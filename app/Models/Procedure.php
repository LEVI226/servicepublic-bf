<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Procedure extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'category_id', 'subcategory_id', 'title', 'slug', 'icon', 'description',
        'documents_required', 'cost', 'conditions', 'delay', 'more_info',
        'source_file', 'is_free', 'is_active', 'is_featured',
        'views_count', 'meta_title', 'meta_description',
    ];

    protected $casts = [
        'is_free' => 'boolean',
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
        'views_count' => 'integer',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function subcategory(): BelongsTo
    {
        return $this->belongsTo(Subcategory::class);
    }

    public function lifeEvents(): BelongsToMany
    {
        return $this->belongsToMany(LifeEvent::class, 'life_event_procedure')
            ->withPivot('order');
    }

    public function documents(): HasMany
    {
        return $this->hasMany(Document::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function getUrlAttribute(): string
    {
        return route('procedures.show', $this->slug);
    }

    public function incrementViews(): void
    {
        $this->increment('views_count');
    }
}
