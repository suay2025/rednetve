<div class="container-fluid overflow-auto" >    
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><i class="fa fa-regular fa-paper-plane"></i> Envio / Pickup <img src="/img/envio_pickup_i.png" alt=""></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active"><a href="/listPedidosCliente">Mis Pedidos</a></li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- /.col -->
                <div class="col-md-12 d-flex">
                    <div class="card mx-auto" x-data="{ currentTab: $persist('changePickup') }" style="width: 52rem;">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills" wire:ignore>
                                <li @click.prevent="currentTab = 'changeEnvio'" class="nav-item"><a class="nav-link mx-3" :class="currentTab === 'changeEnvio' ? 'active' : ''" href="#changeEnvio" data-toggle="tab"><i class="fa fa-regular fa-paper-plane"></i> Envío</a></li>
                                <li @click.prevent="currentTab = 'changePickup'" class="nav-item"><a class="nav-link mx-3" :class="currentTab === 'changePickup' ? 'active' : ''" href="#changePickup" data-toggle="tab"><img style="width: 20px;" src="/img/envio_pickup_i.png" alt=""> Pickup</a></li>
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">

                                <div class="tab-pane" :class="currentTab === 'changeEnvio' ? 'active' : ''" id="changeEnvio" wire:ignore.self>
                                    @livewire('afiliado.shipping-envio', ['nropedido' => $nropedido])
                                </div>

                                <div class="tab-pane" :class="currentTab === 'changePickup' ? 'active' : ''" id="changePickup" wire:ignore.self>
                                    @livewire('afiliado.shipping-centrodistribucion', ['nropedido' => $nropedido])
                                </div>
                                <!-- /.tab-pane -->
                            </div>
                            <!-- /.tab-content -->
                        </div><!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

</div>

@push('styles')
@endpush

@push('alpine-plugins')
<!-- Alpine Plugins -->
<script defer src="https://unpkg.com/@alpinejs/persist@3.x.x/dist/cdn.min.js"></script>
@endpush

@push('js')
<script>
    $(document).ready(function () {
        Livewire.on('nameChanged', (changedName) => {
            $('[x-ref="username"]').text(changedName);
        })
    });
</script>
@endpush
