<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Setting;
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
        return view('admin.settings.users');
    }
    public function security()
    {
        return view('admin.settings.security');
    }

}
