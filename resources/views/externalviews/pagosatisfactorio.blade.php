<link rel="stylesheet" href="/css/bootstrap.min.css">
<link rel="stylesheet" href="/css/app.css">


<div class="container-fluid">
    <div>
        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card" style="width: 100% !important;">
                            <div class="card-body text-center">
                                <h1>Operación procesada con éxito</h1>
                                <p>
                                    Su pago esta siendo validado por nuestro equipo de venta
                                </p>
                                <h3>¿Qué desea hacer ahora?</h3>
                                <p>
                                    <a target="_parent" class="h5 text-titulo" href="/">Seguir comprando</a>
                                </p>
                                <p >
                                    <a target="_parent" class="h5 text-titulo" href="/listPedidosCliente">Ir a Mis Pedidos</a>
                                </p>
                                <p>
                                    Ponte en contacto con nuestro equipo
                                    <a href="https://api.whatsapp.com/send?phone=+58{{$comercio->contactcellphone}}&text={{ $comercio->msgcontact}}" target="_blank">{{$comercio->contactcellphone}}</a> 
                                </p>
                            </div>
                            <div class="card-footer d-flex justify-content-end">
                                <button class="btn btn-success" id="salir">Salir</button><span id="countdown">5</span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->

        <!-- Modal -->
        
        <script>
            let boton = document.getElementById('salir')
            boton.addEventListener('click', function(){
                window.parent.location.href= "/procesadoC";
            })

            window.onload=function() {
                
                window.parent.location.href= "/procesadoC";
                
            }
        </script>

    </div>
</div>

<script src="/js/app.js"></script>
<script src="/js/backend.js"></script>

<!-- <script src="/js/bootstrap.min.js"></script>
<script src="/js/bootstrap.bundle.min.js"></script>
<script src="/js/jquery-3.6.4.min.js"></script> -->
@stack('js')
@stack('before-livewire-scripts')
<livewire:scripts />
@stack('after-livewire-scripts')


@stack('alpine-plugins')
<!-- Alpine Core -->
<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
@push('js')

@endpush

<SCRIPT LANGUAGE="JavaScript">
// history.forward()
</SCRIPT>