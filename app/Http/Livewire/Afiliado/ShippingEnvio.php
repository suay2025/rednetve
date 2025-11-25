<?php

namespace App\Http\Livewire\Afiliado;

use App\Http\Livewire\Admin\AdminComponent;

class ShippingEnvio extends AdminComponent
{
    public $nropedido;

    public function mount($nropedido)
    {
        $this->nropedido = $nropedido;
    }

    public function render()
    {
        return view('livewire.afiliado.shipping-envio');
    }
}
