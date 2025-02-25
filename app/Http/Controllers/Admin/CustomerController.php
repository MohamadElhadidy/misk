<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index() : View
    {
        if (request()->has('q')) {
            $customers = User::whereHas('addresses', function ($query) {
                $query->where('phone_number', 'like', '%' . request('q') . '%'); // Searching by user's name
            })
                ->orWhere('name', 'like', '%' . request('q') . '%') // Searching by order's status
                ->with('orders')->withCount('orders')->orderBy('orders_count', 'desc')
                ->paginate(5);

        } else {
            $customers = User::with('orders')->withCount('orders')->orderBy('orders_count', 'desc')->paginate(5);
        }

        return view('admin.customers.index', compact('customers'));
    }
}
