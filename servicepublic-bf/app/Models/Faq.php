<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    use HasFactory;

    protected $table = 'faqs';

    protected $fillable = [
        'question',
        'reponse',
        'categorie_id',
        'ordre',
        'actif',
    ];

    public function categorie()
    {
        return $this->belongsTo(Categorie::class);
    }

    public function scopeActives($query)
    {
        return $query->where('actif', true);
    }

    public function scopeOrdonnees($query)
    {
        return $query->orderBy('ordre');
    }
}
