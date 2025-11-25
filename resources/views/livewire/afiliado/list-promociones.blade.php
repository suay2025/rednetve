<div>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Promociones</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/admin/dashboard">Escritorio</a></li>
                        <li class="breadcrumb-item active">Promociones</li>
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
                        <button wire:click.prevent="addNew" class="btn btn-primary"><i class="fa fa-plus-circle mr-1"></i> Nueva Marca</button>
                        <x-search-input wire:model="searchTerm" />
                    </div>
                    <div class="card" style="width: 100% !important;">
                        <div class="card-body">
                            <table class="table table-hover table-bordered table-responsive">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">
                                            Titulo
                                            <span wire:click="sortBy('title')" class="float-right text-sm" style="cursor: pointer;">
                                                <i class="fa fa-arrow-up {{ $sortColumnName === 'title' && $sortDirection === 'asc' ? '' : 'text-muted' }}"></i>
                                                <i class="fa fa-arrow-down {{ $sortColumnName === 'title' && $sortDirection === 'desc' ? '' : 'text-muted' }}"></i>
                                            </span>
                                        </th>
                                        <th>Posicion</th>
                                        <th>Activo</th>
                                        <th scope="col">Fecha de Registro</th>
                                        <th scope="col">Opciones</th>
                                    </tr>
                                </thead>
                                <tbody wire:loading.class="text-muted">
                                    @forelse ($promociones as $index => $promocion)
                                    <tr>
                                        <th scope="row">{{ $promociones->firstItem() + $index }}</th>
                                        <td>
                                            <img src="{{ $promocion->avatar_url }}" style="width: 50px;" class="img img-circle mr-1" alt="">
                                            {{ $promocion->title }}
                                        </td>
                                        <td>{{ $promocion->order }}</td>
                                        <td>{{ $promocion->active }}</td>
                                        <td>{{ $promocion->created_at ?? 'N/A' }}</td>
                                        <td>
                                            
                                            <a href="" wire:click.prevent="edit({{ $promocion }})">
                                                <i class="fa fa-edit mr-2"></i>
                                            </a>

                                            <a href="" wire:click.prevent="confirmPromocionRemoval({{ $promocion->id }})">
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
                            {{ $promociones->links() }}
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
            <form autocomplete="off" wire:submit.prevent="{{ $showEditModal ? 'updatePromocion' : 'createPromocion' }}">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                            @if($showEditModal)
                            <span>Editar Promocion</span>
                            @else
                            <span>Nueva Promocion</span>
                            @endif
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="comercio" class="">Comercio <span class="text-danger">*</span></label>
                            <select wire:model="comercio" class="form-control @error('comercio') is-invalid @enderror" id="comercio">
                                <option value="0">Seleccione una opción</option>
                                @foreach($comercios as $com)
                                    <option value="{{ $com->id }}" selected>{{ $com->name }}</option>
                                @endforeach
                            </select>
                            @error('comercio')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="product" class="">Productos </label>
                            <select wire:model="product" class="form-control @error('product') is-invalid @enderror" id="product">
                                @if(count($products)> 0)
                                <option value="0">Seleccione una opción</option>
                                @endif
                                @foreach($products as $prod)
                                    <option value="{{ $prod->id }}">{{ $prod->name }}</option>
                                @endforeach
                            </select>
                            @error('product')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="title">Titulo</label>
                            <input type="text" wire:model.defer="state.title" id="title" autofocus class="form-control @error('title') is-invalid @enderror">
                            @error('title')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="order">Orden</label>
                            <input type="number" wire:model.defer="state.order" id="order" autofocus class="form-control @error('order') is-invalid @enderror">
                            @error('order')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="active">Activo</label>
                            <select wire:model.defer="state.active" id="active" autofocus class="form-control @error('active') is-invalid @enderror">
                                <option value="active">Activo</option>
                                <option value="notactive">No Activo</option>
                            </select>
                            @error('title')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="customFile">Foto de Perfil</label>
                            <div class="custom-file">
                                <div x-data="{ isUploading: false, progress: 5 }" x-on:livewire-upload-start="isUploading = true" x-on:livewire-upload-finish="isUploading = false; progress = 5" x-on:livewire-upload-error="isUploading = false" x-on:livewire-upload-progress="progress = $event.detail.progress">
                                    <input wire:model="photo" type="file" class="custom-file-input" id="customFile">
                                    <div x-show.transition="isUploading" class="progress progress-sm mt-2 rounded">
                                        <div class="progress-bar bg-primary progress-bar-striped" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" x-bind:style="`width: ${progress}%`">
                                            <span class="sr-only">40% Completo (exito)</span>
                                        </div>
                                    </div>
                                </div>
                                <label class="custom-file-label" for="customFile">
                                    @if ($photo)
                                    {{ $photo->getClientOriginalName() }}
                                    @else
                                    Seleccione la foto
                                    @endif
                                </label>
                            </div>

                            @if ($photo)
                            <img src="{{ $photo->temporaryUrl() }}" class="img d-block mt-2 w-100 rounded">
                            @else
                            <img src="{{ $state['avatar_url'] ?? '' }}" class="img d-block mb-2 w-100 rounded">
                            @endif
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times mr-1"></i> Cancelar</button>
                        <button type="submit" class="boton"><i class="fa fa-save mr-1"></i>
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
                <div class="modal-header text-white">
                    <h5>Eliminar Promocion</h5>
                </div>

                <div class="modal-body">
                    <h4>Esta usted seguro de querer eliminar esta Promocion?</h4>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times mr-1"></i> Cancelar</button>
                    <button type="button" wire:click.prevent="deletePromocion" class="btn btn-danger"><i class="fa fa-trash mr-1"></i>Eliminar Promocion</button>
                </div>
            </div>
        </div>
    </div>
</div>
