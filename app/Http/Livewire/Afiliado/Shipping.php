<?php

namespace App\Http\Livewire\Afiliado;

use Livewire\Component;

class Shipping extends Component
{
    public $nropedido;

    public function mount($nropedido = '')
    {
        $this->nropedido = $nropedido;
    }

    public function render()
    {
        if(  \Cart::getTotalQuantity() == 0)
        {
            $this->description = 'No puede ejecutar back en el navegador';
            return view('livewire.error.show-error', [
                'error' => '144',
                'description' => 'No puede ejecutar back en el navegador',
            ]);
        }
        
        return view('livewire.afiliado.shipping');
    }
}
