<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Province extends Model
{
    protected $fillable = ['region_id', 'nom', 'slug', 'chef_lieu', 'ordre'];

    public function region(): BelongsTo
    {
        return $this->belongsTo(Region::class);
    }
}
