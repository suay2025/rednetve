<div>
    <script src="/js/jquery-3.6.4.min.js"></script>
    <script src="/js/slick.min.js"></script>
    <link rel="stylesheet" href="/css/slick-theme.min.css">
    <link rel="stylesheet" href="/css/slick.min.css">
    <link rel="stylesheet" href="/css/showProducts.css">
    <style>
        /* .slider{
            width: 90%!important;
        } */
        /* * {
         box-sizing: border-box;
        } */

        .slider {
            /*width: 50%;*/
            width: 90%;
            margin: 10px auto!important; */        
            /* height: 300px; */
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
            z-index: 1000;
        }

        .slick-prev.slick-arrow {
            border: 1px solid black;
            border-radius: 50px;
            width: 35px;
            height: 35px;
            display: block;
            /* background-image: url('/img/circle-left-regular.svg'); */
            z-index: 1000;
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
<div class="container-fluid showProductsP">
    <div class="row negrita">
        <div class="col-12">
            <span class="h3 text-dark"></span>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <span class="h4">Lo Mas Destacados</span>  
        </div>
    </div>    
    <div class="row">
        <div class="col-md-12">
            <section class="regular slider slider-products">
                @forelse ($products as $index => $product)
                    <div>
                        <div class="card showProductCard mx-auto text-center mx-2">
                            <div class="card-body">
                                <div class="row">
                                    <div class="">
                                        <img class="mx-auto" src="{{$product->image1_url}}" alt="">
                                    </div>
                                </div>
                                <div class="row text-left">
                                    <div class="negrita">{{$product->name}}</div>
                                        @if($product->on_offer)
                                            <div class="text-decoration-line-through">Precio: {{$currencyValue}}. {{ $product->getPrice1() }}</div>
                                            <div class="">Promoción: {{$currencyValue}}. {{ $product->getPrice_offer() }}</div>
                                        @else
                                            <div class="">Precio: {{$currencyValue}}. {{ $product->getPrice1() }}</div>
                                        @endif
                                        <div style="display: flex; flex-direction: row;">
                                            <button class="btn btn-sale">Comprar ahora</button>
                                            <div>
                                                <ul class="text-center starRating">
                                                    <li class="star"><i class="fas fa-star"></i></li>
                                                    <li class="star"><i class="fas fa-star"></i></li>
                                                    <li class="star"><i class="fas fa-star"></i></li>
                                                    <li class="star"><i class="fas fa-star"></i></li>
                                                    <li class="star"><i class="fas fa-star"></i></li>
                                                </ul>
                                                <div class="rating text-center">Rated</div>
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
                    </div>
                @empty
                    <div class="card showProductCard mx-auto text-center">
                        <card-body>
                            <span>No tiene productos destacados</span>
                        </card-body>
                        <card-footer>                    
                        </card-footer>                    
                    </div>
                @endforelse
            </section>       
        </div>
    </div>
</div>

    <script>
        function loadSlider(){
            $(".slider-products").slick({
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
            location.reload()
        })
    </script>
</div>