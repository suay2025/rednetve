<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketUser extends Model
{
    use HasFactory;

    const ACTIVO = 'activo';
    const NOACTIVO = 'noactivo';
    const ANULADO = 'anulado';

    protected $fillable = [
        'nroTicket',
        'user_id',
        'userMikrotik_id',
        'server',
        'user',
        'password',
        'profile',
        'prefijo',
        'monto',
        'nrorouter',
        'status',
        'comment',
    ];
    
    public function aliado()
    {
        $user = User::where('id', $this->user_id)->first();
        if($user){
            return $user;
        }else{
            return null;
        }

    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(UserMikrotik::class, 'user_id', 'id');
    }

    public function latestTicket()
    {
        // Esto automáticamente usa 'created_at' o la clave primaria para determinar el "último"
        return $this->where('user_id', 'id')->latestOfMany();
    }
}
