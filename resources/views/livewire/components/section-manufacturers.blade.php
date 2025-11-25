<div>
    <script src="/js/jquery-3.6.4.min.js"></script>
    <script src="/js/slick.min.js"></script>
    <link rel="stylesheet" href="/css/slick-theme.min.css">
    <link rel="stylesheet" href="/css/slick.min.css">
    <link rel="stylesheet" href="/css/carouselOffer.css">
    <style>
        /* .slider{
            width: 90%!important;
        } */
        /* * {
         box-sizing: border-box;
        } */

        .sliderM {
            /*width: 50%;*/
            width: 100%;
            margin: auto!important;
            height: 150px; 
        }

        .slick-slide {
        margin: 0px 10px;
        }

        .slick-slide img {
        width: 100%;
        height: auto;
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

        .cardManufacturer {
            width: 150px;
            height: 150px;
        }
        
    </style>
    <div class="row">
        <div class="col-md-12">
            Seleccione el catalogo del fabricante 
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <section class="regular sliderM slider-manufacturer">
                @forelse ($manufacturers as $index => $manufacturer)
                    <div>
                        <div class="card cardManufacturer mx-auto text-center mx-2">
                            <div class="card-body">
                                <img class="mx-auto border border-1" src="{{$manufacturer->avatar_url}}" alt="">                                
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="card cardManufacturer mx-auto text-center">
                        <card-body>
                            <span>No tiene Catalogo para este producto</span>
                        </card-body>
                        <card-footer>                    
                        </card-footer>                    
                    </div>
                @endforelse
            </section>       
        </div>
    </div>

    <script>
        function loadSlider(){
            $(".slider-manufacturer").slick({
            dots: true,
            infinite: true,
            slidesToShow: findSlides(),
            slidesToScroll: 5,
            autoplay: false,
            });
        }
        
        loadSlider()

        function findSlides()
        {
            var ancho = window.innerWidth;
            var alto = window.innerHeight;

            if (window.innerWidth < 1024) 
                return 2
            else 
            if (window.innerWidth < 1280) 
                return 3
            else 
                return 5
        }

        window.addEventListener('resize', () => {
            //location.reload()
        })
    </script>
</div>