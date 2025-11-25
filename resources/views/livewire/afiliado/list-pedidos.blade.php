<div>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Pedidos Solicitados</h1>
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

            <div class="row">
                <div class="col-lg-12">
                    <div class="d-flex justify-content-between mb-2">
                        <button wire:click.prevent="addNew" class="btn btn-primary"><i class="fa fa-plus-circle mr-1"></i> Nuevo Pedido</button>
                        <x-search-input wire:model="searchTerm" />
                    </div>
                    <div class="card" style="width: 100% !important;">
                        <div class="card-body">
                            <table class="table table-hover table-bordered table-responsive">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Confirmado</th>
                                        <th scope="col">
                                            Pedido
                                            <span wire:click="sortBy('pedido')" class="float-right text-sm" style="cursor: pointer;">
                                                <i class="fa fa-arrow-up {{ $sortColumnName === 'pedido' && $sortDirection === 'asc' ? '' : 'text-muted' }}"></i>
                                                <i class="fa fa-arrow-down {{ $sortColumnName === 'pedido' && $sortDirection === 'desc' ? '' : 'text-muted' }}"></i>
                                            </span>
                                        </th>
                                        <th scope="col">
                                            Referencia
                                            <span wire:click="sortBy('reference')" class="float-right text-sm" style="cursor: pointer;">
                                                <i class="fa fa-arrow-up {{ $sortColumnName === 'reference' && $sortDirection === 'asc' ? '' : 'text-muted' }}"></i>
                                                <i class="fa fa-arrow-down {{ $sortColumnName === 'reference' && $sortDirection === 'desc' ? '' : 'text-muted' }}"></i>
                                            </span>
                                        </th>
                                        <th scope="col">Cédula</th>
                                        <th scope="col">Cliente</th>
                                        <th scope="col">Productos</th>
                                        <th scope="col">Fecha de Registro</th>
                                        <th scope="col">Opciones</th>
                                    </tr>
                                </thead>
                                <tbody wire:loading.class="text-muted">
                                    @forelse ($pedidos as $index => $pedido)
                                    <tr>
                                        <th scope="row">{{ $pedidos->firstItem() + $index }}</th>
                                        <td>
                                            <select class="form-control" wire:change="changeConfirmation({{ $pedido }}, $event.target.value)">
                                                <option value="0" {{ ($pedido->confirmed === 0) ? 'selected' : '' }}>NO CONFIRMADO</option>
                                                <option value="1" {{ ($pedido->confirmed === 1) ? 'selected' : '' }}>CONFIRMADO</option>
                                                <option value="2" {{ ($pedido->confirmed === 2) ? 'selected' : '' }}>CONFIRMADO FALLIDA</option>
                                            </select>
                                        </td>
                                        <td><a href="/pasarela/{{ $pedido->pedido }}/{{ $pedido->comercio_id }}">{{ $pedido->nropedido }}</a></td>
                                        <td>{{ $pedido->reference }}</td>
                                        <td>{{ $pedido->client->identificationNumber }}</td>
                                        <td>{{ $pedido->client->name }}</td>
                                        <td></td>
                                        <td>{{ $pedido->created_at ?? 'N/A' }}</td>
                                        <td>
                                            
                                            <a href="" wire:click.prevent="edit({{ $pedido }})">
                                                <i class="fa fa-edit mr-2"></i>
                                            </a>

                                            <a href="" wire:click.prevent="confirmPedidoRemoval({{ $pedido->id }})">
                                                <i class="fa fa-trash text-danger"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr class="text-center">
                                        <td colspan="9">
                                            <img src="https://42f2671d685f51e10fc6-b9fcecea3e50b3b59bdc28dead054ebc.ssl.cf5.rackcdn.com/v2/assets/empty.svg" alt="No results found" style="width: 150px;">
                                            <p class="mt-2">No se encontro resultado</p>
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer d-flex justify-content-end">
                            {{ $pedidos->links() }}
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
            <form autocomplete="off" wire:submit.prevent="{{ $showEditModal ? 'updatePedido' : 'createPedido' }}">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                            @if($showEditModal)
                            <span>Editar Pedido</span>
                            @else
                            <span>Nuevo Pedido</span>
                            @endif
                        </h5>
                        <button type="button" class="close text-dark" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="cedula">Cédula</label>
                            <input type="text" wire:model.defer="state.cedula" id="cedula" autofocus class="form-control @error('cedula') is-invalid @enderror">
                            @error('cedula')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror                    
                        </div>

                        <div class="form-group">
                            <label for="reference">Referencia</label>
                            <input type="text" wire:model.defer="state.reference" id="reference" autofocus class="form-control @error('reference') is-invalid @enderror">
                            @error('reference')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label for="description">Descripción</label>
                            <textarea wire:model.defer="state.description" id="description" autofocus class="form-control @error('description') is-invalid @enderror"></textarea>
                            @error('description')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="coste">Costo</label>
                            <input type="text" wire:model.defer="state.coste" id="coste" autofocus class="form-control @error('coste') is-invalid @enderror">
                            @error('coste')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror                    
                        </div>
                    
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="custom-control custom-switch">
                                        <input wire:model.defer="state.in_delivery" type="checkbox" class="custom-control-input" id="in_delivery">
                                        <label class="custom-control-label  mx-3" for="in_delivery">Posee Delivery</label>
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
                <div class="modal-header text-white" style="background-color: #6C2689;">
                    <h5>Eliminar Pedido</h5>
                </div>

                <div class="modal-body">
                    <h4>Esta usted seguro de querer eliminar este Pedido?</h4>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times mr-1"></i> Cancelar</button>
                    <button type="button" wire:click.prevent="deletePedido" class="btn btn-danger"><i class="fa fa-trash mr-1"></i>Eliminar Pedido</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</div>

