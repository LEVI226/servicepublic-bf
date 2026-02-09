<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'titre',
        'message',
        'type',
        'lien',
        'lu',
        'date_lecture',
    ];

    protected $casts = [
        'lu' => 'boolean',
        'date_lecture' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function marquerCommeLu()
    {
        if (!$this->lu) {
            $this->update([
                'lu' => true,
                'date_lecture' => now(),
            ]);
        }
    }

    public function scopeNonLues($query)
    {
        return $query->where('lu', false);
    }

    public function scopeRecentes($query, $limit = 10)
    {
        return $query->orderBy('created_at', 'desc')->limit($limit);
    }

    public function getTypeIconAttribute(): string
    {
        return match($this->type) {
            'success' => 'check-circle',
            'warning' => 'exclamation-triangle',
            'danger' => 'x-circle',
            'info' => 'info-circle',
            default => 'bell',
        };
    }

    public function getTypeColorAttribute(): string
    {
        return match($this->type) {
            'success' => 'success',
            'warning' => 'warning',
            'danger' => 'danger',
            'info' => 'info',
            default => 'primary',
        };
    }
}
