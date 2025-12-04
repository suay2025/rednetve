<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'nroTicket',
        'user_id',
        'user',
        'profile',
        'monto',
        'nrorouter',
    ];
}
