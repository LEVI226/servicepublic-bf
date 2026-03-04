<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    protected $fillable = ['key', 'label', 'value', 'suffix', 'group', 'description', 'order'];

    public static function getStats(): array
    {
        return \Illuminate\Support\Facades\Cache::remember('site.stats', 3600, function () {
            return static::where('group', 'stats')
                ->orderBy('order')
                ->get()
                ->keyBy('key')
                ->toArray();
        });
    }

    public static function clearStatsCache(): void
    {
        \Illuminate\Support\Facades\Cache::forget('site.stats');
        \Illuminate\Support\Facades\Cache::forget('home.stats');
    }
}
