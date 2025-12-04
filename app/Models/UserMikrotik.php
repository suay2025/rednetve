<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserMikrotik extends Model
{
    use HasFactory;
    //actualizar
    protected $fillable = [
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

}
