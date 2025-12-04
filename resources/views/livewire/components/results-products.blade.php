<div>
    <style>
        .cuadro {
            width: 100% !important;
            height: auto !important;
            box-shadow: 5px 5px 15px gray;
            margin-bottom: 10px;
            padding: 15px;
        }

        .imgProduct {
            width: 250px !important; height: 120px !important;
        }

        .negrita {
            font-weight: bold;
        }

        @media screen and (max-width: 768px) {
            .imgProduct {
                width: 250px !important; height: 150px !important;
            }
            .description {
                height: auto !important;
                text-align: justify;
                padding: 15px !important;
            }
            .cuadro {
                width: 100% !important;
                height: 620px !important;
                padding: 0;
            }
            .logo-responsive {
                width: 95px !important;
            }
        }
    </style>
            <div class="row d-flex">                
                <div class="mx-auto col-md-12 col-12">
                    <div class="row">
                        <!-- Sección de categoría -->
                        <div class="col-md-12 col-12">
                            
                        </div>        
                    </div>

                    <!-- Sección de Resultados -->
                    <div class="row bg">
                        <div class="col-md-12 col-12">
                            <span class="h4 mx-4">Resultado de: {{$parametro}} </span>  
                        </div>
                    </div>
                    @if($parametro)
                        @forelse ($products as $index => $product)
                        <div class="card p-3 border border-1 cuadro m-3 h-auto">
                            <div class="row mx-2 border border-1 p-3">
                                <div class="col-md-3 col-12 centrar">
                                    <img class = "imgProduct" src="{{ $product->image1_url }}" alt="">
                                </div>
                                <div class="col-md-5 col-12">
                                    <p class="centrar negrita">{{ $product->name }}</p>
                                    <p class="centrar description" style="height: 50%;">{{ $product->description }}</p>
                                    <div class="centrar p-0 my-0">
                                        <a class="btn btn-view centrar" href="/routedetails/{{ $product->comercio_id }}/{{ $product->id }}">Ver</a>
                                    </div>
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="centrar">Precio: {{ $currencyValue }} {{ $product->getPrice1() }}</div>
                                    <div class="centrar">
                                        <div class="col-md-12 col-12 d-flex justify-content-between">
                                            <div class="input-group input-number-group">
                                                <div class="input-group-button">
                                                    <span class="input-number-decrement">-</span>
                                                </div>
                                                <input wire:model.defer="state.quantity" name="quantity" class="input-number" type="number" value="1" min="0" max="1000">
                                                <div class="input-group-button">
                                                    <span class="input-number-increment">+</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="centrar">
                                        <button wire:click.prevent="sendCard({{ $product->id }}, 1)" class="btn btn-sale text-center">Comprar ahora</button>
                                    </div>
                                    <div class="centrar">
                                        <img class ="logo-responsive" src="{{ $product->comercio->avatar_url }}" alt="">
                                    </div>

                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="card p-3 border border-1 cuadro m-3 h-auto" style="height: 50vh !important;">
                            <span> No tiene resultado</span>
                        </div>
                        @endforelse
                    @endif
                </div>
            </div>
    
    <script>
        $('.input-number-increment').click(function() {
        var $input = $(this).parents('.input-number-group').find('.input-number');
        var val = parseInt($input.val(), 10);
        $input.val(val + 1);
        @this.emit('actualizarQuantity', $input.val())
        });

        $('.input-number-decrement').click(function() {
            var $input = $(this).parents('.input-number-group').find('.input-number');
            var val = parseInt($input.val(), 10);
            if(val > 1){
                $input.val(val - 1);
                @this.emit('actualizarQuantity', $input.val())
            }
        })
    </script>
</div>