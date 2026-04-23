<?php

namespace App\Models\Traits;

trait HasOrderedScope
{
    public function scopeOrdered($query)
    {
        return $query->orderBy('order');
    }
}
