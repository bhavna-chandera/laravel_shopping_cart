<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Product;
use App\Models\Category;
use App\Models\User;
use App\Models\Order;
use App\Models\Rating;
use App\Models\Analysis;

class AdminDashboardController extends Controller
{
    /**
     * Admin Dashboard Page
     */
    public function index(): View
    {
        return view('admin.dashboard.dashboard');
    }

    public function abtmuserindex(): View
    {

        $results = DB::table('users')
            ->selectRaw("
            MONTHNAME(created_at) as month, 
            COUNT(*) as item_count, 
            MONTH(created_at) as month_num
        ")
            ->groupBy('month', 'month_num')
            ->orderBy('month_num', 'asc')
            ->get();

        $totalUsers = DB::table('users')->count();


        $data = [];
        //$data = [['Month', 'Users Registered']];
        $data[] = ['Month', 'Total Users'];

        foreach ($results as $row) {
            $data[] = [$row->month, (int) $row->item_count];
        }

        return view('admin.dashboard.abt_m_user', [
            // 'json_data' => json_encode($data),
            'chartData' => $data,
            'totalUsers' => $totalUsers
        ]);
    }

    public function abtorderindex(): View
    {

        $totalOrders = Order::count();

        $ordersByStatus = Order::select('order_status')
            ->selectRaw('COUNT(*) as total_orders_count')
            ->groupBy('order_status')
            ->get();

        $chartData = [];
        $chartData[] = ['Status', 'Orders Count'];

        foreach ($ordersByStatus as $row) {
            $chartData[] = [$row->order_status, (int) $row->total_orders_count];
        }


        return view('admin.dashboard.abt_order', [
            'chartData'   => $chartData,
            'totalOrders' => $totalOrders
        ]);
    }

    public function prodviewindex(): View
    {

        $totalViews = Analysis::sum('counter_value');

        $viewsByCat = Analysis::leftJoin('categories as c', 'analyses.cat_id', '=', 'c.cat_id')
            ->select('c.cat_name as cat', DB::raw('SUM(counter_value) as view_count'))
            ->groupBy('analyses.cat_id', 'c.cat_name')
            ->get();

        $catChart = [['Cat', 'View Count']];
        // $catChart = ['Cat', 'View Count'];

        foreach ($viewsByCat as $row) {
            $catChart[] = [$row->cat, (int) $row->view_count];
        }

        $topProducts = Analysis::leftJoin('products', 'analyses.p_id', '=', 'products.p_id')
            ->select('products.p_name as p_name', 'counter_value')
            ->orderByDesc('counter_value')
            ->limit(5)
            ->get();

        $prodChart = [['Product name', 'View Count']];
        foreach ($topProducts as $row) {
            $prodChart[] = [$row->p_name, (int) $row->counter_value];
        }


        return view('admin.dashboard.abt_prod_view', [
            'totalViews' => $totalViews,
            'catChart'   => $catChart,
            'prodChart'  => $prodChart,
        ]);
    }

    public function orderindex(): View
    {
        $totalOrderCount = Order::count();

        $totalDeliveredCount = Order::where('order_status', 'delivered')->count();
        $totalNotdeliveredCount = Order::where('order_status', '!=', 'delivered')->count();

        $chartData = [
            ['Status', 'Total orders'],
            ['Delivered', (int) $totalDeliveredCount],
            ['Not Delivered', (int) $totalNotdeliveredCount],
        ];

        return view('admin.dashboard.order', [
            'chartData' => $chartData,
            'totalOrderCount' => $totalOrderCount,
        ]);


        // return view('admin.dashboard.order', [
        //     'totalOrderCount' => $totalOrderCount,
        //     'totalDeliveredCount' => $totalDeliveredCount,
        //     'totalNotdeliveredCount' => $totalNotdeliveredCount,
        // ]);
    }

    public function prodindex(): View
    {

        $categories = Category::withCount('products')->get();

        $data = [];
        $data[] = ['Category', 'Product Count'];

        foreach ($categories as $category) {
            $data[] = [$category->cat_name, (int)$category->products_count];
        }


        $totalPosts = Product::count();

        return view('admin.dashboard.product', [
            'chartData' => $data,
            'totalPosts' => $totalPosts
        ]);

        //         return view('admin.dashboard.product');
    }

    public function reviewindex(): View
    {

        //$ratings = Rating::withCount('products')->get();

        $ratings = DB::table('ratings')
            ->select('rates as rate_val', DB::raw('count(*) as total_count_rates'))
            ->groupBy('rates')
            ->orderBy('rates', 'desc')
            ->get();

        $chartData = [];
        $chartData[] = ['Rating', 'Count'];

        foreach ($ratings as $row) {
            $chartData[] = [$row->rate_val . ' star', (int) $row->total_count_rates];
        }


        $totalRates = DB::table('ratings')->count();

        return view('admin.dashboard.review', [
            // 'json_data' => json_encode($chartData),
            'chartData' => $chartData,
            'totalRates' => $totalRates
        ]);



        //return view('admin.dashboard.review');
    }

    public function userindex(): View
    {

        $totalRegCount = User::count();

        $totalUserCount = User::where('role', 'user')->count();
        $totalAdminCount = User::where('role', 'admin')->count();

        $chartData = [
            ['Role', 'Total count'],
            ['Users', (int) $totalUserCount],
            ['Admins', (int) $totalAdminCount],
        ];

        return view('admin.dashboard.user', [
            'chartData' => $chartData,
            'totalRegCount' => $totalRegCount,
        ]);

        // return view('admin.dashboard.user', [
        //     'totalRegCount' => $totalRegCount,
        //     'totalUserCount' => $totalUserCount,
        //     'totalAdminCount' => $totalAdminCount,
        // ]);
    }
}
