<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;


class UserController extends Controller
{
    //
    public function index(Request $request)
    {

        $userId = Auth::id();
        $search = $request->input('search');
        $role = $request->input('filterbyrole');
        $from   = $request->from_date;
        $to     = $request->to_date;


        $allowedColumns = ['id', 'name', 'email', 'created_at', 'updated_at'];

        $sortColumn = $request->input('sort_by_column', 'id');
        $sortDirection = $request->input('sort_direction', 'asc');

        // Validate sorting inputs
        if (!in_array($sortColumn, $allowedColumns)) {
            $sortColumn = 'id';
        }

        $sortDirection = $sortDirection === 'desc' ? 'desc' : 'asc';


        // return view('products.index', [
        //     'products' => $products,
        //     'currentSortColumn' => $sortColumn,
        //     'currentSortDirection' => $sortDirection,
        // ])

        $users = DB::table('users')->when($search, function ($query, $search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                    ->orWhere('email', 'LIKE', "%{$search}%");
            });
        })->when($role, function ($query, $role) {
            $query->where('role', $role);
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

        // return view('admin.users.users', compact('users'), [
        //     'users' => $users,
        //     'currentSortColumn' => $sortColumn,
        //     'currentSortDirection' => $sortDirection,
        // ]);
        return view('admin.users.users', [
            'users' => $users,
            'currentSortColumn' => $sortColumn,
            'currentSortDirection' => $sortDirection,
        ]);
    }

    public function destroy($id)
    {

        //$userId = Auth::id();
        $deleted = User::where('id', $id)
            ->delete();

        if ($deleted) {
            // 2. Redirect back with a flash message instead of calling alert()
            return redirect()->back()->with('success', 'User deleted successfully.');
        }

        return redirect()->back()->with('error', 'User not found or unauthorized.');
    }

    public function usercreate()
    {
        return view('admin.users.adduser_form');
    }
    public function admincreate()
    {
        return view('admin.users.addadmin');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', Rules\Password::defaults()],
            'role' => ['sometimes', 'in:user,admin'],
        ]);


        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => $validated['password'],
            'role' => $validated['role'],
        ]);


        return redirect()
            ->route('admin.users.users')
            ->with('message', 'User added successfully!');
    }

    public function adminstore(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required'],
            'role' => ['sometimes', 'in:admin'],
        ]);


        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => $validated['password'],
            'role' => $validated['role'],
        ]);


        return redirect()
            ->route('admin.users.users')
            ->with('message', 'User added successfully!');
    }

    public function adminedit($id)
    {
        // $userId = Auth::id();
        $users = User::where('id', $id)
            ->firstOrFail();

        return view('admin.users.edit', compact('users'));
    }

    public function adminupdate(Request $request, $id)
    {

        $userId = Auth::id();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255'],
            // 'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['sometimes', 'in:user,admin'],
        ]);

        $user = User::where('id', $id)
            ->firstOrFail();

        $user->update($validated);

        return redirect()->route('admin.users.users')->with('success', 'User Editedd successfully!');
    }
}
