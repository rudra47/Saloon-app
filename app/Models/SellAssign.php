<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SellAssign extends Model
{
    use HasFactory;

    const SHIPPED = 'shipped';
    const NOT_SHIPPED = 'not_shipped';
    const BO = 'bo';

    protected $fillable = [
        'order_id', 'order_assign_id', 'sell_id', 'shipper_user_id', 'product_id', 'qty', 'shipper_status'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
    public function orderAssign()
    {
        return $this->belongsTo(OrderAssign::class, 'order_assign_id');
    }
    public function sell()
    {
        return $this->belongsTo(Sell::class, 'sell_id');
    }
    public function shipper()
    {
        return $this->belongsTo(User::class, 'shipper_user_id');
    }
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
