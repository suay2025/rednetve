<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductsCombo extends Model
{
    use HasFactory;

    protected $fillable = [
        'comercio_id',
        'product_id',
        'productC_id',        
    ];

    public function product()
    {
        return $this->hasOne(Product::class, 'id', 'productC_id');
    }   

}
