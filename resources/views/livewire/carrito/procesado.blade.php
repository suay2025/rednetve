<div>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Procesado</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/admin/dashboard">Escritorio</a></li>
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
                        <div class="card-body">
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
