<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Structure extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'sigle',
        'slug',
        'type',
        'description',
        'adresse',
        'telephone',
        'email',
        'site_web',
        'horaires',
        'parent_id',
        'ministre',
        'photo_ministre',
        'ordre',
        'actif',
    ];

    public function parent()
    {
        return $this->belongsTo(Structure::class, 'parent_id');
    }

    public function enfants()
    {
        return $this->hasMany(Structure::class, 'parent_id');
    }

    public function eservices()
    {
        return $this->hasMany(Eservice::class);
    }

    public function documents()
    {
        return $this->hasMany(Document::class);
    }

    public function actualites()
    {
        return $this->hasMany(Actualite::class);
    }

    public function scopeActives($query)
    {
        return $query->where('actif', true);
    }

    public function scopeMinisteres($query)
    {
        return $query->where('type', 'ministere');
    }

    public function scopeInstitutions($query)
    {
        return $query->where('type', 'institution');
    }

    public function scopeRacines($query)
    {
        return $query->whereNull('parent_id');
    }

    public function getTypeLabelAttribute(): string
    {
        return match($this->type) {
            'ministere' => 'Ministère',
            'institution' => 'Institution',
            'direction' => 'Direction',
            'secretariat' => 'Secrétariat',
            default => 'Autre',
        };
    }
}
