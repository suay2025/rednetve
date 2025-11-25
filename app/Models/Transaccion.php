<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaccion extends Model
{
    use HasFactory;

    const STATUS_CONFIRMED = 'confirmed';

    const STATUS_NOTCONFIRMED = 'notconfirmed';

    protected $fillable = [
        'user_id',
        'comercio_id',
        'cliente_id',
        'paymentId',
        'codigoFactura',
        'nropedido',
        'metodo',
        'currency',
        'banco',
        'codigo',
        'codigoBO',
        'reference',
        'title',
        'description',
        'email',
        'emailO',
        'identificationNac',
        'identificationNumber',
        'cellphonecode',
        'cellphone',
        'rifLetter',
        'rifNumber',
        'fechaPago',
        'fecha',
        'amount',
        'status',
    ];

}
