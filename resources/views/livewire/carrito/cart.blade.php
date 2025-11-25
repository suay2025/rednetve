<!-- Start Shop -->
<div class="container" >
  <div class="row">
    <div class="col-md-12 m-3" style="height: 100px; background-color: #f0b66c; border-radius: 25px;">
      <img class="my-3" style="width: 50px;" src="/assets/img/icon_carrito.png">
      <span class="my-3 fs-3 text-white fw-bold">Mi Carrito</span>
    </div>    
  </div>

  <div class="row justify-content-center">
    <div class="col-lg-7">
      <table class="table  table-responsive">
        <thead class="thead-primary">
          <tr style="font-size: 12px">                      
            <th scope="col"></th>
            <th scope="col">Sucursal</th>
            <th scope="col">Nombre</th>
            <th scope="col">Precio</th>
            <th scope="col">Cantidad</th>
            <th scope="col">Subtotal</th>
            <th scope="col"></th>                      
          </tr>
        </thead>
        @foreach($cartCollection as $item)
          <div class="row">
            <tbody>
              <tr style="font-size: 12px">
                <td>
                  <img src="{{ $item->attributes->image }}" class="img-thumbnail" width="80" height="80">              
                  
                </td>
                <td><strong>{{ $item->attributes->name_sucursal }}</strong></td>
                <td><strong>{{ $item->name }}</strong></td>
                <td>{{ $item->price }} USD</td>
                <td>{{ $item->quantity }}</td>
                <td>{{ \Cart::get($item->id)->getPriceSum() }} USD </td>
                <td>
                  <form action="{{ route('cart.remove') }}"   method="POST">
                     {{ csrf_field() }}
                     <input type="hidden" value="{{ $item->id }}" id="id" name="id">
                     <button class="btn btn-danger"><i class="fa fa-trash"></i></button>
                  </form>
                </td>
              </tr>
            </tbody>
          </div>
        @endforeach
      </table>
      @if(\Cart::getTotalQuantity()>0)
        <h6>{{ \Cart::getTotalQuantity()}} Producto(s) en el carrito</h6><br>
      @else
        <h6>No Existen Productos en el Carrito de Compra</h6><br>
      @endif
      <div class="row">
        <div class="col-md-6">
          @if(\Cart::getTotalQuantity()>0)
            <a href="/"  class="boton nav-link">
              Seguir comprando
            </a>
          @else
              <a href="/" class="btn btn-info">
                Seleccione un Producto
              </a>
          @endif        
        </div>
        <div class="col-md-6">
          @if(count($cartCollection)>0)
            <form action="{{ route('cart.clear') }}" method="POST">
              {{ csrf_field() }}
              <button class="boton2">
                Vaciar Carrito
              </button> 
            </form>
          @endif         
        </div>
      </div>
    </div>
    @if(count($cartCollection)>0)
      <div class="col-lg-5">
        <div class="row">
          <div class="card">
            <ul class="list-group list-group-flush">
              <li class="list-group-item"><b>Total: </b>{{ \Cart::getTotal() }} USD / {{ \Cart::getTotal() * 35.5 }} BS </li>
            </ul>
          </div>
        </div>
        @auth
          <br><br>
          <a href="{{ route('cart.comprar') }}" class="boton nav-link">
            Confirma tu Pedido
          </a>
        @else
          <br><br>
          <strong>Eres No Usuario Registrado ?</strong> 
          <br>Te Invitamos a Registrarte 
          <p class="mb-3">
            <form action="/register" method="GET">
              @csrf
              <input type="hidden" value="1" id="role" name="role">
              <p class="text-center">
              <button class="boton">
          	     Registrate
              </button>            
            </form>
          </p>
          </p>
          <br><br>
          <strong>Ya Eres Usuario</strong> 
          <br>Nos gustaria que Colocaras tus credenciales
          <p class="mb-3">
            <a class="boton dropdown-item" data-bs-toggle="modal" data-bs-target="#loginModal" style="cursor: pointer;">Entrar al Sistema</a>

          
          </p>
        @endauth
        <!-- <a href="https://ddrsistemas.com/pasarela/Index.php" class="btn btn-success">Proceder a Pagar</a> -->
        <br><br>
        <!-- <a href="/pagadoacredito/1" class="btn btn-info">Proceder a Pagar Por Cuotas</a>-->
      </div>
    @endif
    <br><br>  
  </div>
  <br><br>
</div>

<script>

  function rlocal() 
  {
    var cantidad = 0;
    var precio = 0;
    var montot = 0;
    var amount = 0;

    cantidad = document.getElementById("quantity").value;
    precio = document.getElementById("price").value;

    montot = Math.round(( cantidad * precio ),2);

    document.getElementById("amount").value = montot;
  }
</script>
