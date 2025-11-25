<?php

namespace App\Http\Livewire\Operacion;

use Livewire\Component;

class Pasarela extends Component
{
    public function autocompleteClientePasarela(Request $request)
    {
        if($request->get('campo')=='cedula'){
            $data = Paciente::select("cedula as value", "id as identi", "name as nombre", "cedula as cedula", "sexo as sexo", "fechanacimiento as fechanacimiento");    
        }
        else
        {
            $data = Paciente::select("name as value", "id as identi", "name as nombre", "cedula as cedula", "sexo as sexo", "fechanacimiento as fechanacimiento");
        }
        
        $data = $data
                ->where('laboratorio_id',  $request->get('laboratorio_id'))
                ->where(function($query)  use ($request){
                    $query->where('cedula', 'LIKE', '%'. $request->get('search'). '%')
                    ->orWhere('name', 'LIKE', '%'. $request->get('search'). '%');
                })
                ->get();
    
        return response()->json($data);
    }

    public function enviarData(Request $request){
        $data = ['valor' => "Operacion exitosa!", ];
        return response()->json($data);
    }

    public function render()
    {
        return view('livewire.operacion.pasarela');
    }
}
