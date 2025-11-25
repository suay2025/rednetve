<?php

namespace App\Http\Livewire\Cliente;

use App\Http\Livewire\Admin\AdminComponent;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

use App\Models\DatosFacturacion;
use App\Models\Country;
use App\Models\Estado;
use App\Models\Cities;
use App\Models\DeliveryArea;
use App\Models\PedidoTemporal;

class DatosFacturacionCliente extends AdminComponent
{
    public $state = [];
    public $datosfacturacion;
    public $showEditModal = false;
    public $direccionIdBeingRemoved = null;
    public $class = '';
    public $class1 = '';
    public $deliveryArea = '';

    public $country = 237;
    public $province = 24;
    public $city;
    public $zona;
    public $countries = [], $provinces = [], $cities = [], $zonas = [];
    public $nropedido;
    public $metodoentrega = 'shipment';

    public $currencyValue;

    protected $rules = [
        'country' => 'required|not_in:0',
        'province' => 'required|not_in:0',
        'city' => 'required|not_in:0',
    ];

    protected $messages = [
        'required' => 'Valor requerido',
    ];
    
    public function mount($nropedido)
    {
        $this->nropedido = $nropedido;
        $this->provinces = collect();
        $this->cities = collect();
        $this->zonas = collect();

        $this->countries = Country::all();
        $this->provinces = Estado::where('country_id', 237)->get();
        $this->cities = Cities::where('state_id', 24)->get();

        $datosfacturacion = DatosFacturacion::where('user_id', auth()->user()->id)->first();

        if($datosfacturacion)
        {
            $this->state = $datosfacturacion->toArray();    
        }else{
            $this->state = auth()->user()->toArray();
            $this->state['cellphonecode'] = auth()->user()->datosbasicos->cellphonecode;
            $this->state['cellphone'] = auth()->user()->datosbasicos->cellphone;
            $this->state['address'] = auth()->user()->datosbasicos->address;
        }
        
        $this->state['nropedido'] = $nropedido;
        $this->state['metodoentrega'] = $this->metodoentrega;
        $this->state['metodoenvio'] = 'enviodelivery';

        $this->currencyValue = request()->cookie('currency');
    }

    public function changeZona($zona_id)
    {
        $zona = DeliveryArea::find($zona_id);
        $this->deliveryArea = $zona;
    }

    public function addNew()
    {
        $this->showEditModal = false;
        $this->class = '';
        $this->class1 = '';
    }

    public function edit(DatosFacturacion $datosfacturacion)
	{
		$nropedido = $this->nropedido;
		$this->reset();
		$this->nropedido = $nropedido;

		$this->showEditModal = true;

		$this->datosfacturacion = $datosfacturacion;

		$this->state = $datosfacturacion->toArray();

        $this->countries = Country::all();
        $this->country = $this->state['country_id'];
        $this->provinces = Estado::where('country_id', $this->country)->get();
        $this->province = $this->state['state_id'];
        $this->cities = Cities::where('state_id', $this->province)->get();
        $this->city = $this->state['city_id'];

		$this->dispatchBrowserEvent('show-form');
	}

    public function updateDatos()
	{
		$validatedData = Validator::make($this->state, [
			'identificationNac' => 'required|not_in:0',
			'identificationNumber' => 'required',
            'names' => 'required',
            'surnames' => 'required',
            'cellphonecode' => 'required|not_in:0',
            'cellphone' => 'required',
            'address' => 'required',
            'zipcode' => 'nullable',
		])->validate();

		$this->datosfacturacion->update($validatedData);

		$this->dispatchBrowserEvent('hide-form', ['message' => 'Datos de facturacion actualizado satisfactoriamente!']);
	}

    public function confirmDireccionRemoval($direccionId)
	{
		$this->direccionIdBeingRemoved = $direccionId;

		$this->dispatchBrowserEvent('show-delete-modal');
	}

	public function deleteDireccion()
	{
		$direccion = DatosFacturacion::findOrFail($this->direccionIdBeingRemoved);

		$direccion->delete();

		$this->dispatchBrowserEvent('hide-delete-modal', ['message' => 'Direccion eliminada satisfactoriamente!']);
	}

	public function updatedCountry($value)
	{
		$this->provinces = Estado::where('country_id', $value)->get();
		// $this->subcategory = $this->subcategories->first()->id ?? null;
	}

    public function updatedProvince($value)
	{
		$this->cities = Cities::where('state_id', $value)->get();
		// $this->subcategory = $this->subcategories->first()->id ?? null;
	}

    public function updatedCity($value)
	{
		$this->zonas = DeliveryArea::where('city_id', $value)->get();
		// $this->subcategory = $this->subcategories->first()->id ?? null;
        $this->state['costeenvio'] = '';
        $this->state['deliveryarea'] = '';
	}

    public function updatedZona($value){
        
        $delivery = DeliveryArea::find($value);
        $this->state['deliveryarea'] = $delivery->name;
        $this->state['costeenvio'] = $delivery->coste;
    }

    public function seleccionar(DatosFacturacion $datosfacturacion)
    {
        $this->state = $datosfacturacion->toArray();

        $this->countries = Country::all();
        $this->country = $this->state['country_id'];
        $this->provinces = Estado::where('country_id', $this->country)->get();
        $this->province = $this->state['state_id'];
        $this->cities = Cities::where('state_id', $this->province)->get();
        $this->city = $this->state['city_id'];
        
        $this->showEditModal = true;
        $this->class = 'readonly';
        $this->class1 = 'disabled';

        $this->state['metodoenvio'] = 'enviodelivery';
        
    }

    public function siguiente()
    {
        $validatedData = Validator::make($this->state, [
            'identificationNac' => 'required|not_in:0',
			'identificationNumber' => 'required',
            'names' => 'required',
            'surnames' => 'required',
            'cellphonecode' => 'required|not_in:0',
            'cellphone' => 'required',
            'address' => 'required',
            'zipcode' => 'nullable',
            'metodoenvio'=> 'required|in:enviodelivery,envionacional',
            'metodoentrega'=> 'required|not_in:0' ,
            'deliveryarea' => 'nullable',
            'costeenvio' => 'nullable',
		],  [
            'required' => 'Valor requerido',
        ],)->validate();

        
        $this->validate();
        
        $validatedData['user_id'] = auth()->user()->id;
        $validatedData['country_id'] = $this->country;
        $validatedData['state_id'] = $this->province;
        $validatedData['city_id'] = $this->city;
        $validatedData['deliveryarea_id'] = $this->zona;

        if($this->class !== 'readonly')
        {
            DatosFacturacion::create($validatedData);
        }

        // Agregar datos de facturacion al pedido
        //$validatedData['nropedido'] = $this->nropedido;
        $validatedData['shipping'] = $validatedData['metodoenvio'];
        if($validatedData['shipping'] == 'enviodelivery'){
            $validatedData['in_delivery'] = 1;
        }else{
            $validatedData['in_delivery'] = 0;
        }

        $pedido = PedidoTemporal::where('nropedido', $this->state['nropedido'])->first();

        $pedido->update($validatedData);

        // $pedido = Pedido::where('pedido', $this->nropedido)->first();

        // $pedido->update($validatedData);
        
        $this->dispatchBrowserEvent('enviarFormularioShipping');

		$this->dispatchBrowserEvent('hide-form', ['message' => 'Datos de facturacion actualizado satisfactoriamente!']);

        return redirect()->route('checkout.pasarela', ['nropedido' => $pedido->nropedido, 'comercioId' => $pedido->comercio_id]);

    }

    public function render()
    {
        $direcciones = DatosFacturacion::where('user_id', auth()->user()->id)->paginate();

        $pedido = PedidoTemporal::where('nropedido', $this->nropedido)->first();

        return view('livewire.cliente.datos-facturacion-cliente', ['direcciones'=>$direcciones, 'pedido'=>$pedido]);
    }
}
