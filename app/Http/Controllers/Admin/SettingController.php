<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::all()->keyBy('key');

        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $settings = Setting::all();

        foreach ($settings as $setting) {
            $key = $setting->key;

            if ($setting->type === 'file') {
                if ($request->hasFile($key)) {
                    // পুরনো ফাইল ডিলিট করা (যদি ডিফল্ট ফোল্ডারে না থাকে)
                    if ($setting->value && file_exists(public_path($setting->value)) && ! str_contains($setting->value, 'default')) {
                        @unlink(public_path($setting->value));
                    }

                    $file = $request->file($key);
                    $filename = time().'_'.uniqid().'.'.$file->getClientOriginalExtension();

                    $destinationPath = public_path('uploads/settings');
                    if (! file_exists($destinationPath)) {
                        mkdir($destinationPath, 0755, true);
                    }

                    $file->move($destinationPath, $filename);

                    $setting->update(['value' => 'uploads/settings/'.$filename]);
                }
            } else {
                // Text বা Boolean ফিল্ডের জন্য
                if ($request->has($key)) {
                    $setting->update(['value' => $request->input($key)]);
                }
            }
        }

        return redirect()->route('admin.settings.index')->with('success', 'Settings updated successfully.');
    }
}
