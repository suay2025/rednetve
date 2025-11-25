<div>
    <script src="/js/bootstrap.bundle.min.js"></script>
    <div class="row">
        <div class="col-md-12">            
                <div class="accordion" id="accordionExample">
                    <div class="accordion-item">
                        <h4 class="accordion-header" id="headingOne">
                            <a class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                <h5>Libreta de direcciones</h5>
                            </a>
                        </h4>
                        <div id="collapseOne" class="accordion-collapse collapse @error('showLogin') show @enderror" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <div class="card" style="width: 100% !important;">
                                    <div class="card-header">
                                        
                                    </div>
                                    <div class="card-body">
                                        <table class="table table-hover table-bordered table-responsive">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Seleccione</th>
                                                    <th scope="col">Dirección</th>
                                                    <th scope="col">Opciones</th>
                                                </tr>
                                            </thead>
                                            <tbody wire:loading.class="text-muted">
                                                @forelse ($direcciones as $index => $direccion)
                                                <tr>
                                                    <th scope="row">{{ $direcciones->firstItem() + $index }}</th>
                                                    <td>
                                                        <button wire:click.prevent="seleccionar({{$direccion}})" class="btn btn-primary"> Seleccionar</button>
                                                    </td>
                                                    <td>{{$direccion->direccionCompleta() }} </td>
                                                    <td>
                                                        
                                                        <a href="" wire:click.prevent="edit({{ $direccion }})">
                                                            <i class="fa fa-edit mr-2"></i>
                                                        </a>

                                                        <a href="" wire:click.prevent="confirmDireccionRemoval({{ $direccion->id }})">
                                                            <i class="fa fa-trash text-danger"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                                @empty
                                                <tr class="text-center">
                                                    <td colspan="9">
                                                        <p class="mt-2">No dispone de direcciones</p>
                                                    </td>
                                                </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="card-footer d-flex justify-content-end">
                                        {{ $direcciones->links() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            @if($showEditModal)
                <button wire:click.prevent="addNew" class="btn btn-primary"><i class="fa fa-plus-circle mr-1"></i> Nueva Dirección</button>
            @endif
        </div>
    </div>
    <form class="formShipping" action="{{ route('pasarelaPost') }}" method="post">
    @csrf
    <div class="row">
        <div class="col-md-12">
            <div class="card my-3 mx-auto" style="width: 100% !important;">
                <div class="form-horizontal p-2">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <h4>Dirección de envío</h4>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group">

                        <input wire:model.defer="state.nropedido" type="hidden" name="nropedido" id="nropedido" >
                        <input wire:model.defer="state.metodoentrega" type="hidden" name="metodoentrega" id="metodoentrega" >

                        <div class="row">
                            <div class="col-xs-6 col-md-4 col-sm-4 col-12">
                                <label for="identificationNac">Tipo de documento <span class="text-danger">*</span></label>
                                <select wire:model.defer="state.identificationNac" class="form-control @error('identificationNac') is-invalid @enderror" name="identificationNac" id="identificationNac" placeholder="Tipo" {{$class}} {{$class1}}>
                                    <option value="J">J-</option>
                                    <option value="E">E-</option>
                                    <option value="G">G-</option>
                                    <option value="P">P-</option>
                                    <option value="V" selected>V-</option>
                                </select>
                            </div>
                            <div class="col-xs-6 col-md-8 col-sm-8 col-12">
                                <label for="identificationNumber">Documento <span class="text-danger">*</span></label>
                                <input wire:model.defer="state.identificationNumber" type="text" class="form-control @error('identificationNumber') is-invalid @enderror" name="identificationNumber" id="identificationNumber" placeholder="Documento" {{$class}} {{$class1}}>
                            </div>
                            @error('identificationNumber')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>                            
                    </div>
                    <div class="group-control my-3">
                        <label for="names" for="">Nombres <span class="text-danger">*</span></label>
                        <input wire:model.defer="state.names" type="text" class="form-control @error('names') is-invalid @enderror" id="names" {{$class}} {{$class1}}>
                        @error('names')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="group-control my-3">
                        <label for="surnames" for="">Apellidos <span class="text-danger">*</span></label>
                        <input wire:model.defer="state.surnames" type="text" class="form-control @error('surnames') is-invalid @enderror" id="surnames" {{$class}} {{$class1}}>
                        @error('surnames')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="cellphonecode">Teléfono <span class="text-danger">*</span></label>        
                        <div class="row ">
                            <div class="col-xs-6 col-md-5 col-sm-4 col-4">
                                <select wire:model.defer="state.cellphonecode" class="form-control @error('cellphonecode') is-invalid @enderror" name="cellphonecode" id="cellphonecode" {{$class}} {{$class1}}>
                                    <option value="0">Seleccione</option>
                                    <option value="0412">0412</option>
                                    <option value="0414">0414</option>
                                    <option value="0424">0424</option>
                                    <option value="0416">0416</option>
                                    <option value="0426">0426</option>
                                </select>
                            </div>
                            @error('cellphonecode')
                            <div class="invalid-feedback">
                                {{ $message}}
                            </div>
                            @enderror
                            <div class="col-xs-6 col-md-7 col-sm-8 col-8">
                                <input wire:model.defer="state.cellphone" type="text" class="form-control @error('cellphone') is-invalid @enderror" name="cellphone" id="cellphone" {{$class}} {{$class1}}>
                            </div>
                            @error('cellphone')
                            <div class="invalid-feedback">
                                {{ $message}}
                            </div>
                            @enderror
                        </div>                
                    </div>
                    <div class="form-group">
                        <label for="country" class="">País <span class="text-danger">*</span></label>
                        <select wire:model="country" class="form-control @error('country') is-invalid @enderror" id="country" {{$class}} {{$class1}}>
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
                        <select wire:model="province" class="form-control @error('province') is-invalid @enderror" id="province" {{$class}} {{$class1}}>
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
                        <select wire:model="city" class="form-control @error('city') is-invalid @enderror" id="city" {{$class}} {{$class1}}>
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
                        <label for="zona" class="">Zona de entrega <span class="text-danger">*</span></label>
                        <select wire:model="zona" wire:change="changeZona( $event.target.value)" class="form-control @error('zona') is-invalid @enderror" id="zona" {{$class}} {{$class1}}>
                            <option value="0">Por favor seleccione una ciudad</option>
                            @foreach($zonas as $zona)
                                <option value="{{ $zona->id }}">{{ $zona->name }}</option>
                            @endforeach
                        </select>
                        @error('zona')
                        <div class="invalid-feedback">
                            {{ $message}}
                        </div>
                        @enderror
                    </div>
                    <script>
                        // const changeSelected = (e) => {
                        //     alert(e.target.value)
                        //     console.log(e)
                        // };

                        // document.querySelector('#zona').addEventListener('change', changeSelected);

                    </script>
                    <div class="form-group">
                        <label for="address" class="">Dirección postal (Calle, Nº de Casa) <span class="text-danger">*</span></label>
                        <textarea wire:model.defer="state.address" type="text" class="form-control @error('address') is-invalid @enderror" id="inpuAddress" placeholder="Dirección" {{$class}} {{$class1}}></textarea>
                        @error('address')
                        <div class="invalid-feedback">
                            {{ $message}}
                        </div>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="zipcode" class="">Código Postal </label>
                        <input type="text" wire:model.defer="state.zipcode" type="text" class="form-control @error('zipcode') is-invalid @enderror" id="zipcode" placeholder="Código Postal" {{$class}} {{$class1}}>
                        @error('zipcode')
                        <div class="invalid-feedback">
                            {{ $message}}
                        </div>
                        @enderror
                    </div>

                    <!-- Metodos de entrega -->

                    <div class="form-group">
                        <div class="col-md-12">
                            <h4>Métodos de entrega</h4>
                        </div>
                    </div>
                    <input wire:model.defer="state.metodoenvio" type="hidden"  class=" @error('metodoenvio') is-invalid @enderror" id="metodoenvio">
                    @error('metodoenvio')
                    <div class="invalid-feedback">
                        {{ $message}}
                    </div>
                    @enderror
                    <div class="form-group">
                        <div class="row border border-top my-4 centrar" style="height: 45px !important;">
                            <div class="col-md-1">
                                <input class="input my-1" type="radio" name="metodoenvio" value="enviodelivery" checked/>
                            </div>
                            <div class="col-md-2">
                                @if($deliveryArea) {{ $currencyValue }} {{$deliveryArea->coste}} @else ? @endif
                            </div>
                            <div class="col-md-9">
                                <span class="datos">@if($deliveryArea) {{$deliveryArea->name}} @else Envío local @endif</span>
                                <input type="text"  wire:model.defer="state.costeenvio" >
                                <input type="text"  wire:model.defer="state.deliveryarea" >
                            </div>
                        </div>

                        <div class="row border border-top my-4 d-none">
                            <div class="col-md-12">
                                <div class="row my-3" >
                                    <div class="col-md-1">
                                        <input class="input my-1" type="radio" name="metodoenvio" value="envionacional"/> 
                                    </div>
                                    <div class="col-md-2">
                                        $
                                    </div>
                                    <div class="col-md-9">
                                        <span class="">Envío nacional</span>
                                    </div>
                                </div>
                                
                                <div class="row my-3">
                                    <div class="col-md-12">
                                        <div class="row mx-5">
                                            <div class="col-md-12">
                                                <input type="checkbox"> Asegurado
                                                <p>
                                                    Monto mínimo asegurado por defecto es $ 8,35 por paquete y el monto máximo asegurado permitido es $ 8.354,43. El valor es referencial.
                                                </p>
                                            </div>
                                        </div>
                                        <div class="row mx-5">
                                            <div class="col-md-12">
                                                <input type="checkbox" checked> Es domicilio
                                                <p>
                                                    Ubicaremos la oficina más cercana a su domicilio si la zona seleccionada no dispone del servicio/oficina. Por favor escríbanos al +58 416 5800403
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>                            
                        </div>
                        <script>
                            let metodoenvio = document.querySelector('.input')
                            metodoenvio.addEventListener('change', function(){
                                document.querySelector('#metodoenvio')
                            });
                        </script>                        
                    </div>
                     
                    <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10 d-flex">
                            <button wire:click.prevent="siguiente" class="btn btn-success mx-auto"> Siguiente</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </form>

    <!-- Modal -->
    <div class="modal fade" id="form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog" role="document">
            <form autocomplete="off" wire:submit.prevent="{{ $showEditModal ? 'updateDatos' : 'createDatos' }}">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                            @if($showEditModal)
                            <span>Editar Marca</span>
                            @else
                            <span>Nuevo Marca</span>
                            @endif
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">                        
                        <div class="form-group">
                            <div class="row">
                                <div class="col-xs-6 col-md-4 col-sm-4 col-4">
                                    <label for="identificationNac">Tipo de documento <span class="text-danger">*</span></label>
                                    <select wire:model.defer="state.identificationNac" class="form-control @error('identificationNac') is-invalid @enderror" name="identificationNac" id="identificationNac" placeholder="Tipo">
                                        <option value="J">J-</option>
                                        <option value="E">E-</option>
                                        <option value="G">G-</option>
                                        <option value="P">P-</option>
                                        <option value="V" selected>V-</option>
                                    </select>
                                </div>
                                <div class="col-xs-6 col-md-8 col-sm-8 col-8">
                                    <label for="identificationNumber">Documento <span class="text-danger">*</span></label>
                                    <input wire:model.defer="state.identificationNumber" type="text" class="form-control @error('identificationNumber') is-invalid @enderror" name="identificationNumber" id="identificationNumber" placeholder="Documento">
                                </div>
                                @error('identificationNumber')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>                            
                        </div>
                        <div class="group-control my-3">
                            <label for="names" for="">Nombres <span class="text-danger">*</span></label>
                            <input wire:model.defer="state.names" type="text" class="form-control @error('names') is-invalid @enderror" id="names">
                            @error('names')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="group-control my-3">
                            <label for="surnames" for="">Apellidos <span class="text-danger">*</span></label>
                            <input wire:model.defer="state.surnames" type="text" class="form-control @error('surnames') is-invalid @enderror" id="surnames">
                            @error('surnames')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="cellphonecode">Teléfono <span class="text-danger">*</span></label>        
                            <div class="row ">
                                <div class="col-xs-6 col-md-5 col-sm-4 col-4">
                                    <select wire:model.defer="state.cellphonecode" class="form-control @error('cellphonecode') is-invalid @enderror" name="cellphonecode" id="cellphonecode">
                                        <option value="0">Seleccione</option>
                                        <option value="0412">0412</option>
                                        <option value="0414">0414</option>
                                        <option value="0424">0424</option>
                                        <option value="0416">0416</option>
                                        <option value="0426">0426</option>
                                    </select>
                                </div>
                                @error('cellphonecode')
                                <div class="invalid-feedback">
                                    {{ $message}}
                                </div>
                                @enderror
                                <div class="col-xs-6 col-md-7 col-sm-8 col-8">
                                    <input wire:model.defer="state.cellphone" type="text" class="form-control @error('cellphone') is-invalid @enderror" name="cellphone" id="cellphone">
                                </div>
                                @error('cellphone')
                                <div class="invalid-feedback">
                                    {{ $message}}
                                </div>
                                @enderror
                            </div>                
                        </div>
                        <div class="form-group">
                            <label for="address" class="">Dirección postal (Calle, Nº de Casa) <span class="text-danger">*</span></label>
                            <textarea wire:model.defer="state.address" type="text" class="form-control @error('address') is-invalid @enderror" id="inpuAddress" placeholder="Dirección"></textarea>
                            @error('address')
                            <div class="invalid-feedback">
                                {{ $message}}
                            </div>
                            @enderror
                        </div>
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
                            <label for="zona" class="">Zona de entrega <span class="text-danger">*</span></label>
                            <select wire:model="zona" class="form-control @error('zona') is-invalid @enderror" id="zona">
                                <option value="0">Por favor seleccione una ciudad</option>
                                @foreach($zonas as $zona)
                                    <option value="{{ $zona->id }}">{{ $zona->name }}</option>
                                @endforeach
                            </select>
                            @error('zona')
                            <div class="invalid-feedback">
                                {{ $message}}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="zipcode" class="">Código Postal <span class="text-danger">*</span></label>
                            <input type="text" wire:model.defer="state.zipcode" type="text" class="form-control @error('zipcode') is-invalid @enderror" id="zipcode" placeholder="Código Postal">
                            @error('zipcode')
                            <div class="invalid-feedback">
                                {{ $message}}
                            </div>
                            @enderror
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
                    <h5>Eliminar Dirección</h5>
                </div>

                <div class="modal-body">
                    <h4>Esta usted seguro de querer eliminar esta Dirección?</h4>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times mr-1"></i> Cancelar</button>
                    <button type="button" wire:click.prevent="deleteDireccion" class="btn btn-danger"><i class="fa fa-trash mr-1"></i>Eliminar Dirección</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        window.addEventListener('enviarFormularioShipping', function (event) {
            let formShipping = document.querySelector('.formShipping');            
            formShipping.submit();        
        });
    </script>
    
</div>
