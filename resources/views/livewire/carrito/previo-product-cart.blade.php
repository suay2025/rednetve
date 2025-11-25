@extends('cliente.app')

@section('content')
<div class="row">
  <?php
    use App\Models\Product;
    use App\Models\Products_pack;
    use App\Models\Sucursales;
    use App\Modelo\Sucursal_atributos;
    use App\Modelo\MetodosDePago;

    $id = trim($id_suc);


    if($categoria != 'foods')
    {
      $products = Product::with('sucursal')
      ->where('sucursal_id', $id)
      ->WhereHas('sucursal', function($q)  {
      })
      ->paginate(6);

      $prod = Product::where('id', $id_pro)->first();

      $count = Product::where('id', $id_pro)->count(); 

      $ruta = '/assets/img/products/';
    }
    else{
      $products = Products_pack::with('sucursal')
      ->where('sucursal_id', $id)
      ->WhereHas('sucursal', function($q)  {
      })
      ->paginate(6);

      $prod = Products_pack::where('id', $id_pro)->first();

      $count = Products_pack::where('id', $id_pro)->count();

      $ruta = '/assets/img/productspack/';

    }

    

    $sucursales = Sucursales::where('id', $id)->get();
    $sucursalesa = Sucursal_atributos::where('sucursal_id', $id)->get();
    $metodos_pago = MetodosDePago::where('sucursal_id', $id_suc)->get();

    //  dump($sucursalesa);
    ?>  

  <div class="row">
    <div class="col-md-12 m-3" style="height: 100px; background-color: #f0b66c;">
      
    </div>
    
  </div>

  <div class="row container-fluid d-flex  justify-content-between">
    @if( $count > 0 )
      @include('carrito.producto-detail')
    @else
      @include('carrito.producto-lista') 
    @endif
  </div>

  <div class="row container justify-content-center">

    @if( $count > 0 )
      @include('carrito.producto-lista')
    @endif           
  </div>
</div>
@endsection

