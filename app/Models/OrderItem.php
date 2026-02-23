<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;



class OrderItem extends Model
{
    //
    use HasFactory;
    protected $primaryKey = 'order_item_id';
    protected $fillable = [
        'order_id',
        'user_id',
        'p_id',
        'price',
        'qty'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'p_id', 'p_id');
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    // public function orderItems() // or just "items"
    // {
    //     return $this->hasMany(OrderItem::class);
    // }
}
