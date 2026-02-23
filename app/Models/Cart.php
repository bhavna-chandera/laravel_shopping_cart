<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\belongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;



class Cart extends Model
{
    //
    // use HasFactory;
    protected $primaryKey = 'cart_id';
    protected $fillable = [
        'user_id',
        'qty',
        'price',
    ];
    //public $timestamps = false;
    protected $casts = [
        'add_type' => \App\Enums\AddType::class,
    ];


    public function products()
    {
        return $this->belongsToMany(Product::class, 'cart_product', 'cart_id', 'p_id')
            ->withPivot(['qty', 'price_at_purchase'])
            ->withTimestamps();
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'p_id', 'p_id');
    }

    // If you have a User model, define the inverse relationship (belongsTo)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
