<?php

namespace App\Http\Livewire\Components;

use Livewire\Component;

use App\Models\Manufacturer;

class SectionManufacturers extends Component
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
        $manufacturers = Manufacturer::where('comercio_id', $this->comercio_id)
                            ->where(function($q){
                                $q->where('name', 'like', '%'.$this->parametro.'%');
                            })
                            ->whereHas('products', function($z){
                                $z->where('name', 'like', '%'.$this->parametro.'%')
                                    ->orWhere('description', 'like', '%'.$this->parametro.'%');
                            })
                            ->get();

        return view('livewire.components.section-manufacturers',[
            'manufacturers' => $manufacturers 
        ]);

    }
    
}
