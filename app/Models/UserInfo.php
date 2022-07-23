<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserInfo extends Model
{
    use HasFactory;

    const STATUS_ACTIVE = 'active';
    const STATUS_INACTIVE = 'inactive';

    protected $fillable = [
        'user_id',
        'order_id',
        'first_name',
        'last_name',
        'company',
        'address',
        'apt',
        'city',
        'state',
        'zip_code',
        'email',
        'board_id',
        'additional_information',
        'status',

    ];

     // mutatiors
     public function setUserIdAttribute($authUserInfoId)
     {
         $this->attributes['user_id'] = !is_null($authUserInfoId) ? $authUserInfoId : null;
     }
     public function setCompanyAttribute($company)
     {
         $this->attributes['company'] = !is_null($company) ? $company : null;
     }
     public function setAptAttribute($apt)
     {
         $this->attributes['apt'] = !is_null($apt) ? $apt : null;
     }
     public function setAdditionalInformationAttribute($info)
     {

         $this->attributes['additional_information'] = !is_null($info) ? $info : null;
     }

}
