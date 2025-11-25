
<div class="row">
                <div class="col-md-3 col-12" wire:ignore>
                    <!-- Sección de busqueda -->
                    
                </div>
                <div class="col-md-9 col-12">
                    <div class="row">
                        <!-- Sección de categoría -->
                        <div class="col-md-12 col-12">
                            @livewire('components.section-catalogo', ['comercioId' => 1, 'parametro' => $parametro])
                        </div>        
                    </div>

                    <!-- Sección de Resultados -->
                    <div class="row bg">
                        <div class="col-md-12 col-12">
                            <span class="h4 mx-4">Resultado de: {{$parametro}} </span>  
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-12">
                            @if($parametro)
                                @forelse ($products as $index => $product)
                                    <div class="row  border border-1 ">
                                        <form class="d-flex col-md-12 col-12" action="/add" method="post">
                                            @csrf
                                            <input name="product_id" type="hidden" value="{{ $product->id }}">
                                            <input name="name" type="hidden" value="{{ $product->name }}">
                                            <input name="price1" type="hidden" value="{{ $product->price1 }}">

                                            <div class="col-md-3 col-12 bg-dark">
                                                <img class="mx-auto" style="width:100% !important;" src="{{ $product->image1_url }}" alt="">
                                            </div>
                                            <div class="col-md-5 col-sm-12 col-12">
                                                <div class="row">
                                                    <div class="col-md-12 col-12 centrarFlex">
                                                        <div class="centrar">
                                                            <span class="h6">{{ $product->name }}</span>
                                                        </div>
                                                        <br>
                                                        <div class="centrar">
                                                            {{ $product->description }}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row my-3">
                                                    <div class="col-md-12 col-12 centrarFlex">
                                                        <div class="centrar">
                                                            <a class="btn btn-view centrar" href="/routedetails/{{ $product->comercio_id }}/{{ $product->id }}">Ver</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="row">
                                                    <div class="col-md-12 col-12 d-flex">
                                                        <span class="mx-auto h4">{{$currencyValue}}. {{ $product->getPrice1() }}</span>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12 col-12 d-flex justify-content-between">
                                                        <div class="input-group input-number-group">
                                                            <div class="input-group-button">
                                                                <span class="input-number-decrement">-</span>
                                                            </div>
                                                            <input name="quantity" class="input-number" type="number" value="1" min="0" max="1000">
                                                            <div class="input-group-button">
                                                                <span class="input-number-increment">+</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12 col-12">
                                                        <div class="centrar">
                                                        <button class="btn btn-sale w-25 h-100"><i class="text-white fa fa-shopping-cart" aria-hidden="true"></i> Comprar</button>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                        </form>
                                    </div>
                                    
                                @empty
                                    <div class="card showProductCard mx-auto text-center">
                                        <card-body>
                                            <span>No tiene Productos Disponibles</span>
                                        </card-body>
                                        <card-footer>                    
                                        </card-footer>                    
                                    </div>
                                @endforelse
                            @endif
                        </div>
                    </div>
                    
                </div>
            </div>
    
    <script>
        $('.input-number-increment').click(function() {
        var $input = $(this).parents('.input-number-group').find('.input-number');
        var val = parseInt($input.val(), 10);
        $input.val(val + 1);
        });

        $('.input-number-decrement').click(function() {
            var $input = $(this).parents('.input-number-group').find('.input-number');
            var val = parseInt($input.val(), 10);
            if(val > 1){
                $input.val(val - 1);
            }
        })

    </script>