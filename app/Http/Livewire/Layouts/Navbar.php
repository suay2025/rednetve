<?php

namespace App\Http\Livewire\Layouts;

use Livewire\Component;
use App\Models\Comercio;
use App\Models\Category;
use App\Models\Tasa;
use App\Models\Setting;

class Navbar extends Component
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

    protected $listeners = ['sendCategories' => 'sendCategories', 'receiveManufacturerS' => 'receiveManufacturerS', 'receiveModeloS' => 'receiveModeloS', 'receiveMotorS' => 'receiveMotorS'];

    protected $listen = [
        'App\Events\NewUserCreated' => [
            'captarEvento',
        ],
    ];

    public function captarEvento()
    {
        dd('captarEvento');
    }

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
        $settingUser = new  SettingUser;
        $settingUser->client($comercio->id);

        dd($settingUser);

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
            
            $this->currencyValue = $settingUser->currency;
        }
        
    }

    public function changeCurrency($currency)
    {
        $this->currencyValue = $currency;

        $setting = Setting::where('user_id', $this->comercio->user_id)->first();

        $setting->update(['currency' => $currency]);

        $this->dispatchBrowserEvent('refreshPage', ['message' => 'Refresh pagina!']);        
    }

    public function render()
    {
        return view('livewire.layouts.navbar');
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
            return redirect()->route('cartOff',[
            // return view('livewire.cart.cart', [
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
