<div wire:ignore>
    
<link rel="stylesheet" href="/css/navbar.css">
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="navbar-brand img-logo nav-link" data-widget="pushmenu" href="/" role="button"><i class="fas fa-bars"></i>
                    @guest
                        <img class="" src="/img/logo_respuestos.png" alt=""> 
                    @endauth
                </a>
            </li>
        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Right navbar top   -->
                <div class="row container-fluid">
                    <div class="col-xl-12">
                        <!-- search identification carrito  -->
                        <div class="row d-flex justify-content-between">
                            <div class="col-xl-6 border border-2">
                                <div class="row">
                                    <div class="col-xl-12">
                                    <form class="d-flex">
                                        <input class="form-control me-2 input-search" type="search" placeholder="Search" aria-label="Search">
                                        <!--       select category  -->
                                        <div class="selectCategory dropdown">
                                            <a class="nav-link dropdown-toggle d-flex justify-content-center align-items-center" href="#" id="navbarCategory" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                <div class="category mx-1"></div>
                                            </a>
                                            <ul class="dropdown-menu categoryList border-0 my-0" aria-labelledby="navbarCategory">
                                            </ul>
                                        </div>
                                        <!--       select category  -->
                                        <button class="btn btn-outline-success" type="submit">Search</button>
                                    </form>
                                    </div>
                                </div>
                            </div>
                            <div class="dropdown col-xl-3 border border-2 d-flex justify-content-center align-items-center">
                                @auth
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle color_1 text_menu fw-bold" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    @if(auth()->user()->avatar)
                                        <img src="{{ auth()->user()->avatar_url }}" id="profileImage" class="img-circle elevation-1" alt="User Image" style="height: 30px; width: 30px;">
                                    @else
                                        <img src="/img/icon_miperfil.png" id="profileImage" class="nav-img img-circle elevation-1" alt="User Image" style="">
                                    @endif
                                    {{ auth()->user()->name }}
                                    </a>
                                    <ul class="dropdown-menu">
                                        <a class="dropdown-item" href="{{ route('admin.profile.edit') }}" x-ref="profileLink">Perfil</a>
                                        <a class="dropdown-item" href="/admin/dashboard">Escritorio</a>
                                        <a class="dropdown-item" href="{{ route('admin.profile.edit') }}" x-ref="changePasswordLink">Cambiar Contraseña</a>
                                        <a class="dropdown-item" href="{{ route('admin.settings') }}">Configuración</a>
                                        <div class="dropdown-divider"></div>
                                        <form method="POST" action="{{ route('logout') }}">
                                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">Salir</a>
                                        </form>
                                        
                                    </ul>
                                    </li>
                                @else
                                <!--       select category  -->
                                <div><img class="nav-img" src="/img/icon_miperfil.png" alt=""></div>
                                <div class="">
                                    <button class="dropbtn acceso">Acceso / Registrase</button>
                                    <div class="dropdown-content bg-success">
                                        <div class="card" style="width: 32rem;">
                                            <div class="card-body">
                                                <div class="col-lg-12 titulo c-a text-center h2 pt-3">Ingresa a tu PagoExprés</div>
                                                <p class="text-center textoreg">¿Todavía no te has registrado? <span><a href="/register" class="c-n">Crea tu cuenta Aquí</a></span></p>
                                                            
                                                    <form action="{{ route('login') }}" method="POST">
                                                        @csrf
                                                        <div class="form-group">
                                                            <div class="row mx-auto">
                                                                <div class="col-xs-6 col-md-4 col-sm-4 col-4">
                                                                    <label for="tipodocumento">Tipo </label>
                                                                    <select class="form-control inputForm inputType" name="" id="identificationNac" placeholder="Tipo">
                                                                        <option value="J">J-</option>
                                                                        <option value="E">E-</option>
                                                                        <option value="G">G-</option>
                                                                        <option value="P">P-</option>
                                                                        <option value="V" selected>V-</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-xs-6 col-md-8 col=sm-8 col-8">
                                                                    <label for="documento">Documento</label>
                                                                    <input type="text" id="identificationNumber" class="form-control inputForm" placeholder="Documento" autocomplete="off">
                                                                </div>
                                                            </div>
                                                            
                                                        </div>
                                                
                                                        <div class="form-group">
                                                            <div class="row mx-auto" >
                                                                <div class="col-xs-12 col-sm-12 col-md-12">
                                                                    <label for="email">Correo Electrónico</label>
                                                                    <input type="email" name="email" class="form-control inputForm" placeholder="Correo Electrónico" id="email" autocomplete="off" value="typej2003@gmail.com">
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
                                                                    <input type="password" name="password" id="password-field" class="form-control inputForm" placeholder="Contraseña" value="12345678"/ autocomplete="off">
                                                                </div>
                                                            </div>                
                                                        </div>
                                                            
                                                        <div class="form-group">
                                                            <div class="row mx-auto my-3">
                                                                <div class="col-xs-12 col-sm-12 col-md-12">
                                                                    <button class="btn boton1 w-100">Iniciar Sesión Aquí</button>
                                                                </div>
                                                            </div>                
                                                        </div>
                                                    </form>

                                                <div class="modal-footer" style="background-color: #eb6c0e;">
                                                    Contactar a soporte si no puedes iniciar sesión
                                                </div>
                                                
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--       select category  -->
                                @endif
                            </div>
                            <div class="col-xl-2 border border-2 d-flex justify-content-center align-items-center">
                                <img class="nav-img" src="/img/icon_heart.png" alt="">
                            </div>
                            <div class="col-xl-1 border border-2 d-flex justify-content-center align-items-center">
                                <img class="nav-img" src="/img/icon_carrito.png" alt="">
                                <span>$0.00</span>
                            </div>
                        </div>
                    </div>
                <div>
                <!-- Right navbar bootom   -->
                <div class="row container-fluid">
                    <div class="col-xl-12 d-flex">
                        <!-- categorias  -->
                        <ul class="w-60 nav nav-pills nav-fill d-flex">

                            @foreach($categories as $category)
                                <li class="nav-item dropdown">            
                                    <a class="categoryMenu dropdownLink my-1 nav-link">{{$category->name}}</a>
                                    <div class="subcategoryMenu dropdown-content-link">
                                        @foreach($category->subcategories as $subcategory)
                                            <a class="subcategoryLink" href="#">{{ $subcategory->name }}</a>
                                        @endforeach
                                    </div>            
                                </li>
                            @endforeach
                            
                        </ul>
                        <!-- moneda currency  -->
                        <ul class="nav w-40 d-flex justify-content-between ms-auto" wire:ignore>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle d-flex justify-content-center align-items-center" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <span>Moneda: </span><div class="currency mx-1"></div>
                                </a>
                                <ul class="dropdown-menu currencyList border-0 my-0" aria-labelledby="navbarDropdown">
                                </ul>
                            </li>
                            <li class="nav-item dropdown ms-auto"><span class="nav-link">$: {{$dolar=1}} Bs.</span></li>
                        </ul>
                    <div>
                <div>
            <div>
        </ul>
        
</nav>

<script>    
    

    var categoryOption = [];

    // $(".selectCategory").on("click", ".init", function() {

    //     $(this).closest(".selectCategory").children('li:not(.init)').toggle();
    // });
    
    // var allOptions = $(".selectCategory").children('li:not(.init)');
    // $(".selectCategory").on("click", "li:not(.init)", function() {
    //     allOptions.removeClass('selected');
    //     $(this).addClass('selected');
    //     $(".selectCategory").children('.init').html($(this).html());
    //     allOptions.toggle();
        
    // });
    window.onload = function() {
        // $('.selectCategory').mouseenter(function(){   
        //     $(this).closest(".selectCategory").children('li :not(.init)').toggle();        
        // });
    
        // $('.selectCategory li').mouseenter(function(){
        //     $(this).closest(".selectCategory").children('li :not(.init)').toggle();        
        // });

        // $('.selectCategory li').mouseleave(function(){
        //     $(this).closest(".selectCategory").children('li:not(.init)').toggle();
        // });
        
        // Operaciones de moneda
        var currency = 1
        var currencyOption = ["Bs.", "$", "€"];

        updateCurrency()

        function updateCurrency(currency = 1){
            let actual = currencyOption[currency-1]
            let currencyValue = document.querySelector('.currency')
            currencyValue.innerText = actual
            document.querySelector('.currencyList').innerHtml = ''

            currencyOption.forEach(element => {
                if(actual  != element){
                    let li = document.createElement('li')
                    li.classList.add('optionCurrency', 'my-1')
                    li.dataset.element = element
                    let div = document.createElement('div')
                    div.classList.add('currencyItem')
                    div.innerText = element 
                    li.appendChild(div)
                    let currencyList = document.querySelector('.currencyList').appendChild(li)
                    //currencyList.classList.add('me-auto')
                    li.addEventListener('click', searchElementCurrency)
                }
            });
        }        

        function searchElementCurrency(){
            let currencyList = document.querySelector('.currencyList')
            currencyList.innerHTML = ''     
            let valor = this.dataset.element
            currency = currencyOption.findIndex((element) => element === valor);
            updateCurrency(currency+1)
            $('.currencyList').dropdown();
        }

        $(".optionCategory").click(function(e) {
            var valor = $(this).attr("data-valor");
            console.log(valor);
            //$('.btnCategory').html(valor)
            $('.selectCategory .optionCategory').closest(".selectCategory").children('.optionCategory:not(.init)').toggle();

            
         });

    // Operaciones con Categorias
         
        var category = 1
    
        function updateCategory(category = 1){
            let actual = categoryOption[category-1]
            let categoryValue = document.querySelector('.category')
            categoryValue.innerText = actual

            categoryOption.forEach(element => {
                //if(actual  != element){
                    console.log(element)
                    let li = document.createElement('li')
                    li.classList.add('optionCategory', 'my-1')
                    li.dataset.element = element
                    let div = document.createElement('div')
                    div.classList.add('categoryItem')
                    div.innerText = element 
                    li.appendChild(div)
                    let categoryList = document.querySelector('.categoryList').appendChild(li)
                    //categoryList.classList.add('me-auto')
                    li.addEventListener('click', searchElementCategory)
                //}
            });
        }

        

        function searchElementCategory(){
            let categoryList = document.querySelector('.categoryList')
            categoryList.innerHTML = ''     
            let valor = this.dataset.element
            category = categoryOption.findIndex((element) => element === valor);
            updateCategory(category+1)
        }

        window.addEventListener('sendCategories', event => {
            
            let categories = event.detail.categories
            
            categoryOption = []

            categories.forEach((element, index) => {
                if(element['itemMenu']=="1")
                    categoryOption.push(element['name']);
            });
            updateCategory()
            
        
        }) //fin de Livewire.on  

        // window.onload = function() {
            //alert(@this.valor)
            
            //Livewire.dispatch('prueba', { postId: 2 })
            //Livewire.dispatchTo('Welcome-wire', 'prueba', { postId: 2 })
        // };
    
        Livewire.emit('sendCategories', 2)


    };
    
    window.onload = function() {
        $('.dropdown-toggle').dropdown();
    }
</script>

</div>

