<div>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Usuarios para comercio: {{ $comercio->name }}</h1>
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
                                        <th scope="col">Teléfono</th>
                                        <th scope="col">Registerd Date</th>
                                        <th scope="col">Rol</th>
                                        <th scope="col">Opciones</th>
                                    </tr>
                                </thead>
                                <tbody wire:loading.class="text-muted">
                                    @forelse ($users as $index => $user)
                                    <tr>
                                        <th scope="row">{{ $users->firstItem() + $index }}</th>
                                        <td>
                                            <img src="{{ $user->user->avatar_url }}" style="width: 50px;" class="img img-circle mr-1" alt="">
                                            {{ $user->user->name }}
                                        </td>
                                        <td>{{ $user->user->email }}</td>
                                        <td>{{ $user->telefono() }}</td>
                                        <td>{{ $user->created_at->toFormattedDate() ?? 'N/A' }}</td>
                                        <td>
                                            <select class="form-control" wire:change="changeRole({{ $user }}, $event.target.value)">
                                                <option value="admincomercio" {{ ($user->rolecomercio === 'admincomercio') ? 'selected' : '' }}>Administrador Comercio</option>
                                                <option value="delivery" {{ ($user->rolecomercio === 'delivery') ? 'selected' : '' }}>Delivery</option>
                                            </select>
                                        </td>
                                        <td>
                                            <a href="/listComercios/{{ $user->id }}">
                                                <i class="fa fa-solid fa-building mr-2"></i>
                                            </a>

                                            <a href="" wire:click.prevent="edit({{ $user }})">
                                                <i class="fa fa-edit mr-2"></i>
                                            </a>

                                            <a href="" wire:click.prevent="confirmUserRemoval({{ $user->id }})">
                                                <i class="fa fa-trash text-danger"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr class="text-center">
                                        <td colspan="7">
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
                            <label for="name">Rol</label>
                            <select name="" wire:model.defer="state.rolecomercio" class="roleS form-control @error('role') is-invalid @enderror">
                                <option value="0">SELECCIONE..</option>
                                <option value="admincomercio">Administrador Comercio</option>
                                <option value="delivery">Delivery Boy</option>
                            </select>
                            @error('role')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <script>
                            let select = document.querySelector('.roleS')
                            select.addEventListener('change', function(event){
                                var selectElement = event.target.value;
                                let vehiculo = document.querySelector('.vehiculo')
                                if(selectElement == 'delivery'){
                                    vehiculo.classList.remove("d-none");
                                }else{
                                    vehiculo.classList.add("d-none");
                                }
                                
                            })
                        </script>

                        <div class="form-group d-none vehiculo">
                            <label for="vehiculo">Tipo de Vehículo</label>
                            <select name="" wire:model.defer="state.vehiculo" class="form-control @error('vehiculo') is-invalid @enderror">
                                <option value="0">SELECCIONE..</option>
                                <option value="moto">Moto</option>
                                <option value="carro">Carro</option>
                            </select>
                            @error('vehiculo')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="name">Usuario</label>
                            <input type="text" wire:model.defer="state.name" class="form-control @error('name') is-invalid @enderror" id="name" aria-describedby="nameHelp" placeholder="Usuario">
                            @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="identificationNac">Tipo </label>
                            <select wire:model.defer="state.identificationNac" class="form-control @error('identificationNac') is-invalid @enderror" name="identificationNac" id="identificationNac" placeholder="Tipo">
                                <option value="J">J-</option>
                                <option value="E">E-</option>
                                <option value="G">G-</option>
                                <option value="P">P-</option>
                                <option value="V" selected>V-</option>
                            </select>
                            @error('identificationNac')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            
                        </div>

                        <div class="form-group">
                            <label for="identificationNumber">Documento</label>
                            <input wire:model.defer="state.identificationNumber" type="text" class="form-control @error('identificationNumber') is-invalid @enderror" name="identificationNumber" id="identificationNumber" placeholder="Documento">
                            @error('identificationNumber')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="names">Nombres</label>
                            <input type="text" wire:model.defer="state.names" class="form-control @error('names') is-invalid @enderror" id="names" aria-describedby="namesHelp" placeholder="Nombres completo">
                            @error('names')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="surnames">Apellidos</label>
                            <input type="text" wire:model.defer="state.surnames" class="form-control @error('surnames') is-invalid @enderror" id="surnames" aria-describedby="namesHelp" placeholder="Nombres completo">
                            @error('surnames')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="cellphonecode">Operadora </label>
                            <select wire:model.defer="state.cellphonecode" class="form-control @error('cellphonecode') is-invalid @enderror" name="cellphonecode" id="cellphonecode">
                                <option value="0">Seleccione</option>
                                <option value="0412">0412</option>
                                <option value="0414">0414</option>
                                <option value="0424">0424</option>
                                <option value="0416">0416</option>
                                <option value="0426">0426</option>
                            </select>
                            @error('cellphonecode')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            
                        </div>

                        <div class="form-group">
                            <label for="cellphone">Celular</label>
                            <input wire:model.defer="state.cellphone" type="text" class="form-control @error('cellphone') is-invalid @enderror" name="cellphone" id="cellphone" placeholder="Celular">
                            @error('cellphone')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="email">Correo Electrónico</label>
                            <input type="text" wire:model.defer="state.email" class="form-control @error('email') is-invalid @enderror" id="email" aria-describedby="emailHelp" placeholder="Email">
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
</div>
