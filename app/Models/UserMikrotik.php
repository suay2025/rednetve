<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserMikrotik extends Model
{
    use HasFactory;
    //actualizar
    protected $fillable = [
        'user_id',
        'mikrotik_id',
        'server',
        'name',
        'password',
        'address',
        'macaddress',
        'profile',
        'routes',
        'email',
        'limitUptime',
        'limitBytesIn',
        'limitBytesOut',
        'limitBytesTotal',
        'uptime',
        'bytesIn',
        'packetsIn',
        'bytesOut',
        'packetsOut',
        'active',
    ];

    /* ultima entrada*/
    
    public function tickets(): HasMany
    {
        return $this->hasMany(TicketUser::class, 'user_id', 'id')->latest();
    }

    /**
     * Relación para obtener solo el último ticket del usuario (Usando latestOfMany).
     */
    public function latestTicket(){
        
        return $this->hasOne(TicketUser::class, 'user_id', 'id')->latestOfMany();
    }

}
