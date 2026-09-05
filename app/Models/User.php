<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    protected $guarded = [];

    protected static function booted()
    {
        parent::booted();

        // নতুন ইউজার তৈরির সময় ডিফল্ট অ্যাভাটার সেট করার জন্য
        static::creating(function ($user) {
            if (empty($user->avatar)) {
                $user->avatar = 'https://ui-avatars.com/api/?name='.urlencode($user->name).'&background=6366f1&color=fff';
            }
        });

        // প্রোফাইল আপডেট বা সেভ করার সময় যদি অ্যাভাটার ফিল্ড ফাকা থাকে বা ভুল হয়
        static::updating(function ($user) {
            // যদি ডাটাবেজে নতুন কোনো কাস্টম পাথ বা ui-avatars সেট করা হয়, এটি তা নিশ্চিত করবে
            if (empty($user->avatar)) {
                $user->avatar = 'https://ui-avatars.com/api/?name='.urlencode($user->name).'&background=6366f1&color=fff';
            }
        });
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
