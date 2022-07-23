<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'visa_string',
        'status',
        'user_id',
        'user_info_id',
        'coupon_id',
        'sub_total',
        'grand_total',
        'store_id',
        'money_receiver_id',
        'tracking_no',
        'email_last_sent',
        'bitcoin_track',
        'payment_method_id',
        'order_no',
        'package_id',
        'is_guest',
        'customer_status',
        'admin_status',
        'cart_items',
        'payment_method_name',
    ];

    const STATUS = [
        '0' => 'Processing',
        '1' => 'Sent payment instruction',
        '2' => '2nd Time Sent Payment Instruction',
        '3' => 'Preparing amex instruction',
        '4' => 'Received payment details',
        '5' => 'Collect Payment',
        '6' => 'Delayed BO',
        '7' => 'Shipped',
        '8' => 'Complete',
    ];
    const ORDER_TYPE_NEW = 'new';
    const ORDER_TYPE_PROCESSING = 'processing';

    const SHIPPED = 'shipped';
    const NOT_SHIPPED = 'not_shipped';
    const BO = 'bo';
    const RE_ASSIGN = 're_assign';

    // mutatiors
    public function setUserIdAttribute($value)
    {
        $this->attributes['user_id'] = !is_null($value) ? $value : null;
    }

    public function setOrderNoAttribute($value)
    {
        $this->attributes['order_no'] = strtoupper($value);
    }

    public function setIsGuestAttribute($authUserInfoId)
    {
        $this->attributes['is_guest'] = !is_null($authUserInfoId) ? null : 'guest';
    }

    public function setPackageIdAttribute($packageIdCollect)
    {
        $this->attributes['package_id'] = count($packageIdCollect) > 0 ? json_encode($packageIdCollect) : null;
    }

    public function setPaymentMethodNameAttribute($name)
    {
        $this->attributes['payment_method_name'] = strtoupper($name);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function userInfo()
    {
        return $this->belongsTo(UserInfo::class, 'user_info_id');
    }

    public function shipper()
    {
        return $this->belongsTo(User::class, 'shipper_id')->withDefault([
            'name' => 'Not set yet'
        ]);
    }

    public function sell()
    {
        return $this->hasMany(Sell::class, 'order_id');
    }

    public function coupon()
    {
        return $this->belongsTo(Coupon::class)->withDefault([
            'code' => 'not used'
        ]);
    }

    public function moneyReceiver()
    {
        return $this->belongsTo(MoneyReceiver::class, 'money_receiver_id', 'id')->withDefault([
            'first_name' => 'Not',
            'middle_name' => 'Set',
            'initial_name' => 'Yet'
        ]);
    }

    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class, 'payment_method_id', 'id')->withDefault([
            'code' => 'NaN'
        ]);
    }

    public function store() {
        return $this->belongsTo(Store::class, 'store_id');
    }

}
