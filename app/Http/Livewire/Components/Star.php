<?php

namespace App\Http\Livewire\Components;

use Livewire\Component;

class Star extends Component
{
    public $state = [];

    protected $listeners = ['refreshStar' => 'refreshStar'];

    public function mount($product_id = 1, $ca_valoracion = 4, $class= 'four')
    {
        $this->state['ca_valoracion'] = $ca_valoracion;
        $this->state['class'] = $class;
        $this->state['product_id'] = $product_id;
    }

    public function valorar1($puntuacion)
	{
        $this->state['ca_valoracion'] = $puntuacion;
        $this->ca_valoracion = $puntuacion;
        switch ($puntuacion) {
            case 1:
                $this->state['class'] = 'one';
                break;
            case 2:
                $this->state['class'] = 'two';
                break;
            case 3:
                $this->state['class'] = 'three';
                break;
            case 4:
                $this->state['class'] = 'four';
                break;
            case 5:
                $this->state['class'] = 'five';
                break;
        }
        $this->mount($this->state['product_id'], $this->state['ca_valoracion'], $this->state['class']);

        $this->emit('refreshValoracion', $this->state['product_id'], $this->state['ca_valoracion'], $this->state['class']);
        
	}

    public function refreshStar($product_id = 1, $ca_valoracion = 1, $class= 'one')
    {
        $this->state['ca_valoracion'] = $ca_valoracion;
        $this->state['class'] = $class;
        $this->state['product_id'] = $product_id;

        $this->mount($this->state['product_id'], $this->state['ca_valoracion'], $this->state['class']);
        
    }

    public function render()
    {
        // dd($this->state);
        
        return view('livewire.components.star');
    }
}
