<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $fillable = [
        'titre',
        'slug',
        'description',
        'type',
        'categorie_id',
        'structure_id',
        'numero',
        'date_signature',
        'date_publication',
        'fichier',
        'format',
        'taille',
        'telechargements',
        'actif',
    ];

    protected $casts = [
        'date_signature' => 'date',
        'date_publication' => 'date',
    ];

    public function categorie()
    {
        return $this->belongsTo(Categorie::class);
    }

    public function structure()
    {
        return $this->belongsTo(Structure::class);
    }

    public function incrementerTelechargements()
    {
        $this->increment('telechargements');
    }

    public function scopeActifs($query)
    {
        return $query->where('actif', true);
    }

    public function getTypeLabelAttribute(): string
    {
        return match($this->type) {
            'loi' => 'Loi',
            'decret' => 'Décret',
            'arrete' => 'Arrêté',
            'circulaire' => 'Circulaire',
            'note' => 'Note de service',
            default => 'Autre',
        };
    }

    public function getTailleFormateeAttribute(): string
    {
        if ($this->taille < 1024) {
            return $this->taille . ' B';
        } elseif ($this->taille < 1024 * 1024) {
            return round($this->taille / 1024, 2) . ' KB';
        } else {
            return round($this->taille / (1024 * 1024), 2) . ' MB';
        }
    }
}
