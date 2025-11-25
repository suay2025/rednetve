<?php

namespace App\Http\Livewire\Afiliado\Product;

use Livewire\Attributes\Validate;
use App\Http\Livewire\Admin\AdminComponent;
use App\Models\User;
use App\Models\Comercio;
use App\Models\Product;
use App\Models\ProductsCombo;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;

class ListCombos extends AdminComponent
{
	use WithFileUploads;

	public $state = [];

	public $combo;

	#[Validate] 
	public $product;
	public function rules()
    {
        return [
            'product' => 'required|not_in:0',
        ];
    }
	public $products = [];

	public $showEditModal = false;

	public $productIdBeingRemoved = null;

	public $searchTerm = null;

    protected $queryString = ['searchTerm' => ['except' => '']];

    public $sortColumnName = 'created_at';

    public $sortDirection = 'desc';

    public $comercio_id = 0;

	public $product_id = 0;

    public $screenResolution;

    protected $listeners = [
		'sendResolution'
   		];

	public function sendResolution($screenResolution){
		$this->screenResolution = $screenResolution;
	}


    public function mount($comercioId = 0)
    {
        $this->comercio_id = $comercioId;

		$this->products = Product::where('comercio_id', $this->comercio_id)->get();
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
		
		if ($this->screenResolution < 1024) {
			$this->dispatchBrowserEvent('show-form');	
		}elseif ($this->screenResolution < 1280) {
			$this->dispatchBrowserEvent('show-form');
		}else {
			return redirect()->route('newComboRE', ['comercioId' => $this->comercio_id, 'editModal' => $editModal] );
		}
		
	}

	public function addNewProduct($product_id)
	{   
		// dd($product_id);
		if($product_id)
		{
        $comercio_id = $this->comercio_id;
		$screenResolution = $this->screenResolution;
		$prod_id = $this->product_id;

		$this->reset();		

		$this->product_id = $prod_id;
		$this->products = Product::where('comercio_id', $comercio_id)->get();
		$this->product_id = $product_id;

        $this->comercio_id = $comercio_id;
		$this->screenResolution = $screenResolution;

		$this->showEditModal = false;

		$editModal = 'false';
		
		$this->dispatchBrowserEvent('show-formProduct');	
		}
		
	}

	public function updatedProduct($value)
	{
		
		$product = Product::where('id', $value)->first();

		$this->state = $product->toArray();

	}

	public function addProduct()
	{
		// $validatedData = Validator::make($this->state, [
			
		// ])->validate();
		$this->validate();

        $validatedData['comercio_id'] = $this->comercio_id;
		$validatedData['product_id'] = $this->product_id;
		$validatedData['productC_id'] = $this->product;
		
		ProductsCombo::create($validatedData);

		// session()->flash('message', 'User added successfully!');

		$this->dispatchBrowserEvent('hide-formProduct', ['message' => 'Producto agregado al Combo satisfactoriamente!']);
	}

	public function edit(Product $product)
	{
		
		$this->dispatchBrowserEvent('show-form');

	}

	public function updateProduct()
	{
		$this->dispatchBrowserEvent('hide-form', ['message' => 'Producto actualizado satisfactoriamente!']);
	}

	public function confirmProductRemoval($productId)
	{
		$this->productIdBeingRemoved = $productId;

		$this->dispatchBrowserEvent('show-delete-modal');
	}

	public function confirmProductComboRemoval($productId)
	{
		$this->productIdBeingRemoved = $productId;

		$this->dispatchBrowserEvent('show-delete-modalformProduct');
	}

	public function deleteProductCombo()
	{
		$product = ProductsCombo::findOrFail($this->productIdBeingRemoved);

		$product->delete();

		$this->dispatchBrowserEvent('hide-delete-modalformProduct', ['message' => 'Producto eliminado del Combo satisfactoriamente!']);
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
        if($this->comercio_id > 0 ){
            $combos = Product::query()
                ->where('comercio_id', $this->comercio_id);
        }else{
            $combos = Product::query();
        }
        $combos = $combos->where('in_combo', '1');
    	
        $combos = $combos
            ->where('name', 'like', '%'.$this->searchTerm.'%');

        $combos = $combos
    		->orderBy($this->sortColumnName, $this->sortDirection)
            ->paginate(15);
        
        if($this->comercio_id > 0) {
            $comercio = Comercio::find($this->comercio_id);
            $user = User::find($comercio->user_id);
        }else{
            $comercio = Comercio::find(1);
            $user = auth()->user();
        }        
		
        return view('livewire.afiliado.product.list-combos', [
            'user'  => $user,
            'comercio'  => $comercio,
        	'combos' => $combos,
        ]);
    }
}
