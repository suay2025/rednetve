<div>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Menu Lateral</title>
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous" /> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css" />
    
    <link rel="stylesheet" href="/css/navbar.css">
    

  </head>
  <style>
    
    .img-logo {
        width: 250px!important;
    }
    nav,
    .offcanvas {
      background-color: #fff;
    }
    .nav-link:hover{
        background-color: #fff;
    }
    .navbar-toggler {
      border: none;
    }    
    
    .offcanvas {
        display: none !important;
        overflow: auto;
    }

    .menuNormal {
        display: block!important;
    }

    .menuCategories {
        display: block!important;
    }

    .footer {
        display: block!important;
    }
    
    @media (max-width: 768px) {
        .offcanvas {
            display: block!important;
        }
        .menuNormal {
            display: none!important;
        }
        .menuCategories {
            display: none!important;
        }
      .navbar-nav > li:hover {
        background-color: #fff;
      }
    }

    @media (max-width: 990px) {
        .offcanvas {
            display: block!important;
        }
        .menuNormal {
            display: none!important;
        }
        .menuCategories {
            display: none!important;
        }
      .navbar-nav > li:hover {
        background-color: #fff;
      }
    }
  </style>
  <body>
    <!-- MENU START  -->
    <nav class="navbar navbar-expand-lg navbar-light">
      <!-- NAV CONTAINER START -->
      <div class="container-fluid">
        <a href="/" class="navbar-brand text-info fw-semibold fs-4">
            <img class="img-logo" src="/img/logo_repuestos.png" alt=""> 
        </a>

        <!-- NAV BUTTON  -->
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#menuLateral">
          <span class="navbar-toggler-icon"></span>
        </button>
        <!-- OFFCANVAS MAIN CONTAINER START -->
        <section class="offcanvas offcanvas-start" id="menuLateral" tabindex="-1">
          <div class="offcanvas-header" data-bs-theme="dark">
            <h5 class="offcanvas-title text-info">REPUESTO EXPRES</h5>
            <button class="btn-close" type="button" aria-label="Close" data-bs-dismiss="offcanvas" ></button>
          </div>
          <!-- OFF CANVAS MENU LINKS  START-->
          <div class="offcanvas-body d-flex flex-column justify-content-between px-0 " >
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            @auth
                <li class="nav-item p-3 py-md-1">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown">
                            <a class="nav-link active dropdown-toggle titulo" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <span class="ml-1" x-ref="username">{{ auth()->user()->name }}</span>
                            </a>
                            <div class="dropdown-menu p-4" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('admin.profile.edit') }}" x-ref="profileLink">Perfil</a>
                                <a class="dropdown-item" href="{{ route('admin.dashboard') }}" x-ref="profileLink">Escritorio</a>
                                <a class="dropdown-item" href="{{ route('admin.profile.edit') }}" x-ref="changePasswordLink">Cambiar Contraseña</a>
                                <a class="dropdown-item" href="{{ route('admin.settings') }}">Configuración</a>
                                <div class="dropdown-divider"></div>
                                <form method="POST" action="{{ route('logout') }}">
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">Salir</a>
                                </form>
                            </div>
                        </li>
                    </ul>
                </li>
            @endauth
                
            @guest
                <li class="nav-item p-3 py-md-1">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown" style="position: relative!important; z-index: 9001!important;">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img src="/img/icon_miperfil.png" id="profileImage" class="img-circle elevation-1" alt="User Image" style="height: 30px; width: 30px;">
                                <span class="ml-1" x-ref="username">Perfil</span>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown" >
                                <div class="d-flex justify-content-between mb-2 ml-3">
                                    <img class="" src="/img/icon_soporte.png" style="width: 18px; height: 25px;">
                                    <a class="dropdown-item" href="#">Soporte en Línea</a>
                                </div>

                                <div class="d-flex justify-content-between mb-2 ml-3">
                                    <img src="/img/icon_registrarse.png" style="width: 18px; height: 25px;">                                        
                                    <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#registerModal" style="cursor: pointer;">Registrarse</a>
                                </div>

                                <div class="d-flex justify-content-between mb-2 ml-3">
                                    <img src="/img/icon_entrar.png" style="width: 18px; height: 25px;">
                                    <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#loginModal" style="cursor: pointer;">Entrar</a>
                                </div>
                            </div>
                        </li>
                    </ul>
                </li>  
            @endguest
                <li class="nav-item">
                    <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-table"></i>
                    <p>
                        Menú de Usuario
                        <i class="fas fa-angle-left right"></i>
                    </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="" class="nav-link">
                            <i class="nav-icon fas fa-comments"></i>
                            <p>Menú 1</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Menú 2</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Menú 3</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-table"></i>
                    <p>
                        Categorías
                        <i class="fas fa-angle-left right"></i>
                    </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @foreach($categories as $category)
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>
                                {{ $category->name }}
                                @if( $category->subcategories->count() > 0 )
                                <i class="fas fa-angle-left right"></i>
                                @endif
                            </p>
                            </a>
                            @if( $category->subcategories->count() > 0 )
                            <ul class="nav nav-treeview">
                                @foreach( $category->subcategories as $subcategory )
                                <li class="nav-item">
                                    <a class="nav-link" style="cursor:pointer;" data-subcategory="{{$subcategory->name}}" href="{{ route('cat', [
                                        'categ' => $subcategory->name,
                                        'manufacturer_id' => $state['manufacturer_id'],
                                        'modelo_id' => $state['modelo_id'],
                                        'motor_id' => $state['motor_id'],
                                            ]) }}">
                                        <i class="nav-icon fas fa-comments"></i>
                                        {{$subcategory->name}}
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                            @endif
                        </li>
                        @endforeach
                    </ul>
                </li>
            </ul>
            <!-- enlaces redes sociales -->

            <div class="d-lg-none align-self-center py-3">
              <a href=""><i class="bi bi-twitter px-2 text-info fs-2"></i></a>
              <a href=""><i class="bi bi-facebook px-2 text-info fs-2"></i></a>
              <a href=""><i class="bi bi-github px-2 text-info fs-2"></i></a>
              <a href=""><i class="bi bi-whatsapp px-2 text-info fs-2"></i></a>
            </div>
          </div>
        </section>
        <!-- OFFCANVAS MAIN CONTAINER END  -->
        <div class="row w-100">
            <div class="col-xl-12">
        
                <!-- CONTAINER MENU PRINCIPAL y ACCESO -->
                <div class="row">
                    <div class="col-xl-12 col-md-12">
                        <section class="row menuNormal w-75" id="menuNormal" tabindex="-1">
                        <!-- OFF CANVAS MENU LINKS  START-->
                            <div class="d-flex flex-row justify-content-between px-0 " >
                                <ul class="w-75 navbar-nav fs-5 justify-content-start">
                                    <li class="nav-item p-3 py-md-1">
                                        <form action="{{ route('search') }}" method="GET" class="d-flex" wire:ignore>
                                            <input wire:model.defer="state.manufacturer_id" type="hidden" id ="manufacturerS_id" name = "manufacturerS_id">
                                            <input wire:model.defer="state.modelo_id" type="hidden" id ="modeloS_id" name = "modeloS_id">
                                            <input wire:model.defer="state.motor_id" type="hidden" id ="motorS_id" name = "motorS_id">
                                            <input id="words" name="words" style="width: 350px;" class="form-control me-4 input-search" type="search" placeholder="Buscar" aria-label="Search">
                                            <button id="btn-search" class="btn btn-outline-success input-form" type="submit">Buscar</button>
                                        </form>
                                    </li>
                                </ul>
                                <ul class="navbar-nav fs-5 justify-content-between">
                                    <li class="nav-item p-3 py-md-1">
                                        <a href="" class="nav-link">PROJECTS</a>
                                    </li>
                                    <li class="nav-item p-3 py-md-1">
                                        <a href="" class="nav-link">ABOUT</a>
                                    </li>
                                @auth
                                    <li class="nav-item p-3 py-md-1">
                                        <ul class="navbar-nav ml-auto">
                                            <li class="nav-item dropdown">
                                                <a class="nav-link active dropdown-toggle titulo" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <span class="ml-1" x-ref="username">{{ auth()->user()->name }}</span>
                                                </a>
                                                <div class="dropdown-menu p-4" aria-labelledby="navbarDropdown">
                                                    <a class="dropdown-item" href="{{ route('admin.profile.edit') }}" x-ref="profileLink">Perfil</a>
                                                    <a class="dropdown-item" href="{{ route('admin.dashboard') }}" x-ref="profileLink">Escritorio</a>
                                                    <a class="dropdown-item" href="{{ route('admin.profile.edit') }}" x-ref="changePasswordLink">Cambiar Contraseña</a>
                                                    <a class="dropdown-item" href="{{ route('admin.settings') }}">Configuración</a>
                                                    <div class="dropdown-divider"></div>
                                                    <form method="POST" action="{{ route('logout') }}">
                                                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">Salir</a>
                                                    </form>
                                                </div>
                                            </li>
                                        </ul>
                                    </li>
                                @endauth
                                    
                                @guest
                                    <li class="nav-item p-3 py-md-1">
                                        <ul class="navbar-nav ml-auto">
                                            <li class="nav-item dropdown" style="position: relative!important; z-index: 9001!important;">
                                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <img src="/img/icon_miperfil.png" id="profileImage" class="img-circle elevation-1" alt="User Image" style="height: 30px; width: 30px;">
                                                    <span class="ml-1" x-ref="username">Perfil</span>
                                                </a>
                                                <div class="dropdown-menu" aria-labelledby="navbarDropdown" >
                                                    <div class="d-flex justify-content-between mb-2 ml-3">
                                                        <img class="" src="/img/icon_soporte.png" style="width: 18px; height: 25px;">
                                                        <a class="dropdown-item" href="#">Soporte en Línea</a>
                                                    </div>

                                                    <div class="d-flex justify-content-between mb-2 ml-3">
                                                        <img src="/img/icon_registrarse.png" style="width: 18px; height: 25px;">                                        
                                                        <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#registerModal" style="cursor: pointer;">Registrarse</a>
                                                    </div>

                                                    <div class="d-flex justify-content-between mb-2 ml-3">
                                                        <img src="/img/icon_entrar.png" style="width: 18px; height: 25px;">
                                                        <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#loginModal" style="cursor: pointer;">Entrar</a>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </li> 
                                @endguest
                                    
                                    <li class="nav-item p-3 py-md-1">
                                        <div class="row">
                                            <div class="col-md-12 mx-2">
                                                <div class="dropdown-cart-drop">
                                                    <a class="btn-cart-drop d-flex justify-content-between">
                                                        <img src="/img/icon_carrito.png" style="width: 32px; height: 32px; cursor:pointer;">
                                                        <span class="text-dark">({{\Cart::getTotalQuantity()}})</span>
                                                    </a>
                                                    <div class="dropdown-content-cart-drop">
                                                        <div>
                                                            @include('livewire.carrito.cart-drop')
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </section>
                    </div>
                </div>        

                <!-- CONTAINER MENU CATEGORIA y MONEDA -->
                <div class="row">
                    <div class="col-xl-12">
                        <section class="row menuCategories w-100" id="menuCategories" tabindex="-1">
                        <!-- OFF CANVAS MENU LINKS  START-->
                        <div class="d-flex flex-row justify-content-between px-0 " >
                            <ul class="w-60 nav nav-pills nav-fill d-flex">
                                
                                <?php $x = -1; ?>

                                @foreach($categories as $category)
                                    <li class="nav-item dropdown">
                                        
                                        <a class="dropdown-toggle" href="#" id="navbarDropdown1" role="button" data-bs-toggle="dropdown" aria-expanded="false">                                            
                                                {{$category->name}}                                            
                                        </a>
                                        @if($category->subcategories->count() > 0)
                                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                            @foreach($category->subcategories as $subcategory)
                                                <?php $x += 1; ?>
                                                <li data-subcategory="{{$subcategory->name}}">
                                                    <a class="dropdown-item subcategory{{$x}}" style="cursor:pointer;" data-subcategory="{{$subcategory->name}}" href="{{ route('cat', [
                                                        'categ' => $subcategory->name,
                                                        'manufacturer_id' => $state['manufacturer_id'],
                                                        'modelo_id' => $state['modelo_id'],
                                                        'motor_id' => $state['motor_id'],
                                                         ]) }}">
                                                        {{$subcategory->name}}
                                                    </a>
                                                </li>
                                                <script>
                                                    document.querySelector('.subcategory{{$x}}').addEventListener('click', function(){
                                                        console.log(this.dataset.subcategory)
                                                    })
                                                </script>
                                            @endforeach
                                        </ul>
                                        @endif

                                    </li>
                                @endforeach
                                
                                

                            </ul>
                            <script>
                                var valor2;
                                let currencyLink;
                            </script>
                            <!-- moneda currency  -->
                            <ul class="nav w-40 d-flex justify-content-between ms-auto" wire:ignore>
                                <li class="nav-item dropdown">
                                    <span>Moneda: </span>
                                    <div class="currency mx-1">
                                        <select class="form-control" wire:change="changeCurrency($event.target.value)">
                                            <option value="Bs" {{ ($currencyValue === 'Bs') ? 'selected' : '' }}>Bs</option>
                                            <option value="$" {{ ($currencyValue === '$') ? 'selected' : '' }}>$</option>
                                            <option value="€" {{ ($currencyValue === '€') ? 'selected' : '' }}>€</option>
                                        </select>
                                    </div>
                                    
                                </li>
                                <li class="nav-item dropdown ms-auto"><span class="nav-link">$: {{$tasacambio}} Bs.</span></li>
                                <!-- <script>
                                    let selectCurrency = document.querySelector('.selectCurrency')
                                    selectCurrency.addEventListener('change', function(e){
                                        Livewire.emit('changeCurrency', e.target.value)
                                    })
                                </script> -->
                                
                            </ul>                            
                        </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
      </div>
    </nav>

    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script> -->

    <script>
    
        window.addEventListener('refreshPage', event => {
            
            let message = event.detail.message

            //location.reload()
        
        }) 
    </script>
    
  </body>
</html>

    <script>
        let serverInput     = document.getElementById('words');
        let saveButton      = document.getElementById('btn-search');

        saveButton.addEventListener('click', () =>
        {
            localStorage.setItem('serverValue', serverInput.value);

            // localStorage.setItem('serverManufacturer', '');

            // localStorage.setItem('serverModelo', '');

            // localStorage.setItem('serverModelo', '');
        });

        window.addEventListener('DOMContentLoaded', () =>
        {
            let savedServer  = localStorage.getItem('serverValue');

            if (savedServer)
            {
                serverInput.value = savedServer;
            }
        });

        let manufacturerS = document.getElementById('manufacturerS_id');
        let modeloS = document.getElementById('modeloS_id');
        let motorS = document.getElementById('motorS_id');

        window.addEventListener('DOMContentLoaded', () =>
        {
            let savedServer  = localStorage.getItem('serverManufacturer');

            if (savedServer)
            {
                manufacturerS.value = savedServer;
                modeloS.value = localStorage.getItem('serverModelo');
                motorS.value = localStorage.getItem('serverMotor');;
            }
        });

    </script>

</div>