<div class="container-fluid">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        .img1Promocion {
            width: 100%;
            height: 97.5%;
        }
        .img2Promocion {
            width: 100%;
            height: 95%;
            margin-bottom: 5px;
        }
        .cuadro1Promocion{
            width: 100%;
            height: 400px;
        }
        .cuadro2Promocion{
            width: 100%;
            height: 200px;
        }

        .col-md-12 {
            padding: 0 !important;
        }

        @media screen and (max-width: 768px) {
            .img1Promocion {
                width: 100% !important;
                height: 145px !important;
            }
            
            .cuadro1Promocion{
                display: flex;
                width: 100% !important;
                height: 145px !important;
                margin-bottom: 5px !important;
                padding: 0 !important;
                
            }
            .carousel {
                width: 95% !important;
                padding: 0 !important;
                margin: auto;
                margin-left: 21px !important;
            }
            .img2Promocion {
                width: 105% !important;
                height: 105px !important;
                padding: 0 !important;
                height: 100%;
                margin: auto !important;
            }
            .cuadro2Promocion{
                display: flex;
                width: 100% !important;
                height: 105px !important;
                margin-bottom: 5px !important;
                padding: 0 !important;
            }
            .subcuadro2Promocion {
                width: 90% !important;
                padding: 0 !important;
                margin: auto;
            }

        }
    </style>
    <div class=""></div>
    <div class="row">
        <div class="col-md-7 col-sm-7">
            <div class="cuadro1Promocion" style="">
                <div id="carouselExampleControls" class="carousel slide " data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <a href="/viewdetails/{{ $promocionFirst->comercio_id }}/{{ $promocionFirst->product_id }}"><img class="img1Promocion" src="{{ $promocionFirst->avatar_url }}" alt="0  slide"></a>
                        </div>
                        @foreach($promociones as $clave => $promocion)
                        <div class="carousel-item">
                            <a href="/viewdetails/{{ $promocion->comercio_id }}/{{ $promocion->product_id }}"><img class="img1Promocion" src="{{ $promocion->avatar_url }}" alt="{{$clave}} slide"></a>
                        </div>
                        @endforeach
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previo</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Proximo</span>
                    </a>
                </div>
                
            </div>
        </div>
        <div class="col-md-5 col-sm-5">            
            <div>
                    <div class="cuadro2Promocion">
                        <div class="subcuadro2Promocion">
                            <a href="/viewdetails/2/1"><img class="img2Promocion" src="/img/promociones/panaderia_expreso_derecha1_compressed.jpg" alt=""></a>
                        </div>
                    </div>
                
            
                    <div class="cuadro2Promocion">
                        <div class="subcuadro2Promocion">
                            <a href="viewdetails/2/2"><img class="img2Promocion" src="/img/promociones/panaderia_expreso_derecha2_compressed.jpg" alt=""></a>
                        </div>
                    </div>
            </div>
            
        </div>
    </div>
</div>
