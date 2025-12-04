<link rel="stylesheet" href="/css/bootstrap.min.css">
<link rel="stylesheet" href="/css/app.css">
<div class="container-fluid">
    <div>
        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card" style="width: 100% !important;">
                            <div class="card-body text-center">
                                <h3>WifiExprés</h3>
                                <input type="hidden" id="user" name="user" value="{{ $user }}">
                                <input type="hidden" id="password" name="password" value="{{ $password }}">
                                <h4>Operación procesada con éxito</h4>
                                <p>
                                  Inicio de sesión en <span class="h4 text-danger" id="contador">5 segundos</span>
                                </p>
                            </div>
                            <div class="card-footer d-flex justify-content-end">
                                <button class="d-none" onclick="enviarDatoAlPadre()">Enviar Variable al Padre</button>
                                <script>
                                function enviarDatoAlPadre() {
                                    const miObjeto = {
                                        user: document.getElementById('user').value,
                                        password: document.getElementById('password').value,
                                    };
                                    // Usa window.parent para referirte al padre y postMessage para enviar datos
                                    // El primer argumento es los datos y el segundo es el origen del padre
                                    window.parent.postMessage(miObjeto, '*'); // Enviar a cualquier origen por simplicidad, pero se recomienda especificar el origen del padre para seguridad.
                                }
                                var contador = 5
                                function cuentaRegresiva(contador){                                    
                                    const idIntervalo = setInterval(() => {
                                        console.log(contador); // Muestra el valor actual del contador
                                        document.getElementById('contador').textContent = contador

                                        if (contador === 0) {
                                            clearInterval(idIntervalo); // Detiene el intervalo cuando llega a 0
                                            console.log("¡Cuenta regresiva terminada!");
                                        } else {
                                            contador--; // Disminuye el contador en 1
                                        }
                                    }, 1000); // 1000 milisegundos = 1 segundo                                
                                }

                                const timeoutId = setTimeout(() => {
                                    enviarDatoAlPadre()
                                    clearTimeout(timeoutId)
                                }, 5000)

                                
                            </script>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->

    </div>
</div>

<script src="/js/app.js"></script>
<script src="/js/backend.js"></script>

<!-- <script src="/js/bootstrap.min.js"></script>
<script src="/js/bootstrap.bundle.min.js"></script>
<script src="/js/jquery-3.6.4.min.js"></script> -->
@stack('js')
@stack('before-livewire-scripts')
<livewire:scripts />
@stack('after-livewire-scripts')


@stack('alpine-plugins')
<!-- Alpine Core -->
<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
@push('js')

@endpush

<SCRIPT LANGUAGE="JavaScript">
// history.forward()
</SCRIPT>