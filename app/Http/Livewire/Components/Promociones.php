<?php

namespace App\Http\Livewire\Components;

use Livewire\Component;
use App\Models\Promocion;
class Promociones extends Component
{
    public function render()
    {
        $promocionFirst= Promocion::query()
        ->where('active', 'active')
        ->orderBy('order', 'asc')
        ->first();
        $promociones = Promocion::query()
			->where('active', 'active')
            ->whereNotIn('id', [$promocionFirst->id])
            ->orderBy('order', 'asc')
            ->get();

        return view('livewire.components.promociones', [
            'promociones' => $promociones,
            'promocionFirst' => $promocionFirst,
        ]);
    }
}
