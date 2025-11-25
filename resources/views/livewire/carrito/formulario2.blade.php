@extends('cliente.app')

@section('content')

<div class="container-fluid">
	<div class="row">
    	<div class="col-md-12 m-3" style="height: 100px; background-color: #f0b66c; border-radius: 25px;">
      		<img class="my-3" style="width: 50px;" src="/assets/img/icon_carrito.png">
      		<span class="my-3 fs-3 text-white fw-bold">Mi Carrito | Forma de Pago</span>
    	</div>    
  	</div>
</div>

<!--<form action="https://ddrsistemas.com/pasarelape/Index-12.php" method="POST"> -->
<!--<form action="/pasarelape/Index-12.php" method="POST"> -->
<form action="{{url('pasarela')}}" method="post">
@csrf
	<div class="container-fluid">
		<div class="col-md-10 mx-3">
			<div class="row border border-secondary my-3">
				<!-- 
					<h6 class="text-success mx-2">
					<strong>Gracias. Tu pedido Nro {{ $pedido }} ha sido recibido.</strong>
				</h6>-->
				<input type="hidden" name="pedido" id="pedido" value="{{ $pedido }}" >
				<input type="hidden" name="fecha" id="pfecha" value="{{ $fecha }}" >
				<input type="hidden" name="total" id="total" value="{{ $total }}" >
				<input type="hidden" name="fe_pedido" id="fe_pedido" value="{{ $fe_pedido }}" >
				<input type="hidden" name="cedula" id="cedula" value="{{ $cedula }}" >
				<input type="hidden" name="tipocedula" id="tipocedula" value="{{ $tipocedula }}" >
				<input type="hidden" name="celular" id="celular" value="{{ $celular }}" >
				<input type="hidden" name="direccion" id="direccion" value="{{ $direccion }}" >
				<input type="hidden" name="user_id" id="user_id" value="{{ $user_id }}" >
				<input type="hidden" name="referencia" id="referencia" value="{{ $referencia }}" >
				<input type="hidden" name="correo" id="correo" value="{{ $correo }}" >
				<input type="hidden" name="titulo" id="titulo" value="{{ $titulo }}" >
				<input type="hidden" name="descripcion" id="descripcion" value="{{ $descripcion }}" >
				<p>
				    <strong>Pan Express</strong>
				</p>
				<h1>Pedido Nro {{ $referencia }}</h1>
				<p>
				    <strong>Datos del Pedido</strong><br>
				    Fecha: {{ $fe_pedido }} <br>
				    Local: {{ $name_sucursal }} <br>
				    <br>
				    Informacion: {{ $titulo }} <br>
				    {{ $descripcion }} <br><br>
				    Total Pedido: {{ $total }} <br><br>
				    <strong>Datos de Facturación</strong><br>
				    Cédula: {{ $cedula }} <br>
				    Nombre: {{ $nombre }} <br>
				    Celular: {{ $celular }} <br>
				    Dirección: {{ $direccion }} <br><br>				    
				    Correo: {{ $correo }} <br>
				    
				</p>

				<br>
			</div>
			<div class="row">
				<div class="col-6">
					<img src="https://panexpres.com/botondepago.jpg" >
					<input type="submit" class="boton" value="PAGAR ( PASARELA VBDV )">
				</div>
				<div class="col-6">
					<img src="https://panexpres.com/botondepago.jpg" >
					<a href="/pagomovilsucursal/{{$pedido}}/{{$sucursal_id}}" class="">
						<input class="boton" type="button" name="" value="PAGAR DIRECTO AL LOCAL">
					</a>
				</div>
			</div>
		</div>
	</div>
</form>

@endsection
