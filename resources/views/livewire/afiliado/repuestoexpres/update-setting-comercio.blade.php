<div>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Configuraciones de {{ $comercio->name }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/">Inicio</a></li>
                        <li class="breadcrumb-item active">Configuraciones</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Configuración General</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form wire:submit.prevent="updateSetting">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="siteName">Nombre del Sitio</label>
                                    <input wire:model.defer="state.site_name" type="text" class="form-control" id="siteName" placeholder="Ingrese el nombre del Sitio">
                                </div>
                                <div class="form-group">
                                    <label for="siteEmail">Email del Sitio</label>
                                    <input wire:model.defer="state.site_email" type="email" class="form-control" id="siteEmail" placeholder="Ingrese el email del Sitio">
                                </div>
                                <div class="form-group">
                                    <label for="siteTitle">Título del Sitio</label>
                                    <input wire:model.defer="state.site_title" type="text" class="form-control" id="siteTitle" placeholder="Ingrese el título del Sitio">
                                </div>
                                <div class="form-group">
                                    <label for="footerText">Texto del Pie de Página</label>
                                    <input wire:model.defer="state.footer_text" type="text" class="form-control" id="footerText" placeholder="Ingrese el texto del Pie de página">
                                </div>
                                
                                <div class="form-group">
                                    <div class="custom-control custom-switch">
                                        <input wire:model.defer="state.sidebar_collapse" type="checkbox" class="custom-control-input" id="sidebarCollapse">
                                        <label class="custom-control-label" for="sidebarCollapse">Colapsar Barra Lateral</label>
                                    </div>
                                    <!-- <label for="sidebar_collapse">Sidebar Collapse</label><br>
                                    <input wire:model.defer="state.sidebar_collapse" type="checkbox" id="sidebar_collapse"> -->
                                </div>

                                <div class="form-group">
                                    <label for="footerText">Moneda del Sitio</label>
                                    <select wire:model.defer="state.currency" class="form-control">
                                        <option value="Bs">BS</option>
                                        <option value="$">$</option>
                                        <option value="€">€</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="footerText">Usar por defecto API BCV ($)</label>
                                    <select wire:model.defer="state.api_bcv" class="form-control">
                                        <option value="NO">NO</option>
                                        <option value="SI">SI</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <div class="custom-control custom-switch">
                                        <input wire:model.defer="state.in_cellphonecontact" type="checkbox" class="custom-control-input" id="in_cellphonecontact">
                                        <label class="custom-control-label" for="in_cellphonecontact">Ícono de WhatsApp</label>
                                    </div>
                                    <!-- <label for="sidebar_collapse">Sidebar Collapse</label><br>
                                    <input wire:model.defer="state.sidebar_collapse" type="checkbox" id="sidebar_collapse"> -->
                                </div>

                                <div class="form-group">
                                    <div class="custom-control custom-switch">
                                        <input wire:model.defer="state.in_sliderprincipal" type="checkbox" class="custom-control-input" id="in_sliderprincipal">
                                        <label class="custom-control-label" for="in_sliderprincipal">Mostrar Slider Principal</label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="custom-control custom-switch">
                                        <input wire:model.defer="state.in_marcasproductos" type="checkbox" class="custom-control-input" id="in_marcasproductos">
                                        <label class="custom-control-label" for="in_marcasproductos">Mostrar Marcas Productos</label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="custom-control custom-switch">
                                        <input wire:model.defer="state.in_impuesto" type="checkbox" class="custom-control-input" id="in_impuesto">
                                        <label class="custom-control-label" for="in_impuesto">Calcular Impuestos</label>
                                    </div>
                                </div>

                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-save mr-1"></i>Guardar cambios</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@push('js')
<script>
    $('#sidebarCollapse').on('change', function() {
        $('body').toggleClass('sidebar-collapse');
    })
</script>
@endpush
