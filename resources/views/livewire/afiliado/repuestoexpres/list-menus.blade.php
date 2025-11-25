<div>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><i class="fa fa-solid fa-list"></i> Menús</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/admin/dashboard">Escritorio</a></li>
                        <li class="breadcrumb-item active"><a href="/listComercios/{{$comercio->user_id}}">Comercios</a></li>
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
                    </div>
                </div>
            </div>
            @endif
            <div class="row">
                <div class="col-lg-12">
                    <div class="d-flex justify-content-between mb-2">
                        <button wire:click.prevent="addNew" class="btn btn-primary"><i class="fa fa-plus-circle mr-1"></i> Agregar Menú</button>
                        <x-search-input wire:model="searchTerm" />
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-hover table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">
                                            Texto
                                            <span wire:click="sortBy('texto')" class="float-right text-sm" style="cursor: pointer;">
                                                <i class="fa fa-arrow-up {{ $sortColumnName === 'texto' && $sortDirection === 'asc' ? '' : 'text-muted' }}"></i>
                                                <i class="fa fa-arrow-down {{ $sortColumnName === 'texto' && $sortDirection === 'desc' ? '' : 'text-muted' }}"></i>
                                            </span>
                                        </th>
                                        <th>Ruta</th>
                                        <th>Origen</th>
                                        <th>Menu</th>
                                        <th>Posición</th>
                                        <th scope="col">Fecha de Registro</th>
                                        <th scope="col">Opciones</th>
                                    </tr>
                                </thead>
                                <tbody wire:loading.class="text-muted">
                                    @forelse ($menus as $index => $menu)
                                    <tr>
                                        <th scope="row">{{ $menus->firstItem() + $index }}</th>
                                        <td>{{ $menu->texto }}</td>
                                        <td>{{ $menu->ruta }}</td>
                                        <td>{{ $menu->origen }}</td>
                                        <td>{{ $menu->menu }}</td>
                                        <td>{{ $menu->posicion }}</td>
                                        <td>{{ $menu->comercio_id }}</td>
                                        <td>{{ $menu->created_at->toFormattedDate() ?? 'N/A' }}</td>
                                        <td>                                            
                                            <a href="" wire:click.prevent="edit({{ $menu }})">
                                                <i class="fa fa-edit mr-2"></i>
                                            </a>

                                            <a href="" wire:click.prevent="confirmMenuRemoval({{ $menu->id }})">
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
                            {{ $menus->links() }}
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
            <form autocomplete="off" wire:submit.prevent="{{ $showEditModal ? 'updateMenu' : 'createMenu' }}">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                            @if($showEditModal)
                            <span>Editar Menú</span>
                            @else
                            <span>Nuevo Menú</span>
                            @endif
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">                        
                        <div class="form-group">
                            <label for="texto">Texto</label>
                            <input type="text" wire:model.defer="state.texto" class="form-control @error('texto') is-invalid @enderror" id="texto" aria-describedby="textoHelp" placeholder="Introduzca la Texto">
                            @error('texto')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="ruta">Ruta</label>
                            <input type="text" wire:model.defer="state.ruta" class="form-control @error('ruta') is-invalid @enderror" id="ruta" aria-describedby="rutaHelp" placeholder="Introduzca la Ruta">
                            @error('ruta')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="posicion">Posición</label>
                            <input type="text" wire:model.defer="state.posicion" class="form-control @error('posicion') is-invalid @enderror" id="posicion" aria-describedby="rutaHelp" placeholder="Introduzca la Posición">
                            @error('posicion')
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
                    <h5>Eliminar Menús</h5>
                </div>

                <div class="modal-body">
                    <h4>Esta seguro de querer eliminar este menú?</h4>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times mr-1"></i> Cancelar</button>
                    <button type="button" wire:click.prevent="deleteCategory" class="btn btn-danger"><i class="fa fa-trash mr-1"></i>Eliminar Categoria</button>
                </div>
            </div>
        </div>
    </div>
</div>
