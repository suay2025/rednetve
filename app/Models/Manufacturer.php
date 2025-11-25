<?php

namespace App\Models;

use Illuminate\Support\Facades\Storage;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Manufacturer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'avatar',
        'mercado', //primario o secundario //originales o genericos
        'user_id',
        'area_id',
        'comercio_id',
    ];

    protected $appends = [
        'avatar_url',
    ];

    public function getAvatarUrlAttribute()
    {
        if ($this->avatar && Storage::disk('avatarsmanufacturers')->exists($this->avatar)) {
            return Storage::disk('avatarsmanufacturers')->url($this->avatar);
        } 

        return asset('noimage.png');
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
