<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Analysis extends Model
{
    //
    use HasFactory;
    protected $primaryKey = 'analy_id';
    protected $fillable = [
        'p_id',
        'cat_id',
        'counter_value',
        'visited_at'
    ];
    public $timestamps = false;
}
