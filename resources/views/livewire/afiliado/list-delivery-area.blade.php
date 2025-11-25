<div>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"> <i class="fa fa-solid fa-layer-group"></i>Zonas de entregas</h1>
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
            @if($user)
            <div class="row">
                <div class="col-lg-12">
                    <div class="card w-50">
                        <div class="row">
                            <div class="col-lg-6">
                                <span>Propietario: </span>
                            </div>
                            <div class="col-lg-6">
                                <span>{{ $user->name }}</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <span>Comercio: </span>
                            </div>
                            <div class="col-lg-6">
                                <span>{{ $comercio->name }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <div class="row">
                <div class="col-lg-12">
                    <div class="d-flex justify-content-between mb-2">
                        <button wire:click.prevent="addNew" class="btn btn-primary"><i class="fa fa-plus-circle mr-1"></i> Nueva Zona</button>
                        <x-search-input wire:model="searchTerm" />
                    </div>
                    <div class="card" style="width: 100% !important;">
                        <div class="card-body">
                            <table class="table table-hover table-bordered table-responsive">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">País</th>
                                        <th scope="col">Estado</th>
                                        <th scope="col">Ciudad</th>
                                        <th scope="col">
                                            Zona
                                            <span wire:click="sortBy('name')" class="float-right text-sm" style="cursor: pointer;">
                                                <i class="fa fa-arrow-up {{ $sortColumnName === 'name' && $sortDirection === 'asc' ? '' : 'text-muted' }}"></i>
                                                <i class="fa fa-arrow-down {{ $sortColumnName === 'name' && $sortDirection === 'desc' ? '' : 'text-muted' }}"></i>
                                            </span>
                                        </th>
                                        <th scope="col">Distancia</th>
                                        <th scope="col">Costo</th>
                                        <th scope="col">Fecha de Registro</th>
                                        <th scope="col">Opciones</th>
                                    </tr>
                                </thead>
                                <tbody wire:loading.class="text-muted">
                                    @forelse ($zonas as $index => $zona)
                                    <tr>
                                        <th scope="row">{{ $zonas->firstItem() + $index }}</th>
                                        <td>{{ $zona->country->name }}</td>
                                        <td>{{ $zona->province->name }}</td>
                                        <td>{{ $zona->city->name }}</td>
                                        <td>{{ $zona->name }}</td>
                                        <td>{{ $zona->distance }}</td>
                                        <td>{{ $zona->coste }}</td>
                                        <td>{{ $zona->created_at ?? 'N/A' }}</td>
                                        <td>
                                            
                                            <a href="" wire:click.prevent="edit({{ $zona }})">
                                                <i class="fa fa-edit mr-2"></i>
                                            </a>

                                            <a href="" wire:click.prevent="confirmZonaRemoval({{ $zona->id }})">
                                                <i class="fa fa-trash text-danger"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr class="text-center">
                                        <td colspan="6">
                                            <img src="https://42f2671d685f51e10fc6-b9fcecea3e50b3b59bdc28dead054ebc.ssl.cf5.rackcdn.com/v2/assets/empty.svg" alt="No results found" style="width: 150px;">
                                            <p class="mt-2">No se encontro resultado</p>
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer d-flex justify-content-end">
                            {{ $zonas->links() }}
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
            <form autocomplete="off" wire:submit.prevent="{{ $showEditModal ? 'updateZona' : 'createZona' }}">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                            @if($showEditModal)
                            <span>Editar Zona</span>
                            @else
                            <span>Nuevo Zona</span>
                            @endif
                        </h5>
                        <button type="button" class="close text-dark" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="country" class="">País <span class="text-danger">*</span></label>
                            <select wire:model="country" class="form-control @error('country') is-invalid @enderror" id="country">
                                <option value="0">Seleccione una opción</option>
                                @foreach($countries as $country)
                                    @if($country->name == 'Venezuela')
                                    <option value="{{ $country->id }}" selected>{{ $country->name }}</option>
                                    @else
                                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                            @error('country')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="province" class="">Estado/Provincia </label>
                            <select wire:model="province" class="form-control @error('province') is-invalid @enderror" id="province">
                            <option value="0">Seleccione una opción</option>
                                @foreach($provinces as $province)
                                    <option value="{{ $province->id }}">{{ $province->name }}</option>
                                @endforeach
                            </select>
                            @error('province')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="city" class="">Ciudad/Sector <span class="text-danger">*</span></label>
                            <select wire:model="city" class="form-control @error('city') is-invalid @enderror" id="city">
                                <option value="0">Por favor seleccione una ciudad</option>
                                @foreach($cities as $city)
                                    <option value="{{ $city->id }}">{{ $city->name }}</option>
                                @endforeach
                            </select>
                            @error('city')
                            <div class="invalid-feedback">
                                {{ $message}}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="name">Zona</label>
                            <input type="text" wire:model.defer="state.name" id="name" autofocus class="form-control @error('name') is-invalid @enderror">
                            @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="coste">Costo</label>
                            <input type="number" wire:model.defer="state.coste" id="coste" autofocus class="form-control @error('coste') is-invalid @enderror">
                            @error('coste')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="distance">Distancia</label>
                            <input type="number" wire:model.defer="state.distance" id="distance" autofocus class="form-control @error('distance') is-invalid @enderror">
                            @error('distance')
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
                <div class="modal-header text-white" style="background-color: #6C2689;">
                    <h5>Eliminar Zona</h5>
                </div>

                <div class="modal-body">
                    <h4>Esta usted seguro de querer eliminar esta Zona?</h4>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times mr-1"></i> Cancelar</button>
                    <button type="button" wire:click.prevent="deleteZona" class="btn btn-danger"><i class="fa fa-trash mr-1"></i>Eliminar Zona</button>
                </div>
            </div>
        </div>
    </div>

</div>

