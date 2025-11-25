<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Router extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'ip',
        'macAddress',
        'dns',
        'identity',
        'admin',
        'password',
        'location',
        'nrorouter',
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }    
}
