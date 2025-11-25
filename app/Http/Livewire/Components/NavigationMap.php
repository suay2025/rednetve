<?php

namespace App\Http\Livewire\Components;

use App\Http\Livewire\Admin\AdminComponent;

use App\Models\Comercio;

class NavigationMap extends AdminComponent
{
    public $comercio;

    public function mount($comercio_id)
    {
        $this->comercio = Comercio::find($comercio_id);

        
        
    }

    public function render()
    {
        return view('livewire.components.navigation-map');
    }
}
