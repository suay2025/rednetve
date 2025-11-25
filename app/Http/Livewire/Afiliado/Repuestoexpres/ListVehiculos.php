<?php

namespace App\Http\Livewire\Afiliado\Repuestoexpres;

use Livewire\Component;

class ListVehiculos extends Component
{

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

    public $user_id;

    public $manufacturer_id, $modelo_id, $motor_id;

    public function mount($user_id)    
    {
        $this->user_id = $user_id;

        $this->manufacturer = 0;
        
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

    public function addNew()
    {

    }

    public function createVehiculo()
    {

    }

    public function edit(Vehiculo $vehiculo)
    {

    }

    public function updateVehiculo()
    {

    }

    public function confirmVehiculoRemoval($vehiculoId)
    {

    }

    public function deleteVehiculo()
    {

    }

    public function sortBy($columnName)
    {
        if ($this->sortColumnName === $columnName) {
            $this->sortDirection = $this->swapSortDirection();
        } else {
            $this->sortDirection = 'asc';
        }

        $this->sortColumnName = $columnName;
    }

    public function swapSortDirection()
    {
        return $this->sortDirection === 'asc' ? 'desc' : 'asc';
    }

    public function updatedSearchTerm()
    {
        $this->resetPage();
    }

    public function render()
    {
    	$vehiculos = Vehiculo::query()
            ->where('user_id', $this->user_id)
            ->where(function($q){
                $q->where('name', 'like', '%'.$this->searchTerm.'%')
                ->orWhere('email', 'like', '%'.$this->searchTerm.'%');
            })
            ->orderBy($this->sortColumnName, $this->sortDirection)
            ->paginate(15);

        return view('livewire.afiliado.repuestoexpres.list-vehiculos', [
        	'vehiculos' => $vehiculos,
        ]);
    }

}
