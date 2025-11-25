<div>
    <style>
        /* .slider{
            width: 90%!important;
        } */
        /* * {
         box-sizing: border-box;
        } */

        .slider {
            /*width: 50%;*/
            width: 100%;
            margin: 10px auto!important; */        
            /* height: 300px; */
        }

        .slick-slide {
        margin: 0px 10px; 
        }

        .slick-slide {
        margin: 0px 20px; 
        }

        .slick-slide img {
        width: 20%;
        height: 200px;
        }

        .slick-prev:before,
        .slick-next:before {
        color: black;
        }

        .slick-next.slick-arrow {
            border: 1px solid black;
            border-radius: 50px;
            width: 35px;
            height: 35px;
            display: block;
            /* background-image: url('/img/circle-right-regular.svg'); */
            z-index: 2;
        }

        .slick-prev.slick-arrow {
            border: 1px solid black;
            border-radius: 50px;
            width: 35px;
            height: 35px;
            display: block;
            /* background-image: url('/img/circle-left-regular.svg'); */
            z-index: 2;
        }

        .slick-slide {
        transition: all ease-in-out .3s;
        /* opacity: .2; */
        }
        
        /* .slick-active {
        opacity: .5;
        }

        .slick-current {
        opacity: 1;
        } */
        
    </style>
<div class="container-fluid carouselOffer">
    <div class="row negrita">
        <div class="col-12">
            <img class="mx-3" width="45px" src="/img/icon-sales.png" alt=""><span class="h3 text-dark">Ofertas</span>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <span class="h4 text-white mx-4">Mira y aprovecha estos descuentos</span>  
        </div>
    </div>   
    <div class="row">
        <div class="col-md-12">
            <section class="regular slider slider-products" @if($renderizar) wire:ignore @endif wire:ignore.self>
                @forelse ($offers as $index => $product)
                    <div>
                        <form action="/add" method="post">
                            @csrf
                            <input name="product_id" type="hidden" value="{{ $product->id }}">
                            <input name="name" type="hidden" value="{{ $product->name }}">
                            <input name="price1" type="hidden" value="{{ $product->price1 }}">
                            <input name="quantity" type="hidden" value="1">
                            <div class="card showProductCard mx-auto text-center mx-2">
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
                                    <span class="">Tienda: Auto Repuestos Fred</span>
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

    <script>
        function loadSlider(){
            $(".slider-products-offers").slick({
            dots: true,
            infinite: true,
            slidesToShow: findSlides(),
            slidesToScroll: 3,
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
</div>