<?php

namespace App\Providers;


use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\User;
use App\Models\Cart;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Share variables with the 'layouts.navigation' view (or wherever your navbar is)
        View::composer('layouts.navigation', function ($view) {
            $cartCount = 0;
            $wishlistCount = 0;

            if (Auth::check()) {
                $user = Auth::user();
                // $cartCount = $user->cartProducts()->count();
                // $wishlistCount = $user->wishlistItems()->count();
            }

            $view->with('cartCount', $cartCount)->with('wishlistCount', $wishlistCount);
        });
    }
}
