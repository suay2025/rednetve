    <div class="">    
        <style>
            .img-responsive {
                width:100%; height: 250px;
            }
            @media only screen and (max-width: 1070px) {
                .img-responsive {
                    
                }   
            }
        </style>
        <head>
            @if(auth()->user())
                <meta charset="utf-8">
                <meta name="viewport" content="width=device-width, initial-scale=1">
                <meta http-equiv="x-ua-compatible" content="ie=edge">
                <link rel="icon" type="image/svg+xml" href="/icon.png" />
                <title>{{ setting('site_title') }} | {{ setting('site_name') }}</title>
                <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
                <link rel="stylesheet" href="/css/navigationMap.css">
                <!-- <link rel="stylesheet" href="/css/style.css"> -->
                <link rel="stylesheet" href="/css/bootstrap.min.css">
                <!-- <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script> -->
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
                
                <script src="/js/jquery-3.6.4.min.js"></script>  
                <script src="/js/slick.min.js"></script>

                <link rel="stylesheet" href="/css/slick-theme.min.css">
                <link rel="stylesheet" href="/css/slick.min.css">
                <link rel="stylesheet" href="/css/carouselOffer.css">
                <link rel="stylesheet" href="/css/showProducts.css">
                <link rel="stylesheet" href="/css/star.css">
                @stack('styles')
                <livewire:styles />
                @endif          
            </head>
            @if($in_cellphonecontact > 0)            
                <div class="row" id="whatsapp">
                    <a href="https://api.whatsapp.com/send?phone=+58{{$comercio->contactcellphone}}&text={{ $comercio->msgcontact}}" target="_blank">
                        <svg aria-hidden="true" focusable="false" data-prefix="fab" data-icon="whatsapp" class="svg-inline--fa fa-whatsapp fa-w-14 text-success" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7.9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z"></path></svg>
                    </a>
                </div>            
            @endif
        
            <div class="row">
                <div class="col-md-12">
                    @if (config('app.url').'/nobanner.png' !== $comercio->banner_url )
                        <img style="width:100%; height: 150px; 
                        @if(auth()->user())
                            margin-top: 60px;
                        @endif
                        " src="{{ $comercio->banner_url}}" alt="">
                    @else
                        <img style="width:100%; height: 150px; 
                        @if(auth()->user())
                            margin-top: 60px;
                        @endif
                        " src="/img/panexpres_banner.png" alt="">
                    @endif
                </div>
            </div>
            <div class="card mx-auto my-3 shadow" style="width: 80%" >
                <div class="row mb-2">
                    <div class="col-sm-6">
                        
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/">Inicio</a></li>
                            <li class="breadcrumb-item active">{{ $comercio->name }}</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
                <div class="row mb-2">
                    <div class="col-md-4">
                        <div style="width:100%; height: 80%;">
                            <img class="img-responsive" src="{{ $product->image1_url }}" alt="">
                        </div>
                        
                    </div><!-- /.col -->
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-12">
                                {{ $product->name}}
                            </div>
                        </div>
                        <div class="row d-flex justify-content-between">
                            <div class="col-md-12">
                                <div>Ver mas productos de<span class="mx-1"><a href="">{{ $product->comercio->name}}</a></span></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <span>{{ $currencyValue }} {{ $product->getPrice1() }}</span>
                            </div>
                        </div>
                        <div class="row">
                            <form class="col-md-12 d-flex justify-content-between" action="/add" method="post">
                                @csrf
                                <input name="product_id" type="hidden" value="{{ $product->id }}">
                                <input name="name" type="hidden" value="{{ $product->name }}">
                                <input name="price1" type="hidden" value="{{ $product->price1 }}">
                                <div class="col-md-6">
                                    <div class="input-group input-number-group" style="margin-left: 0px !important; padding:0 !important;">
                                        <div class="input-group-button">
                                            <span class="input-number-decrement">-</span>
                                        </div>
                                        <input name="quantity" class="input-number" type="number" value="1" min="0" max="1000">
                                        <div class="input-group-button">
                                            <span class="input-number-increment">+</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 d-flex justify-content-start">
                                    <button class="btn btn-sale"><i class="text-white fa fa-shopping-cart" aria-hidden="true"></i> Comprar</button>
                                </div>
                                <div class="col-md-3 d-none">
                                    <button class="btn h-75  border border-secondary"><i class="fa fa-solid fa-heart"></i></button>                        
                                </div>
                            </form>
                        </div>
                        <!-- <div class="row">
                            <span>Disponibilidad: </span><span class="mx-1">{{ $product->stock }}</span>
                        </div> -->
                        <div class="row d-flex justify-content-start">
                            @if($product->in_envio_nacional)
                            <div style="width: auto;"><img style="width:60px" src="/img/envio_auto.png" alt=""><span>Envío nacional</span></div>
                            @endif
                            @if($product->in_delivery)
                            <div style="width: auto;"><img style="width:60px" src="/img/envio_moto.png" alt=""><span>Delivery</span></div>
                            @endif
                            @if($product->in_pickup)
                            <div style="width: auto;"><img style="width:60px" src="/img/envio_pickup.png" alt=""><span>Pickup</span></div>
                            @endif
                        </div>
                        <div class="row">
                            <div class="accordion" id="accordionExample">
                                <div class="accordion-item">
                                    <h4 class="accordion-header" id="headingOne">
                                        <a class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            Información del producto
                                        </a>
                                    </h4>
                                    <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            {{$product->description}}
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h4 class="accordion-header" id="headingTwo">
                                        <a class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                            Especificaciones del producto
                                        </a>
                                    </h4>
                                    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <strong>Peso: </strong>{{ $product->tx_peso }}
                                            <br>
                                            <strong>Tamaño: </strong>{{ $product->tx_tamanio }}
                                            <br>
                                            <strong>Pedido: </strong>{{ $product->getPedido() }}
                                            <br>
                                            <strong>Envio Gratis: </strong>{{ $product->getEnvioGratis() }}
                                            <br>
                                            <strong>Frágil: </strong>{{ $product->getFragil() }}
                                            <br>
                                            <strong>Oferta: </strong>{{ $product->getOferta() }}
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h4 class="accordion-header" id="headingThree">
                                        <a class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                            Información de tienda
                                        </a>
                                    </h4>
                                    <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <p>Dirección: {{$product->comercio->address}}</p>
                                            <p>
                                                <a href="https://api.whatsapp.com/send?phone=+58{{$comercio->contactcellphone}}&text={{ $comercio->msgcontact}}" target="_blank">{{$product->comercio->cellphonecontact}}</a> 
                                                {{$product->comercio->phonecontact}}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- /.col -->
                </div><!-- /.row -->

            </div>
        
            <div class="row my-2">
                <div class="col-md-12">
                    @livewire('components.show-recommended', [
                            'comercioId' => 1, 
                            'parametro' => $words='',
                            'manufacturer_id' => $manufacturer_id='',
                            'modelo_id' => $modelo_id='',
                            'motor_id' => $motor_id='',
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
    @if(auth()->user())
        <script src="/js/bootstrap.bundle.min.js"></script>

        @stack('js')
        @stack('before-livewire-scripts')
        <livewire:scripts />
        @stack('after-livewire-scripts')

        @stack('alpine-plugins')
        <!-- Alpine Core -->
        <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

        <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" /> -->
    @endif


    </div>
    