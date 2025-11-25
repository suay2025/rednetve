<?php

namespace App\Http\Livewire\Operacion;

use Livewire\Component;

class MakePayment extends Component
{
    public $comercioId;
    
    public function mount($comercioId=0)
    {
        $this->comercioId = $comercioId;
    }
    public function render()
    {
        return view('livewire.operacion.make-payment');
    }
}
