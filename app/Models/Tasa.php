<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tasa extends Model
{
    use HasFactory;

    const STATUS_ACTIVO = 'activo';
    const STATUS_NOACTIVO = 'noactivo';

    public $tasaResult;

    protected $fillable = [
        'tasa',
        'status',
        'user_id',
        'comercio_id',
    ];

    public function getStatus()
    {
    	switch ($this->status) {
    		case 'activo':
    			$q = 'Activo';
    			break;
    		case 'noactivo':
    			$q = 'No activo';
    			break;
    	}
    	return $q;
    }

    public function convertirString($valor)
    {
        $temporal = number_format($valor, 2, ',', '.');

        return str_replace(".", ",", $temporal);
    }

    public function convertirNumero($valor)
    {
        $valor = str_replace(".", "", $valor);

        $valor = str_replace(",", ".", $valor);

        return floatval($valor);
    }

    public function getTasaHoy($user_id)
    {
        $tasaResult = Tasa::where('status','activo')
                ->where('user_id', $user_id)
                ->first();
        dd($tasaResult);
        if($tasaResult){
            $valor = $tasaResult->tasa;
            dd($valor);
            return $this->convertirString($valor);
        }
        else
        {
            return '1,00';
        }
    }
    public function tasaHoy($user_id)
    {

        $tasa = Tasa::where('status','activo')
                ->where('user_id', $user_id)
                ->first();
        if($tasa)
        {
            return $tasa->tasa;    
        }
        else
        {
            return 1.00;
        }

        
    }

    public function getTasa()
    {
        return $this->convertirString($this->tasa);
            return str_replace(".", ",", $this->tasa);    
    }
}
