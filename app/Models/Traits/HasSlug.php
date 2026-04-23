<?php

namespace App\Models\Traits;

use Illuminate\Support\Str;

trait HasSlug
{
    public static function bootHasSlug()
    {
        static::saving(function ($model) {
            if (empty($model->slug)) {
                $source = $model->name ?? $model->title ?? null;
                if ($source) {
                    $model->slug = Str::slug($source);
                }
            }
        });
    }
}
