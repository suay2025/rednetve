<?php

namespace App\Http\Livewire\Afiliado\RepuestoExpres;

use App\Http\Livewire\Admin\AdminComponent;
use App\Models\User;
use App\Models\Comercio;
use App\Models\Impuesto;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ListImpuestos extends AdminComponent
{

	public $state = [];

	public $impuesto;

	public $showEditModal = false;

	public $impuestoIdBeingRemoved = null;

	public $searchTerm = null;

    protected $queryString = ['searchTerm' => ['except' => '']];

    public $sortColumnName = 'created_at';

    public $sortDirection = 'desc';

    public $user_id = 1;
    public $comercio_id = 1;
    public $menu_id = 0;

    public function mount($comercioId = 1)
    {
        $this->comercio_id = $comercioId;
        if($comercioId > 0){
            $comercio = Comercio::find($comercioId);
            $this->user_id = $comercio->user_id;
        }
        
    }

	public function addNew()
	{   
        $user_id = $this->user_id;
        $comercio_id = $this->comercio_id;

		$this->reset();

        $this->user_id = $user_id;
        $this->comercio_id = $comercio_id;

        $this->state['itemMenu'] = '0';

		$this->showEditModal = false;

		$this->dispatchBrowserEvent('show-form');
	}

	public function createImpuesto()
	{
		$validatedData = Validator::make($this->state, [
			'name' => 'required',
            'amount' => 'required',
		])->validate();
        
        if($this->user_id == 0){
            dd('Usuario no existente Id=0');
        }
        $validatedData['comercio_id'] = $this->comercio_id;

        Impuesto::create($validatedData);

		// session()->flash('message', 'User added successfully!');

		$this->dispatchBrowserEvent('hide-form', ['message' => 'Impuestos agregado satisfactoriamente!']);
	}

	public function edit(Impueto $impuesto)
	{
		$user_id = $this->user_id;
        $comercio_id = $this->comercio_id;

		$this->reset();

        $this->user_id = $user_id;
        $this->comercio_id = $comercio_id;

		$this->showEditModal = true;

		$this->impuesto = $impuesto;

		$this->state = $impuesto->toArray();

		$this->dispatchBrowserEvent('show-form');
	}

	public function updateImpuesto()
	{
		$validatedData = Validator::make($this->state, [
			'name' => 'required',
            'amount' => 'required',
		])->validate();

		$this->impuesto->update($validatedData);

		$this->dispatchBrowserEvent('hide-form', ['message' => 'Impuesto actualizado satisfactoriamente!']);
	}

	public function confirmImpuestoRemoval($impuestoId)
	{
		$this->impuestoIdBeingRemoved = $impuestoId;

		$this->dispatchBrowserEvent('show-delete-modal');
	}

	public function deleteImpuesto()
	{
		$impuesto = Impusto::findOrFail($this->impuestoIdBeingRemoved);

		$impuesto->delete();

		$this->dispatchBrowserEvent('hide-delete-modal', ['message' => 'Impuesto eliminado satisfactoriamente!']);
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
        if($this->comercio_id == 1 ){
            $impuestos = Impuesto::query();
        }else{
            $impuestos = Impuesto::query()
                ->where('comercio_id', $this->comercio_id);
        }
        
    	$impuestos = $impuestos
            ->where(function($q){
                $q->where('name', 'like', '%'.$this->searchTerm.'%');                
            })
    		->orderBy($this->sortColumnName, $this->sortDirection)
            ->paginate(15);
        
        $comercio = Comercio::find($this->comercio_id);
		
        return view('livewire.afiliado.repuestoexpres.list-impuestos', [
            'comercio'  => $comercio,
        	'impuestos' => $impuestos,
        ]);
    }
}
