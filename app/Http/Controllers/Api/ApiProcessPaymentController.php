<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApiProcessPaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
	public function apiprocesspayment(Request $request)
	{
		// Accede a los datos enviados
        $datos = $request->all();
		
		//Creación de solicitud de pago
        $Payment = new IpgBdvPaymentRequest();        
		
		$Payment->idLetter= $request->post('identificationNac'); //Letra de la cédula - V, E o P
        $Payment->idNumber= $request->post('identificationNumber'); //Número de cédula
        $Payment->amount= $request->post('amount'); //Monto a combrar, DECIMAL
        $Payment->currency= $request->post('currency'); //Moneda del pago, 0 - Bolivar Fuerte, 1 - Dolar
        $Payment->reference= $request->post('reference'); //Código de referecia o factura
        $Payment->title= $request->post('title'); //Titulo para el pago, Ej: Servicio de Cable
        $Payment->description= $request->post('description'); //Descripción del pago, Ej: Abono mes de marzo 2017
        $Payment->email= $request->post('email');
        $Payment->cellphone= $request->post('cellphone');    
		
		$user = $request->post('user');
		
        //$Payment->urlToReturn= $_SERVER['REQUEST_SCHEME']."://".$_SERVER['HTTP_HOST'].'/ipg2-bdv-demo/success.php?token={ID}'; //URL de retrono al finalizar el pago

		$Payment->urlToReturn= "https://"."://".$_SERVER['HTTP_HOST'].'/ipg2-bdv-demo/success.php?token={ID}'; //URL de retrono al finalizar el pago

        //$Payment->urlToReturn= "http://localhost:8585/";
        // $Payment->urlToReturn= "https://ddrsistemas.com/pasarelape/procesado.php";

		//usado para panexpres.com
        //$Payment->urlToReturn= "https://panexpres.com/pagosatisfactorio/{ID}";	

		//usado para Mikrotik
		$Payment->urlToReturn= "https://panexpres.com/pagosatisfactorioMikrotik/{ID}";

        $Payment->rifLetter= $request->post('rifLetter') ?? ''; //Letra de la cédula - V, E o P
        $Payment->rifNumber= $request->post('rifNumber') ?? ''; //Número de cédula
		
		$demo = "NO";

        if( $demo == "SI" ) {
            $PaymentProcess = new IpgBdv2 ("70527030","z0tTsYq3");
        } else {
             $PaymentProcess = new IpgBdv2 ("76669805","0Ih2wwzK");
        }

        $response = $PaymentProcess->createPayment($Payment);
        
        if ($response->success == true) // Se procesó correctamente y es necesario redirigir a la página de pago
        {
			$resultado = 'true';
			$urlPayment = $response->urlPayment;
			// if (strtolower(filter_input(INPUT_SERVER, 'HTTP_X_REQUESTED_WITH')) === 'xmlhttprequest') { //si es ajax
            //      header('Content-type: application/json');
            //      echo json_encode($response);			
            //  }
            //  else{ //si no es ajax
            //      header("Location: ".$response->urlPayment); //W
            //      die();
            //  }		
        }
        else
        {
			$resultado = 'false';
             header('Content-type: application/json');
             echo json_encode($response);
        }
		/*
		*/		
		return response()->json([
                // 'message' => 'Datos recibidos completos',
                // 'identificationNac' => $request->post('identificationNac'),
				// 'identificationNumber' => $request->post('identificationNumber'),
				// 'amount' => $request->post('amount'),
				// 'currency' => $request->post('currency'),
				// 'reference' => $request->post('reference'),
				// 'title' => $request->post('title'),
				// 'description' => $request->post('description'),
				// 'email' => $request->post('email'),
				// 'cellphone' => $request->post('cellphone'),
				// 'cellphone1' => $request->post('cellphone1'),
				// 'rifLetter' => $request->post('rifLetter'),
				// 'rifNumber' => $request->post('rifNumber'),
				// 'datos' => $datos,
				// 'resultado' => $resultado,
				// 'urlPayment' => $response->urlPayment,
				'response' => $response
            ], 200);
		
	}

    public function index()
    {
		
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
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