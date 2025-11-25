<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Storage;

class Promocion extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'avatar',
        'order',
        'active',
    ];

    protected $appends = [
        'avatar_url',
    ];

    public function getAvatarUrlAttribute()
    {
        if ($this->avatar && Storage::disk('avatarspromociones')->exists($this->avatar)) {
            return Storage::disk('avatarspromociones')->url($this->avatar);
        }

        return asset('noimage.png');
    }
}
