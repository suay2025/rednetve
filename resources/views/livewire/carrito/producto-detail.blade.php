 <!-- cuerpo -->
<div class="row container-fluid d-flex  justify-content-between mx-3">
  <div class="col-xs-8 col-md-4">
    <img  src="{{$ruta.$prod->image_path1}}" class="card-img shadow rounded mx-auto d-blod img-fluid">
    <h1 class="color_v">
      US$ {{$prod->price1}} / {{$prod->price1*35.7}}Bsf.
    </h1>
    <p class="color_v">
      <strong>Entrega:</strong> 20min a 30min 
    </p>

    <form action="{{ route('cart.store') }}" method="POST">
      {{ csrf_field() }}
      <p>
        <label for="" class="color_v">
          <strong>Cantidad: </strong>
        </label>
        <input type="number" onclick="calcular()" id="quantity" name="quantity" value="1" min="1" max="10" size="3" style="width : 50px; heigth : 5px; border-radius: 10px;" min="1" max="10">
        <label class="color_v" for="">
          <strong>Total ($): </strong>
        </label>
        <input type="text" id="amount" name="amount" size="3" required readonly style="width : 50px; heigth : 5px; border-radius: 10px;">
      </p>
      <p>
        <button class="boton font-weight-bold">
          Agregar al carrito
        </button>
        <!-- <button class="btn_buy font-weight-bold">Comprar ahora</button> -->
      </p>
      <input type="hidden" value="{{ $prod->id }}" id="id" name="id">
      <input type="hidden" value="{{ $prod->afiliado_id }}" id="afiliado_id" name="afiliado_id">
      <input type="hidden" value="{{ $prod->sucursal_id }}" id="sucursal_id" name="sucursal_id">
      <input type="hidden" value="{{ $prod->sucursal->name_sucursal }}" id="name_sucursal" name="name_sucursal">
      <input type="hidden" value="{{ $prod->name }}" id="name" name="name">
      <input type="hidden" value="{{ $prod->categoria->name }}" id="categoria" name="categoria">
      <input type="hidden" value="{{$ruta.$prod->image_path1}}" id="img" name="img">
      <input type="hidden" value="{{ $prod->details2 }}" id="slug" name="slug">
      <input type="hidden" value="{{ ($categoria != 'foods')? $prod->price1: $prod->pack_price }}" id="price" name="price">
    </form>
  </div>

  <div class="col-xs-12 col-md-4 "> <h1 class="color_v">{{$prod->name}}</h1>
    <p class="color_menu text-justify">
      {{$prod->details1}}
    </p>
    <p class="color_v">
      {{$prod->details2}}
    </p>
    <p>
      <ul class="list-unstyled d-flex justify-content-between">
        <li>
          <strong>Valoracion:({{ $prod->ca_valoracion }})</strong>
            @for ($i = 0; $i <= 4; $i++)
              @if( $prod->ca_valoracion <= $i )
                <i class="text-default fa fa-star"></i>
              @else
                <i class="text-warning fa fa-star"></i>
              @endif
            @endfor  
        </li>
      </ul>
    </p>
  </div>


  @if( $count > 0 )
    @include('sucursal-info')
  @else
  @endif
</div>


<script type="text/javascript">
  //var objDiv = document.getElementById("product_sucur");
  //objDiv.scrollTop = objDiv.scrollHeight;
</script>

<script>
  document.addEventListener("DOMContentLoaded", function(event) {
    
    let amount = document.getElementById("amount");

    calcular();

    function calcular() {
      let cantidad = 0;
      let precio = 0;
      let montot = 0;
      //console.log("quantity");
      //console.log(document.getElementById("quantity").value); 
      cantidad = document.getElementById("quantity").value;
      precio = document.getElementById("price").value;
      montot = Math.round(( cantidad * precio ), 2);
      amount.value = montot;
    }  
    
  });

</script>

