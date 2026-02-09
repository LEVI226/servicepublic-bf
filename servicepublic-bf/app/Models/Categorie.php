<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'slug',
        'description',
        'icone',
        'type',
        'parent_id',
        'ordre',
        'actif',
    ];

    public function parent()
    {
        return $this->belongsTo(Categorie::class, 'parent_id');
    }

    public function enfants()
    {
        return $this->hasMany(Categorie::class, 'parent_id');
    }

    public function fiches()
    {
        return $this->hasMany(Fiche::class);
    }

    public function eservices()
    {
        return $this->hasMany(Eservice::class);
    }

    public function documents()
    {
        return $this->hasMany(Document::class);
    }

    public function faqs()
    {
        return $this->hasMany(Faq::class);
    }

    public function scopeParticuliers($query)
    {
        return $query->where('type', 'particulier')->where('actif', true);
    }

    public function scopeEntreprises($query)
    {
        return $query->where('type', 'entreprise')->where('actif', true);
    }

    public function scopeRacines($query)
    {
        return $query->whereNull('parent_id');
    }
}
