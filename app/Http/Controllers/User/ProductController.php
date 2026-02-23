<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Image;
use App\Models\Wishlist;
use App\Models\Cart;
use App\Models\Analysis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;


class ProductController extends Controller
{

    public function index(Request $request)
    {

        $userId = Auth::id();
        $search = $request->input('search');
        $category = $request->input('filterbycat');
        $products = Product::with('images')->get();

        $wishlist = Wishlist::where('user_id', $userId)
            ->pluck('p_id') //it will give collection...
            ->toArray();

        $cart = DB::table('cart_product')
            ->join('carts', 'cart_product.cart_id', '=', 'carts.cart_id')
            ->where('carts.user_id', $userId)
            ->pluck('cart_product.qty', 'cart_product.p_id')
            ->toArray();

        $products = Product::withAvg('ratings', 'rates')->withCount('ratings')
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('p_name', 'LIKE', "%{$search}%")
                        ->orWhere('p_desc', 'LIKE', "%{$search}%");
                });
            })->when($category, function ($query, $category) {
                $query->where('cat_id', $category);
            })
            ->get();


        return view('user.products.products', compact(
            'products',
            'wishlist',
            'cart',
            'userId'
        ));
    }


    // public function innnnnndex()
    // {
    //     // Retrieve all products from the database
    //     $products = Product::all();

    //     $userId = Auth::id();

    //     $wishlist = Wishlist::where('user_id', $userId)
    //         ->pluck('p_id')
    //         ->toArray();

    //     $cart = DB::table('cart_product')
    //         ->where('user_id', $userId)
    //         ->pluck('qty', 'p_id')
    //         ->toArray();


    //     // $cart = Cart::where('user_id', $userId)
    //     //     ->toArray();


    //     return view('user.products.products', compact('products', 'wishlist', 'cart', 'userId'));
    // }


    // public function wishlistttttttt()
    // {
    //     //$products = Product::all(); // or Product::get();

    //     $userId = Auth::id(); // Get the authenticated user's ID 

    //     $isWishlisted = DB::table('products')
    //         ->select('products.*') // Select all columns from the products table
    //         ->addSelect(DB::raw("(CASE WHEN count(wishlists.p_id) > 0 THEN 1 ELSE 0 END)"))
    //         ->leftJoin('wishlists', function ($join) use ($userId) {
    //             $join->on('p_id', '=', 'wishlists.p_id')
    //                 ->where('wishlists.user_id', '=', $userId); // Join only for the current user
    //         })->get();

    //     // dump($wishlistItems);
    //     dump($isWishlisted);
    //     $heartStatus = $isWishlisted == 1 ? '0' : '1';
    //     $heart = $heartStatus == 1 ? '❤️' : '🤍';
    //     return view('user.products.products', compact('isWishlisted', 'heart'));
    // }

    //***********************************delete this create at the end of proj */
    public function create()
    {
        return view('user.products.prodform');
    }

    public function details($p_id, $cat_id)
    {
        // Increment view counter
        $analysis = Analysis::firstOrCreate(
            ['p_id' => $p_id],
            [
                'cat_id' => $cat_id,
                'counter_value' => 0,
                'visited_at' => now()
            ]
        );

        $analysis->increment('counter_value');

        // Load product
        $products = Product::withAvg('ratings', 'rates')
            ->withCount('ratings')
            ->findOrFail($p_id);

        $userId = Auth::id();

        $cart = DB::table('cart_product')
            ->join('carts', 'cart_product.cart_id', '=', 'carts.cart_id')
            ->where('carts.user_id', $userId)
            ->pluck('cart_product.qty', 'cart_product.p_id')
            ->toArray();

        $wishlist = Wishlist::where('user_id', $userId)
            ->pluck('p_id')
            ->toArray();

        return view('user.products.details', compact('products', 'cart', 'wishlist'));
    }


    public function detaaaaaaaaaaaaails($p_id)
    {

        $userId = Auth::id();

        //$products = Product::findOrFail($p_id);

        //$products = Product::withAvg('ratings', 'rates')->withCount('ratings')->get();

        $products = Product::withAvg('ratings', 'rates') // average rating
            ->withCount('ratings')        // total ratings count
            ->findOrFail($p_id);

        $cart = DB::table('cart_product')
            ->join('carts', 'cart_product.cart_id', '=', 'carts.cart_id')
            ->where('carts.user_id', $userId)
            ->pluck('cart_product.qty', 'cart_product.p_id')
            ->toArray();

        $wishlist = Wishlist::where('user_id', $userId)
            ->pluck('p_id')
            ->toArray();


        // $cart = DB::table('cart_product')
        //     ->join('carts', 'cart_product.cart_id', '=', 'carts.cart_id')
        //     ->where('carts.user_id', $userId)
        //     ->pluck('cart_product.qty', 'cart_product.p_id')
        //     ->toArray();
        return view('user.products.details', compact('products', 'cart', 'wishlist'));
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'p_name' => 'required|string|max:255',
            'p_price' => 'required|numeric|min:0',
            'p_offerprice' => 'nullable|numeric|min:0|lt:p_price',
            'p_desc' => 'nullable|string',
            'p_stock' => 'required|integer|min:0',
            'cat_id' => 'required|integer',

            //for images 
            'photos' => 'nullable|array|max:5',
            'photos.*' => 'image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);


        $product = Product::create([
            'p_name' => $validated['p_name'],
            'p_desc' => $validated['p_desc'] ?? null,
            'p_price' => $validated['p_price'],
            'p_offerprice' => $validated['p_offerprice'] ?? null,
            'p_stock' => $validated['p_stock'],
            'cat_id' => $validated['cat_id'],
        ]);

        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                $path = $photo->store('products', 'public');

                Image::create([
                    'p_id' => $product->p_id,
                    'image_path' => $path,
                ]);
            }
        }

        return redirect()
            ->route('user.products.products')
            ->with('message', 'Product added successfully!');
    }

    public function show()
    {
        $carts = Cart::with('products');
        return view('user.cart.cart', compact('carts'));
    }


    public function adminindex(Request $request)
    {
        // $products = Product::simplePaginate(3);

        // return view('admin.products.products', compact('products'));
        $query = $request->input('search');
        $category = $request->input('filterbycat');

        $from   = $request->from_date;
        $to     = $request->to_date;

        // for sortinggggggggggggggggg
        $allowedColumns = ['p_id', 'p_name', 'p_price', 'p_offerprice', 'p_stock', 'created_at', 'updated_at'];

        $sortColumn = $request->input('sort_by_column', 'p_id');
        $sortDirection = $request->input('sort_direction', 'asc');

        // Validate sorting inputs
        if (!in_array($sortColumn, $allowedColumns)) {
            $sortColumn = 'p_id';
        }

        $sortDirection = $sortDirection === 'desc' ? 'desc' : 'asc';
        //-------------------------------------------sorting end

        $products = Product::query()
            ->when($query, function ($q) use ($query) {
                $q->where('p_name', 'LIKE', "%{$query}%");
                // ->orWhere('description', 'LIKE', "%{$query}%");
            })->when($category, function ($q) use ($category) {
                $q->where('cat_id', 'LIKE', "%{$category}%");
                // ->orWhere('description', 'LIKE', "%{$query}%");
            })->when($from && $to, function ($query) use ($from, $to) {
                $query->whereBetween('created_at', [
                    Carbon::parse($from)->startOfDay(),
                    Carbon::parse($to)->endOfDay()
                ]);
            })
            ->orderby($sortColumn, $sortDirection)
            ->simplePaginate(3)
            ->appends($request->all()) // Optional: add pagination
            ->withQueryString(); // Keeps search parameters in the pagination links


        // $products = Product::withAvg('ratings', 'rates')->withCount('ratings')
        //     ->when($search, function ($query, $search) {
        //         $query->where(function ($q) use ($search) {
        //             $q->where('p_name', 'LIKE', "%{$search}%")
        //                 ->orWhere('p_desc', 'LIKE', "%{$search}%");
        //         });
        //     })->when($category, function ($query, $category) {
        //         $query->where('cat_id', $category);
        //     })
        //     ->get();


        return view('admin.products.products', compact('products'), [
            'currentSortColumn' => $sortColumn,
            'currentSortDirection' => $sortDirection,
        ]);
    }


    public function indeximages()
    {
        $images = Image::all();
        return view('admin.products.products', compact('images'));
    }

    public function admincreate()
    {
        return view('admin.products.prod_form');
    }

    public function adminedit($p_id)
    {
        // $userId = Auth::id();
        $products = Product::where('p_id', $p_id)
            ->firstOrFail();


        return view('admin.products.edit', compact('products'));
    }

    public function adminupdate(Request $request, $p_id)
    {

        $userId = Auth::id();

        $validated = $request->validate([
            'p_name' => 'required|string|max:255',
            'p_price' => 'required|numeric|min:0',
            'p_offerprice' => 'nullable|numeric|min:0|lt:p_price',
            'p_desc' => 'nullable|string',
            'p_stock' => 'required|integer|min:0',
            'cat_id' => 'required|integer',

            //for images 
            'photos' => 'nullable|array|max:5',
            'photos.*' => 'image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('photos')) {

            Image::where('p_id', $p_id)->delete();

            foreach ($request->file('photos') as $photo) {
                $path = $photo->store('products', 'public');

                Image::create([
                    'p_id' => $p_id,
                    'image_path' => $path,
                ]);
            }
        }

        $product = Product::where('p_id', $p_id)
            ->firstOrFail();

        $product->update($validated);

        return redirect()->route('admin.products.products')->with('success', 'Product Editedd successfully!');
    }

    public function destroy($p_id)
    {

        //$userId = Auth::id();
        $deleted = Product::where('p_id', $p_id)
            ->delete();

        if ($deleted) {
            return redirect()->back()->with('success', 'Product deleted successfully.');
        }

        return redirect()->back()->with('error', 'User not found or unauthorized.');
    }



    public function productView(Request $request)
    {
        $p_id = $request->query('p_id');

        $cat_id = $request->query('cat_id');


        $analysis = Analysis::firstOrCreate(
            ['p_id' => $p_id],
            ['cat_id' => $cat_id, 'counter_value' => 0]
        );

        $analysis->increment('counter_value');
    }
}
