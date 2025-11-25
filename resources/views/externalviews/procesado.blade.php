<link rel="stylesheet" href="/css/bootstrap.min.css">
<link rel="stylesheet" href="/css/app.css">

@livewire('layouts.navbar-checkout')

<div class="container-fluid">
    <div>
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark"></h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item active"><a href="/listPedidosCliente">Mis Pedidos</a></li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card" style="width: 100% !important;">
                            <div class="card-body text-center">
                                <h1>Operación procesada con éxito</h1>
                                <h4>Nro Pedido: <span class="bg-warning p-1 rounded">{{$nropedido}}</span></h4>
                                <p>
                                    Su pago esta siendo validado por nuestro equipo de venta
                                </p>
                                <p>
                                    <a class="h5 text-titulo" href="/">Seguir comprando</a>
                                </p>
                                <p >
                                    <a class="h5 text-titulo" href="/listPedidosCliente">Mis Pedidos</a>
                                </p>
                                <p class="h4">
                                    Ponte en contacto con nuestro equipo a través de nuestro whatsapp: 
                                    <a href="https://api.whatsapp.com/send?phone=+58{{$comercio->contactcellphone}}&text={{ $comercio->msgcontact}}" target="_blank">{{$comercio->contactcellphone}}</a> 
                                </p>
                            </div>
                            <div class="card-footer d-flex justify-content-end">
                                
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->

        <!-- Modal -->
        

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