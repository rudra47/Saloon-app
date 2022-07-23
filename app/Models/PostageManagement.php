<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostageManagement extends Model
{
    use HasFactory;

    protected $fillable = ['shipper_user_id', 'postage_type', 'qty'];

    const POSTAGE_TYPE = [
        1 => '$6.65',
        2 => 'Forever',
        3 => 'Global'
    ];
}
