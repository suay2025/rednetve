<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CentroDistribucion extends Model
{
    use HasFactory;

    protected $fillable = [
        'comercio_id',
        'address',
        'contactphone',
        'horario',
    ];

    public function comercio()
    {
        return $this->hasOne(Comercio::class, 'id', 'comercio_id');
    }
}
