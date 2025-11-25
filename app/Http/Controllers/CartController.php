<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Pedido;
use App\Models\Product;
use App\Models\Setting;

use DB;
use Cart;
use Carbon\Carbon;
use Mail;

class CartController extends Controller
{
    public $conf = null;

    public $state = [];

    public function __construct() { 
        $this->conf = Setting::where('id', 1)->first();
    }
    //
    public function vercart()  
    {    
        dd(' ver cart');
        
        $cartCollection = \Cart::getContent();
        //dd($cartCollection);
        return view('carrito.cart')->with('E-COMMERCE STORE | CART')->with(['cartCollection' => $cartCollection]);;
    }
    
    public function shop()
    {
        $products = Product::all();
        if(auth()->check()){
            return view('carrito.cart.shop')->with('E-COMMERCE STORE | SHOP')->with(['products' => $products]);
        }
        else{
            return view('carrito.cart.shop')->with('E-COMMERCE STORE | SHOP')->with(['products' => $products]);
        }
        
    }

    public function cart()  
    {    
        $conf = Setting::where('id', 1)->first();
        
        $cartCollection = \Cart::getContent();
        //dd($cartCollection);
        return view('livewire.carrito.cart', compact('conf'))->with('E-COMMERCE STORE | CART')->with(['cartCollection' => $cartCollection]);;
    }

    

    public function remove(Request $request){
        \Cart::remove($request->id);

        $cartCollection = \Cart::getContent();

        return redirect()->route('goCart')->with('success_msg', 'Item is removed!');
        // return redirect()->route('cart.index')->with('success_msg', 'Item is removed!');
    }

    public function add(Request $request )
    {
        $product = Product::find($request->product_id);
        
        \Cart::add(array(
            'id' => $request->product_id,
            'name' => $product->name,
            'price' => $product->price1,
            'quantity' => $request->quantity,
            'attributes' => array(
                'nropedido' => '',
                'image' => $product->image1_url,
                'comercio_id' => $product->comercio_id,
                'categoria_id' => $request->categoria_id,
                'subcategoria_id' => $request->subcategoria_id,
            )
        ));
        return redirect()->back();
        //return redirect()->route('cart.index')->with('success_msg', 'Item Agregado a su Carrito!');
    }

    public function add1(Request$request, $id)
    {       
        \Cart::add(array(
            'id' => $request->id,
            'name' => $request->name,
            'price' => $request->price.$id,
            'quantity' => $request->quantity.$id,
            'attributes' => array(
                'nropedido' => '',
                'image' => $request->img,
                'afiliado_id' => $request->afiliado_id,
                'sucursal_id' => $request->sucursal_id,
            )
        ));
        return redirect()->route('cart.index')->with('success_msg', 'Item Agregado a sú Carrito!');
    }
        

    public function update(Request $request){
        \Cart::update($request->id,
            array(
                'quantity' => array(
                    'relative' => false,
                    'value' => $request->quantity
                ),
        ));

        $cartCollection = \Cart::getContent();

        return view('livewire.carrito.cart')->with('E-COMMERCE STORE | CART')->with(['cartCollection' => $cartCollection]);;
        // return redirect()->route('cart.index')->with('success_msg', 'El Carrito ha sido Actualizado');
    }

    public function updateQuantity($value){
        dd($value);
        
        \Cart::update($this->state['id'],
            array(
                'quantity' => array(
                    'relative' => false,
                    'value' => $this->state['quantity']
                ),
        ));

        $cartCollection = \Cart::getContent();

        return view('livewire.carrito.cart')->with('E-COMMERCE STORE | CART')->with(['cartCollection' => $cartCollection]);;
        // return redirect()->route('cart.index')->with('success_msg', 'El Carrito ha sido Actualizado');
    }

    public function clear()
    {
        \Cart::clear();

        return redirect()->route('goCart')->with('success_msg', 'El Carrito se ha vaciado');

        // return redirect()->route('cart.index')->with('success_msg', 'El Carrito se ha vaciado');
    }

    public function onlyClear()
    {
        \Cart::clear();

        // return redirect()->route('cart.index')->with('success_msg', 'El Carrito se ha vaciado');
    }

    public function total()
    {
        return \Cart::getTotal();
    }

    public function contenido()
    {
        return \Cart::getContent();
    }

    public function comprar()
    {
        $cartCollection = \Cart::getContent();
        //dd($cartCollection);
        
        return view('carrito.formulario1', ['conf'=>$this->conf,])->with('E-COMMERCE STORE | CART')->with(['cartCollection' => $cartCollection]);

        //return view('formulario1');
    }

    // Crear el Pedido
    public function formulario2( Request $request )
    {
        $id = DB::table( 'pedidos' )->max('id');  
        $id = $id  + 1;

        $items = Cart::getContent();

        foreach ($items as $key => $value) {
            $afiliado_id = $value->attributes->afiliado_id;
            $sucursal_id = $value->attributes->sucursal_id;
            $name_sucursal = $value->attributes->name_sucursal;
            break;
        }
        
        DB::table( 'pedidos' )->updateOrInsert(
         [ 
                'id'  => $id,
                'user_id'  => $request->user_id,
                'afiliado_id' => $afiliado_id,
                'sucursal_id' => $sucursal_id,
                'estado'   => $request->estado,
                'fe_pedido'  => $request->fe_pedido,
                'tipocedula'  => $request->tipocedula,
                'cedula'  => $request->cedula,
                'nombre'  => $request->nombre,
                'telefono'  => $request->celular,
                'direccion'  => $request->direccion,
                'totalbs'  => $request->totalbs
         ] 
        );

        $idd = DB::table( 'pedidos_detalles' )->max('id');  

        $cartCollection = \Cart::getContent();

        $tx_productos = "";
        foreach( $cartCollection  as $item ) 
        {
            $idd = $idd  + 1;

            DB::table( 'pedidos_detalles' )->updateOrInsert(
                [ 
                    'id'  => $idd,
                    'user_id'  => auth()->user()->id,
                    'pedido_id'  => $id,
                    'afiliado_id' => $item->attributes->afiliado_id,
                    'sucursal_id' => $item->attributes->sucursal_id,
                    'producto_id'  => $item->id,
                    'nombre'  => $item->name,
                    'cantidad'  => $item->quantity,
                    'precio'  => $item->price,
                    'subtotal'  => $item->quantity * $item->price,
                ] 
            );

            $tx_productos = $tx_productos . '-' . $item->name . '-(' . $item->quantity . ')-(' . ( $item->quantity * $item->price ) . ')';
        }        
        //\Cart::clear();
        $mensage = 'Pedido Creado Satisfactoriamente';
        //return view('formulario2')->with('success_msg', $mensage);
        return view('carrito.formulario2', ['conf' => $this->conf])->with([ 
                'message'=>'Estado actualizado correctamente', 
                'success_msg' => $mensage, 
                'pedido' => $id, 
                'fecha' => $request->fe_pedido, 
                'name_sucursal' => $name_sucursal,
                'sucursal_id' => $sucursal_id,
                'total' => $request->totalbs ,
                'estado'   => $request->estado,
                'fe_pedido'  => $request->fe_pedido,
                'tipocedula'  => $request->tipocedula,
                'cedula'  => $request->cedula,
                'nombre'  => $request->nombre,
                'celular'  => $request->celular,
                'direccion'  => $request->direccion,
                'user_id'  => $request->user_id,
                'referencia'  => 'Pedido ' . $id . '-' . $request->cedula . '-' . $request->fe_pedido . ' ' ,
                'correo'  => auth()->user()->email ,
                'titulo'  => 'Compra PanExpres ' . $id . ' - ' . $request->fe_pedido . ' ' ,
                'descripcion'  => 'Compra PanExpres ' . $tx_productos,
                'request' => $request,
            ]);

            \Cart::clear();

            $token = Str::random(64);
            //Envío de email al usuario
            Mail::send('email.email-pedido', [
                'token' => $token,
                'pedido' => $id, 
                'name_sucursal' => $name_sucursal,
                'sucursal_id' => $sucursal_id,
                'fecha' => $request->fe_pedido, 
                'total' => $request->totalbs ,
                'estado'   => $request->estado,
                'fe_pedido'  => $request->fe_pedido,
                'tipocedula'  => $request->tipocedula,
                'cedula'  => $request->cedula,
                'nombre'  => $request->nombre,
                'celular'  => $request->celular,
                'direccion'  => $request->direccion,
                'user_id'  => $request->user_id,
                'referencia'  => 'Pedido ' . $id . '-' . $request->cedula . '-' . $request->fe_pedido . ' ' ,
                'correo'  => auth()->user()->email ,
                'titulo'  => 'Compra PanExpres ' . $id . ' - ' . $request->fe_pedido . ' ' ,
                'descripcion'  => 'Compra PanExpres ' . $tx_productos 
                ], function($message) use($request){
                $message->to( auth()->user()->email );
                $message->subject('Pedido Creado Número ' . $id . '-' . $request->cedula . '-' . $request->fe_pedido . ' ' );
            });
     
    }

    public function formulario3( Request $request )
    {
        return view('formulario2');
    }
    

    public function formasdepago()
    {
        return view('formulario2', ['conf'=>$this->conf,]);
    }

    public function previaCompra($id_suc, $id_pro, $categoria)
    {
        $conf = Setting::where('id', 1)->first();

        $items = \Cart::getContent();
        $encontrado = false;
        $name_sucursal = '';


        foreach($items as $item)
        {
            $name_sucursal = $item->attributes->name_sucursal;
            if($item->attributes->sucursal_id !== $id_suc){
                $encontrado = true;
                break;
            }
        }
        if($encontrado)
        {
            return redirect()->route('welcome')->with('success_msg', 'Debe seleccionar un producto de la ' . $name_sucursal);
        }

        return view('carrito.previo-product-cart', compact('conf', 'id_suc','id_pro','categoria') );
    }

    
    
    
}
