<?php

namespace App\Http\Livewire\Cliente;

use App\Http\Livewire\Admin\AdminComponent;
use App\Http\Livewire\Notificacion\EmailController;
use App\Models\User;
use App\Models\Pedido;
use App\Models\Comercio;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;

class ListPedidosCliente extends AdminComponent
{
	use WithFileUploads;

	public $state = [];

	public $pedido;

	public $comercioId;

	public $showEditModal = false;

	public $containerIdBeingRemoved = null;

	public $searchTerm = null;

    protected $queryString = ['searchTerm' => ['except' => '']];

    public $sortColumnName = 'created_at';

    public $sortDirection = 'desc';

	public $currencyValue = 'Bs';

    public function mount()
    {
		$this->currencyValue = request()->cookie('currency');
    }

	public function sendNotificacion(Pedido $pedido )
	{
		$notificacion = new EmailController();

        $notificacion->sendEmail('compra', auth()->user(), $pedido->nropedido);

	}

	public function changeConfirmation(Pedido $pedido, $confirmed)
	{
		Validator::make(['confirmed' => $confirmed], [
			'confirmed' => [
				'required',
				Rule::in(Pedido::CONFIRMED, Pedido::NOTCONFIRMED),
			],
		])->validate();

		$pedido->update(['confirmed' => $confirmed]);

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
		$comercioId = $this->comercioId;
		$this->reset();
		$this->comercioId = $comercioId;

		$this->currencyValue = request()->cookie('currency');

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
        
		$validatedData['comercio_id']=$this->comercioId;

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
		$comercioId = $this->comercioId;
		$this->reset();
		$this->comercioId = $comercioId;

		$this->currencyValue = request()->cookie('currency');

		$this->showEditModal = true;

		$this->pedido = $pedido;

		$this->state = $pedido->toArray();

		$this->dispatchBrowserEvent('show-form');
	}

	public function updatePedido()
	{
		$validatedData = Validator::make($this->state, [
			'reference' => 'required',
		])->validate();

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
    		->where('user_id', auth()->user()->id)
            ->orWhere('reference', 'like', '%'.$this->searchTerm.'%')
            ->orderBy($this->sortColumnName, $this->sortDirection)
            ->paginate(15);

        return view('livewire.cliente.list-pedidos-cliente', [
        	'pedidos' => $pedidos,
        ]);
    }
}
