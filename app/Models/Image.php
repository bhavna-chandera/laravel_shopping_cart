<?php



namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


// class Image extends Model
// {
//     //
//     use HasFactory;
//     protected $primaryKey = 'id';
//     protected $fillable = [
//         'p_id',
//         'image_path'
//     ];

//     public function product(): BelongsTo
//     {
//         // Inverse of the one-to-many relationship
//         return $this->belongsTo(Product::class);
//     }
// }


class Image extends Model
{
    use HasFactory;

    // protected $table = 'images_table';

    protected $fillable = [
        'p_id',
        'image_path',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'p_id', 'p_id');
    }
}
