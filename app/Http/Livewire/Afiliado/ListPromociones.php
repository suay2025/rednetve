<?php

namespace App\Http\Livewire\Afiliado;

use App\Http\Livewire\Admin\AdminComponent;
use App\Models\Promocion;
use App\Models\Comercio;
use App\Models\Product;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;

class ListPromociones extends AdminComponent
{
	use WithFileUploads;

	public $state = [];

	public $comercio;
    public $product;
    public $comercios = [], $products = [];

	protected $rules = [
        'comercio' => 'required|not_in:0',
        'product' => 'required|not_in:0',
    ];

	public $promocion;

	public $showEditModal = false;

	public $promocionIdBeingRemoved = null;

	public $searchTerm = null;

    protected $queryString = ['searchTerm' => ['except' => '']];

    public $sortColumnName = 'created_at';

    public $sortDirection = 'desc';

    public $photo;

	public function updatedComercio($value)
	{
		$this->products = Product::where('comercio_id', $value)->get();
		$this->product = $this->products->first()->id ?? null;
	}

    public function mount()
    {
    }

    public function addNew()
	{
		$this->reset();

		$this->comercios = Comercio::all();

		$this->products = collect();
        
		$this->showEditModal = false;

        $this->state['active'] = 'active';

		$this->dispatchBrowserEvent('show-form');
	}

	public function createPromocion()
	{
		$validatedData = Validator::make($this->state, [
            'title' => 'required',
			'order' => 'required',
            'active' => 'required',
		])->validate();

        if ($this->photo) {
			$validatedData['avatar'] = $this->photo->store('/', 'avatarspromociones');
		}

		$validatedData['comercio_id'] = $this->comercio_id;
		$validatedData['product_id'] = $this->product_id;

		Promocion::create($validatedData);

		// session()->flash('message', 'User added successfully!');

		$this->dispatchBrowserEvent('hide-form', ['message' => 'Promoción agregada satisfactoriamente!']);
	}

	public function edit(Promocion $promocion)
	{
		
		$this->reset();
		
		$this->showEditModal = true;

		$this->promocion = $promocion;

		$this->state = $promocion->toArray();

		$this->comercios = Comercio::all();
        $this->comercio = $this->state['comercio_id'];        
        $this->product = $this->state['product_id'];

		$this->products = Product::where('comercio_id', $this->comercio)->get();

		$this->dispatchBrowserEvent('show-form');
	}

	public function updatePromocion()
	{
		$validatedData = Validator::make($this->state, [
			'title' => 'required',
			'order' => 'required',
            'active' => 'required',
		])->validate();

        if ($this->photo) {
			$validatedData['avatar'] = $this->photo->store('/', 'avatarspromociones');            
		}

		$this->promocion->update($validatedData);

		$this->dispatchBrowserEvent('hide-form', ['message' => 'Promocion actualizada satisfactoriamente!']);
	}

	public function confirmPromocionRemoval($promocionId)
	{
		$this->promocionIdBeingRemoved = $promocionId;

		$this->dispatchBrowserEvent('show-delete-modal');
	}

	public function deletePromocion()
	{
		$promocion = Promocion::findOrFail($this->promocionIdBeingRemoved);

		$promocion->delete();

		$this->dispatchBrowserEvent('hide-delete-modal', ['message' => 'Promocion eliminada satisfactoriamente!']);
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
    	$promociones = Promocion::query()
    		->orderBy($this->sortColumnName, $this->sortDirection)
            ->paginate(15);

        return view('livewire.afiliado.list-promociones', [
        	'promociones' => $promociones,
        ]);
    }
}
