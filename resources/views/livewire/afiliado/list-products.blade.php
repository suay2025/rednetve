<div>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Productos</h1>
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

    <div class="row">
        <div class="col-md-6">
            
        </div>
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
                                <span>Operación No Confirmada: </span>
                            </div>
                            <div class="col-lg-6">
                                <span>{{ $user->OperacionNoConfirmada() }}</span>
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
                        <button wire:click.prevent="addNew" class="btn btn-primary"><i class="fa fa-plus-circle mr-1"></i> Nuevo Producto</button>
                        <x-search-input wire:model="searchTerm" />
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-hover table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Comercio</th>
                                        <th scope="col">
                                            Nombre
                                            <span wire:click="sortBy('name')" class="float-right text-sm" style="cursor: pointer;">
                                                <i class="fa fa-arrow-up {{ $sortColumnName === 'name' && $sortDirection === 'asc' ? '' : 'text-muted' }}"></i>
                                                <i class="fa fa-arrow-down {{ $sortColumnName === 'name' && $sortDirection === 'desc' ? '' : 'text-muted' }}"></i>
                                            </span>
                                        </th>
                                        <th scope="col">Categorias</th>
                                        <th scope="col">SubCategorias</th>
                                        <th scope="col">Fecha de Registro</th>
                                        <th scope="col">Opciones</th>
                                    </tr>
                                </thead>
                                <tbody wire:loading.class="text-muted">
                                    @forelse ($products as $index => $product)
                                    <tr>
                                        <th scope="row">{{ $products->firstItem() + $index }}</th>
                                        <td>{{ $product->comercio->name }}</td>
                                        <td>
                                            <img src="{{ $product->image1_url }}" style="width: 50px;" class="img img-circle mr-1" alt="">
                                            {{ $product->name }}
                                        </td>
                                        <td>{{ $product->category_id }}</td>
                                        <td>
                                            <a wire:click.prevent="addNewCategory({{ $product->id }})" style="cursor:pointer" ><i class="fa fa-plus-circle mr-1"></i> Nueva Categoria</a>
                                            <ul>
                                            @foreach ($product->showSubcategories() as $categorias)
                                                <li class="d-flex justify-content-between">
                                                    <div class="mx-2">{{ $categorias->subcategory()->name }}</div>
                                                    <a href="" wire:click.prevent="confirmProductCategories({{ $categorias->id }})">
                                                        <i class="fa fa-trash text-danger"></i>
                                                    </a>
                                                </li>
                                            @endforeach
                                            </ul>
                                        </td>
                                        <td>{{ $product->created_at->toFormattedDate() ?? 'N/A' }}</td>
                                        <td>
                                            <a href="" wire:click.prevent="edit({{ $product->id }})">
                                                <i class="fa fa-edit mr-2"></i>
                                            </a>

                                            <a href="" wire:click.prevent="confirmProductRemoval({{ $product->id }})">
                                                <i class="fa fa-trash text-danger"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr class="text-center">
                                        <td colspan="6">
                                            <img src="https://42f2671d685f51e10fc6-b9fcecea3e50b3b59bdc28dead054ebc.ssl.cf5.rackcdn.com/v2/assets/empty.svg" alt="No results found">
                                            <p class="mt-2">No se encontro resultados</p>
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer d-flex justify-content-end">
                            {{ $products->links() }}
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->

    <!-- Modal Product -->
    <!-- Modal -->
    <div class="modal fade" id="form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog" role="document">
            <form autocomplete="off" wire:submit.prevent="{{ $showEditModal ? 'updateProduct' : 'createProduct' }}">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                            @if($showEditModal)
                            <span>Editar Producto</span>
                            @else
                            <span>Nuevo Producto</span>
                            @endif
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="name">Categoría</label>
                            <select wire:model.defer="state.category_id" class="form-control @error('category_id') is-invalid @enderror" id="category_id" wire:change="changeCategory( $event.target.value, 0)">
                                <option value="0">Seleccione una opción</option>
                                @foreach($comercio->categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="name">Subcategoría</label>
                            <select wire:model.defer="state.subcategory_id" class="subcategory form-control @error('subcategory_id') is-invalid @enderror" id="subcategory_id" wire:ignore>
                            </select>
                            @error('subcategory_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label for="name">Nombre</label>
                            <input type="text" wire:model.defer="state.name" class="form-control @error('name') is-invalid @enderror" id="name" aria-describedby="nameHelp" placeholder="Enter full name">
                            @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="customFile">Imagen del Producto</label>
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
                                    Seleccione la imagen
                                    @endif
                                </label>
                            </div>

                            @if ($photo)
                            <img src="{{ $photo->temporaryUrl() }}" class="img d-block mt-2 w-100 rounded">
                            @else
                            <img src="{{ $state['image1_url'] ?? '' }}" class="img d-block mb-2 w-100 rounded">
                            @endif
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
                    <h5>Eliminar Producto</h5>
                </div>

                <div class="modal-body">
                    <h4>Esta seguro de querer eliminar este producto?</h4>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times mr-1"></i> Cancelar</button>
                    <button type="button" wire:click.prevent="deleteProduct" class="btn btn-danger"><i class="fa fa-trash mr-1"></i>Eliminar Producto</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Category -->
    <!-- Modal -->
    <div class="modal fade" id="formCategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog" role="document">
            <form autocomplete="off" wire:submit.prevent="{{ $showEditModal ? 'updateCategories' : 'createCategories' }}">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                            @if($showEditModal)
                            <span>Editar Category</span>
                            @else
                            <span>Nueva Categoria</span>
                            @endif
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="category">Categoría</label>
                            <select wire:model="category" class="form-control @error('category') is-invalid @enderror">
                                <option value="0">Seleccione una opción</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('category')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="subcategoryP_id">Subcategoría</label>
                            <select wire:model="subcategory" class="subcategoryP form-control @error('subcategoryP_id') is-invalid @enderror" >
                                @if($subcategories->count() == 0 )    
                                    <option value="0">Seleccione una opción</option>
                                @else
                                <option value="0">Seleccione una opción</option>
                                @endif
                                @foreach($subcategories as $subcategory)
                                    <option value="{{ $subcategory->id }}">{{ $subcategory->name }}</option>
                                @endforeach
                            </select>
                            @error('subcategoryP_id')
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
    <div class="modal fade" id="confirmationModalformCategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5>Eliminar Producto</h5>
                </div>

                <div class="modal-body">
                    <h4>Esta seguro de querer eliminar esta categoria?</h4>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times mr-1"></i> Cancelar</button>
                    <button type="button" wire:click.prevent="deleteProductCategories" class="btn btn-danger"><i class="fa fa-trash mr-1"></i>Eliminar Producto</button>
                </div>
            </div>
        </div>
    </div>


    <script>

        window.onpageshow = function() {
        
            window.addEventListener('sendSubcategories', event => {
                
                let subcategories = event.detail.subcategories

                let subcategory = event.detail.subcategory

                let msg = event.detail.msg

                let select = document.querySelector('.subcategory')
                
                select.innerHTML = ''

                var option = `<option value="0">${msg}</option>`
                
                subcategories.forEach(function(numero) {
                    
                    if(numero['name'] == subcategory){
                        option += `<option value="${numero['id']}" selected>${numero['name']}</option>`
                    }else{
                        option += `<option value="${numero['id']}">${numero['name']}</option>`
                    }
                    
                });
                
                select.innerHTML = option
            
            }) 

            window.addEventListener('sendSubcategoriesP', event => {
                toastr.success(event.detail.message, 'Success!');
                alert('ok')
                let subcategoriesP = event.detail.subcategoriesP

                let subcategoryP = event.detail.subcategoryP

                let msg = event.detail.msg

                let selectP = document.querySelector('.subcategoryP')
                
                selectP.innerHTML = ''

                var optionP = `<option value="0">${msg}</option>`
                
                subcategoriesP.forEach(function(numero) {
                    
                    if(numero['name'] == subcategoryP){
                        optionP += `<option value="${numero['id']}" selected>${numero['name']}</option>`
                    }else{
                        optionP += `<option value="${numero['id']}">${numero['name']}</option>`
                    }
                    
                });
                
                selectP.innerHTML = optionP
            
            }) 
        }
    </script>

    <script>
        
        window.onpageshow = function() {
            document.addEventListener('livewire:load', () => {
                //Livewire.emit('sendResolution', screen.width);
                @this.screenResolution = screen.width
            });

            window.addEventListener('show-formCategory', event => {
                
                $('#formCategory').modal('show');
            })

            window.addEventListener('hide-formCategory', event => {
                
                $('#formCategory').modal('hide');
            })

            window.addEventListener('show-delete-modalformCategory', event => {
                $('#confirmationModalformCategory').modal('show');
            })

            window.addEventListener('hide-delete-modalformCategory', event => {
                $('#confirmationModalformCategory').modal('hide');
            })
        }
    </script>

</div>



   
