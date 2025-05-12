<?php

namespace App\Http\Controllers;

use App\Models\UserAddress;
use Illuminate\Http\Request;

class UserAddressController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'full_name' => 'required|string|max:255',
            'address1' => 'required|string|max:255',
            'address2' => 'nullable|string|max:255',
            'area' => 'required|string|max:255',
            'pincode' => 'required|digits:6',
            'landmark' => 'nullable|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'mobile_no' => 'required|string|max:15',
        ]);

        // Create a new address
        $address = new UserAddress($validatedData);
        $address->user_id = auth()->id(); // Assuming you have user authentication
        $address->save();

        // return redirect()->back()->with('success', 'Address added successfully!');
        return redirect('/order')->with('success', 'Address saved and order placed successfully.');
    }

    public function remove($id)
    {
        // Find the address by ID
        $address = UserAddress::findOrFail($id);

        // Check if the address belongs to the authenticated user
        if ($address->user_id !== auth()->id()) {
            return redirect()->route('checkout')->with('error', 'You are not authorized to remove this address.');
        }

        // Delete the address
        $address->delete();

        // Redirect back to the checkout page with a success message
        return redirect()->route('checkout')->with('success', 'Address removed successfully.');
    }
}
