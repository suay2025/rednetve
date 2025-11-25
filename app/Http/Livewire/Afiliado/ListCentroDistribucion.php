<?php

namespace App\Http\Livewire\Afiliado;

use App\Http\Livewire\Admin\AdminComponent;
use App\Models\CentroDistribucion;
use App\Models\Comercio;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;

class ListCentroDistribucion extends AdminComponent
{
	use WithFileUploads;

	public $state = [];

	public $centro;

	public $comercio_id;

	public $showEditModal = false;

	public $centroIdBeingRemoved = null;

	public $searchTerm = null;

    protected $queryString = ['searchTerm' => ['except' => '']];

    public $sortColumnName = 'created_at';

    public $sortDirection = 'desc';

    public function mount($comercioId)
    {
    	$this->comercio_id = $comercioId;
    	
    }

    public function addNew()
	{
		$comercio_id = $this->comercio_id;
		$this->reset();
		$this->comercio_id = $comercio_id;

		$this->showEditModal = false;

		$this->dispatchBrowserEvent('show-form');
	}

	public function createCentro()
	{
		$validatedData = Validator::make($this->state, [
			'address' => 'required',
            'contactphone' => 'required',
            'horario' => 'required',
		])->validate();

		$validatedData['comercio_id']=$this->comercio_id;

		CentroDistribucion::create($validatedData);

		// session()->flash('message', 'User added successfully!');

		$this->dispatchBrowserEvent('hide-form', ['message' => 'Centro de distribución agregado satisfactoriamente!']);
	}

	public function edit(CentroDistribucion $centro)
	{
		$comercio_id = $this->comercio_id;
		$this->reset();
		$this->comercio_id = $comercio_id;

		$this->showEditModal = true;

		$this->centro = $centro;

		$this->state = $centro->toArray();

		$this->dispatchBrowserEvent('show-form');
	}

	public function updateCentro()
	{
		$validatedData = Validator::make($this->state, [
			'address' => 'required',
            'contactphone' => 'required',
            'horario' => 'required',
		])->validate();

		$this->brand->update($validatedData);

		$this->dispatchBrowserEvent('hide-form', ['message' => 'Centro de distribución actualizado satisfactoriamente!']);
	}

	public function confirmCentroRemoval($centroId)
	{
		$this->centroIdBeingRemoved = $centroId;

		$this->dispatchBrowserEvent('show-delete-modal');
	}

	public function deleteCentro()
	{
		$centro = CentroDistribucion::findOrFail($this->$centroIdBeingRemoved);

		$centro->delete();

		$this->dispatchBrowserEvent('hide-delete-modal', ['message' => 'Centro de distribución eliminado satisfactoriamente!']);
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
		
    	$centros = CentroDistribucion::query()
    		->where('comercio_id', $this->comercio_id)
            ->orderBy($this->sortColumnName, $this->sortDirection)
            ->paginate(15);

            $comercio = Comercio::find($this->comercio_id);

        return view('livewire.afiliado.list-centro-distribucion', [
        	'centros' => $centros,
            'comercio' => $comercio,
        ]);
    }
}
