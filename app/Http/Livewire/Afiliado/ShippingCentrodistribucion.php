<?php

namespace App\Http\Livewire\Afiliado;

use App\Http\Livewire\Admin\AdminComponent;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

use App\Models\CentroDistribucion;
use App\Models\Comercio;
use App\Models\PedidoTemporal;

class ShippingCentrodistribucion extends AdminComponent
{
    public $state = [];
    public $showEditModal = false;
    public $comercio_id;    

    public $infocentro;
    public $class = 'd-none';
    public $centrodistribucion_id;
    public $address;
    public $contactphone;
    public $horario;
    public $metodoentrega = 'pickup';

    public $searchTerm = null;

    protected $queryString = ['searchTerm' => ['except' => '']];

    public $sortColumnName = 'created_at';

    public $sortDirection = 'desc';

    public function mount($nropedido = '', $comercioId = 1)
    {
        
        $this->comercio_id = $comercioId;

        $this->centro = '';

        $this->state['nropedido'] = $nropedido;
        $this->state['metodoentrega'] = $this->metodoentrega;

    }

    public function siguientePickup()
    {
        
        $pedido = PedidoTemporal::where('nropedido', $this->state['nropedido'])->first();

        $validatedData['identificationNac'] = auth()->user()->identificationNac;
        $validatedData['identificationNumber'] = auth()->user()->identificationNumber;
        $validatedData['names'] = auth()->user()->names;
        $validatedData['surnames'] = auth()->user()->surnames;
        $validatedData['cellphonecode'] = auth()->user()->datosbasicos->cellphonecode;
        $validatedData['cellphone'] = auth()->user()->datosbasicos->cellphone;
        $validatedData['address'] = auth()->user()->datosbasicos->address;

        $validatedData['metodoentrega'] = $this->metodoentrega;
        $validatedData['shipping'] = '';
        $validatedData['in_delivery'] = '0';
        $validatedData['zipcode'] = '';
        $validatedData['deliveryarea'] = '';
        $validatedData['country_id'] = '';
        $validatedData['state_id'] = '';
        $validatedData['city_id'] = '';

        $validatedData['comercio_id'] = $this->comercio_id;
        $validatedData['centrodistribucion_id'] = $this->centrodistribucion_id;
        $validatedData['address'] = $this->address;
        $validatedData['contactphone'] = $this->contactphone;
        $validatedData['horario'] = $this->horario;

        $pedido->update($validatedData);

        $this->dispatchBrowserEvent('enviarFormularioPickup');

		
        return redirect()->route('checkout.pasarela', ['nropedido' => $pedido->nropedido, 'comercioId' => $pedido->comercio_id]);

    }

    public function selectComercio(Comercio $centro)
	{
		$this->infocentro = '<div>'.$centro->name . '<br>'.$centro->address . '<br>' . $centro->contactphone . '<br>' . $centro->horario.'</div>';
        
        $this->class = '';
        $this->centrodistribucion_id = $centro->id;
		// session()->flash('message', 'User added successfully!');

        $this->address = $centro->address;
        $this->contactphone = $centro->contactcellphone . ' ' . $centro->contactphone;
        $this->horario = $centro->horario;

		$this->dispatchBrowserEvent('hide-form-centros', ['message' => 'Centro seleccionado satisfactoriamente!']);
	}

	public function selectCentro(CentroDistribucion $centro)
	{
		$this->infocentro = '<div>'.$centro->comercio->name . '<br>'.$centro->address . '<br>' . $centro->contactphone . '<br>' . $centro->horario.'</div>';
        
        $this->class = '';
        $this->centrodistribucion_id = $centro->id;
		// session()->flash('message', 'User added successfully!');
        $this->address = $centro->address;
        $this->contactphone = $centro->contactphone;
        $this->horario = $centro->horario;

		$this->dispatchBrowserEvent('hide-form-centros', ['message' => 'Centro seleccionado satisfactoriamente!']);
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
        $centrosmodal = CentroDistribucion::query()
    		->where('comercio_id', $this->comercio_id)
            ->orderBy($this->sortColumnName, $this->sortDirection)
            ->get();
        
        $comercio = Comercio::find($this->comercio_id);

        return view('livewire.afiliado.shipping-centrodistribucion', ['centrosmodal' => $centrosmodal, 'comercio' => $comercio]);
    }
}
