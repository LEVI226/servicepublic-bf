<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class LifeEvent extends Model
{
    protected $fillable = [
        'title', 'slug', 'description', 'icon', 'content',
        'order', 'is_active', 'meta_title', 'meta_description',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'order' => 'integer',
    ];

    public function procedures(): BelongsToMany
    {
        return $this->belongsToMany(Procedure::class, 'life_event_procedure')
            ->withPivot('order')
            ->orderByPivot('order');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order');
    }
}
