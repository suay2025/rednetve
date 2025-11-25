<div>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Vehículos</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Escritorio</a></li>
                        <li class="breadcrumb-item active">Vehículos</li>
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
                        <button wire:click.prevent="addNew" class="btn btn-primary"><i class="fa fa-plus-circle mr-1"></i> Nuevo Usuario</button>
                        <x-search-input wire:model="searchTerm" />
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-hover table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">
                                            Placa
                                            <span wire:click="sortBy('placa')" class="float-right text-sm" style="cursor: pointer;">
                                                <i class="fa fa-arrow-up {{ $sortColumnName === 'placa' && $sortDirection === 'asc' ? '' : 'text-muted' }}"></i>
                                                <i class="fa fa-arrow-down {{ $sortColumnName === 'placa' && $sortDirection === 'desc' ? '' : 'text-muted' }}"></i>
                                            </span>
                                        </th>
                                        <th scope="col">Marca</th>
                                        <th scope="col">Modelo</th>
                                        <th scope="col">Motor</th>
                                    </tr>
                                </thead>
                                <tbody wire:loading.class="text-muted">
                                    @forelse ($vehiculos as $index => $vehiculo)
                                    <tr>
                                        <th scope="row">{{ $vehiculos->firstItem() + $index }}</th>
                                        <td>{{ $vehiculo->placa }}</td>
                                        <td>{{ $vehiculo->marca }}</td>
                                        <td>{{ $vehiculo->modelo }}</td>
                                        <td>{{ $vehiculo->motor }}</td>
                                        <td>
                                            <a href="" wire:click.prevent="edit({{ $vehiculo }})">
                                                <i class="fa fa-edit mr-2"></i>
                                            </a>

                                            <a href="" wire:click.prevent="confirmVehiculoRemoval({{ $vehiculo->id }})">
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
                            {{ $vehiculos->links() }}
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
            <form autocomplete="off" wire:submit.prevent="{{ $showEditModal ? 'updateVehiculo' : 'createVehiculo' }}">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                            @if($showEditModal)
                            <span>Editar Vehículo</span>
                            @else
                            <span>Nuevo Vehículo</span>
                            @endif
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="placa">Placa</label>
                            <input type="text" wire:model.defer="state.placa" class="form-control @error('placa') is-invalid @enderror" id="placa" aria-describedby="placaHelp" placeholder="Placa">
                            @error('placa')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="manufacturer">Marca</label>
                            <select wire:ignore wire:model="manufacturer" name="manufacturer_id" id="manufacturer" class="form-control @error('manufacturer') is-invalid @enderror">
                                @if($manufacturers->count() == 0 )    
                                    <option value="0">Seleccione una opción</option>
                                @else
                                <option value="0">Seleccione una opción</option>
                                @endif
                                @foreach($manufacturers as $manufacturer)
                                        <option value="{{ $manufacturer->id }}" selected="false">{{ $manufacturer->name }}</option>                        
                                @endforeach
                                <script>
                                    $("#manufacturer_id").val("0");
                                </script>
                            </select>
                            @error('manufacturer')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="modelo">Modelo</label>
                            <select wire:model="modelo" name="modelo_id" id="modelo_id" class="modelo form-control @error('modelo') is-invalid @enderror" >
                                @if($modelos->count() == 0 )    
                                    <option value="0">Seleccione una opción</option>
                                @else
                                <option value="0">Seleccione una opción</option>
                                @endif
                                @foreach($modelos as $modelo)
                                    <option value="{{ $modelo->id }}">{{ $modelo->name }}</option>
                                @endforeach
                            </select>
                            @error('modelo')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="motor">Motor</label>
                            <select wire:model="motor" name="motor_id" id="motor_id" class="motor form-control @error('motor') is-invalid @enderror">
                                @if($motores->count() == 0 )    
                                    <option value="0">Seleccione una opción</option>
                                @else
                                <option value="0">Seleccione una opción</option>
                                @endif
                                @foreach($motores as $motor)
                                    <option value="{{ $motor->id }}">{{ $motor->name }}</option>
                                @endforeach
                            </select>
                            @error('motor')
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
                    <h5>Eliminar Usuario</h5>
                </div>

                <div class="modal-body">
                    <h4>Esta seguro de querer eliminar este vehículo?</h4>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times mr-1"></i> Cancelar</button>
                    <button type="button" wire:click.prevent="deleteVehiculo" class="btn btn-danger"><i class="fa fa-trash mr-1"></i>Eliminar Usuario</button>
                </div>
            </div>
        </div>
    </div>
</div>
