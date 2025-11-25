<?php

namespace App\Http\Livewire\Layouts;

use Livewire\Component;

use App\Models\Comercio;
use App\Models\Category;
use App\Models\Tasa;
use App\Models\Setting;
use App\Models\SettingUser;
use App\Models\Menu; 

class NavbarNuevo extends Component
{

    public $categories;

    public $state = [];

    public $comercio;
    public $comercio_id = 1;

    public $tasacambio = 1;

    public $currenciesP = [
        '0' => "Bs", 
        '1' => "$",
        '2' => "€"];

    public $dolar = 1;

    public $currencyValue = 'Bs';

    public $manufacturer_id, $modelo_id, $motor_id;

    public $totalQuantityCart = 0;

    protected $listeners = ['sendCategories' => 'sendCategories', 'receiveManufacturerS' => 'receiveManufacturerS', 'receiveModeloS' => 'receiveModeloS', 'receiveMotorS' => 'receiveMotorS', 'changeQuantity' => 'changeQuantity', 'emitCurrency' => 'emitCurrency'];


    public function mount($comercioId = 1, $manufacturer_id = 0, $modelo_id = 0, $motor_id = 0){

        $this->comercio_id = $comercioId;

        // dd($manufacturer_id);

        $this->state['manufacturer_id'] = $manufacturer_id;

        $this->state['modelo_id'] = $modelo_id;

        $this->state['motor_id'] = $motor_id;

        $this->categories = Category::where('comercio_id', $this->comercio_id)
                                    ->where('itemMenu', 1)
                                    ->get();
        
        $this->comercio = Comercio::find($this->comercio_id);
        
        $setting = Setting::where('user_id', $this->comercio->user_id)->first();
        // $settingUser = SettingUser::where('user_id', auth()->user()->id)->first();

        if($setting){
            if($setting->api_bcv=="SI"){
                $dolar = json_decode(file_get_contents("https://pydolarve.org/api/v1/dollar"), true);

                $dolar = $dolar['monitors']['bcv']['price'];
                
                $this->tasacambio = $dolar;
            }else{
                $tasa = Tasa::where('status','activo')
                    ->where('user_id', $this->comercio->user_id)
                    ->first();
                    
                if($tasa){
                    $this->tasacambio = $tasa->tasa;
                }else{
                    $this->tasacambio = 1;
                }
            }
            
        }

        $this->totalQuantityCart = \Cart::getTotalQuantity();

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
        
    }

    public function emitCurrency($currencyValue)
    {
        $this->currencyValue = $currencyValue;
    }

    public function changeQuantity()
    {
        $this->totalQuantityCart = \Cart::getTotalQuantity();
    }

    public function render()
    {
        $this->emit('searchMenu', $this->manufacturer_id, $this->modelo_id, $this->motor_id);

        $menus = Menu::where('comercio_id', $this->comercio_id)
            ->where('menu', 1)
            ->orderBy('posicion', 'asc')
            ->get();

        return view('livewire.layouts.navbar-nuevo', [
            'menus' => $menus,
        ]);
    }

    public function sendCategories ($postId=0)
    {
       $this->dispatchBrowserEvent('sendCategories', ['categories' => $this->categories, 'message' => 'variables enviadas satisfactoriamente!']);
    }

    public function receiveManufacturerS ($manufacturerS_id=0)
    {
        $this->state['manufacturer_id'] = $manufacturerS_id;

        $this->manufacturer_id = $manufacturerS_id;

    //    $this->dispatchBrowserEvent('sendCategories', ['categories' => $this->categories, 'message' => 'variables enviadas satisfactoriamente!']);
    }

    public function receiveModeloS ($modeloS_id=0)
    {
        $this->state['modelo_id'] = $modeloS_id;

        $this->modelo_id = $modeloS_id;

    //    $this->dispatchBrowserEvent('sendCategories', ['categories' => $this->categories, 'message' => 'variables enviadas satisfactoriamente!']);
    }

    public function receiveMotorS ($motorS_id=0)
    {
        $this->state['motor_id'] = $motorS_id;

        $this->motor_id = $motorS_id;

    //    $this->dispatchBrowserEvent('sendCategories', ['categories' => $this->categories, 'message' => 'variables enviadas satisfactoriamente!']);
    }

    public function cartRuta()
    {
        $cartCollection = \Cart::getContent();

        if(auth()->check()){
            return redirect()->route('cart', [
                'cartCollection' => $cartCollection, 
                'words' => null,
                'comercioId' => $this->comercio_id, 
                'manufacturer_id' => 0,
                'modelo_id' => 0,
                'motor_id' => 0,
            ]);
        }else{
            // return redirect()->route('cartOff');
            return view('livewire.cart.cart', [
                'cartCollection' => $cartCollection, 
                'words' => null,
                'comercioId' => $this->comercio_id, 
                'manufacturer_id' => 0,
                'modelo_id' => 0,
                'motor_id' => 0,
            ]);
        }
    }

    
}
