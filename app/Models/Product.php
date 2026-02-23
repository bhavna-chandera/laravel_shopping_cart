<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


// use Illuminate\Database\Eloquent\Relations\HasOne;


// class Product extends Model
// {
//     //
//     use HasFactory;

//     protected $primaryKey = 'p_id'; // Specify custom primary key name

//     protected $fillable = [
//         'p_name',
//         'p_desc',
//         'p_price',
//         'p_offerprice',
//         'p_stock'
//     ];

//     // Cast p_imgs to array for easier handling
//     // protected $casts = [
//     //     'p_imgs' => 'array',
//     // ];

//     // public function details(): HasOne
//     // {
//     //     return $this->hasOne(ProductDetails::class);
//     // }

//     // In Post model (Inverse)
//     public function category()
//     {
//         return $this->belongsTo(Category::class);
//     }

//     public function images(): HasMany
//     {
//         return $this->hasMany(Image::class);
//     }
// }


class Product extends Model
{
    use HasFactory;

    protected $primaryKey = 'p_id';

    protected $fillable = [
        'p_name',
        'p_desc',
        'p_price',
        'p_offerprice',
        'p_stock',
        'cat_id',
    ];


    public function images(): HasMany
    {
        return $this->hasMany(Image::class, 'p_id', 'p_id');
    }

    public function details(): HasOne
    {
        return $this->hasOne(ProductDetails::class, 'p_id', 'p_id');
    }


    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'cat_id', 'cat_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // public function wishlists(): BelongsToMany
    // {
    //     return $this->belongsToMany(User::class, 'wishlists', 'p_id', 'user_id')->withTimestamps();
    // }

    // public function wishlists(): BelongsToMany
    // {
    //     return $this->belongsToMany(
    //         Wishlist::class,
    //         'product_wishlist',
    //         'p_id',
    //         'like_id',
    //         'p_id',
    //         'like_id'
    //     )->withTimestamps();
    // }

    public function carts()
    {
        return $this->belongsToMany(Cart::class, 'cart_product', 'p_id', 'cart_id')
            ->withPivot(['qty', 'price_at_purchase'])
            ->withTimestamps();
    }


    // public function wishlists()
    // {
    //     return $this->belongsToMany(User::class, 'wishlist_product');
    // }

    public function wishlistedBy()
    {
        return $this->belongsToMany(
            User::class,
            'wishlists',
            'p_id',
            'user_id'
        );
    }
    public function ratings(): HasMany
    {
        return $this->hasMany(Rating::class, 'p_id', 'p_id');
    }
}
