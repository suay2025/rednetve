<?php

namespace App\Http\Livewire\Mikrotik\Hotspot;

use Livewire\Component;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

use RouterOS\Client;
use RouterOS\Query;

use App\Models\Router;

use Illuminate\Http\Request;
//use \RouterOS; // Asegúrate de que este 'use' apunte al namespace correcto

class CrearTicket extends Component
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
            'totalTicket' => 'required|not_in:0',
        ], $messages)->validate();

        try {

            $client = $this->configRouter();
            
            for ($i = 0; $i < intval($validatedData['totalTicket']); $i++) {
                // Genera un nombre de usuario único (puedes ajustarlo)
                $username = 'user' . str_pad($i + 1, 2, '0', STR_PAD_LEFT);
                
                // Genera la contraseña de 8 dígitos
                $password = $this->randomPassword();

                //dd($validatedData['server']);
                
                $query = (new Query('/ip/hotspot/user/add'))
                    ->equal('server', $validatedData['server'])
                    ->equal('name', $username)
                    ->equal('password', $password)
                    ->equal('profile', $validatedData['profile']);
                // Ejecutar la consulta
                $response = $client->query($query)->read();
                // Tarea completada.

                $this->cuentas[] = ['name' => $username, 'password' => $password];

                $this->dispatchBrowserEvent('hide-formHotspot', ['message' => 'Se han creado el usuario ' . $username . ' de Hotspot con éxito.']);

                // Puedes manejar la respuesta si es necesario
                // Por ejemplo, registrar en la base de datos de Laravel si el usuario se creó correctamente
            }

            //llamar a graficar qr
            $this->dispatchBrowserEvent('crear-qr', ['usershotspot' => $this->cuentas]);

            //return 'Se han creado 10 usuarios de Hotspot con éxito.';

        } catch (\Exception $e) {
            return 'Error: ' . $e->getMessage();
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

        return view('livewire.mikrotik.hotspot.crear-ticket');
    }

}
