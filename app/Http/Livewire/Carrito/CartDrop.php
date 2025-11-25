<?php

namespace App\Http\Livewire\Carrito;

use Livewire\Component;

use Illuminate\Http\Request;
use App\Models\Tasa;

class CartDrop extends Component
{
    public $currencyValue;

    protected $listeners = [
        'emitCurrency' => 'emitCurrency'
    ];

    public function mount()
    {
        $this->currencyValue = request()->cookie('currency');
    }

    public function getPrice($price, $comercio_id = 1)
    {
        $currency = request()->cookie('currency');
        
        $tasaValues = Tasa::where('comercio_id', $comercio_id)->where('status', 'activo')->first();

        if(!$tasaValues){
            $tasa = 1;
        }else{
            $tasa = $tasaValues->tasa;
        }
        
        switch ($currency) {
            case 'Bs':
                return round($tasa * $price, 2);
                break;            
            case '$':
                return round($price, 2);                
                break;
        }
    }

    public function emitCurrency($currencyValue, Request $request)
    {
        $this->currencyValue = $request->cookie('currency');

    }

    public function render()
    {
        return view('livewire.carrito.cart-drop');
    }
}
