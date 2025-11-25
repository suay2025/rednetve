<?php

namespace App\Http\Livewire\Components;

use Livewire\Component;

class CarouselProductsOffer extends Component
{
    public $comercioId;

    public function mount($comercioId = 1)
    {
        $this->comercioId = $comercioId;
    }

    public function render()
    {
        $offers = Product::where('comercio_id', $this->comercioId)
                            ->where('on_offer', '1')
                            ->paginate();
        dd($offers);
        return view('livewire.components.carousel-products-offer',[
            'offers' => $offers 
        ]);
    }
}
