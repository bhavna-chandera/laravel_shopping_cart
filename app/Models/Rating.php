<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Rating extends Model
{
    //
    use HasFactory;
    protected $primaryKey = 'rate_id';
    protected $fillable = [
        'user_id',
        'p_id',
        'rates',
        'review',
        'order_id',

    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'p_id', 'p_id');
    }
}
