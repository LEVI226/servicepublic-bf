<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Actualite extends Model
{
    use HasFactory;

    protected $fillable = [
        'titre',
        'slug',
        'resume',
        'contenu',
        'image',
        'structure_id',
        'type',
        'a_la_une',
        'date_publication',
        'vues',
        'actif',
    ];

    protected $casts = [
        'date_publication' => 'datetime',
        'a_la_une' => 'boolean',
    ];

    public function structure()
    {
        return $this->belongsTo(Structure::class);
    }

    public function incrementerVues()
    {
        $this->increment('vues');
    }

    public function scopeActives($query)
    {
        return $query->where('actif', true);
    }

    public function scopePubliees($query)
    {
        return $query->whereNotNull('date_publication')
                     ->where('date_publication', '<=', now());
    }

    public function scopeALaUne($query)
    {
        return $query->where('a_la_une', true);
    }

    public function scopeRecentes($query, $limit = 5)
    {
        return $query->orderBy('date_publication', 'desc')->limit($limit);
    }

    public function getTypeLabelAttribute(): string
    {
        return match($this->type) {
            'communique' => 'Communiqué',
            'avis' => 'Avis',
            default => 'Actualité',
        };
    }
}
