<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Demande extends Model
{
    use HasFactory;

    protected $fillable = [
        'reference',
        'user_id',
        'eservice_id',
        'donnees_formulaire',
        'documents_joints',
        'statut',
        'commentaire',
        'traite_par',
        'date_soumission',
        'date_traitement',
        'date_rendez_vous',
        'lieu_rendez_vous',
    ];

    protected $casts = [
        'donnees_formulaire' => 'array',
        'documents_joints' => 'array',
        'date_soumission' => 'datetime',
        'date_traitement' => 'datetime',
        'date_rendez_vous' => 'date',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($demande) {
            if (empty($demande->reference)) {
                $demande->reference = 'DEM-' . strtoupper(uniqid());
            }
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function eservice()
    {
        return $this->belongsTo(Eservice::class, 'eservice_id');
    }

    public function agent()
    {
        return $this->belongsTo(User::class, 'traite_par');
    }

    public function getStatutLabelAttribute(): string
    {
        return match($this->statut) {
            'brouillon' => 'Brouillon',
            'soumise' => 'Soumise',
            'en_cours' => 'En cours de traitement',
            'en_attente' => 'En attente de documents',
            'traitee' => 'Traitée',
            'rejetee' => 'Rejetée',
            'annulee' => 'Annulée',
            default => 'Inconnu',
        };
    }

    public function getStatutColorAttribute(): string
    {
        return match($this->statut) {
            'brouillon' => 'secondary',
            'soumise' => 'info',
            'en_cours' => 'primary',
            'en_attente' => 'warning',
            'traitee' => 'success',
            'rejetee' => 'danger',
            'annulee' => 'dark',
            default => 'secondary',
        };
    }

    public function scopeEnCours($query)
    {
        return $query->whereIn('statut', ['soumise', 'en_cours', 'en_attente']);
    }

    public function scopeTerminees($query)
    {
        return $query->whereIn('statut', ['traitee', 'rejetee', 'annulee']);
    }

    public function peutModifier(): bool
    {
        return in_array($this->statut, ['brouillon', 'soumise']);
    }

    public function peutAnnuler(): bool
    {
        return in_array($this->statut, ['brouillon', 'soumise', 'en_cours']);
    }
}
