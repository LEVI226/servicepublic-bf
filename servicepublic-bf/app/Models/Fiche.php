<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fiche extends Model
{
    use HasFactory;

    protected $fillable = [
        'titre',
        'slug',
        'description',
        'contenu',
        'categorie_id',
        'icone',
        'duree_traitement',
        'cout',
        'documents_requis',
        'etapes',
        'contact',
        'lieu',
        'vues',
        'actif',
    ];

    protected $casts = [
        'documents_requis' => 'array',
        'etapes' => 'array',
        'cout' => 'decimal:2',
    ];

    public function categorie()
    {
        return $this->belongsTo(Categorie::class);
    }

    public function incrementerVues()
    {
        $this->increment('vues');
    }

    public function scopeActives($query)
    {
        return $query->where('actif', true);
    }

    public function scopePopulaires($query, $limit = 5)
    {
        return $query->orderBy('vues', 'desc')->limit($limit);
    }
}
