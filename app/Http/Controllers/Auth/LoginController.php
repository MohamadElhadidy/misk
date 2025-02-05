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

            $sessionWishlist = Session::get('wishlist') ?? [];

            if (!empty($sessionWishlist)) {

                foreach ($sessionWishlist as $productId) {
                    auth()->user()->wishlist()->firstOrCreate([
                        'product_id' => $productId
                    ]);
                }

                Session::forget('wishlist'); // Clear session wishlist after merging
            }


            $request->session()->regenerate();

            return redirect()->intended();
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }
}
