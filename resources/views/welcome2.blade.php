<div>  
    
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> -->
<!doctype html>
<html lang="es">
  <head>
     <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <link rel="icon" type="image/svg+xml" href="/icon.png" />
    <title>{{ setting('site_title') }} | {{ setting('site_name') }}</title>

    <!-- Bootstrap CSS -->
	    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"> -->
        <link rel="stylesheet" href="/css/bootstrap.min.css">

        
	    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="/css/app.css">
    <link rel="stylesheet" href="/css/infiniteSlider.css">

    <script src="/js/jquery-3.6.4.min.js"></script>
    <script src="/js/slick.min.js"></script>
    <link rel="stylesheet" href="/css/slick-theme.min.css">
    <link rel="stylesheet" href="/css/slick.min.css">
    <link rel="stylesheet" href="/css/carouselOffer.css">
    <link rel="stylesheet" href="/css/showProducts.css">
    <link rel="stylesheet" href="/css/star.css">

    
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.rtl.min.css" integrity="sha384-WJUUqfoMmnfkBLne5uxXj+na/c7sesSJ32gI7GfCk4zO4GthUKhSEGyvQ839BC51" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <script src="https://kit.fontawesome.com/03cf5139f1.js"></script> -->

    <link rel="stylesheet" href="/css/style.css">
    
    <!-- <link rel="stylesheet" href="/css/modopago.css" class="rel"> -->
    <!-- <link rel="stylesheet" href="/cs/swiper-bundle.min.css"> -->
    
    <title>{{config('app.name')}}</title>
    <style>
      
    </style>
  </head>
  @if($in_cellphonecontact > 0)
  <div id="whatsapp">
    <a href="https://api.whatsapp.com/send?phone=04165800403&text=Hola%20,te%20asesoramos%20por
%20whatsapp%20gestiona%20tu%20compra%20por%20este%20canal." target="_blank">
        <svg aria-hidden="true" focusable="false" data-prefix="fab" data-icon="whatsapp" class="svg-inline--fa fa-whatsapp fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7.9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z"></path></svg>
    </a>
  </div>
  @endif

  <body class="container-fluid">
   <!--ENCABEZADO--> 
   
    @livewire('layouts.navbar', [
                        'comercioId' => 1,
                        'manufacturer_id' => $manufacturer_id,
                        'modelo_id' => $modelo_id,
                        'motor_id' => $motor_id,
                        ])
    
    @if($in_sliderprincipal > 0)
        @include('livewire.components.slider-principal')
    @endif

    @if($in_marcasproductos > 0)
        @livewire('components.marcas-productos')
    @endif
    <div class="my-2"></div>    
    <section class="">
        <div class="my-2"></div>
        
        @if($words == '')
            
            <div class="row">
                <div class="col-xl-6 col-md-6 col-sm-6">
                    @livewire('components.component-search', [
                        'comercioId' => 1,
                        'manufacturer_id' => $manufacturer_id,
                        'modelo_id' => $modelo_id,
                        'motor_id' => $motor_id,
                        ])
                </div>
                <div class="col-xl-6 col-md-6 col-sm-6">
                    @livewire('components.carousel-offer')
                </div>
            </div>
        
            <div class="my-2"></div>
            @livewire('components.show-products')
        @endif
        @if($words != '' )
            @livewire('components.results-products', [
                'comercioId' => 1, 
                'parametro' => $words,
                'manufacturer_id' => $manufacturer_id,
                'modelo_id' => $modelo_id,
                'motor_id' => $motor_id,
                ] )
        @endif
        <div class="my-5"></div>
    </section>
    @livewire('components.navigation-map', ['comercio_id' => $comercio_id])

    @livewire('layouts.footer')
    
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script> -->
    
    
  </body>
</html>

<!-- Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
  <div class="modal-dialog">
    <div class="modal-content modalFondo">
      <div class="modal-header" style="background-color: #f8f8f8;">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <section class="banner">
            <div class="row">
                <div class="col-lg-12 d-flex">
                    <img class="img_logo mx-auto" src="./img/logo_repuestos.png" alt="">
                </div>
            </div>
        </section>
        <div class="container-fluid d-flex flex-row">
            <div class="card  mx-auto" style="width: 32rem;">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12 titulo c-a text-center h2 pt-3">Ingresa a tu RepuestoExpress</div>
                        <p class="text-center textoreg">¿Todavía no te has registrado? <span><a href="#" class="c-n">Crea tu cuenta Aquí</a></span></p>
                    </div>
            
                    <form action="{{ route('login') }}" method="POST">
                        @csrf
                      <div class="form-group">
                        <div class="row mx-auto">
                            <div class="col-xs-6 col-md-4 col-sm-4 col-4">
                                <label for="tipodocumento">Tipo </label>
                                <select class="form-control inputForm inputType" name="" id="identificationNacW" placeholder="Tipo">
                                    <option value="J">J-</option>
                                    <option value="E">E-</option>
                                    <option value="G">G-</option>
                                    <option value="P">P-</option>
                                    <option value="V" selected>V-</option>
                                </select>
                            </div>
                            <div class="col-xs-6 col-md-8 col=sm-8 col-8">
                                <label for="documento">Documento</label>
                                <input type="text" id="identificationNumberW" class="form-control inputForm" placeholder="Documento">
                            </div>
                        </div>
                        
                    </div>
            
                        <div class="form-group">
                            <div class="row mx-auto" >
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <label for="email">Correo Electrónico</label>
                                    <input type="email" name="email" class="form-control inputForm" placeholder="Correo Electrónico" id="emailW">
                                </div>
                            </div>
                            @error('email')
                              <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
            
                        <div class="form-group">
                            <div class="row mx-auto">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <label for="password">Contraseña</label>
                                    <input type="password" name="password" id="password-fieldW" class="form-control inputForm" placeholder="Contraseña" value="12345678"/>
                                </div>
                            </div>                
                        </div>
                        
                        <div class="form-group">
                            <div class="row mx-auto my-3">
                                <div class="col-xs-12 col-sm-12 col-md-12 d-flex">
                                    <button type="submit" class="btn btn-app w-100 mx-auto">Iniciar Sesión</button>
                                </div>
                            </div>                
                        </div>
                        <p class="text-center c-a texto"><a href="#">¿Olvidé mi contraseña?</a></p>
                        
                    </form>
                </div>
            </div>

        </div>        
      </div>

      <div class="modal-footer" style="background-color: #eb6c0e;">
        Contactar a soporte si no puedes iniciar sesión
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
  <div class="modal-dialog">
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
                <div class="card-body">
                  <div class="row">
                      <div class="col-lg-12 titulo c-a text-center h2 pt-3">Registrate a RepuestoExpres</div>
                      <p class="texto text-center">¿Ya tienes una cuenta? <span class="c-n">click Aquí</span></p>
                  </div>
        
                  <form action="{{ route('register') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <div class="row mx-auto">
                            <div class="col-xs-6 col-md-4 col-sm-4 col-4">
                                <label for="tipodocumento">Tipo </label>
                                <select class="form-control inputForm inputType" name="" id="identificationNacR" placeholder="Tipo">
                                    <option value="J">J-</option>
                                    <option value="E">E-</option>
                                    <option value="G">G-</option>
                                    <option value="P">P-</option>
                                    <option value="V" selected>V-</option>
                                </select>
                            </div>
                            <div class="col-xs-6 col-md-8 col=sm-8 col-8">
                                <label for="documento">Documento</label>
                                <input type="text" id="identificationNumberR" class="form-control inputForm" placeholder="Documento">
                            </div>
                        </div>
                        
                    </div>
                    <input type="hidden" name="role" value="afiliado">
                    <div class="form-group my-3">
                        <div class="row mx-auto">
                            <div class="col-xs-12 col-md-12 col-sm-12 col-12">
                                <input type="text" name="name" class="form-control inputForm" placeholder="Usuario">
                            </div>
                        </div>
                    </div>
            
                    <div class="form-group my-3">
                        <div class="row mx-auto">
                            <div class="col-xs-12 col-md-12 col-sm-12 col-12">
                                <input type="email" name="email" class="form-control inputForm" placeholder="Email">
                            </div>
                        </div>
                    </div>
                    <div class="form-group my-3">
                        <div class="row mx-auto">
                            <div class="col-xs-12 col-md-12 col-sm-12 col-12">
                                <input type="password" name="password" class="form-control inputForm" placeholder="Contraseña" value="12345678">                    
                            </div>
                        </div>
                    </div>
            
                    <div class="form-group my-3">
                        <div class="row mx-auto">
                            <div class="col-xs-12 col-md-12 col-sm-12 col-12">
                                <input type="password" name="password_confirmation" class="form-control inputForm" placeholder="Confirme la Contraseña" value="12345678">                        
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="documento">Teléfono </label>        
                        <div class="row mx-auto">
                            <div class="col-xs-6 col-md-5 col-sm-4 col-4">
                                <select class="form-control" name="cellphonecode" id="cellphonecode">
                                    <option value="0">Seleccione</option>
                                    <option value="0412">0412</option>
                                    <option value="0414">0414</option>
                                    <option value="0424">0424</option>
                                    <option value="0416">0416</option>
                                    <option value="0426">0426</option>
                                </select>
                            </div>
                            <div class="col-xs-6 col-md-7 col-sm-8 col-8">
                                <input type="text" class="form-control" name="cellphone" id="cellphone">
                            </div>
                        </div>                
                    </div>
                    
                    <div class="form-group d-flex">
                                <button type="submit" class="btn btn-app w-100 mx-auto">Unete Ya</button>
                        
                    </div>
                    <p class="text-center c-a texto"><a href="#">¿Olvidé mi contraseña?</a></p>
                    
                  </form>
                </div>
            </div>

        </div>        
      </div>

      <div class="modal-footer" style="background-color: #eb6c0e;">
        Contactar a soporte si no puedes iniciar sesión
      </div>
    </div>
  </div>
</div>

</div>


<script src="/js/app.js"></script>
<script src="/js/backend.js"></script>
@stack('js')
@stack('before-livewire-scripts')
<livewire:scripts />
@stack('after-livewire-scripts')

@stack('alpine-plugins')
<!-- Alpine Core -->
<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" /> -->

<script src="/js/bootstrap.bundle.min.js"></script>

<script src="/js/jquery-3.6.4.min.js"></script>

        