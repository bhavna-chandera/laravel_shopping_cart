<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\User;
use App\Models\Cart;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        //

        View::composer('layouts.navigation', function ($view) {
            $userId = Auth::id();
            if (Auth::check()) {
                $cart = Cart::where('user_id', $userId)->first();

                // If cart exists, count products; else 0
                $count = $cart ? $cart->products()->count() : 0;
                $view->with([
                    'wishlistsCount' => Wishlist::where('user_id', $userId)->count(),
                    'cartsCount'     => $count,
                    //'cartsCount'     => Cart->products()::where('user_id', $userId)->count(),
                ]);
            } else {
                $view->with([
                    'wishlistsCount' => 0,
                    'cartsCount'     => 0,
                ]);
            }
        });
    }
}
