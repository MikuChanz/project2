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
        'price',
        'year',
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
}