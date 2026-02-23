<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Relations\HasMany;


class Category extends Model
{
    //
    use HasFactory;
    protected $primaryKey = 'cat_id';
    protected $fillable = [
        'cat_name'
    ];

    // In Category model

    public function products()
    {
        return $this->hasMany(Product::class, 'cat_id', 'cat_id');
    }
}
