<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product; // assuming you have a Product model

class CartController extends Controller
{
    /**
     * Display the cart.
     */
    public function index(Request $request)
    {
        $cart = session()->get('cart', []);
        $totalQuantity = 0;
        $totalPrice = 0;

        foreach ($cart as $productSizes) {
            foreach ($productSizes as $item) {
                $totalQuantity += $item['quantity'];
                $totalPrice += $item['quantity'] * $item['price'];
            }
        }

        return view('cart.index', compact('cart', 'totalQuantity', 'totalPrice'));
    }

    // In CartController.php
    public function add(Request $request, $productId)
    {
        // Retrieve the product from the database
        $product = Product::findOrFail($productId);

        // Retrieve the selected size
        $size = $product->sizes()->findOrFail($request->sizeId);

        // Retrieve the current cart from the session or initialize a new one
        $cart = session()->get('cart', []);


        // Check if the product with the selected size is already in the cart
        if (isset($cart[$productId][$request->sizeId])) {
            // Increment the quantity if the same size is already in the cart
            $cart[$productId][$request->sizeId]['quantity'] += $request->quantity;
        } else {
            // Add the product with the selected size and price to the cart
            $cart[$productId][$request->sizeId] = [
                "id" => $product->id,
                "name" => $product->name,
                "size" => $size->name,
                "quantity" => $request->quantity,
                "price" => $size->price, // Assuming the size has a price field
                "image" => $product->image, // if you want to store an image URL
            ];
        }

        // Update the session with the new cart
        session()->put('cart', $cart);


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
    public function remove(Request $request, $id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
            return redirect()->route('cart.index')->with('success', 'Product removed from cart.');
        }

        return redirect()->route('cart.index')->with('error', 'Product not found in cart.');
    }
}
