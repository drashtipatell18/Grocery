<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubCategory extends Model
{
    use HasFactory , SoftDeletes;
    protected $table = 'sub_categories';
    protected $fillable = ['category_id','subcategory_name','image'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
