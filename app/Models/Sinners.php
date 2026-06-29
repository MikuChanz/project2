<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Attributes\Fillable;
#[Fillable(['name','sinners_id', 'description', 'rarity', 'release_year',])]
class Sinners extends Model
{
    protected $table = 'sinners';

    public function sinners(): HasMany
    {
        return $this->hasMany(IDs::class);
    }
}
