<?php

namespace App\Http\Livewire\Afiliado\Repuestoexpres;

use App\Http\Livewire\Admin\AdminComponent;
use App\Models\User;
use App\Models\DatosBasicos;
use App\Models\UserComercio;
use App\Models\Comercio;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;

class ListUsersComercio extends AdminComponent
{
	use WithFileUploads;

	public $state = [];

	public $usercomercio;

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

    }

	public function changeRole(UserComercio $usercomercio, $role)
	{
		Validator::make(['role' => $role], [
			'role' => [
				'required',
				Rule::in(UserComercio::ROLE_ADMINCOMERCIO, UserComercio::ROLE_DELIVERY),
			],
		])->validate();

		$usercomercio->update(['rolecomercio' => $role]);

		$this->dispatchBrowserEvent('updated', ['message' => "Rol cambió a {$role} satisfactoriamente."]);
	}

	public function addNew()
	{
        $comercio_id = $this->comercio_id;
        $this->reset();
        $this->comercio_id = $comercio_id;

        $this->state['identificationNac'] = "V";
		$this->state['vehiculo'] = "0";

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
			'rolecomercio' => 'required',
            'cellphonecode' => 'required',
            'cellphone' => 'required',
            'vehiculo' => 'nullable',
		])->validate();

		$validatedData['password'] = bcrypt($validatedData['password']);

		if ($this->photo) {
			$validatedData['avatar'] = $this->photo->store('/', 'avatars');
		}

		$validatedData['role'] = 'user';
		$user = User::create($validatedData);

        DatosBasicos::create([
            'user_id' => $user->id,
            'cellphonecode' => $validatedData['cellphonecode'],
            'cellphone' => $validatedData['cellphone'],
        ]);

        UserComercio::create([
            'user_id' => $user->id,
            'comercio_id' => $this->comercio_id,
            'rolecomercio' => $validatedData['rolecomercio'],
            'vehiculo' => $validatedData['vehiculo'],
        ]);

		// session()->flash('message', 'User added successfully!');

		$this->dispatchBrowserEvent('hide-form', ['message' => 'Usuario agregado satisfactoriamente!']);
	}

	public function edit(User $usercomercio)
	{
		$this->reset();

		$this->showEditModal = true;

		$this->usercomercio = $usercomercio;

		$this->state = $usercomercio->toArray();

		$this->dispatchBrowserEvent('show-form');
	}

	public function updateUser()
	{
		$validatedData = Validator::make($this->state, [
			'name' => 'required',
            'names' => 'required',
            'surnames' => 'required',
            'identificationNac' => 'required',
            'identificationNumber' => 'required',
			'email' => 'required|email|unique:users',
			'password' => 'required|confirmed',
			'rolecomercio' => 'required',
            'cellphonecode' => 'required',
            'cellphone' => 'required',
            'vehiculo' => 'nullable',
		])->validate();

		if(!empty($validatedData['password'])) {
			$validatedData['password'] = bcrypt($validatedData['password']);
		}

		if ($this->photo) {
			Storage::disk('avatars')->delete($this->user->avatar);
			$validatedData['avatar'] = $this->photo->store('/', 'avatars');
		}

		$this->usercomercio->update([
			'rolecomercio' => $validatedData('rolecomercio'),
		]);

		$user = User::find($this->usercomercio->id);

		$user->update($validatedData);

		$this->dispatchBrowserEvent('hide-form', ['message' => 'Usuario actualizado satisfactoriamente!']);
	}

	public function confirmUserRemoval($userId)
	{
		$this->userIdBeingRemoved = $userId;

		$this->dispatchBrowserEvent('show-delete-modal');
	}

	public function deleteUser()
	{
		$usercomercio = UserComercio::findOrFail($this->userIdBeingRemoved);

		$usercomercio->delete();

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

    	$userscomercio = UserComercio::query()
            ->where('comercio_id', $this->comercio_id)
            ->whereHas('user', function($q){
                $q->where('name', 'like', '%'.$this->searchTerm.'%')
                    ->orWhere('email', 'like', '%'.$this->searchTerm.'%');
            })
    		->orderBy($this->sortColumnName, $this->sortDirection)
            ->paginate(15);
        
        

        return view('livewire.afiliado.repuestoexpres.list-users-comercio', [
        	'users' => $userscomercio,
            'comercio' => Comercio::find($this->comercio_id),
        ]);
    }

	
}
