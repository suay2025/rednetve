<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Categories;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = [
        'texto',
        'ruta',
        'origen',
        'menu',
        'posicion',
        'comercio_id',
    ];

    public function subcategories()
    {
        if($this->origen == 'categories')
        {
            $category = Category::where('name', $this->ruta)->first();

            if($category){
                if($category->subcategories()->count()>0){
                    return $category->subcategories();
                }else{
                    return null;
                }
            }           
            else{
                return null;
            }
            
        }
    }
}

