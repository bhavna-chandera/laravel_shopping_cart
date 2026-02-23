<?php

// use Illuminate\Support\Facades\Route;

// Route::get('/admin/admindash', function () {
//     return view('admin.admindash');
// })->middleware(['auth', 'verified'], ['role', 'admin'])->name('admin/dashboard');


use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\User\ProductController;
use App\Http\Controllers\User\OrderController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\User\ReviewController;
use Illuminate\Support\Facades\Route;


// Route::group([
//     'prefix' => 'admin',
//     'middleware' => ['auth', 'verified', 'admin'],
// ], function () {
//     Route::get('/dashboard', [AdminDashboardController::class, 'index'])
//         ->name('admin.dashboard.dashboard');
// });

Route::group(
    [
        'prefix' => 'admin',
        'middleware' => ['auth', 'verified', 'admin'], // // i will add check role user in future************************
    ],
    function () {
        // All routes in this inner group will use ProductController
        Route::group([
            'prefix' => 'dashboard',
            'controller' => AdminDashboardController::class,
        ], function () {
            // Routes will have prefix '/user/dashboard/dashboard' and use ProductController
            Route::get('/dashboard', 'index')->name('admin.dashboard.dashboard');
            Route::get('/abt_m_user', 'abtmuserindex')->name('admin.dashboard.abt_m_user');
            Route::get('/abt_order', 'abtorderindex')->name('admin.dashboard.abt_order');
            Route::get('/abt_prod_view', 'prodviewindex')->name('admin.dashboard.abt_prod_view');
            Route::get('/order', 'orderindex')->name('admin.dashboard.order');
            Route::get('/product', 'prodindex')->name('admin.dashboard.product');
            Route::get('/review', 'reviewindex')->name('admin.dashboard.review');
            Route::get('/user', 'userindex')->name('admin.dashboard.user');
        });

        Route::group([
            'prefix' => 'users',
            'controller' => UserController::class,
        ], function () {
            // Routes will have prefix '/user/dashboard/dashboard' and use ProductController
            Route::get('/users', 'index')->name('admin.users.users');
            Route::delete('/users/{id}',  'destroy')->name('admin.users.users.destroy');

            Route::get('/adduser_form', 'usercreate')->name('admin.users.adduser_form');
            Route::post('/users', 'store')->name('admin.users.users.store');
            Route::get('/users/{id}/edit', 'adminedit')->name('admin.users.edit');

            Route::put('/users/{id}', 'adminupdate')->name('admin.users.users.adminupdate');

            Route::get('/addadmin', 'admincreate')->name('admin.users.addadmin');
            Route::post('/users', 'adminstore')->name('admin.users.users.adminstore');
        });

        Route::group([
            'prefix' => 'products',
            'controller' => ProductController::class,
        ], function () {
            // Routes will have prefix '/user/dashboard/dashboard' and use ProductController
            Route::get('/products', 'adminindex', 'indeximages')->name('admin.products.products');
            Route::delete('/products/{p_id}',  'destroy')->name('admin.products.products.destroy');
            Route::get('/prod_form', 'admincreate')->name('admin.products.prod_form');
            Route::post('/products', 'store')->name('admin.products.products.store');
            Route::get('/products/{p_id}/edit', 'adminedit')->name('admin.products.edit');

            Route::put('/products/{p_id}', 'adminupdate')->name('admin.products.products.update');
        });

        Route::group([
            'prefix' => 'orders',
            'controller' => OrderController::class,
        ], function () {
            // Routes will have prefix '/user/dashboard/dashboard' and use ProductController
            Route::get('/orders', 'adminorders')->name('admin.orders.orders');
            Route::put('/orders/{order}/update-status', 'updateStatus')->name('admin.orders.orders.update_status');
            Route::delete('/orders/{order_id}',  'destroy')->name('admin.orders.orders.destroy');
            Route::post('/update-status', 'updateOrderStatus')->name('admin.orders.updateorderstatus');
        });

        Route::group([
            'prefix' => 'reviews',
            'controller' => ReviewController::class,
        ], function () {
            // Routes will have prefix '/user/dashboard/dashboard' and use ProductController
            Route::get('/reviews', 'adminindex')->name('admin.reviews.reviews');
            //Route::put('/reviews/{order}/update-status', 'updateStatus')->name('admin.orders.orders.update_status');
        });
    }
);
