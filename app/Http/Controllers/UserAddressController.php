<?php


namespace App\Http\Controllers;

use App\Models\UserAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserAddressController extends Controller
{
    // Display all addresses for the authenticated user
    public function index()
    {
        $addresses = Auth::user()->addresses; // Get addresses for the authenticated user
        return view('user.addresses.index', compact('addresses'));
    }

    // Show form to create a new address
    public function create()
    {
        return view('user.addresses.create');
    }

    // Store a new address for the authenticated user
    public function store(Request $request)
    {
        $request->validate([
            'address_line_1' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'postal_code' => 'required|string|max:20',
            'country' => 'required|string|max:255',
            'phone_number' => 'nullable|string|max:20',
            'is_default' => 'nullable|boolean',
        ]);

        // Create a new address and associate it with the logged-in user
        $address = Auth::user()->addresses()->create([
            'address_line_1' => $request->address_line_1,
            'address_line_2' => $request->address_line_2,
            'city' => $request->city,
            'state' => $request->state,
            'postal_code' => $request->postal_code,
            'country' => $request->country,
            'phone_number' => $request->phone_number,
            'is_default' => $request->is_default ?? false,  // Default to false if not provided
        ]);

        return redirect()->route('user.addresses.index')->with('success', 'Address added successfully!');
    }

    // Show form to edit an existing address
    public function edit(UserAddress $address)
    {
        return view('user.addresses.edit', compact('address'));
    }

    // Update the specified address
    public function update(Request $request, UserAddress $address)
    {
        $request->validate([
            'address_line_1' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'postal_code' => 'required|string|max:20',
            'country' => 'required|string|max:255',
            'phone_number' => 'nullable|string|max:20',
            'is_default' => 'nullable|boolean',
        ]);

        // Update the existing address
        $address->update([
            'address_line_1' => $request->address_line_1,
            'address_line_2' => $request->address_line_2,
            'city' => $request->city,
            'state' => $request->state,
            'postal_code' => $request->postal_code,
            'country' => $request->country,
            'phone_number' => $request->phone_number,
            'is_default' => $request->is_default ?? false,
        ]);

        return redirect()->route('user.addresses.index')->with('success', 'Address updated successfully!');
    }

    // Remove the specified address
    public function destroy(UserAddress $address)
    {
        $address->delete();

        return redirect()->route('user.addresses.index')->with('success', 'Address removed successfully!');
    }
}
