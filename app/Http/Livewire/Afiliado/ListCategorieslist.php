<?php

namespace App\Http\Livewire\Afiliado;

use App\Http\Livewire\Admin\AdminComponent;
use App\Models\User;
use App\Models\Comercio;
use App\Models\Categorylist;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ListCategorieslist extends AdminComponent
{
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
    public $category_id = 0;

    public $lista;
    public $nivel = 1;
    public $x = 0;

    public function mount($comercioId = 0)
    {
        $this->comercioId = $comercioId;
        if($comercioId > 0){
            $comercio = Comercio::find($comercioId);
            $this->userId = $comercio->user_id;
        }
        
    }

	public function changeMenu(Categorylist $categoria, $status)
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

    public function addNewList($category_id, $categoryname)
	{   
        $categoryId = $this->categoryId;
        $userId = $this->userId;
        $comercioId = $this->comercioId;

		$this->reset();

        $this->category_id = $category_id;
        $this->userId = $userId;
        $this->comercioId = $comercioId;

        $this->state['itemMenu'] = '0';

		$this->showEditModal = false;

		$this->dispatchBrowserEvent('show-formList', ['name' => $categoryname]);
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

        $nro = Categorylist::where('user_id', $this->userId)->count();
        
        $validatedData['posicionMenu'] = $nro+1;

		Categorylist::create($validatedData);

		// session()->flash('message', 'User added successfully!');

		$this->dispatchBrowserEvent('hide-form', ['message' => 'Categoría agregada satisfactoriamente!']);
	}

    public function createCategoryList()
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

        $nro = Categorylist::where('user_id', $this->userId)->count();
        
        $validatedData['posicionMenu'] = $nro+1;

        $category = CategoryList::find($this->category_id);

        $nivel = $category->nivel + 1;

        $validatedData['nivel'] = $nivel;

        $validatedData['point_id'] = $this->category_id;
        
		$category = Categorylist::create($validatedData);

		// session()->flash('message', 'User added successfully!');

		$this->dispatchBrowserEvent('hide-formList', ['message' => 'Categoría agregada satisfactoriamente!']);
	}

	public function edit(Categorylist $category)
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
		$category = Categorylist::findOrFail($this->categoryIdBeingRemoved);

		$category->delete();

		$this->dispatchBrowserEvent('hide-delete-modal', ['message' => 'Categoría eliminada satisfactoriamente!']);
	}

    public function confirmCategoryListRemoval($categoryId, $categoryname)
	{
		$this->categoryIdBeingRemoved = $categoryId;

		$this->dispatchBrowserEvent('show-delete-modalList', ['name' => $categoryname]);
	}

	public function deleteCategoryList()
	{
		$category = Categorylist::findOrFail($this->categoryIdBeingRemoved);

		$category->delete();

		$this->dispatchBrowserEvent('hide-delete-modalList', ['message' => 'Categoría eliminada satisfactoriamente!']);
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

    public function listar(CategoryList $category)
    {       
            $this->lista = array();

            $categoryId = $category->id;

            
                //$this->state = $category->toArray();
            
            
                //$this->lista[]  = $category->only(['id', 'name', 'point_id', 'nivel']);
                //$this->lista[]  = $category->only(['name']);

                $this->list($category->id); //llama recursividad


            //     dd($this->lista);

            if(empty($this->lista)){
                return "";
            }
            else{
                return $this->lista;
            }
        
    }

    public function list($category_id)
    {   

        $lista1 = array();

        $subcats = Categorylist::where('point_id', $category_id)->get();

        foreach($subcats as $subcat)
        {
            
            $this->lista[] = $subcat->only(['id', 'name', 'point_id', 'nivel']);
            
            
            //$this->lista[] = $subcat->only(['name']);

            $retorno = $this->list($subcat->id);
    
            if(!empty($retorno)){
                $this->lista[] = $retorno;
            }
            
        }


        
    }

    public function visualizarListado(CategoryList $category, $listado)
    {                
            $listado = $this->lista;
            if($listado !== ""){
                echo "<ul class='my-2'>";                
                $this->recursivaUl($listado, 0, 1);                
                echo "</ul>";
            }
      
    }

    public function recursivaUl($listado, $x, $nivel)
    {       
        $nivel = 1;
        echo "<ul>";
            for ($i = 0; $i < count($listado); $i++){
                if($listado[$i]['nivel'] == $nivel)
                {                    
                    $this->contenido($listado[$i]['name'], $listado[$i]['id']);
                }else{                
                    if($listado[$i]['nivel'] > $nivel)
                    {
                        echo "<ul>";
                        $this->contenido($listado[$i]['name'], $listado[$i]['id']);
                        $nivel = $nivel + 1;
                    }
                    else{
                        for ($j=0; $j < $nivel; $j++) { 
                            if($listado[$i]['nivel'] !== $nivel)
                            echo "</ul>";
                            $nivel = $nivel - 1;
                        }
                        $this->contenido($listado[$i]['name'], $listado[$i]['id']);                        
                        
                    }
                }
                   
                
            }
        echo "</ul>";
    }

    

    public function contenido($name, $id)
    {   
        echo "<li class='form-control my-1 p-auto h-auto border border-secundary d-flex  justify-content-between'>
            <div class=''>".$name."</div>";
        echo "<div class=''>
                <a class='' href='' wire:click.prevent='addNewList( ".$id.", $name)'>
                    <i class='fa fa-plus-circle'></i>
                </a>";
            echo "<a class='' href='' wire:click.prevent='confirmCategoryListRemoval( ".$id.",'". $name ."')'>
            <i class='fa fa-trash text-danger '></i>
        </a>";
        echo "</div></li>";

        return 0;
    }

    public function render()
    {
        if($this->comercioId == 0 ){
            $categories = Categorylist::query();
        }else{
            $categories = Categorylist::query()
                ->where('comercio_id', $this->comercioId);
        }
        
    	$categories = $categories
            ->where(function($q){
                $q->where('name', 'like', '%'.$this->searchTerm.'%');                
            })
            ->where('nivel', 0)
    		->orderBy($this->sortColumnName, $this->sortDirection)
            ->paginate(15);
        
        $comercio = Comercio::find($this->comercioId);
		
        return view('livewire.afiliado.list-categorieslist', [
            'comercio'  => $comercio,
        	'categories' => $categories,
        ]);
    }
}
