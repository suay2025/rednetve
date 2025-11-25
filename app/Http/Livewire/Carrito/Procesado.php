<?php

namespace App\Http\Livewire\Carrito;

use Livewire\Component;
use App\Models\Comercio;

class Procesado extends Component
{
    public function render()
    {
        \Cart::clear();
        $comercio = Comercio::find(1);
        return view('livewire.carrito.procesado', ['comercio' => $comercio]);
    }
}
