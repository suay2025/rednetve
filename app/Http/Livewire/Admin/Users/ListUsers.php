<?php

namespace App\Http\Livewire\Admin\Users;

use App\Http\Livewire\Admin\AdminComponent;
use App\Models\User;
use App\Models\UserMikrotik;
use App\Models\DatosBasicos;
use App\Models\Router;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use RouterOS\Client;
use RouterOS\Query;

class ListUsers extends AdminComponent
{
	use WithFileUploads;

	public $state = [];

	public $user;

	public $showEditModal = false;

	public $userIdBeingRemoved = null;

	public $searchTerm = null;

    protected $queryString = ['searchTerm' => ['except' => '']];

	public $photo;

    public $sortColumnName = 'created_at';

    public $sortDirection = 'desc';

	public function changeRole(User $user, $role)
	{
		Validator::make(['role' => $role], [
			'role' => [
				'required',
				Rule::in(User::ROLE_ADMIN, User::ROLE_USER, User::ROLE_CLIENTE, User::ROLE_ALIADO),
			],
		])->validate();

		$user->update(['role' => $role]);

		$this->dispatchBrowserEvent('updated', ['message' => "Rol cambió a {$role} satisfactoriamente."]);
	}

	public function changeStatus(User $user, $status)
	{
		Validator::make(['status' => $status], [
			'status' => [
				'required',
				Rule::in(User::ACTIVO, User::SUSPENDIDO),
			],
		])->validate();

		if($status=='activo'){
			$active = true;
		}else{
			$active = false;
		}

		$user->update(['status' => $status, 'active' => $active]);

		$this->dispatchBrowserEvent('updated', ['message' => "Rol cambió a {$status} satisfactoriamente."]);
	}

	public function addNew()
	{
		$this->reset();

		$this->showEditModal = false;

		$this->dispatchBrowserEvent('show-form');
	}

	public function createUser()
	{
		$validatedData = Validator::make($this->state, [
			'name' => 'required',
			'email' => 'required|email|unique:users',
			'password' => 'required|confirmed',
			'role' => 'required',
		])->validate();

		$validatedData['password'] = bcrypt($validatedData['password']);

		if ($this->photo) {
			$validatedData['avatar'] = $this->photo->store('/', 'avatars');
		}

		User::create($validatedData);

		// session()->flash('message', 'User added successfully!');

		$this->dispatchBrowserEvent('hide-form', ['message' => 'Usuario agregado satisfactoriamente!']);
	}

	public function edit(User $user)
	{
		$this->reset();

		$this->showEditModal = true;

		$this->user = $user;

		$this->state = $user->toArray();

		$this->dispatchBrowserEvent('show-form');
	}

	public function updateUser()
	{
		$validatedData = Validator::make($this->state, [
			'name' => 'required',
			'email' => 'required|email|unique:users,email,'.$this->user->id,
			'password' => 'sometimes|confirmed',
			'role' => 'required',
			'identificationNac' => 'required',
			'identificationNumber' => 'required',
		])->validate();

		if(!empty($validatedData['password'])) {
			$validatedData['password'] = bcrypt($validatedData['password']);
		}

		if ($this->photo) {
			Storage::disk('avatars')->delete($this->user->avatar);
			$validatedData['avatar'] = $this->photo->store('/', 'avatars');
		}

		$this->user->update($validatedData);

		$this->dispatchBrowserEvent('hide-form', ['message' => 'Usuario actualizado satisfactoriamente!']);
	}

	public function confirmUserRemoval($userId)
	{
		$this->userIdBeingRemoved = $userId;

		$this->dispatchBrowserEvent('show-delete-modal');
	}

	public function deleteUser()
	{
		$user = User::findOrFail($this->userIdBeingRemoved);

		$user->delete();

		$this->dispatchBrowserEvent('hide-delete-modal', ['message' => 'Usuario eliminado satisfactoriamente!']);
	}

    public function sortBy($columnName)
    {
        if ($this->sortColumnName === $columnName) {
            $this->sortDirection = $this->swapSortDirection();
        } else {
            $this->sortDirection = 'asc';
        }

        $this->sortColumnName = $columnName;
    }

    public function swapSortDirection()
    {
        return $this->sortDirection === 'asc' ? 'desc' : 'asc';
    }

    public function updatedSearchTerm()
    {
        $this->resetPage();
    }

    public function render()
    {

    	$users = User::query()
    		->where('name', 'like', '%'.$this->searchTerm.'%')
    		->orWhere('email', 'like', '%'.$this->searchTerm.'%')
            ->orderBy($this->sortColumnName, $this->sortDirection)
            ->paginate(15);

        return view('livewire.admin.users.list-users', [
        	'users' => $users,
        ]);
    }

	public function registerUser(Request $request)
	{
		// Accede a los datos enviados
		try {

			// Obtener todos los datos del formulario
			$todosLosCampos = $request->all();

			// Obtener un campo específico
			$name = $request->input('name');
			$email = $request->input('email');

			$nrorouter = $request->input('nrorouter');
			$cellphonecode = $request->input('cellphonecode');
			$cellphone = $request->input('cellphone');
			$password = $request->input('inputPassword');
			$password_mikrotik = $request->input('inputPassword');
			$profile = $request->input('planes');

			$user = User::where('email', $email)->first();
			if(!$user){

				$user = User::create([
					'name' => $request->input('name'),
					'names' => $request->input('names'),
					'surnames' => $request->input('surnames'),
					'identificationNac' => $request->input('identificationNac'),
					'identificationNumber' => $request->input('identificationNumber'),
					'email' => $request->input('email'),
					'password' => bcrypt($password),
					'password_mikrotik' => $password_mikrotik,
					'active' => 0,
					'nrorouter' => $request->input('nrorouter'),
					'role' => $request->input('role'),
					'status' => 'suspendido',
					'profile' => $request->input('planes'),
				]);

				$datosbasicos = DatosBasicos::where('cellphone', $cellphone)->first();

				if($datosbasicos){

					//$userNew = $this->createUserHotspot($nrorouter, $cellphone, $profile, $password);

					return response()->json([
						'message' => 'Error, el Telefono se encuentra registrado', 
						'datos' => $todosLosCampos,
						'cellphone' => $cellphone,
						'userNew' => $userNew,
						'password' => $password,
						'success' => false,
					]);

				}else{

					DatosBasicos::create([
						'user_id' => $user->id,
						'cellphonecode' => $request->input('cellphonecode'),
						'cellphone' => $request->input('cellphone'),
					]);

					//$user = $this->createUserHotspot($nrorouter, $cellphone, $profile, $password);

					return response()->json([
						'message' => 'Usuario creado satisfactoriamente', 
						'datos' => $todosLosCampos,
						'user' => $user,
						'password' => $password_mikrotik,
						'success' => true,
					]);
				}			

				// Puedes hacer lo que necesites con los datos aquí
				// Por ejemplo, guardarlos en la base de datos
			}else{
				return response()->json([
					'message' => 'El Usuario ya existe!!',
					'datos' => $todosLosCampos,
					'success' => false,
				]);
			}
			

		} catch (Exception $e) {
            // Manejar errores de conexión o de la API
            return response()->json(['success' => false, 'message' => 'Error en la creación del usuario.', 'error' => $e->getMessage()], 500);
        }
	}

	public function configRouter()
    {
        try {
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

			} catch (Exception $e) {

				$newUser = [
					'user' => '',
					'password' => '',
					'status' => false,
					'error' => 510, 
				];

				return response()->json([
					'user'  => $newUser, 
					'error' => 510, 
				]);
				
				
			} 
		
    }

	public function createUserHotspot($nrorouter, $user, $profile, $password)
	{
        try {
			
			$this->router = Router::where('nrorouter', $nrorouter)->first();

			$client = $this->configRouter();

			$userMikrotik = UserMikrotik::where('name', $user)->first();
			$server = 'all';

			if(!$userMikrotik)
			{
				$userMikrotik = UserMikrotik::create([
					'server' => $server,
					'name' => $user,
					'password' => $password,
					'profile' => $profile,
					'routes' => $nrorouter,
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

				
			}

			$newUptimeLimit = $this->timeProfileUser($profile);
			
			// asignar limit uptime
			$newUptime = $this->defineUptimeLimit($userMikrotik, $mikrotik_id, $profile, $newUptimeLimit = "00:00:15");

			$this->cleanUptime($mikrotik_id, $newUptimeLimit = "00:00:00");

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
	
}
