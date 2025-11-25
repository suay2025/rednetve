<div>
    <div class="row">
        <div class="col-md-12">
            <h4>Centro de distribución</h4>
        </div>
    </div>
    <hr>
    
    <div class="row">
        <div class="col-md-12">
            <div class="row border border-1 my-1">
                <div class="col-md-8">
                    {{ $comercio->name }}
                    <br>
                    {{ $comercio->address }}
                    <br>
                    {{ $comercio->contactphone}} {{ $comercio->cellphonecontact }}
                    <br>
                    {{ $comercio->horario}}
                </div>
                <div class="col-md-4 d-flex justify-content-center align-items-center">
                    <button class="btn btn-secondary form-control w-50" href="" wire:click.prevent="selectComercio({{ $comercio }})">
                        Entregar aquí
                    </button>
                </div>
            </div>
            @forelse ($centrosmodal as $index => $centro)
                <div class="row border border-1 my-1">
                    <div class="col-md-8">
                        {{ $centro->address }}
                        <br>
                        {{ $centro->contactphone}}
                        <br>
                        {{ $centro->horario}}
                    </div>
                    <div class="col-md-4 d-flex justify-content-center align-items-center">
                        <button class="btn btn-secondary form-control w-50" href="" wire:click.prevent="selectCentro({{ $centro }})">
                            Entregar aquí
                        </button>
                    </div>
                </div>
            @empty
            <div class="row">
                <div class="col-md-12">
                    <p class="mt-2">No se encontro resultados</p>
                </div>
            </div>
            @endforelse
        </div>
    </div>

    <div class="row centrar {{$class}} ">
        <div class="col-md-6">
            {!! $infocentro !!} 
        </div>
        <div class="col-md-6">
            <form class="formPickup" action="" method="get">
                @csrf
                <input wire:model.defer="state.metodoentrega" type="hidden" name="metodoentrega" id="metodoentrega" >
                <input wire:model.defer="state.nropedido" type="hidden" name="nropedido" id="nropedido" >
                <button class='btn btn-success {{$class}}' wire:click.prevent="siguientePickup">Siguiente</button>
            </form>
        </div>
        <script>
            window.addEventListener('enviarFormularioPickup', function (event) {            
                let form = document.querySelector('.formPickup');            
                form.submit();        
            });
        </script>
    </div>

</div>
