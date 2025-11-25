<?php

namespace App\Http\Livewire\Layouts;

use Livewire\Component;

class NavbarIn extends Component
{
    public $totalQuantityCart = 0;

    public $currencyValue = 'Bs';

    public function mount()
    {
        $this->currencyValue = request()->cookie('currency');
    }
    
    public function render()
    {
        
        $this->totalQuantityCart = \Cart::getTotalQuantity();

        return view('livewire.layouts.navbar-in');
    }
}
