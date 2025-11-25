<?php

namespace App\Http\Livewire\Afiliado;

use App\Http\Livewire\Admin\AdminComponent;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

use App\Models\DeliveryArea;
use App\Models\Comercio;
use App\Models\Country;
use App\Models\Estado;
use App\Models\Cities;

class ListDeliveryArea extends AdminComponent
{

	public $state = [];

    public $country = 237;
    public $province;
    public $city;
    public $countries = [], $provinces = [], $cities = [];

	public $zone;

	public $comercio_id;

	public $showEditModal = false;

	public $zoneIdBeingRemoved = null;

	public $searchTerm = null;

    protected $queryString = ['searchTerm' => ['except' => '']];

    public $sortColumnName = 'created_at';

    public $sortDirection = 'desc';

    public function mount($comercioId)
    {
    	$this->comercio_id = $comercioId;

        $this->provinces = collect();
        $this->cities = collect();

        $this->countries = Country::all();

        $this->provinces = Estado::where('country_id', 237)->get();
    	
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

    public function addNew()
	{
		$comercio_id = $this->comercio_id;
		$this->reset();
		$this->comercio_id = $comercio_id;

        $this->cities = collect();
        $this->countries = Country::all();
        $this->provinces = Estado::where('country_id', 237)->get();

		$this->showEditModal = false;

		$this->dispatchBrowserEvent('show-form');
	}

	public function createZona()
	{
		$validatedData = Validator::make($this->state, [
			'name' => 'required',
            'distance' => 'required',
            'coste' => 'required',
		])->validate();
        
        $validatedData['country_id']=$this->country;
        $validatedData['state_id']=$this->province;
        $validatedData['city_id']=$this->city;
		$validatedData['comercio_id']=$this->comercio_id;

		DeliveryArea::create($validatedData);

		// session()->flash('message', 'User added successfully!');

		$this->dispatchBrowserEvent('hide-form', ['message' => 'Zona agregada satisfactoriamente!']);
	}

	public function edit(DeliveryArea $zone)
	{
		$comercio_id = $this->comercio_id;
		$this->reset();
		$this->comercio_id = $comercio_id;

        $this->showEditModal = true;

		$this->zone = $zone;

		$this->state = $zone->toArray();

        $this->countries = Country::all();
        $this->country = $this->state['country_id'];
        $this->provinces = Estado::where('country_id', $this->country)->get();
        $this->province = $this->state['state_id'];
        $this->cities = Cities::where('state_id', $this->province)->get();
        $this->city = $this->state['city_id'];
        

		$this->dispatchBrowserEvent('show-form');
	}

	public function updateZona()
	{
		$validatedData = Validator::make($this->state, [
			'name' => 'required',
            'distance' => 'required',
            'coste' => 'required',
		])->validate();

        $validatedData['country_id']=$this->country;
        $validatedData['state_id']=$this->province;
        $validatedData['city_id']=$this->city;

		$this->zone->update($validatedData);

		$this->dispatchBrowserEvent('hide-form', ['message' => 'Zona actualizada satisfactoriamente!']);
	}

	public function confirmZonaRemoval($zoneId)
	{
		$this->zoneIdBeingRemoved = $zoneId;

		$this->dispatchBrowserEvent('show-delete-modal');
	}

	public function deleteZona()
	{
		$zone = DeliveryArea::findOrFail($this->zoneIdBeingRemoved);

		$zone->delete();

		$this->dispatchBrowserEvent('hide-delete-modal', ['message' => 'Zona eliminada satisfactoriamente!']);
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
    	$zonas = DeliveryArea::query()
    		->where('comercio_id', $this->comercio_id)
            ->orderBy($this->sortColumnName, $this->sortDirection)
            ->paginate(15);

            $comercio = Comercio::find($this->comercio_id);

        return view('livewire.afiliado.list-delivery-area', [
        	'zonas' => $zonas,
            'user' => auth()->user(),
            'comercio' => $comercio,
        ]);
    }
}
