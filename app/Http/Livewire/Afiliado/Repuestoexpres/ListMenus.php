<?php

namespace App\Http\Livewire\Afiliado\RepuestoExpres;

use App\Http\Livewire\Admin\AdminComponent;
use App\Models\User;
use App\Models\Comercio;
use App\Models\Menu;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ListMenus extends AdminComponent
{

	public $state = [];

	public $menu;

	public $showEditModal = false;

	public $menuIdBeingRemoved = null;

	public $searchTerm = null;

    protected $queryString = ['searchTerm' => ['except' => '']];

    public $sortColumnName = 'created_at';

    public $sortDirection = 'desc';

    public $user_id = 1;
    public $comercio_id = 1;
    public $menu_id = 0;

    public function mount($comercioId = 1)
    {
        $this->comercio_id = $comercioId;
        if($comercioId > 0){
            $comercio = Comercio::find($comercioId);
            $this->user_id = $comercio->user_id;
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

	public function createMenu()
	{
		$validatedData = Validator::make($this->state, [
			'texto' => 'required',
            'ruta' => 'required',
            'posicion' => 'required',
		])->validate();
        
        if($this->user_id == 0){
            dd('Usuario no existente Id=0');
        }
        $validatedData['comercio_id'] = $this->comercio_id;

        $nro = Menu::where('comercio_id', $this->comercio_id)->count();
        
        if($nro > 4)
        {
            $this->dispatchBrowserEvent('hide-form', ['message' => 'Cantidad de item supera lo permitido!']);    
        }
        $validatedData['posicion'] = $nro+1;

		Menu::create($validatedData);

		// session()->flash('message', 'User added successfully!');

		$this->dispatchBrowserEvent('hide-form', ['message' => 'Item agregado satisfactoriamente!']);
	}

	public function edit(Menu $menu)
	{
		$user_id = $this->user_id;
        $comercio_id = $this->comercio_id;

		$this->reset();

        $this->user_id = $user_id;
        $this->comercio_id = $comercio_id;

		$this->showEditModal = true;

		$this->menu = $menu;

		$this->state = $menu->toArray();

		$this->dispatchBrowserEvent('show-form');
	}

	public function updateMenu()
	{
		$validatedData = Validator::make($this->state, [
			'texto' => 'required',
            'ruta' => 'required',
            'posicion' => 'required',
		])->validate();

		$this->menu->update($validatedData);

		$this->dispatchBrowserEvent('hide-form', ['message' => 'Item actualizado satisfactoriamente!']);
	}

	public function confirmMenuRemoval($menuId)
	{
		$this->menuIdBeingRemoved = $menuId;

		$this->dispatchBrowserEvent('show-delete-modal');
	}

	public function deleteMenu()
	{
		$menu = Menu::findOrFail($this->menuIdBeingRemoved);

		$menu->delete();

		$this->dispatchBrowserEvent('hide-delete-modal', ['message' => 'Item eliminado satisfactoriamente!']);
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
        if($this->comercio_id == 1 ){
            $menus = Menu::query();
        }else{
            $menus = Menu::query()
                ->where('comercio_id', $this->comercio_id);
        }
        
    	$menus = $menus
            ->where(function($q){
                $q->where('texto', 'like', '%'.$this->searchTerm.'%');                
            })
    		->orderBy($this->sortColumnName, $this->sortDirection)
            ->paginate(15);
        
        $comercio = Comercio::find($this->comercio_id);
		
        return view('livewire.afiliado.repuestoexpres.list-menus', [
            'comercio'  => $comercio,
        	'menus' => $menus,
        ]);
    }
}
