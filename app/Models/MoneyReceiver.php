<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MoneyReceiver extends Model
{
    use HasFactory;
    protected $fillable = ['payment_method_id', 'first_name', 'middle_name', 'initial_name', 'btc_address', 'payment_type', 'country', 'status', 'payment_category','created_at','updated_at','receivers_track'];

    const STATUS_ACTIVE = 'active';
    const STATUS_DEACTIVATED = 'deactivated';

    const PAYMENT_CATEGORY_CHINA = "china";
    const PAYMENT_CATEGORY_HIGH = "high";
    const PAYMENT_CATEGORY_LOW = "low";

    const PAYMENT_METHOD_WU = 'WU';
    const PAYMENT_METHOD_MG = 'MG';

    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class, 'payment_method_id');
    }

    public function scopePaymentCategoryHigh($query)
    {
        return $query->where('payment_category', self::PAYMENT_CATEGORY_HIGH);
    }
    public function scopePyamentCategoryChina($query){
        return $query->where('payment_category', self::PAYMENT_CATEGORY_CHINA);
    }
    public function scopePaymentCategoryLow($query){
        return $query->where('payment_category', self::PAYMENT_CATEGORY_LOW);
    }

    public function conditionalMoneyReceiver()
    {
        return $this->hasOne(ConditionalMoneyReceiver::class);
    }
}
