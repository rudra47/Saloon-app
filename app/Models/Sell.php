<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class Sell extends Model
{
    use HasFactory;

    const OFFER = "OFFER";
    const COUPON = "COUPON";
    const NONE = "NONE";
    const FREE = "FREE";

    const SHIPPED = 'shipped';
    const NOT_SHIPPED = 'not_shipped';
    const BO = 'bo';
    const RE_ASSIGN = 're_assign';

    protected $fillable = [
        'product_id',
        'order_id',
        'qty',
        'freebio',
        'admin_status',
        'package_product_grp_id',
        'is_product_package',
        'is_free',
        'is_assigned',
        'shipper_id',
        'is_set_shipper',
        'price',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
    public function shipper()
    {
        return $this->belongsTo(User::class, 'shipper_id')->withDefault([
            'name' => 'Not Set'
        ]);
    }
}
