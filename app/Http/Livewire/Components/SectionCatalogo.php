<?php

namespace App\Http\Livewire\Components;

use Livewire\Component;

use App\Models\Product;
use App\Models\Category;

class SectionCatalogo extends Component
{
    public $comercio_id;

    public $parametro;

    public function mount($comercioId = 1, $parametro )
    {

        $this->comercio_id = $comercioId;

        $this->parametro = $parametro;

    }

    public function render()
    {

        $catalogos = Category::where('comercio_id', $this->comercio_id)
                        ->where(function($q){
                            $q->where('name', 'like', '%'.$this->parametro.'%')
                                ->orWhere('description', 'like', '%'.$this->parametro.'%');
                        })
                        ->whereHas('subcategories', function($q){
                            $q->where('name', 'like', '%'.$this->parametro.'%')
                                ->orWhere('description', 'like', '%'.$this->parametro.'%');
                        })
                        ->get();
        // dd($catalogos);
        return view('livewire.components.section-catalogo',[
            'catalogos' => $catalogos 
        ]);

    }
    
}
