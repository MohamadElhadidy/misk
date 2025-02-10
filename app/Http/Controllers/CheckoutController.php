<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\ProductSize;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index(Request $request) {
        if (auth()->check()) {
            $carts = Cart::where('user_id', auth()->id())->get();
        } else {
            $carts = session()->get('cart', []);
        }

        $totalQuantity = 0;
        $totalPrice = 0;
        $cart = [];

        if (auth()->check()) {
            // Process database cart
            foreach ($carts as $item) {
                $product = Product::find($item->product_id);
                $size = ProductSize::find($item->product_size_id);
                $quantity = $item->quantity;


                $cart[] = [
                    'product' => $product,
                    'size' => $size,
                    'quantity' => $quantity,
                ];

                $totalQuantity += $quantity;
                $totalPrice += $quantity * $size->price;
            }
        } else {
            // Process session cart
            foreach ($carts as $key1 => $productSizes) {
                $product = Product::find($key1);

                foreach ($productSizes as $key2 => $item) {
                    $size = ProductSize::find($key2);
                    $quantity = $item['quantity'];
                    $totalQuantity += $quantity;

                    $cart[] = [
                        'product' => $product,
                        'size' => $size,
                        'quantity' => $quantity,
                    ];

                    $totalPrice += $quantity * $size->price;
                }
            }
        }

        return view('checkout.index', compact('cart', 'totalPrice', 'totalQuantity'));
    }
}
