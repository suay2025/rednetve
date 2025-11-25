<div>
    <div class="row my-5">
        <div class="col-md-12 text-center">
            <button class="btn btn-success" onClick="enviarPeticion()">Enviar Peticion JS</button>
        </div>
    </div>

    <div class="row my-5">
        <div class="col-md-12 text-center">
            <button wire:click.prevent="enviarPeticion"class="btn btn-success" wire:>Enviar Peticion JS</button>
        </div>
    </div>


<script>
    function enviarPeticion(){
        
        const data = null;

        const xhr = new XMLHttpRequest();
        xhr.withCredentials = true;

        xhr.addEventListener('readystatechange', function () {
            if (this.readyState === this.DONE) {
                console.log(this.responseText);
            }
        });

        xhr.open('GET', 'https://open-weather-map27.p.rapidapi.com/weather');
        xhr.setRequestHeader('x-rapidapi-key', 'Sign Up for Key');
        xhr.setRequestHeader('x-rapidapi-host', 'open-weather-map27.p.rapidapi.com');

        xhr.send(data)

        console.log('Finalizo')

    }
</script>

</div>