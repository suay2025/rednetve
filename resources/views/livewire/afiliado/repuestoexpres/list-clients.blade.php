<div>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Clientes</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Escritorio</a></li>
                        <li class="breadcrumb-item active">Clientes</li>
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
                        <button wire:click.prevent="addNew" class="btn btn-primary"><i class="fa fa-plus-circle mr-1"></i> Nuevo Cliente</button>
                        <x-search-input wire:model="searchTerm" />
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-hover table-bordered">
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
                                        <th scope="col">
                                            Email
                                            <span wire:click="sortBy('email')" class="float-right text-sm" style="cursor: pointer;">
                                                <i class="fa fa-arrow-up {{ $sortColumnName === 'email' && $sortDirection === 'asc' ? '' : 'text-muted' }}"></i>
                                                <i class="fa fa-arrow-down {{ $sortColumnName === 'email' && $sortDirection === 'desc' ? '' : 'text-muted' }}"></i>
                                            </span>
                                        </th>
                                        <th scope="col">Telélefono</th>
                                        <th scope="col">Vehículo</th>
                                    </tr>
                                </thead>
                                <tbody wire:loading.class="text-muted">
                                    @forelse ($users as $index => $user)
                                    <tr>
                                        <th scope="row">{{ $users->firstItem() + $index }}</th>
                                        <td>
                                            <img src="{{ $user->avatar_url }}" style="width: 50px;" class="img img-circle mr-1" alt="">
                                            {{ $user->name }}
                                        </td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->datosbasicos->telefono }}</td>
                                        <td>
                                        <a wire:click.prevent="addNewVehiculo({{ $user->id }})" style="cursor:pointer" ><i class="fa fa-plus-circle mr-1"></i> Nuevo Vehículo</a>
                                            
                                            <ul>
                                            @foreach ($user->showVehiculos($user->id) as $vehiculos)
                                                <li class="d-flex justify-content-between border border-1 p-2">
                                                    <div class="mx-2">
                                                        {{ 'Marca: ' . $vehiculos->manufacturer->name }}
                                                        <br>
                                                        {{ 'Modelo: ' . $vehiculos->modelo->name }}
                                                        <br>
                                                        {{ 'Motor: ' . $vehiculos->motor->name }}
                                                    </div>
                                                    <a href="" wire:click.prevent="confirmVehiculo({{ $vehiculos->id }})">
                                                        <i class="fa fa-trash text-danger"></i>
                                                    </a>
                                                </li>
                                            @endforeach
                                            </ul>
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
                            {{ $users->links() }}
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
            <form autocomplete="off" wire:submit.prevent="{{ $showEditModal ? 'updateUser' : 'createUser' }}">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                            @if($showEditModal)
                            <span>Editar Usuarios</span>
                            @else
                            <span>Nuevo Usuario</span>
                            @endif
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="role">Rol</label>
                            <input type="text" wire:model.defer="state.role" class="form-control" id="role" placeholder="Rol" readonly style="background-color:white">
                        </div>

                        <div class="form-group">
                            <div class="row mx-auto">
                                <div class="col-xs-6 col-md-4 col-sm-4 col-4">
                                    <label for="tipodocumento">Tipo </label>
                                    <select wire:model.defer="stateDatosBasicos.identificationNac" class="form-control inputForm inputType" name="" id="identificationNac" placeholder="Tipo">
                                        <option value="J">J-</option>
                                        <option value="E">E-</option>
                                        <option value="G">G-</option>
                                        <option value="P">P-</option>
                                        <option value="V" selected>V-</option>
                                    </select>
                                </div>
                                <div class="col-xs-6 col-md-8 col=sm-8 col-8">
                                    <label for="documento">Documento</label>
                                    <input wire:model.defer="stateDatosBasicos.identificationNumber" type="text" id="identificationNumber" class="form-control inputForm" placeholder="Documento">
                                </div>
                            </div>
                            
                        </div>

                        <div class="form-group">
                            <label for="name">Usuario</label>
                            <input type="text" wire:model.defer="state.name" class="form-control @error('name') is-invalid @enderror" id="name" aria-describedby="nameHelp" placeholder="Enter full name">
                            @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="email">Correo Electrónico</label>
                            <input type="text" wire:model.defer="state.email" class="form-control @error('email') is-invalid @enderror" id="email" aria-describedby="emailHelp" placeholder="Enter email">
                            @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password">Contraseña</label>
                            <input type="password" wire:model.defer="state.password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Contraseña">
                            @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="passwordConfirmation">Confirme la Contraseña</label>
                            <input type="password" wire:model.defer="state.password_confirmation" class="form-control" id="passwordConfirmation" placeholder="Confirme la Contraseña">
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
    <div class="modal fade" id="formVehiculo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
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
                            <label for="manufacturer">Marca</label>
                            <select wire:ignore wire:model="manufacturer" name="manufacturer_id" id="manufacturer_id" class="form-control @error('manufacturer') is-invalid @enderror">
                                @if($manufacturers->count() == 0 )    
                                    <option value="0">Seleccione una opción</option>
                                @else
                                <option value="0">Seleccione una opción</option>
                                @endif
                                @foreach($manufacturers as $manufacturer)
                                        <option value="{{ $manufacturer->id }}" selected="false">{{ $manufacturer->name }}</option>                        
                                @endforeach
                                <script>
                                    //$("#manufacturer_id").val("0");
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
                    <h4>Esta seguro de querer eliminar este usuario?</h4>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times mr-1"></i> Cancelar</button>
                    <button type="button" wire:click.prevent="deleteUser" class="btn btn-danger"><i class="fa fa-trash mr-1"></i>Eliminar Usuario</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        window.onpageshow = function() {
            window.addEventListener('show-formVehiculo', event => {
                
                $('#formVehiculo').modal('show');
            })

            window.addEventListener('hide-formVehiculo', event => {
                
                $('#formVehiculo').modal('hide');
            })

        }
    </script>
    
</div>
