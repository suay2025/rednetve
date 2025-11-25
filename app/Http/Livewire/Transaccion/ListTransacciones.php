<?php

namespace App\Http\Livewire\Transaccion;

use App\Http\Livewire\Admin\AdminComponent;
use App\Models\Comercio;
use App\Models\Transaccion;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ListTransacciones extends AdminComponent
{
    public $state = [];

    public $userId;
    public $comercioId; 

    public $trans;

    public $showEditModal = false;

    public $transIdBeingRemoved = null;

    public $searchTerm = null;

    protected $queryString = ['searchTerm' => ['except' => '']];

    public $sortColumnName = 'created_at';

    public $sortDirection = 'desc';

    public $modoPago =  [
        [
            'modo'=> 'efectivo', 
            'nombre'=> 'Efectivo'
        ],
        [
            'modo'=> 'transferencia', 
            'nombre'=> 'Transferencia'
        ],
        [
            'modo'=> 'puntodeventa', 
            'nombre'=> 'Punto de Venta'
        ],
        [
            'modo'=> 'biopago', 
            'nombre'=> 'Biopago'
        ],
        [
            'modo'=> 'pagomovil', 
            'nombre'=> 'Pago Movil'
        ],
        [
            'modo'=> 'divisa', 
            'nombre'=> 'Divisa'
        ],
        [
            'modo'=> 'zelle', 
            'nombre'=> 'Zelle'
        ]
    ];

    public $metodoPago = 'all';
    public $status = 'all';
        

    public function mount($comercioId)
    {
        $this->comercioId = $comercioId;
        if($comercioId != '0'){
            $comercio = Comercio::find($comercioId);
            $this->userId = $comercio->userId;
        }
    }

    public function changeStatus(Transaccion $trans, $status)
    {
        Validator::make(['status' => $status], [
            'status' => [
                'required',
                Rule::in(Transaccion::STATUS_CONFIRMED, Transaccion::STATUS_NOTCONFIRMED),
            ],
        ])->validate();

        $trans->update(['status' => $status]);

        $this->dispatchBrowserEvent('updated', ['message' => "Estado cambiado a {$status} satisfactoriamente."]);
    }

    public function addNew()
    {
        $comercioId = $this->comercioId;
        $metodoPago = $this->metodoPago;
        $userId = $this->userId;

		$this->reset();

        $this->comercioId = $comercioId;
        $this->metodoPago = $metodoPago;
        $this->userId = $userId;

        $this->showEditModal = false;

        $this->state['user_id'] = $this->userId;
        $this->state['metodo'] = '0';
        $this->state['status'] = 'norevisado';


        $this->dispatchBrowserEvent('show-form');
        
    }

    public function createTrans()
    {
        $validatedData = Validator::make($this->state, [
            'user_id'  => 'required',
            'cliente_id'  => 'required',
            'status' => 'required',
            'codigoFactura' => 'required',
            'metodo'  => 'required',
            'reference' => 'required',
            'identificationNumber' => 'required',
            'cellphone'  => 'required',
            'codigo'  => 'required',
            'fechaPago'  => 'required',
            'amount'  => 'required',
        ])->validate();
        
        $validatedData['comercio_id'] = $this->comercioId;
        $validatedData['banco'] = $this->buscarBanco($validatedData['codigo']);

        Transaccion::create($validatedData);

        // session()->flash('message', 'User added successfully!');

        $this->dispatchBrowserEvent('hide-form', ['message' => 'Transaccion agregada satisfactoriamente!']);
    }

    public function buscarBanco($codigo) {
        $name = '';
        
        $bancos = array(
            [
                "name"=> "BANCO DE VENEZUELA",
                "codigo"=> "0102"
            ],
            [
                "name"=> "100% BANCO",
                "codigo"=> "0156"
            ],
            [
                "name"=> "BANCAMIGA BANCO MICROFINANCIERO CA",
                "codigo"=> "0172"
            ],
            [
                "name"=> "BANCARIBE",
                "codigo"=> "0114"
            ],
            [
                "name"=> "BANCO ACTIVO",
                "codigo"=> "0171"
            ],
            [
                "name"=> "BANCO AGRICOLA DE VENEZUELA",
                "codigo"=> "0166"
            ],
            [
                "name"=> "BANCO BICENTENARIO DEL PUEBLO",
                "codigo"=> "0175"
            ],
            [
                "name"=> "BANCO CARONI",
                "codigo"=> "0128"
            ],
            [
                "name"=> "BANCO DEL TESORO",
                "codigo"=> "0163"
            ],
            [
                "name"=> "BANCO EXTERIOR",
                "codigo"=> "0115"
            ],
            [
                "name"=> "BANCO FONDO COMUN",
                "codigo"=> "0151"
            ],
            [
                "name"=> "BANCO INTERNACIONAL DE DESARROLLO",
                "codigo"=> "0173"
            ],
            [
                "name"=> "BANCO MERCANTIL",
                "codigo"=> "0105"
            ],
            [
                "name"=> "BANCO NACIONAL DE CREDITO",
                "codigo"=> "0191"
            ],
            [
                "name"=> "BANCO PLAZA",
                "codigo"=> "0138"
            ],
            [
                "name"=> "BANCO SOFITASA",
                "codigo"=> "0137"
            ],
            [
                "name"=> "BANCO VENEZOLANO DE CREDITO",
                "codigo"=> "0104"
            ],
            [
                "name"=> "BANCRECER",
                "codigo"=> "0168"
            ],
            [
                "name"=> "BANESCO",
                "codigo"=> "0134"
            ],
            [
                "name"=> "BANFANB",
                "codigo"=> "0177"
            ],
            [
                "name"=> "BANGENTE",
                "codigo"=> "0146"
            ],
            [
                "name"=> "BANPLUS",
                "codigo"=> "0174"
            ],
            [
                "name"=> "BBVA PROVINCIAL",
                "codigo"=> "0108"
            ],
            [
                "name"=> "DELSUR BANCO UNIVERSAL",
                "codigo"=> "0157"
            ],
            [
                "name"=> "MI BANCO",
                "codigo"=> "0169"
            ],
            [
                "name"=> "N58 BANCO DIGITAL BANCO MICROFINANCIERO S A",
                "codigo"=> "0178"
            ]);

        
            
        //$banco = array_search($codigo, array_column($bancos, 'name'));

        $name = $this->searchName($codigo, 'codigo', $bancos);

        return $name;
    }

    function searchName($value, $key, $array) {
        foreach ($array as $k => $val) {
            if ($val[$key] == $value) {
                return $val['name'];
                //return $k;
            }
        }
        return null;
     }

    public function edit(Transaccion $trans1)
    {        
        dd($this->state);
        $comercioId = $this->comercioId;
        $metodoPago = $this->metodoPago;
        $userId = $this->userId;

		$this->reset();

        $this->comercioId = $comercioId;
        $this->metodoPago = $metodoPago;
        $this->userId = $userId;

        $this->showEditModal = true;

        $this->trans = $trans1;

        $this->state = $trans1->toArray();
        
        $this->dispatchBrowserEvent('show-form');
    }

    public function updateTrans()
    {
        
        $validatedData = Validator::make($this->state, [
            'user_id'  => 'required',
            'cliente_id'  => 'required',
            'status' => 'required',
            'codigoFactura' => 'required',
            'metodo'  => 'required',
            'reference' => 'required',
            'identificationNumber' => 'required',
            'cellphone'  => 'required',
            'codigo'  => 'required',
            'fechaPago'  => 'required',
            'amount'  => 'required',
        ])->validate();

        $this->trans->update($validatedData);

        $this->dispatchBrowserEvent('hide-form', ['message' => 'Transaccion actualida satisfactoriamente!']);
    }

    public function confirmTransRemoval($transId)
    {
        $this->transIdBeingRemoved = $transId;

        $this->dispatchBrowserEvent('show-delete-modal');
    }

    public function deleteTrans()
    {
        $trans = Transaccion::findOrFail($this->transIdBeingRemoved);

        $trans->delete();

        $this->dispatchBrowserEvent('hide-delete-modal', ['message' => 'Transaccion eliminada satisfactoriamente!']);
    }

    public function sortBy($columnName)
    {
        if ($this->sortColumnName === $columnName) {
            $this->sortDirection = $this->swapSortDirection();
        } else {
            $this->sortDirection = 'asc';
        }

        $this->sortColumnName = $columnName;
    }

    public function swapSortDirection()
    {
        return $this->sortDirection === 'asc' ? 'desc' : 'asc';
    }

    public function updatedSearchTerm()
    {
        $this->resetPage();
    }

    public function render()
    {
        $transacciones = Transaccion::query();

        if($this->status !== 'all'){
            $transacciones = $transacciones
                ->where('status', $this->status);
        }

        if($this->metodoPago !== 'all'){
            $transacciones = $transacciones
                ->where('metodo', $this->metodoPago);
        }

        

        $transacciones = $transacciones
            ->where(function($q){
                $q->where('reference', 'like', '%'.$this->searchTerm.'%')
                ->orWhere('metodo', 'like', '%'.$this->searchTerm.'%');
            })
            ->where('comercio_id', $this->comercioId)
            ->orderBy($this->sortColumnName, $this->sortDirection)
            ->paginate(15);
        
        $comercio = Comercio::find($this->comercioId);


        return view('livewire.transaccion.list-transacciones', [
            'transacciones' => $transacciones,
            'comercio' => $comercio,
        ]);
    }


}
