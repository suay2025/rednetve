<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PedidoTemporal extends Model
{
    use HasFactory;

    protected $fillable = [
        'nropedido',
        'reference',
        'comercio_id',
        'user_id',
        'title',
        'description',
        'coste',
        'costeenvio',
        'currency',
        'metodo',
        'in_delivery',
        'confirmed',
        'shipping', 
        'address',
        'metodoentrega',
        //envio o pickupt
        //centro de distribucion
        'centrodistribucion_id',
        'comercio_id',
        //'address',
        'contactphone',
        'horario',        
        'comercio_id',
        //envio
        //'address',
        'identificationNac',
        'identificationNumber',
        'names',
        'surnames',
        'cellphonecode',
        'cellphone',
        'address',
        'country_id',
        'state_id',
        'city_id',
        'zipcode',
        //delivery
        'deliveryarea_id',
        'deliveryarea',
        'userdelivery_id',
        'pedidoentregado',
        'valoracionpedido',
        'valoraciondelivery',
    ];

    public function comercio()
    {
        return $this->hasOne(Comercio::class, 'id', 'comercio_id');
    }

    public function client()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
