<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Cart;
use App\Models\Product;
use App\Models\User;
use App\Models\Wishlist;
use App\Models\Address;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Enums\AddType;
use Illuminate\Validation\Rules\Enum;

use function Laravel\Prompts\alert;

class AddrController extends Controller
{
    //

    public function edit($add_id)
    {
        $userId = Auth::id();
        $address = Address::where('add_id', $add_id)
            ->where('user_id', $userId)
            ->firstOrFail();

        return view('address.edit', compact('address'));
    }

    public function index(Request $request): View
    {
        return view('address.addr');
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
            ->route('address.addr')
            ->with('message', 'Address added successfully!');
    }

    public function update(Request $request, $add_id)
    {

        $userId = Auth::id();

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

        $address = Address::where('add_id', $add_id)
            ->where('user_id', $userId)
            ->firstOrFail();

        $address->update($validated);

        return redirect()->route('address.addr')->with('success', 'Address updated successfully!');
    }

    public function create()
    {
        return view('address.add_addr');
    }

    public function destroy($add_id)
    {

        $userId = Auth::id();
        $deleted = Address::where('add_id', $add_id)
            ->where('user_id', $userId)
            ->delete();

        if ($deleted) {
            // 2. Redirect back with a flash message instead of calling alert()
            return redirect()->back()->with('success', 'Address deleted successfully.');
        }

        return redirect()->back()->with('error', 'Address not found or unauthorized.');
    }
}
