<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'max:255'],
            'email' => ['required', 'unique:users', 'max:255'],
            'password' => ['required', 'max:255'],
        ]);

        $user = User::create($validatedData);
        event(new Registered($user));

        //redirect to verify email page
        return redirect('/email/verify');
    }
}
