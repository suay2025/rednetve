<?php

namespace App\Http\Livewire\Afiliado\Repuestoexpres;

use App\Models\SettingComercio;
use App\Models\Comercio;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class UpdateSettingComercio extends Component
{
    public $state = [];

    public $comercio_id = 1;

    public $comercio;

    public $setting;

    public function mount($comercioId = 1)
    {
        $this->comercio_id = $comercioId;

        $this->comercio = Comercio::find($this->comercio_id);
        
        $this->setting = SettingComercio::where('comercio_id', $this->comercio_id)->first();
        
        if ($this->setting) {
            $this->state = $this->setting->toArray();
        }
    }

    public function updateSetting()
    {
        // $setting = Setting::first();

        $this->state['comercio_id'] = $this->comercio_id;
        $this->state['user_id'] = $this->comercio->user_id;
        if ($this->setting) {
            $this->setting->update($this->state);
        } else {
            $this->setting = SettingComercio::create($this->state);
        }

        Cache::forget('setting');

        $this->dispatchBrowserEvent('updated', ['message' => 'Configuración actualizada satisfactoriamente!']);
    }

    public function render()
    {
        return view('livewire.afiliado.repuestoexpres.update-setting-comercio');
    }
}
