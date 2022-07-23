<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class ConditionalMoneyReceiver extends Model
{
    use HasFactory;

    protected $table = 'conditional_money_receivers';
    protected $fillable = ['money_receiver_id', 'days', 'use_limit', 'count', 'status', 'expire_date'];

    const ACTIVE = 'active';
    const DEACTIVE = 'deactivate';

    public function money_receiver()
    {
        return $this->belongsTo(MoneyReceiver::class, 'money_receiver_id');
    }
}
