<?php

namespace App\Models;

use App\Models\Product;
use App\Models\Cart;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
// use Illuminate\Database\Eloquent\Relations\hasOne;
// use Illuminate\Database\Eloquent\Relations\belongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;



class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'role',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /*
        // public function wishlists()
        // {
        //     return $this->belongsToMany(Product::class, 'wishlists', 'user_id', 'p_id')->withTimestamps();
        // }
    
        // public function profile()
        // {
        //     return $this->hasOne(Profile::class);
        // }
    
        // public function wishlists()
        // {
        //     return $this->hasMany(Wishlist::class);
        // }
*/

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    // public function wishlists(): BelongsToMany
    // {
    //     return $this->belongsToMany(Product::class, 'product_wishlist', 'p_id', 'like_id')
    //         ->withPivot('p_id')
    //         ->withTimestamps();
    // }
    public function wishlistProducts()
    {
        return $this->belongsToMany(
            Product::class,
            'wishlists',   // table name
            'user_id',     // FK on wishlists
            'p_id'         // FK to products
        )->withTimestamps();
    }


    // public function cartProducts()
    // {
    //     return $this->belongsToMany(Product::class, 'cart_product')
    //         ->withPivot('qty', 'price');
    // }

    public function cart()
    {
        return $this->hasOne(Cart::class);
    }

    // public function cartProducts()
    // {
    //     return $this->belongsToMany(
    //         Product::class,
    //         'cart_product',
    //         'user_id',
    //         'p_id'
    //     )->withPivot('qty')
    //         ->withTimestamps();
    // }

    public function cartProducts()
    {
        return $this->cart ? $this->cart->products() : collect();
    }

    public function addresses(): HasMany
    {
        return $this->hasMany(Address::class);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    // public function cartItems(): HasMany
    // {
    //     return $this->hasMany(Cart::class, 'p_id', 'cart_id');
    // }

    // public function wishlistItems(): HasMany
    // {

    //     return $this->hasMany(Wishlist::class);
    // }
}
