<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    // প্রোফাইল পেজ ভিউ দেখানো
    public function index()
    {
        return view('admin.profile.index');
    }

    // এডিট ফর্ম ভিউ দেখানো
    public function edit()
    {
        return view('admin.profile.edit');
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'avatar' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        // ১. যদি ইউজার ছবি রিমুভ করতে চায়
        if ($request->has('remove_avatar')) {
            if ($user->avatar && ! str_contains($user->avatar, 'ui-avatars.com')) {
                $oldPath = public_path($user->avatar);
                if (file_exists($oldPath)) {
                    @unlink($oldPath);
                }
            }
            $data['avatar'] = 'https://ui-avatars.com/api/?name='.urlencode($request->name).'&background=random';
        }
        // ২. যদি নতুন কোনো ছবি আপলোড করা হয়
        elseif ($request->hasFile('avatar')) {
            // পুরনো কাস্টম ছবি থাকলে ডিলিট করা
            if ($user->avatar && ! str_contains($user->avatar, 'ui-avatars.com')) {
                $oldPath = public_path($user->avatar);
                if (file_exists($oldPath)) {
                    @unlink($oldPath);
                }
            }

            // ফাইল আপলোড লজিক
            $file = $request->file('avatar');
            $filename = time().'_'.uniqid().'.'.$file->getClientOriginalExtension();

            $destinationPath = public_path('uploads/avatars');
            if (! file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            $file->move($destinationPath, $filename);

            // ডাটাবেজে সেভ করার জন্য পাথ অ্যারেতে যুক্ত করা
            $data['avatar'] = 'uploads/avatars/'.$filename;
        }

        // ৩. ডাটাবেজ আপডেট নিশ্চিত করা
        $user->update($data);

        // dd($data, $user->getChanges());

        return redirect()->route('admin.profile.index')->with('success', 'Profile and avatar updated successfully.');
    }

    public function changePassowrd()
    {
        return view('admin.profile.change-password');
    }

    // পাসওয়ার্ড আপডেট
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        auth()->user()->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('admin.profile.index')->with('success', 'Password updated successfully.');
    }
}
