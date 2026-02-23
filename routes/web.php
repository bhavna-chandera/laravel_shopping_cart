<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\ProductController;
use App\Http\Controllers\User\OrderController;
use App\Http\Controllers\User\CartController;
use App\Http\Controllers\User\WishlistController;
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\AddrController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('user.dashboard.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/address', [AddrController::class, 'index'])->name('address.addr');
    Route::get('/address/add_addr', [AddrController::class, 'create'])->name('address.add_addr.create');
    Route::post('/address/adding', [AddrController::class, 'store'])->name('address.add_addr.store');
    // Route::get('/address/edit', [AddrController::class, 'edit'])->name('address.edit_addr');
    Route::delete('/address/{add_id}', [AddrController::class, 'destroy'])->name('address.destroy');
    Route::get('/address/{add_id}/edit', [AddrController::class, 'edit'])->name('address.edit_addr');
    Route::put('/address/{add_id}', [AddrController::class, 'update'])->name('address.update_addr');
    //Route::put('/address', [AddrController::class, 'store'])->name('address.edit_addr');
});

/*
      // ------------------------------------------editing
      // Route::get('/user/dashboard/dashboard', function () {
      //     return view('user/dashboard/dashboard');
      // })->middleware(['auth', 'verified'])->name('user.dashboard.dashboard');
      
      // Route::get('/user/products/products', [ProductController::class, 'index'], function () {
      //     return view('user/products/products');
      // })->middleware(['auth', 'verified'])->name('user.products.products');
      
      // Route::get('/user/orders/orders', function () {
       //     return view('user/orders/orders');
      // })->middleware(['auth', 'verified'])->name('user.orders.orders');
      
      // Route::get('/user/wishlist/wishlist', [WishlistController::class, 'index'], function () {
       //     return view('user/wishlist/wishlist');
      // })->middleware(['auth', 'verified'])->name('user.wishlist.wishlist');
      
      // Route::get('/user/cart/cart', function () {
       //     return view('user/cart/cart');
      // })->middleware(['auth', 'verified'])->name('user.cart.cart');
      
      //********************************************************** 
      //Route::get('/products', [ProductController::class, 'index'])->name('products.index');
      //Route::get('/products', [ProductController::class, 'index'])->name('products');
      //************************************************************** 
      
      // Route::get('/user/products/prodform', [ProductController::class, 'create'], function () {
      //     return view('user/products/prodform');
      // })->middleware(['auth', 'verified'])->name('user.products.prodform');
      
       // Route::get('/user/products/products/details/{p_id}', [ProductController::class, 'details'], function () {
       //     return view('user/products/products/details/{p_id}');
       // })->middleware(['auth', 'verified'])->name('user.products.products.details');
       
       //Route::get('/details/{p_id}', [ProductController::class, 'details'])->middleware(['auth', 'veryfied'])->name('user.products.details');
       
       // Route::get('/user/products/create', [ProductController::class, 'create'])->name('user.products.create');
       //Route::post('/user/products/products', [ProductController::class, 'store'])->name('user.products.products.store');
       //----------------------------------------end
*/

// ---------------------started to make group for user---------------------------------
Route::group([
    'prefix' => 'user',
    'middleware' => ['auth', 'verified'], // // i will add check role user in future************************
], function () {
    // All routes in this inner group will use ProductController
    Route::group([
        'prefix' => 'dashboard',
        'controller' => DashboardController::class,
    ], function () {
        // Routes will have prefix '/user/dashboard/dashboard' and use ProductController
        Route::get('/dashboard', 'index')->name('user.dashboard.dashboard');
    });

    Route::group([
        'prefix' => 'products',
        'controller' => ProductController::class,
    ], function () {

        Route::get('/products', 'index')->name('user.products.products');
        Route::get('/prodform', 'create')->name('user.products.prodform');
        Route::post('/products', 'store')->name('user.products.products.store');
        Route::get('/details/{p_id}/{cat_id}', 'details')->name('user.products.details');
    });

    Route::group([
        'prefix' => 'orders',
        'controller' => OrderController::class,
    ], function () {

        Route::get('/orders', 'index')->name('user.orders.orders');
        // Route::get('/orders', 'show')->name('user.orders.orders.show');
        Route::post('/orders', 'store')->name('user.orders.orders.store');
        //Route::get('/rateform', 'create')->name('user.orders.rateform');
        //Route::post('/products', 'store')->name('user.products.products.store');
        Route::get('/orders/{order}/product/{p_id}/rateform', 'create')->name('user.orders.rateform');
        Route::post('/orders/{order}/product/{p_id}/rateform', 'storeOrUpdateReview')->name('user.orders.rateform');
        // Route::put('/orders/{order}/product/{p_id}/rateform', 'submitReview')->name('user.orders.rateform');
    });

    Route::group([
        'prefix' => 'wishlist',
        'controller' => WishlistController::class,
    ], function () {

        Route::get('/wishlist', 'index')->name('user.wishlist.wishlist');
        Route::post('/toggle/{p_id}', 'toggle')->name('user.wishlist.toggle');
    });

    Route::group([
        'prefix' => 'cart',
        'controller' => CartController::class,
    ], function () {

        //Route::get('/cart', 'index')->name('user.cart.cart');
        Route::get('/cart', 'show', 'showAddresses')->name('user.cart.cart');
        // Route::get('/cart/update', 'update')->name('user.cart.cart.update');
        Route::post('/cart/update', 'update')->name('user.cart.cart.update');
        Route::get('/addressform', 'create')->name('user.cart.addressform');
        Route::post('/cart', 'store')->name('user.cart.cart.store');


        //Route::post('/cart/update', 'update')->name('user.cart.cart.update');



        // Route::middleware(['auth'])->group(function () {
        //     Route::post('/cart/cart/update', [CartController::class, 'update'])
        //         ->name('user.cart.cart.update');

        //     Route::get('/cart', [CartController::class, 'show'])
        //         ->name('user.cart.show');
        // });
    });
});
//--------------------------------------------------------------------

require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';
