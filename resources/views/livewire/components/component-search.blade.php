<div>
    <div class="row">
        <div class="col-lg-12 col-xs-12 col-md-12 col-sm-12">

    <!-- <form autocomplete="off" wire:submit.prevent="searchMotor"> -->
    <form action="{{ route('searchMotor') }}" method="get" wire:ignore.self>
        @csrf
        <div class="card w-75 p-1 mx-auto">
            <div class="form-group">
                <label for="manufacturer">Marca</label>
                <select wire:ignore wire:model="manufacturer" name="manufacturer_id" id="manufacturer" class="form-control @error('manufacturer') is-invalid @enderror">
                    @if($manufacturers->count() == 0 )    
                        <option value="0">Seleccione una opción</option>
                    @else
                    <option value="0">Seleccione una opción</option>
                    @endif
                    @foreach($manufacturers as $manufacturer)
                            <option value="{{ $manufacturer->id }}" selected="false">{{ $manufacturer->name }}</option>                        
                    @endforeach
                    <script>
                         $("#manufacturer_id").val("0");
                    </script>
                </select>
                @error('manufacturer')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="modelo">Modelo</label>
                <select wire:model="modelo" name="modelo_id" id="modelo_id" class="modelo form-control @error('modelo') is-invalid @enderror" >
                    @if($modelos->count() == 0 )    
                        <option value="0">Seleccione una opción</option>
                    @else
                    <option value="0">Seleccione una opción</option>
                    @endif
                    @foreach($modelos as $modelo)
                        <option value="{{ $modelo->id }}">{{ $modelo->name }}</option>
                    @endforeach
                </select>
                @error('modelo')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="motor">Motor</label>
                <select wire:model="motor" name="motor_id" id="motor_id" class="motor form-control @error('motor') is-invalid @enderror">
                    @if($motores->count() == 0 )    
                        <option value="0">Seleccione una opción</option>
                    @else
                    <option value="0">Seleccione una opción</option>
                    @endif
                    @foreach($motores as $motor)
                        <option value="{{ $motor->id }}">{{ $motor->name }}</option>
                    @endforeach
                </select>
                @error('motor')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="form-group mx-auto">
                <button type="submit" class="btn-app" id="searchMotor">Buscar</button>
            </div>
        </div>            
    </form>
        </div>
    </div>
    
    <script>
        let manufacturer = document.getElementById('manufacturer');
        let modelo = document.getElementById('modelo_id');
        let motor = document.getElementById('motor_id');

        let searchMotor = document.getElementById('searchMotor');

        searchMotor.addEventListener('click', () =>
        {
            localStorage.setItem('serverManufacturer', manufacturer.value);
            localStorage.setItem('serverModelo', modelo.value);
            localStorage.setItem('serverMotor', motor.value);
        });

        window.addEventListener('DOMContentLoaded', () =>
        {
            let savedServer  = localStorage.getItem('serverManufacturer');

            if (savedServer)
            {                
                modelo_id.value = localStorage.getItem('serverModelo');
                motor_id.value = localStorage.getItem('serverMotor');;
            }
        });

    </script>    
        
</div>