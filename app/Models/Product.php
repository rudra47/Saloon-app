<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Staudenmeir\EloquentEagerLimit\HasEagerLimit;

class Product extends Model
{
    use HasFactory;
    use HasEagerLimit;

    const STATUS_ACTIVE = 'active';
    const STATUS_INACTIVE = 'inactive';
    const FILE_STORE_PATH = 'product/images';

    protected $appends = ['image_url'];

    protected $fillable = ['store_id', 'name', 'slug', 'regular_price', 'price', 'image', 'short_description', 'description', 'meta_title', 'meta_description', 'trending_now', 'favorite_today', 'status'];

    public function getTrendingNowAttribute($value)
    {
        return $value ? 'Yes' : 'No';
    }

    public function getFavoriteTodayAttribute($value)
    {
        return $value ? 'Yes' : 'No';
    }

    public function categories() {
        return $this->belongsToMany(Category::class);
    }

    public function tags() {
        return $this->belongsToMany(Tag::class);
    }

    public function store() {
        return $this->belongsTo(Store::class);
    }

    public function getImageUrlAttribute()
    {
        if($this->image == null) {
            return asset('adminity/files/assets/images/cross-red-cross.gif');
        }
        return asset('storage/' . self::FILE_STORE_PATH .'/'.$this->attributes['image'].'.jpg');
    }

    public function offers()
    {
        return $this->morphMany(Offer::class, 'offerable');
    }
}
