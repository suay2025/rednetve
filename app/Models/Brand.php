<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class brand extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'user_id',
        'area_id',
        'comercio_id',
    ];

    public function product()
    {
        return $this->hasOne(Product::class);
    } 

    public function isActive()
    {
        return 1;
    }
}
