<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use HasFactory;

    const PERCENTAGE = 'percentage';
    const MONEY = 'money';
    const ACTIVE = 'active';
    const INACTIVE = 'inactive';
    const FREE = 'free';
    const DISCOUNT = 'discount';
    const FILE_STORE_PATH = 'offer/images';
    protected $appends = ['image_url'];

    protected $fillable = ['buy_quantity', 'message', 'offer', 'offer_type', 'discount_type', 'status', 'image', 'offer_variation'];

    public function products() {
        return $this->belongsToMany(Product::class);
    }

    public function offerable()
    {
        return $this->morphTo();
    }

    public function getImageUrlAttribute() {
        if($this->image != null) {
            return asset('storage/' . self::FILE_STORE_PATH .'/'.$this->attributes['image'].'.jpg');
        }
        return null;
    }

}
