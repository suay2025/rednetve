<?php

namespace App\Http\Livewire\Afiliado;

use Livewire\Attributes\Validate;
use App\Http\Livewire\Admin\AdminComponent;
use App\Models\User;
use App\Models\Comercio;
use App\Models\Product;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\CategoriesProduct;
use App\Models\Valoracion;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;

class ListProducts extends AdminComponent
{
	use WithFileUploads;

	public $state = [];

	public $stateP = [];

	public $product;

	public $showEditModal = false;

	public $productIdBeingRemoved = null;

	public $categoryIdBeingRemoved = null;

	public $searchTerm = null;

    protected $queryString = ['searchTerm' => ['except' => '']];

    public $sortColumnName = 'created_at';

    public $sortDirection = 'desc';

    public $comercio_id = 0;

	public $photo;

	public $screenResolution;

	#[Validate] 
	public $category;
	public function rules()
    {
        return [
            'category' => 'required|not_in:0',
        ];
    }

    public $content = '';
	public $subcategory;
	public $categories = [], $subcategories = [];

	public $product_id = 0;

	protected $listeners = [
		'sendResolution'
   		];

	public function sendResolution($screenResolution){
		$this->screenResolution = $screenResolution;
	}	

    public function mount($comercioId = 1)
    {
        $this->comercio_id = $comercioId;

		$this->categories = Category::where('comercio_id', $this->comercio_id)->get();
		
		$this->subcategories = collect();
    }

	public function updatedCategory($value)
	{
		$this->subcategories = Subcategory::where('category_id', $value)->get();
		// $this->subcategory = $this->subcategories->first()->id ?? null;
	}

	public function changeRole(Comercio $product, $status)
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

	public function changeCategory($categoryId, $subcategory)
	{	
		$subcategories = Subcategory::where('category_id', $categoryId)->get();	

		if(!$subcategories){
			$msg = 'Seleccione una opción';
			$this->state['subcategory_id'] = 0;
		}else{
			$msg = 'No posee Subcategoria';
			$this->state['subcategory_id'] = 0;
		}

		
		$this->dispatchBrowserEvent('sendSubcategories', ['subcategories' => $subcategories, 'subcategory' => $subcategory, 'msg' => $msg]);
	}

	public function addNew()
	{   
        $comercio_id = $this->comercio_id;
		$screenResolution = $this->screenResolution;

		$this->reset();		

        $this->comercio_id = $comercio_id;
		$this->screenResolution = $screenResolution;

		$this->showEditModal = false;

		$editModal = 'false';
		$product_id = 0;
		
		if ($this->screenResolution < 1024) {
			return redirect()->route('newProductRE', ['comercioId' => $this->comercio_id, 'productId' => $product_id, 'editModal' => $editModal] );
			//$this->dispatchBrowserEvent('show-form');	
		}elseif ($this->screenResolution < 1280) {
			return redirect()->route('newProductRE', ['comercioId' => $this->comercio_id, 'productId' => $product_id,  'editModal' => $editModal] );
			//$this->dispatchBrowserEvent('show-form');
		}else {
			return redirect()->route('newProductRE', ['comercioId' => $this->comercio_id, 'productId' => $product_id,  'editModal' => $editModal] );
		}
		
	}

	public function createProduct()
	{
		$validatedData = Validator::make($this->state, [
			'name' => 'required',
            'category_id' => 'required|not_in:0',
            'subcategory_id' => 'nullable',
		])->validate();

		if ($this->photo) {
			$validatedData['avatar'] = $this->photo->store('/', 'avatarsproducts');
		}

        $comercio = Comercio::find($this->comercio_id);

        $validatedData['user_id'] = $comercio->user_id;
        $validatedData['comercio_id'] = $this->comercio_id;

		Product::create($validatedData);

		// session()->flash('message', 'User added successfully!');

		$this->dispatchBrowserEvent('hide-form', ['message' => 'Producto agregado satisfactoriamente!']);
	}

	public function edit($product_id)
	{
		$editModal = 'true';
		
		if ($this->screenResolution < 1024) {
			return redirect()->route('editProductRE', ['comercioId' => $this->comercio_id, 'productId' => $product_id, 'editModal' => $editModal] );
			$this->dispatchBrowserEvent('show-form');	
		}elseif ($this->screenResolution < 1280) {
			return redirect()->route('editProductRE', ['comercioId' => $this->comercio_id, 'productId' => $product_id, 'editModal' => $editModal] );
			$this->dispatchBrowserEvent('show-form');
		}else {
			return redirect()->route('editProductRE', ['comercioId' => $this->comercio_id, 'productId' => $product_id, 'editModal' => $editModal] );
		}

		$comercio_id = $this->comercio_id;

		$this->reset();

        $this->comercio_id = $comercio_id;

		$this->showEditModal = true;

		$this->product = $product;

		$this->state = $product->toArray();

		$subcategory = Subcategory::find($this->state['subcategory_id']);

		$this->changeCategory($this->state['category_id'], $subcategory->name);

		$this->dispatchBrowserEvent('show-form');

		$this->state['subcategory_id'] = $subcategory->id;
	}

	public function updateProduct()
	{
		$validatedData = Validator::make($this->state, [
			'name' => 'required',
            'category_id' => 'required',
            'subcategory_id' => 'required',
		])->validate();

		$filename = $this->state['code'].'-'.$this->comercio_id;

		if ($this->photo) {
			if (Storage::disk('avatarsproducts')->exists($this->product->avatar)) {
				Storage::disk('avatarsproducts')->delete($this->product->avatar);
			}
			//$validatedData['image_path1'] = $this->photo->store('/', 'avatarsproducts');
            $validatedData['image_path1'] = $this->photo->storeAs(null,
                $filename . '-1.png', 'avatarsproducts'
            );
		}

		$this->product->update($validatedData);

		$this->dispatchBrowserEvent('hide-form', ['message' => 'Producto actualizado satisfactoriamente!']);
	}

	public function confirmProductRemoval($product_id)
	{
		$this->productIdBeingRemoved = $product_id;

		$this->dispatchBrowserEvent('show-delete-modal');
	}

	public function deleteProduct()
	{
		$product = Product::findOrFail($this->productIdBeingRemoved);

		$product->delete();

		$this->dispatchBrowserEvent('hide-delete-modal', ['message' => 'Producto eliminado satisfactoriamente!']);
	}

	// Category
	public function addNewCategory($product_id)
	{   
		// dd($product_id);
		if($product_id)
		{
        $comercio_id = $this->comercio_id;
		$screenResolution = $this->screenResolution;
		$prod_id = $this->product_id;

		$this->reset();		

		$this->product_id = $prod_id;
		$this->categories = Category::where('comercio_id', $comercio_id)->get();
		$this->subcategories = collect();
		$this->product_id = $product_id;

        $this->comercio_id = $comercio_id;
		$this->screenResolution = $screenResolution;

		$this->showEditModal = false;

		$editModal = 'false';
		
		$this->dispatchBrowserEvent('show-formCategory');	
		}
		
	}

	public function createCategories()
	{
		// $validatedData = Validator::make($this->state, [
			
		// ])->validate();
		$this->validate();
		$comercio = Comercio::find($this->comercio_id);

        $validatedData['user_id'] = $comercio->user_id;
        $validatedData['comercio_id'] = $this->comercio_id;
		$validatedData['product_id'] = $this->product_id;
		$validatedData['category_id'] = $this->category;
		$validatedData['subcategory_id'] = $this->subcategory;

		if($this->subcategory == 0)
		{
			$validatedData['primary'] = 'primary';
			$validatedData['subcategory_id'] = 0;
		}
		else{
			$validatedData['primary'] = 'secundary';
		}

        // 'order',


		CategoriesProduct::create($validatedData);

		// session()->flash('message', 'User added successfully!');

		$this->dispatchBrowserEvent('hide-formCategory', ['message' => 'Categoria agregada satisfactoriamente!']);
	}

	public function confirmProductCategories($category_id)
	{
		
		$this->categoryIdBeingRemoved = $category_id;
		
		$this->dispatchBrowserEvent('show-delete-modalformCategory');
	}


	public function deleteProductCategories()
	{
		
		$category = CategoriesProduct::findOrFail($this->categoryIdBeingRemoved);

		$category->delete();

		$this->dispatchBrowserEvent('hide-delete-modalformCategory', ['message' => 'Categoria eliminada satisfactoriamente!']);
	}

	public function valorar($referred, $product_id, $puntuacion)
	{
		$valoracion = Valoracion::where('referred', $referred)->where('user_id', auth()->user()->id)->first();
		if($valoracion){
			$valoracion->update(['ca_valoracion' => $puntuacion]);
		}else{
			Valoracion::create([
				'user_id' => auth()->user()->id,
				'comercio_id' => $comercio_id,
				'product_id' => 0,
				'ca_valoracion' => $puntuacion,
				'referred' => $referred,
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
        if($this->comercio_id > 1 ){
            $products = Product::query()
                ->where('comercio_id', $this->comercio_id);
        }else{
            $products = Product::query();
        }
        
    	$products = $products
            ->where(function($q){
                $q->where('name', 'like', '%'.$this->searchTerm.'%');                
            })
    		->orderBy($this->sortColumnName, $this->sortDirection)
            ->paginate(15);
        
        if($this->comercio_id > 0) {
            $comercio = Comercio::find($this->comercio_id);
            $user = User::find($comercio->user_id);
        }else{
            $comercio = Comercio::find(1);
            $user = auth()->user();
        }        
		
        return view('livewire.afiliado.list-products', [
            'user'  => $user,
            'comercio'  => $comercio,
        	'products' => $products,
        ]);
    }
}
