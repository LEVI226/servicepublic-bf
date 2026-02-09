<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Eservice extends Model
{
    use HasFactory;

    protected $table = 'eservices';

    protected $fillable = [
        'nom',
        'slug',
        'description',
        'contenu',
        'categorie_id',
        'structure_id',
        'icone',
        'url_externe',
        'en_ligne',
        'duree_traitement',
        'cout',
        'champs_formulaire',
        'documents_requis',
        'vues',
        'actif',
    ];

    protected $casts = [
        'champs_formulaire' => 'array',
        'documents_requis' => 'array',
        'cout' => 'decimal:2',
        'en_ligne' => 'boolean',
    ];

    public function categorie()
    {
        return $this->belongsTo(Categorie::class);
    }

    public function structure()
    {
        return $this->belongsTo(Structure::class);
    }

    public function demandes()
    {
        return $this->hasMany(Demande::class, 'eservice_id');
    }

    public function incrementerVues()
    {
        $this->increment('vues');
    }

    public function scopeActifs($query)
    {
        return $query->where('actif', true);
    }

    public function scopeEnLigne($query)
    {
        return $query->where('en_ligne', true)->where('actif', true);
    }

    public function scopePopulaires($query, $limit = 5)
    {
        return $query->orderBy('vues', 'desc')->limit($limit);
    }

    public function getEstExterneAttribute(): bool
    {
        return !empty($this->url_externe);
    }
}
