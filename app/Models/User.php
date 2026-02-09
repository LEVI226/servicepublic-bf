<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'nom',
        'prenom',
        'email',
        'telephone',
        'password',
        'type',
        'statut',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function getNomCompletAttribute(): string
    {
        return "{$this->prenom} {$this->nom}";
    }

    public function isCitoyen(): bool
    {
        return $this->type === 'citoyen';
    }

    public function isAgent(): bool
    {
        return $this->type === 'agent';
    }

    public function isAdmin(): bool
    {
        return $this->type === 'admin';
    }

    public function demandes()
    {
        return $this->hasMany(Demande::class);
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    public function notificationsNonLues()
    {
        return $this->hasMany(Notification::class)->where('lu', false);
    }
}
