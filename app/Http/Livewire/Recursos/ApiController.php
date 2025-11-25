<?php

namespace App\Http\Livewire\Recursos;

use Livewire\Component;

use Illuminate\Http\Request;

use App\Http\Controllers\CartController;

use App\Models\Pedido;
use App\Models\PedidoDetalles;
use App\Models\PedidoTemporal;
use App\Models\PedidoDetallesTemporal;
use App\Models\Transaccion;
use App\Models\Pagomovil;

class ApiController extends Component
{
    public $cedula = '13053081';
    public $sistema = 'ddrsistema';
    public $total = '1';
    public $referencia = '1';
    public $celular= '1';
    public $correo= '1';
    public $titulo= '1';
    public $descripcion= '1';

	public $tokenId;

	public $id_suc;

	public function procesado(Request $request)
	{
		$this->tokenId = $request->get('ID');
		return view('livewire.recursos.procesado');
	}

    public function render()
    {
        return view('livewire.recursos.Index');
    }

    public function enviarPeticion(){
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => "https://open-weather-map27.p.rapidapi.com/weather",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => [
                "x-rapidapi-host: open-weather-map27.p.rapidapi.com",
                "x-rapidapi-key: Sign Up for Key"
            ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            //echo "cURL Error #:" . $err;
            dd("cURL Error #:" . $err);
        } else {
            //echo $response;
            dd($response);
        }
    }
    
    public function recibirDatos(Request $request){
	
		//return response()->json($request->get('campo'));

		//Creación de solicitud de pago
		$Payment = new IpgBdvPaymentRequest();            

		$Payment->idLetter= $request->get('identificationNac'); //Letra de la cédula - V, E o P
		$Payment->idNumber= $request->get('identificationNumber'); //Número de cédula
		$Payment->amount= $request->get('amount'); //Monto a combrar, DECIMAL
		$Payment->currency= $request->get('currency'); //Moneda del pago, 0 - Bolivar Fuerte, 1 - Dolar
		$Payment->reference= $request->get('reference'); //Código de referecia o factura
		$Payment->title= $request->get('title'); //Titulo para el pago, Ej: Servicio de Cable
		$Payment->description= $request->get('description'); //Descripción del pago, Ej: Abono mes de marzo 2017
		$Payment->email= $request->get('email');
		$Payment->cellphone= $request->get('cellphone');
		
		//$Payment->urlToReturn= $_SERVER['REQUEST_SCHEME']."://".$_SERVER['HTTP_HOST'].'/ipg2-bdv-demo/success.php?token={ID}'; //URL de retrono al finalizar el pago
		
		//$Payment->urlToReturn= "https://ddrsistemas.com/pasarelape/procesado.php";
		//$Payment->urlToReturn= "https://panexpres.com/pagosatisfactorio/{ID}";

		// $Payment->urlToReturn= "http://http://192.168.1.4:8000/pagosatisfactorio/{ID}";
		$Payment->urlToReturn= "https://panexpres.com/pagosatisfactorio/{ID}";
		// $Payment->urlToReturn= "https://panexpres.com/receive/{ID}";
		

		// actualizado

		$Payment->rifLetter= $request->get('rifLetter') ?? ''; //Letra de la cédula - V, E o P
		$Payment->rifNumber= $request->get('rifNumber') ?? ''; //Número de cédula

		$demo = "NO";
		if( $demo == "SI" ){                
			$PaymentProcess = new IpgBdv2 ("70527030","z0tTsYq3");
		} else {
			$PaymentProcess = new IpgBdv2 ("76669805","0Ih2wwzK");
		}

		$response = $PaymentProcess->createPayment($Payment);
		
		if ($response->success == true) // Se procesó correctamente y es necesario redirigir a la página de pago
		{
			if (strtolower(filter_input(INPUT_SERVER, 'HTTP_X_REQUESTED_WITH')) === 'xmlhttprequest') { //si es ajax
				header('Content-type: application/json');
				return response()->json($response);
				echo json_encode($response);
				
			}
			else{ //si no es ajax
				return response()->json('die');
				header("Location: ".$response->urlPayment); //W
				//die();
				return response()->json('die');
			}		
		}
		else
		{
			return response()->json('response 2');
			header('Content-type: application/json');
			echo json_encode($response);
		}
        
    }

	public function ChequePago(Request $request){
                
        $demo = "NO";
        
            //Instanciación de la API de pago con usuario y clave

            if( $demo == "SI" ) {
                $PaymentProcess = new IpgBdv2 ("70527030","z0tTsYq3");
            } else {
                $PaymentProcess = new IpgBdv2 ("76669805","0Ih2wwzK");
            }
            
            $response = $PaymentProcess->checkPayment($request->get('token'));

            return response()->json(json_encode($response));
            echo json_encode($response);
        
    }

	public function pagosatisfactorio($id){
        $token = $id;

		$datos = IpgBdv2::checkPayment($token);
        //$datos = $this->SearchPayment($token);
    
        if($datos->success == 'true')
        {
          $reference = $datos->reference;
    
          //$pedido_id = explode('-', str_replace('Pedido ', '', $reference, ))[0];
    
          //$pedido = Pedido::find($pedido_id);
		  $pedido = Pedido::where('pedido', $reference)->first();
    
          $paymentDate = date('Y-m-d H:i:s', strtotime($datos->paymentDate));
    
          $transaccion = Transacciones::create([
           'token' => $token,
           'paymentId' => auth()->user()->id,
           'comercio_id' => 1,
           'identificationNumber' => $datos->idNumber,
           'id_transaccion' => $datos->transactionId,
           'reference' => $datos->reference,
           'totalbs' => $datos->amount,
           'fechaPago' => $paymentDate,
           'title' => $datos->title,
           'description' => $datos->description,
           'status' => 1,
		   'pedido' => $datos->reference,
          ]);
    
           $pedido->update(
             [
               'reference' => $datos->transactionId,
               'confirmed' => 1,
             ]);

			$cart = new CartController;

        	$cart->onlyClear();

        }
    
        return view('externalviews.procesado', ['id_suc' => $token, 'success' => $datos->success] );
    }
	
	public function registrarReferencia($id)
    {
        $token = $id;

		$demo = "NO";
		if( $demo == "SI" ){                
			$PaymentProcess = new IpgBdv2 ("70527030","z0tTsYq3");
		} else {
			$PaymentProcess = new IpgBdv2 ("76669805","0Ih2wwzK");
		}
		
		$datos = $PaymentProcess->checkPayment($token);
        //$datos = $this->SearchPayment($token);
    
        if($datos->success == 'true')
        {
          $reference = $datos->reference;
    
          //$pedido_id = explode('-', str_replace('Pedido ', '', $reference, ))[0];
    
          //$pedido = Pedido::find($pedido_id);
		  $pedidotemporal = PedidoTemporal::where('nropedido', $reference)->first();

		  $pedidodetallestemporal = PedidoDetallesTemporal::where('nropedido', $reference)->first();
    
          $paymentDate = date('Y-m-d H:i:s', strtotime($datos->paymentDate));
    
          $transaccion = Transaccion::create([
           'token' => $token,
           'paymentId' => $token,
		   'cliente_id' => $pedidotemporal->user_id,
		   'user_id' => $pedidotemporal->user_id,
           'comercio_id' => $pedidotemporal->comercio_id,
           'identificationNumber' => $datos->idNumber,
           'id_transaccion' => $datos->transactionId,
           'reference' => $datos->reference,
           'totalbs' => $datos->amount,
           'fechaPago' => $paymentDate,
           'title' => $datos->title,
           'description' => $datos->description,
           'status' => 1,
		   'nropedido' => $datos->reference,
          ]);
    
           $pedidotemporal->update([
			'reference' => $datos->transactionId,
			'metodo' => 'tarjeta',
			'confirmed' => 1,
			]);

			$pedido = $pedidotemporal->toArray();

			$pedidodetalles = $pedidodetallestemporal->toArray();

        	Pedido::create($pedido);

			PedidoDetalles::create($pedidodetalles);

			$cart = new CartController;

        	$cart->onlyClear();

			\Cart::clear();

            return $token;

        }
    }

}

class IpgBdv2
{
	private const ACCESS_TOKEN = 'accessToken';

		// Produccion
		private const URL_API = 'https://biopago.banvenez.com/IPG2/api/Payments';
		private const URL_AUTH = 'https://biopago.banvenez.com/IPG2/connect/token';
	
	function __construct($user,$pass){

		session_start();		
		if(!isset($_SESSION[self::ACCESS_TOKEN])){
			$_SESSION[self::ACCESS_TOKEN] = '';
		}

		$this->user = $user;
		$this->pass = $pass;
		$this->messages = array(
				0 => "Operación efectuada correctamente",
				1 => "Request NO válido, verifique el formato con la documentación",
				2 => "La letra de la cédula es inválida",
				3 => "El número de cédula es inválido",
				4 => "La moneda es inválida, valores permitidos 1 (Bs.) o 2 (USD)",
				5 => "El título es inválido",
				6 => "La referencia es inválida",
				7 => "El monto es inválido",
				8 => "Se superó la cantidad máxima de envíos de códigos",
				9 => "Pago no encontrado",
				12 => "Pago se encuentra fuera del rango de fechas validas",
				13 => "El pago se encuentra expirado",
				14 => "Instrumento de pago inválido",
				15 => "Compra Rechazada. Transacción Fallida",
				16 => "Se excedió en el número de intentos de verificación de token",
				17 => "Token de autenticación inválido",
				18 => "El teléfono es inválido",
				19 => "Código de seguridad de tarjeta de crédito inválido",
				21 => "Fecha de expiración inválida",
				22 => "Token de autenticación expirado",
				23 => "La descripción es inválida",
				24 => "Correo electrónico inválido",
				25 => "Afiliado no válido",
				26 => "No se encontró el token de autenticación",
				27 => "No se encontró el método de pago",
				29 => "Error enviando el token de autenticación",
				30 => "No se encontró el grupo de pago",
				31 => "No se encontró el método de autenticación",
				32 => "No se encontró la transacción solicitada",
			    34 => "Token caducado",
				35 => "La letra del rif es inválida",
				36 => "El número de rif es inválido",
				99 => "Ha ocurrido un error en el servidor",
				401 => "Usuario y/o clave incorrectos",
			    404 => "No se pudo conectar con el servidor BDV",
				500 => "Ha ocurrido un error en el servidor BDV"
			);

	}
	
	public function checkPayment($paymentToken) {
		
		if($_SESSION[self::ACCESS_TOKEN] == ''){
			$this->refreshToken();	
		}
		
		$response = $this->getPayment($paymentToken);		
		
		if($response->responseCode == 401){				
			$this->refreshToken();				
			$response = $this->getPayment($paymentToken);
		}
	    
		return $response;
	}
	
    public function createPayment($paymentRequest) {
		
		if($_SESSION[self::ACCESS_TOKEN] == ''){
			$this->refreshToken();	
		}

		$response = $this->postPayment($paymentRequest);
	
		if($response->responseCode == 401){		
			$this->refreshToken();				
			$response = $this->postPayment($paymentRequest);
		}
	    
		return $response;		
    }	

	private function getMessageDescription($code) {
		 return $this->messages[$code];
	}

	private function refreshToken() {
			
		$curl = curl_init();

		$params = [
			CURLOPT_URL =>  self::URL_AUTH,
			CURLOPT_USERAGENT => 'IPG',
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 5,
			CURLOPT_POST => 1,
			CURLOPT_NOBODY => false,
			CURLOPT_HTTPHEADER => array(
				"cache-control: no-cache",
				"content-type: application/x-www-form-urlencoded",
				"accept: */*",
				"accept-encoding: gzip, deflate",
			),
			CURLOPT_POSTFIELDS => "grant_type=client_credentials&client_id=".$this->user."&client_secret=".$this->pass
		];

		curl_setopt_array($curl, $params);		
		
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		
		$resp = curl_exec($curl);
		
		$httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
		
		if ($httpcode == 200)
		{
			$auxResp = json_decode($resp);
			$_SESSION[self::ACCESS_TOKEN] = $auxResp->access_token;
		}
    }
	 
	private function postPayment($paymentRequest){
		 $curl = curl_init();

		$headers = [
			'Content-Type: application/json',
		    'Authorization: Bearer '.$_SESSION[self::ACCESS_TOKEN],
		];		

		$data = array(
				"currency" => $paymentRequest->currency,
				"amount" => is_numeric($paymentRequest->amount) ? $paymentRequest->amount : 0,
				"reference" => $paymentRequest->reference,
				"title" => $paymentRequest->title,
				"description" => $paymentRequest->description,
				"letter" => $paymentRequest->idLetter,
				"number" => $paymentRequest->idNumber,
				"email" => $paymentRequest->email,
				"cellphone" => $paymentRequest->cellphone,
				"urlToReturn" => $paymentRequest->urlToReturn,
				"rifLetter" => $paymentRequest->rifLetter,
				"rifNumber" => $paymentRequest->rifNumber);
		
		$str_data = json_encode($data);
		
		curl_setopt_array($curl, array(
			CURLOPT_HTTPHEADER=> $headers,
			CURLOPT_RETURNTRANSFER => 1,
			CURLOPT_URL => self::URL_API,
			CURLOPT_USERAGENT => 'IPG',
			CURLOPT_POST => 1,
			CURLOPT_POSTFIELDS => $str_data,
			CURLOPT_HTTPAUTH=> CURLAUTH_ANY,
			CURLOPT_TIMEOUT=> 5
		));

		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
			
		$resp = curl_exec($curl);
		
		$httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
		
		$response = new IpgBdvPaymentResponse();		
	
		if ($httpcode == 200)
		{
			$auxResp = json_decode($resp); 
			$response->responseCode = $auxResp->responseCode;
			if ($auxResp->responseCode == 0)
			{
				$response->paymentId =  $auxResp->paymentId;
				$response->urlPayment =  $auxResp->urlPayment;
				$response->success = true;
			}
			else
			{
				$response->success = false;
			}
		}
		else if( $httpcode == 401 )  
		{ 
			$response->responseCode = 401;
			$response->success = false;
		} 
		else if( $httpcode == 500 )  
		{ 
			$response->responseCode = 500;
			$response->success = false;
		} 
		else
		{ 
			$response->responseCode = 404;
			$response->success = false;
		} 
		
		$response->responseMessage = $this->getMessageDescription($response->responseCode);
		
		curl_close($curl); 
				
		return $response;
	}	
	
	private function getPayment($paymentToken)
	{
		$curl = curl_init();

		$headers = [
			'Content-Type: application/json',
			  'Authorization: Bearer '.$_SESSION[self::ACCESS_TOKEN],
		];
		
		$url = self::URL_API;
		
		curl_setopt_array($curl, array(
			CURLOPT_HTTPHEADER=> $headers,
			CURLOPT_RETURNTRANSFER => 1,
			CURLOPT_URL => self::URL_API.'/'.$paymentToken,
			CURLOPT_USERAGENT => 'IPG',
			CURLOPT_HTTPGET => TRUE,
			CURLOPT_HTTPAUTH=> CURLAUTH_ANY,
			CURLOPT_TIMEOUT=> 5
		));

		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		
		$response = new IpgBdvCheckPaymentResponse();
		$resp = curl_exec($curl);
		$httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

		if ($httpcode == 200)
		{
			$auxResp = json_decode($resp);
			
			$response->responseCode = $auxResp->responseCode;			

			if ($auxResp->responseCode == 0)
			{
				$response->status = $auxResp->status;			
				$response->success = true;				
				$response->idLetter = $auxResp->letter;
	 			$response->idNumber = $auxResp->number;
	 			$response->amount = $auxResp->amount;
	 			$response->currency = $auxResp->currency;
	 			$response->reference = $auxResp->reference ?? '';
	 			$response->title = $auxResp->title;
	 			$response->description = $auxResp->description;
				$response->transactionId = $auxResp->transactionId;
				$response->paymentMethodDescription = $auxResp->paymentMethodDescription ?? '';
				$response->paymentDate = $auxResp->createdOn;
				$response->paymentMethodNumber = $auxResp->pan ?? '';
				$response->token = $paymentToken;
				$response->authorizationCode = $auxResp->authorizationCode ?? '';
			}
			else
			{
				$response->success = false;
			}
		}
		else if( $httpcode == 401 )  
		{ 
			$response->responseCode = 401;
			$response->success = false;
		} 
		else if( $httpcode == 500 )  
		{ 
			$response->responseCode = 500;
			$response->success = false;
		} 
		else
		{ 
			$response->responseCode = 404;
			$response->success = false;
		} 
		
		$response->responseMessage = $this->getMessageDescription($response->responseCode);
		
		curl_close($curl);
				
		return $response;

		curl_close($curl); 

		return $resp;
	}
}

class IpgBdvPaymentRequest
{	
	// propiedades
	public $idLetter;
	public $idNumber;
	public $amount;
	public $currency;
	public $reference;
	public $title;
	public $description;
	public $email;
	public $cellphone;
	public $urlToReturn;
	public $rifLetter;
	public $rifNumber;
}

class IpgBdvPaymentResponse
{	
    // propiedades
	public $success;
	public $responseCode;
	public $responseMessage;
	public $paymentId;
	public $urlPayment;
}

class IpgBdvCheckPaymentResponse
{	
    // propiedades
	public $status;
	public $currency;
	public $amount;
	public $reference;
	public $title;
	public $description;
	public $idLetter;
	public $idNumber;
	public $transactionId;
	public $paymentMethodDescription;
	public $paymentDate;
	public $success;
	public $responseCode;
	public $responseMessage;
	public $paymentMethodNumber;
	public $token;
	public $authorizationCode;
}
