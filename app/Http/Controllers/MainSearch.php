<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainSearch extends Controller
{
    public $parametro = '';

    public function index(Request $request)
    {


        dd($request->post('modelo_id'));

        $this->parametro = $parametro;

        return view('MainSearch', [
            'parametro' => $parametro,
        ]);
    }
}
