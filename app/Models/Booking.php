<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $fillable = ['user_id', 'saloon_id', 'saloon_service_id', 'price', 'booking_apply_time', 'booking_confirm_time', 'transaction_no', 'status'];

    public function customer()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function saloon()
    {
        return $this->belongsTo(Saloon::class, 'saloon_id');
    }

    public function saloon_service()
    {
        return $this->belongsTo(SaloonService::class, 'saloon_service_id');
    }
}
