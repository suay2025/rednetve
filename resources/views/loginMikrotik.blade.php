
<div>
<link href="css/bootstrap.min.css" rel="stylesheet">
<div>
    <div class="row">
        <div class="col-md-12 col-12">
            <div class="card mx-auto my-3" style="width: 350px; height: 150px;">
                <div class="card-header">A través de Servidor remoto</div>
                <div class="card-body text-center">
                    <div class="row text-center">
                        <span id="msj"></span>
                    </div>
                    <button wire:click.prevent="login" class="btn btn-primary btnLogin mx-auto"> Entrar</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    window.onload = function() {
        let btnLogin = document.querySelector('.btnLogin')
        let msj = document.querySelector('#msj')
        
        btnLogin.addEventListener('click', ()=> {
            //fetch('http://127.0.0.1:8000/api/accesoMikrotik')
            fetch('https://panexpres.com/api/accesoMikrotik')
            .then(response => response.json())
            //.then(data => console.log(data))
            .then(data => {   

                if (data.success == true) {
                    console.log(data.valor)
                    msj.innerHTML = data.valor
                }
                else {
                    console.log(data)
                    msj.innerHTML = data
                }
            })
            .catch(error => {
                console.error('Error:', error)
                msj.innerHTML = 'Error:' + error
            });
        })
    }
</script>
</div>