<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rednet</title>
    <!-- Enlace a Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Enlace a Font Awesome para iconos (necesario para el chat y redes sociales) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <!-- Enlace a CSS Personalizado -->
    <link rel="stylesheet" href="css/styles_welcome.css">
</head>
<body>

    <!-- 1. BARRA DE NAVEGACIÓN (NAVBAR) -->
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top py-3">
            <div class="container-fluid px-md-5">
                <!-- Logo Izquierda -->
                    <a class="navbar-brand" href="#inicio" data-page="inicio">
                    <!-- LOGO FICTICIO: Usa un placeholder si no tienes la imagen -->
                    <!-- CAMBIO: Se eliminó height="30" para que el tamaño lo maneje styles.css. El placeholder ahora es 45px. -->
                    <img src="img/logo_rednet.png" class="img-responsive" onerror="this.onerror=null; this.src='https://placehold.co/120x45/007bff/white?text=Rednet';" alt="Logo Rednet">
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarNav">
                    <!-- Menú Central -->
                    <ul class="navbar-nav mx-auto">
                        <li class="nav-item">
                            <!-- Inicialmente activo -->
                            <a class="nav-link active" aria-current="page" href="#inicio" data-page="inicio">Inicio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#quienes-somos" data-page="nosotros">Nosotros</a>
                        </li>
                        
                        <li class="nav-item">
                            <a class="nav-link" href="#nuestros-servicios" data-page="servicios">Servicios</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#planes" data-page="planes">Planes</a>
                        </li>
                    </ul>

                    <!-- Opciones Derecha -->
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="miRednetDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" data-page="mi-rednet">
                                <img src="img/icono_mirednet.svg" alt="" class="nav-icon" onerror="this.onerror=null;this.src='https://placehold.co/20x20/007bff/fff?text=R';">
                                Mi Rednet
                                <!-- Inline SVG caret (stroke-only, transparent background) -->
                                <svg class="dropdown-icon" viewBox="0 0 24 24" aria-hidden="true" focusable="false">
                                    <path d="M6 9l6 6 6-6"></path>
                                </svg>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="miRednetDropdown">
                                <li><a class="dropdown-item" href="#">Login</a></li>
                                <li><a class="dropdown-item" href="#">Salir</a></li>
                            </ul>
                        </li>
                        <!-- Localidad removed as requested -->
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <!-- 2. CONTENIDO PRINCIPAL (MAIN) -->
    <main class="mt-5 pt-5">
        
        <!-- Sección 1: INICIO (Con imagen de Bienvenida) -->
        <section id="inicio" class="vh-70 w-100 position-relative bg-section-1">
            <img src="img/banner_empresa.jpg" onerror="this.onerror=null;" alt="Imagen de Bienvenida" class="img-fluid section-img">
        </section>

        <!-- Sección 2: sQUIÉNES SOMOS (Color de fondo intercalado) -->
        <section id="quienes-somos" class="vh-70 w-100 d-flex justify-content-center align-items-center text-center p-0 bg-section-2">
            <img src="img/Nosotros.jpg" onerror="this.onerror=null;" alt="Mapa de Cobertura" class="img-fluid section-img section-img--contain">
        </section>
        
        <!-- Sección 3: COBERTURA (Con imagen, Color de fondo intercalado) -->
        <section id="cobertura" class="vh-70 w-100 position-relative bg-section-1">
            <img src="img/cobertura_empresa.jpg" onerror="this.onerror=null;" alt="Mapa de Cobertura" class="img-fluid section-img">
        </section>

        <!-- Sección 4: DISFRUTA SIN LÍMITES (Color de fondo intercalado) -->
        <section id="disfruta" class="vh-70 w-100 position-relative bg-section-1">
            <img src="img/disfruta.jpg" onerror="this.onerror=null;" alt="Mapa de Cobertura" class="img-fluid section-img">
        </section>

        <!-- Sección 5: NUESTROS SERVICIOS (ID usado por el enlace "Servicios") -->
        <section id="nuestros-servicios" class="vh-70 w-100 position-relative bg-section-1">
            <img src="img/SERVICIO.jpg" onerror="this.onerror=null;" alt="Mapa de Cobertura" class="img-fluid section-img">
        </section>

        <!-- Sección 6: PLANES (Sección principal para ver planes) -->
        <section id="planes" class="vh-70 w-100 position-relative bg-section-1">
            <img src="img/PLANES.jpg" onerror="this.onerror=null;" alt="Mapa de Cobertura" class="img-fluid section-img">
            </section>

            <!-- Sección 7: PLANES (Duplicado sin imagen con columnas y botones) -->
            <section id="planes-duplicado" class="w-100 bg-section-2 py-5 d-none">
                <div class="container text-dark">
                    <!-- Primera fila: dos columnas (col-md-3 y col-md-9) -->
                    <div class="row mb-4">
                        <div class="col-12 col-md-3 mb-3 mb-md-0 d-flex flex-column align-items-stretch">
                            <button class="btn btn-outline-primary mb-2 w-100 plan-btn">
                                <span class="btn-title">MEGA DEDICADOS</span>
                                <small class="btn-subtitle d-block text-muted">COMERCIO MEDIO</small>
                            </button>
                            <button class="btn btn-outline-primary mb-2 w-100 plan-btn">
                                <span class="btn-title">COMERCIO</span>
                                <small class="btn-subtitle d-block text-muted">PLUS</small>
                            </button>
                            <button class="btn btn-outline-primary w-100 plan-btn">
                                <span class="btn-title">PROVEEDORES</span>
                                <small class="btn-subtitle d-block text-muted">SERVICIO DE INTERNET (ISP)</small>
                            </button>
                        </div>
                        <div class="col-12 col-md-9">
                            <p class="mb-0">Aquí puedes describir brevemente las características generales de los planes seleccionados o mostrar contenido dinámico relacionado con el plan escogido.</p>
                        </div>
                    </div>

                    <!-- Segunda fila: título y botón solicitar reunión -->
                    <div class="row align-items-center">
                        <div class="col-12 col-md-6">
                            <h3 class="mb-0">Planes corporativos</h3>
                        </div>
                        <div class="col-12 col-md-6 text-md-end mt-3 mt-md-0">
                            <div class="dropdown d-inline-block">
                                <button class="btn btn-primary dropdown-toggle" type="button" id="solicitarReunionDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                    Solicitar una reunión
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="solicitarReunionDropdown">
                                    <li><a class="dropdown-item" href="#">Juan Pérez</a></li>
                                    <li><a class="dropdown-item" href="#">María Gómez</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </section>


    </main>

    <!-- 3. PIE DE PÁGINA (FOOTER) -->
    <footer class="bg-dark text-white pt-5">
        <div class="container">
            <div class="row text-center text-md-start">
                
                <!-- Columna 1: Logo -->
                <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3">
                    <img src="img/logo_rednet_WHITE.png" class="img-responsive footer-logo" onerror="this.onerror=null; this.src='https://placehold.co/120x30/ffffff/000?text=Rednet';" alt="Logo Rednet Footer">
                    <p class="mt-3 text-white-50">Conectando tu mundo con la mejor velocidad.</p>
                </div>
                
                <!-- Columna 2: Dirección -->
                <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mt-3">
                    <h5 class="text-uppercase mb-4 font-weight-bold text-warning">Dirección</h5>
                    <p><i class="fas fa-home me-2"></i> Av. Principal, Edificio Rednet, Caracas.</p>
                </div>

                <!-- Columna 3: Horario de Atención -->
                <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mt-3">
                    <h5 class="text-uppercase mb-4 font-weight-bold text-warning">Horario</h5>
                    <p><i class="fas fa-clock me-2"></i> Lunes a Viernes: 8:00am - 5:00pm</p>
                    <p><i class="fas fa-clock me-2"></i> Sábados: 9:00am - 1:00pm</p>
                </div>

                <!-- Columna 4: Menús y Correo -->
                <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3">
                    <h5 class="text-uppercase mb-4 font-weight-bold text-warning">Enlaces Útiles</h5>
                    <p><a href="#inicio" class="text-white text-decoration-none">Inicio</a></p>
                    <p><a href="#quienes-somos" class="text-white text-decoration-none">Empresa</a></p>
                    <p><a href="mailto:contacto@rednet.com" class="text-white text-decoration-none"><i class="fas fa-envelope me-2"></i> contacto@rednet.com</a></p>
                </div>
            </div>
            
            <!-- NUEVA FILA: Derechos Reservados y Redes Sociales -->
            <hr class="mt-4 mb-3 bg-secondary">
            <div class="row pb-3 align-items-center">
                
                <!-- 1ra Columna: Derechos Reservados -->
                <div class="col-md-6 text-center text-md-start">
                    <p class="text-white-50 mb-0">Todos los derechos reservados | Rednet 2025</p>
                </div>

                <!-- 2da Columna: Redes Sociales -->
                <div class="col-md-6 text-center text-md-end mt-3 mt-md-0">
                    <a href="#" class="text-white-50 mx-2"><i class="fab fa-instagram fa-lg"></i></a>
                    <a href="#" class="text-white-50 mx-2"><i class="fab fa-whatsapp fa-lg"></i></a>
                    <a href="#" class="text-white-50 mx-2"><i class="fab fa-tiktok fa-lg"></i></a>
                    <a href="#" class="text-white-50 mx-2"><i class="fab fa-facebook-f fa-lg"></i></a>
                    <a href="#" class="text-white-50 mx-2"><i class="fab fa-linkedin-in fa-lg"></i></a>
                </div>
            </div>

        </div>
    </footer>

    <!-- BOTÓN DE CHAT FLOTANTE (Posición Fija Abajo Derecha) -->
    <a href="#" class="chat-btn bg-success shadow-lg" role="button" aria-label="Abrir chat de soporte">
        <i class="fas fa-comment-dots text-white"></i>
    </a>

    <!-- Enlace a Bootstrap JS (Popper y jQuery incluidos en el bundle) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Enlace a JavaScript Personalizado -->
    <script src="js/scripts_welcome.js"></script>
</body>
</html>