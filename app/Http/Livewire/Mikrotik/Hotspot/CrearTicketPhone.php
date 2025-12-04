<?php

namespace App\Http\Livewire\Mikrotik\Hotspot;

use Livewire\Component;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

use RouterOS\Client;
use RouterOS\Query;

use App\Models\Router;
use App\Models\TicketUser;
use App\Models\UserMikrotik;

use Illuminate\Http\Request;
//use \RouterOS; // Asegúrate de que este 'use' apunte al namespace correcto

class CrearTicketPhone extends Component
{
    public $nameshotspots = [];

    public $namesprofiles = [];

    public $state = [];

    public $router;

    public $usershotspot = [];

    public $showEditModal = false;

    public $datos = [
        'host' => '192.168.2.1',
        'user' => 'admin',
        'pass' => 'admin123'
    ];

    public $cuenta = [
        'id' => '',
        'name' => '',
        'password' => '',
    ];
    public $cuentas = [];

    public function mount($nrorouter = 'R001')
    {        
        $this->router = Router::where('nrorouter', $nrorouter)->first();
        //todos los hotspots
        $hotspots = $this->exeQuery($this->datos, '/ip/hotspot/print');
        $this->nameshotspots = [];
        foreach ($hotspots as $elemento) {
            $this->nameshotspots[] = $elemento['name'];
        }

        //todos los profiles
        $profiles = $this->exeQuery($this->datos, '/ip/hotspot/user/profile/print');
        $this->namesprofiles = [];
        foreach ($profiles as $elemento) {
            $this->namesprofiles[] = $elemento['name'];
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

    public function exeQuery($datos, $query)
    {
        try {

                $client = $this->configRouter();

                //$client = new Client($datos);

                $query = new Query($query);

                $result = $client->query($query)->read();

            } catch (Exception $e) {
                $result = "Caught exception: " . $e->getMessage() . "\n";
            } 
        return $result;
    }
    
    public function createHotspotUsers()
    {
        
        $messages = [
                    'required' => 'El campo :attribute es requerido.',
                    'name.max' => 'The name cannot exceed 255 characters.',
                ];

        $validatedData = Validator::make($this->state, [
            'server' => 'required|not_in:0',
            'profile' => 'required|not_in:0',
            'cellphone' => 'required',
        ], $messages)->validate();

        try {
            
            $client = $this->configRouter();
            
            $username = $validatedData['cellphone'];

            $userMikrotik = UserMikrotik::where('name', $username)->first();

            $profile = $validatedData['profile'];

            if(!$userMikrotik)
			{                
                // Genera la contraseña de 8 dígitos
                $password = $this->randomPassword();

                $userMikrotik = UserMikrotik::create([
					'server' => $validatedData['server'],
					'name' => $username,
					'password' => $password,
					'profile' => $validatedData['profile'],
                    'routes' => $this->router->nrorouter,
				]);

                $query = (new Query('/ip/hotspot/user/add'))
                    ->equal('server', $validatedData['server'])
                    ->equal('name', $username)
                    ->equal('password', $password)
                    ->equal('profile', $profile);
                // Ejecutar la consulta
                $response = $client->query($query)->read();
                // Tarea completada.

                $this->cuentas[] = ['name' => $username, 'password' => $password];

                $this->dispatchBrowserEvent('hide-form', ['message' => 'Se han creado el usuario ' . $username . ' de Hotspot con éxito.']);

                $newUser = [
					'user' => $username,
					'password' => $password,
					'status' => true,
				];

                // buscar id
                // $query = (new Query('/ip/hotspot/user/print'))
                //     ->where('name', $username);
                // $response = $client->query($query)->read();

                // $mikrotik_id = $response[0]['.id'];

                $mikrotik_id = $this->searchId_mikrotik($client, $username);
				
                $userMikrotik->update(['mikrotik_id'=>$mikrotik_id]);

            }else{
                
				$newUser = [
                        'user' => $username,
                        'password' => $userMikrotik->password,
                        'status' => true,
                    ];

				$userMikrotik->update(['profile'=>$profile]);
				$mikrotik_id = $userMikrotik->mikrotik_id;
				$password = $userMikrotik->password;

                if(!$mikrotik_id){
					$mikrotik_id = $this->searchId_mikrotik($client, $username);
                    $userMikrotik->update(['mikrotik_id'=>$mikrotik_id]);
				}

				// Modificar profile
				$query = (new Query('/ip/hotspot/user/set'))
					->equal('.id', $mikrotik_id)
					->equal('password', $password)
					->equal('profile', $profile);

				$response = $client->query($query)->read();

                $this->cleanUptime($mikrotik_id, $newUptime = "00:00:00");

                $this->cuentas[] = ['name' => $username, 'password' => $password];

                $this->dispatchBrowserEvent('hide-form', ['message' => 'Se han actualizo el usuario ' . $username . ' de Hotspot con éxito.']);
			}

            // asignar limit uptime
			$this->defineUptimeLimit($userMikrotik, $mikrotik_id, $profile, $newUptimeLimit = "00:00:15");

            // registra user en modelo TicketUser
            TicketUser::create([
                'nroTicket' => $this->randomNroTicket(),
                'user_id' => auth()->user()->id,
                'user' => $userMikrotik->name,
                'monto' => explode('/', $profile)[1],
                'profile' => $profile,
                'nrorouter' => $this->router->nrorouter,
            ]);            

            // Puedes manejar la respuesta si es necesario
            // Por ejemplo, registrar en la base de datos de Laravel si el usuario se creó correctamente            

            //llamar a graficar qr
            $this->dispatchBrowserEvent('crear-qr', ['usershotspot' => $this->cuentas]);

            //return 'Se han creado 10 usuarios de Hotspot con éxito.';

        } catch (\Exception $e) {
            return 'Error: ' . $e->getMessage();
        }
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

    public function selectUsershotspots($users, $hotspot)
    {
        $usershotspots = [];

        foreach ($users as $elementos) {            
            if(array_key_exists('server', $elementos))
            {
                if($elementos['server'] == $hotspot){
                    $usershotspots[] = ['name' => $elementos['name'], 'password' => $elementos['password']];
                }                
            }
            
        }
        return $usershotspots;
    }

    /**
     * Genera una contraseña de 8 dígitos con un dígito y un carácter especial.
     */
    private function generatePassword()
    {
        $chars = '!@#$%^&*()_+-=[]{}|;:,.<>?';
        $specialChar = $chars[rand(0, strlen($chars) - 1)];

        // Genera 7 caracteres aleatorios
        $randomChars = substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 7);

        // Inserta un dígito en una posición aleatoria
        $position = rand(0, 7);
        $password = substr_replace($randomChars, rand(0, 9), $position, 0);

        // Inserta el carácter especial en una posición aleatoria
        $position = rand(0, 8);
        $password = substr_replace($password, $specialChar, $position, 0);

        return $password;
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

    private function randomNroTicket() {
		// $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
		$alphabet = '1234567890';
		$nroTicket = array(); //remember to declare $pass as an array
		$alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
		for ($i = 0; $i < 8; $i++) {
			$n = rand(0, $alphaLength);
			$nroTicket[] = $alphabet[$n];
		}

        $resp = TicketUser::where('nroTicket', implode($nroTicket))->first();        

        if($resp != null){
            $nroTicket = $this->randomNroTicket();
        }
        return implode($nroTicket); //turn the array into a string
	}

    public function showUsersHotspot()
    {
        $messages = [
                    'required' => 'El campo :attribute es requerido.',
                    'name.max' => 'The name cannot exceed 255 characters.',
                ];

        $validatedData = Validator::make($this->state, [
            'server' => 'required|not_in:0',
        ], $messages)->validate();
        
        $users = $this->exeQuery($this->datos, '/ip/hotspot/user/print');

        $this->usershotspot = $this->selectUsershotspots($users, $validatedData['server']);

        $this->dispatchBrowserEvent('crear-qr', ['usershotspot' => $this->usershotspot]);

        
    }

    public function render()
    {
        return view('livewire.mikrotik.hotspot.crear-ticket-phone');
    }

}
