<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index()
    {
        return view('admin.settings.index');
    }

    public function update(Request $request) {
        foreach ($request->except('_token') as $key => $value) {

            if (Helper::isBase64Image($value)) {
                $value = Helper::UploadBase64($value, 'store/logo');
            }

            Setting::set($key, $value);
        }

        return back()->with('success', 'Settings updated successfully!');
    }


    public function shipping()
    {
        return view('admin.settings.shipping');
    }
    public function seo_social_media()
    {
        return view('admin.settings.seo_social_media');
    }
    public function appearance()
    {
        return view('admin.settings.appearance');
    }
    public function users()
    {
        if (request()->has('q')) {
            $users = User::where('name', 'like', '%' . request('q') . '%')->orWhere('email', 'like', '%' . request('q') . '%')->paginate(5);
        } else {
            $users = User::paginate(5);
        }
        return view('admin.settings.users', compact('users'));
    }
    public function promote(User $user)
    {
        $user->promote();
        return back()->with('success', 'User promoted successfully.');
    }

    public function downgrade(User $user)
    {
        $user->downgrade();
        return back()->with('success', 'User downgraded successfully.');
    }

    public function ban(User $user)
    {
        $user->ban();
        return back()->with('success', 'User banned successfully.');
    }

    public function unban(User $user)
    {
        $user->unban();
        return back()->with('success', 'User unbanned successfully.');
    }

    public function security()
    {
        return view('admin.settings.security');
    }

}
