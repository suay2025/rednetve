<div class="container-fluid">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="/css/app.css">
    <link rel="stylesheet" href="/css/infiniteSlider.css">

    <script src="/js/jquery-3.6.4.min.js"></script>
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

    @if(\Cart::getTotalQuantity()>0)

    <div class="row my-2">
        <div class="col-md-8">
            <table class="table table-responsive">
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
                        <td><strong>{{ $this->getComercio($item->attributes->comercio_id)->name }}</strong></td>
                        <td><strong>{{ $item->name }}</strong></td>
                        <td>{{ $this->convertir($item->price) }} {{ $currencyValue }}</td>
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
                        <td>{{ $this->convertir(\Cart::get($item->id)->getPriceSum()) }} {{ $currencyValue }} </td>
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
                                <button wire:click.prevent="finalizarCompra" class="form-control btn btn-success">Compra</button>
                                @else
                                    <div class="row">
                                        <div class="col-md-12">
                                        <strong>Ya Eres Usuario</strong> 
                                        <br>Nos gustaria que Colocaras tus credenciales
                                        <p class="mb-3">
                                            <a href="/login" class="boton dropdown-item" data-bs-toggle="modal" data-bs-target="#loginModal" style="cursor: pointer;">Entrar al Sistema</a>
                                        </p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                        <strong>Aun no tienes cuenta?</strong> 
                                            <a href="/register" class="boton dropdown-item" data-bs-toggle="modal" data-bs-target="#registerModal" style="cursor: pointer;">Registrarte</a>
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

    @else
    <div class="row my-2">
        <div class="col-md-12">
            <div class="centrar">Carrito Vacío</div>
            <div class="centrar">
                <img class="logo-responsive" src="/img/carrito_vacio.gif" alt="">
            </div>
        </div>
    </div>
    @endif
    
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
