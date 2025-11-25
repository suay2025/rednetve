<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'avatar',
        'user_id',
        'area_id',
        'comercio_id',
        'itemMenu',
        'posicionMenu',
    ];

    protected $appends = [
        'avatar_url',
    ];

    public function getAvatarUrlAttribute()
    {
        if ($this->avatar && Storage::disk('avatarscategories')->exists($this->avatar)) {
            return Storage::disk('avatarscategories')->url($this->avatar);
        }

        return asset('noimage.png');
    }

    public function subcategories()
    {
        return $this->hasMany(Subcategory::class);
    }

    public function subcategoriesMenu()
    {
        return $this->hasMany(Subcategory::class)->where('itemMenu', 1)->get();
    }
}
