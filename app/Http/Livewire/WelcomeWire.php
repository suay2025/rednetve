<?php

namespace App\Http\Livewire;
use App\Http\Livewire\Admin\AdminComponent;

use Illuminate\Http\Request;
use App\Models\Comercio;
use App\Models\Category;

class WelcomeWire extends AdminComponent
{
    public $comercio;
    public $peticion;
    public $categories;
    public $valor = 'esto es una prueba';
    public $existe;
    public $dolar = 1;

    protected $listeners = ['prueba' => 'prueba'];

    public function mount(Request $request)
    {
        $comercio = null;
        $existe = false;
        $categories = null;
        //->
        $peticion = explode('/', \Request::getRequestUri());

        // if($peticion[1] !== ''){
        //     if($peticion !== ''){            
        //         $this->comercio = Comercio::where('name', $peticion[2])->first();
        //     }else{
        //         $this->comercio = Comercio::find(1);    
        //     }
        // }else{
        //     $this->comercio = Comercio::find(1);
        // }
        
        // if($this->comercio){
        //     $this->existe = true;
        //     $this->categories = Category::where('comercio_id', $this->comercio->id)->get();
        // }else{
        //     $this->categories = Category::where('comercio_id', 1)->get();
        // }

        
        
        // return view('livewire.welcome-wire', [
        //     'comercio' => $comercio,
        //     'existe' => $existe,
        // ]);

        $dolar = json_decode(file_get_contents("https://pydolarve.org/api/v1/{currency}"), true);

        dd($dolar);
        $this->dolar = $dolar['promedio'];
        
    }

    public function render()
    {
        return view('livewire.welcome-wire', [
            // 'comercio' => $this->comercio,
            // 'existe' => $this->existe,
        ]);
    }

    public function index()
    {
        $this->render();
    }


}
