<?php

namespace App\Http\Livewire\Layouts;

use Livewire\Component;

class Footer extends Component
{
    public $comercio_id;

    public function mount($comercioId=1)
    {
        $this->comercio_id = $comercioId;
    }

    public function render()
    {
        return view('livewire.layouts.footer');
    }
}
