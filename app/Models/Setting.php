<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Setting extends Model
{
    protected $guarded = [];

    /**
     * The "booted" method of the model.
     */
    protected static function booted(): void
    {
        static::saved(function ($setting) {
            Cache::forget('app_settings');
        });
        static::deleted(function ($setting) {
            Cache::forget('app_settings');
        });
    }
}
