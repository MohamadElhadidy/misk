<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
   public function show(Order $order)
   {
       if(Auth::user()->role === 'admin'){
           return redirect("/admin/orders/?q={$order->order_id}");
        }

       dd($order);
   }
}
