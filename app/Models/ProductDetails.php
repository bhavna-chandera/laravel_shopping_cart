<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;


class ProductDetails extends Model
{
    //
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    // public function ratings(): HasOne
    // {
    //     return $this->hasOne(Rating::class, 'p_id', 'p_id');
    // }
}
