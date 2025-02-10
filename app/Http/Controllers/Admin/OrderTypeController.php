<?php

namespace App\Http\Controllers\admin;

use App\Models\OrderType;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderTypeController extends Controller
{
    public function index()
    {
        $orderTypes = OrderType::all();

        // You can check for user permissions here
        $canEdit = auth()->user()->can('edit posts');
        $canDelete = auth()->user()->can('delete posts');

        // Return the data in JSON format
        return response()->json([
            'orderTypes' => $orderTypes,
            'canEdit' => $canEdit,
            'canDelete' => $canDelete,
        ]);
    }

    public function create()
    {
        return view('backoffice.referrals.create-referral-types');  // Return the view for the create provider form

    }

    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
        ]);

        // Create a new order type
        OrderType::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        // Redirect with success message
        return redirect()->route('orderTypes.store')->with('success', 'Order Type created successfully!');
    }


    // public function edit(OrderType $orderType)
    // {
    //     return view('order_types.edit', compact('orderType'));
    // }

    // public function update(Request $request, OrderType $orderType)
    // {
    //     $request->validate([
    //         'name' => 'required|string|max:255',
    //         'description' => 'nullable|string',
    //     ]);

    //     $orderType->update($request->all());

    //     return redirect()->route('order_types.index');
    // }

    public function destroy($id)
    {
        // Find the order type by its ID
        $orderType = OrderType::findOrFail($id);

        // Delete the order type
        $orderType->delete();

        // Redirect with success message
        return redirect()->route('orderTypes.store')->with('success', 'Order Type deleted successfully!');
    }

    public function edit($id)
    {
        // Find the order type by its ID
        $orderType = OrderType::findOrFail($id);

        // Return the edit view with the order type data
        return view('backoffice.referrals.edit-referral-type', compact('orderType'));
    }

    public function update(Request $request, $id)
    {
        // Validate the incoming data
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
        ]);

        // Find the order type by its ID
        $orderType = OrderType::findOrFail($id);

        // Update the order type with the new data
        $orderType->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        // Redirect back to the list with a success message
        return redirect()->route('orderTypes.store')->with('success', 'Order Type updated successfully!');
    }



}
