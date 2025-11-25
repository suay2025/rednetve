<div>
    
    <div class="row">
        <div class="col-md-12">
            Seleccione el catalogo 
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <section class="regular sliderC slider-catalogo">
                @forelse ($catalogos as $index => $product)
                    <div>
                        <div class="card cardCatalogo mx-auto text-center mx-2">
                            <div class="card-body">
                                <img class="mx-auto border border-1" src="{{$product->image1_url}}" alt="">                                
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="card cardCatalogo mx-auto text-center">
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
            $(".slider-catalogo").slick({
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