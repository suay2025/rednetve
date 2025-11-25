<?php

namespace App\Http\Livewire\Afiliado;

use App\Http\Livewire\Admin\AdminComponent;
use App\Models\User;
use App\Models\Comercio;
use App\Models\Manufacturer;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ListManufacturers extends AdminComponent
{
    use WithFileUploads;

	public $state = [];

    public $photo;

	public $manufacturer;

	public $showEditModal = false;

	public $manufacturerIdBeingRemoved = null;

	public $searchTerm = null;

    protected $queryString = ['searchTerm' => ['except' => '']];

    public $sortColumnName = 'created_at';

    public $sortDirection = 'desc';

    public $user_id= 0;
    public $area_id= 0;
    public $comercio_id = 0;
    public $manufacturer_id = 0;

    public function mount($comercioId = 0)
    {
        $this->comercio_id = $comercioId;
        if($comercioId > 0){
            $comercio = Comercio::find($comercioId);
            $this->user_id = $comercio->user_id;
            $this->area_id = $comercio->area_id;
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

	public function createManufacturer()
	{
		$validatedData = Validator::make($this->state, [
			'name' => 'required',
            'mercado' => 'nullable',
            'address' => 'nullable',
		])->validate();

        if ($this->photo) {
			$validatedData['avatar'] = $this->photo->store('/', 'avatarsmanufacturers');
		}
        
        $validatedData['user_id'] = $this->user_id;
        $validatedData['area_id'] = $this->area_id;
        $validatedData['comercio_id'] = $this->comercio_id;

        Manufacturer::create($validatedData);

		// session()->flash('message', 'User added successfully!');

		$this->dispatchBrowserEvent('hide-form', ['message' => 'Fabricante agregado satisfactoriamente!']);
	}

	public function edit(Manufacturer $manufacturer)
	{
		$user_id = $this->user_id;
        $comercio_id = $this->comercio_id;

		$this->reset();

        $this->user_id = $user_id;
        $this->comercio_id = $comercio_id;

		$this->showEditModal = true;

		$this->manufacturer = $manufacturer;

		$this->state = $manufacturer->toArray();

		$this->dispatchBrowserEvent('show-form');
	}

	public function updateManufacturer()
	{
		$validatedData = Validator::make($this->state, [
			'name' => 'required',
            'address' => 'nullable',
            'mercado' => 'nullable',
		])->validate();

        if ($this->photo) {
			$validatedData['avatar'] = $this->photo->store('/', 'avatarsmanufacturers');
		}

		$this->manufacturer->update($validatedData);

		$this->dispatchBrowserEvent('hide-form', ['message' => 'Fabricante actualizado satisfactoriamente!']);
	}

	public function confirmManufacturerRemoval($manufacturer_id)
	{
		$this->manufacturerIdBeingRemoved = $manufacturer_id;

		$this->dispatchBrowserEvent('show-delete-modal');
	}

	public function deleteManufacturer()
	{
		$manufacturer = Manufacturer::findOrFail($this->manufacturerIdBeingRemoved);

		$manufacturer->delete();

		$this->dispatchBrowserEvent('hide-delete-modal', ['message' => 'Fabricante eliminado satisfactoriamente!']);
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
        if($this->comercio_id == 0 ){
            $manufacturers = Manufacturer::query();
        }else{
            $manufacturers = Manufacturer::query()
                ->where('comercio_id', $this->comercio_id);
        }
        
    	$manufacturers = $manufacturers
            ->where(function($q){
                $q->where('name', 'like', '%'.$this->searchTerm.'%');                
            })
    		->orderBy($this->sortColumnName, $this->sortDirection)
            ->paginate(15);
        
        $comercio = Comercio::find($this->comercio_id);
		
        return view('livewire.afiliado.list-manufacturers', [
            'comercio'  => $comercio,
        	'manufacturers' => $manufacturers,
        ]);
    }
}
