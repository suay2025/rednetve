<div>
    <style>
        .modal-body {
            min-height: 400px!important;
            height: auto;
        }
    </style>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Metodos de Pagos</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/admin/dashboard">Escritorio</a></li>
                        <li class="breadcrumb-item active">Comercios</li>
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
                                <span>Propietario: </span>
                            </div>
                            <div class="col-lg-6">
                                <span>{{ $comercio->getPropietario()->name }}</span>
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
                    </div>
                </div>
            </div>
            @endif
            <div class="row">
                <div class="col-lg-12">
                    <div class="d-flex justify-content-between mb-2">
                        <button wire:click.prevent="addNew" class="btn btn-primary"><i class="fa fa-plus-circle mr-1"></i> Nuevo Metodo</button>
                        <x-search-input wire:model="searchTerm" />
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-hover table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">
                                            Metodo de Pago
                                            <span wire:click="sortBy('metodopago')" class="float-right text-sm" style="cursor: pointer;">
                                                <i class="fa fa-arrow-up {{ $sortColumnName === 'metodopago' && $sortDirection === 'asc' ? '' : 'text-muted' }}"></i>
                                                <i class="fa fa-arrow-down {{ $sortColumnName === 'metodopago' && $sortDirection === 'desc' ? '' : 'text-muted' }}"></i>
                                            </span>
                                        </th>
                                        <th scope="col">Descripción</th>
                                        <th scope="col">Fecha de Registro</th>
                                        <th scope="col">Opciones</th>
                                    </tr>
                                </thead>
                                <tbody wire:loading.class="text-muted">
                                    @forelse ($metodosC as $index => $metodo)
                                    <tr>
                                        <th scope="row">{{ $metodosC->firstItem() + $index }}</th>
                                        <td>
                                            {{ $metodo->metodo }}
                                        </td>
                                        <td>
                                            {{ $metodo->description() }}
                                        </td>
                                        <td>{{ $metodo->created_at->toFormattedDate() ?? 'N/A' }}</td>
                                        <td>
                                            <a href="/listTransacciones/{{$metodo->id }}">
                                            <i class="fa fa-solid fa-book mr-2"></i>
                                            </a>

                                            <a href="" wire:click.prevent="edit({{ $metodo }})">
                                                <i class="fa fa-edit mr-2"></i>
                                            </a>

                                            <a href="" wire:click.prevent="confirmMetodoRemoval({{ $metodo->id }})">
                                                <i class="fa fa-trash text-danger"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr class="text-center">
                                        <td colspan="5">
                                            <img src="https://42f2671d685f51e10fc6-b9fcecea3e50b3b59bdc28dead054ebc.ssl.cf5.rackcdn.com/v2/assets/empty.svg" alt="No results found">
                                            <p class="mt-2">No se encontro resultados</p>
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer d-flex justify-content-end">
                            {{ $metodosC->links() }}
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
            <form autocomplete="off" wire:submit.prevent="{{ $showEditModal ? 'updateMetodo' : 'createMetodo' }}">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                            @if($showEditModal)
                            <span>Editar Método de Pago</span>
                            @else
                            <span>Nuevo Método de Pago</span>
                            @endif
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Método de Pago</label>
                            <select name="" id="metodoId" wire:model.defer="metodoId" class="form-control @error('metodoId') is-invalid @enderror" wire:change="changeDatos($event.target.value)">
                                <option value="0">Selecciona una opción</option>
                                @foreach($metodos as $metodo)
                                    <option value="{{ $metodo->metodo }}">{{ $metodo->metodopago }}</option>
                                @endforeach
                            </select>
                            @error('metodoId')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div style="display: {{$visible4}}"> <!-- Datos transferencia -->
                            <div class= "datosTransferencia">
                                <div class="form-group">
                                    <div class="row mx-auto">
                                        <div class="col-xs-6 col-md-4 col-sm-4 col-4">
                                            <label for="identificationNac">Tipo </label>
                                            <select wire:model.defer="state.identificationNac" class="form-control inputForm inputType @error('identificationNac') is-invalid @enderror" name="" id="identificationNac" placeholder="Tipo">
                                                <option value="0">Selecciona una opción</option>
                                                <option value="V">V-</option>
                                                <option value="J">J-</option>
                                                <option value="E">E-</option>
                                                <option value="G">G-</option>
                                                <option value="P">P-</option>
                                            </select>
                                            @error('identificationNac')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="col-xs-6 col-md-8 col=sm-8 col-8">
                                            <label for="identificationNumber">Documento</label>
                                            <input type="text" wire:model.defer="state.identificationNumber" class="form-control inputForm inputType @error('identificationNumber') is-invalid @enderror" id="identificationNumber" class="form-control inputForm" placeholder="Documento">
                                            @error('identificationNumber')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>                        
                                </div>
                                <div class="form-group" wire:ignore>
                                    <label for="">Banco</label>
                                    <select name="" id="banco_id" wire:model.defer="state.banco_id" class="form-control @error('banco_id') is-invalid @enderror">
                                        <option value="0">Selecciona una opción</option>
                                        @foreach($bancos as $ban)
                                            <option value="{{ $ban->id }}">{{ $ban->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('banco_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="tipocuenta">Tipo de Cuenta</label>
                                    <select name="tipocuenta" id="tipocuenta" wire:model.defer="state.tipocuenta" class="form-control @error('tipocuenta') is-invalid @enderror" >
                                        <option value="0">Seleccione una opción</option>
                                        <option value="cuenta">Cuenta</option>
                                    </select>
                                    @error('tipocuenta')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="nrocuenta">Instrumento</label>
                                    <input type="text" wire:model.defer="state.nrocuenta" class="form-control @error('nrocuenta') is-invalid @enderror" id="nrocuenta" aria-describedby="nrocuentaHelp" placeholder="Nro de Cuenta">
                                    @error('nrocuenta')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="titular">Titular</label>
                                    <input type="text" wire:model.defer="state.titular" class="form-control @error('titular') is-invalid @enderror" id="titular" aria-describedby="titularHelp" placeholder="Titular">
                                    @error('titular')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div style="display: {{$visible5}}"> <!-- Datos pagomovil -->
                            <div class= "datosPagomovil">
                                <div class="form-group" wire:ignore>
                                    <label for="banco_id">Banco</label>
                                    <select wire:model.defer="state.banco_id" class="form-control inputForm inputType @error('banco_id') is-invalid @enderror" name="" id="banco_id">
                                        <option value="0">Selecciona una opción</option>
                                        @foreach($bancos as $ban)
                                            <option value="{{ $ban->id }}">{{ $ban->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('banco_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <div class="row mx-auto">
                                        <div class="col-xs-6 col-md-4 col-sm-4 col-4">
                                            <label for="cellphonecode">Operadora </label>
                                            <select wire:model.defer="state.cellphonecode" class="form-control inputForm inputType @error('cellphonecode') is-invalid @enderror" name="" id="cellphonecode" placeholder="Tipo">
                                                <option value="0">Selecciona una opción</option>
                                                <option value="0412">0412</option>
                                                <option value="0412">0414</option>
                                                <option value="0412">0424</option>
                                                <option value="0412">0416</option>
                                                <option value="0412">0426</option>
                                            </select>
                                            @error('cellphonecode')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="col-xs-6 col-md-8 col=sm-8 col-8">
                                            <label for="cellphone">Nro Celular</label>
                                            <input type="text" wire:model.defer="state.cellphone" class="form-control inputForm inputType @error('cellphone') is-invalid @enderror" id="cellphone" class="form-control inputForm" placeholder="Documento">
                                            @error('cellphone')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>                        
                                </div>
                                <div class="form-group">
                                    <div class="row mx-auto">
                                        <div class="col-xs-6 col-md-4 col-sm-4 col-4">
                                            <label for="identificationNac">Tipo </label>
                                            <select wire:model.defer="state.identificationNac" class="form-control inputForm inputType @error('identificationNac') is-invalid @enderror" name="" id="identificationNac" placeholder="Tipo">
                                                <option value="0">Selecciona una opción</option>
                                                <option value="V">V-</option>
                                                <option value="J">J-</option>
                                                <option value="E">E-</option>
                                                <option value="G">G-</option>
                                                <option value="P">P-</option>
                                            </select>
                                            @error('identificationNac')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="col-xs-6 col-md-8 col=sm-8 col-8">
                                            <label for="identificationNumber">Documento</label>
                                            <input type="text" wire:model.defer="state.identificationNumber" class="form-control inputForm inputType @error('identificationNumber') is-invalid @enderror" id="identificationNumber" class="form-control inputForm" placeholder="Documento">
                                            @error('identificationNumber')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>                        
                                </div>
                            </div>
                        </div>
                        <div style="display: {{$visible7}}"> <!-- Datos pago online -->
                            <div class= "datosPagomovil">
                                <div class="form-group">
                                    <div class="row mx-auto">
                                        <div class="col-xs-6 col-md-4 col-sm-4 col-4">
                                            <label for="cellphonecode">Operadora </label>
                                            <select wire:model.defer="state.cellphonecode" class="form-control inputForm inputType @error('cellphonecode') is-invalid @enderror" name="" id="cellphonecode" placeholder="Tipo">
                                                <option value="0">Selecciona una opción</option>
                                                <option value="0412">0412</option>
                                                <option value="0412">0414</option>
                                                <option value="0412">0424</option>
                                                <option value="0412">0416</option>
                                                <option value="0412">0426</option>
                                            </select>
                                            @error('cellphonecode')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="col-xs-6 col-md-8 col=sm-8 col-8">
                                            <label for="cellphone">Nro Celular</label>
                                            <input type="text" wire:model.defer="state.cellphone" class="form-control inputForm inputType @error('cellphone') is-invalid @enderror" id="cellphone" class="form-control inputForm" placeholder="Documento">
                                            @error('cellphone')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>                        
                                </div>
                                <div class="form-group">
                                    <div class="row mx-auto">
                                        <div class="col-xs-6 col-md-4 col-sm-4 col-4">
                                            <label for="identificationNac">Tipo </label>
                                            <select wire:model.defer="state.identificationNac" class="form-control inputForm inputType @error('identificationNac') is-invalid @enderror" name="" id="identificationNac" placeholder="Tipo">
                                                <option value="0">Selecciona una opción</option>
                                                <option value="V">V-</option>
                                                <option value="J">J-</option>
                                                <option value="E">E-</option>
                                                <option value="G">G-</option>
                                                <option value="P">P-</option>
                                            </select>
                                            @error('identificationNac')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="col-xs-6 col-md-8 col=sm-8 col-8">
                                            <label for="identificationNumber">Documento</label>
                                            <input type="text" wire:model.defer="state.identificationNumber" class="form-control inputForm inputType @error('identificationNumber') is-invalid @enderror" id="identificationNumber" class="form-control inputForm" placeholder="Documento">
                                            @error('identificationNumber')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>                        
                                </div>

                                <div class="form-group">
                                    <div class="row mx-auto">
                                        <div class="col-xs-12 col-md-12 col=sm-12 col-12">
                                            <label for="identificationNumber">Plataforma de pago</label>
                                            <input type="pagoonline" wire:model.defer="state.pagoonline" class="form-control inputForm inputType @error('pagoonline') is-invalid @enderror" id="pagoonline" class="form-control inputForm" placeholder="Plataforma de pago">
                                            @error('pagoonline')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>                        
                                </div>

                                <div class="form-group">
                                    <div class="row mx-auto">
                                        <div class="col-xs-12 col-md-12 col=sm-12 col-12">
                                            <label for="identificationNumber">Email</label>
                                            <input type="email" wire:model.defer="state.email" class="form-control inputForm inputType @error('email') is-invalid @enderror" id="email" class="form-control inputForm" placeholder="Email">
                                            @error('email')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>                        
                                </div>
                            </div>
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
                    <h5>Eliminar Método</h5>
                </div>

                <div class="modal-body">
                    <h4>Esta seguro de querer eliminar este método?</h4>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times mr-1"></i> Cancelar</button>
                    <button type="button" wire:click.prevent="deleteMetodo" class="btn btn-danger"><i class="fa fa-trash mr-1"></i>Eliminar Método</button>
                </div>
            </div>
        </div>
    </div>    
    
</div>
