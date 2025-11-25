<?php

namespace App\Http\Livewire\Afiliado;

use Illuminate\Support\Facades\Redirect;
use Livewire\Component;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

use App\Http\Controllers\CartController;
use App\Http\Livewire\Notificacion\EmailController;

use App\Models\User;
use App\Models\DatosBasicos;
use App\Models\Comercio;
use App\Models\Banco;
use App\Models\Transaccion;
use App\Models\Pedido;
use App\Models\PedidoDetalles;
use App\Models\PedidoTemporal;
use App\Models\PedidoDetallesTemporal;
use App\Models\MetodoPagoC;
use App\Models\Tasa;

class Pasarela extends Component
{
    public $id_suc;
    public $tokenId;
    public $state = [];
    public $showEditModal = false;
    public $comercio_id;
    public $pedido;
    public $comercio;

    public $nropedido;
    public $clienteId = 0;
    public $currency = 1; // Bolivar
    public $currencyValue = '$';
    public $amount = 1; //monto
    public $reference = '12345678'; // Pedido a pagar
    public $title = 'Esto es un titulo';
    public $description = 'Esto es una descripcion';
    public $email = 'typej2003@gmail.com';
    public $cellphone = '';
    public $rifLetter = 'J';
    public $rifNumber = ''; // J G
    public $identificationNac = 'V'; // V E P
    public $identificationNumber = '';

    public $metodoentrega;

    public $bancos;
    public $pagosmoviles;
    public $transferencias;
    public $zelles;
    public $paypals;

    protected $listeners = [
        'emitCurrency' => 'emitCurrency'
    ];

    public function mount($nropedido = '', $comercioId = 1, )
	{
        
        $this->pedido = PedidoTemporal::where('nropedido', $nropedido)->first();
        $this->comercio_id = $comercioId;

        $this->currencyValue = request()->cookie('currency');
        
        //guardar variables de entrega
        $this->metodoentrega = $this->pedido->metodoentrega;

        $this->autenticarComercio($comercioId, $this->pedido->comercio_id);  
        
        if($this->pedido)
        {
            $this->nropedido = $this->pedido->nropedido;
            $this->reference = $this->pedido->nropedido;
            $this->title = $this->pedido->title;
            $this->description = $this->pedido->description;
            $this->clienteId = $this->pedido->user_id;
            $this->amount = $this->pedido->coste;

            if($this->currencyValue == 'Bs')
            {
                // Hacer conversion
                $this->amount = $this->convertir($this->pedido->coste, $this->pedido->comercio_id);
                $this->currency = '1';
            }else{
                $this->currency = '2';
            }
            
            $cliente = $this->pedido->client;            
            $this->email = $cliente->email;
            $this->cellphonecode = $cliente->datosbasicos->cellphonecode;
            $this->cellphone = $cliente->datosbasicos->cellphone;
            $this->identificationNac = $cliente->identificationNac;
            $this->identificationNumber = $cliente->identificationNumber;
            $this->comercio = Comercio::find($this->pedido->comercio_id);
        }
	}

    public function pasarelaPost($request)
    {
        $cart = new CartController;
        $contenido = $cart->contenido();
        $title = 'Compra';
        $description = '';

        foreach($contenido as $elemento)
        {
            if($description !== '')
            {
                $description .= ' / ';
            }
            $description .= $elemento->name;
            $description .= ' - '. $elemento->quantity;
            $description .= ' - '. $elemento->price;
        }
        
        $this->nropedido = auth()->user()->identificationNumber . '-' . str_replace("-", "", date("Y-m-d")) . str_replace(":", "", date("H:i:s"));
        $this->reference = $this->nropedido;
        $this->title = 'Compra';
        $this->description = $description;

        $this->currencyValue = request()->cookie('currency');

        dd($this->currencyValue);

        if($this->currencyValue == 'Bs')
        {
            // Hacer conversion
            $this->amount = $this->convertir($cart->total());

            $this->currency = '1';
        }else{
            $this->amount = $cart->total();
            $this->currency = '2';
        }

        $cliente = auth()->user();
        $this->clienteId = $cliente->id;

        $this->email = $cliente->email;
        $this->cellphonecode = $cliente->datosbasicos->cellphonecode;
        $this->cellphone = $cliente->datosbasicos->cellphone;
        $this->identificationNac = $cliente->identificationNac;
        $this->identificationNumber = $cliente->identificationNumber;

        //$comercio es panexpress
        $this->comercio = Comercio::find(1);

        $this->pagosmoviles = MetodoPagoC::select(['id', 'metodo','cellphonecode','cellphone','identificationNumber','banco', 'codigo'])->where('comercio_id', $this->comercio_id)->where('metodo','pagomovil')->get()->toArray();
        
        $this->transferencias = MetodoPagoC::select(['id', 'metodo','banco', 'codigo', 'titular','identificationNumber','nrocuenta'])->where('comercio_id', $this->comercio_id)->where('metodo','transferencia')->get()->toArray();

        $this->zelles = MetodoPagoC::select(['id', 'metodo', 'cellphonecode','cellphone','identificationNumber','pagoonline', 'email'])->where('comercio_id', $this->comercio_id)->where('pagoonline','zelle')->get()->toArray();
        
        // return view('livewire.afiliado.pasarela', [
        //     'comercio' => $this->comercio,
        //     'clienteId' => $this->clienteId,
        //     'identificationNac' => $this->identificationNac,
        //     'identificationNumber' => $this->identificationNumber,
        //     'email' => $cliente->email,
        //     'cellphonecode' => $cliente->datosbasicos->cellphonecode,
        //     'cellphone' => $cliente->datosbasicos->cellphone,
        //     'identificationNac' => $cliente->identificationNac,
        //     'identificationNumber' => $cliente->identificationNumber,
        //     'rifLetter' => 'J',
        //     'rifNumber' => '',
        //     'reference' => $this->reference,
        //     'currency' => $this->currency,
        //     'currencyValue' => $this->currencyValue,
        //     'title' => $this->title,
        //     'description' => $this->description,
        //     'description' => $this->description,
        // ]);
    }

    public function convertir($amount, $comercio_id)
    {
        $tasaValues = Tasa::where('comercio_id', $comercio_id)->where('status', 'activo')->first();

        if(!$tasaValues){
            $tasa = 1;
        }else{
            $tasa = $tasaValues->tasa;
            
        }
        switch ($this->currencyValue) {
            case 'Bs':
                $subtotal = round($amount*$tasa, 2);
                break;
            case '$':
                $subtotal = round($amount, 2);
                break;            
        }

        return $subtotal;
    }


    public function emitCurrency($currencyValue, Request $request)
    {
        $this->currencyValue = $request->cookie('currency');

        $this->dispatchBrowserEvent('refreshPage', ['message' => "Refresh."]);
    }

    public function searchCurrency($currency)
    {
        switch ($currency) {
            case '1':
                return 'Bs';
                break;
            
            case '2':
                return '$';
                break;
        }
    }

    public function autenticarComercio($comercio_id, $comercio2_id)
    {
        if($comercio_id != $comercio2_id)
        {
            return redirect('/errorFound/12');
        }
        
    }

    public function procesado(Request $request)
	{
		$this->tokenId = $request->get('ID');

        $this->id_suc = $request->get('ID'); 

        dd($request);
		
	}

    public function enviarDataPasarela(Request $request)
    {
        
        $operacion = $request->get('datos');

        $comercio = Comercio::find($operacion['comercio_id']);

        $operacion['user_id'] = $comercio->user_id;

        $operacion['banco'] = '';

        if($operacion['codigo']){
            $banco = Banco::where('codigo', $operacion['codigo'])->first();
            $operacion['banco'] = $banco->name;
        }
        
        $transaccion = Transaccion::create($operacion);

        $pedidoTemporal = PedidoTemporal::where('nropedido', $operacion['nropedido'])->first();

        $pedidoTemporal->update([
            'reference' => $operacion['reference'],
            'metodo' => $operacion['metodo'],
            'currency' => $operacion['currency'],
        ]);

        $pedidoDetallesTemporales = PedidoDetallesTemporal::where('nropedido', $operacion['nropedido'])->get();        

        $pedido = $pedidoTemporal->toArray();

        $newpedido = Pedido::create($pedido);

        foreach($pedidoDetallesTemporales as $pedidoDetallesTemporal){
            $pedidodetalles = $pedidoDetallesTemporal->toArray();
            $detalles = PedidoDetalles::create($pedidodetalles);
        }

        $cart = new CartController;

        $cart->onlyClear();

        // Envio de notificaciones por la compra

        $notificacion = new EmailController();

        $notificacion->sendEmail('compra', auth()->user(), $newpedido->nropedido);

        //$notificacion->sendEmail('compraRealizadaWithImages', auth()->user(), $newpedido->nropedido);

        if($transaccion){
            $data = [
                'state'=> 'ok', 
                'pedido_id' => $newpedido->id,
                'nropedido' => $newpedido->nropedido,
            ];
        }
        else{
            $data = ['state'=> 'fallido'];
        }

        return response()->json($data);

    }

    public function redirection()
    {
        
        return Redirect::to('listUsers');
    }

    public function sendProcesado()
	{
		$this->dispatchBrowserEvent('sendProcesado');
	}

    

    public function render()
    {
        if(  \Cart::getTotalQuantity() == 0)
        {
            $this->description = 'No puede ejecutar back en el navegador';
            return view('livewire.error.show-error', [
                'error' => '144',
                'description' => 'No puede ejecutar back en el navegador',
            ]);
        }

        $this->bancos = Banco::all()->toArray();

        $this->pagosmoviles = MetodoPagoC::select(['id', 'metodo','cellphonecode','cellphone','identificationNumber','banco', 'codigo'])->where('comercio_id', $this->comercio_id)->where('metodo','pagomovil')->get()->toArray();
        
        $this->transferencias = MetodoPagoC::select(['id', 'metodo','banco', 'codigo', 'titular','identificationNumber','nrocuenta'])->where('comercio_id', $this->comercio_id)->where('metodo','transferencia')->get()->toArray();

        $this->zelles = MetodoPagoC::select(['id', 'metodo', 'cellphonecode','cellphone','identificationNumber','pagoonline', 'email'])->where('comercio_id', $this->comercio_id)->where('pagoonline','zelle')->get()->toArray();

        $this->paypals = MetodoPagoC::select(['id', 'metodo', 'cellphonecode','cellphone','identificationNumber','pagoonline', 'email'])->where('comercio_id', $this->comercio_id)->where('pagoonline','paypal')->get()->toArray();
        
        return view('livewire.afiliado.pasarela');
    }
}
