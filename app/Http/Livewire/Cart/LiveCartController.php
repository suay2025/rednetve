<?php

namespace App\Http\Livewire\Cart;

use Illuminate\Http\Request;
use Livewire\Component;
use App\Models\Product;

class LiveCartController extends Component
{

    
    public function render()
    {
        return view('livewire.cart.live-cart-controller');
    }
}
