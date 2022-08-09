<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaloonService extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $fillable = ['name', 'saloon_user_id', 'saloon_id', 'price', 'discount_type', 'discount_price', 'status'];
}
