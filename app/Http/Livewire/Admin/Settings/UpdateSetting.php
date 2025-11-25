<?php

namespace App\Http\Livewire\Admin\Settings;

use App\Models\Setting;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class UpdateSetting extends Component
{
    public $state = [];

    public $userId = 0;

    public $setting;

    public function mount($userId = 0)
    {
        if($userId == 0){
            $this->userId = auth()->user()->id;
        }
        
        $this->setting = Setting::where('user_id', $this->userId)->first();
        
        if ($this->setting) {
            $this->state = $this->setting->toArray();
        }
    }

    public function updateSetting()
    {
        // $setting = Setting::first();

        $this->state['user_id'] = $this->userId;
        if ($this->setting) {
            $this->setting->update($this->state);
        } else {
            $this->setting = Setting::create($this->state);
        }

        Cache::forget('setting');

        $this->dispatchBrowserEvent('updated', ['message' => 'Configuración actualizada satisfactoriamente!']);
    }

    public function render()
    {
        return view('livewire.admin.settings.update-setting');
    }
}
