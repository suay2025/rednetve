<?php

namespace App\Http\Livewire\Afiliado\Repuestoexpres;

use App\Http\Livewire\Admin\AdminComponent;

use App\Models\User;
use App\Models\Comercio;
use App\Models\Manufacturer;
use App\Models\Modelo;
use App\Models\Motor;
use App\Models\Vehiculo;
use App\Models\ComercioVehiculo;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;

class ListClients extends AdminComponent
{
	use WithFileUploads;

	public $state = [];

	public $user;

	public $showEditModal = false;

	public $userIdBeingRemoved = null;

	public $searchTerm = null;

    protected $queryString = ['searchTerm' => ['except' => '']];

	public $photo;

    public $sortColumnName = 'created_at';

    public $sortDirection = 'desc';

	public $comercio_id;

	public $user_id;

	#[Validate]
	public $manufacturer;
	public function rules()
    {
        return [
            'manufacturer' => 'required|not_in:0',
			'modelo' => 'required|not_in:0',
			'motor' => 'required|not_in:0',
        ];
    }

    public function messages() 
    {
        return [
            'manufacturer.required' => 'Debe seleccionar una opcion.',
			'modelo.required' => 'Debe seleccionar una opcion.',
			'motor.required' => 'Debe seleccionar una opcion.',
			'placa.required' => 'Debe ingresar un Placa.',
        ];
    }
   
    public $modelo;
    public $motor;
	public $manufacturers = [], $modelos = [], $motores = [];

	public $manufacturer_id = 0;
	public $modelo_id = 0; 
	public $motor_id = 0;

	public function mount($comercioId = 1, $manufacturer_id = 0, $modelo_id = 0, $motor_id = 0)
	{
		$this->comercio_id = $comercioId;

		$this->manufacturer = 0;
		$this->modelo = 0;
		$this->motor = 0;

		$this->manufacturers = collect();

		$this->modelos = collect();

		$this->motores = collect();

	}

	public function addNew()
	{
		$comercio_id = $this->comercio_id;
		$this->reset();
		$this->manufacturers = collect();

		$this->modelos = collect();

		$this->motores = collect();

		$this->comercio_id = $comercio_id;

		$this->showEditModal = false;

		$this->state['role'] = 'cliente';

		$this->dispatchBrowserEvent('show-form');
	}

	public function createUser()
	{
		$validatedData = Validator::make($this->state, [
			'name' => 'required',
			'email' => 'required|email|unique:users',
			'password' => 'required|confirmed',
			'role' => 'required',
			'identificationNac' => 'required',
			'identificationNumber' => 'required',
		])->validate();

		$validatedData['password'] = bcrypt($validatedData['password']);

		if ($this->photo) {
			$validatedData['avatar'] = $this->photo->store('/', 'avatars');
		}

		$user = User::create($validatedData);

		$datosbasicos = DatosBasicos::create(['user_id' => $user->id]);

		// session()->flash('message', 'User added successfully!');

		$this->dispatchBrowserEvent('hide-form', ['message' => 'Usuario agregado satisfactoriamente!']);
	}

	public function edit(User $user)
	{
		$this->reset();

		$this->showEditModal = true;

		$this->user = $user;

		$this->state = $user->toArray();

		$this->dispatchBrowserEvent('show-form');
	}

	public function updateUser()
	{
		$validatedData = Validator::make($this->state, [
			'name' => 'required',
			'email' => 'required|email|unique:users,email,'.$this->user->id,
			'password' => 'sometimes|confirmed',
			'role' => 'required',
			'identificationNac' => 'required',
			'identificationNumber' => 'required',
		])->validate();

		if(!empty($validatedData['password'])) {
			$validatedData['password'] = bcrypt($validatedData['password']);
		}

		if ($this->photo) {
			Storage::disk('avatars')->delete($this->user->avatar);
			$validatedData['avatar'] = $this->photo->store('/', 'avatars');
		}

		$this->user->update($validatedData);

		$this->dispatchBrowserEvent('hide-form', ['message' => 'Usuario actualizado satisfactoriamente!']);
	}

	public function confirmUserRemoval($userId)
	{
		$this->userIdBeingRemoved = $userId;

		$this->dispatchBrowserEvent('show-delete-modal');
	}

	public function deleteUser()
	{
		$user = User::findOrFail($this->userIdBeingRemoved);

		$user->delete();

		$this->dispatchBrowserEvent('hide-delete-modal', ['message' => 'Usuario eliminado satisfactoriamente!']);
	}

	public function addNewVehiculo($user_id)
	{
		$comercio_id = $this->comercio_id;
		$this->reset();
		$this->comercio_id = $comercio_id;
		$this->user_id = $user_id;
		
		$this->modelos = collect();

		$this->motores = collect();

		$this->showEditModal = false;

		$this->dispatchBrowserEvent('show-formVehiculo');

	}

	public function createVehiculo()
	{
		
		$this->validate();

		$validatedData['manufacturer_id'] = $this->manufacturer;
		$validatedData['modelo_id'] = $this->modelo;
		$validatedData['motor_id'] = $this->motor;

		$validatedData['user_id'] = $this->user_id;

		$vehiculo = Vehiculo::create($validatedData);

		ComercioVehiculo::create([
			'user_id' => $this->user_id,
			'vehiculo_id' => $vehiculo->id,
			'comercio_id' => $this->comercio_id,
		]);

		// session()->flash('message', 'User added successfully!');

		$this->dispatchBrowserEvent('hide-formVehiculo', ['message' => 'Vehículo agregado satisfactoriamente!']);
	}

	public function confirmVehiculo($vehiculo_id)
	{

	}

	public function updatedManufacturer($value)
	{
        $this->manufacturer_id = $value;
		$this->modelos = Modelo::where('manufacturer_id', $value)->get();
		// $this->subcategory = $this->subcategories->first()->id ?? null;
        $this->emit('receiveManufacturerS', $value);

        $this->updatedModelo(0);
	}

    public function updatedModelo($value)
	{
        $this->modelo_id = $value;
		$this->motores = Motor::where('manufacturer_id', $this->manufacturer_id)->where('modelo_id', $value)->get();
		// $this->subcategory = $this->subcategories->first()->id ?? null;
        $this->emit('receiveModeloS', $value);
	}

    public function updatedMotor($value)
	{
        $this->emit('receiveMotorS', $value);
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
    	$users = User::query()
    		->where('name', 'like', '%'.$this->searchTerm.'%')
    		->orWhere('email', 'like', '%'.$this->searchTerm.'%')
            ->orderBy($this->sortColumnName, $this->sortDirection)
            ->paginate(15);
		
		$comercio = Comercio::find($this->comercio_id)->first();

		$this->manufacturers = Manufacturer::where('comercio_id', $this->comercio_id)->get();

        return view('livewire.afiliado.repuestoexpres.list-clients', [
        	'users' => $users,
			'comercio' => $comercio,
        ]);
    }
}
