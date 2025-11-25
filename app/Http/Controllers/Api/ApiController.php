<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

    class ApiController extends Controller
    {
        public function index()
        {
            //
            $data = ['valor' => "Operacion exitosa a traves de api!", ];
            return response()->json($data);
        }
        
        public function recibirDatosApi(Request $request)
        {
            // Accede a los datos enviados
            $datos = $request->all();

            // Aquí procesas los datos
            // Por ejemplo, guardar en la base de datos
            // Ejemplo:
            // \App\Models\TuModelo::create($datos);

            // Retorna una respuesta
            return response()->json([
                'message' => 'Datos recibidos completos',
                'datos' => $datos,
            ], 200);
        }
    }