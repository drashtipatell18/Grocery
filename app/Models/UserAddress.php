<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserAddress extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'user_addresses';
    protected $fillable = ['user_id','address'];

     public function user()
    {
        return $this->belongsTo(User::class);
    }
}
