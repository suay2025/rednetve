<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComercioVehiculo extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'vehiculo_id',
        'comercio_id',
    ];

    public function getVehiculo()
    {
        
        $vehiculo = Vehiculo::query()->Where('id', $this->vehiculo_id)
                                ->with('manufacturer')->get();

        return $vehiculo;

        return $this->hasOne(Vehiculo::class, 'id', 'vehiculo_id')->with('manufacturer');
    }
}
