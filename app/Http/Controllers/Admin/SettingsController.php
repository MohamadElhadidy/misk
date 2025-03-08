<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index()
    {
        $settings = [
            'store_name' => Setting::get('store_name', 'Default Store Name'),
            'store_email' => Setting::get('store_email', 'Default Store Email'),
            'store_phone' => Setting::get('store_phone', 'Default Store Phone'),
            'store_address' => Setting::get('store_address', 'Default Store Address'),
        ];

        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request) {
        foreach ($request->except('_token') as $key => $value) {
            Setting::set($key, $value);
        }

        return back()->with('success', 'Settings updated successfully!');
    }


    public function localization()
    {
        $settings = [
            'store_name' => Setting::get('store_name', 'Default Store Name'),
            'store_email' => Setting::get('store_email', 'Default Store Email'),
            'store_phone' => Setting::get('store_phone', 'Default Store Phone'),
            'store_address' => Setting::get('store_address', 'Default Store Address'),
        ];

        return view('admin.settings.localization', compact('settings'));
    }

}
