<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use App\Models\Product; // assuming you have a Product model
use App\Models\ProductSize;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    /**
     * Display the cart.
     */
    public function index(Request $request)
    {
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

        return view('cart.index', compact('cart', 'totalPrice', 'totalQuantity'));
    }

    // In CartController.php
    public function add(Request $request, $productId)
    {
        try {
            DB::beginTransaction();
            if (auth()->check()) {
                $cart = Cart::where('user_id', $request->user_id)
                    ->where('product_id', $request->product_id)
                    ->where('product_size_id', $request->sizeId)
                    ->first();

                if ($cart) {
                    // For logged-in users: Add to database
                    $cart->update([
                        'quantity' => $cart->quantity + $request->quantity
                    ]);
                } else {
                    Cart::create([
                        'user_id' => auth()->id(),
                        'product_id' => $productId,
                        'product_size_id' => $request->sizeId,
                        "quantity" => $request->quantity,
                    ]);
                }
            } else {

                $cart = session()->get('cart') ?? [];


                // Check if the product with the selected size is already in the cart
                if (isset($cart[$productId][$request->sizeId])) {
                    // Increment the quantity if the same size is already in the cart
                    $cart[$productId][$request->sizeId]['quantity'] += $request->quantity;
                } else {
                    // Add the product with the selected size and price to the cart
                    $cart[$productId][$request->sizeId] = [
                        "quantity" => $request->quantity,
                    ];
                }

                Session::put('cart', $cart);
            }



            DB::commit();

            return back()->with('success', 'Cart  success!');
        } catch (\Throwable $th) {
            DB::rollBack();

            Log::error('Something went wrong!', ['exception' => $th]);

            return back()->with('error', 'Something went wrong! Please try again.');
        }
    }


    /**
     * Update an item’s quantity.
     */
    public function update(Request $request, $id)
    {
        // Validate the request
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] = $request->quantity;
            session()->put('cart', $cart);
            return redirect()->route('cart.index')->with('success', 'Cart updated!');
        }

        return redirect()->route('cart.index')->with('error', 'Product not found in cart.');
    }

    /**
     * Remove an item from the cart.
     */
    public function destroy(Request $request)
    {
        if (auth()->check()) {
            // Remove product from database cart for authenticated users
            $cartItem = Cart::where('user_id', auth()->id())
                ->where('product_id', $request->productId)
                ->where('product_size_id', $request->sizeId)
                ->first();

            if ($cartItem) {
                $cartItem->delete();
                return redirect()->route('cart.index')->with('success', 'Product removed from cart.');
            }

            return redirect()->route('cart.index')->with('error', 'Product not found in cart.');
        } else {
            // Remove product from session cart for guest users
            $cart = session()->get('cart', []);

            if (isset($cart[$request->productId][$request->sizeId])) {
                unset($cart[$request->productId][$request->sizeId]);

                // Remove the product array if it's empty
                if (empty($cart[$request->productId])) {
                    unset($cart[$request->productId]);
                }

                session()->put('cart', $cart);
                return redirect()->route('cart.index')->with('success', 'Product removed from cart.');
            }

            return redirect()->route('cart.index')->with('error', 'Product not found in cart.');
        }
    }


    /**
     * Remove an item from the cart.
     */
    public function clear()
    {
        if (auth()->check()) {
            // Clear cart from the database for authenticated users
            Cart::where('user_id', auth()->id())->delete();
        } else {
            // Clear session cart for guest users
            session()->forget('cart');
        }

        return redirect()->route('cart.index')->with('success', 'Cart cleared successfully.');
    }
}
