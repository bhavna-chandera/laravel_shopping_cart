<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\Product;
use App\Models\User;
use App\Models\Wishlist;
use App\Models\Address;
use App\Models\Order;
use App\Models\Image;
use App\Models\OrderItem;
use App\Enums\OrderStatus;
use App\Models\Rating;
use Illuminate\Validation\Rules\Enum;
use PhpParser\Node\Stmt\TryCatch;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;



class OrderController extends Controller
{
    //
    // public function index()
    // {

    //     //$products = Product::all(); 
    //     return view('user.orders.orders');
    // }

    public function index(Request $request)
    {
        $userId = Auth::id();
        // Retrieve all orders with their order items, ordered by creation date descending
        //$orders = Order::with('orderItems.product')->latest()->get();
        // $orders = Order::with('orderItems.product')
        //     ->where('user_id', $userId)
        //     ->latest()
        //     ->paginate(10);
        // // ->get();

        // // $query = YourModel::query();

        // if ($request->filled('from_date') && $request->filled('to_date')) {
        //     $startDate = Carbon::parse($request->from_date)->startOfDay();
        //     $endDate = Carbon::parse($request->to_date)->endOfDay();

        //     // Use whereBetween for date range filtering
        //     $orders->whereBetween('created_at', [$startDate, $endDate]);

        //     // Alternative: Use whereDate for simpler day-level comparison (if time doesn't matter)
        //     // $query->whereDate('created_at', '>=', $request->from_date)
        //     //       ->whereDate('created_at', '<=', $request->to_date);
        // }

        // $data = $orders->get();
        $query = Order::with('orderItems.product')
            ->where('user_id', $userId)
            ->latest();

        if ($request->filled('from_date') && $request->filled('to_date')) {
            $startDate = Carbon::parse($request->from_date)->startOfDay();
            $endDate = Carbon::parse($request->to_date)->endOfDay();

            $query->whereBetween('created_at', [$startDate, $endDate]);
        }

        // appends(request()->all()) ensures the dates stay in the URL when you change pages
        $orders = $query->simplePaginate(5)->appends($request->all());


        return view('user.orders.orders', compact('orders'));
    }

    public function create($order_id, $p_id)
    {
        $userId = Auth::id();

        //$order = Order::findOrFail($order_id);

        $ratings = Rating::where('p_id', $p_id)
            ->where('user_id', $userId)
            ->where('order_id', $order_id)
            ->first();


        return view('user.orders.rateform', [
            'order_id' => $order_id,
            'p_id' => $p_id,
            'ratings' => $ratings
        ]);
        //return view('user.orders.rateform');
    }

    public function storeOrUpdateReview(Request $request)
    {
        $userId = Auth::id();

        $request->validate([
            'order_id' => 'required|exists:orders,order_id',
            'p_id' => 'required|exists:products,p_id',
            'rates' => 'required|integer|min:1|max:5',
            'review' => 'nullable|string|max:2000',
        ]);

        // Save review logic here
        Rating::updateOrCreate(
            [
                'user_id' => $userId,
                'order_id' => $request->order_id,
                'p_id' => $request->p_id,
            ],
            [
                'rates' => $request->rates,
                'review' => $request->review,
            ]
        );

        return redirect()
            ->route('user.orders.orders')->with('success', 'Review submitted successfully!');




        //return redirect()->back()->with('success', 'Review submitted successfully!');
    }
    // public function updateReview(Request $request)
    // {
    //     $userId = Auth::id();



    //     $request->validate([
    //         'order_id' => 'required|exists:orders,order_id',
    //         'p_id' => 'required|exists:products,p_id',
    //         'rates' => 'required|integer|min:1|max:5',
    //         'review' => 'nullable|string|max:2000',
    //     ]);

    //     // Save review logic here
    //     Rating::updateOrCreate([
    //         'user_id' => $userId,
    //         'order_id' => $request->order_id,
    //         'p_id' => $request->p_id,
    //         'rates' => $request->rates,
    //         'review' => $request->review,
    //     ]);

    //     return redirect()->back()->with('success', 'Review submitted successfully!');
    // }


    // public function show($id)
    // {
    //     // Retrieve a specific order with its order items and the related product details
    //     // $order = Order::with('orderItems.product')->find($id);

    //     // return view('orders.show', compact('order'));
    // }



    public function store(Request $request)
    {

        $userId = Auth::id();

        if (!$userId) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        //dd($request->all());


        $request->validate([
            'add_id' => 'required|exists:addresses,add_id',
        ]);

        // $validatedStatus = $request->validate([
        //     'order_status' => [new Enum(OrderStatus::class)],
        // ]);

        // $OrderValue = $validatedStatus['order_status'];
        //dump($validatedStatus);

        // Fetch cart with products
        $cart = Cart::with('products')
            ->where('user_id', $userId)
            ->first();

        if (!$cart || $cart->products->count() === 0) {
            return response()->json(['error' => 'Cart is empty'], 400);
        }

        try {
            // Calculate total 
            $subtotal = 0;

            foreach ($cart->products as $product) {
                $subtotal += $product->pivot->qty * $product->pivot->price_at_purchase;
            }

            $shipping = 10;
            $grandTotal = $subtotal + $shipping;

            // Create order
            $order = Order::create([
                'user_id'           => $userId,
                'add_id'            => $request->add_id,
                'order_status'      => 'in_process',
                'grand_total'       => $grandTotal,
                'order_date'        => now(),
                // 'order_placed_date' => now(),
            ]);

            foreach ($cart->products as $product) {
                OrderItem::create([
                    'user_id' => $userId,
                    'order_id' => $order->order_id,
                    'p_id' => $product->p_id,
                    'price' => $product->pivot->price_at_purchase,
                    'qty' => $product->pivot->qty,
                ]);
            }


            $cart->products()->detach();
            $cart->update(['price' => 0]);

            return response()->json([
                'status' => 'success',
                'order_id' => $order->order_id
            ]);
        } catch (\Exception $e) {

            return response()->json([
                'error' => 'Order failed',
                'message' => $e->getMessage()
            ], 500);
        }

        // return redirect()->route('user.orders.orders')->with('success', 'Order placed successfully!');
        return view('user.orders.orders')->with('success', 'Order placed successfully!');
    }




    public function updateOrderStatus(Request $request, Order $order)
    {
        $request->validate([
            'order_id'     => 'required|exists:orders,order_id',
            'order_status' => 'required|in:in_process,dispatched,out_for_delivery,delivered,cancelled'
        ]);

        $order = Order::where('order_id', $request->order_id)->firstOrFail();


        $data = [
            'order_status' => $request->order_status
        ];

        if ($request->order_status === 'delivered') {
            $data['order_placed_date'] = Carbon::now();
        } else {
            // This will set the column to NULL in the database
            // $data['order_placed_date'] = Carbon::null();
            $order->order_placed_date = null;
        }

        $order->update($data);
        //return view('admin.orders.orders');

        //$order->save();

        return response()->json(['success' => true]);
    }



    public function adminorders(Request $request)
    {
        $search = $request->search;
        $status = $request->status;
        $from   = $request->from_date;
        $to     = $request->to_date;
        //-------------------sorting----------------
        $allowedColumns = ['order_id', 'user_id', 'grand_total', 'created_at', 'order_placed_date'];

        $sortColumn = $request->input('sort_by_column', 'order_id');
        $sortDirection = $request->input('sort_direction', 'asc');

        // Validate sorting inputs
        if (!in_array($sortColumn, $allowedColumns)) {
            $sortColumn = 'order_id';
        }

        $sortDirection = $sortDirection === 'desc' ? 'desc' : 'asc';
        //-----------------------end-------------------------------

        $orders = DB::table('orders')
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('order_id', 'LIKE', "%{$search}%")
                        ->orWhere('grand_total', 'LIKE', "%{$search}%");
                });
            })
            ->when($status, function ($query) use ($status) {
                $query->where('order_status', $status);
            })
            ->when($from && $to, function ($query) use ($from, $to) {
                $query->whereBetween('created_at', [
                    Carbon::parse($from)->startOfDay(),
                    Carbon::parse($to)->endOfDay()
                ]);
            })
            ->orderby($sortColumn, $sortDirection)
            ->simplePaginate(5)
            ->appends($request->all());

        return view('admin.orders.orders', compact('orders'), [
            'currentSortColumn' => $sortColumn,
            'currentSortDirection' => $sortDirection,
        ]);
    }


    public function adminordeeeeers(Request $request)
    {
        // $orders = Order::simplePaginate(3);
        // return view('admin.orders.orders', compact('orders'));

        $userId = Auth::id();
        $search = $request->input('search');
        $status = $request->input('status');
        // $users = User::all()->paginate(3);
        // $users = DB::table('users')->paginate(3);
        $orders = DB::table('orders')->when($search, function ($query, $search) {
            $query->where(function ($q) use ($search) {
                $q->where('grand_total', 'LIKE', "%{$search}%")
                    ->orWhere('order_id', 'LIKE', "%{$search}%");
            });
        })->when($status, function ($query, $status) {
            $query->where('order_status', $status);
        })->simplePaginate(3);

        // if ($request->filled('from_date') && $request->filled('to_date')) {
        //     $startDate = Carbon::parse($request->from_date)->startOfDay();
        //     $endDate = Carbon::parse($request->to_date)->endOfDay();

        //     // $orders->whereBetween('created_at', [$startDate, $endDate]);
        //     $orders->whereDate('created_at', '>=', $request->from_date)
        //         ->whereDate('created_at', '<=', $request->to_date);
        // }

        return view('admin.orders.orders', compact('orders'));
    }


    public function indeximages()
    {

        $images = Image::all();

        return view('admin.products.products', compact('images'));
    }

    public function updateStatus(Request $request, Order $order)
    {


        $validated = $request->validate([
            'order_status' => 'required|string|in:in_process,dispatched,out_for_delivery,delivered,cancelled',
        ]);

        // Update the order status
        $order->update([
            'order_status' => $validated['order_status'],
        ]);
    }

    public function destroy($order_id)
    {

        //$userId = Auth::id();
        $deleted = Order::where('order_id', $order_id)
            ->delete();

        if ($deleted) {
            return redirect()->back()->with('success', 'Order deleted successfully.');
        }

        return redirect()->back()->with('error', 'User not found or unauthorized.');
    }
}
