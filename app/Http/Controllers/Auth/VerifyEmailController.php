<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

class VerifyEmailController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function verifyEmail(EmailVerificationRequest $request)
    {
        $request->fulfill();
        return redirect('/');
    }

    public function sendVerificationEmail()
    {
        request()->user()->sendEmailVerificationNotification();
        return back()->with('message', 'Verification link sent!');
    }
}
