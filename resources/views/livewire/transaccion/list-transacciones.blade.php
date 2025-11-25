<div>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><i class="fa fa-solid fa-file-invoice-dollar"></i> Transacciones</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/admin/dashboard">Escritorio</a></li>
                        <li class="breadcrumb-item active"><a href="/listComercios/{{$comercio->id}}">Comercios</a></li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            @if($comercio)
            <div class="row">
                <div class="col-lg-12">
                    <div class="card w-50">
                        <div class="row">
                            <div class="col-lg-6">
                                <span>Dueño: </span>
                            </div>
                            <div class="col-lg-6">
                                <span>{{$comercio->propietario()}}</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <span>Comercio: </span>
                            </div>
                            <div class="col-lg-6">
                                <span>{{$comercio->name}}</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <span>Operación No Confirmada: </span>
                            </div>
                            <div class="col-lg-6">
                                <span>{{$comercio->OperacionNoConfirmada()}}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            <div class="row">
                <div class="col-lg-12">
                    <div class="d-flex justify-content-between mb-2">
                        <button wire:click.prevent="addNew" class="btn btn-primary"><i class="fa fa-plus-circle mr-1"></i> Nueva Transacción</button>
                        <x-search-input wire:model.live="searchTerm" />
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-hover table-bordered table-responsive">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Propietario</th>
                                        <th scope="col">Cliente</th>
                                        <th scope="col" wire:ignore>
                                            <select wire:model.refer="status" class="form-control border-0" style="width:150px;font-weight: bold;" name="" id="">
                                                <option value="all" select>Estados</option>
                                                <option value="confirmado">Confirmados</option> 
                                                <option value="norevisado">No Revisados</option> 
                                            </select>
                                        </th>
                                        <th scope="col">Código de Factura</th>
                                        <th scope="col" wire:ignore>
                                            <select wire:model.refer="metodoPago" class="form-control border-0" style="width:150px;font-weight: bold;" name="" id="">
                                                <option value="all">Método de Pago</option>
                                                @foreach($modoPago as $metodo)
                                                    {{$valor = $metodo['modo']}}
                                                    <option value="{{$metodo['modo']}}" {{ ($metodoPago === $valor) ? 'selected' : '' }}> {{$metodo['nombre']}}</option> 
                                                    
                                                @endforeach
                                            </select>
                                        </th>
                                        <th scope="col">Referencia</th>
                                        <th scope="col">Monto</th>
                                        <th scope="col">
                                            Cédula
                                            <span wire:click="sortBy('cedula')" class="float-right text-sm" style="cursor: pointer;">
                                                <i class="fa fa-arrow-up {{ $sortColumnName === 'cedula' && $sortDirection === 'asc' ? '' : 'text-muted' }}"></i>
                                                <i class="fa fa-arrow-down {{ $sortColumnName === 'cedula' && $sortDirection === 'desc' ? '' : 'text-muted' }}"></i>
                                            </span>
                                        </th>
                                        <th scope="col">Teléfono</th>
                                        <th scope="col">Banco</th>
                                        <th scope="col">Código</th>
                                        <th scope="col">Fecha de Pago</th>
                                        <th scope="col">Fecha de Registro</th>
                                        <th scope="col">Monto</th>
                                        <th scope="col">Opciones</th>
                                    </tr>
                                </thead>
                                <tbody wire:loading.class="text-muted">
                                    @forelse ($transacciones as $index => $trans)
                                    <tr>
                                        <th scope="row">{{ $transacciones->firstItem() + $index }}</th>
                                        <td>{{ $trans->user_id }}</td>
                                        <td>{{ $trans->cliente_id }}</td>
                                        <td>
                                            <select style="width: 150px;" class="form-control" wire:change="changeStatus({{ $trans }}, $event.target.value)">
                                                <option value="confirmed" {{ ($trans->status === 'confirmed') ? 'selected' : '' }}>CONFIRMADO</option>
                                                <option value="notconfirmed" {{ ($trans->status === 'notconfirmed') ? 'selected' : '' }}>NO CONFIRMADO</option>
                                            </select>
                                        </td>
                                        <td>
                                            <span class="mr-2">{{ $trans->codigoFactura }}</span>
                                        </td>
                                        <td>
                                            <span class="mr-2">{{ $trans->metodo }}</span>
                                        </td>
                                        <td>{{ $trans->reference }}</td>
                                        <td>{{ $trans->amount }}</td>
                                        <td>{{ $trans->identificationNumber }}</td>
                                        <td>{{ $trans->cellphone }}</td>
                                        <td>{{ $trans->banco }}</td>
                                        <td>{{ $trans->codigo }}</td>
                                        <td>{{ $trans->fechaPago }}</td>
                                        <td>{{ $trans->created_at?->toFormattedDate() ?? 'N/A' }}</td>
                                        <td>{{ $trans->amount }}</td>
                                        <td>
                                            <a href="" wire:click.prevent="edit({{ $trans }})">
                                                <i class="fa fa-edit mr-2"></i>
                                            </a>

                                            <a href="" wire:click.prevent="confirmTransRemoval({{ $trans->id }})">
                                                <i class="fa fa-trash text-danger"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr class="text-center">
                                        <td colspan="13">
                                            <img src="https://42f2671d685f51e10fc6-b9fcecea3e50b3b59bdc28dead054ebc.ssl.cf5.rackcdn.com/v2/assets/empty.svg" alt="No results found">
                                            <p class="mt-2">Resultados no encontrados</p>
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer d-flex justify-content-end">
                            {{ $transacciones->links() }}
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->

    <!-- Modal -->
    <div class="modal fade" id="form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog" role="document">
            <form autocomplete="off" wire:submit.prevent="{{ $showEditModal ? 'updateTrans' : 'createTrans' }}">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                            @if($showEditModal)
                            <span>Editar Transaccion</span>
                            @else
                            <span>Nuevo Transaccion</span>
                            @endif
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="userId">Usuario </label>
                            <input type="text" wire:model="state.userId" class="form-control @error('userId') is-invalid @enderror" id="userId" name="userId" aria-describedby="nameHelp" placeholder="Introduzca la userId">
                            @error('userId')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="clienteId">Cliente </label>
                            <input type="text" wire:model="state.clienteId" class="form-control @error('clienteId') is-invalid @enderror" id="userId" name="clienteId" aria-describedby="nameHelp" placeholder="Introduzca la clienteId">
                            @error('clienteId')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        
                        <div class="form-group" wire:ignore>
                            <label for="status">Estado</label>
                            <select name="status" wire:model.defer="state.status" class="form-control @error('status') is-invalid @enderror" id="status">
                                <option value="confirmado">CONFIRMADO</option>
                                <option value="norevisado" selected>NO REVISADO</option>
                            </select>
                            @error('status')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="codigoFactura">Codigo Factura</label>
                            <input type="text" wire:model.defer="state.codigoFactura" class="form-control @error('codigoFactura') is-invalid @enderror" id="codigoFactura" aria-describedby="nameHelp" placeholder="Introduzca el codigo de la factura">
                            @error('codigoFactura')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="metodo">Modo de Pago</label>
                            <select name="metodo" wire:model.defer="state.metodo" class="form-control @error('metodo') is-invalid @enderror" id="metodo">
                                <option value="0" selected>SELECCIONE..</option>
                                <option value="pagomovil" selected>PAGO MOVIL</option>
                                <option value="transferencia" selected>TRANSFERENCIA</option>
                                <option value="zelle" selected>ZELLE</option>
                            </select>
                            @error('modopago')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="reference">Referencia</label>
                            <input type="text" wire:model.defer="state.reference" class="form-control @error('reference') is-invalid @enderror" id="reference" aria-describedby="nameHelp" placeholder="Introduzca la Referencia">
                            @error('reference')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="identificationNumber">Cédula</label>
                            <input type="text" wire:model.defer="state.identificationNumber" class="form-control @error('identificationNumber') is-invalid @enderror" id="identificationNumber" aria-describedby="nameHelp" placeholder="Introduzca la cedula">
                            @error('identificationNumber')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="cellphone">Teléfono</label>
                            <input type="text" wire:model.defer="state.cellphone" class="form-control @error('cellphone') is-invalid @enderror" id="cellphone" aria-describedby="nameHelp" placeholder="Introduzca el Teléfono">
                            @error('cellphone')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group" wire:ignore>
                            <label for="codigo">Banco</label>
                            <select name="codigo" id="codigo" wire:model.defer="state.codigo" class="form-control @error('codigo') is-invalid @enderror">

                            </select> 
                            @error('banco')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="fechaPago">Fecha de Pago</label>
                            <input type="date" wire:model.defer="state.fechaPago" class="form-control @error('fechaPago') is-invalid @enderror" id="fechaPago" name="fechaPago" aria-describedby="fechaPagoHelp" placeholder="Introduzca la Fecha de Pago">
                            @error('fechaPago')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="monto">Monto</label>
                            <input type="text" wire:model.defer="state.amount" class="form-control @error('amount') is-invalid @enderror" id="amount" aria-describedby="nameHelp" placeholder="Introduzca el Monto">
                            @error('amount')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                    </div>
                    <div class="modal-footer">

                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times mr-1"></i> Cancelar</button>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save mr-1"></i>
                            @if($showEditModal)
                            <span>Guardar Cambios</span>
                            @else
                            <span>Guardar</span>
                            @endif
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5>Eliminar Transacción</h5>
                </div>

                <div class="modal-body">
                    <h4>Estas seguro de querer eliminar esta transacción?</h4>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times mr-1"></i> Cancelar</button>
                    <button type="button" wire:click.prevent="deleteTrans" class="btn btn-danger"><i class="fa fa-trash mr-1"></i>Eliminar Transacción</button>
                </div>
            </div>
        </div>
    </div>
</div>

@push('js')
<script>
    cargarBanco()

    function funcionBancos(){
        let bancos
        return bancos =
        {
            "bancos": [
            {
                "name": "BANCO DE VENEZUELA",
                "codigo": "0102"
            },
            {
                "name": "100% BANCO",
                "codigo": "0156"
            },
            {
                "name": "BANCAMIGA BANCO MICROFINANCIERO CA",
                "codigo": "0172"
            },
            {
                "name": "BANCARIBE",
                "codigo": "0114"
            },
            {
                "name": "BANCO ACTIVO",
                "codigo": "0171"
            },
            {
                "name": "BANCO AGRICOLA DE VENEZUELA",
                "codigo": "0166"
            },
            {
                "name": "BANCO BICENTENARIO DEL PUEBLO",
                "codigo": "0175"
            },
            {
                "name": "BANCO CARONI",
                "codigo": "0128"
            },
            {
                "name": "BANCO DEL TESORO",
                "codigo": "0163"
            },
            {
                "name": "BANCO EXTERIOR",
                "codigo": "0115"
            },
            {
                "name": "BANCO FONDO COMUN",
                "codigo": "0151"
            },
            {
                "name": "BANCO INTERNACIONAL DE DESARROLLO",
                "codigo": "0173"
            },
            {
                "name": "BANCO MERCANTIL",
                "codigo": "0105"
            },
            {
                "name": "BANCO NACIONAL DE CREDITO",
                "codigo": "0191"
            },
            {
                "name": "BANCO PLAZA",
                "codigo": "0138"
            },
            {
                "name": "BANCO SOFITASA",
                "codigo": "0137"
            },
            {
                "name": "BANCO VENEZOLANO DE CREDITO",
                "codigo": "0104"
            },
            {
                "name": "BANCRECER",
                "codigo": "0168"
            },
            {
                "name": "BANESCO",
                "codigo": "0134"
            },
            {
                "name": "BANFANB",
                "codigo": "0177"
            },
            {
                "name": "BANGENTE",
                "codigo": "0146"
            },
            {
                "name": "BANPLUS",
                "codigo": "0174"
            },
            {
                "name": "BBVA PROVINCIAL",
                "codigo": "0108"
            },
            {
                "name": "DELSUR BANCO UNIVERSAL",
                "codigo": "0157"
            },
            {
                "name": "MI BANCO",
                "codigo": "0169"
            },
            {
                "name": "N58 BANCO DIGITAL BANCO MICROFINANCIERO S A",
                "codigo": "0178"
            }
            ]
        }
        
    }

    function cargarBanco(){
        
        var bancos = funcionBancos()


        let bancosS = document.querySelector("#codigo");
        
        bancosS.innerHTML += "<option value='0'>SELECCIONE..</option>"; 

        bancos.bancos.forEach( e => {
            bancosS.innerHTML += "<option value='"+e['codigo']+"'>"+e['name']+"</option>"; 
        })

    }
</script>
@endpush