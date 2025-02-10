<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        //validate
        $credentials = $request->validate([
            'email' => ['required', 'exists:users', 'max:255', ''],
            'password' => ['required', 'max:255'],
        ]);
        //login

        if (Auth::attempt($credentials, request('remember_me'))) {

            //wishlist
            $sessionWishlist = Session::get('wishlist') ?? [];

            if (!empty($sessionWishlist)) {

                foreach ($sessionWishlist as $productId) {
                    auth()->user()->wishlist()->firstOrCreate([
                        'product_id' => $productId
                    ]);
                }

                Session::forget('wishlist'); // Clear session wishlist after merging
            }

            //Cart
            $sessionCart = Session::get('cart') ?? [];

            if (!empty($sessionCart)) {

                foreach ($sessionCart as $productId => $productSizes) {
                    foreach ($productSizes as $sizeId => $item) {
                        // Check if the item already exists in the user's cart, then update the quantity
                        $existingCartItem = auth()->user()->cart()->where('product_id', $productId)
                            ->where('product_size_id', $sizeId)
                            ->first();

                        if ($existingCartItem) {
                            // If the item exists, update the quantity
                            $existingCartItem->quantity += $item['quantity'];
                            $existingCartItem->save();
                        } else {
                            // If the item doesn't exist, create a new cart entry
                            auth()->user()->cart()->create([
                                'product_id' => $productId,
                                'product_size_id' => $sizeId,
                                'quantity' => $item['quantity'],
                            ]);
                        }
                    }
                }

                Session::forget('cart'); // Clear session cart after merging
            }


            $request->session()->regenerate();

            return redirect()->intended();
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }
}
