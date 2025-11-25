<?php

namespace App\Http\Livewire\Cliente;

use App\Http\Livewire\Admin\AdminComponent;
use App\Models\User;
use App\Models\DatosBasicos;
use App\Models\Client;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;

class ListClientesComercio extends AdminComponent
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

    public function mount($comercioId = 1)
    {
        $this->comercio_id = $comercioId;
		$this->state['role'] = 'cliente';
    }

	public function changeRole(User $user, $role)
	{
		Validator::make(['role' => $role], [
			'role' => [
				'required',
				Rule::in(User::ROLE_ADMIN, User::ROLE_USER, User::ROLE_CLIENTE, User::ROLE_AFIL),
			],
		])->validate();

		$user->update(['role' => $role]);

		$this->dispatchBrowserEvent('updated', ['message' => "Rol cambió a {$role} satisfactoriamente."]);
	}

	public function addNew()
	{
		$comercio_id = $this->comercio_id;
        $this->reset();
        $this->comercio_id = $comercio_id;

        $this->state['identificationNac'] = "V";

		$this->showEditModal = false;

		$this->dispatchBrowserEvent('show-form');
	}

	public function createUser()
	{
		$validatedData = Validator::make($this->state, [
			'name' => 'required',
            'names' => 'required',
            'surnames' => 'required',
            'identificationNac' => 'required',
            'identificationNumber' => 'required',
			'email' => 'required|email|unique:users',
			'password' => 'required|confirmed',
            'cellphonecode' => 'required',
            'cellphone' => 'required',
		])->validate();

		$validatedData['password'] = bcrypt($validatedData['password']);
		$validatedData['role'] = 'cliente';

		if ($this->photo) {
			$validatedData['avatar'] = $this->photo->store('/', 'avatars');
		}

		$user = User::create($validatedData);

		DatosBasicos::create([
            'user_id' => $user->id,
            'cellphonecode' => $validatedData['cellphonecode'],
            'cellphone' => $validatedData['cellphone'],
        ]);

		Client::create([
            'user_id' => $user->id,
            'comercio_id' => $this->comercio_id,
        ]);

		// session()->flash('message', 'User added successfully!');

		$this->dispatchBrowserEvent('hide-form', ['message' => 'Cliente agregado satisfactoriamente!']);
	}

	public function edit(User $user)
	{
		$comercio_id = $this->comercio_id;
        $this->reset();
        $this->comercio_id = $comercio_id;

		$this->showEditModal = true;

		$this->user = $user;

		$this->state = $user->toArray();

		$this->state['cellphone'] = $user->datosbasicos->cellphone;
		$this->state['cellphonecode'] = $user->datosbasicos->cellphonecode;

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
		$client = Client::findOrFail($this->userIdBeingRemoved);

		$client->delete();

		$this->dispatchBrowserEvent('hide-delete-modal', ['message' => 'Usuario eliminado satisfactoriamente!']);
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

    	$clientes = Client::query()
			->where('comercio_id', $this->comercio_id)
            ->orderBy($this->sortColumnName, $this->sortDirection)
            ->paginate(15);

        return view('livewire.cliente.list-clientes-comercio', [
        	'clientes' => $clientes,
        ]);
    }


}
