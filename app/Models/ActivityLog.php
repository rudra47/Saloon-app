<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'activity_log_type',
        'model_id',
        'properties',
    ];

    const PRODUCT_QUANTITY_ASSIGN = 'product_quantity_assign';
    const LABEL_QUANTITY_ASSIGN   = 'label_quantity_assign';
    const ORDER_ASSIGN            = 'order_assign';
    const PRODUCT_REJECT          = 'product_reject';
    const POSTAGE_QUANTITY_ASSIGN = 'postage_quantity_assign';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function shipper()
    {
        return $this->belongsTo(User::class, 'model_id');
    }
    public function getPropertiesAttribute($value) {
        return json_decode($value);
    }

}
