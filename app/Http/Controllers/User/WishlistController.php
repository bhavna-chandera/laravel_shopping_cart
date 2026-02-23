<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Wishlist;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    //

    public function index(Request $request)
    {
        $user = Auth::user();
        $search = $request->input('search');
        $category = $request->input('filterbycat');

        $products = $user->wishlistProducts()
            ->with('images')
            ->withAvg('ratings', 'rates')
            ->withCount('ratings')
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('p_name', 'LIKE', "%{$search}%")
                        ->orWhere('p_desc', 'LIKE', "%{$search}%");
                });
            })->when($category, function ($query, $category) {
                $query->where('cat_id', $category);
            })
            ->get();


        $wishlist = $products->pluck('p_id')->toArray();

        $cart = $user->cartProducts()
            ->pluck('cart_product.qty', 'cart_product.p_id')
            ->toArray();

        return view('user.wishlist.wishlist', compact(
            'products',
            'wishlist',
            'cart'
        ));
    }

    public function toggle($p_id)
    {
        $user = Auth::user();

        $user->wishlistProducts()->toggle($p_id);

        return response()->noContent();
    }


    // public function iiiiindex()
    // {
    //     $userId = Auth::id();

    //     // Get all wishlist entries with products + images
    //     $wishlists = Wishlist::where('user_id', $userId)
    //         ->with('products.images')
    //         ->get(); // Collection of Wishlist

    //     // Flatten all products from all wishlists into a single collection
    //     $products = $wishlists->flatMap(function ($wishlist) {
    //         return $wishlist->products;
    //     });


    //     $wishlistProductIds = $products->pluck('p_id')->toArray();

    //     return view('user.wishlist.wishlist', [
    //         'products' => $products,
    //         'wishlist' => $wishlistProductIds
    //     ]);
    // }


    // public function indeeeeeeex()
    // {
    //     $userId = Auth::id();

    //     // Get user's wishlist with ALL products + images
    //     $wishlist = Wishlist::where('user_id', $userId)
    //         ->with(['products.images'])
    //         ->get();

    //     $products = $wishlist ? $wishlist->products : collect();

    //     // Used to show ❤️ / 🤍
    //     $wishlistProductIds = $products->pluck('p_id')->toArray();

    //     return view('user.wishlist.wishlist', [
    //         'products' => $products,
    //         'wishlist' => $wishlistProductIds
    //     ]);
    // }


    // public function toggle($p_id)
    //public function toggle(Request $request)
    // {

    //     $productId = Product::findOrFail($p_id);

    //     // $user = Auth::user();
    //     $userId = Auth::id();
    //     //$productId = $request->input('p_id');

    //     $wishlistItem = Wishlist::where('user_id', $userId)
    //         ->where('p_id', $p_id)
    //         ->first();

    //     // $wishlistItem = DB::table('wishlist')
    //     //     ->where('p_id', $productId)
    //     //     ->where('user_id', $userId)
    //     //     ->first();

    //     if ($wishlistItem) {
    //         //DB::table('wishlists')->where('id', $wishlistItem->id)->delete();
    //         $wishlistItem->delete();
    //         $inWishlist = false;
    //         //$message = 'Product removed from wishlist.';
    //         //return response()->json(['message' => 'removed from wishlist']);
    //     } else {
    //         Wishlist::create([
    //             'user_id' => $userId,
    //             'p_id' => $p_id
    //         ]);
    //         $inWishlist = true;
    //         //$message = 'Product added to wishlist.';
    //         //return response()->json(['message' => 'added to wishlist']);
    //     }
    //     $products = Product::all();


    //     //return view('user.products.details', compact('wishlistItem', 'productId'));
    //     return view('user.products.products', compact('products'));
    //     // return response()->json([
    //     //     'success' => true,
    //     //     'inWishlist' => $inWishlist,
    //     //     'message' => $message
    //     // ]);
    // }

    // public function toggle($p_id)
    // {
    //     $user = Auth::user();

    //     // This one line replaces your entire if/else block
    //     //$user->wishlists()->toggle($p_id);
    //     $results = $user->wishlists()->toggle($p_id);

    //     // Check if it was attached or detached for your response
    //     $inWishlist = count($results['attached']) > 0;

    //     return response()->noContent();
    // }



    // public function toggle(Request $request, $p_id)
    // {
    //     $userId = Auth::id();
    //     $wishlists = Wishlist::firstOrCreate(['user_id' => $userId]);

    //     $wishlists = Wishlist::where('user_id', $userId)
    //         ->where('p_id', $p_id)
    //         ->first();

    //     //$wishlists =  $wishlists->products()->wherekey('p_id', $p_id)->exists();


    //     if ($wishlists) {
    //         $wishlists->delete();
    //         $wishlists->products()->detach($p_id);
    //         $inWishlist = false;
    //         // $message = 'Product removed from wishlist.';
    //     } else {
    //         $wishlists = Wishlist::create([
    //             'user_id' => $userId,
    //             'p_id' => $p_id
    //         ]);
    //         $wishlists->products()->attach($p_id);
    //         $inWishlist = true;
    //         // $message = 'Product added to wishlist.';
    //     }

    //     return response()->noContent();
    // }
}
