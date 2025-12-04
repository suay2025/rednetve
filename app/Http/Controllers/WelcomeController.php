<?php

namespace App\Http\Controllers;
use App\Http\Livewire\Admin\AdminComponent;

use Illuminate\Http\Request;
use App\Models\Comercio;
use App\Models\Category;
use App\Models\Setting;
use App\Models\SettingUser;
use App\Models\User;


use App\Events\NewEventCreated;

class WelcomeController extends Controller
{
    protected $listeners = [
        'receiveManufacturerS' => 'receiveManufacturerS', 
        'receiveModeloS' => 'receiveModeloS', 
        'receiveMotorS' => 'receiveMotorS', 
        'emitCurrency' => 'emitCurrency'
    ];

    public $words = '';

    public $state = [];

    public $manufacturer_id, $modelo_id, $motor_id;

    public $currencyValue;

    public function __invoke(Request $request)
    {

        // $comercio = null;
        // $existe = false;
        // //->
        // $peticion = explode('/', \Request::getRequestUri());

        // if($peticion[1] !== ''){
        //     $comercio = Comercio::where('name', $peticion[2])->first();
        // }
        
        // if($comercio){
        //     $existe = true;
        // }else{
        //     $categories = Category::where('comercio_id', 1)->get();
        // }

        // dd($request);

        // return view('welcome', [
        //     'existe' => $existe,
        //     'comercio' => $comercio,
        //     'categories' => $categories,
        // ]);
        
    }

    public function index(Request $request)
    {
        $peticion = explode('/', \Request::getRequestUri());
        if($peticion[0] == '')
        {
            $manufacturer_id = 0;
        }
        $words = '';

        if ($request->isMethod('post')) 
        {
            if($request->post('words'))
            {
                if($request->post('words') !== '')
                {
                    $words = $request->post('words');
                    
                }
            }
            if($request->post('categ'))
            {
                if($request->post('categ') !== '')
                {
                    $words .= $request->post('categ');
                }
            }

            $manufacturer_id = $request->post('manufacturer_id');
            $modelo_id = $request->post('modelo_id');
            $motor_id = $request->post('motor_id');

            $comercio_id = $request->post('comercio_id');
            if(empty($comercio_id)){
                $comercio_id = 1;
            }

            // dd($request);

            if($request->post('manufacturer_id'))
            {
                $words .= ' ';
            }

            // event(new NewEventCreated());

        }else{ // Method get
            if($request->get('words'))
            {
                if($request->get('words') !== '')
                {
                    $words = $request->get('words');
                }
            }
            if($request->get('categ'))
            {
                if($request->get('categ') !== '')
                {
                    $words .= $request->get('categ');
                }
            }
            
            $manufacturer_id = $request->get('manufacturer_id');
            $modelo_id = $request->get('modelo_id');
            $motor_id = $request->get('motor_id');
            $comercio_id = $request->get('comercio_id');

            if($manufacturer_id == null)
            {
                $manufacturer_id = 0;
                $modelo_id = 0;
                $motor_id = 0;
            }

            if(empty($comercio_id)){
                $comercio_id = 1;
            }

            // dd($request);

            if($request->get('manufacturer_id'))
            {
                $words .= ' ';
            }

            // event(new NewEventCreated());

            $setting = Setting::find($comercio_id)->first();

        }

        if(empty($words)){
            $words = null;
        }

        // Manipular cookie
       
        $this->setCookie();

        // Fin cookie

        if( isset( $_COOKIE['infosite']) )
        {
            $this->setCookie();
        }else{
            $this->setCookie();
        }

        $comercio_id = $request->get('comercio_id');
        if(empty($comercio_id)){
            $comercio_id = 1;
        }
        $setting = Setting::find($comercio_id)->first();

        // Evaluar currency
        $minutes = 10;
        $this->comercio = Comercio::find($comercio_id);
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
        // Fin evaluar currency

        return view('welcome', [
            'words' => $words,
            'manufacturer_id' => $manufacturer_id,
            'modelo_id' => $modelo_id,
            'motor_id' => $motor_id,
            'comercio_id' => $comercio_id,
            'comercio' => $this->comercio,
            'in_cellphonecontact' => $setting->in_cellphonecontact,
            'in_sliderprincipal' => $setting->in_sliderprincipal,
            'in_marcasproductos' => $setting->in_marcasproductos,
            'currencyValue' => $this->currencyValue,
        ]);
    }

    public function setCookie()
    {
        // $dominio = str_replace(\Request::url(), '', \Request::fullUrl());
        $fullUrl = \Request::fullUrl();

        $cadena = "http://192.168.1.4:8000";

        $comercio = Comercio::where('dominio', 'LIKE', $_SERVER['SERVER_NAME']);

        // $cadena = "https://repuestoexpres.com";

        $cookie_name = "infosite";
        $cookie_value = $_SERVER['SERVER_NAME'];
        setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); //name,value,time,url
        
        // setcookie('infosite','',time() - 1);
        // if(empty($_COOKIE['infosite'])){
        //     $this->dispatchBrowserEvent('update', ['message' => 'No existe el cookie!']);
        //     dd('No existe el cookie!');
        // }else{
        //     dd($_COOKIE['infosite']);
        // }
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

    public function checkoutShipping($nropedido)
    {
        return view('externalviews.checkout', [
            'nropedido' => $nropedido,
        ]);
    }

    public function checkoutPasarela($nropedido, $comercioId)
    {
        return view('externalviews.checkoutpasarela', [
            'nropedido' => $nropedido,
            'comercioId' => $comercioId,
        ]);
    }

    public function receiveBDV($toke)
    {
        return view('externalviews.procesado', [
            'nropedido' => $toke,
            'comercioId' => '1',
        ]);
    }

}
