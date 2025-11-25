<?php

namespace App\Http\Livewire\Afiliado\Product\Repuestoexpres;

use App\Http\Livewire\Admin\AdminComponent;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;

use App\Models\Area;
use App\Models\Comercio;
use App\Models\Manufacturer;
use App\Models\Brand;
use App\Models\Modelo;
use App\Models\Motor;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Container;
use App\Models\Product;
use App\Models\Supplier;


class NewComboRE extends AdminComponent
{
    use WithFileUploads;
    
    public $comercio_id; 
    public $editModal;
    public $controlActivity = true;
    public $state = [];

    public $photo1;
    public $photo2;
    public $photo3;
    public $photo4;

    public function mount($comercioId, $editModal )
    {

        $this->comercio_id = $comercioId;
        $this->editModal = $editModal;

        // dd($this->showEditModal);

        if($editModal == 'false'){
            $this->controlActivity = false;
        }

        $this->state['delivery'] = false;
        $this->state['container_id'] = "0";
        $this->comercio = Comercio::find($comercioId);
        $this->state['area_id'] = $this->comercio->area_id;
        $this->state['in_pedido'] = "0";
        $this->state['in_envio_gratis'] = "0";
        $this->state['in_offer'] = "0";
        $this->state['in_fragil'] = "0";
        $this->state['in_por_encargo'] = "0";
        $this->state['in_valido'] = "1";
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

    public function createCombo()
	{
        //dd($this->state);

		$validatedData = Validator::make($this->state, [
            'code_lote' => 'nullable',
            'code' => 'required',
			'name' => 'required',
            'manufacturer_id' => 'nullable',
            'brand_id'  => 'nullable',
            'model_id' => 'nullable',
            'motor_id' => 'nullable',
            'container_id' => 'required|not_in:0',
            'details1' => 'nullable',
            'details2' => 'nullable',
            'description' => 'nullable',
            'price1' => 'required',
            'price2' => 'nullable',
            'profit_price' => 'nullable',
            'price_mayor' => 'nullable',
            'profit_mayor' => 'nullable',
            'price_offer' => 'nullable',
            'profit_offer' => 'nullable',
            'price_divisa' => 'nullable',
            'delivery' => 'nullable',
            'shipping_cost' => 'nullable',
            'stock_min' => 'nullable',
            'stock_max' => 'nullable',
            'stock' => 'nullable',
            'area_id' => 'required|not_in:0',
            'category_id' => 'required|not_in:0',
            'subcategory_id' => 'nullable',
            'supplier_id' => 'required|not_in:0',
            'pack_products_id' => 'required|not_in:0',
            'pack_price' => 'nullable',

            'tx_peso' => 'nullable',
            'tx_tamanio' => 'nullable',
            'tx_presentacion' => 'nullable',
            'tx_tamanio_carga' => 'nullable',
            'tx_tamanio_venta' => 'nullable',
            'fe_expedicion' => 'nullable',
            'in_pedido' => 'nullable',
            'tx_adicionales' => 'nullable',
            'in_envio_gratis' => 'nullable',
            'in_offer' => 'nullable',
            'tx_recomendacion_consumo' => 'nullable',
            'in_fragil' => 'nullable',
            'in_por_encargo' => 'nullable',
            'ca_valoracion' => 'nullable',
            'in_valido' => 'nullable',
		])->validate();

        $filename = $validatedData['code'].'-'.$this->comercio_id;

		if ($this->photo1) {
			//$validatedData['image_path1'] = $this->photo->store('/', 'avatarsproducts');
            $validatedData['image_path1'] = $this->photo1->storeAs(null,
                $filename . '-1.png', 'avatarsproducts'
            ); 
		}
        if ($this->photo2) {
			//$validatedData['image_path1'] = $this->photo->store('/', 'avatarsproducts');
            $validatedData['image_path2'] = $this->photo2->storeAs(null,
                $filename . '-1.png', 'avatarsproducts'
            ); 
		}
        if ($this->photo3) {
			//$validatedData['image_path1'] = $this->photo->store('/', 'avatarsproducts');
            $validatedData['image_path3'] = $this->photo3->storeAs(null,
                $filename . '-1.png', 'avatarsproducts'
            ); 
		}
        if ($this->photo4) {
			//$validatedData['image_path1'] = $this->photo->store('/', 'avatarsproducts');
            $validatedData['image_path4'] = $this->photo4->storeAs(null,
                $filename . '-1.png', 'avatarsproducts'
            ); 
		}

        $comercio = Comercio::find($this->comercio_id);

        $validatedData['user_id'] = $comercio->user_id;
        $validatedData['userCreated_at'] = auth()->user()->id;
        $validatedData['userUpdated_at'] = auth()->user()->id;
        $validatedData['comercio_id'] = $this->comercio_id;

        $validatedData['in_combo'] = "1";

		Product::create($validatedData);

		// session()->flash('message', 'User added successfully!');

		$this->dispatchBrowserEvent('hide-form', ['message' => 'Combo agregado satisfactoriamente!']);

        return redirect()->route('listCombos', ['comercioId' => $this->comercio_id, ] );
	}

    public function updateProduct()
	{
        dd('update');
    }

    public function render()
    {
        $areas = Area::all();
        $comercio = Comercio::find($this->comercio_id);
        $manufacturers = Manufacturer::where('comercio_id', $this->comercio_id)->get();
        $brands = Brand::where('comercio_id', $this->comercio_id)->get();
        $models = Modelo::where('comercio_id', $this->comercio_id)->get();
        $motors = Motor::where('comercio_id', $this->comercio_id)->get();
        $categories = Category::where('comercio_id', $this->comercio_id)->get();
        $containers = Container::where('comercio_id', $this->comercio_id)->get();
        $suppliers = Supplier::where('comercio_id', $this->comercio_id)->get();

        $suppliers = Supplier::where('comercio_id', $this->comercio_id)->get();
        

        return view('livewire.afiliado.product.repuestoexpres.new-combo-r-e', [
            'areas' => $areas,
            'comercio' => $comercio,
            'categories' => $categories,
            'manufacturers' => $manufacturers,
            'brands' => $brands,
            'models' => $models,
            'motors' => $motors,
            'containers' => $containers,
            'suppliers' => $suppliers,            
        ]);
    }
}
