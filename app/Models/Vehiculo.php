<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehiculo extends Model
{
    use HasFactory;

    protected $fillable = [
        'manufacturer_id',
        'modelo_id',
        'motor_id',
    ];

    public function manufacturer()
    {
        return $this->hasOne(Manufacturer::class, 'id', 'manufacturer_id');
    }

    public function modelo()
    {
        return $this->hasOne(Modelo::class, 'id', 'modelo_id');
    }

    public function motor()
    {
        return $this->hasOne(Motor::class, 'id', 'motor_id');
    }

    public function comercioVehiculo()
    {
        return $this->hasOne(ComercioVehiculo::class, 'vehiculo_id', 'id');
    }
}
