<div>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                        <h1 class="m-0 text-dark">
                        @if($controlActivity)
                            <span>Editar Producto</span>
                        @else
                            <span>Crear Producto</span>
                        @endif
                    </h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/admin/dashboard">Escritorio</a></li>
                        <li class="breadcrumb-item active"><a href="/listProducts/{{$comercio->user_id}}">Comercios</a></li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            @if($comercio)
            <div class="row">
                <div class="col-lg-12">
                    <div class="card w-50">
                        <div class="row p-2">
                            <div class="col-lg-2">
                                <span>Propietario</span>
                            </div>
                            <div class="col-lg-10">
                                <label class="form-control">{{$comercio->propietario()}}</label>
                            </div>
                        </div>
                        <div class="row p-2">
                            <div class="col-lg-2">
                                <span>Comercio: </span>
                            </div>
                            <div class="col-lg-10">                                
                                <div class="input-group mb-3">
                                    <label class="form-control">{{$comercio->name}}</label>
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <input type="checkbox"> <span class="ml-1"> Aplicar a mis comercios</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-xl-12">
                                    <div class="row">
                                        <div class="col-xl-6 col-md-6">
                                            <div class="form-group" wire:ignore>
                                                <label for="name">Categoría</label>
                                                <select wire:model.defer="state.category_id" class="form-control @error('category_id') is-invalid @enderror" id="category_id" wire:change="changeCategory( $event.target.value, 0)">
                                                    <option value="0">Seleccione una opción</option>
                                                    @foreach($comercio->categories as $category)
                                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('category_id')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                            <div class="form-group" wire:ignore>
                                                <label for="name">Subcategoría</label>
                                                <select wire:model.defer="state.subcategory_id" class="subcategory form-control @error('subcategory_id') is-invalid @enderror" id="subcategory_id" wire:ignore>
                                                </select>
                                                @error('subcategory_id')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="code_lote">Código del Lote</label>
                                                <input type="text" wire:model.defer="state.code_lote" autofocus class="font-costo form-control @error('code_lote') is-invalid @enderror" id="code_lote">
                                                @error('code_lote')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="code">Código del Producto</label>
                                                <input type="text" wire:model.defer="state.code"  id="code" class="font-costo form-control @error('code') is-invalid @enderror" autofocus >
                                                @error('code')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="name">Nombre del Producto</label>
                                                <input type="text" wire:model.defer="state.name"  id="name" class="font-costo form-control @error('name') is-invalid @enderror" autofocus >
                                                @error('name')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="brand_id">Marca</label>
                                                <div class="input-group mb-3">
                                                    <select wire:model.defer="state.brand_id"  id="brand_id" class="font-costo form-control @error('brand_id') is-invalid @enderror" autofocus >
                                                        <option value="0">Seleccione una opción</option>
                                                        @foreach($brands as $brand)
                                                            <option value="{{$brand->id}}">{{$brand->name}}</option>
                                                        @endforeach
                                                    </select>
                                                    
                                                    <div class="input-group-append">
                                                        <div class="input-group-text">
                                                            <a href=""><span class="fas fa-plus"></span></a>
                                                        </div>
                                                    </div>
                                                    @error('brand_id')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="container_id">Contenedor</label>
                                                <div class="input-group mb-3">
                                                    <select wire:model.defer="state.container_id"  id="container_id" class="font-costo form-control @error('container_id') is-invalid @enderror" autofocus >
                                                        <option value="0">Seleccione una opción</option>
                                                        @foreach($containers as $container)
                                                            <option value="{{$container->id}}">{{$container->name}}</option>
                                                        @endforeach
                                                    </select>
                                                    <div class="input-group-append">
                                                        <div class="input-group-text">
                                                            <a href=""><span class="fas fa-plus"></span></a>
                                                        </div>
                                                    </div>
                                                    @error('container_id')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-md-6">
                                            <div class="form-group">
                                                <label for="customFile">Imagen 1 del Producto</label>
                                                <div class="custom-file">
                                                    <div x-data="{ isUploading: false, progress: 5 }" x-on:livewire-upload-start="isUploading = true" x-on:livewire-upload-finish="isUploading = false; progress = 5" x-on:livewire-upload-error="isUploading = false" x-on:livewire-upload-progress="progress = $event.detail.progress">
                                                        <input wire:model="photo" type="file" class="custom-file-input" id="customFile">
                                                        <div x-show.transition="isUploading" class="progress progress-sm mt-2 rounded">
                                                            <div class="progress-bar bg-primary progress-bar-striped" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" x-bind:style="`width: ${progress}%`">
                                                                <span class="sr-only">40% Completo (exito)</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <label class="custom-file-label" for="customFile">
                                                        @if ($photo)
                                                        {{ $photo->getClientOriginalName() }}
                                                        @else
                                                        Seleccione la imagen
                                                        @endif
                                                    </label>
                                                </div>

                                                @if ($photo)
                                                <img src="{{ $photo->temporaryUrl() }}" class="img d-block mt-2 w-100 rounded">
                                                @else
                                                <img src="{{ $state['avatar_url'] ?? '' }}" class="img d-block mb-2 w-100 rounded">
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                <label for="customFile">Imagen 1 del Producto</label>
                                                <div class="custom-file">
                                                    <div x-data="{ isUploading: false, progress: 5 }" x-on:livewire-upload-start="isUploading = true" x-on:livewire-upload-finish="isUploading = false; progress = 5" x-on:livewire-upload-error="isUploading = false" x-on:livewire-upload-progress="progress = $event.detail.progress">
                                                        <input wire:model="photo" type="file" class="custom-file-input" id="customFile">
                                                        <div x-show.transition="isUploading" class="progress progress-sm mt-2 rounded">
                                                            <div class="progress-bar bg-primary progress-bar-striped" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" x-bind:style="`width: ${progress}%`">
                                                                <span class="sr-only">40% Completo (exito)</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <label class="custom-file-label" for="customFile">
                                                        @if ($photo)
                                                        {{ $photo->getClientOriginalName() }}
                                                        @else
                                                        Seleccione la imagen
                                                        @endif
                                                    </label>
                                                </div>

                                                @if ($photo)
                                                <img src="{{ $photo->temporaryUrl() }}" class="img d-block mt-2 w-100 rounded">
                                                @else
                                                <img src="{{ $state['avatar_url'] ?? '' }}" class="img d-block mb-2 w-100 rounded">
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                <label for="customFile">Imagen 1 del Producto</label>
                                                <div class="custom-file">
                                                    <div x-data="{ isUploading: false, progress: 5 }" x-on:livewire-upload-start="isUploading = true" x-on:livewire-upload-finish="isUploading = false; progress = 5" x-on:livewire-upload-error="isUploading = false" x-on:livewire-upload-progress="progress = $event.detail.progress">
                                                        <input wire:model="photo" type="file" class="custom-file-input" id="customFile">
                                                        <div x-show.transition="isUploading" class="progress progress-sm mt-2 rounded">
                                                            <div class="progress-bar bg-primary progress-bar-striped" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" x-bind:style="`width: ${progress}%`">
                                                                <span class="sr-only">40% Completo (exito)</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <label class="custom-file-label" for="customFile">
                                                        @if ($photo)
                                                        {{ $photo->getClientOriginalName() }}
                                                        @else
                                                        Seleccione la imagen
                                                        @endif
                                                    </label>
                                                </div>

                                                @if ($photo)
                                                <img src="{{ $photo->temporaryUrl() }}" class="img d-block mt-2 w-100 rounded">
                                                @else
                                                <img src="{{ $state['avatar_url'] ?? '' }}" class="img d-block mb-2 w-100 rounded">
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Detalles -->
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="details1">Detalle 1</label>
                                                <input type="text" wire:model.defer="state.details1" autofocus class="font-costo form-control @error('details1') is-invalid @enderror" id="details1">
                                                @error('details1')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="details2">Detalle 2</label>
                                                <input type="text" wire:model.defer="state.details2" autofocus class="font-costo form-control @error('details2') is-invalid @enderror" id="details2">
                                                @error('details2')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="description">Descripción</label>
                                                <input type="text" wire:model.defer="state.description" autofocus class="font-costo form-control @error('description') is-invalid @enderror" id="description">
                                                @error('description')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Precios detal -->
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="price1">Precio 1</label>
                                                <input type="number" wire:model.defer="state.price1" autofocus class="font-costo form-control @error('price1') is-invalid @enderror" id="price1">
                                                @error('price1')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="price2">Precio 2</label>
                                                <input type="number" wire:model.defer="state.price2" autofocus class="font-costo form-control @error('price2') is-invalid @enderror" id="price2">
                                                @error('price2')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="profit_price">Ganancia (%)</label>
                                                <input type="number" wire:model.defer="state.profit_price" autofocus class="font-costo form-control @error('profit_price') is-invalid @enderror" id="profit_price">
                                                @error('profit_price')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Precios al Mayor wholesaler  -->
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="price_mayor">Precio al Mayor</label>
                                                <input type="number" wire:model.defer="state.price_mayor" autofocus class="font-costo form-control @error('price_mayor') is-invalid @enderror" id="price_mayor">
                                                @error('price_mayor')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="profit_mayor">Ganancia (%)</label>
                                                <input type="number" wire:model.defer="state.profit_mayor" autofocus class="font-costo form-control @error('profit_mayor') is-invalid @enderror" id="profit_mayor">
                                                @error('profit_mayor')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Precios de Oferta  -->
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="price_offer">Precio de Oferta</label>
                                                <input type="number" wire:model.defer="state.price_offer" autofocus class="font-costo form-control @error('price_offer') is-invalid @enderror" id="price_offer">
                                                @error('price_offer')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="profit_offer">Ganancia (%)</label>
                                                <input type="number" wire:model.defer="state.profit_offer" autofocus class="font-costo form-control @error('profit_offer') is-invalid @enderror" id="profit_offer">
                                                @error('profit_offer')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Precios de Divisa  -->
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="price_divisa">Precio de la Divisa</label>
                                                <input type="number" wire:model.defer="state.price_divisa" autofocus class="font-costo form-control @error('price_divisa') is-invalid @enderror" id="price_divisa">
                                                @error('price_divisa')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Delivery  -->
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="delivery">Delivery</label>
                                                <select type="number" wire:model.defer="state.delivery" autofocus class="font-costo form-control @error('delivery') is-invalid @enderror" id="delivery">
                                                    <option value="SI">SI</option>
                                                    <option value="NO">NO</option>
                                                </select>
                                                @error('delivery')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="shipping_cost">Costo de Envio</label>
                                                <input type="number" wire:model.defer="state.shipping_cost" autofocus class="font-costo form-control @error('shipping_cost') is-invalid @enderror" id="shipping_cost">
                                                @error('shipping_cost')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Stock -->
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="stock_min">Stock Mínimo</label>
                                                <input type="number" wire:model.defer="state.stock_min" autofocus class="font-costo form-control @error('stock_min') is-invalid @enderror" id="stock_min">
                                                @error('stock_min')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="stock_max">Stock Máximo</label>
                                                <input type="number" wire:model.defer="state.stock_max" autofocus class="font-costo form-control @error('stock_max') is-invalid @enderror" id="stock_max">
                                                @error('stock_max')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="stock">Stock</label>
                                                <input type="number" wire:model.defer="state.stock" autofocus class="font-costo form-control @error('stock') is-invalid @enderror" id="stock">
                                                @error('stock')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Proveedor -->
                                    <div class="form-group col-md-4" wire:ignore>
                                        <label for="supplier_id">Proveedor</label>
                                        <div class="input-group mb-3">
                                            <select wire:model.defer="state.supplier_id"  id="supplier_id" class="font-costo form-control @error('supplier_id') is-invalid @enderror" autofocus >
                                                <option value="0">Seleccione una opción</option>
                                                @foreach($suppliers as $supplier)
                                                    <option value="{{$supplier->id}}">{{$supplier->name}}</option>
                                                @endforeach
                                            </select>
                                            
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <a href=""><span class="fas fa-plus"></span></a>
                                                </div>
                                            </div>
                                            @error('supplier_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Caracteristica del paquete -->
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="pack_price">Precio del Paquete</label>
                                                <input type="number" wire:model.defer="state.pack_price" autofocus class="font-costo form-control @error('pack_price') is-invalid @enderror" id="pack_price">
                                                @error('pack_price')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="tx_peso">Peso</label>
                                                <input type="text" wire:model.defer="state.tx_peso" autofocus class="font-costo form-control @error('tx_peso') is-invalid @enderror" id="tx_peso">
                                                @error('tx_peso')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="tx_tamanio">Tamaño</label>
                                                <input type="text" wire:model.defer="state.tx_tamanio" autofocus class="font-costo form-control @error('tx_tamanio') is-invalid @enderror" id="tx_tamanio">
                                                @error('tx_tamanio')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="tx_presentacion">Presentacion</label>
                                                <input type="text" wire:model.defer="state.tx_presentacion" autofocus class="font-costo form-control @error('tx_presentacion') is-invalid @enderror" id="tx_presentacion">
                                                @error('tx_presentacion')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Caracteristica del paquete -->
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="tx_tamanio_carga">Tamaño de carga</label>
                                                <input type="text" wire:model.defer="state.tx_tamanio_carga" autofocus class="font-costo form-control @error('tx_tamanio_carga') is-invalid @enderror" id="tx_tamanio_carga">
                                                @error('tx_tamanio_carga')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="tx_tamanio_venta">Tamaño de Venta</label>
                                                <input type="text" wire:model.defer="state.tx_tamanio_venta" autofocus class="font-costo form-control @error('tx_tamanio_venta') is-invalid @enderror" id="tx_tamanio_venta">
                                                @error('tx_tamanio_venta')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="tx_contornos">Contorno</label>
                                                <input type="text" wire:model.defer="state.tx_contornos" autofocus class="font-costo form-control @error('tx_contornos') is-invalid @enderror" id="tx_contornos">
                                                @error('tx_contornos')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="tx_contiene">Contenido</label>
                                                <input type="text" wire:model.defer="state.tx_contiene" autofocus class="font-costo form-control @error('tx_contiene') is-invalid @enderror" id="tx_contiene">
                                                @error('tx_contiene')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Caracteristica del paquete -->
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="fe_vencimiento">Fecha de Vencimiento</label>
                                                <input type="date" wire:model.defer="state.fe_vencimiento" autofocus class="font-costo form-control @error('fe_vencimiento') is-invalid @enderror" id="fe_vencimiento">
                                                @error('fe_vencimiento')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="fe_expedicion">Fecha de Expedicion</label>
                                                <input type="date" wire:model.defer="state.fe_expedicion" autofocus class="font-costo form-control @error('fe_expedicion') is-invalid @enderror" id="fe_expedicion">
                                                @error('fe_expedicion')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="tx_alergenos">Alergenos</label>
                                                <input type="text" wire:model.defer="state.tx_alergenos" autofocus class="font-costo form-control @error('tx_alergenos') is-invalid @enderror" id="tx_alergenos">
                                                @error('tx_alergenos')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="tx_adicionales">Contenido Adicional</label>
                                                <textarea wire:model.defer="state.tx_adicionales" autofocus class="font-costo form-control @error('tx_adicionales') is-invalid @enderror" id="tx_adicionales">
                                                </textarea>
                                                @error('tx_adicionales')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Caracteristica del paquete -->
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <input type="checkbox" wire:model.defer="state.in_pedido" autofocus class="my-2 @error('in_pedido') is-invalid @enderror" id="in_pedido"> <span class="font-costo my-2">En pedido</span>
                                                @error('in_pedido')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <input type="checkbox" wire:model.defer="state.in_envio_gratis" autofocus class="my-2 @error('in_envio_gratis') is-invalid @enderror" id="in_envio_gratis"> <span class="font-costo my-2">Envio gratis</span>
                                                @error('in_envio_gratis')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group my-2">
                                                <input type="checkbox" wire:model.defer="state.in_fragil" autofocus class="my-2 @error('in_fragil') is-invalid @enderror" id="in_fragil"> <span class="font-costo my-2">Es frágil</span>
                                                @error('in_fragil')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group my-2">
                                                <input type="checkbox" wire:model.defer="state.in_oferta" autofocus class="my-2 @error('in_oferta') is-invalid @enderror" id="in_oferta"> <span class="font-costo my-2">En Oferta</span>
                                                @error('in_oferta')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        
                                    </div>

                                    <!-- Caracteristica del paquete -->
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="tx_valores_nutricionales">Valores Nutricionales</label>
                                                <input type="text" wire:model.defer="state.tx_valores_nutricionales" autofocus class="font-costo form-control @error('tx_valores_nutricionales') is-invalid @enderror" id="tx_valores_nutricionales">
                                                @error('tx_valores_nutricionales')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="tx_conservacion">Conservacion</label>
                                                <input type="text" wire:model.defer="state.tx_conservacion" autofocus class="font-costo form-control @error('tx_conservacion') is-invalid @enderror" id="tx_conservacion">
                                                @error('tx_conservacion')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="tx_recomendacion_consumo">Recomendación Consumo</label>
                                                <input type="text" wire:model.defer="state.tx_contornos" autofocus class="font-costo form-control @error('tx_recomendacion_consumo') is-invalid @enderror" id="tx_recomendacion_consumo">
                                                @error('tx_recomendacion_consumo')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="tx_envase_embalaje">Envase Embalaje</label>
                                                <input type="text" wire:model.defer="state.tx_envase_embalaje" autofocus class="font-costo form-control @error('tx_envase_embalaje') is-invalid @enderror" id="tx_envase_embalaje">
                                                @error('tx_envase_embalaje')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Caracteristica del paquete -->
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="tx_datos_vencimiento">Datos Vencimiento</label>
                                                <input type="text" wire:model.defer="state.tx_datos_vencimiento" autofocus class="font-costo form-control @error('tx_datos_vencimiento') is-invalid @enderror" id="tx_datos_vencimiento">
                                                @error('tx_datos_vencimiento')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <input type="checkbox" wire:model.defer="state.in_por_encargo" autofocus class="my-2 @error('in_por_encargo') is-invalid @enderror" id="in_envio_gratis"> <span class="font-costo my-2">Por Encargo</span>
                                                @error('in_por_encargo')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group my-2">
                                                <input type="checkbox" wire:model.defer="state.in_olor_fuerte" autofocus class="my-2 @error('in_olor_fuerte') is-invalid @enderror" id="in_olor_fuerte"> <span class="font-costo my-2">Olor Fuerte</span>
                                                @error('in_olor_fuerte')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group my-2">
                                                <input type="checkbox" wire:model.defer="state.in_valido" autofocus class="my-2 @error('in_valido') is-invalid @enderror" id="in_valido"> <span class="font-costo my-2">Es Valido</span>
                                                @error('in_valido')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Caracteristica del paquete -->
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="tx_vencimiento">Vencimiento</label>
                                                <input type="text" wire:model.defer="state.tx_vencimiento" autofocus class="font-costo form-control @error('tx_vencimiento') is-invalid @enderror" id="tx_vencimiento">
                                                @error('tx_vencimiento')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="ca_valoracion">Calificación de Valoracion</label>
                                                <input type="text" wire:model.defer="state.ca_valoracion" autofocus class="font-costo form-control @error('ca_valoracion') is-invalid @enderror" id="ca_valoracion">
                                                @error('ca_valoracion')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer d-flex justify-content-between">
                            <a href="/listProducts/{{$comercio->id}}" type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times mr-1"></i> Cancelar</a>
                            <button type="submit" class="btn btn-primary"><i class="fa fa-save mr-1"></i>
                                @if($controlActivity)
                                <span>Guardar Cambios</span>
                                @else
                                <span>Guardar</span>
                                @endif
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->

    
        <script>

            window.onpageshow = function() {

                window.addEventListener('sendSubcategories', event => {
                    
                    let subcategories = event.detail.subcategories

                    let subcategory = event.detail.subcategory

                    let msg = event.detail.msg

                    let select = document.querySelector('.subcategory')
                    
                    select.innerHTML = ''

                    var option = `<option value="0">${msg}</option>`
                    
                    subcategories.forEach(function(numero) {
                        
                        if(numero['name'] == subcategory){
                            option += `<option value="${numero['id']}" selected>${numero['name']}</option>`
                        }else{
                            option += `<option value="${numero['id']}">${numero['name']}</option>`
                        }
                        
                    });
                    
                    select.innerHTML = option
                
                }) 
            }
        </script>
</div>

