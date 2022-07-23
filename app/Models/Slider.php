<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;

    const STATUS_ACTIVE = 'active';
    const STATUS_INACTIVE = 'inactive';
    const FILE_STORE_PATH = 'images/slider';
    protected $appends = ['image_url'];

    public function getImageUrlAttribute(): string
    {
        if ($this->image == null) {
            return asset('adminity/files/assets/images/cross-red-cross.gif');
        }
        return asset('storage/' . self::FILE_STORE_PATH . '/' . $this->attributes['image'] . '.jpg');
    }

    protected $fillable = ['mini_title', 'title', 'description', 'btn_name', 'btn_link', 'btn_color_code', 'text_right_or_left', 'text_font_color', 'image'];
}
