<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\DatosBasicos;
class SearchController extends Controller
{
    
    public function autocompleteCliente(Request $request)
    {

        $data = DB::table('users')
            ->join('datos_basicos', 'users.id', '=', 'datos_basicos.user_id')
            ->where(function($query)  use ($request){
                $query->where('users.identificationNumber', 'LIKE', '%'. $request->get('search'). '%')
                ->orWhere('users.name', 'LIKE', '%'. $request->get('search'). '%');
            });
        
        if($request->get('campo')=='cedula'){
            $data = $data->select("users.identificationNumber as value", "users.id as identi", "users.identificationNac as identificationNac","users.name as nombre", "users.identificationNumber as identificationNumber", "datos_basicos.telefono as telefono", "users.email as email");    
        }
        else
        {
            $data = $data->select("users.identificationNumber as value", "users.id as identi", "users.identificationNac as identificationNac","users.name as nombre", "users.identificationNumber as identificationNumber", "datos_basicos.telefono as telefono", "users.email as email");
        }
        $data = $data->get();
    
        return response()->json($data);
    }
}
