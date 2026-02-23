<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use App\Models\User;
use App\Models\Wishlist;
use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Enums\AddType;
use Illuminate\Validation\Rules\Enum;



class CartController extends Controller
{
    /**
     * Add / Update cart item (AJAX)
     */



    public function show()
    {
        $userId = Auth::id();

        $cart = Cart::with('products.images')
            ->where('user_id', $userId)
            ->first(); // user's cart

        $wishlist = Wishlist::where('user_id', $userId)->pluck('p_id')->toArray();

        return view('user.cart.cart', compact('cart', 'wishlist'));
    }

    public function showAddresses()
    {
        $userId = Auth::id();
        $addresses = Address::where('user_id', $userId);
        return view('user.cart.cart');
    }

    // public function uppppdate(Request $request)
    // {

    //     $userId = Auth::id();
    //     $request->validate([
    //         'p_id' => 'required|integer',
    //         'qty' => 'required|integer|min:1',
    //         'price_at_purchase' => 'required|numeric',
    //     ]);

    //     $cart = Cart::where('user_id', $userId)
    //         ->where('p_id', $request->p_id)
    //         ->first();

    //     if ($cart) {
    //         $cart->qty += $request->qty;
    //         $cart->price = $request->price_at_purchase;
    //         $cart->save();
    //     } else {
    //         Cart::create([
    //             'user_id' => $userId,
    //             'p_id' => $request->p_id,
    //             'qty' => $request->qty,
    //             'price' => $request->price_at_purchase,
    //         ]);
    //     }

    //     return response()->json(['status' => 'success']);
    // }

    public function update(Request $request)
    {
        $userId = Auth::id();
        $request->validate([
            // 'p_id' => 'required|exists:products,p_id',
            'qty'  => 'required|integer|min:0',
            'price_at_purchase' => 'required|numeric|min:0',
        ]);

        // // Get or create cart for user
        // $cart = Cart::firstOrCreate(
        //     ['user_id' => $userId],
        //     ['price' => 0]
        // );

        $cart = Cart::firstOrCreate(
    ['user_id' => $userId],
    [
        'p_id'           => $request->p_id, // needed because column is NOT NULL
        'price'          => 0,
        'qty'            => 0,
        'item_added_at'  => now(),
        'item_updated_at'=> now(),
    ]
);

        // Remove item if qty = 0
        if ($request->qty == 0) {
            $cart->products()->detach($request->p_id);

            return response()->json([
                'status' => 'removed'
            ]);
        }

        // Add or update product in pivot-> without removing already added cart items
        $cart->products()->syncWithoutDetaching([
            $request->p_id => [
                'qty' => $request->qty,
                'price_at_purchase' => $request->price_at_purchase
            ]
        ]);

        // Update cart total price
        $total = $cart->products
            ->sum(function ($product) {
                // add shipping charge at 10 if want to replace---***********************************************************************
                $grandTotal = (($product->pivot->qty * $product->pivot->price_at_purchase));
                return $grandTotal;
            });
        $total += 10;

        $cart->update(['price' => $total]);

        return response()->json([
            'status' => 'updated',
            'cart_total' => $total
        ]);
    }

    public function create()
    {
        return view('user.cart.addressform');
    }

    public function store(Request $request)
    {

        $userId = Auth::id();
        //dump($userId);
        if (!$userId) {
            return response()->json(['error' => 'User is not authenticated'], 401);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'mobile' => 'required',
            'pincode' => 'required|numeric|digits:6',
            'address' => 'required|string|min:5|max:255',
            'city' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'mobile_alternate' => 'nullable',
            'landmark' => 'nullable|string|max:255',

        ]);

        // $validated = $request->validate([
        //     'add_type' => [
        //         'required',
        //         new Enum(AddType::class) // Validates that the submitted value exists in the enum
        //     ],
        //     // other validation rules
        // ]);

        $validatedaddtype =  $request->validate([
            'add_type' => ['required', new Enum(AddType::class)],
        ]);

        $addTypeValue = $validatedaddtype['add_type'];
        //dump($validatedaddtype);

        $addresses = Address::create([
            'user_id' => $userId,
            'name' => $validated['name'],
            'mobile' => $validated['mobile'],
            'pincode' => $validated['pincode'],
            'address' => $validated['address'],
            'city' => $validated['city'],
            'state' => $validated['state'],
            'city' => $validated['city'],
            'mobile_alternate' => $validated['mobile_alternate'] ?? null,
            'landmark' => $validated['landmark'] ?? null,
            'add_type' => $addTypeValue,
        ]);

        return redirect()
            ->route('user.cart.cart')
            ->with('message', 'Address added successfully!');
    }
}


/**
 * Show cart page
 */
    // public function show()
    // {
    //     $cart = Cart::with('products')
    //         ->where('user_id', Auth::id())
    //         ->first();

    //     return view('user.cart.cart', compact('cart'));
    // }



// namespace App\Http\Controllers\User;

// use App\Http\Controllers\Controller;
// use Illuminate\Http\Request;
// use App\Models\Cart;
// use App\Models\User;
// use Illuminate\Support\Facades\Auth;

// class CartController extends Controller
 

    // public function show()
    // {
    //     //$user = User::find(1);
    //     // if ($user) {
    //     //     $products = $user->products; // Accesses the 'products' relationship
    //     // };
    //     $carts = Cart::with('products'); // Eager load products
    //     dd($carts);
    //     return view('user.cart.cart', compact('products'));
    // }



    // public function update(Request $request)
    // {
    //     $request->validate([
    //         'p_id' => 'required|integer',
    //         'qty' => 'required|integer|min:0',
    //         'price_at_purchase' => 'required|numeric'
    //     ]);

        // $userId = Auth::id();

        // if ($request->qty == 0) {
        //     Cart::where([
        //         'user_id' => $userId,
        //         'p_id' => $request->productId
        //     ])->delete();

        //     return response()->noContent();
        //     // return response()->json(['status' => 'removed']);
        // }

        // if ($request->qty > 0) {
            //$wishlists->delete();
            //$wishlists->products()->detach($p_id);
            //$inWishlist = false;
            // $message = 'Product removed from wishlist.';

        // } else {
        //     // $wishlists = Wishlist::create([
        //     //    'user_id' => $userId,
        //     //   'p_id' => $p_id
        //     //]);
        //     // $wishlists->products()->attach($p_id);
        //     //$inWishlist = true;
        //     // $message = 'Product added to wishlist.';
        // }

        // Cart::updateOrCreate(
        //     [
        //         'user_id'    => $userId,
        //         'p_id' => $request->productId
        //     ],
        //     [
        //         'qty'   => $request->qty,
        //         'price_at_purchase' => $request->price
        //     ]
        // );

        // return response()->json([
        //     'status' => 'updated',
        //     'qty'    => $request->qty
        // ]);
//         return response()->noContent();
//     }
// }




// class CartControuuuller extends Controller
// {
//     //
//     public function indexxxxx(Request $request)
//     {

//         //$products = Product::all();
//         $userId = Auth::id(); // Get the currently authenticated user's ID
//         $productId = $request->input('productId'); // Get the product ID from the request
//         $productPrice = $request->input('p_offerprice');

//         $cartItem = Cart::where('user_id', $userId)
//             ->where('productId', $productId)
//             ->first(); // Retrieve the first matching item

//         if ($cartItem) {
//             // Product already in cart, increment the quantity
//             $cartItem->quantity++;
//             $cartItem->save();
//         } else {
//             // Product not in cart, create a new entry
//             Cart::create([
//                 'user_id' => $userId,
//                 // 'productId' => $productId,
//                 'productId' => 18,
//                 // 'price' => $productPrice,
//                 'qty' => 1,
//                 'item_added_at',
//                 'item_updated_at',
//             ]);
//         }




//         return view('user.cart.cart');
//     }
// } -->