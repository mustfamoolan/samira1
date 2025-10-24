<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SiteSetting;
use Illuminate\Support\Facades\Storage;

class SiteSettingController extends Controller
{
    public function edit()
    {
        $settings = SiteSetting::getSettings();
        return view('admin.settings.edit', compact('settings'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'site_name' => 'required|string|max:255',
            'site_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $data = $request->only(['site_name']);

        // رفع الشعار إذا تم اختيار ملف جديد
        if ($request->hasFile('site_logo')) {
            // حذف الشعار القديم إذا كان موجوداً
            $oldSettings = SiteSetting::getSettings();
            if ($oldSettings->site_logo && Storage::disk('public')->exists($oldSettings->site_logo)) {
                Storage::disk('public')->delete($oldSettings->site_logo);
            }

            // رفع الشعار الجديد
            $data['site_logo'] = $request->file('site_logo')->store('site', 'public');
        }

        SiteSetting::updateSettings($data);

        return redirect()->route('admin.settings.edit')->with('success', 'تم تحديث إعدادات الموقع بنجاح');
    }
}
