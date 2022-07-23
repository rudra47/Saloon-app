<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    use HasFactory;

    const ACTIVE = 'active';
    const DEACTIVATED = 'deactivated';
    const PERCENTAGE = 'percentage';
    const DOLLAR = 'dollar';
    const FILE_STORE_PATH = 'images/payment-method';

    const BTC = 1;
    const WU = 3;
    const MG = 4;
    const ABRA = 6;

    protected $appends = ['image_url'];

    protected $fillable = ['name', 'short_name', 'status', 'min', 'max', 'image', 'surcharge', 'discount_type', 'discount_amount'];

    public function getImageUrlAttribute()
    {
        if ($this->image == null) {
            return asset('adminity/files/assets/images/cross-red-cross.gif');
        }
        return asset('storage/' . self::FILE_STORE_PATH . '/' . $this->attributes['image'] . '.jpg');
    }

    public function moneyReceivers()
    {
        return $this->hasMany(MoneyReceiver::class,'payment_method_id','id');
    }
}
