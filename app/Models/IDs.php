<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class IDs extends Model
{
    protected $table = 'i_ds';

    protected $fillable = [
        'name',
        'sinner_id',
        'association_id',
        'description',
        'rarity',
        'season',
        'release_year',
        'image',
        'display',
    ];

    public function sinner(): BelongsTo
    {
        return $this->belongsTo(Sinners::class);
    }

    public function association(): BelongsTo
    {
        return $this->belongsTo(Association::class);
    }

    public function jsonSerialize(): mixed
    {
        return [
            'id' => intval($this->id),
            'name' => $this->name,
            'description' => $this->description,
            'sinner' => $this->sinner->name,
            'association' => $this->association->name,
            'rarity' => $this->rarity,
            'season' => $this->season,
            'release_year' => intval($this->release_year),
            'image' => asset('images/' . $this->image),
        ];
    }
}