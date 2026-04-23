<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Organisme extends Model
{
    protected $fillable = [
        'name', 'slug', 'acronym', 'description', 'address',
        'city', 'region', 'phone', 'email', 'website',
        'hours', 'latitude', 'longitude', 'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function getFullNameAttribute(): string
    {
        return $this->acronym ? "{$this->name} ({$this->acronym})" : $this->name;
    }
}
