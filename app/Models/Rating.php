<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;

    protected $table = "rating";
    protected $fillable = [
        'product_id',
        'customer_name',
        'star',
        'review'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
