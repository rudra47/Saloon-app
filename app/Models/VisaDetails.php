<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisaDetails extends Model
{
    use HasFactory;
    protected $fillable = [
        'userinfo_id',
        'first_name',
        'last_name',
        'email',
        'address',
        'city',
        'state',
        'zip_code',
        'phone_number',
        'card_number',
        'expire_month',
        'expire_year',
        'cvv',
    ];
}
