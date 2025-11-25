<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notificacion extends Model
{
    use HasFactory;

    protected $fillable = [
        'medio',
        'title',
        'content',
        'adjunto',
        'file',
        'nrosends',
        'comercio_id',
    ];

    protected $appends = [
        'file_url',
    ];

    public function getFileUrlAttribute()
    {
        if ($this->avatar && Storage::disk('filesnotificaciones')->exists($this->avatar)) {
            return Storage::disk('filesnotificaciones')->url($this->avatar);
        }

        return asset('noimage.png');
    }

    public function nroclientes()
    {
        return  Client::where('comercio_id', $this->comercio_id)->count();
    }

    public function comercio()
    {
        return $this->hasOne(Comercio::class, 'id', 'comercio_id');
    }

    public function client()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
