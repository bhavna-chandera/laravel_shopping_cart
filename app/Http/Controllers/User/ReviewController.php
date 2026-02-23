<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ReviewController extends Controller
{
    //
    public function adminindex(Request $request)
    {

        $userId = Auth::id();
        $search = $request->input('search');
        $rates = $request->input('rates');
        $from   = $request->from_date;
        $to     = $request->to_date;

        //-------------------sorting----------------
        $allowedColumns = ['rate_id', 'user_id', 'p_id', 'rates', 'review', 'order_id', 'created_at', 'updated_at'];

        $sortColumn = $request->input('sort_by_column', 'order_id');
        $sortDirection = $request->input('sort_direction', 'asc');

        // Validate sorting inputs
        if (!in_array($sortColumn, $allowedColumns)) {
            $sortColumn = 'order_id';
        }

        $sortDirection = $sortDirection === 'desc' ? 'desc' : 'asc';
        //-----------------------end-------------------------------

        $ratings = DB::table('ratings')->when($search, function ($query, $search) {
            $query->where(function ($q) use ($search) {
                $q->where('review', 'LIKE', "%{$search}%")
                    ->orWhere('order_id', 'LIKE', "%{$search}%");
            });
        })->when($rates, function ($query, $rates) {
            $query->where('rates', $rates);
        })->when($from && $to, function ($query) use ($from, $to) {
            $query->whereBetween('created_at', [
                Carbon::parse($from)->startOfDay(),
                Carbon::parse($to)->endOfDay()
            ]);
        })
            ->orderBy($sortColumn, $sortDirection)
            ->simplePaginate(4)
            ->appends($request->all()) // Optional: add pagination
            ->withQueryString();

        return view('admin.reviews.reviews', compact('ratings'), [
            'currentSortColumn' => $sortColumn,
            'currentSortDirection' => $sortDirection,
        ]);
    }
}
