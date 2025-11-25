<style type="text/css">
	.input-wrapper 
	{
	  position: relative;
	  width: 271px;
	}

	.input 
	{
	  box-sizing: border-box;
	  color: #191919;
	  padding: 15px 15px 15px 35px;
	  width: 100%;
	}

	.input-icon 
	{
	  color: #191919;
	  position: absolute;
	  width: 20px;
	  height: 20px;
	  top: 50%;
	  transform: translateY(-50%);
	  left: unset;
	  right: 12px;
	}

</style>
@extends('cliente.app')

@section('content')
	<div class="container-fluid bg-light">
		<div class="col-md-12 mx-3 my-2">
			<div class="card rounded my-2 col-md-6">
				<div class="card-body">
					<br>
					Pedido: {{ $pedido->id . '-' . $pedido->cedula . '-' . $pedido->fe_pedido }}
					<br>
					Sucursal: {{ $sucursal->name_sucursal }}
					<br>
					Monto: {{ $pedido->totalbs}} Bs.
				</div>
			</div>
			<div class="row">
				<div class="col-md-6" id="contenido">
				</div>

				<div class="border col-md-5" id="detalles">
					<h4>Detalle</h4>
				</div>
			</div>

			<script>
		    	var modopago = '';
		    	var banco = '';
		    	var telefono = '';
		    	var nrocuenta = '';
		    	var monto = 0;
		    	var referencia = '';
		    	var contenido = document.querySelector("#contenido");
		    	var detalles = document.querySelector("#detalles");

		    	var f = new Date();

		    	let m = f.getMonth() +1;

		    	let mes = m.toString().padStart(2, '0')

		    	var fecha = f.getFullYear() + "-" + mes + "-" + f.getDate();

		        window.addEventListener('load', init, false);
		        function init() 
		        {
		        	contenido.appendChild(funcComopagar()) 

		        }

		        function ir(ventana, valor)
		        {
		        	switch(ventana)
		        	{
		        		case '1':
		        			modopago = valor;
		        			contenido.innerHTML = '';
		        			contenido.appendChild(funcDatos_transferencia());

		        			detalles.innerHTML = '';
		        			detalles.appendChild(funcDetalles());

		        			break;
		        		case '2':
		        			contenido.innerHTML = '';
		        			contenido.appendChild(funcBanco());

		        			detalles.innerHTML = '';
		        			detalles.appendChild(funcDetalles());
		        			break;
		        		case '3':
		        			var radios = document.getElementsByName("banco");
						    var selected = Array.from(radios).find(radio => radio.checked);
						    banco = selected.value;		        			
		        			contenido.innerHTML = '';
		        			contenido.appendChild(funcDiapago());

		        			detalles.innerHTML = '';
		        			detalles.appendChild(funcDetalles());
		        			break;
		        		case '4':
		        			fecha = document.querySelector("#fecha").value;
		        			contenido.innerHTML = '';
		        			contenido.appendChild(funcTelefonopago());
		        			break;
		        		case '5':
		        			if(modopago == 'pago movil'){
		        				telefono = document.querySelector("#telefono").value;
		        			}else{
		        				nrocuenta = document.querySelector("#nrocuenta").value;
		        			}
		        			contenido.innerHTML = '';
		        			contenido.appendChild(funcMontopago())

		        			detalles.innerHTML = '';
		        			detalles.appendChild(funcDetalles());
		        			break;
		        		case '6':
		        			monto = document.querySelector("#monto").value;
		        			contenido.innerHTML = '';
		        			contenido.appendChild(funcReferencia())

		        			detalles.innerHTML = '';
		        			detalles.appendChild(funcDetalles());
		        			break;
		        		case '7':
		        			referencia = document.querySelector("#referencia").value;

		        			contenido.innerHTML = '';
		        			contenido.appendChild(funcDatosoperacion())

		        			document.querySelector("#metodopago1").value = modopago;
					    	document.querySelector("#banco1").value = banco;
					    	if(modopago == 'transferencia'){
					    		document.querySelector("#nrocuenta").value = nrocuenta;	
					    	}else{
					    		document.querySelector("#tel").value = telefono;
					    	}
					    	document.querySelector("#fecha1").value = fecha;
					    	document.querySelector("#monto1").value = monto;
					    	document.querySelector("#referencia1").value = referencia;

					    	document.getElementById("formulario").addEventListener('submit', validarFormulario);

					    	detalles.innerHTML = '';
		        			detalles.appendChild(funcDetalles());
					    	break;
		        	}
		        }

		        function volver(ventana, valor)
		        {
		        	switch(ventana)
		        	{
		        		case '0':
		        			modopago = valor;
		        			contenido.innerHTML = '';
		        			contenido.appendChild(funcComopagar());
		        			break;
		        		case '1':
		        			contenido.innerHTML = '';
		        			contenido.appendChild(funcDatos_transferencia());
		        			break;
		        		case '2':
		        			contenido.innerHTML = '';
		        			contenido.appendChild(funcBanco());
		        			break;
		        		case '3':
		        			contenido.innerHTML = '';
		        			contenido.appendChild(funcDiapago());
		        			break;
		        		case '4':
		        			contenido.innerHTML = '';
		        			contenido.appendChild(funcTelefonopago());
		        			break;
		        		case '5':
		        			contenido.innerHTML = '';
		        			contenido.appendChild(funcMontopago());
		        			break;
		        		case '6':
		        			contenido.innerHTML = '';
		        			contenido.appendChild(funcReferencia());
		        			break;
		        	}
		        }

		        function funcComopagar()
		        {
		        	let div = document.createElement('div');
		        	
		        	div.innerHTML = `
		        		<div id="comopagar">
							<div class="row my-2">
								<div class="col-md-12">
									<h3 class="card-title">¿Cómo vas a pagar?</h3>
								</div>
							</div>
							<div class="card rounded col-md-6 my-2">
								<div class="card-body">
									<a class="nav-link" style="cursor:pointer;" onclick="ir('1','transferencia')" >
										<div class="row">
											<div class="col-md-10 h5 font-weight-bold">
												Transferencia
											</div>
											<div class="col-md-2">
												<img src="/bootstrap-icons/icons/arrow-right.svg">
											</div>
										</div>
									</a>
								</div>
							</div>

							<div class="card rounded col-md-6 my-2">
								<div class="card-body">
									<a class="nav-link" style="cursor:pointer;" onclick="ir('1', 'deposito')" >
										<div class="row">
											<div class="col-md-10 h5 font-weight-bold">
												Depósito
											</div>
											<div class="col-md-2">
												<img src="/bootstrap-icons/icons/arrow-right.svg">
											</div>
										</div>
									</a>
								</div>
							</div>

							<div class="card rounded col-md-6 my-2">
								<div class="card-body">
									<a class="nav-link" style="cursor:pointer;" onclick="ir('1', 'pago movil')">
										<div class="row">
											<div class="col-md-10 h5 font-weight-bold">
												Pago Móvil
											</div>
											<div class="col-md-2">
												<img src="/bootstrap-icons/icons/arrow-right.svg">
											</div>
										</div>
									</a>
								</div>
							</div>

							<div class="card rounded col-md-6 my-2">
								<div class="card-body">
									<a class="nav-link" style="cursor:pointer;" onclick="ir('1', 'deposito usd')">
										<div class="row">
											<div class="col-md-10 h5 font-weight-bold">
												Depósito USD
											</div>
											<div class="col-md-2">
												<img src="/bootstrap-icons/icons/arrow-right.svg">
											</div>
										</div>
									</a>
								</div>
							</div>
						</div>
		        	`
		        	return div;
		        }

		        function funcDatos_transferencia()
		        {
		        	let div = document.createElement('div');
		        	
		        	let valor  = `
		        		<div id="datos_transferencia">
							<div class="row my-2">
								<div class="col-md-12">
									<h3 class="card-title">Transfiere a esta cuenta</h3>
								</div>
							</div>
							<div class="row my-2">
								<div class="col-md-12">
									<h3 class="card-title">Asegurate de copiar los datos correctamente.</h3>
								</div>
							</div>
							<div class="card rounded col-md-6 my-2">
								<div class="card-body">`
								if(modopago=='pago movil')
								{

									valor += `
										<div class="row" id="regtelefono">
											<div class="col-md-10 h5 font-weight-bold">
												<label for="telefono">Número de teléfono</label>
												<input class="form-control" type="text" value="04165800403" id="telefono" readonly>
											</div>
											<div class="col-md-2">
												<button id="boton" onclick="copiar()"><img src="/bootstrap-icons/icons/copy.svg"></button>
											</div>
										</div> `
								}
								else
								{
									valor += `
										<div class="row" id="regcuenta">
											<div class="col-md-10 h5 font-weight-bold">
												<label for="cuenta">Número de cuenta</label>
												<input class="form-control" type="text" value="CCC CCCC CCCC CCCC" id="cuenta" readonly>
											</div>
											<div class="col-md-2">
												<button id="boton" onclick="copiar()"><img src="/bootstrap-icons/icons/copy.svg"></button>
											</div>
										</div>
										`
								}
								valor += `
								</div>
							</div>

							<div class="card rounded col-md-6 my-2">
								<div class="card-body">
										<div class="row">
											<div class="col-md-10 h5 font-weight-bold">
												<label for="rif">RIF</label>
												<input class="form-control" type="text" value="J12345678" id="rif" readonly>
											</div>
											<div class="col-md-2">
												<button id="boton1" onclick="copiar()"><img src="/bootstrap-icons/icons/copy.svg"></button>
											</div>
										</div>
								</div>
							</div>
							<div class="card rounded col-md-6 my-2">
								<div class="card-body">
										<div class="row">
											<div class="col-md-10 h5 font-weight-bold">
												<label for="banco">BANCO</label>
												<input class="form-control" type="text" value="Banco de Venezuela" id="venezuela" readonly>
											</div>
											<div class="col-md-2">
												<button id="boton" onclick="copiar()"><img src="/bootstrap-icons/icons/copy.svg"></button>
											</div>
										</div>
								</div>
							</div>

							<div class="card rounded col-md-6 my-2">
								<div class="card-body d-flex justify-content-between mb-2">
									<a class="rounded p-3 btn btn-success" style="cursor:pointer;" onclick="volver('0', '')">Volver</a>
									<a class="rounded p-3 btn btn-success" style="cursor:pointer;" onclick="ir('2', 't')">Confirme su pago</a>
								</div>
							</div>
						</div>
		        	`
		        	div.innerHTML = valor;
		        	return div;
		        }

		        function funcBanco()
		        {
		        	let div = document.createElement('div');
		        	
		        	div.innerHTML = `
		        		<div id="banco">
							<div class="row my-2">
								<div class="col-md-12">
									<h3 class="card-title">¿Desde qué banco se realizó el pago?</h3>
								</div>
							</div>
							<div class="card rounded col-md-6 my-2">
								<div class="card-body">
										<div class="row border p-2 my-2">
											<div class="col-md-10 h5 font-weight-bold">
												<label class="form-check-label" for="venezuela">Banco de Venezuela</label>
											</div>
											<div class="col-md-2">
												<input class="form-check-input border" type="radio" name="banco" id="venezuela" value="venezuela" checked>
											</div>
										</div>
										<div class="row border p-2 my-2">
											<div class="col-md-10 h5 font-weight-bold">
												<label class="form-check-label" for="mercantil">Banco de Mercantil</label>
											</div>
											<div class="col-md-2">
												<input class="form-check-input border" type="radio" name="banco" id="mercantil" value="mercantil">
											</div>
										</div>
										<div class="row border p-2 my-2">
											<div class="col-md-10 h5 font-weight-bold">
												<label class="form-check-label" for="telefono">Banco Banesco</label>
											</div>
											<div class="col-md-2">
												<input class="form-check-input" type="radio" name="banco" id="banesco" value="banesco">
											</div>
										</div>
								</div>
							</div>

							<div class="card rounded col-md-6 my-2">
								<div class="card-body d-flex justify-content-between mb-2">
									<a class="rounded p-3 btn btn-success" style="cursor:pointer;" onclick="volver('1', '')">Volver</a>
									<a class="rounded p-3 btn btn-success" style="cursor: pointer;" onclick="ir('3', '')">Confirmar banco proveniente</a>
								</div>
							</div>
						</div>
		        	`
		        	return div;
		        }

		        function funcDiapago()
		        {
		        	let div = document.createElement('div');

		        	div.innerHTML = `
		        		<div id="diapago">
							<div class="row my-2">
								<div class="col-md-12">
									<h3 class="card-title">¿Qué día realizaste el pago?</h3>
								</div>
							</div>
							<div class="card rounded col-md-6 my-2">
								<div class="card-body">
									<div class="row border p-2 my-2">
										<div class="col-md-10 h5 font-weight-bold">
											<input class="form-control" type="date" id="fecha" name="fecha" value="${fecha}" />
										</div>
									</div>
								</div>
							</div>

							<div class="card rounded col-md-6 my-2">
								<div class="card-body d-flex justify-content-between mb-2">
									<a class="rounded p-3 btn btn-success" style="cursor:pointer;" onclick="volver('2', '')">Volver</a>
									<a class="rounded p-3 btn btn-success" style="cursor: pointer;" onclick="ir('4', '')">Confirmar día de pago</a>
								</div>
							</div>
						</div>
		        	`
		        	return div;
		        }

		        function funcTelefonopago()
		        {
		        	let div = document.createElement('div');
		        	let valor1 = '';
		        	let valor = `
		        		<div id="telefonopago">
							<div class="row my-2">
								<div class="col-md-12">
									<h3 class="card-title">¿Con qué número de `
									if(modopago=="pago movil")
									{
										valor1 += 'teléfono';
									}
									else
									{
										valor1 += 'cuenta';
									}
									valor += valor1;
									valor += `
									pagaste?</h3>
								</div>
							</div>
							<div class="card rounded col-md-6 my-2">
								<div class="card-body">
									<div class="row p-2 my-2">
										<div class="col-md-10 h5 font-weight-bold"> `
										if(modopago=="pago movil"){
											valor += `<input type="text" class="form-control" name="telefono" id="telefono" value="${telefono}">`
											}
											else
											{
												valor += `<input type="text" class="form-control" name="nrocuenta" id="nrocuenta" value="${nrocuenta}">`
											}
										valor += `
										</div>
									</div>
								</div>
							</div>

							<div class="card rounded col-md-6 my-2">
								<div class="card-body d-flex justify-content-between mb-2">
									<a class="rounded p-3 btn btn-success" style="cursor:pointer;" onclick="volver('3', '')">Volver</a>
									<a class="rounded p-3 btn btn-success" style="cursor: pointer;" onclick="ir('5', '')">Confirmar ${valor1}</a>
								</div>
							</div>
						</div>
		        	`
		        	div.innerHTML = valor;

		        	return div;
		        }

		        function funcMontopago()
		        {
		        	let div = document.createElement('div');
		        	
		        	div.innerHTML = `
		        		<div id="montopago">
							<div class="row my-2">
								<div class="col-md-12">
									<h3 class="card-title">Confirma el monto en Bolívares</h3>
								</div>
							</div>
							<div class="card rounded col-md-6 my-2">
								<div class="card-body">
									<div class="row p-2 my-2">
										<div class="col-md-10 h5 font-weight-bold">
											<input type="text" class="form-control" name="monto" id="monto"  value="${monto}">
										</div>
									</div>
								</div>
							</div>

							<div class="card rounded col-md-6 my-2">
								<div class="card-body d-flex justify-content-between mb-2">
									<a class="rounded p-3 btn btn-success" style="cursor:pointer;" onclick="volver('4', '')">Volver</a>
									<a class="rounded p-3 btn btn-success" style="cursor: pointer;" onclick="ir('6', '')">Confirmar monto</a>
								</div>
							</div>
						</div>
		        	`
		        	return div;
		        }

		        function funcReferencia()
		        {
		        	let div = document.createElement('div');
		        	
		        	let valor = `
		        		<div id="referenciadiv">
							<div class="row my-2">
								<div class="col-md-12">
									<h3 class="card-title">Confirma el número de referencia</h3>
								</div>
							</div>
							<div class="card rounded col-md-6 my-2">
								<div class="card-body">
									<div class="row p-2 my-2">
										<div class="col-md-10 h5 font-weight-bold">
											<input type="text" class="form-control" name="referencia" id="referencia" value="${referencia}">
										</div>
									</div>
								</div>
							</div>

							<div class="card rounded col-md-6 my-2">
								<div class="card-body d-flex justify-content-between mb-2">
									<a class="rounded p-3 btn btn-success" style="cursor:pointer;" onclick="volver('5', '')">Volver</a>
									<a class="rounded p-3 btn btn-success" style="cursor: pointer;" onclick="ir('7', '')">Confirmar número de referencia</a>
								</div>
							</div>
						</div>
		        	`

		        	div.innerHTML = valor;

		        	return div;
		        }

		        function funcDatosoperacion()
		        {
		        	let div = document.createElement('div');
		        	let valor = `
		        	<form action="/enviardatos" id="formulario" method="POST">
		        		@csrf
		        		<input type="hidden" id="pedido_id" name="pedido_id" value="{{$pedido->id}}" />
		        		<div id="datosoperacion">
							<div class="row my-2">
								<div class="col-md-12">
									<h3 class="card-title">Confirma los datos introducidos</h3>
								</div>
							</div>
							<div class="card rounded col-md-12 my-2">
								<div class="card-body">
									<div class="row p-2 my-2">
										<label for="metodopago1">Métodos de pago: </label>
										<div class="row">
											<div class="col-md-11">
												<input class="form-control" type="text" name="metodopago1" id="metodopago1" value="${modopago}" readonly>
											</div>
											<div class="col-md-1">
												<a style="cursor:pointer" onclick="volver('0','0')">
													<img class="" src="/bootstrap-icons/icons/pencil.svg" />
												</a>
											</div>
										</div>
									</div>
									<div class="row p-2 my-2">
										<label for="banco1">Banco: </label>
										<div class="row">
											<div class="col-md-11">
												<input class="form-control" type="text" name="banco1" id="banco1" value="${banco}" readonly>
											</div>
											<div class="col-md-1">
												<a style="cursor:pointer" onclick="volver('2','0')">
													<img class="" src="/bootstrap-icons/icons/pencil.svg" />
												</a>
											</div>
										</div>
									</div>
									<div class="row p-2 my-2">
										<label for="fecha1">Fecha: </label>
										<div class="row">
											<div class="col-md-11">
												<input class="form-control" type="date" name="fecha1" id="fecha1" value="${fecha}" readonly>
											</div>
											<div class="col-md-1">
												<a style="cursor:pointer" onclick="volver('3','0')">
													<img class="" src="/bootstrap-icons/icons/pencil.svg" />
												</a>
											</div>
										</div>
									</div>`

									if(modopago=='pago movil')
									{
										valor += `
										<div id="divtelefono" class="row p-2 my-2">
											<label for="tel">Número de teléfono: </label>
											<div class="row">
												<div class="col-md-11">
													<input class="form-control" type="text" name="tel" id="tel" value="${telefono}" readonly>
												</div>
												<div class="col-md-1">
													<a style="cursor:pointer" onclick="volver('4','0')">
														<img class="" src="/bootstrap-icons/icons/pencil.svg" />
													</a>
												</div>
											</div>
										</div>
										`
									}
									else
									{
										valor += `
											<div id="divnrocuenta" class="row p-2 my-2">
												<label for="nrocuenta">Número de cuenta: </label>
												<div class="row">
													<div class="col-md-11">
														<input class="form-control" type="text" name="nrocuenta" id="nrocuenta" value="${nrocuenta}" readonly>
													</div>
													<div class="col-md-1">
														<a style="cursor:pointer" onclick="volver('4','0')">
															<img class="" src="/bootstrap-icons/icons/pencil.svg" />
														</a>
													</div>
												</div>
											</div>`
									}
									valor += `
									<div class="row p-2 my-2">
										<label for="monto1">Monto: </label>
										<div class="row">
											<div class="col-md-11">
												<input class="form-control" type="text" name="monto1" id="monto1" value="${monto}" readonly>
											</div>
											<div class="col-md-1">
												<a style="cursor:pointer" onclick="volver('5','0')">
													<img class="" src="/bootstrap-icons/icons/pencil.svg" />
												</a>
											</div>
										</div>
									</div>
									<div class="row p-2 my-2">
										<label for="referencia1">Número de referencia: </label>
										<div class="row">
											<div class="col-md-11">
												<input class="form-control" type="text" name="referencia1" id="referencia1" value="${referencia}" readonly>
											</div>
											<div class="col-md-1">
												<a style="cursor:pointer" onclick="volver('6','0')">
													<img class="" src="/bootstrap-icons/icons/pencil.svg" />
												</a>
											</div>
										</div>
									</div>
								</div>
							</div>

							<div class="card rounded col-md-6 my-2">
								<div class="card-body text-center">
									<button type="submit" class="rounded p-3 btn btn-success" >Enviar datos</button>
								</div>
							</div>
						</div>
		        	</form>
		        	`
		        	div.innerHTML = valor;

		        	return div;
		        }

		        function funcDetalles()
		        {
		        	let div = document.createElement('div');
		        	
		        	let valor = `
		        		<div id="datosoperaciond col-md-12">
							<div class="row my-2">
								<div class="col-md-12">
									<h3 class="card-title">Detalles</h3>
								</div>
							</div>
							<div class="card rounded col-md-12 my-2">
								<div class="card-body">
									<div class="row p-2 my-2">
										<label for="metodopago1">Métodos de pago: </label>
										<div class="row">
											<div class="col-md-11">
												<input class="form-control" type="text" name="" id="metodopagod" value="${modopago}" readonly>
											</div>
											<div class="col-md-1">
												<a style="cursor:pointer" onclick="volver('0','0')">
													<img class="" src="/bootstrap-icons/icons/pencil.svg" />
												</a>
											</div>
										</div>
									</div>
									<div class="row p-2 my-2">
										<label for="banco1">Banco: </label>
										<div class="row">
											<div class="col-md-11">
												<input class="form-control" type="text" name="" id="bancod" value="${banco}" readonly>
											</div>
											<div class="col-md-1">
												<a style="cursor:pointer" onclick="volver('2','0')">
													<img class="" src="/bootstrap-icons/icons/pencil.svg" />
												</a>
											</div>
										</div>
									</div>
									<div class="row p-2 my-2">
										<label for="fecha1">Fecha: </label>
										<div class="row">
											<div class="col-md-11">
												<input class="form-control" type="date" name="" id="fechad" value="${fecha}" readonly>
											</div>
											<div class="col-md-1">
												<a style="cursor:pointer" onclick="volver('3','0')">
													<img class="" src="/bootstrap-icons/icons/pencil.svg" />
												</a>
											</div>
										</div>
									</div>`

									if(modopago=='pago movil')
									{
										valor += `
										<div id="divtelefono" class="row p-2 my-2">
											<label for="tel">Número de teléfono: </label>
											<div class="row">
												<div class="col-md-11">
													<input class="form-control" type="text" name="" id="teld" value="${telefono}" readonly>
												</div>
												<div class="col-md-1">
													<a style="cursor:pointer" onclick="volver('4','0')">
														<img class="" src="/bootstrap-icons/icons/pencil.svg" />
													</a>
												</div>
											</div>
										</div>
										`
									}
									else
									{
										valor += `
											<div id="divnrocuenta" class="row p-2 my-2">
												<label for="nrocuenta">Número de cuenta: </label>
												<div class="row">
													<div class="col-md-11">
														<input class="form-control" type="text" name="" id="nrocuentad" value="${nrocuenta}" readonly>
													</div>
													<div class="col-md-1">
														<a style="cursor:pointer" onclick="volver('4','0')">
															<img class="" src="/bootstrap-icons/icons/pencil.svg" />
														</a>
													</div>
												</div>
											</div>`
									}
									valor += `
									<div class="row p-2 my-2">
										<label for="monto1">Monto: </label>
										<div class="row">
											<div class="col-md-11">
												<input class="form-control" type="text" name="" id="montod" value="${monto}" readonly>
											</div>
											<div class="col-md-1">
												<a style="cursor:pointer" onclick="volver('5','0')">
													<img class="" src="/bootstrap-icons/icons/pencil.svg" />
												</a>
											</div>
										</div>
									</div>
									<div class="row p-2 my-2">
										<label for="referencia1">Número de referencia: </label>
										<div class="row">
											<div class="col-md-11">
												<input class="form-control" type="text" name="" id="referenciad" value="${referencia}" readonly>
											</div>
											<div class="col-md-1">
												<a style="cursor:pointer" onclick="volver('6','0')">
													<img class="" src="/bootstrap-icons/icons/pencil.svg" />
												</a>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
		        	`
		        	div.innerHTML = valor;

		        	return div;
		        }

		        function validarFormulario(evento) {
					evento.preventDefault();
				  	var metodopago1 = document.getElementById('metodopago1').value;
				  	if(metodopago1.length == 0) {
				    	alert('No has seleccionado nada en el metodo de pago');
				    	return;
				  	}
				  	var banco1 = document.getElementById('banco1').value;
				  	if (banco1.length == 0) {
				    	alert('No has seleccionado nada en el banco');
				    	return;
				  	}
				  	var fecha1 = document.getElementById('fecha1').value;
				  	if (fecha1.length == 0) {
				    	alert('No has seleccionado nada en la fecha');
				    	return;
				  	}

				  	if(modopago == 'pago movil')
				  	{
				  		var telefono1 = document.getElementById('tel').value;
					  	if (banco1.length == 0) {
					    	alert('No has seleccionado nada en el banco');
					    	return;
					  	}
				  	}
				  	else
				  	{
				  		var nrocuenta1 = document.getElementById('nrocuenta').value;
					  	if (nrocuenta.length == 0) {
					    	alert('No has seleccionado nada en la cuenta');
					    	return;
					  	}
				  	}
				  	var monto1 = document.getElementById('monto1').value;
				  	if (monto1.length == 0) {
				    	alert('No has seleccionado nada en el monto');
				    	return;
				  	}
				  	var referencia1 = document.getElementById('referencia1').value;
				  	if (referencia1.length == 0) {
				    	alert('No has seleccionado nada en la referencia');
				    	return;
				  	}
				  	
				  	this.submit();
				}
		    </script>

		</div>
	</div>
@endsection

<script type="text/javascript">
	function copiar()
	{
  		var origen = document.getElementById('telefono');
  		var destino = document.getElementById('target2');
  		var copyFrom = document.createElement("textarea");
  		copyFrom.textContent = origen.value;
  		var body = document.getElementsByTagName('body')[0];
  		body.appendChild(copyFrom);
  		copyFrom.select();
  		document.execCommand('copy');
  		body.removeChild(copyFrom);
  		destino.focus();
  		document.execCommand('paste');
	}
</script>