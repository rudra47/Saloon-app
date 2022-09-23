<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Saloon extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $fillable = ['user_id', 'name', 'email', 'phone', 'address', 'latitude', 'longitude', 'status'];

    public function tags() {
        return $this->belongsToMany(Tag::class);
    }
    public function services() {
        return $this->hasMany(SaloonService::class);
    }
}

