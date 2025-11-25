<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Subcategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'avatar',
        'user_id',
        'comercio_id',
        'category_id',
        'itemMenu',
        'posicionMenu',
        'posicionSubmenu',
    ];

    protected $appends = [
        'avatar_url',
    ];

    public function getAvatarUrlAttribute()
    {
        if ($this->avatar && Storage::disk('avatarssubcategories')->exists($this->avatar)) {
            return Storage::disk('avatarssubcategories')->url($this->avatar);
        } 

        return asset('noimage.png');
    }

    public function user()
    {
        return $this->hasOne(User::class)->withDefault([
            'name' => '',
            'email' => '',
        ]);
    }

    public function comercio()
    {
        return $this->hasOne(Comercio::class)->withDefault([
            'name' => '',
        ]);
    }

    public function categoria()
    {
        return $this->hasOne(Category::class, 'id', 'category_id')->withDefault([
            'name' => '',
        ]);
    }
}
