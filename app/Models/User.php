<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Filament\Models\Contracts\HasName;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements FilamentUser, HasName
{
    use Notifiable, HasRoles;

    protected $fillable = ['nom', 'prenom', 'email', 'password', 'role', 'telephone', 'is_active'];

    protected $hidden = ['password', 'remember_token'];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_active' => 'boolean',
        ];
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return $this->hasRole(['super_admin', 'editor']) || in_array($this->role, ['super_admin', 'editor']);
    }

    public function isSuperAdmin(): bool
    {
        return $this->hasRole('super_admin') || $this->role === 'super_admin';
    }

    public function isEditor(): bool
    {
        return $this->hasRole(['super_admin', 'editor']) || in_array($this->role, ['super_admin', 'editor']);
    }

    public function getNomCompletAttribute(): string
    {
        return "{$this->prenom} {$this->nom}";
    }

    public function getFilamentName(): string
    {
        return "{$this->prenom} {$this->nom}";
    }
}
