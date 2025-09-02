<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AboutPageController extends Controller
{
    public function index()
    {
        $keys = [
            'about_intro_title',
            'about_intro_paragraph',
            'about_mission_paragraph',
            'about_vision_paragraph',
        ];

        $settings = Setting::whereIn('key', $keys)->pluck('value', 'key');

        return Inertia::render('Admin/About/Edit', [
            'settings' => $settings
        ]);
    }

    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'about_intro_title' => 'required|string|min:10',
            'about_intro_paragraph' => 'required|string|min:10',
            'about_mission_paragraph' => 'required|string|min:10',
            'about_vision_paragraph' => 'required|string|min:10',
        ]);

        foreach ($validatedData as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        return back()->with('success', 'Hakkımızda sayfası bilgileri başarıyla güncellendi.');
    }
}