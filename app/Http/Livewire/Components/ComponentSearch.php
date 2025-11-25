<?php

namespace App\Http\Livewire\Components;

use App\Http\Livewire\Admin\AdminComponent;
use Livewire\Attributes\Validate;
use Illuminate\Validation\Rule;

use App\Models\Comercio;
use App\Models\Manufacturer;
use App\Models\Modelo;
use App\Models\Motor;
use App\Models\Product;

class ComponentSearch extends AdminComponent
{
    public $comercio_id = 0;

    #[Validate]
	public $manufacturer = 0;
	public function rules()
    {
        return [
            'manufacturer' => 'required|not_in:0',
        ];
    }

    public function messages() 
    {
        return [
            'manufacturer.required' => 'Debe seleccionar una opcion.',
            'manufacturer.not_in' => 'Debe seleccionar una opcion.',
        ];
    }
   
    public $modelo;
    public $motor;
	public $manufacturers = [], $modelos = [], $motores = [];

    public $manufacturer_id, $modelo_id, $motor_id;

    public function mount($comercioId = 0, $manufacturer_id= 0, $modelo_id = 0, $motor_id = 0)
    {
        $this->manufacturer = 0;
        $this->manufacturer = $manufacturer_id;
        $this->modelo = $modelo_id;
        $this->motor = $motor_id;
        
        $this->comercio_id = $comercioId;

        $this->manufacturer_id = $manufacturer_id;
        $this->modelo_id = $modelo_id;
        $this->motor_id = $motor_id;

        $this->manufacturers = Manufacturer::where('comercio_id', $this->comercio_id)->get();

		// $this->manufacturers = Manufacturer::where('comercio_id', $this->comercio_id)->get();
        if($manufacturer_id == 0)
		{            
		    $this->modelos = collect();

            $this->motores = collect();
        }else{

            $this->modelos = Modelo::where('manufacturer_id', $manufacturer_id)->get();

            $this->motores = Motor::where('manufacturer_id', $manufacturer_id)->where('modelo_id', $modelo_id)->get();

            if (!$this->modelos){
                $this->motores = collect();
                $this->motores = collect();
            }
            else{
                if (!$this->motores){
                    $this->motores = collect();
                }
            }            

        }
        
    }

    public function updatedManufacturer($value)
	{
        $this->manufacturer_id = $value;
		$this->modelos = Modelo::where('manufacturer_id', $value)->get();
		// $this->subcategory = $this->subcategories->first()->id ?? null;
        $this->emit('receiveManufacturerS', $value);

        $this->updatedModelo(0);
	}

    public function updatedModelo($value)
	{
        $this->modelo_id = $value;
		$this->motores = Motor::where('manufacturer_id', $this->manufacturer_id)->where('modelo_id', $value)->get();
		// $this->subcategory = $this->subcategories->first()->id ?? null;
        $this->emit('receiveModeloS', $value);
	}

    public function updatedMotor($value)
	{
        $this->emit('receiveMotorS', $value);
	}

    public function searchMotor()
    {
        $this->validate();

        $informacion = "Hola desde Componente A!";
        $products = Product::all();

        $this->emit('infoRecibida', $informacion, $this->manufacturer, $products);
    }

    
}
