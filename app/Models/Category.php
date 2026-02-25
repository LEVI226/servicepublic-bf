<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    protected $fillable = [
        'name', 'slug', 'description', 'icon', 'color',
        'order', 'is_active', 'meta_title', 'meta_description',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'order' => 'integer',
    ];

    public function subcategories(): HasMany
    {
        return $this->hasMany(Subcategory::class)->orderBy('order');
    }

    public function procedures(): HasMany
    {
        return $this->hasMany(Procedure::class);
    }

    public function eservices(): HasMany
    {
        return $this->hasMany(EService::class);
    }

    public function articles(): HasMany
    {
        return $this->hasMany(Article::class);
    }

    public function faqs(): HasMany
    {
        return $this->hasMany(Faq::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order');
    }

    public function getUrlAttribute(): string
    {
        return route('categories.show', $this->slug);
    }
}
