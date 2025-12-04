<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\ApiProcessPaymentController;
use App\Http\Controllers\Api\IpgBdvPaymentRequest;
use App\Http\Controllers\Api\IpgBdv2;
use App\Http\Controllers\Api\IpgBdvPaymentResponse;
use App\Http\Controllers\Api\IpgBdvCheckPaymentResponse;

use App\Http\Livewire\Notificacion\SmsSender;
use RouterOS\Client;
use RouterOS\Query;

use App\Models\Pagomovil;
use App\Models\Router;
use App\Models\UserMikrotik;

use Illuminate\Http\Request;

class MikrotikPasarelaController extends Controller
{
    //
	public $router; 

    public function mikrotikPasarela(Request $request)
	{
		// Accede a los datos enviados
        $datos = $request->all();
		
		//Creación de solicitud de pago
        $Payment = new IpgBdvPaymentRequest();  

		$plan = json_decode($request->post('planPasarela'));
		$reference = $request->post('reference') . '/' . $request->post('cellphone') . '/' . $request->post('nrorouter'). '/' .$plan->plan.'/'.$plan->costo;

		//$reference = $request->post('reference') . '/' . $request->post('cellphone') . '/' . $request->post('nrorouter');
		
		$Payment->idLetter= $request->post('identificationNac'); //Letra de la cédula - V, E o P
        $Payment->idNumber= $request->post('identificationNumber'); //Número de cédula
        $Payment->amount= $request->post('amount'); //Monto a combrar, DECIMAL
        $Payment->currency= $request->post('currency'); //Moneda del pago, 0 - Bolivar Fuerte, 1 - Dolar
        $Payment->reference= $reference; //Código de referecia o factura
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
        $remote_addr = $_SERVER['REMOTE_ADDR'];	

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
            ], 200)->header('Access-Control-Allow-Origin', '*');
		
	}

    public function registrarReferenciaMikrotik($id)
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
          	$referenceArray = explode('/', $datos->reference);

			$reference = $referenceArray[0];
			$telefono = $referenceArray[1];
			$nrorouter = $referenceArray[2];
			$plan = $referenceArray[3];
			$costo = $referenceArray[4];
    
        	$paymentDate = date('Y-m-d H:i:s', strtotime($datos->paymentDate));

			$transaccion = Pagomovil::create([
				'referencia' => $reference,
				'nrorouter' => $nrorouter,
				'telefono' => $telefono,
				'user' => $telefono,
				'banco' => 'BDVPasarela',
				'plan' => $plan,
				'monto' => $datos->amount,
				'externalcomment' => json_encode($datos) . '/ ip remoto: '.$_SERVER['REMOTE_ADDR'],
				'status' => 'PAGADO',
				'token' => $token,
				'active' => false,
			]);

			// Crear usuario
			$newUser = $this->createUserHotspot($nrorouter, $telefono, $plan.'/'.$costo);

            return $newUser;

        }else{
			$newUser = [
					'user' => '',
					'password' => '',
					'status' => false,
				];
			return $newUser;
		}
    }

	public function configRouter()
    {
        if(config('app.host') == 'ip'){
            $host = $this->router->ip;
        }else{
            $host = $this->router->dns;
            //$host = 'typej.ddns.net';
            //$host = '192.168.1.6';
        }        
        
        // Iniciar la conexión
        $client = new Client([
            'host' => $host,
            'user' => $this->router->admin,
            'pass' => $this->router->password,
            'port' => 8728,
        ]);

        return $client;
    }

	public function createUserHotspot($nrorouter, $user, $profile)
    {
        try {
			
			$this->router = Router::where('nrorouter', $nrorouter)->first();

			$client = $this->configRouter();

			$userMikrotik = UserMikrotik::where('name', $user)->first();
			$server = 'all';

			if(!$userMikrotik)
			{
				$password = $this->randomPassword();

				$userMikrotik = UserMikrotik::create([
					'server' => $server,
					'name' => $user,
					'password' => $password,
					'profile' => $profile,
				]);

				// Crear la consulta para añadir el usuario
				$query = (new Query('/ip/hotspot/user/add'))
					->equal('server', 'all')
					->equal('name', $user)
					->equal('password', $password)
					->equal('profile', $profile);
				
				// Ejecutar la consulta
				$client->query($query)->read();
				// Tarea completada.

				$newUser = [
					'user' => $user,
					'password' => $password,
					'status' => true,
				];

				// buscar id
				// $query = (new Query('/ip/hotspot/user/print'))
				// 	->where('name', $user);
				// $response = $client->query($query)->read();
				$mikrotik_id = $this->searchId_mikrotik($client, $user);

				$userMikrotik = UserMikrotik::create([
                        'mikrotik_id' => $mikrotik_id, 
                        'name'=>$user,
                        'server'=>$server,
                        'profile'=>$profile,                        
                    ]);

			}else{
				$newUser = [
                        'user' => $user,
                        'password' => $userMikrotik->password,
                        'status' => true,
                    ];
				$userMikrotik->update(['profile'=>$profile]);
				$mikrotik_id = $userMikrotik->mikrotik_id;
				$password = $userMikrotik->password;
				if(!$mikrotik_id){
					$mikrotik_id = $this->searchId_mikrotik($client, $user);
					$userMikrotik->update(['mikrotik_id'=>$mikrotik_id]);
				}
				// Modificar profile
				$query = (new Query('/ip/hotspot/user/set'))
					->equal('.id', $mikrotik_id)
					->equal('password', $password)
					->equal('profile', $profile);

				$response = $client->query($query)->read();

				$this->cleanUptime($mikrotik_id, $newUptime = "00:00:00");
			}
			
			// asignar limit uptime
			$this->defineUptimeLimit($userMikrotik, $mikrotik_id, $profile, $newUptimeLimit = "00:00:15");

			//Enviar sms con el user y la contraseña
			//$this->sendSms($user, $password);

			//$this->login($nrorouter, $user, $password);			

			return $newUser;

		} catch (Exception $e) {

			$newUser = [
				'user' => '',
				'password' => '',
				'status' => false,
			];

			return $newUser;
			
		} 

		//$validatedData['password'] = bcrypt($validatedData['password']);
    }

	public function searchId_mikrotik($client, $user)
	{
		try {
			// buscar id
			$query = (new Query('/ip/hotspot/user/print'))
				->where('name', $user);
			$response = $client->query($query)->read();

			return  $response[0]['.id'];


		} catch (\Throwable $th) {
			return false;
		}
		
	}

	public function defineUptimeLimit(UserMikrotik $userMikrotik, $id, $profile, $newUptimeLimit = "00:00:15")
    {

        $client = $this->configRouter();

        try {
            //buscar tiempo del perfil de user
            $newUptimeLimit = $this->timeProfileUser($profile);
            
            $query = (new Query('/ip/hotspot/user/set'))
                ->equal('.id', $id)
                ->equal('limit-uptime', $newUptimeLimit);


            $response = $client->query($query)->read();

			$userMikrotik->update(['limitUptime' => $newUptimeLimit ]);
            
            return true;
            

        } catch (\Exception $e) {
            return false;
        }        
    }

	public function timeProfileUser($name)
    {
        $client = $this->configRouter();
        
        // Buscar el usuario
        $query = (new Query('/ip/hotspot/user/profile/print'))
            ->where('name', $name);
            
        // Ejecutar la consulta
        $time = $client->query($query)->read();

        if (isset($time[0]['session-timeout'])) {
            return $time[0]['session-timeout'];
        }else{
            return '';
        }
    }

	public function cleanUptime($id, $newUptime = "00:00:00")
    {
        $client = $this->configRouter();

        $userName = "user"; // El nombre del usuario a modificar
        
        try {
            
            $query = (new Query('/ip/hotspot/user/reset-counters'))
                ->equal('.id', $id);


            $response = $client->query($query)->read();
            
            return true;
            

        } catch (\Exception $e) {
            return false;
        }

        
    }

	private function randomPassword() {
		// $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
		$alphabet = '1234567890';
		$pass = array(); //remember to declare $pass as an array
		$alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
		for ($i = 0; $i < 8; $i++) {
			$n = rand(0, $alphaLength);
			$pass[] = $alphabet[$n];
		}
		return implode($pass); //turn the array into a string
	}

	public function sendSms($user, $password)
    {
        $message = 'Su cuenta se encuentra activa. Usuario: ' . $user . ' Clave: ' . $password;
        $sender = new SmsSender;
        $sender->callSendSms($user, $message);

    }

	public function login($nrorouter, $username, $password)
    {
        try {

            $router = Router::where('nrorouter', $nrorouter)->first();

			if(config('app.host') == 'ip'){
				$host = $router->ip;
			}else{
				$host = $router->dns;
			}
			
			$datos = [
				'host' => $host,
				'user' => $router->admin,
				'pass' => $router->password,
			];

            //$macAddress = '1A-2B-3C-4D-5E';
			$client = new Client($datos);

            //$query = (new Query('/ip/hotspot/login'))
			$query = (new Query('/login'))
                ->equal('name', $username)
                ->equal('password', $password);
            //     ->equal('mac-address', $macAddress);

            $response = $client->query($query)->read();

            return true;

            // Verificar si el login fue exitoso según la respuesta de MikroTik
            // if (empty($response)) {
            //     return response()->json([
            //         'status' => true,
            //         'valor' => 'Usuario autenticado exitosamente.',
            //         // Aquí puedes redirigir al usuario
            //         // El login.html debe manejar la redirección del navegador con JS
            //     ]);
            // } else {
            //     return response()->json([
            //         'status' => false,
            //         'valor' => 'Error de autenticación con MikroTik.',
            //         'response' => $response
            //     ]);
            // }

        } catch (Exception $e) {
            // Manejar errores de conexión o de la API
            return false;
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
