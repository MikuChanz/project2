<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Association extends Model
{
    public function ids(): HasMany
    {
        return $this->hasMany(IDs::class);
    }
}