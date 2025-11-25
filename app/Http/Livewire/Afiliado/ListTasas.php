<?php

namespace App\Http\Livewire\Afiliado;

use App\Http\Livewire\Admin\AdminComponent;
use App\Models\Tasa;
use App\Models\Comercio;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;

class ListTasas extends AdminComponent
{
	use WithFileUploads;

	public $state = [];

	public $tasa;

	public $comercioId;

	public $showEditModal = false;

	public $tasaIdBeingRemoved = null;

	public $searchTerm = null;

    protected $queryString = ['searchTerm' => ['except' => '']];

    public $sortColumnName = 'created_at';

    public $sortDirection = 'desc';

	public $dolar = 1;

    public function mount($comercioId)
    {
    	$this->comercioId = $comercioId;

		$dolar = json_decode(file_get_contents("https://pydolarve.org/api/v1/dollar"), true);

        $dolar = $dolar['monitors']['bcv']['price'];
        if($dolar !==''){
			$this->dolar = $dolar;
		}
        
    	
    }

    public function changeStatus(Tasa $tasa, $status)
	{
		Validator::make(['status' => $status], [
			'status' => [
				'required',
				Rule::in(Tasa::STATUS_ACTIVO, Tasa::STATUS_NOACTIVO),
			],
		])->validate();

		$tasa->update(['status' => $status]);

		$this->dispatchBrowserEvent('updated', ['message' => "Status cambiado a {$status} satisfactoriamente."]);
	}

	public function addNew()
	{
		$comercioId = $this->comercioId;
		$dolar = $this->dolar;
		$this->reset();
		$this->comercioId = $comercioId;
		$this->dolar = $dolar;

		$this->state['tasa'] = $this->dolar;

		$this->showEditModal = false;

		$this->dispatchBrowserEvent('show-form');
	}

	public function createTasa()
	{
		$validatedData = Validator::make($this->state, [
			'tasa' => 'required',
		])->validate();

		$validatedData['comercio_id']=$this->comercioId;

		$validatedData['user_id'] = auth()->user()->id;

		$tasa = Tasa::where('status','activo')->where('comercio_id', $this->comercioId)->first();
		if($tasa){
			$tasa->update(['status'=>'noactivo']);
		}
		$validatedData['tasa'] = str_replace(",", ".", $validatedData['tasa']);
		
		Tasa::create($validatedData);

		// session()->flash('message', 'User added successfully!');

		$this->dispatchBrowserEvent('hide-form', ['message' => 'Tasa agregada satisfactoriamente!']);
	}

	public function edit(Tasa $tasa)
	{
		$comercioId = $this->comercioId;
		$dolar = $this->dolar;
		$this->reset();
		$this->comercioId = $comercioId;
		$this->dolar = $dolar;

		$this->showEditModal = true;

		$this->tasa = $tasa;

		$this->state = $tasa->toArray();

		$this->dispatchBrowserEvent('show-form');
	}

	public function updateTasa()
	{
		$validatedData = Validator::make($this->state, [
			'tasa' => 'required',
		])->validate();

		$this->tasa->update($validatedData);

		$this->dispatchBrowserEvent('hide-form', ['message' => 'Tasa actualizada satisfactoriamente!']);
	}

	public function confirmTasaRemoval($tasaId)
	{
		$this->tasaIdBeingRemoved = $tasaId;

		$this->dispatchBrowserEvent('show-delete-modal');
	}

	public function deleteTasa()
	{
		$tasa = Tasa::findOrFail($this->tasaIdBeingRemoved);

		$tasa->delete();

		$this->dispatchBrowserEvent('hide-delete-modal', ['message' => 'Tasa eliminada satisfactoriamente!']);
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
    	$tasas = Tasa::query()
    		->where('comercio_id', $this->comercioId)
            ->orderBy($this->sortColumnName, $this->sortDirection)
            ->paginate(15);
		
		$comercio = Comercio::find($this->comercioId);

        return view('livewire.afiliado.list-tasas', [
        	'tasas' => $tasas,
        	'comercio'=> $comercio,
        ]);
    }
}
