<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockManage extends Model
{
    use HasFactory;

    protected $fillable = [
        'shipper_user_id', 'product_id', 'product_name', 'quantity', 'label_quantity'
    ];
}
