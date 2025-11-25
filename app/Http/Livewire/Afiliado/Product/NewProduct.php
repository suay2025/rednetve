<?php

namespace App\Http\Livewire\Afiliado\Product;

use App\Http\Livewire\Admin\AdminComponent;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;

use App\Models\Comercio;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Container;
use App\Models\Product;
use App\Models\Supplier;


class NewProduct extends AdminComponent
{
    use WithFileUploads;
    
    public $comercioId; 
    public $editModal;
    public $controlActivity = true;
    public $state = [];

    public $photo;

    public function mount($comercioId, $editModal )
    {

        $this->comercioId = $comercioId;
        $this->editModal = $editModal;

        // dd($this->showEditModal);

        if($editModal == 'false'){
            $this->controlActivity = false;
        }
        
    }

    public function changeCategory($categoryId, $subcategory)
	{	
		$subcategories = Subcategory::where('category_id', $categoryId)->get();	

		if($subcategories->count() > 0){
			$msg = 'Seleccione una opción';
			$this->state['subcategory_id'] = 0;
		}else{
			$msg = 'No posee Subcategoria';
			$this->state['subcategory_id'] = 0;
		}

        $this->skipRender();
        		
		$this->dispatchBrowserEvent('sendSubcategories', ['subcategories' => $subcategories, 'subcategory' => $subcategory, 'msg' => $msg]);
	}

    public function render()
    {
        $comercio = Comercio::find($this->comercioId);
        $brands = Brand::where('comercio_id', $this->comercioId)->get();
        $categories = Category::where('comercio_id', $this->comercioId)->get();
        $containers = Container::where('comercio_id', $this->comercioId)->get();
        $suppliers = Supplier::where('comercio_id', $this->comercioId)->get();
        

        return view('livewire.afiliado.product.new-product', [
            'comercio' => $comercio,
            'categories' => $categories,
            'brands' => $brands,            
            'containers' => $containers,
            'suppliers' => $suppliers,            
        ]);
    }
}
