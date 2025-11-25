<?php

namespace App\Http\Livewire\Components;

use App\Http\Livewire\Admin\AdminComponent;
use Illuminate\Http\Request;

use App\Models\Setting;
use App\Models\SettingUser;
use App\Models\Tasa;
use App\Models\Comercio;

class Currency extends AdminComponent
{
    public $tasacambio = 1;

    public $currenciesP = [
        '0' => "Bs", 
        '1' => "$",];

    public $dolar = 1;

    public $currencyValue = 'Bs';

    public $comercio;

    public function mount($comercioId = 1)
    {
        if(\Cookie::get('currency') == null)
        {
            $minutes = 10;
            $this->comercio = Comercio::find($comercioId);
            $setting = Setting::where('user_id', $this->comercio->user_id)->first();    
            if(auth()->user())
            {
                $settingUser = SettingUser::where('user_id', auth()->user()->id)->first(); 
                if($settingUser){
                    \Cookie::queue('currency', $settingUser->currency, $minutes);
                    $this->currencyValue = $settingUser->currency;
                }else{
                    \Cookie::queue('currency', $setting->currency, $minutes);
                    $this->currencyValue = $setting->currency;
                }
                
            }else{            
                \Cookie::queue('currency', $setting->currency, $minutes);
                $this->currencyValue = $setting->currency;
                
            }
        }else{
            $this->currencyValue = \Cookie::get('currency');
        }

        
    }

    public function changeCurrency($currency)
    {
        $minutes = 10;
        if(auth()->user()){
            // $setting = Setting::where('user_id', $this->comercio->user_id)->first();
            $settingUser = SettingUser::where('user_id', auth()->user()->id)->first();
            if($settingUser){
                $settingUser->update(['currency' => $currency]);    
            }else
            {
                $settingUser = SettingUser::create([
                    'user_id' => auth()->user()->id,
                    'currency' => $currency,
                ]);
                
            }
            \Cookie::queue('currency', $settingUser->currency, $minutes);
            $this->currencyValue = $settingUser->currency;
            
        }else{
            \Cookie::queue('currency', $currency, $minutes);
            $this->currencyValue = $currency;
        }

        $this->emit('emitCurrency', $this->currencyValue);
        

        $this->dispatchBrowserEvent('refreshPage', ['message' => 'Refresh pagina!']);        
        
    }

    public function render()
    {
        
        return view('livewire.components.currency');
    }
}
