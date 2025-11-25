<?php

namespace App\Http\Livewire\Afiliado;

use App\Http\Livewire\Admin\AdminComponent;
use App\Models\Container;
use App\Models\Comercio;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;

class ListContainers extends AdminComponent
{
	use WithFileUploads;

	public $state = [];

	public $container;

	public $comercioId;

	public $showEditModal = false;

	public $containerIdBeingRemoved = null;

	public $searchTerm = null;

    protected $queryString = ['searchTerm' => ['except' => '']];

    public $sortColumnName = 'created_at';

    public $sortDirection = 'desc';

    public function mount($comercioId)
    {
    	$this->comercioId = $comercioId;
    	
    }

    public function addNew()
	{
		$comercioId = $this->comercioId;
		$this->reset();
		$this->comercioId = $comercioId;

		$this->showEditModal = false;

		$this->dispatchBrowserEvent('show-form');
	}

	public function createContainer()
	{
		$validatedData = Validator::make($this->state, [
			'name' => 'required',
		])->validate();

		$validatedData['comercio_id']=$this->comercioId;

		Container::create($validatedData);

		// session()->flash('message', 'User added successfully!');

		$this->dispatchBrowserEvent('hide-form', ['message' => 'Contenedor agregada satisfactoriamente!']);
	}

	public function edit(Container $container)
	{
		$comercioId = $this->comercioId;
		$this->reset();
		$this->comercioId = $comercioId;

		$this->showEditModal = true;

		$this->container = $container;

		$this->state = $container->toArray();

		$this->dispatchBrowserEvent('show-form');
	}

	public function updateContainer()
	{
		$validatedData = Validator::make($this->state, [
			'name' => 'required',
		])->validate();

		$this->container->update($validatedData);

		$this->dispatchBrowserEvent('hide-form', ['message' => 'Contenedor actualizada satisfactoriamente!']);
	}

	public function confirmContainerRemoval($containerId)
	{
		$this->containerIdBeingRemoved = $containerId;

		$this->dispatchBrowserEvent('show-delete-modal');
	}

	public function deleteContainer()
	{
		$container = Container::findOrFail($this->containerIdBeingRemoved);

		$container->delete();

		$this->dispatchBrowserEvent('hide-delete-modal', ['message' => 'Contenedor eliminada satisfactoriamente!']);
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
		
    	$containers = Container::query()
    		->where('comercio_id', $this->comercioId)
            ->orderBy($this->sortColumnName, $this->sortDirection)
            ->paginate(15);

            $comercio = Comercio::find($this->comercioId);

        return view('livewire.afiliado.list-containers', [
        	'containers' => $containers,
            'comercio' => $comercio,
        ]);
    }
}
