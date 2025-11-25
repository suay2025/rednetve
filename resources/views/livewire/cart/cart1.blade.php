<div class="container-fluid">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="/css/style-welcome.css">

    <script src="/js/slick.min.js"></script>
    <link rel="stylesheet" href="/css/slick-theme.min.css">
    <link rel="stylesheet" href="/css/slick.min.css">
    <link rel="stylesheet" href="/css/showProducts.css">
    <link rel="stylesheet" href="/css/star.css">

    <div class="row my-2">
        <div class="col-md-12">
        <a href="/"><h6><i class="fa fa-solid fa-arrow-left"></i> Continuar con la compra</h6></a>
        </div>
    </div>

    <div class="row my-2">
        <div class="col-md-8">
            <table class="table table-reponsive">
                <thead class="thead-primary">
                    <tr style="font-size: 12px">                      
                        <th scope="col"></th>
                        <th scope="col">Comercio</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Cantidad</th>
                        <th scope="col">Subtotal</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                @foreach($cartCollection as $item)
                <div class="row">
                    <tbody>
                    <tr style="font-size: 12px">
                        <td>
                            <img src="{{ $item->attributes->image }}" class="img-thumbnail" width="80" height="80">                                        
                        </td>
                        <td><strong>{{ $item->attributes->comercio_id }}</strong></td>
                        <td><strong>{{ $item->name }}</strong></td>
                        <td>{{ $item->price }} USD</td>
                        <td>
                            <div class="col-md-12 d-flex justify-content-between">
                            <div class="input-group input-number-group">
                                    <div class="input-group-button">
                                        <span class="input-number-decrement" wire:click.prevent="updateQuantity({{ $item->id }}, {{ $item->quantity }}, '-' )">-</span>
                                    </div>
                                    <input class="input-number" type="number" value="{{ $item->quantity }}" min="0" max="1000">
                                    <div class="input-group-button">
                                        <span class="input-number-increment" wire:click.prevent="updateQuantity({{ $item->id }}, {{ $item->quantity }}, '+' )">+</span>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>{{ \Cart::get($item->id)->getPriceSum() }} USD </td>
                        <td>
                            <form action="{{ route('cart.remove') }}"   method="POST">
                                {{ csrf_field() }}
                                <input type="hidden" value="{{ $item->id }}" id="id" name="id">
                                <button class="btn btn-danger"><i class="fa fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    </tbody>
                </div>
                @endforeach
            </table>
            @if(\Cart::getTotalQuantity()>0)
                <h6>{{ \Cart::getTotalQuantity()}} Producto(s) en el carrito</h6><br>
            @else
                <h6>No Existen Productos en el Carrito de Compra</h6><br>
            @endif
            <div class="row">
                <div class="col-md-6">
                @if(count($cartCollection)>0)
                    <form action="{{ route('cart.clear') }}" method="POST">
                    {{ csrf_field() }}
                    <button class="btn-danger">
                        Vaciar Carrito
                    </button> 
                    </form>
                @endif         
                </div>
            </div>                
        </div>
        <div class="col-md-4">
        <div>Su pedido (cant: {{ count($listpedidos)}})</div>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Precio total artículos</th>
                        <!-- <th scope="col">{{ $currencyValue }} {{$this->getSubTotal() }}</th> -->
                         <th scope="col">{{ $currencyValue }} {{ $this->getTotal() }}</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="d-none">
                        <th scope="row">Impuestos</th>
                        <td>{{ $currencyValue }} {{ $this->getImpuestoIVA() }}</td>
                    </tr>
                    @if($currencyValue == '$')
                    <tr class="d-none">
                        <th scope="row">IGTF</th>
                        <td>{{ $currencyValue }} {{ $this->amountIGTF() }}</td>
                    </tr>
                    @endif
                    <tr>
                        <th scope="row">Total</th>
                        <td>{{ $currencyValue }} {{ $this->getTotal() }}</td>
                    </tr>
                    <tr>
                        <th scope="row" colspan = "2">
                            @if(count($cartCollection)>0)
                                @auth
                                <button wire:click.prevent="finalizarCompra" class="form-control btn btn-success">Comprar</button>
                                @else
                                <div class="row">
                                    <div class="accordion" id="accordionExample">
                                        <div class="accordion-item">
                                            <h4 class="accordion-header" id="headingOne">
                                                <a class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                    <strong>¿Ya Eres Usuario? </strong> 
                                                </a>
                                            </h4>
                                            <div id="collapseOne" class="accordion-collapse collapse @error('showLogin') show @enderror" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    <br>Nos gustaria que Colocaras tus credenciales
                                                    <br>
                                                    <form action="{{ route('autenticar') }}" method="POST">
                                                        @csrf
                                                        <div class="group-control">
                                                            <label class="text-bold Text-Uppercase" for="">Inicia Sesión</label>
                                                        </div>
                                                        <div class="group-control my-3 d-none">
                                                            <a class="form-control text-center" href="/login-google"><i class="fa fa-brands fa-google"></i> Iniciar con Google</a>
                                                        </div>
                                                        
                                                        <div class="form-group my-3">
                                                            <div class="row" >
                                                                <div class="col-xs-12 col-sm-12 col-md-12">
                                                                    <label for="email">Correo Electrónico</label>
                                                                    <input type="email" name="email" class="form-control inputForm" placeholder="Correo Electrónico" id="emailW">
                                                                </div>
                                                            </div>
                                                            @error('email')
                                                            <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                
                                                        <div class="form-group my-3">
                                                            <div class="row">
                                                                <div class="col-xs-12 col-sm-12 col-md-12">
                                                                    <label for="password">Contraseña</label>
                                                                    <input type="password" name="password" id="password-fieldW" class="form-control inputForm" placeholder="Contraseña" value="12345678"/>
                                                                </div>
                                                            </div>                
                                                        </div>          
                                                        
                                                        <div class="form-group">
                                                            <div class="row my-3">
                                                                <div class="col-xs-12 col-sm-12 col-md-12 d-flex">
                                                                    <button class="btn btn-app w-100 mx-auto">Iniciar Sesión</button>
                                                                </div>
                                                            </div>                
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h4 class="accordion-header" id="headingThree">
                                                <a class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                    <strong>¿Aún no tienes cuenta? </strong> 
                                                </a>
                                            </h4>
                                            <div id="collapseThree" class="accordion-collapse collapse @error('showRegister') show @enderror" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    <form action="{{ route('registrarse') }}" method="post">           
                                                        @csrf
                                                        <input type="hidden" value="cliente" id="role" name="role" value="{{old('role')}}">

                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-xs-6 col-md-4 col-sm-4 col-4">
                                                                    <label for="identificationNac">Nac </label>
                                                                    <select class="form-control @error('identificationNac') is-invalid @enderror" name="identificationNac" id="identificationNac" placeholder="Tipo" value="{{old('identificationNac')}}">
                                                                        <option value="J">J-</option>
                                                                        <option value="E">E-</option>
                                                                        <option value="G">G-</option>
                                                                        <option value="P">P-</option>
                                                                        <option value="V" selected>V-</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-xs-6 col-md-8 col=sm-8 col-8">
                                                                    <label for="identificationNumber">Documento</label>
                                                                    <input type="text" class="form-control @error('identificationNumber') is-invalid @enderror" name="identificationNumber" id="identificationNumber" placeholder="Documento" value="{{old('identificationNumber')}}">
                                                                </div>
                                                                @error('identificationNumber')
                                                                <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>                            
                                                        </div>
                                                        
                                                        <div class="form-group">
                                                            <label for="name">Usuario <span class="text-danger">*</span></label>
                                                            <div class="input-group mb-3">                
                                                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Usuario" value="{{old('name')}}">
                                                                <div class="input-group-append">
                                                                    <div class="input-group-text">
                                                                        <span class="fas fa-envelope"></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @error('name')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="names">Nombres <span class="text-danger">*</span></label>
                                                            <div class="input-group mb-3">                
                                                                <input type="text" name="names" class="form-control" placeholder="Nombre completo" value="{{old('names')}}">
                                                                <div class="input-group-append">
                                                                    <div class="input-group-text">
                                                                        <span class="fas fa-envelope"></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @error('names')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="surnames">Apellidos <span class="text-danger">*</span></label>
                                                            <div class="input-group mb-3">                
                                                                <input type="text" name="surnames" class="form-control" placeholder="Apellidos" value="{{old('surnames')}}">
                                                                <div class="input-group-append">
                                                                    <div class="input-group-text">
                                                                        <span class="fas fa-envelope"></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @error('surnames')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                        
                                                        <div class="form-group">
                                                            <label for="documento">Email <span class="text-danger">*</span></label>            
                                                            <div class="input-group mb-3">
                                                                <input type="email" name="email" id="email" class="form-control" placeholder="Email" value="{{old('email')}}">
                                                                <div class="input-group-append">
                                                                    <div class="input-group-text">
                                                                        <span class="fas fa-envelope"></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @error('email')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="documento">Contraseña <span class="text-danger">*</span></label>            
                                                            <div class="input-group mb-3">
                                                                <input type="password" name="password" class="form-control" placeholder="Password" value="12345678" value="{{old('password')}}">
                                                                <div class="input-group-append">
                                                                <div class="input-group-text">
                                                                        <span class="fas fa-lock"></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @error('password')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="documento">Repita la contraseña <span class="text-danger">*</span></label>        
                                                            <div class="input-group mb-3">
                                                                <input type="password" name="password_confirmation" class="form-control" placeholder="password confirmation" value="12345678">
                                                                <div class="input-group-append">
                                                                <div class="input-group-text">
                                                                        <span class="fas fa-lock"></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @error('password_confirmation')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="documento">Teléfono </label>        
                                                            <div class="row ">
                                                                <div class="col-xs-6 col-md-5 col-sm-4 col-4">
                                                                    <select class="form-control @error('cellphone') is-invalid @enderror" name="cellphonecode" id="cellphonecode" value="{{old('cellphonecode')}}"> 
                                                                        <option value="0">Seleccione</option>
                                                                        <option value="0412">0412</option>
                                                                        <option value="0414">0414</option>
                                                                        <option value="0424">0424</option>
                                                                        <option value="0416">0416</option>
                                                                        <option value="0426">0426</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-xs-6 col-md-7 col-sm-8 col-8">
                                                                    <input type="text" class="form-control @error('cellphone') is-invalid @enderror" name="cellphone" id="cellphone" value="{{old('cellphone')}}">
                                                                </div>
                                                            </div>   
                                                            @error('cellphonecode')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror 
                                                            @error('cellphone')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror            
                                                        </div>

                                                        <div class="form-group my-3 d-flex">
                                                            <button type="submit" class="btn btn-app mx-auto"><span class="fas fa-user-plus"></span>Unete</button>
                                                        </div>

                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endauth
                            @endif
                        </th>
                    </tr>
                </tbody>
            </table>            
        </div>
    </div>

    <div class="row my-2">
        <div class="col-md-12">
            @livewire('components.show-recommended', [
                    'comercioId' => 1, 
                    'parametro' => $words,
                    'manufacturer_id' => $manufacturer_id,
                    'modelo_id' => $modelo_id,
                    'motor_id' => $motor_id,
                    ] )
        </div>
    </div>
    
    <script>
        $('.input-number-increment').click(function() {
        var $input = $(this).parents('.input-number-group').find('.input-number');
        var val = parseInt($input.val(), 10);
        $input.val(val + 1);
        });

        $('.input-number-decrement').click(function() {
        var $input = $(this).parents('.input-number-group').find('.input-number');
        var val = parseInt($input.val(), 10);
        if(val > 0)
            $input.val(val - 1);
        })

    </script>

    
</div>