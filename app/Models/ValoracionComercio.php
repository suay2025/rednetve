<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ValoracionComercio extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'comercio_id',
        'ca_valoracion',
        'comment',
    ];
}
