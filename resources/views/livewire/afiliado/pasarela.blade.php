<div>
    <style>
        .pasarela {
            width: 46rem !important;"
        }

        @media only screen and (max-width: 1070px)
        {
            .pasarela {
                width: 85% !important;"
            }   

        }
    </style>
        <!-- Bootstrap CSS -->
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.rtl.min.css" integrity="sha384-WJUUqfoMmnfkBLne5uxXj+na/c7sesSJ32gI7GfCk4zO4GthUKhSEGyvQ839BC51" crossorigin="anonymous"> -->
    <script src="https://kit.fontawesome.com/03cf5139f1.js"></script>

    <link rel="stylesheet" href="/css/pasarela.css" class="rel">

    <head>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" />
        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

        <script src="/js/variables.js"></script>
        <script src="/js/selectMetodoPagoPasarela.js"></script>
        
    </head> 
    
    

    <div class="row d-none">
        <div class="col-md-12 mx-3">
            <span class="negrita">Información:</span>
            <div class="row">
                <div class="col-md-3">
                    <span>clienteId: <span>{{ $clienteId }}</span></span>
                </div>
                <div class="col-md-3">
                    <span>identificationNac: <span>{{ $identificationNac }}</span>
                </div>
                <div class="col-md-3">
                    <span>identificationNumber: <span>{{ $identificationNumber }}</span>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    <span>email: <span>{{ $email }}</span></span>
                </div>
                <div class="col-md-3">
                    <span>cellphone: <span>{{ $cellphone }}</span></span>
                </div>
                <div class="col-md-3">
                    <span>rifLetter: <span>{{ $rifLetter }}</span></span>
                </div>
                <div class="col-md-3">
                    <span>rifNumber: <span>{{ $rifNumber }}</span></span>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <span>reference: <span>{{ $reference }}</span> // Pedido a pagar</span>
                </div>
                <div class="col-md-2">
                    <span>currency: <span>{{ $currency }}</span></span>
                </div>
                <div class="col-md-2">
                    <span>currencyValue: <span>{{ $currencyValue }}</span></span>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2">
                    <span>amount: <span>{{ $amount }}</span> //monto</span>
                </div>
                <div class="col-md-5">
                    <span>title: <span>{{ $title }}</span></span>
                </div>
                <div class="col-md-5">
                    <span>description: <span>{{ $description }}</span></span>
                </div>
            </div>            
        </div>
    </div>

    <script>
        document.addEventListener('livewire:load', function () {
            
            
        })        
    </script>
    <div class="container-fluid d-flex flex-row">
        <div class="row mx-auto pasarela">
            <div class="col-sm-10">
                
            </div><!-- /.col -->
            <div class="col-sm-2">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item active">
                        Divisa @livewire('components.currency')
                    </li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div>
    <div class="container-fluid d-flex flex-row">
        <div class="card mx-auto pasarela" >
            <div class="card-body">
                <div class="row my-3">
                    <div class="col-lg-12" wire:ignore>
                        <div class="divPrincipal" id="divPrincipal"></div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>

<script>
    document.addEventListener('livewire:load', function () {
        var nropedido = @this.nropedido 
        var reference = @this.reference 
        var title = @this.title 
        var description  = @this.description 
        var clienteId = @this.clienteId 
        var amount = @this.amount
        var currency = @this.currency 
        var currencyValue  = @this.currencyValue 
        var email = @this.email 
        var cellphone = @this.cellphone 
        var cellphonecode = @this.cellphonecode 
        var identificationNac = @this.identificationNac
        var identificationNumber = @this.identificationNumber
        var rifLetter = 'J';
        var rifNumber = ''; // J G

        var bancos = @this.bancos;
        var pagosmoviles = @this.pagosmoviles;
        var transferencias = @this.transferencias;
        var zelles = @this.zelles;
        var paypals = @this.paypals;

        var comercio_id = @this.comercio_id;
        
        //console.log(bancos)

        let divPrincipal = document.getElementById('divPrincipal')
        divPrincipal.appendChild(selectMetodoPago(0, comercio_id, nropedido, reference, title, description, clienteId,amount,currency,currencyValue,email,cellphonecode, cellphone, identificationNac, identificationNumber,rifLetter, rifNumber, bancos, pagosmoviles, transferencias, zelles, paypals))  
    })
    
</script>


<script>    
    window.addEventListener('sendWelcome', function (event) {
        
        location.href = '/';
    });

    window.addEventListener('sendProcesado', function (event) {
        alert('sendProcesado');
        location.href = '/procesado';
    });
    
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</div>
