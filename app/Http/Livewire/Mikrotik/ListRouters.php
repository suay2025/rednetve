<?php

namespace App\Http\Livewire\Mikrotik;

use App\Http\Livewire\Admin\AdminComponent;
use App\Models\Router;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;

class ListRouters extends AdminComponent
{


	use WithFileUploads;

	public $state = [];

	public $router;

	public $showEditModal = false;

	public $routerIdBeingRemoved = null;

	public $searchTerm = null;

    protected $queryString = ['searchTerm' => ['except' => '']];

	public $photo;

    public $sortColumnName = 'created_at';

    public $sortDirection = 'desc';

	public function changeRole(Router $router, $role)
	{
		Validator::make(['role' => $role], [
			'role' => [
				'required',
				Rule::in(Router::ROLE_ADMIN, Router::ROLE_USER, Router::ROLE_CLIENTE, Router::ROLE_AFIL),
			],
		])->validate();

		$user->update(['role' => $role]);

		$this->dispatchBrowserEvent('updated', ['message' => "Rol cambió a {$role} satisfactoriamente."]);
	}

	public function addNew()
	{
		$this->reset();

		$this->showEditModal = false;

		$this->dispatchBrowserEvent('show-form');
	}

	public function createRouter()
	{
		$validatedData = Validator::make($this->state, [
			'identity' => 'required',
			'ip' => 'required',
            'dns' => 'required',
			'macAddress' => 'required',
			'admin' => 'required',
            'password' => 'required',
            'location' => 'required',
		])->validate();

		$validatedData['user_id'] = auth()->user()->id;

		Router::create($validatedData);

		// session()->flash('message', 'User added successfully!');

		$this->dispatchBrowserEvent('hide-form', ['message' => 'Router agregado satisfactoriamente!']);
	}

	public function edit(Router $router)
	{
		$this->reset();

		$this->showEditModal = true;

		$this->router = $router;

		$this->state = $router->toArray();

		$this->dispatchBrowserEvent('show-form');
	}

	public function updateRouter()
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

		$this->dispatchBrowserEvent('hide-form', ['message' => 'Router actualizado satisfactoriamente!']);
	}

	public function confirmRouterRemoval($routerId)
	{
		$this->routerIdBeingRemoved = $routerId;

		$this->dispatchBrowserEvent('show-delete-modal');
	}

	public function deleteRouter()
	{
		$router = Router::findOrFail($this->routerIdBeingRemoved);

		$router->delete();

		$this->dispatchBrowserEvent('hide-delete-modal', ['message' => 'Router eliminado satisfactoriamente!']);
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
        $routers = Router::query();

        if(auth()->user()->role !== 'admin')
        {
            $routers = $routers->where('user_id', auth()->user()->id);
        }

    	$routers = $routers
			->where(function($q){
				$q = $q
					->where('identity', 'like', '%'.$this->searchTerm.'%')
					->orWhere('macAddress', 'like', '%'.$this->searchTerm.'%');
			})
            ->orderBy($this->sortColumnName, $this->sortDirection)
            ->paginate(15);

        return view('livewire.mikrotik.list-routers', [
        	'routers' => $routers,
        ]);
    }

}

