<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Address extends Model
{
    //
    use HasFactory;
    protected $primaryKey = 'add_id';
    protected $fillable = [
        'user_id',
        'name',
        'mobile',
        'pincode',
        'address',
        'city',
        'state',
        'add_type'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
