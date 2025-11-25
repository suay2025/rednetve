<?php

namespace App\Http\Livewire\Afiliado;

use App\Http\Livewire\Admin\AdminComponent;
use App\Models\User;
use App\Models\Comercio;
use App\Models\Category;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;

class ListCategories extends AdminComponent
{
    use WithFileUploads;
    
	public $state = [];

	public $category;

	public $showEditModal = false;

	public $categoryIdBeingRemoved = null;

	public $searchTerm = null;

    protected $queryString = ['searchTerm' => ['except' => '']];

    public $sortColumnName = 'created_at';

    public $sortDirection = 'desc';

    public $userId = 0;
    public $comercioId = 0;
    public $categoryId = 0;
    public $photo;

    public function mount($comercioId = 0)
    {
        $this->comercioId = $comercioId;
        if($comercioId > 0){
            $comercio = Comercio::find($comercioId);
            $this->userId = $comercio->user_id;
        }
        
    }

	public function changeMenu(Category $categoria, $status)
	{
		$categoria->update(['itemMenu' => $status]);

        $seleccion = 'NO';
        if($status == '1'){
            $seleccion = 'SI';
        }
		$this->dispatchBrowserEvent('updated', ['message' => "La selección cambió a {$seleccion} satisfactoriamente."]);
	}

	public function addNew()
	{   
        $categoryId = $this->categoryId;
        $userId = $this->userId;
        $comercioId = $this->comercioId;

		$this->reset();

        $this->categoryId = $categoryId;
        $this->userId = $userId;
        $this->comercioId = $comercioId;

        $this->state['itemMenu'] = '0';

		$this->showEditModal = false;

		$this->dispatchBrowserEvent('show-form');
	}

	public function createCategory()
	{
		$validatedData = Validator::make($this->state, [
			'name' => 'required',
            'itemMenu' => 'required',
		])->validate();
        
        if($this->userId == 0){
            dd('Usuario no existente Id=0');
        }
        $validatedData['user_id'] = $this->userId;
        $validatedData['comercio_id'] = $this->comercioId;

        if ($this->photo) {
			$validatedData['avatar'] = $this->photo->store('/', 'avatarscategories');
		}

        $nro = Category::where('user_id', $this->userId)->count();
        
        $validatedData['posicionMenu'] = $nro+1;

		Category::create($validatedData);

		// session()->flash('message', 'User added successfully!');

		$this->dispatchBrowserEvent('hide-form', ['message' => 'Categoría agregada satisfactoriamente!']);
	}

	public function edit(Category $category)
	{
		$categoryId = $this->categoryId;
        $userId = $this->userId;
        $comercioId = $this->comercioId;

		$this->reset();

        $this->categoryId = $categoryId;
        $this->userId = $userId;
        $this->comercioId = $comercioId;

		$this->showEditModal = true;

		$this->category = $category;

		$this->state = $category->toArray();

		$this->dispatchBrowserEvent('show-form');
	}

	public function updateCategory()
	{
		$validatedData = Validator::make($this->state, [
			'name' => 'required',
            'itemMenu' => 'required',
		])->validate();

        if ($this->photo) {
			if (Storage::disk('avatarscategories')->exists($this->category->avatar)) {
				Storage::disk('avatarscategories')->delete($this->category->avatar);
			}
            $validatedData['avatar'] = $this->photo->store('/', 'avatarscategories');
		}

		$this->category->update($validatedData);

		$this->dispatchBrowserEvent('hide-form', ['message' => 'Categoría actualizada satisfactoriamente!']);
	}

	public function confirmCategoryRemoval($categoryId)
	{
		$this->categoryIdBeingRemoved = $categoryId;

		$this->dispatchBrowserEvent('show-delete-modal');
	}

	public function deleteCategory()
	{
		$category = Category::findOrFail($this->categoryIdBeingRemoved);

		$category->delete();

		$this->dispatchBrowserEvent('hide-delete-modal', ['message' => 'Categoría eliminada satisfactoriamente!']);
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
        if($this->comercioId == 0 ){
            $categories = Category::query();
        }else{
            $categories = Category::query()
                ->where('comercio_id', $this->comercioId);
        }
        
    	$categories = $categories
            ->where(function($q){
                $q->where('name', 'like', '%'.$this->searchTerm.'%');                
            })
    		->orderBy($this->sortColumnName, $this->sortDirection)
            ->paginate(15);
        
        $comercio = Comercio::find($this->comercioId);
		
        return view('livewire.afiliado.list-categories', [
            'comercio'  => $comercio,
        	'categories' => $categories,
        ]);
    }
}
