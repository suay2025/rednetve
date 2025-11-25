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


class NewProductRE extends AdminComponent
{
    use WithFileUploads;
    
    public $comercioId; 
    public $editModal;
    public $controlActivity = true;
    public $state = [];

    public $photo1;
    public $photo2;
    public $photo3;
    public $photo4;

    public function mount($comercioId, $productId, $editModal )
    {

        $this->comercioId = $comercioId;
        $this->product_id = $productId;
        $this->editModal = $editModal;

        // dd($this->showEditModal);

        if($editModal == 'false'){
            $this->controlActivity = false;
            $this->state['in_delivery'] = false;
            $this->state['container_id'] = "0";
            $this->comercio = Comercio::find($comercioId);
            $this->state['area_id'] = $this->comercio->area_id;
            $this->state['in_pedido'] = "0";
            $this->state['in_envio_gratis'] = "0";
            $this->state['in_offer'] = "0";
            $this->state['in_fragil'] = "0";
            $this->state['in_por_encargo'] = "0";
            $this->state['in_valido'] = "1";
        }else{
            $this->product = Product::find($this->product_id);
            
		    $this->state = $this->product->toArray();
            
            $this->state['in_pedido'] = $this->checkear($this->state['in_pedido']);
            $this->state['in_pickup'] = $this->checkear($this->state['in_pickup']);
            $this->state['in_delivery'] = $this->checkear($this->state['in_delivery']);
            $this->state['in_envio_nacional'] = $this->checkear($this->state['in_envio_nacional']);
            $this->state['in_envio_gratis'] = $this->checkear($this->state['in_envio_gratis']);
            $this->state['in_offer'] = $this->checkear($this->state['in_offer']);
            $this->state['in_fragil'] = $this->checkear($this->state['in_fragil']);
            $this->state['in_por_encargo'] = $this->checkear($this->state['in_por_encargo']);
            $this->state['in_olor_fuerte'] = $this->checkear($this->state['in_olor_fuerte']);
            $this->state['in_valido'] = $this->checkear($this->state['in_valido']);
            $this->state['in_combo'] = $this->checkear($this->state['in_combo']);

        }
        
    }

    public function checkear($value)
    {
        switch ($value) {
            case '0':
                return false;
                break;
            case '1':
                return true;
                break;
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

    public function createProduct()
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
            'madein' => 'nullable',
            'in_pedido' => 'nullable',
            'tx_adicionales' => 'nullable',

            'in_pickup'  => 'nullable',
            'in_envio_nacional' => 'nullable',
            'in_delivery' => 'nullable',            
            'in_envio_gratis' => 'nullable',
            
            'in_offer' => 'nullable',
            'tx_recomendacion_consumo' => 'nullable',
            'in_fragil' => 'nullable',
            'in_por_encargo' => 'nullable',
            'ca_valoracion' => 'nullable',
            'in_valido' => 'nullable',
		])->validate();

        $filename = $validatedData['code'].'-'.$this->comercioId;

		if ($this->photo1) {
            // $validatedData['avatar'] = $this->photo->store('/', 'avatarscomercios');
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

        $comercio = Comercio::find($this->comercioId);

        $validatedData['user_id'] = $comercio->user_id;
        $validatedData['userCreated_at'] = auth()->user()->id;
        $validatedData['userUpdated_at'] = auth()->user()->id;
        $validatedData['comercio_id'] = $this->comercioId;

		Product::create($validatedData);

		// session()->flash('message', 'User added successfully!');

		$this->dispatchBrowserEvent('hide-form', ['message' => 'Producto agregado satisfactoriamente!']);

        return redirect()->route('listProducts', ['comercioId' => $this->comercioId, ] );
	}

    public function updateProduct()
	{
        $validatedData = Validator::make($this->state, [
            'code_lote' => 'nullable',
            'code' => 'required',
			'name' => 'required',
            'manufacturer_id' => 'nullable',
            'brand_id'  => 'nullable',
            'model_id' => 'nullable',
            'motor_id' => 'nullable',
            'container_id' => 'nullable',
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
            
            'shipping_cost' => 'nullable',
            'stock_min' => 'nullable',
            'stock_max' => 'nullable',
            'stock' => 'nullable',
            'area_id' => 'required|not_in:0',
            'category_id' => 'required|not_in:0',
            'subcategory_id' => 'nullable',
            'supplier_id' => 'required|not_in:0',
            'pack_products_id' => 'nullable',
            'pack_price' => 'nullable',

            'tx_peso' => 'nullable',
            'tx_tamanio' => 'nullable',
            'tx_presentacion' => 'nullable',
            'tx_tamanio_carga' => 'nullable',
            'tx_tamanio_venta' => 'nullable',
            'fe_expedicion' => 'nullable',
            'madein' => 'nullable',
            'in_pedido' => 'nullable',
            'tx_adicionales' => 'nullable',
            'in_pickup'  => 'nullable',
            'in_envio_nacional' => 'nullable',
            'in_delivery' => 'nullable',            
            'in_envio_gratis' => 'nullable',
            'in_offer' => 'nullable',
            'tx_recomendacion_consumo' => 'nullable',
            'in_fragil' => 'nullable',
            'in_por_encargo' => 'nullable',
            'ca_valoracion' => 'nullable',
            'in_valido' => 'nullable',
		])->validate();

        
        $filename = $validatedData['code'].'-'.$this->comercioId;

        if ($this->photo1) {
            // $validatedData['avatar'] = $this->photo->store('/', 'avatarscomercios');
			if (Storage::disk('avatarsproducts')->exists($this->product->image_path1)) {
				Storage::disk('avatarsproducts')->delete($this->product->image_path1);
			}
			$validatedData['image_path1'] = $this->photo1->storeAs(null,
                $filename . '-1.png', 'avatarsproducts'
            );     
		}

        $this->product->update($validatedData);

		$this->dispatchBrowserEvent('hide-form', ['message' => 'Producto actualizado satisfactoriamente!']);
    }

    public function render()
    {
        $areas = Area::all();
        $comercio = Comercio::find($this->comercioId);
        $manufacturers = Manufacturer::where('comercio_id', $this->comercioId)->get();
        $brands = Brand::where('comercio_id', $this->comercioId)->get();
        $models = Modelo::where('comercio_id', $this->comercioId)->get();
        $motors = Motor::where('comercio_id', $this->comercioId)->get();
        $categories = Category::where('comercio_id', $this->comercioId)->get();
        $containers = Container::where('comercio_id', $this->comercioId)->get();
        $suppliers = Supplier::where('comercio_id', $this->comercioId)->get();

        $suppliers = Supplier::where('comercio_id', $this->comercioId)->get();
        

        return view('livewire.afiliado.product.repuestoexpres.new-product-r-e', [
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
