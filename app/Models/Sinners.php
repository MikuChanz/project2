<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Sinners extends Model
{
    protected $table = 'sinners';

    public function sinners(): HasMany
    {
        return $this->hasMany(IDs::class);
    }
}
