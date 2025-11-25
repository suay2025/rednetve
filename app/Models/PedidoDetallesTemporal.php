<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PedidoDetallesTemporal extends Model
{
    use HasFactory;

    protected $fillable = [
        'pedido_id',
        'nropedido',
        'comercio_id',
        'user_id',
        'name',
        'product_id',
        'price1',
        'quantity',
        'image',
    ];
}
