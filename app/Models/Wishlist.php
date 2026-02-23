<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;



class Wishlist extends Model
{
    //
    use HasFactory;
    protected $primaryKey = 'like_id';

    protected $fillable = [
        'user_id',
        'p_id',
        'liked_at'
    ];

    // public function product()
    // {
    //     return $this->belongsTo(Product::class, 'p_id');
    // }

    // public function product()
    // {
    //     return $this->hasMany(Product::class);
    // }
    public function products()
    {
        return $this->belongsToMany(
            Product::class,
            'product_wishlist',
            'like_id', // FK to wishlists.like_id
            'p_id',    // FK to products.p_id
            'like_id', // local key on wishlists
            'p_id'     // local key on products
        )->withTimestamps();
    }

    // {
    //     return $this->belongsToMany(Product::class, 'product_wishlist', 'p_id', 'like_id')->withPivot('created_at')->withTimestamps();;
    // }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
