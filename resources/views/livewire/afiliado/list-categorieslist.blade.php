<div>
    <style>
        ul{
            list-style:none;
            width: auto!important;
            
        }

        @media screen and (max-width: 768px) {


        }

    </style>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><i class="fa fa-solid fa-list"></i> Categorias Lista</h1>
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
                        <button wire:click.prevent="addNew" class="btn btn-primary"><i class="fa fa-plus-circle mr-1"></i> Agregar Categoría</button>
                        <x-search-input wire:model="searchTerm" />
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-hover table-bordered table-responsive">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">ID</th>
                                        <th scope="col">
                                            Categoría
                                            <span wire:click="sortBy('name')" class="float-right text-sm" style="cursor: pointer;">
                                                <i class="fa fa-arrow-up {{ $sortColumnName === 'name' && $sortDirection === 'asc' ? '' : 'text-muted' }}"></i>
                                                <i class="fa fa-arrow-down {{ $sortColumnName === 'name' && $sortDirection === 'desc' ? '' : 'text-muted' }}"></i>
                                            </span>
                                        </th>
                                        <th>Item Menú</th>
                                        <th class="subcategoria">SubCategoria</th>
                                        <th>Point</th>
                                        <th>Nivel</th>
                                        <th scope="col">Fecha de Registro</th>
                                        <th scope="col">Opciones</th>
                                    </tr>
                                </thead>
                                <tbody wire:loading.class="text-muted">
                                    @forelse ($categories as $index => $categoria)
                                    <tr>
                                        <th scope="row">{{ $categories->firstItem() + $index }}</th>
                                        <th scope="row">{{ $categoria->id }}</th>
                                        <td>
                                            {{ $categoria->name }}
                                        </td>
                                        <td>
                                            <select class="form-control" wire:change="changeMenu({{ $categoria }}, $event.target.value)">
                                                <option value="0" {{ ($categoria->itemMenu === '0') ? 'selected' : '' }}>NO</option>
                                                <option value="1" {{ ($categoria->itemMenu === '1') ? 'selected' : '' }}>SI</option>
                                            </select>
                                        </td>
                                        <td class="subcategoria">
                                            <?php $listado = $this->listar($categoria); ?>
                                            
                                            <a class = "mb-2" wire:click.prevent="addNewList({{ $categoria->id }}, '{{ $categoria->name }}')" href="">
                                                <i class="fa fa-solid fa-plus mr-2"></i>
                                                <span>SubCategoria</span>
                                            </a>
                                            <div class="row">
                                                <?php $listado = $this->listar($categoria); ?>
                                                {{$this->visualizarListado($categoria, $listado)}}                      
                                                    
                                            </div>                            
                                        </td>
                                        <td>{{ $categoria->point_id }}</td>
                                        <td>{{ $categoria->nivel }}</td>
                                        <td>{{ $categoria->created_at->toFormattedDate() ?? 'N/A' }}</td>
                                        <td>
                                            
                                            <a href="" wire:click.prevent="edit({{ $categoria }})">
                                                <i class="fa fa-edit mr-2"></i>
                                            </a>

                                            <a href="" wire:click.prevent="confirmCategoryRemoval({{ $categoria->id }})">
                                                <i class="fa fa-trash text-danger"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr class="text-center">
                                        <td colspan="9">
                                            <img src="https://42f2671d685f51e10fc6-b9fcecea3e50b3b59bdc28dead054ebc.ssl.cf5.rackcdn.com/v2/assets/empty.svg" alt="No results found">
                                            <p class="mt-2">No se encontro resultados</p>
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer d-flex justify-content-end">
                            {{ $categories->links() }}
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
            <form autocomplete="off" wire:submit.prevent="{{ $showEditModal ? 'updateCategory' : 'createCategory' }}">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                            @if($showEditModal)
                            <span>Editar Categoria</span>
                            @else
                            <span>Nuevo Categoria</span>
                            @endif
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">                        
                        <div class="form-group">
                            <label for="name">Categoria</label>
                            <input type="text" wire:model.defer="state.name" class="form-control @error('name') is-invalid @enderror" id="name" aria-describedby="nameHelp" placeholder="Introduzca la Categoria">
                            @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="itemMenu">Item Menu Categorías</label>
                            <select wire:model.defer="state.itemMenu" class="form-control @error('itemMenu') is-invalid @enderror" id="itemMenu" aria-describedby="itemMenuHelp" placeholder="Introduzca la Categoria">
                                <option value="0">No </option>
                                <option value="1">Si</option>
                            </select>
                            @error('itemMenu')
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
                    <h5>Eliminar Categoria</h5>
                </div>

                <div class="modal-body">
                    <h4>Esta seguro de querer eliminar esta categoria?</h4>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times mr-1"></i> Cancelar</button>
                    <button type="button" wire:click.prevent="deleteCategory" class="btn btn-danger"><i class="fa fa-trash mr-1"></i>Eliminar Categoria</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="confirmationModalList" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5>Eliminar Categoria <span class="categoryname"></span></h5>
                </div>

                <div class="modal-body">
                    <h4>Esta seguro de querer eliminar esta categoria <span class="categoryname"></span>?</h4>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times mr-1"></i> Cancelar</button>
                    <button type="button" wire:click.prevent="deleteCategory" class="btn btn-danger"><i class="fa fa-trash mr-1"></i>Eliminar Categoria</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="formList" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog" role="document">
            <form autocomplete="off" wire:submit.prevent="{{ $showEditModal ? 'updateCategoryList' : 'createCategoryList' }}">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                            @if($showEditModal)
                            <span>Editar Categoria Lista</span>
                            @else
                            <span>Agregar SubCategoria a </span><span class="categoryname"></span>
                            @endif
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">                        
                        <div class="form-group">
                            <label for="name">Categoria</label>
                            <input type="text" wire:model.defer="state.name" class="form-control @error('name') is-invalid @enderror" id="name" aria-describedby="nameHelp" placeholder="Introduzca la Categoria">
                            @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="itemMenu">Item Menu Categorías</label>
                            <select wire:model.defer="state.itemMenu" class="form-control @error('itemMenu') is-invalid @enderror" id="itemMenu" aria-describedby="itemMenuHelp" placeholder="Introduzca la Categoria">
                                <option value="0">No </option>
                                <option value="1">Si</option>
                            </select>
                            @error('itemMenu')
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

    <script>
        window.addEventListener('hide-formList', function (event) {
            $('#formList').modal('hide');
            toastr.success(event.detail.message, 'Success!');
        });

        window.addEventListener('show-formList', function (event) {
            $('#formList').modal('show');

            document.querySelector('.categoryname').innerTxt = event.detail.name
        });

        window.addEventListener('hide-delete-modalList', function (event) {
            $('#confirmationModalList').modal('hide');
            toastr.success(event.detail.message, 'Success!');
        });

        window.addEventListener('show-delete-modalList', function (event) {
            $('#confirmationModalList').modal('show');

            document.querySelector('.categoryname').innerTxt = event.detail.name
        });
    </script>
</div>
