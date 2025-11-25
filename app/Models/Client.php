<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'comercio_id',
    ];

    public function telefono()
    {
        $datosbasicos = DatosBasicos::where('user_id', $this->user_id)->first();
        return $datosbasicos->cellphonecode . $datosbasicos->cellphone; 
    }

    public function comercio()
    {
        return $this->hasOne(Comercio::class, 'id', 'comercio_id');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function datosbasicos()
    {
        return $this->hasOne(DatosBasicos::class, 'user_id', 'user_id');
    }
}
