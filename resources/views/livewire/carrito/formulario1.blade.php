@extends('cliente.app')

@section('content')
<div class="container-fluid">
	<div class="row">
	    <div class="col-md-12 m-3" style="height: 100px; background-color: #f0b66c; border-radius: 25px;">
	      <img class="my-3" style="width: 50px;" src="/assets/img/icon_carrito.png">
	      <span class="my-3 fs-3 text-white fw-bold">Mi Carrito</span>
	    </div>    
	  </div>
	</div>
</div>

<form action="{{ route('cart.formulario2') }}" method="POST">
    @csrf
	<?php 
		$fe_pedido = date("Y-m-d H:i:s");
		$fe_pedido = date("Y-m-d");
	?>
	<div class="row">
	<div class="col-1">
	</div>
	<div class="col-3">

		<h4>Información del Pedido</h4>
		<br>
			<form>
			<input type="hidden" name="estado" class="form-control" value="0"  Required>
			<input type="hidden" name="user_id" class="form-control" value="{{ auth()->user()->id }}"  Required>

			<div class="form-row">
			    	<label for=""><strong>Fecha del Pedido *</strong></label>
				      <input type="text" name="fe_pedido" value="{{ $fe_pedido }}" class="form-control" placeholder="" Required ReadOnly>
			  </div>
			  <br>

			  <div class="form-row">
			    	<label for=""><strong>Nombre Completo *</strong></label>
				      <input type="text" name="nombre" value="{{ auth()->user()->name }}" class="form-control" placeholder="" Required>
			  </div>
			  <br>
			  
			  <div class="form-row">
			    	<label for=""><strong>Tipo de Cedula *</strong></label>
					<select id="tipocedula" name="tipocedula" class="form-select">

					@if( auth()->user()->tipocedula == 'V')
											<option value="V" selected>
                                                    V
                                                </option>
                                                <option value="E">
                                                    E
                                                </option>
                                                <option value="P">
                                                    P
                                                </option>
                                            </select>
					@endif
					@if( auth()->user()->tipocedula == 'E')
											<option value="V">
                                                    V
                                                </option>
                                                <option value="E" selected>
                                                    E
                                                </option>
                                                <option value="P">
                                                    P
                                                </option>
                                            </select>
					@endif
					@if( auth()->user()->tipocedula == 'P')
											<option value="V">
                                                    V
                                                </option>
                                                <option value="E">
                                                    E
                                                </option>
                                                <option value="P" selected>
                                                    P
                                                </option>
                                            </select>
					@endif
					@if( !isset( auth()->user()->tipocedula ) )
											<option value="V">
                                                    V
                                                </option>
                                                <option value="E">
                                                    E
                                                </option>
                                                <option value="P">
                                                    P
                                                </option>
                                            </select>
					@endif

					  <br>
					  <label for=""><strong>Cedula *</strong></label>
				      <input type="text" name="cedula" value="{{ auth()->user()->cedula }}" class="form-control" placeholder="" Required>
			  </div>
			  <br>

			  <div class="form-row">
			    	<label for=""><strong>Direccion *</strong></label>
			      <input type="text" name="direccion" value="{{ auth()->user()->direccion }}" class="form-control" placeholder="">
			  </div>
			  <br>

			  <div class="form-row">
			      <label for=""><strong>Telefono *</strong></label>
			      <input type="text" name="celular" value="{{ auth()->user()->celular }}" class="form-control" placeholder="">
			  </div>
			  <br>
			  
			</form>

		</div>
		<div class="col-1">
	</div>

		<div class="col-6">

		<h4>Productos</h4>
		<br>

			<p class="my-2">Productos</p>
			<div class="row mx-2">
				<table class="table">

				<tbody>
					<?php
						$total = 0;
					?>
				  @foreach($cartCollection as $item)
				   
					<div class="row">
                    <tr style="font-size: 12px">
                      <td>
                         <img src="{{ $item->attributes->image }}" class="img-thumbnail" width="80" height="80">
                      </td>
                      <td><strong>{{ $item->name }}</strong></td>
                      <td>{{ \Cart::get($item->id)->getPriceSum() }} USD 
                      </td>
                    </tr>
                    @endforeach
					</tbody>
					<tfooter>
                    <tr style="font-size: 12px">
						<td><strong>Total</strong></td>
						<td></td>
                      	<td>
						  <strong>
						  @if( \Cart::getTotal() > 0 )
	    	                    {{ \Cart::getTotal() }}  USD 
	                   	@else
    	                    	0  USD 
            	       	@endif
						   <input type="hidden" value="{{ \Cart::getTotal() * 38 }}" name="totalbs" class="form-control" placeholder="">
						</strong>
						</td>
                    </tr>

					</tfooter>
				</div>

				</table>

			</div>
			<br>
			<div class="row mx-2">
			</div>
			<br>
			<div class="justify-content-right">
				<div class="row col-4">
					<button type="submit" class="boton" >Finaliza tu pedido</buttom>
				</div>
			</div>
			<br>
			<div class="row mx-2">
				<p class="">Sus datos personales se utilizarán para procesar su pedido, respaldar su experiencia en este sitio web y para otros fines descritos en nuestro política de privacidad.</p>
			</div>

		</div>

		<div class="col-1">
	</div>

	</div>

</form>

@endsection
