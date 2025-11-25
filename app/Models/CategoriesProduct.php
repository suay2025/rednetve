<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoriesProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'comercio_id',
        'category_id',
        'subcategory_id',
        'primary',
    ];

    public function subcategory()
    {

        if($this->subcategory_id > 0)
        {            
            return Subcategory::where('id', $this->subcategory_id)->first();
        }else{
            return Category::where('id', $this->category_id)->first();
        }
    } 

}
