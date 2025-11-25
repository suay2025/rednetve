
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js@9.0.1/public/assets/styles/choices.min.css"/>
<script src="https://cdn.jsdelivr.net/npm/choices.js@9.0.1/public/assets/scripts/choices.min.js"></script>

<style>
    .sinborde {
        border: 0!important;
        background-color: #FFF!important;
        color: #000!important;
    }
</style>
<div class="container-fluid mx-3">
    <div class="row">
        <div class="col-lg-6 text-center">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                    <div class="col-lg-12">
                        <div class="card w-50">
                            <div class="row">
                                <div class="col-lg-6">
                                    <span>Dueño: </span>
                                </div>
                                <div class="col-lg-6">
                                    <span>XXX XXXX</span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <span>Comercio: </span>
                                </div>
                                <div class="col-lg-6">
                                    <span>XXX XXXX</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
                <div class="card-footer">
                    Utiliza nuestra
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 text-center">
            <span style="font-weight:Bold">FINALIZAR COMPRA</span>
        </div>
    </div>
    <hr style="background-color:red;">
    <!-- LOGIN -->
     <div class="row">
        <div class="col-lg-12">
            <div class="accordion accordion-flush" id="accordionFlushExample">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingOne">
                    <i class="fa fa-solid fa-user"></i>
                    ¿Ya eres cliente?
                    <a class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                        Haz clic aquí para acceder
                    </a>
                    </h2>
                    <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">
                                <form action="{{ route('login') }}" method="POST">
                                    @csrf                                    
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <label for="email">Ingrese su correo electrónico</label>
                                            <input type="email" name="email" class="form-control" placeholder="Correo Electrónico" id="email">
                                            @error('email')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-lg-6">
                                            <label for="passwword">Contraseña</label>
                                            <input type="password" name="password" id="password-field" class="form-control" placeholder="Contraseña" value="12345678"/>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12 text-center">Recuerdame <input type="checkbox"></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 text-center">
                                            <button type="submit" class="boton w-25">Entrar</button>
                                        </div>
                                    </div>
                                </form>
                                <div class="row">            
                                    <div class="col-md-12 text-center">
                                        <span>No tienes cuenta o perfil? </span>
                                        <a href="/inforegistro">Regístrate</a>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 text-center">              
                                        <span>Olvidé mi </span>
                                        <a href="">Contraseña</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>    
            </div>
        </div>
    </div>
    <!-- SELECCIONA MONEDA -->
    <div>
        <div class="col-lg-12">
            <label for="tipomoneda">SELECCIONA LA MONEDA CON QUE DESEAS PAGAR</label>
            <select class="form-control w-25"  name="tipomoneda" id="tipomoneda">
                <option value="bolivar">BOLIVARES</option>
                <option value="dolar">DOLAR</option>
            </select>
        </div>
    </div>
    <form action="{{ route('login') }}" method="POST">
    @csrf                                    
    <div class="row">
        <!-- ZONA DE LA FACTURACION -->
        <div class="col-lg-6">
            <div class="row">
                <div class="col-12">
                    Facturación y envío
                </div>                
            </div>
            <hr>
            <form action="">
            <div class="row">
                <div class="col-lg-6">
                    <label for="name">Nombre <span class="text-red">*</span></label>
                    <input type="text" id="name" class="form-control">
                </div>
                <div class="col-lg-6">
                    <label for="lastname">Apellido <span class="text-red">*</span></label>
                    <input type="text" id="lastname" class="form-control">
                </div>

            </div>
            <div class="row">
                <div class="col-lg-12">
                    <label for="company">Nombre de la Empresa (opcional)</label>
                    <input type="text" id="company" class="form-control">
                </div>                
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <label for="pais">País / Región <span class="text-red">*</span></label>
                    <input type="text" id="pais" class="form-control sinborde" disabled borde="0" value="Venezuela" style ="display">
                </div>                
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <label for="pais">Estado <span class="text-red">*</span></label>
                    <select class="form-control choices-single">
                    <option></option>
                    <option value="AZ">Arizona</option>
                    <option value="CO">Colorado</option>
                    <option value="ID">Idaho</option>
                    <option value="MT">Montana</option>
                    <option value="NE">Nebraska</option>
                    <option value="NM">New Mexico</option>
                    <option value="ND">North Dakota</option>
                    <option value="UT">Utah</option>
                    <option value="WY">Wyoming</option>
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <label for="city">Ciudad <span class="text-red">*</span></label>
                    <input type="text" id="city" class="form-control">
                </div>                
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <label for="address">Dirección <span class="text-red">*</span></label>
                    <input type="text" id="address" class="form-control">
                </div>                
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <label for="zipcode">Código Postal <span class="text-red">*</span></label>
                    <input type="text" id="zipcode" class="form-control">
                </div>                
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <label for="phone">Teléfono (opcional)</span></label>
                    <input type="text" id="zipcode" class="form-control">
                </div>                
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <label for="email">Dirección de Correo <span class="text-red">*</span></span></label>
                    <input type="email" id="email" class="form-control">
                </div>                
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <label for="typeId">Tipo de Identificación <span class="text-red">*</span></label>
                    <select class="form-control" name="" id="typeId">
                        <option value="J">J-</option>
                        <option value="E">E-</option>
                        <option value="G">G-</option>
                        <option value="P">P-</option>
                        <option value="V">V-</option>
                    </select>
                </div>
                <div class="col-lg-6">
                    <label for="personalId">Número Identificación <span class="text-red">*</span></label>
                    <input type="text" id="identificacion" class="form-control">
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <label for="premovil">Prefijo Celular <span class="text-red">*</span></label>
                    <select class="form-control" name="" id="premovil">
                        <option value="0412">0412</option>
                        <option value="0412">0414</option>
                        <option value="0412">0424</option>
                        <option value="0412">0416</option>
                        <option value="0412">0426</option>
                    </select>
                </div>
                <div class="col-lg-6">
                    <label for="movil">Número Celular <span class="text-red">*</span></label>
                    <input type="text" id="movil" class="form-control">
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <label for="userName">Nombre de Usuario<span class="text-red">*</span></label>
                    <input type="text" id="userName" class="form-control">
                </div>                
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <label for="password">Crear una Contraseña para la Cuenta<span class="text-red">*</span></label>
                    <input type="password" id="password" class="form-control">
                </div>                
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <label for="info">INFORMACIÓN ADICIONAL<span class="text-red">*</span></label>
                </div>                
            </div>
            <hr>

            <div class="row">
                <div class="col-lg-12">
                    <label for="notapedido">Notas del pedido (opcional)<span class="text-red">*</span></label>
                    <input type="text" id="notapedido" class="form-control">
                </div>                
            </div>

            </form>

        </div>
        <!-- ZONA DEL PEDIDO Y PAGO -->
         <div class="col-lg-6">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="card">
                        <h4 class="text-center my-3">TU PEDIDO</h4>
                        <div class="card-body">
                            <table class="table" borde='0'>
                                <thead>
                                    <tr>
                                    <th class="text-left" scope="col" style="width: 80%;">Producto</th>
                                    <th class="text-center" scope="col" style="width: 20%;">SubTotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr id="descripcion">
                                        <td class="text-left" scope="row">Set de Coctelera Europea 500ML 
                                        × 1</td>
                                        <td class="text-right"><span>30.00</span><span id="moneda">$</span></td>
                                    </tr>
                                    <tr>
                                        <td class="text-left">Subtotal</td>
                                        <td class="text-right">30.00 $</td>
                                    </tr>
                                    <tr id="envio">
                                        <td colspan="2">
                                            <div class="row">
                                                <div class="col-md-2 text-left">Envío</div>
                                                <div class="col-md-10 text-justify">Introduce tu dirección para ver las opciones de envío.</div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-left">Total</td>
                                        <td class="text-right">30.00 $</td>
                                    </tr>
                                </tbody>
                            </table>
                            <h4 class="text-center my-3">MÉTODOS DE PAGOS</h4>
                            <div class="row">
                                <div class="col-md-4 p-1">
                                    <div class="card btn" style="width: 100%; height:180px; border: 1px solid #000;">
                                        <img width="150" src="/img/visa-mastercard.png" class="card-img-top" alt="...">
                                        <div class="card-footer">
                                            Tarjetas
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 p-1">
                                    <div class="card btn" style="width: 100%; height:180px; border: 1px solid #000;">
                                        <img width="150" src="/img/transferencia.png" class="card-img-top" alt="...">
                                        <div class="card-footer">
                                            Transferencia
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 p-1">
                                    <div class="card btn" style="width: 100%; height:180px; border: 1px solid #000;">
                                        <img width="150" src="/img/pagomovil.png" class="card-img-top" alt="...">
                                        <div class="card-footer">
                                            Pago Móvil
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 p-1">
                                    <div class="card btn" style="width: 100%; height:180px; border: 1px solid #000;">
                                        <img width="150" src="/img/zelle.png" class="card-img-top" alt="...">
                                        <div class="card-footer">
                                            Pago Móvil
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-lg-12 text-justify">
                                    <p>Tus datos personales se utilizarán para procesar tu pedido, mejorar tu experiencia en esta web y otros propósitos descritos en nuestros 
                                    <span class="text-red">Términos y Condiciones.</span></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 text-justify">
                                    <p> <input type="checkbox"> He leído y estoy de acuerdo con los <span class="text-red">términos y condiciones</span> de la web <span class="text-red">*</span>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-lg-12 text-center">
                                    <button class="btn btn-danger form-control w-75">Realizar Pedido</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
         </div>
    </div>
    </form>
</div>
@push('js')
<script>
    new Choices(document.querySelector(".choices-single"));
</script>
@endpush
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>