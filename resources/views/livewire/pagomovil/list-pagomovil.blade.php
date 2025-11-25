<div>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Pago Móvil</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/admin/dashboard">Escritorio</a></li>
                        <li class="breadcrumb-item active">Pago Móbil</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-lg-12">
                    <div class="d-flex justify-content-between mb-2">
                        <button wire:click.prevent="addNew" class="btn btn-primary"><i class="fa fa-plus-circle mr-1"></i> Nuevo Pago móvil</button>
                        <x-search-input wire:model="searchTerm" />
                    </div>
                    <div class="card">
                        <div class="card-body table-responsive">
                            <table class="table table-hover table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Opciones</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Activo</th>
                                        <th scope="col">Router</th>
                                        <th scope="col">User</th>
                                        <th scope="col">Fecha del Pago</th>
                                        <th scope="col">
                                            Referencia
                                            <span wire:click="sortBy('referencia')" class="float-right text-sm" style="cursor: pointer;">
                                                <i class="fa fa-arrow-up {{ $sortColumnName === 'referencia' && $sortDirection === 'asc' ? '' : 'text-muted' }}"></i>
                                                <i class="fa fa-arrow-down {{ $sortColumnName === 'referencia' && $sortDirection === 'desc' ? '' : 'text-muted' }}"></i>
                                            </span>
                                        </th>
                                        <th scope="col">
                                            Banco
                                            <span wire:click="sortBy('banco')" class="float-right text-sm" style="cursor: pointer;">
                                                <i class="fa fa-arrow-up {{ $sortColumnName === 'banco' && $sortDirection === 'asc' ? '' : 'text-muted' }}"></i>
                                                <i class="fa fa-arrow-down {{ $sortColumnName === 'banco' && $sortDirection === 'desc' ? '' : 'text-muted' }}"></i>
                                            </span>
                                        </th>
                                        <th scope="col">Teléfono</th>
                                        <th scope="col">Plan</th>
                                        <th scope="col">Monto</th>                                        
                                    </tr>
                                </thead>
                                <tbody wire:loading.class="text-muted">
                                    @forelse ($pagomoviles as $index => $pago)
                                    <tr>
                                        <th scope="row">{{ $pagomoviles->firstItem() + $index }}</th>
                                        <td>
                                            @if($pago->status === 'confirmado')
                                                <a href="" wire:click.prevent="activarUsuario({{ $pago }})">
                                                    <i class="fa fa-solid fa-user-plus mx-2"></i>
                                                </a>
                                            @else
                                                <a href="">
                                                    <i class="fa fa-solid fa-toggle-off mx-2"></i>
                                                </a>
                                            @endif
                                            

                                            <a href="" wire:click.prevent="enviarSms({{ $pago }})">
                                                <i class="fa fa-solid fa-comment mx-2"></i>
                                            </a>

                                            <a href="" wire:click.prevent="confirmPagoRemoval({{ $pago->id }})">
                                                <i class="fa fa-trash text-danger mx-2"></i>
                                            </a>
                                        </td>
                                        <td>
                                            <select style="width:120px;" class="form-control" wire:change="changeStatus({{ $pago }}, $event.target.value)">
                                                <option value="confirmado" {{ ($pago->status === 'confirmado') ? 'selected' : '' }}>CONFIRMADO</option>
                                                <option value="noconfirmado" {{ ($pago->status === 'noconfirmado') ? 'selected' : '' }}>NO CONFIRMADO</option>
                                                <option value="rechazado" {{ ($pago->status === 'rechazado') ? 'selected' : '' }}>RECHAZADO</option>
                                            </select>
                                        </td>                                        
                                        <td>{{ $pago->active }}</td>
                                        <td>{{ $pago->nrorouter }}</td>
                                        <td>{{ $pago->user }}</td>                                        
                                        <td>{{ $pago->fecha_pago }}</td>
                                        <td>{{ $pago->referencia }}</td>
                                        <td>{{ $pago->banco }}</td>
                                        <td>{{ $pago->telefono }}</td>
                                        <td>{{ $pago->plan }}</td>
                                        <td>{{ $pago->monto }}</td>
                                        
                                    </tr>
                                    @empty
                                    <tr class="text-center">
                                        <td colspan="11">
                                            <img src="https://42f2671d685f51e10fc6-b9fcecea3e50b3b59bdc28dead054ebc.ssl.cf5.rackcdn.com/v2/assets/empty.svg" alt="No results found">
                                            <p class="mt-2">No se encontro resultados</p>
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer d-flex justify-content-end">
                            {{ $pagomoviles->links() }}
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
            <form autocomplete="off" wire:submit.prevent="{{ $showEditModal ? 'updatePago' : 'createPago' }}">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                            @if($showEditModal)
                            <span>Editar Pago Móvil</span>
                            @else
                            <span>Nuevo Pago Móvil</span>
                            @endif
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Status</label>
                            <select name="" wire:model.defer="state.status" class="form-control @error('status') is-invalid @enderror" id="">
                                <option value="0">SELECCIONE..</option>
                                <option value="confirmado">CONFIRMADO</option>
                                <option value="noconfirmado">SIN CONFIRMACIÓN</option>
                                <option value="descartado">DESCARTADO</option>
                            </select>
                            @error('status')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="nrorouter">Nrorouter</label>
                            <input type="text" wire:model.defer="state.nrorouter" class="form-control @error('nrorouter') is-invalid @enderror" id="nrorouter" aria-describedby="nrorouterHelp" placeholder="Fecha pago">
                            @error('nrorouter')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="fecha_pago">fecha_pago</label>
                            <input type="date" wire:model.defer="state.fecha_pago" class="form-control @error('fecha_pago') is-invalid @enderror" id="fecha_pago" aria-describedby="fecha_pagoHelp" placeholder="Fecha pago">
                            @error('fecha_pago')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="referencia">Referencia</label>
                            <input type="text" wire:model.defer="state.referencia" class="form-control @error('referencia') is-invalid @enderror" id="referencia" aria-describedby="nameHelp" placeholder="Referencia">
                            @error('referencia')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="banco">Banco</label>
                            <input type="text" wire:model.defer="state.banco" class="form-control @error('banco') is-invalid @enderror" id="banco" aria-describedby="bancoHelp" placeholder="Banco">
                            @error('banco')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="telefono">Teléfono</label>
                            <input type="text" wire:model.defer="state.telefono" class="form-control @error('telefono') is-invalid @enderror" id="telefono" aria-describedby="telefonoHelp" placeholder="Teléfono">
                            @error('telefono')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="monto">Monto</label>
                            <input type="text" wire:model.defer="state.monto" class="form-control @error('monto') is-invalid @enderror" id="monto" aria-describedby="montoHelp" placeholder="Monto">
                            @error('monto')
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
                    <h5>Eliminar Pago Móvil</h5>
                </div>

                <div class="modal-body">
                    <h4>Esta seguro de querer eliminar este pago móvil?</h4>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times mr-1"></i> Cancelar</button>
                    <button type="button" wire:click.prevent="deletePago" class="btn btn-danger"><i class="fa fa-trash mr-1"></i>Eliminar Pago móvil</button>
                </div>
            </div>
        </div>
    </div>
</div>
