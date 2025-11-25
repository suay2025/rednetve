<?php

namespace App\Http\Livewire\Layouts;

use Livewire\Component;
use App\Models\Comercio;

class NavbarPasarela extends Component
{
    public $comercio_id;
    public function mount($comercioId= 1)
    {
        $this->comercio_id = $comercioId;
    }
    public function render()
    {
        $comercio = Comercio::find($this->comercio_id);
        return view('livewire.layouts.navbar-pasarela', ['comercio'=> $comercio]);
    }
}
