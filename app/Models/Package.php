<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'message', 'slug', 'price', 'image', 'regular_price'];
    const FILE_STORE_PATH = 'images/package';
    protected $appends = ['image_url'];

    public function getImageUrlAttribute()
    {
        if($this->image == null) {
            return asset('adminity/files/assets/images/cross-red-cross.gif');
        }
        return asset('storage/' . self::FILE_STORE_PATH .'/'.$this->attributes['image'].'.jpg');
    }

    public function products()
    {
        return $this->hasMany(PackageProduct::class);
    }

    public function offers()
    {
        return $this->morphMany(Offer::class, 'offerable');
    }
}
