<?php

namespace App\Http\Livewire\Components;

use Illuminate\Http\Request;

use App\Http\Livewire\Admin\AdminComponent;
use Illuminate\Support\Facades\Validator;

use App\Models\Product;
use App\Models\Comercio;
use App\Models\Setting;
use App\Models\SettingUser;
use App\Models\ValoracionProduct;

use Cart;

class ShowProducts extends AdminComponent
{
    public $todos = 5; 
    public $comercio_id;

    public $state = [];

    public $ca_valoracion = 0;

    public $currencyValue = 'Bs';

    public $parametro = null;

    public $renderizar = false;

    protected $listeners = [
        'recibirSearch' => 'recibirSearch', 
        'infoRecibida' => 'actualizarInfo', 
        'refreshValoracion' => 'refreshValoracion', 
        'refreshShowProduct' => 'refreshShowProduct',
        'emitCurrency' => 'emitCurrency'
    ];

    public function sendCard($product_id, $quantity )
    {
        $product = Product::find($product_id);
        
        \Cart::add(array(
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->price1,
            'quantity' => $quantity,
            'attributes' => array(
                'image' => $product->image1_url,
                'comercio_id' => $product->comercio_id,
                'categoria_id' => $product->categoria_id,
                'subcategoria_id' => $product->subcategoria_id,
            )
        ));

        $cartCollection = \Cart::getContent();

        if(auth()->check()){
            return redirect()->route('cart', [
                'cartCollection' => $cartCollection, 
                'words' => null,
                'comercioId' => $this->comercio_id, 
                'manufacturer_id' => 0,
                'modelo_id' => 0,
                'motor_id' => 0,
            ]);
        }else{
            return redirect()->route('cartOff',[
            // return view('livewire.cart.cart', [
                'cartCollection' => $cartCollection, 
                'words' => null,
                'comercioId' => $this->comercio_id, 
                'manufacturer_id' => 0,
                'modelo_id' => 0,
                'motor_id' => 0,
            ]);
        }

        $this->emit('changeQuantity');
        //return redirect()->back();
        //return redirect()->route('cart.index')->with('success_msg', 'Item Agregado a su Carrito!');
    }

    public function cartView($productId)
    {

        // Almacenar producto y continuar
        

        
    }

    public function actualizarInfo($data, $manufacturer, $products)
    {
        $this->parametro = $manufacturer;

        $this->informacion = $data;

    }

    public function mount($comercioId = 1, $currencyValue='$')
    {
        $this->comercio_id = $comercioId;

        $this->comercio = Comercio::find($this->comercio_id);

        $this->state['product_id'] = '0';
        $this->state['ca_valoracion'] = 0;
        $this->state['class'] = 'star';

        $this->currencyValue = request()->cookie('currency');
        
    }

    public function searchClass($puntuacion)
    {
        switch ($puntuacion) {
            case '1':
                return 'one';
                break;
            case '2':
                return 'two';
                break;
            case '3':
                return 'three';
                break;
            case '4':
                return 'four';
                break;
            case '5':
                return 'five';
                break;
        }
    }

    public function refreshValoracion($product_id, $ca_valoracion, $class)
    {
        $this->state['ca_valoracion'] = $ca_valoracion;
        $this->state['class'] = $class;
    }

    public function registrarValoracion()
    {
        $validatedData = Validator::make($this->state, [
			'comment' => 'nullable',
            'product_id' => 'required',
		])->validate();

        if(auth()->user())
        {
            $valoracion = ValoracionProduct::where('user_id', auth()->user()->id)->where('product_id', $validatedData['product_id'])->first();
            if($valoracion){
                $valoracion->update(['ca_valoracion' => $this->state['ca_valoracion'], 'class' => $this->searchClass($this->state['ca_valoracion']), 'comment' => $validatedData['comment']]);
            }else{
                ValoracionProduct::create([
                    'user_id' => auth()->user()->id,
                    'product_id' => $validatedData['product_id'],
                    'ca_valoracion' => $this->state['ca_valoracion'],
                    'class' => $this->searchClass($this->state['ca_valoracion']),
                    'comment' => $validatedData['comment'],
                ]);
            }

            // $this->skipRender();

            $this->dispatchBrowserEvent('hide-valoracionModal', ['message' => 'Gracias por la valoración!']);
            // $this->dispatchBrowserEvent('updateStar', ['comercio_id' => $comercio_id, 'puntuacion' => $puntuacion, 'class' => $class,]);

            // $this->mount($this->comercio_id);
            $this->refreshShowProduct();
            return redirect()->route('welcome');

        }
    }

    public function valorar($product_id, $puntuacion, $classV)
	{
        $this->skipRender();
        if (auth()->user()) {

            $this->state['product_id'] = $product_id;
            $this->state['class'] = $classV;
            $this->state['ca_valoracion'] = $puntuacion;
            $this->state['comment'] = '';

            $this->ca_valoracion = $puntuacion;

            $this->emit('refreshStar', $product_id, $puntuacion, $classV);

            $this->dispatchBrowserEvent('show-valoracionModal', ['classV' => $classV, 'ca_valoracion' => $puntuacion, 'product_id' => $product_id]);
        }
        else{
            // $this->dispatchBrowserEvent('show-loginModalShow');
            $this->dispatchBrowserEvent('hide-delete-modal', ['message' => 'Debe iniciar session para valoración!']);
        }
	}

    public function valorar1($puntuacion)
	{
        $this->state['ca_valoracion'] = $puntuacion;
        $this->ca_valoracion = $puntuacion;
	}

    public function refreshShowProduct()
    {
        $this->mount($this->comercio_id);        
    }

    public function render()
    {

        $setting = Setting::where('user_id', $this->comercio->user_id)->first();
        if(auth()->user()){
            $settingUser = SettingUser::where('user_id', auth()->user()->id)->first();
            if($settingUser){
                $currency = $settingUser->currency;
            }else{
                $currency = $setting->currency;
                $this->currencyValue = $currency;
            }            
        }else{
            $currency = request()->cookie('currency');
            $this->currencyValue = $currency;
        }
        
        
        if($this->comercio_id == 1){
            $products = Product::query()
                    ->with('valoracionProduct')
                            ->paginate();
        }else{
            $products = Product::where('comercio_id', $this->comercio_id)
                    ->with('valoracionProduct')
                            ->paginate();
        }
        if($this->parametro == null){
            return view('livewire.components.show-products',[
                'products' => $products 
            ]);
        }else{
            return '';
        }
        
    }

    public function comprar(Request $request)
    {
        dd($request);

        \Cart::add(array(
            'id' => $request->id,
            'price' => $request->price1,
            'quantity' => 1,
            'attributes' => array(
                'image' => $request->img,
            )
        ));
    }

    public function emitCurrency($currencyValue, Request $request)
    {
        $this->currencyValue = $request->cookie('currency');

    }
}
