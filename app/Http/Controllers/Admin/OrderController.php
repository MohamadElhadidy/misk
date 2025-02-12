<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index() : View
    {
        if (request()->has('q')) {
            $orders = Order::whereHas('user', function ($query) {
                $query->where('name', 'like', '%' . request('q') . '%'); // Searching by user's name
            })
                ->orWhere('status', 'like', '%' . request('q') . '%') // Searching by order's status
                ->orWhere('order_id', 'like', '%' . request('q') . '%') // Searching by order's status
                ->paginate(5);

        } else {
            $orders = Order::paginate(5);
        }

        return view('admin.orders.index', compact('orders'));
    }

    public function updateStatus(Request $request, $id)
    {
        // Find the order by ID
        $order = Order::findOrFail($id);

        // Validate the status input
        $request->validate([
            'status' => 'required|in:pending,processing,shipped,delivered,canceled,refunded,returned',
        ]);

        // Update the order status
        $order->status = $request->status;
        $order->save();

        // Redirect back with a success message
        return back()->with('success', 'Order status updated successfully!');
    }

    public function show(Order $order) : View
    {
        return view('admin.orders.show', compact('order'));
    }


}
