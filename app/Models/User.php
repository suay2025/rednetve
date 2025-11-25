<?php

namespace App\Models;

use App\Models\ComercioVehiculo;

use App\Mail\verification;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;

use Mail;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    const ROLE_ADMIN = 'admin';
    const ROLE_USER = 'user';
    const ROLE_CLIENTE = 'cliente';
    const ROLE_ALIADO = 'aliado';
    const ROLE_DELIVERY = 'delivery';
    const ACTIVO = 'activo';
    const SUSPENDIDO = 'suspendido';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'identificationNac',
        'identificationNumber',
        'names',
        'surnames',
        'name',
        'email',
        'password',
        'password_mikrotik',
        'avatar',
        'role',
        'status',
        'external_id',
        'external_auth',
        'active',
        'nrorouter',
        'profile',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'email_verified_at',
        'created_at',
        'updated_at',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $appends = [
        'avatar_url',
    ];

    public function getAvatarUrlAttribute()
    {
        if ($this->avatar && Storage::disk('avatars')->exists($this->avatar)) {
            return Storage::disk('avatars')->url($this->avatar);
        }

        return asset('noimage.png');
    }

    public function isAdmin()
    {
        if ($this->role !== self::ROLE_ADMIN) {
            return false;
        }

        return true;
    }

    public function isUser()
    {
        if ($this->role !== self::ROLE_USER) {
            return false;
        }

        return true;
    }

    public function isCliente()
    {
        if ($this->role !== self::ROLE_CLIENTE) {
            return false;
        }

        return true;
    }

    public function isAliado()
    {
        if ($this->role !== self::ROLE_ALIADO) {
            return false;
        }

        return true;
    }

    public function isDelivery()
    {
        if ($this->role !== self::ROLE_DELIVERY) {
            return false;
        }

        return true;
    }

    public function datosbasicos()
    {
        return $this->hasOne(DatosBasicos::class)->withDefault([
            'telefono' => '',
            'direccion' => '',
        ]);
    }    

    public function comercios()
    {
        return $this->hasMany(Comercio::class);
    }    

    public function client()
    {
        return $this->hasOne(Client::class, 'user_id', 'id');
    }    

    public function OperacionNoConfirmada()
    {
        return Transaccion::query()
            ->where('id', $this->id)
            ->where('status', 'norevisado')
            ->count();
    }

    public function rol(){
        switch ($this->role) {
            case 'admin':
                return 'Administrador';
                break;
            case 'cliente':
                return 'Cliente';
                break;
            case 'afiliado':
                return 'Afiliado';
                break;
            
        }
    }

    public function showVehiculos($user_id)
    {
        $vehiculos = Vehiculo::whereHas('comercioVehiculo', function($q)  use ($user_id) {
            $q->where('user_id', $user_id);
        })
        ->with('manufacturer')
        ->get();

        return $vehiculos;
    }

    public function pedidos()
    {
        return $this->hasMany(User::class, 'user_id', 'id');
    }

    public function email($vista, $titulo)
    {
        $token = Str::random(64);
        //Envío de email al usuario
        Mail::send('email.'.$vista, ['token' => $token, 'correo' => $this->email ], function($message) use($request){
            $message->to($this->email);
            $message->subject($titulo);
        });
    }

    

}
