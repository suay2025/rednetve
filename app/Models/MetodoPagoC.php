<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MetodoPagoC extends Model
{
    use HasFactory;

    protected $fillable = [
        'comercio_id',
        'metodo',
        'banco',
        'codigo',
        'tipocuenta',
        'currency',
        'nrocuenta',
        'marcaInternaciona',
        'ccv-cvv',
        'fechavencimiento',
        'fecha',
        'cellphonecode',
        'cellphone',
        'titular',
        'identificationNac',
        'identificationNumber',
        'descripcion',
        'pagoonline',
        'email',
        'exchange',
        'exchangeaddress',
    ];

    public function comercios()
    {
        return $this->hasMany('Comercio');
    }

    public function description()
    {
        $description = "";

        switch ($this->metodo) {
            case 'pagomovil':
                $description = $this->banco . ' / ' . $this->codigo . ' / ' . $this->cellphonecode .'-'. $this->cellphone." / ".$this->identificationNac."-".$this->identificationNumber;
                break;
            
            case 'transferencia':
                $description = $this->banco . "/". $this->titular . "/".$this->nrocuenta."/".$this->identificationNac."-".$this->identificationNumber;
                break;
            case 'pagoonline':
                    $description = $this->pagoonline . "/". $this->cellphonecode . "-".$this->cellphone."/".$this->identificationNac."-".$this->identificationNumber;
                    break;
        }
        return $description;
    }
}
