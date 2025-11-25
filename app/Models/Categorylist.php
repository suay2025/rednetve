<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorylist extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'avatar',
        'user_id',
        'area_id',
        'comercio_id',
        'itemMenu',
        'posicionMenu',
        'point_id',
        'nivel',
    ];

    
}
