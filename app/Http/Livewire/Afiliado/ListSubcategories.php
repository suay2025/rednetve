<?php

namespace App\Http\Livewire\Afiliado;

use App\Http\Livewire\Admin\AdminComponent;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;
use App\Models\User;
use App\Models\Comercio;
use App\Models\Category;
use App\Models\Subcategory;

class ListSubcategories extends AdminComponent
{
	use WithFileUploads;

	public $state = [];

	public $subcategory;

	public $showEditModal = false;

	public $subcategoryIdBeingRemoved = null;

	public $searchTerm = null;

    protected $queryString = ['searchTerm' => ['except' => '']];

	public $photo;

    public $sortColumnName = 'created_at';

    public $sortDirection = 'desc';

    public $comercio_id, $category_id, $user_id;

    public function mount($comercioId = 1, $categoryId)
    {
        $this->comercio_id = $comercioId;
        $this->category_id = $categoryId;
        if($comercioId > 0){
            $comercio = Comercio::find($comercioId);
			$this->user_id = $comercio->user_id;
        }
    }

	public function changeMenu(Subcategory $category, $itemMenu)
	{

		$category->update(['itemMenu' => $itemMenu]);

		$this->dispatchBrowserEvent('updated', ['message' => "Item Menu cambió a {$itemMenu} satisfactoriamente."]);
	}

	public function addNew()
	{
        $user_id = $this->user_id;
		
        $comercio_id = $this->comercio_id;
        $category_id = $this->category_id;
		$this->reset();
        $this->user_id = $user_id;
        $this->comercio_id = $comercio_id;
        $this->category_id = $category_id;

		$this->showEditModal = false;

		$this->dispatchBrowserEvent('show-form');
	}

	public function createSubcategory()
	{
		$validatedData = Validator::make($this->state, [
			'name' => 'required',
            'itemMenu' => 'required',
		])->validate();
        
        $validatedData['user_id'] = $this->user_id;
        $validatedData['comercio_id'] = $this->comercio_id;
        $validatedData['category_id'] = $this->category_id;
		$validatedData['posicionMenu'] = 0;
		$validatedData['posicionSubmenu'] = 0;

		if ($this->photo) {
			$validatedData['avatar'] = $this->photo->store('/', 'avatarssubcategories');
		}

		Subcategory::create($validatedData);

		// session()->flash('message', 'User added successfully!');

		$this->dispatchBrowserEvent('hide-form', ['message' => 'Subcategoria agregada satisfactoriamente!']);
	}

	public function edit(Subcategory $subcategory)
	{
		$userId = $this->userId;
        $comercioId = $this->comercioId;
        $categoryId = $this->categoryId;
		$this->reset();
        $this->userId = $userId;
        $this->comercioId = $comercioId;
        $this->categoryId = $categoryId;

		$this->showEditModal = true;

		$this->subcategory = $subcategory;

		$this->state = $subcategory->toArray();

		$this->dispatchBrowserEvent('show-form');
	}

	public function updateSubcategory()
	{
		$validatedData = Validator::make($this->state, [
			'name' => 'required',
            'itemMenu' => 'required',
		])->validate();

		if ($this->photo) {
			Storage::disk('avatarssubcategories')->delete($this->subcategory->avatar);
			$validatedData['avatar'] = $this->photo->store('/', 'avatarssubcategories');
		}

		$this->subcategory->update($validatedData);

		$this->dispatchBrowserEvent('hide-form', ['message' => 'Subcategoria actualizada satisfactoriamente!']);
	}

	public function confirmSubcategoryRemoval($subcategoryId)
	{
		$this->subcategoryIdBeingRemoved = $subcategoryId;

		$this->dispatchBrowserEvent('show-delete-modal');
	}

	public function deleteSubcategory()
	{
		$subcategory = Subcategory::findOrFail($this->subcategoryIdBeingRemoved);

		$subcategory->delete();

		$this->dispatchBrowserEvent('hide-delete-modal', ['message' => 'Subcategoria eliminada satisfactoriamente!']);
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
        $subcategories = Subcategory::query();

        if(auth()->user()->role== 'admin')
        {
            
        }else
		{
            $subcategories = $subcategories->where('comercio_id', $this->comercio_id);
        }
		$subcategories = $subcategories
    		->where('category_id', $this->category_id);
    	
		$subcategories = $subcategories
    		->where('name', 'like', '%'.$this->searchTerm.'%')
    		->orderBy($this->sortColumnName, $this->sortDirection)
            ->paginate(15);

        $comercio = Comercio::find($this->comercio_id);
        $category = Category::find($this->category_id);

        return view('livewire.afiliado.list-subcategories', [
            'comercio' => $comercio,
            'category' => $category,
        	'subcategories' => $subcategories,
        ]);
    }
}
