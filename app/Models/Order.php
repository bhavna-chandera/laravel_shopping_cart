<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;



class Order extends Model
{
    //
    use HasFactory;
    protected $primaryKey = 'order_id';
    protected $fillable = [
        'user_id',
        'add_id',
        'order_status',
        'grand_total',
        'order_date',
        'order_placed_date'
    ];
    public $timestamps = false;
    protected $casts = [
        'order_status' => \App\Enums\OrderStatus::class,
    ];

    // protected function casts(): array
    // {
    //     return [
    //         'order_placed_date' => 'datetime',
    //         
    //     ];
    // }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class, 'order_id');
    }
}
