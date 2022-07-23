<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderAssign extends Model
{
    use HasFactory;

    const SHIPPED = 'shipped';
    const NOT_SHIPPED = 'not_shipped';

    protected $fillable = [
        'order_id', 'shipper_user_id', 'shipper_status', 'assign_step'
    ];

    public function sellAssign()
    {
        return $this->hasMany(SellAssign::class, 'order_assign_id');
    }

    public function shipper()
    {
        return $this->belongsTo(User::class, 'shipper_user_id');
    }
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

}
