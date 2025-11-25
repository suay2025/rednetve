<?php

namespace App\Http\Livewire\Afiliado;

use App\Http\Livewire\Admin\AdminComponent;

use App\Models\User;
use App\Models\Comercio;
use App\Models\Area;
use App\Models\ValoracionComercio;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;

class ListComercios extends AdminComponent
{
	use WithFileUploads;

	public $state = [];

	public $comercio;

	public $showEditModal = false;

	public $comercioIdBeingRemoved = null;

	public $searchTerm = null;

    protected $queryString = ['searchTerm' => ['except' => '']];

    public $sortColumnName = 'created_at';

    public $sortDirection = 'desc';

    public $user_id = 0;

	public $photo;

	public $banner;

	protected $listeners = [
		'generarKeyword'
   		];

    public function mount($userId = 0)
    {
        $this->user_id = $userId;
    }

	public function changeRole(Comercio $comercio, $status)
	{
		Validator::make(['status' => $status], [
			'status' => [
				'required',
				Rule::in(User::ROLE_ACTIVE, User::ROLE_NOACTIVE),
			],
		])->validate();

		$comercio->update(['status' => $status]);

		$this->dispatchBrowserEvent('updated', ['message' => "Estado cambió a {$role} satisfactoriamente."]);
	}

	public function addNew()
	{   
        $user_id = $this->user_id;

		$this->reset();

        $this->user_id = $user_id;

		$this->showEditModal = false;

		$this->dispatchBrowserEvent('show-form');
	}

	public function generarKeyword($name)
	{
		$this->state['keyword'] = strtolower(str_replace(' ', '', $this->state['name']));

		$this->dispatchBrowserEvent('getKeyword', ['keyword' => $this->state['keyword']]);		

	}

	public function createComercio()
	{
		$validatedData = Validator::make($this->state, [
			'area_id'=> 'required|not_in:0',
			'name' => 'required',
			'cellphonecontact' => 'nullable',
			'horario' => 'required',
		])->validate();

		if ($this->photo) {
			// $validatedData['avatar'] = $this->photo->store('/', 'avatarscomercios');
			$filename = $validatedData['name'].'_'.date("YmdHis");			
			$validatedData['avatar'] = $this->photo->storeAs(null,
                $filename . '.png', 'avatarscomercios'
            );            
		}

		if ($this->banner) {
			$filename = $validatedData['name'].'_banner_'.date("YmdHis");			
			$validatedData['banner'] = $this->photo->storeAs(null,
                $filename . '.png', 'bannerscomercios'
            );            
		}

		// resize image

        $validatedData['user_id'] = $this->user_id;

		$validatedData['keyword'] = $this->state['keyword'];

		Comercio::create($validatedData);

		// session()->flash('message', 'User added successfully!');

		$this->dispatchBrowserEvent('hide-form', ['message' => 'Comercio agregado satisfactoriamente!']);

		$this->dispatchBrowserEvent('refreshPage', ['message' => 'Refresh pagina!']);  
	}

	public function edit(Comercio $comercio)
	{
		$user_id = $this->user_id;

		$this->reset();

        $this->user_id = $user_id;

		$this->showEditModal = true;

		$this->comercio = $comercio;

		$this->state = $comercio->toArray();

		// dd($this->state['avatar']);

		$this->dispatchBrowserEvent('show-form');
	}

	public function updateComercio()
	{
		$validatedData = Validator::make($this->state, [
			'name' => 'required',			
			'area_id' => 'required',
			'cellphonecontact' => 'nullable',
			'horario' => 'required',
		])->validate();

		$validatedData['keyword'] = $this->state['keyword'];

		if ($this->photo) {
			// $validatedData['avatar'] = $this->photo->store('/', 'avatarscomercios');
			$filename = $validatedData['name'].'_'.date("YmdHis");
			if (Storage::disk('avatarscomercios')->exists($this->comercio->banner)) {
				Storage::disk('avatarscomercios')->delete($this->comercio->banner);
			}
			$validatedData['avatar'] = $this->photo->storeAs(null,
                $filename . '.png', 'avatarscomercios'
            );            
		}

		if ($this->banner) {
			$filename = $validatedData['name'].'_banner_'.date("YmdHis");	
			
			if (Storage::disk('bannerscomercios')->exists($this->comercio->banner)) {
				Storage::disk('bannerscomercios')->delete($this->comercio->banner);
			}
			$validatedData['banner'] = $this->banner->storeAs(null,
                $filename . '.png', 'bannerscomercios'
            );            
		}

		$this->comercio->update($validatedData);

		$this->dispatchBrowserEvent('hide-form', ['message' => 'Comercio actualizado satisfactoriamente!']);
	}

	public function confirmComercioRemoval($comercioId)
	{
		$this->comercioIdBeingRemoved = $comercioId;

		$this->dispatchBrowserEvent('show-delete-modal');
	}

	public function deleteComercio()
	{
		$comercio = Comercio::findOrFail($this->comercioIdBeingRemoved);

		$comercio->delete();

		$this->dispatchBrowserEvent('hide-delete-modal', ['message' => 'Comercio eliminado satisfactoriamente!']);

		$this->dispatchBrowserEvent('refreshPage', ['message' => 'Refresh pagina!']);  
		
	}

	public function searchClass($puntuacion)
    {
        switch ($variable) {
            case '1':
                return 'one';
                break;
            case '2':
                return 'two';
                break;
            case '3':
                return 'three';
                break;
            case '4':
                return 'four';
                break;
            case '5':
                return 'five';
                break;
        }
    }

	public function valorar($comercio_id, $puntuacion)
	{
		$valoracion = ValoracionComercio::where('user_id', auth()->user()->id)->where('comercio_id', $comercio_id)->first();
		if($valoracion){
			$valoracion->update(['ca_valoracion' => $puntuacion, 'class' => 'star',]);
		}else{
			ValoracionComercio::create([
				'user_id' => auth()->user()->id,
				'comercio_id' => $comercio_id,
				'ca_valoracion' => $puntuacion,
				'class' => $this->searchClass($puntuacion),
				'comment' => '',
			]);
		}

		$this->dispatchBrowserEvent('hide-delete-modal', ['message' => 'Valoración actualizada satisfactoriamente!']);
		// $this->dispatchBrowserEvent('updateStar', ['comercio_id' => $comercio_id, 'puntuacion' => $puntuacion, 'class' => $class,]);
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
        if($this->user_id == 1 ){
            $comercios = Comercio::query();
        }else{
            $comercios = Comercio::query()
                ->where('user_id', $this->user_id);
        }
        
    	$comercios = $comercios
            ->where(function($q){
                $q->where('name', 'like', '%'.$this->searchTerm.'%');                
            })
    		->orderBy($this->sortColumnName, $this->sortDirection)
            ->paginate(15);
        
        $user = User::find($this->user_id);

		$areas = Area::all();
		
        return view('livewire.afiliado.list-comercios', [
            'user'  => $user,
			'areas'  => $areas,
        	'comercios' => $comercios,
        ]);
    }
}
