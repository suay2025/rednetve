<div>
    <link rel="stylesheet" href="/css/star.css">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Comercios</h1>
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
            @if($user)
            <div class="row">
                <div class="col-lg-12">
                    <div class="card w-50">
                        <div class="row">
                            <div class="col-lg-6">
                                <span>Propietario: </span>
                            </div>
                            <div class="col-lg-6">
                                <span>{{$user->name}}</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <span>Operación No Confirmada: </span>
                            </div>
                            <div class="col-lg-6">
                                <span>{{$user->OperacionNoConfirmada()}}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            <div class="row">
                <div class="col-lg-12">
                    <div class="d-flex justify-content-between mb-2">
                        <button wire:click.prevent="addNew" class="btn btn-primary"><i class="fa fa-plus-circle mr-1"></i> Comercio</button>
                        <x-search-input wire:model="searchTerm" />
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-hover table-bordered table-responsive">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">
                                            Nombre
                                            <span wire:click="sortBy('name')" class="float-right text-sm" style="cursor: pointer;">
                                                <i class="fa fa-arrow-up {{ $sortColumnName === 'name' && $sortDirection === 'asc' ? '' : 'text-muted' }}"></i>
                                                <i class="fa fa-arrow-down {{ $sortColumnName === 'name' && $sortDirection === 'desc' ? '' : 'text-muted' }}"></i>
                                            </span>
                                        </th>
                                        <th scope="col">No Confirmada</th>
                                        <th scope="col">Valoración</th>
                                        <td scope="col">Estrella</td>
                                        <th scope="col">Fecha de Registro</th>
                                        <th scope="col">Opciones</th>
                                    </tr>
                                </thead>
                                <tbody wire:loading.class="text-muted">
                                    @forelse ($comercios as $index => $comercio)
                                    <tr>
                                        <th scope="row">{{ $comercios->firstItem() + $index }}</th>
                                        <td>
                                            <img src="{{ $comercio->avatar_url }}" style="width: 50px;" class="img img-circle mr-1" alt="">
                                            {{ $comercio->name }}
                                        </td>
                                        <td>{{ $comercio->OperacionNoConfirmada() }}</td>
                                        <td></td>
                                        <td>
                                            
                                        </td>
                                        <td>{{ $comercio->created_at->toFormattedDate() ?? 'N/A' }}</td>
                                        <td class="fs-2">
                                            <a href="/listTransacciones/{{$comercio->id }}">
                                                <i class="fa fa-solid fa-file-invoice-dollar mx-2"></i>
                                            </a>

                                            <a href="/listCategories/{{$comercio->id }}">
                                                <i class="fa fa-solid fa-list mx-2"></i>
                                            </a>

                                            <a href="/listProducts/{{$comercio->id }}">
                                                <img width="35px" src="/img/icon-motor.png" alt="">
                                            </a>

                                            <a href="/listProducts/{{$comercio->id }}">
                                                <i class="fa fa-solid fa-motorcycle mx-2"></i>
                                            </a>

                                            <a href="/listMetodosPagosC/{{$comercio->id }}">
                                                <i class="fa fa-regular fa-credit-card mx-2"></i>
                                            </a>

                                            <a href="/listMetodosPagosC/{{$comercio->id }}">
                                                <i class="fa fa-solid fa-layer-group"></i>
                                            </a>

                                            <a href="/listCentrodistribucion/{{$comercio->id }}">
                                                <i class="fa fa-solid fa-dolly mr-2 mx-2"></i>
                                            </a>

                                            <a href="" wire:click.prevent="edit({{ $comercio }})">
                                                <i class="fa fa-edit mr-2 mx-2"></i>
                                            </a>

                                            <a href="" wire:click.prevent="confirmComercioRemoval({{ $comercio->id }})">
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
                            {{ $comercios->links() }}
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
            <form autocomplete="off" wire:submit.prevent="{{ $showEditModal ? 'updateComercio' : 'createComercio' }}">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                            @if($showEditModal)
                            <span>Editar Comercios</span>
                            @else
                            <span>Nuevo Comercio</span>
                            @endif
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="area_id">Área Económica</label>
                            <select wire:model.defer="state.area_id" class="form-control @error('area_id') is-invalid @enderror" id="area_id">
                                <option value="0">Seleccione una opción</option>
                                @foreach($areas as $area)
                                    <option value="{{ $area->id }}">{{ $area->name }}</option>
                                @endforeach
                            </select>
                            @error('area_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label for="name">Nombre</label>
                            <input type="text" wire:model.defer="state.name" class="form-control @error('name') is-invalid @enderror" id="name" aria-describedby="nameHelp" placeholder="Introduzca el Nombre">
                            @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="keyword">Indicador Único</label>
                            <input type="text" wire:model.defer="state.keyword" class="form-control @error('keyword') is-invalid @enderror" id="keyword" aria-describedby="keywordHelp" placeholder="Identificador Único" Readonly>
                            @error('keyword')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                            <script>
                                let name = document.querySelector('#name')
                                name.addEventListener('blur', function(){
                                    valor = document.getElementById("name").value;
                                    if( valor == null || valor.length == 0 || /^\s+$/.test(valor) ) { 
                                        return false;
                                    }
                                    Livewire.emit('generarKeyword', valor);

                                    window.addEventListener('getKeyword', event => {                
                                        let keyword = event.detail.keyword

                                        document.querySelector('#keyword').value= keyword
                                    
                                    })
                                    
                                    
                                })
                            </script>
                        </div>

                        <div class="form-group">
                            <label for="customFile">Logo del Comercio (150x80)</label>
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
                                        Seleccione el logo
                                    @endif
                                </label>
                            </div>

                            @if ($photo)
                                <img src="{{ $photo->temporaryUrl() }}" class="img d-block mt-2 w-100 rounded">
                            @else
                                <img src="{{ $state['avatar_url'] ?? '' }}" class="img d-block mb-2 w-100 rounded">
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="customFile">Banner del Comercio (600x100)</label>
                            <div class="custom-file">
                                <div x-data="{ isUploading: false, progress: 5 }" x-on:livewire-upload-start="isUploading = true" x-on:livewire-upload-finish="isUploading = false; progress = 5" x-on:livewire-upload-error="isUploading = false" x-on:livewire-upload-progress="progress = $event.detail.progress">
                                    <input wire:model="banner" type="file" class="custom-file-input" id="customFile1">
                                    <div x-show.transition="isUploading" class="progress progress-sm mt-2 rounded">
                                        <div class="progress-bar bg-primary progress-bar-striped" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" x-bind:style="`width: ${progress}%`">
                                            <span class="sr-only">40% Completo (exito)</span>
                                        </div>
                                    </div>
                                </div>
                                <label class="custom-file-label" for="customFile">
                                    @if ($banner)
                                        {{ $banner->getClientOriginalName() }}
                                    @else
                                        Seleccione el Banner
                                    @endif
                                </label>
                            </div>

                            @if ($banner)
                                <img src="{{ $banner->temporaryUrl() }}" class="img d-block mt-2 w-100 rounded">
                            @else
                                <img src="{{ $state['banner_url'] ?? '' }}" class="img d-block mb-2 w-100 rounded">
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="cellphonecontact">Numero de Contacto WhatsApp</label>
                            <input type="text" wire:model.defer="state.cellphonecontact" class="form-control @error('cellphonecontact') is-invalid @enderror" id="cellphonecontact" aria-describedby="cellphonecontactHelp" placeholder="Nro de WhatsApp">
                            @error('cellphonecontact')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="dominio">Dominio</label>
                            <input type="text" wire:model.defer="state.dominio" class="form-control @error('dominio') is-invalid @enderror" id="dominio" aria-describedby="dominioHelp" placeholder="Dominio">
                            @error('dominio')
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
                    <h5>Eliminar Comercio</h5>
                </div>

                <div class="modal-body">
                    <h4>Esta seguro de querer eliminar este comercio?</h4>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times mr-1"></i> Cancelar</button>
                    <button type="button" wire:click.prevent="deleteComercio" class="btn btn-danger"><i class="fa fa-trash mr-1"></i>Eliminar Usuario</button>
                </div>
            </div>
        </div>
    </div>
    <script>

        window.addEventListener('updateStar', event => {
                    
            let comercio_id = event.detail.comercio_id
            let puntuacion = event.detail.puntuacion
            let class = event.detail.class

            let div = `
                <div class="cardStar" product="${comercio_id}" wire:ignore>`
                    for ($i = 1; $i <=5; $i++){
                        if(puntuacion >= $i){
                div +=    `<span wire:click.prevent="valorar(1, ${comercio_id}, ${i})" product="${ comercio_id }" star = "${i}" class="star ${class}">★</span>`
                        }else{
                div +=    `<span wire:click.prevent="valorar(1, ${comercio_id}, ${i})" product="${ comercio_id }" star = "${i}" class="star">★</span>`
                        }
                    }
                div +=    `
                    <h5 class="output" output="${ comercio_id }">
                        Puntuación: ${puntuacion}/5
                    </h5>
                </div>
            `
        }
    </script>
    <script src="/js/star.js"></script>
</div>
