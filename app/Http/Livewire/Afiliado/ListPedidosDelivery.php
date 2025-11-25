<?php

namespace App\Http\Livewire\Afiliado;

use App\Http\Livewire\Admin\AdminComponent;
use App\Models\User;
use App\Models\Pedido;
use App\Models\Comercio;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;

class ListPedidosDelivery extends AdminComponent
{
	use WithFileUploads;

	public $state = [];

	public $pedido;

	public $comercio_id;

	public $showEditModal = false;

	public $containerIdBeingRemoved = null;

	public $searchTerm = null;

    protected $queryString = ['searchTerm' => ['except' => '']];

    public $sortColumnName = 'created_at';

    public $sortDirection = 'desc';

    public function mount()
    {
    	
    }

	public function changeConfirmation(Pedido $pedido, $confirmed)
	{
		Validator::make(['confirmed' => $confirmed], [
			'confirmed' => [
				'required',
				Rule::in(Pedido::DELIVERED, Pedido::NOTDELIVERED),
			],
		])->validate();

		$pedido->update(['pedidoentregado' => $confirmed]);

		switch ($confirmed) {
			case '1':
				$confirmed = 'Confirmado';
				break;
			
			case '0':
				$confirmed = 'No Confirmado';
				break;
		}

		$this->dispatchBrowserEvent('updated', ['message' => "Pedido cambió a: {$confirmed} satisfactoriamente."]);
	}

    public function addNew()
	{
		$comercio_id = $this->comercio_id;
		$this->reset();
		$this->comercio_id = $comercio_id;

		$this->showEditModal = false;

		$this->dispatchBrowserEvent('show-form');
	}

	public function createPedido()
	{
		$validatedData = Validator::make($this->state, [
			'pedido' => 'required',
            'description' => 'nullable',
            'cedula' => 'required',
            'coste'  => 'required',
            'in_delivery' => 'nullable',
		])->validate();
        
		$validatedData['comercio_id']=$this->comercio_id;

        $user = User::whereHas('datosbasicos', function($q) use ($validatedData) {
            $q->where('identificationNumber', $validatedData['cedula']);
        })->first();

        if($user)
        {
            $validatedData['user_id']=$user->id;
            
            Pedido::create($validatedData);

            // session()->flash('message', 'User added successfully!');

            $this->dispatchBrowserEvent('hide-form', ['message' => 'Pedido agregado satisfactoriamente!']);
        }else{
            $this->dispatchBrowserEvent('hide-form', ['message' => 'Cédula del Cliente no existe!']);
        }

		
	}

	public function edit(Pedido $pedido)
	{
		$comercio_id = $this->comercio_id;
		$this->reset();
		$this->comercio_id = $comercio_id;

		$this->showEditModal = true;

		$this->pedido = $pedido;

		$this->state = $pedido->toArray();

		$this->dispatchBrowserEvent('show-form');
	}

	public function updatePedido()
	{
		$validatedData = Validator::make($this->state, [
			'pedido' => 'required',
            'description' => 'nullable',
            'cedula' => 'required',
            'coste'  => 'required',
            'in_delivery' => 'nullable',
		])->validate();

        $validatedData['comercio_id'] = $this->comercio_id;
		$this->pedido->update($validatedData);

		$this->dispatchBrowserEvent('hide-form', ['message' => 'Pedido actualizado satisfactoriamente!']);
	}

	public function confirmPedidoRemoval($pedidoId)
	{
		$this->pedidoIdBeingRemoved = $pedidoId;

		$this->dispatchBrowserEvent('show-delete-modal');
	}

	public function deletePedido()
	{
		$pedido = Pedido::findOrFail($this->pedidoIdBeingRemoved);

		$pedido->delete();

		$this->dispatchBrowserEvent('hide-delete-modal', ['message' => 'Pedido eliminado satisfactoriamente!']);
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
		
    	$pedidos = Pedido::query()
    		->where('comercio_id', $this->comercio_id)
            ->orWhere('reference', 'like', '%'.$this->searchTerm.'%')
            ->orderBy($this->sortColumnName, $this->sortDirection)
            ->paginate(15);

            $comercio = Comercio::find($this->comercio_id);

        return view('livewire.afiliado.list-pedidos-delivery', [
        	'pedidos' => $pedidos,
            'comercio' => $comercio,
        ]);
    }
}
