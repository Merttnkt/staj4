<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ContactSettingsController extends Controller
{
    public function index()
    {
        $settings = Setting::all()->pluck('value', 'key')->all();

        return Inertia::render('Admin/Settings/Contact', [
            'settings' => $settings,
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'address' => 'nullable|string',
            'phone' => 'nullable|string',
            'email' => 'nullable|email',
            'map_src' => 'nullable|url',
            'facebook_url' => 'nullable|url',
            'instagram_url' => 'nullable|url',
            'twitter_url' => 'nullable|url',
            'linkedin_url' => 'nullable|url',
        ]);

        foreach ($validatedData as $key => $value) {
            Setting::updateOrCreate(['key' => $key], ['value' => $value]);
        }

        return redirect()->back()->with('success', 'Ayarlar başarıyla kaydedildi.');
    }
}
