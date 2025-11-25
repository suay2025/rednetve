<?php

namespace App\Http\Livewire\Cliente;

use Livewire\Component;
use App\Models\Pedido;
use App\Models\PedidoDetalles;

class DetallesPedido extends Component
{
    public $nropedido;

    public function mount($nroPedido)
    {
        $this->nropedido = $nroPedido;
    }

    public function render()
    {
        $detalles = PedidoDetalles::where('nropedido', $this->nropedido)->paginate();
        $pedido = Pedido::where('nropedido', $this->nropedido)->first();
        return view('livewire.cliente.detalles-pedido', [
            'pedido' => $pedido,
            'detalles' => $detalles,
        ]);
    }
}
