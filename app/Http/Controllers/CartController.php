<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product; // assuming you have a Product model
use App\Models\ProductSize;

class CartController extends Controller
{
    /**
     * Display the cart.
     */
    public function index(Request $request)
    {
        $carts = session()->get('cart', []);
        $totalQuantity = 0;
        $totalPrice = 0;
        $cart = [];

        foreach ($carts as $key1 => $productSizes) {
            $product =  Product::find($key1);

            foreach ($productSizes as $key2 =>  $item) {

                $size = ProductSize::find($key2);
                $quantity = $item['quantity'];
                $totalQuantity += $item['quantity'];

                $cart[] = [
                    'product' => $product,
                    'size' => $size,
                    'quantity' => $quantity,
                ];

                $totalPrice += $quantity * $size->price;
            }
        }

        return view('cart.index', compact('cart',  'totalPrice', 'totalQuantity'));
    }

    // In CartController.php
    public function add(Request $request, $productId)
    {
        // Retrieve the current cart from the session or initialize a new one
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


        // Update the session with the new cart
        session()->put('cart', $cart);
        // dd($cart);

        // Redirect back to the cart page with a success message
        return back();
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
        $cart = session()->get('cart') ?? [];

        if (isset($cart[$request->productId][$request->sizeId])) {
            unset($cart[$request->productId][$request->sizeId]);
            session()->put('cart', $cart);
            return redirect()->route('cart.index')->with('success', 'Product removed from cart.');
        }

        return redirect()->route('cart.index')->with('error', 'Product not found in cart.');
    }

    /**
     * Remove an item from the cart.
     */
    public function clear()
    {
        session()->put('cart', []);

        return redirect()->route('cart.index')->with('error', 'Product not found in cart.');
    }
}
