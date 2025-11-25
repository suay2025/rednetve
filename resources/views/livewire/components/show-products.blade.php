<div>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <link rel="icon" type="image/svg+xml" href="/icon.png" />
    <title>{{ setting('site_title') }} | {{ setting('site_name') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/style-welcome.css">
    <link rel="stylesheet" href="/css/navigationMap.css">
    <!-- <link rel="stylesheet" href="/css/style.css"> -->
    <!-- <link rel="stylesheet" href="/css/bootstrap.min.css"> -->
    <!-- <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <script src="/js/jquery-3.6.4.min.js"></script>  
    <script src="/js/slick.min.js"></script>
    @push('js')
    <script src="/js/slick.min.js"></script>
    @endpush
    <link rel="stylesheet" href="/css/slick-theme.min.css">
    <link rel="stylesheet" href="/css/slick.min.css">
    <link rel="stylesheet" href="/css/carouselOffer.css">
    <link rel="stylesheet" href="/css/showProducts.css">
    <link rel="stylesheet" href="/css/star.css">
    @stack('styles')
    <livewire:styles />
    
    <div class="container-fluid showProductsP">
        <div class="row negrita">
            <div class="col-12">
                <span class="h3 text-dark">Productos</span>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <span class="h4 text-white"></span>  
            </div>
        </div>    
        <div class="row" wire:ignore>
            <div class="col-md-12">
                <section class="regular slider slider-products" wire:key="w_price">
                    @forelse ($products as $index => $product)
                        <div>
                            <form action="/add" method="post">
                                @csrf
                                <input name="product_id" type="hidden" value="{{ $product->id }}">
                                <input name="name" type="hidden" value="{{ $product->name }}">
                                <input name="price1" type="hidden" value="{{ $product->price1 }}">
                                <input name="quantity" type="hidden" value="1">
                                <div class="card showProductCard mx-3 text-center mx-2">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="">
                                                <a href="/routedetails/{{ $product->comercio_id }}/{{ $product->id }}" ><img class="mx-auto" src="{{ $product->image1_url }}" alt=""></a>
                                            </div>
                                        </div>
                                        <div class="row text-left">
                                            <div class="negrita d-flex align-item-start">{{$product->name}}</div>
                                                @if($product->on_offer)
                                                    <div class="text-decoration-line-through d-flex align-item-start">Precio: {{$currencyValue}}. {{ $product->getPrice1() }}</div>
                                                    <div class="d-flex align-item-start">Promoción: {{$currencyValue}}. {{ $product->getPrice_offer() }}</div>
                                                @else
                                                    <div class="d-flex align-item-start">Precio: {{$currencyValue}}. {{ $product->getPrice1() }}</div>
                                                @endif
                                                <div style="display: flex; flex-direction: row;">
                                                    <div class="">
                                                    <!-- <button type="submit" class="btn btn-sale text-center">Comprar ahora</button> -->
                                                    <a wire:click.prevent="sendCard({{ $product->id }}, 1)" class="btn btn-sale text-center">Comprar ahora</a>
                                                    </div>
                                                    <br>                                                     
                                                    <div class="cardStar" product="{{$product->id}}" >
                                                        @for ($i = 1; $i <=5; $i++)
                                                            @if($product->valoracionProduct->ca_valoracion >= $i)
                                                                <span wire:click.prevent="valorar({{ $product->id }}, {{ $product->valoracionProduct->ca_valoracion }}, '{{ $product->valoracionProduct->class }}')" product="{{ $product->id }}" star = "{{ $i }}" class="star {{ $product->valoracionProduct->class }}">★</span>
                                                            @else
                                                                <span wire:click.prevent="valorar({{ $product->id }}, {{ $product->valoracionProduct->ca_valoracion }}, '{{ $product->valoracionProduct->class }}')" product="{{ $product->id }}" star = "{{ $i }}" class="star">★</span>
                                                            @endif
                                                        @endfor
                                                        <h5 class="output" output="show{{ $product->id }}">
                                                            Puntuación: {{ $product->valoracionProduct->ca_valoracion }}/5
                                                        </h5>
                                                    </div>
                                                </div>
                                        </div>
                                        @if($product->in_envio_gratis)
                                        <div class="text-left" style="color: blue;">Envío Gratis</div>
                                        @endif
                                    </div>
                                    <div class="card-footer">
                                        <span class="d-flex align-item-start">{{$product->comercio->name}}</span>
                                    </div>
                                </div>
                            </form>
                        </div>
                    @empty
                        <div class="card showProductCard mx-auto text-center">
                            <div class="card-body">
                                <span>No tiene productos disponibles</span>
                            </div>
                            <div class= "card-footer">
                            </div>                    
                        </div>
                    @endforelse
                </section>       
            </div>
        </div>
    </div>

    <!-- Modal -->

    
    <!-- Modal -->
    <div class="modal fade" id="valoracionModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog">
            <form autocomplete="off" wire:submit.prevent="registrarValoracion">
                <div class="modal-content modalFondo">
                    <div class="modal-header" style="background-color: #f8f8f8;">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <section class="banner">
                            <div class="row">
                                <div class="col-lg-12">
                                    <img class="img_logo" src="./img/logo_repuestos.png" alt="">
                                </div>
                            </div>
                        </section>
                        <div class="container-fluid d-flex flex-row">
                            <div class="card  mx-auto" style="width: 32rem;">
                                <div class="modal-body">
                                    
                                    <div class="form-group my-2">
                                        @livewire('components.star', ['product_id' => $state['product_id'], 'ca_valoracion' => $state['ca_valoracion'], 'class' => $state['class']])
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="comment">Comentario</label>
                                        <textarea wire:model.defer="state.comment" autofocus class="form-control @error('comment') is-invalid @enderror" id="comment" rows = "5"></textarea>
                                        @error('comment')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                        </div>        
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close"> Cancelar</button>
                        <button type="submit" class="btn-app"><i class="fa fa-save mr-1"></i>
                            <span>Guardar Cambios</span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        function loadSlider(){
            $(".slider-products").slick({
            dots: true,
            infinite: true,
            slidesToShow: findSlides(),
            slidesToScroll: 1,
            autoplay: false,
            });
        }
        
        loadSlider()

        function findSlides()
        {
            var ancho = window.innerWidth;
            var alto = window.innerHeight;

            if (window.innerWidth < 1024) 
                return 1
            else 
            if (window.innerWidth < 1280) 
                return 2
            else 
                return 3
        }

        window.addEventListener('resize', () => {
            //location.reload()
        })
    </script>

    <script src="/js/star.js"></script>

    <script>
        window.onpageshow = function() {
            window.addEventListener('show-valoracionModal', function (event) {
                $('#valoracionModal').modal('show');
            });

            window.addEventListener('hide-valoracionModal', function (event) {
                $('#valoracionModal').modal('hide');
            });

            window.addEventListener('show-loginModalShow', function (event) {
                $('#loginModalShow').modal('show');
            });

            window.addEventListener('hide-loginModalShow', function (event) {
                $('#loginModalShow').modal('hide');
            });

            $('#valoracionModal').on('show.bs.modal', function(){
                
            });
        }
    </script>

</div>