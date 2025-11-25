<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Motor extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'user_id',
        'area_id',
        'comercio_id',
        'manufacturer_id',
        'modelo_id',
    ];
}
