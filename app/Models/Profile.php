<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    //
    // In Profile model (Inverse)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
