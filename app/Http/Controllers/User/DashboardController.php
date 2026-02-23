<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    //
    public function index()
    {

        //$products = Product::all();

        return view('user.dashboard.dashboard');
    }

    // public function index()
    // {

    //     //$products = Product::all();
    //     $user = Auth::user();
    //     $products = $user->products;
    //     $wishlists = $user->wishlists;


    //     return view('user.dashboard.dashboard', compact('products', 'wishlists'));
    // }
}
