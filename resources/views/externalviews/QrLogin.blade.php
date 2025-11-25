<!DOCTYPE html>
<html>
<head>
    <title>MikroTik Hotspot - Lector QR</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap.min.css">
    <style>
        /* CSS Básico para el Hotspot */
        body { font-family: sans-serif; text-align: center; padding: 20px; }
        #qr-video { width: 100%; max-width: 300px; height: auto; border: 1px solid #ccc; margin: 10px auto; display: block; }
        #result-status { color: red; margin-bottom: 15px; }
        .login-box { max-width: 350px; margin: 0 auto; padding: 20px; border: 1px solid #ddd; border-radius: 8px; }
    </style>
</head>
<body>
    <div class="row">
        <div class="col-md-12 col-12">
            <iframe style="width: 300px;" src="https://panexpres.com/lectorQr" frameborder="0"></iframe>
        </div>
    </div>
    <div class="login-box">
        <h2>Acceso Hotspot QR</h2>
        
        <video id="qr-video" muted playsinline></video>
        
        <p id="result-status">Iniciando escáner...</p>

        <form name="login" action="$(link-login-only)" method="post"
              $(if chap-id) onSubmit="return doLogin()" $(endif)>
            <input type="hidden" name="username" id="username"/>
            <input type="hidden" name="password" id="password"/>
            <input type="submit" value="Conectar Manualmente" style="display: none;"/>
        </form>
    </div>

    <script src="qr-scanner.min.js"></script>

    <script>
        // * IMPORTANTE: AJUSTA LA RUTA DEL WORKER SI NO USAS EL CDN *
        // Para Mikrotik, si copiaste los archivos de la librería al Hotspot, 
        // la ruta puede ser relativa, ej: 'qr-scanner-worker.min.js'
        QrScanner.WORKER_PATH = 'qr-scanner-worker.min.js';
        
        const videoElement = document.getElementById('qr-video');
        const statusElement = document.getElementById('result-status');
        const usernameInput = document.getElementById('username');
        const passwordInput = document.getElementById('password');
        const loginForm = document.forms['login'];
        
        let qrScanner = null;

        /**
         * Maneja el código QR decodificado (ej. "usuario:contraseña")
         * @param {string} result - El texto del código QR.
         */
        function onDecode(result) {
            if (qrScanner) {
                qrScanner.stop();
            }

            statusElement.style.color = 'green';
            statusElement.textContent = 'Código QR detectado. Iniciando sesión...';

            // Suponiendo que el QR contiene "usuario:contraseña"
            const parts = result.split(':');
            
            if (parts.length >= 2) {
                usernameInput.value = parts[0];
                passwordInput.value = parts[1];
                loginForm.submit(); // Envía el formulario de login de Mikrotik
            } else {
                statusElement.style.color = 'red';
                statusElement.textContent = 'Formato de QR incorrecto (debe ser usuario:contraseña).';
            }
        }

        // 1. Inicialización y arranque del escáner
        try {
            qrScanner = new QrScanner(
                videoElement,
                onDecode,
                {
                    preferredCamera: 'environment' // Intenta usar la cámara trasera
                }
            );

            qrScanner.start()
                .then(() => {
                    statusElement.style.color = 'blue';
                    statusElement.textContent = 'Escáner activo. Por favor, muestre su QR.';
                })
                .catch(error => {
                    // ESTO FALLARÁ EN HTTP. AQUÍ SE CAPTURA EL ERROR
                    statusElement.style.color = 'red';
                    statusElement.textContent = '❌ Error: Se necesita HTTPS para acceder a la cámara. Por favor, conéctese manualmente o vea las soluciones en la documentación de Mikrotik.';
                    console.error('Error al iniciar el escáner (probable falla por HTTP):', error);
                });

        } catch (e) {
            statusElement.style.color = 'red';
            statusElement.textContent = 'Error fatal del escáner.';
            console.error(e);
        }
    </script>
    
    $(if chap-id)
    <script src="md5.js"></script>
    <script>
    function doLogin() {
        // Lógica de login CHAP de Mikrotik (si aplica)
        // ...
        return true;
    }
    </script>
    $(endif)

</body>
</html>