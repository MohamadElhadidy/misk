<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke()
    {
        $top_products = DB::table('orders')
            ->join('order_details', 'orders.id', '=', 'order_details.order_id')
            ->join('products', 'order_details.product_id', '=', 'products.id')
            ->select('products.id', 'products.name', DB::raw('SUM(order_details.quantity) as total_sales'))
            ->where('orders.status', 'delivered')  // Add condition for delivered orders
            ->groupBy('products.id', 'products.name')
            ->orderByDesc('total_sales')
            ->take(5)
            ->get();


        // Example: Top 5 customers by revenue
        $top_customers = DB::table('orders')
            ->join('users', 'orders.user_id', '=', 'users.id')
            ->select('users.name', DB::raw('SUM(orders.total_price) as total_spent'))
            ->where('orders.status', 'delivered')
            ->groupBy('users.name')
            ->orderByDesc('total_spent')
            ->take(5)
            ->get();

        return view('admin.dashboard',[
            'delivered_orders' => Order::getDeliveredOrdersCount(),
            'total_revenue' => Order::getTotalRevenue(),
            'customer_count' => Order::getCustomerCount(),
            'total_orders' => Order::count(),
            'total_products' => Product::count(),
            'top_products' => $top_products,
            'top_customers' => $top_customers,
        ]);
    }
}
