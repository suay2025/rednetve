<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar de Tres Secciones - Vista SOLO PC</title>
    
    <!-- Enlace a Bootstrap 5 CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" xintegrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjHh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
    <style>
        html, body {
            height: 100%;
            margin: 0;
            font-family: Arial, sans-serif;
        }

        /* Variables y Estilos Generales */
        :root {
            --color-primary: #10999F; /* Color principal (azul verdoso) */
            --color-secondary: #f8f9fa; /* Fondo claro */
            --color-text: #343a40;

            /* ALTURAS DE EJEMPLO (AJUSTA ESTOS VALORES A LA ALTURA REAL DE TUS MENÚS) */
            --navbar-height: 70px; 
            --menu-desktop-height: 40px; 

            /* Cálculo de la altura total del banner */
            --banner-dynamic-height: calc(100vh - var(--navbar-height) - var(--menu-desktop-height));
        }

        .navbar-custom {
            background-color: var(--color-secondary);
            border-bottom: 1px solid #e9ecef;
            min-height: 70px; /* Altura mínima para asegurar el espacio */
        }

        /* ------------------------------------------------------------------ */
        /* ESTRUCTURA CLAVE DE TRES COLUMNAS (Desktop) */
        /* ------------------------------------------------------------------ */
        .navbar-content-container {
            /* PROPIEDADES CRUCIALES PARA LA DISTRIBUCIÓN */
            display: flex;
            align-items: center;
            justify-content: space-between; /* Distribuye Logo y Login a los extremos */
            width: 100%;
            height: 100%; /* Asegura que ocupe la altura del nav */
        }

        /* 1. Section-Logo (Izquierda) */
        .section-logo {
            flex-shrink: 0; /* Asegura que mantenga su tamaño */
            /* Padding para separar del borde izquierdo */
            padding: 0 1rem 0 1rem; 
        }

        /* 2. Section-Search (Centro - EXPANDIDO) */
        .section-search {
            flex-grow: 1; /* <-- ESTO HACE QUE SE ESTIRE y ocupe el espacio central */
            max-width: 420px; /* Reducido a 420px para una barra de búsqueda más compacta */
            margin: 0 1.5rem; /* Margen para separar visualmente del logo y login */
        }
        
        /* 3. Section-Login (Derecha) */
        .section-login {
            flex-shrink: 0; /* Asegura que mantenga su tamaño */
            /* Padding para separar del borde derecho */
            padding: 0 1rem 0 0; 
        }

        /* Estilo para el Input y Botón de Búsqueda */
        .form-control-search {
            border-radius: 0.5rem 0 0 0.5rem;
        }
        .btn-custom-primary {
            background-color: var(--color-primary);
            border-color: var(--color-primary);
            color: white;
            border-radius: 0 0.5rem 0.5rem 0; 
            transition: background-color 0.3s;
        }
        .btn-custom-primary:hover {
            background-color: #0b7a7f;
            border-color: #0b7a7f;
            color: white;
        }
        /* Color hover para items de dropdown */
        .dropdown-menu .dropdown-item:hover {
            background-color: var(--color-main-footer) !important;
            color: #fff !important;
        }
        /* --- Estilos para el menú de escritorio (sin subrayado) y dropdown por hover --- */
        .menu-desktop a {
            text-decoration: none !important;
            color: #ffffff !important;
        }
        .menu-desktop .dropdown,
        .menu-desktop .dropdown-submenu {
            position: relative;
        }
        .btn-secondary {
            background-color: var(--color-dark-blue);
        }
        @media (min-width: 768px) {
            .menu-desktop .dropdown:hover > .dropdown-menu {
                display: block;
            }
            .menu-desktop .dropdown-menu {
                display: none;
                position: absolute;
                top: 100%;
                left: 0;
                background: #009b9f;
                border: none;
                min-width: 200px;
                z-index: 2000;
                padding: .25rem 0;
            }
            .menu-desktop .dropdown-menu .dropdown-item {
                color: #fff !important;
                padding: .5rem 1rem;
            }
            .menu-desktop .dropdown-submenu:hover > .dropdown-menu {
                display: block;
                top: 0;
                left: 100%;
                min-width: 180px;
            }
        }
    </style>
    <style>
        /* Variables de Color Actualizadas */
        :root {
            --color-primary: #10999F; /* Azul Verdoso (para botones y redes sociales) */
            --color-main-footer: #162661; /* ¡NUEVO COLOR SOLICITADO! (Fondo principal) */
            --color-bottom-footer: #101c4e; /* Fondo de Copyright (Ligeramente más oscuro que el principal) */
            --color-dark-blue: #113c66; /* Azul Oscuro para Copyright Text */
        }

        /* ------------------------------------------------------------------ */
        /* PIE DE PÁGINA: Fila Superior (4 Columnas) */
        /* ------------------------------------------------------------------ */

        .footer-top {
            background-color: var(--color-main-footer); /* Usando el nuevo color #162661 */
            color: white; /* Color de las letras: Blanco */
            padding: 3rem 0;
        }

        /* Estilo para los títulos y etiquetas */
        .footer-title {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 0.75rem;
            display: flex;
            align-items: center;
        }
        .footer-link, .footer-text {
            color: #ccc; /* Gris claro para el texto secundario */
            text-decoration: none;
            display: block;
            margin-bottom: 0.25rem;
            font-size: 0.95rem;
        }
        .footer-link:hover {
            color: var(--color-primary);
        }
        /* Ajuste específico para las líneas de horario */
        .footer-top .col-md-3:nth-child(3) .footer-text {
            margin-bottom: 0.5rem; 
        }

        /* ------------------------------------------------------------------ */
        /* PIE DE PÁGINA: Fila Inferior (Copyright y Redes Sociales) */
        /* ------------------------------------------------------------------ */
        .footer-bottom {
            background-color: var(--color-bottom-footer); /* Usando el azul oscuro de contraste */
            color: white;
            padding: 1rem 0;
            font-size: 0.9rem;
        }

        /* Estilo específico para el texto de Copyright */
        .copyright-text {
            color: var(--color-dark-blue); /* Color solicitado: Azul Oscuro #003366 */
            font-weight: 500;
        }

        /* Estilos para los Iconos de Redes Sociales */
        .social-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 38px;
            height: 38px;
            background-color: var(--color-primary); /* Fondo: #10999f */
            border-radius: 50%; /* Iconos Redondos */
            color: white; /* Iconos: Color Blanco */
            transition: transform 0.3s ease;
            margin-left: 0.5rem; /* Separación entre iconos */
        }
        .social-icon:hover {
            transform: scale(1.1);
            background-color: #0b7a7f;
        }

        /* ------------------------------------------------------------------ */
        /* RESPONSIVIDAD (Ajustes para Móviles) */
        /* ------------------------------------------------------------------ */
        @media (max-width: 767.98px) {
            .footer-top .col-md-3 {
                margin-bottom: 2rem;
            }
            .footer-bottom .text-md-end {
                text-align: start !important;
                margin-top: 0.5rem;
            }
            .social-icon {
                margin-left: 0;
                margin-right: 0.5rem;
            }
        }
    </style>
    <style>
        /* ------------------------------------------------------------------ */
        /* SECCIÓN INICIO SOLICITADA */
        /* ------------------------------------------------------------------ */
        #inicio {
            margin-top: 120px;
            /* 1. Aplica la altura dinámica calculada */
            height: var(--banner-dynamic-height);
            width: 100%;
            overflow: hidden; /* Evita barras de desplazamiento si hay un desbordamiento mínimo */
        }
        
        #section-body {
            /* 2. El contenedor toma el 100% del alto de la sección principal */
            width: 100%;
            height: 100%;
        }

        #section-body img {
            /* 3. La imagen ocupa todo el contenedor (#section-body) */
            width: 100%; 
            height: 100%;
            /* 4. Propiedad clave para responsividad: ajusta la imagen sin distorsionarla */
            object-fit: cover; 
            display: block;
        }
    </style>

    <style>
        /* ======================================= */
        /* CSS Base para Altura y Flexibilidad Vertical */
        /* ======================================= */
        
        /* Contenedor principal: Ocupa el 100% de la altura del viewport y usa Flexbox en columna. */
        #nosotros {
            height: 100vh;
            display: flex;
            flex-direction: column;
            width: 100%;
        }

        /* ======================================= */
        /* Fila 1 (Cabecera): 10% y Responsividad Horizontal */
        /* ======================================= */

        .section-title {
            background-color: #10999F; /* Color solicitado */
            flex-shrink: 0; /* Evita que la cabecera se reduzca */
            /* En móvil, la altura es automática para apilar los elementos (display: flex + flex-direction: column) */
            height: auto; 
            padding-top: 0.5rem; 
            padding-bottom: 0.5rem;
        }

        /* Media Query para Tablet y PC (md: 768px en Bootstrap) */
        @media (min-width: 768px) {
            .section-title {
                height: 10%; /* Fija la altura al 10% en pantallas grandes */
                padding: 0; /* Elimina padding vertical extra en PC */
            }
        }
        
        /* Aseguramos que los elementos internos en PC estén alineados */
        .header-content {
            height: 100%;
        }


        /* ======================================= */
        /* Fila 2 (Cuerpo): 90% y Adaptación de Imagen */
        /* ======================================= */
        
        #section-body {
            flex-grow: 1; /* Ocupa todo el espacio vertical restante (el 90% dinámico) */
            padding: 0 !important; /* Quitar padding de Bootstrap para que la imagen toque los bordes */
            overflow: hidden; 
        }
        
        /* Estilos de la imagen para ADAPTACIÓN RESPONSIVA */
        #section-body img {
            width: 100%;
            height: 100%;
            /* object-fit: cover asegura que la imagen cubra completamente el área sin distorsionarse */
            object-fit: cover; 
            display: block;
        }

        /* Estilos específicos para el menú en móvil */
        .navbar-nav-mobile-flex {
            display: flex;
            flex-direction: column; /* Apila los enlaces en móvil */
            width: 100%;
            text-align: center;
        }
        @media (min-width: 768px) {
            .navbar-nav-mobile-flex {
                flex-direction: row; /* Vuelve a línea en PC */
                justify-content: flex-end; /* Alinea a la derecha en PC */
            }
        }

    </style>
    <style>
        /* 2. CONTENEDOR PRINCIPAL CON IMAGEN DE FONDO */
        .servicios {
            /* ------------------------------------------------ */
            /* PROPIEDADES CRÍTICAS PARA LA CORRECCIÓN DE SCROLL */
            width: 100%; 
            /* ALTURA CALCULADA: 100% de la ventana menos la altura del encabezado */
            /* height: calc(100vh - var(--header-height));  */
            height: 80vh; 
            /* Se ha eliminado 'min-height: 90vh;' para evitar desbordamiento */
            /* ------------------------------------------------ */

            background-image: url('img/servicio.png');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            
            /* Estilos de layout para centrar el contenido */
            display: flex;
            justify-content: center;
            align-items: center; /* Se cambia a 'center' para centrar los botones en el espacio disponible */
            padding: 2rem 1rem;
            overflow-y: auto; /* Si el contenido de los botones es muy grande, permitimos scroll SOLO aquí */
        }
        
        /* 3. ÁREA DE BOTONES RESPONSIVE */
        .button-area-wrapper {
            width: 100%;
            max-width: 900px;
            background-color: transparent; 
            padding: 2rem;
            border-radius: 1rem;
            /* Se elimina margin-top: 5vh; ya que main-container ahora usa align-items: center */
            box-shadow: 0 0 30px rgba(0, 0, 0, 0.3);
        }
        
        /* Contenedor Grid para los botones (Responsive) */
        .responsive-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 2rem; 
            justify-items: center;
            padding: 1rem 0;
            background-color: #ffffff00;
            color: white;

        }
        
        @media (min-width: 768px) {
            .responsive-grid {
                grid-template-columns: repeat(4, 1fr);
            }
        }

        /* Estilos del ítem individual (contenedor de botón y etiquetas) */
        .button-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            width: 100%;
            max-width: 150px;
        }

        /* Estilo del Botón (Círculo con Icono) */
        .action-icon {
            width: 180px;
            height: 180px;
            border-radius: 15px;
            background-color: white; 
            border: 2px solid transparent; 
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            cursor: pointer;
            display: flex;
            justify-content: center;
            align-items: center;
            transition: border-color 0.3s ease, box-shadow 0.3s ease, transform 0.2s;
        }

        /* Efecto Hover: Cambiar el color del borde a #6500DB */
        .action-icon:hover {
            border: 2px solid #162661; 
            border-radius: 15px;
            /* border-color: var(--color-accent); 
            box-shadow: 0 4px 15px rgba(101, 0, 219, 0.4);
            transform: translateY(-2px);  */
        }

        
        /* Estilos de las etiquetas */
        .button-label {
            margin-top: 0.5rem;
            font-size: 1rem;
            font-weight: 700; 
            color: var(--color-light); 
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.7); 
        }

        .button-sublabel {
            font-size: 0.875rem;
            color: var(--color-light); 
            font-weight: 400;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.7);
        }
    </style>
</head>
<body>

    <!-- BARRA DE NAVEGACIÓN (SOLO ESTRUCTURA DE ESCRITORIO) -->
    <nav class="navbar fixed-top navbar-custom shadow-sm p-0">
        <!-- container-fluid sin padding para pegar a los bordes si es necesario -->
        <div class="container-fluid p-0 mt-2 mb-3">
            
            <!-- ÚNICO CONTENEDOR DE ESCRITORIO -->
            <div class="navbar-content-container">

                <!-- 1. LOGO (Izquierda) -->
                <div class="section-logo">
                    <a class="navbar-brand p-0" href="#">
                        <img src="img/logo_rednet.png" 
                             class="img-fluid" style="max-width:140px;" alt="Logo Rednet">
                    </a>
                </div>

                <!-- 2. SEARCH (Centro - Expandido) -->
                <div class="section-search">
                    <form class="w-100" role="search">
                        <div class="input-group">
                            <!-- Input -->
                            <input class="form-control form-control-search" type="search" placeholder="Buscar servicios o ayuda..." aria-label="Search">
                            <!-- Botón de Búsqueda -->
                            <button class="btn btn-custom-primary" type="button">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.447.747 1.054 1.353 1.398 1.397l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85Z"/>
                                </svg>
                            </button>
                        </div>
                    </form>
                </div>

                <!-- 3. LOGIN (Derecha) - espacio reservado para otros elementos -->
                <div class="section-login">
                    <!-- aquí puedes colocar botones o enlaces adicionales a la derecha -->
                    <!-- Mi Rednet y Localización movidos aquí (izquierda del header) -->
                    <div class="d-flex align-items-center ms-3">
                        <!-- Mi Rednet (dropdown) -->
                        <div class="dropdown me-2">
                            <a class="nav-link dropdown-toggle d-flex align-items-center p-0 text-dark" href="#" id="miRednetDropdownLeft" role="button" data-bs-toggle="dropdown" aria-expanded="false" data-page="mi-rednet">
                                <img src="img/icono_mirednet.svg" alt="Mi Rednet" class="nav-icon me-2" onerror="this.onerror=null;this.src='https://placehold.co/20x20/007bff/fff?text=R';" style="max-width:20px;">
                                <span>Mi Rednet</span>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="miRednetDropdownLeft">
                                <a class="dropdown-item" href="/login">Login</a>
                                <a class="dropdown-item" href="#">Salir</a>
                            </div>
                        </div>
                    </div>
                    
                </div>
                <!-- Localización (dropdown convertido a div para poder controlar z-index) -->
                <div class="section-localization ml-3 mr-2" style="margin-right: 20px !important;">
                    <div class="dropdown" style="position:relative; z-index:3000;">
                        <button class="btn btn-sm btn-secondary dropdown-toggle" type="button" id="locationDropdownLeft" data-bs-toggle="dropdown" aria-expanded="false">
                            Caracas
                        </button>
                        <div class="dropdown-menu dropdown-menu-start" aria-labelledby="locationDropdownLeft">
                            <a class="dropdown-item active" href="#">Caracas</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- Menú horizontal adicional debajo del nav (desktop + mobile) -->
        <div class="w-100 my-1" style="background-color:#009b9f;">
            <div class="container">
                <!-- Desktop menu: visible en md+ (con dropdown para SERVICIOS) -->
                <nav class="menu-desktop d-md-flex justify-content-center align-items-center gap-4 py-2">
                    <a href="#inicioT" data-page="inicio" class="text-white text-uppercase fs-6 mx-3">INICIOX</a>
                    <a href="#nosotrosT" data-page="nosotrosT" class="text-white text-uppercase fs-6 mx-3">NOSOTROS</a>

                    <!-- SERVICIOS dropdown multinivel -->
                    <div class="dropdown mx-3">
                        <a href="#servicios" data-page="servicios" class="text-white text-uppercase fs-6 dropdown-toggle">SERVICIOS</a>
                        <div class="dropdown-menu">
                            <a href="#" class="dropdown-item">Residencial</a>
                            <div class="dropdown-submenu">
                                <a href="#" class="dropdown-item dropdown-toggle">Empresarial</a>
                                <div class="dropdown-menu">
                                    <a href="#" class="dropdown-item">Pyme</a>
                                    <a href="#" class="dropdown-item">Corporacion Plus</a>
                                    <a href="#" class="dropdown-item">ISP</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <a href="#" class="text-white text-uppercase fs-6 mx-3">PAGUE AQUÍ</a>
                </nav>

                <!-- Mobile header: visible en sm (muestra toggler) -->
                <div class="d-flex d-md-none justify-content-between align-items-center py-2">
                    <div></div>
                    <button class="btn btn-link text-white p-0" type="button" data-bs-toggle="collapse" data-bs-target="#mobileMenu" aria-controls="mobileMenu" aria-expanded="false" aria-label="Toggle menu">
                        <!-- Icono hamburguesa simple -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" style="color:white;">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>

                <!-- Mobile menu (colapsable) -->
                <div class="collapse d-md-none" id="mobileMenu">
                    <nav class="d-flex flex-column text-center py-2">
                        <a href="#" class="text-white py-2 border-top">INICIO</a>
                        <a href="#" class="text-white py-2 border-top">NOSOTROS</a>
                        <a href="#" class="text-white py-2 border-top">SERVICIOS</a>
                        <a href="#" class="text-white py-2 border-top">PAGUE AQUÍ</a>
                    </nav>
                </div>

            </div>
        </div>    
    </nav>

    

    <!-- JS de Bootstrap (necesario para el colapso del menú móvil) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <main class="">
        <!-- EL CÓDIGO DE LA SECCIÓN INICIO SOLICITADA -->
        <div id="inicioT" style="height: 5px;"></div>
        <section id="inicio">
            <div id="section-body">
                <!-- Nota: La ruta 'img/banner_empresa.jpg' no se cargará en este entorno. Se usa un placeholder. -->
                <img src="img/banner_empresa.jpg" 
                    alt="Banner de la empresa"
                    onerror="this.src='https://placehold.co/1920x800/2980b9/ffffff?text=Error+al+cargar+img/banner_empresa.jpg'">
            </div>
        </section>
        <div id="nosotrosT" style="height: 5px;"></div>
        <section id="nosotros">        
            <!-- Fila 1: Título y Menú (section-title) -->
            <div class="section-title" class="container-fluid">
                <div class="row header-content align-items-center">
                    
                    <!-- Columna Izquierda: Título (20% en PC/Tablet, 100% en Móvil) -->
                    <!-- En móvil, usa col-12 y centrado. En PC, usa col-md-3 (cercano al 20%) y alineado a la izquierda. -->
                    <div class="col-12 col-md-3 text-center text-md-start">
                        <h2 class="text-white fw-bold fs-4 mb-0 mx-3 text-truncate">
                            NOSOTROS
                        </h2>
                    </div>
                    
                    <!-- Columna Derecha: Menú (80% en PC/Tablet, 100% en Móvil) -->
                    <!-- En móvil, usa col-12. En PC, usa col-md-9 (cercano al 80%) y alineado a la derecha. -->
                    <div class="col-12 col-md-9">
                        <nav class="navbar navbar-expand-md d-none">
                            <div class="container-fluid justify-content-center justify-content-md-end p-0">
                                <!-- Los botones de menú se colapsan si es necesario (aunque aquí usamos una nav simple) -->
                                <ul class="navbar-nav navbar-nav-mobile-flex">
                                    <li class="nav-item">
                                        <a class="nav-link text-white fw-medium px-3" href="#">Inicio</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-white fw-medium px-3" href="#">Servicios</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-white fw-medium px-3" href="#">Contacto</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-white fw-medium px-3" href="#">Acerca de</a>
                                    </li>
                                </ul>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
            
            <!-- Fila 2: Contenido Principal (section-body) - 90% de Altura -->
            <div id="section-body" class="container-fluid p-0">
                <!-- La imagen ocupa el 100% del ancho y el 100% de la altura de este div (el 90% dinámico) -->
                <img 
                    src="img/Nosotros.jpg" 
                    alt="Imagen representativa de la sección Nosotros" 
                    onerror="this.onerror=null; this.src='https://placehold.co/1920x1080/004d40/ffffff?text=IMAGEN+NOSOTROS+RESPONSIVE';"
                >
            </div>
        </section>
        <section id="disfruta">
            <div id="section-body">
                <!-- Nota: La ruta 'img/banner_empresa.jpg' no se cargará en este entorno. Se usa un placeholder. -->
                <img src="img/disfruta.jpg" 
                    alt="Banner disfruta"
                    onerror="this.src='https://placehold.co/1920x800/2980b9/ffffff?text=Error+al+cargar+img/banner_empresa.jpg'">
            </div>
        </section>

        <!-- Sección de Título, Fondo y Menú (section-title) -->
         <section id="servicios">        
            <!-- Fila 1: Título y Menú (section-title) -->
            <div class="section-title" class="container-fluid" style="height: 70px;">
                <div class="row header-content align-items-center">
                    
                    <!-- Columna Izquierda: Título (20% en PC/Tablet, 100% en Móvil) -->
                    <!-- En móvil, usa col-12 y centrado. En PC, usa col-md-3 (cercano al 20%) y alineado a la izquierda. -->
                    <div class="col-12 col-md-3 text-center text-md-start">
                        <h2 class="text-white fw-bold fs-4 mb-0 mx-3 text-truncate">
                            SERVICIOS
                        </h2>
                    </div>
                    
                    <!-- Columna Derecha: Menú (80% en PC/Tablet, 100% en Móvil) -->
                    <!-- En móvil, usa col-12. En PC, usa col-md-9 (cercano al 80%) y alineado a la derecha. -->
                    <div class="col-12 col-md-9">
                        
                    </div>
                </div>
            </div>
            
            <!-- Fila 2: Contenido Principal (section-body) - 90% de Altura -->
            <div id="section-body" class="container-fluid p-0" style="height: 90vh;">             
                <!-- Wrapper para centrar y contener los botones -->
                <div class="button-area-wrapper">
                    <!-- 
                        ÁREA DE BOTONES RESPONSIVE
                    -->
                    <div class="responsive-grid">                        
                        <!-- Botón 1: Buscar Datos -->
                        <div class="button-item">
                            <button class="action-icon">
                                <!-- Icono SVG: Lupa (Buscar) -->
                                <img src="img/boton_residencial_01.png" alt="">
                            </button>
                            <span class="button-label">Residencial</span>
                            <!-- <span class="button-sublabel">Inicia la consulta</span> -->
                        </div>

                        <!-- Botón 2: Generar Informe -->
                        <div class="button-item">
                            <button class="action-icon">
                                <!-- Icono SVG: Documento/Archivo -->
                                <img width="120" src="img/boton_pyme_01.png" alt="">
                            </button>
                            <span class="button-label">Pyme</span>
                            <!-- <span class="button-sublabel">Crea el documento</span> -->
                        </div>

                        <!-- Botón 3: Ver Historial -->
                        <div class="button-item">
                            <button class="action-icon">
                                <!-- Icono SVG: Reloj (Historial) -->
                                <img width="120" src="img/boton_corporativo_01.png" alt="">
                            </button>
                            <span class="button-label">Corporativa Plus</span>
                            <!-- <span class="button-sublabel">Revisa tus acciones</span> -->
                        </div>

                        <!-- Botón 4: Configuración -->
                        <div class="button-item">
                            <button class="action-icon">
                                <!-- Icono SVG: Engranaje (Configuración) -->
                                
                                <img width="100" src="img/boton_isp_01.png" alt="">
                            </button>
                            <span class="button-label">ISP</span>
                            <!-- <span class="button-sublabel">Ajusta preferencias</span> -->
                        </div>

                    </div>
                </div>
            </div>
        </section>
        
        <section id="cobertura">        
            <!-- Fila 1: Título y Menú (section-title) -->
            <div class="section-title" class="container-fluid">
                <div class="row header-content align-items-center">
                    
                    <!-- Columna Izquierda: Título (20% en PC/Tablet, 100% en Móvil) -->
                    <!-- En móvil, usa col-12 y centrado. En PC, usa col-md-3 (cercano al 20%) y alineado a la izquierda. -->
                    <div class="col-12 col-md-3 text-center text-md-start">
                        <h2 class="text-white fw-bold fs-4 mb-0 mx-3 text-truncate">
                            
                        </h2>
                    </div>
                    
                    <!-- Columna Derecha: Menú (80% en PC/Tablet, 100% en Móvil) -->
                    <!-- En móvil, usa col-12. En PC, usa col-md-9 (cercano al 80%) y alineado a la derecha. -->
                    <div class="col-12 col-md-9">
                        <nav class="navbar navbar-expand-md d-none">
                            <div class="container-fluid justify-content-center justify-content-md-end p-0">
                                <!-- Los botones de menú se colapsan si es necesario (aunque aquí usamos una nav simple) -->
                                <ul class="navbar-nav navbar-nav-mobile-flex">
                                    <li class="nav-item">
                                        <a class="nav-link text-white fw-medium px-3" href="#">Inicio</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-white fw-medium px-3" href="#">Servicios</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-white fw-medium px-3" href="#">Contacto</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-white fw-medium px-3" href="#">Acerca de</a>
                                    </li>
                                </ul>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
            
            <!-- Fila 2: Contenido Principal (section-body) - 90% de Altura -->
            <div id="section-body" class="container-fluid p-0">
                <!-- La imagen ocupa el 100% del ancho y el 100% de la altura de este div (el 90% dinámico) -->
                <img 
                    src="img/cobertura.png" 
                    alt="Imagen representativa de la sección Nosotros" 
                    onerror="this.onerror=null; this.src='https://placehold.co/1920x1080/004d40/ffffff?text=IMAGEN+NOSOTROS+RESPONSIVE';"
                >
            </div>
        </section>
        
    </main>

    <!-- COMPONENTE FOOTER -->
    <footer>
        <!-- FILA 1: 4 COLUMNAS (Logo, Dirección, Horario, Menú/Correo) -->
        <div class="footer-top">
            <div class="container">
                <div class="row">
                    
                    <!-- Columna 1: Logo -->
                    <div class="col-12 col-md-3">
                        <img src="img/logo_rednet_WHITE.png" 
                             class="img-fluid mb-3" alt="Logo Rednet Footer">                        
                    </div>

                    <!-- Columna 2: Dirección -->
                    <div class="col-12 col-md-3">
                        <p class="footer-title">
                            <!-- Icono de ubicación -->
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="white" class="bi bi-geo-alt-fill me-2" viewBox="0 0 16 16">
                                <path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10m0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6"/>
                            </svg>
                            Dirección
                        </p>
                        <p class="footer-text">
                            Av. Principal, Edificio Tech<br>
                            Piso 5, Oficina 501, Caracas, VE
                        </p>
                    </div>

                    <!-- Columna 3: Horario de Atención -->
                    <div class="col-12 col-md-3">
                        <p class="footer-title">
                             <!-- Icono de reloj -->
                             <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="white" class="bi bi-clock-fill me-2" viewBox="0 0 16 16">
                                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-8 3.5a.5.5 0 0 0 .5-.5V7.793l2.354 2.353a.5.5 0 0 0 .708-.708l-2.75-2.75a.5.5 0 0 0-.5-.5h-2.5a.5.5 0 0 0 0 1h2a.5.5 0 0 0 .5.5z"/>
                            </svg>
                            Horario de atención
                        </p>
                        <!-- Lunes - Viernes -->
                        <p class="footer-text mb-0">LUNES - VIERNES: 8:00 a.m. - 5:00 p.m.</p>
                        <!-- Sábados -->
                        <p class="footer-text">SÁBADOS: 8:00 a.m. - 2:00 p.m.</p>
                    </div>

                    <!-- Columna 4: Menú y Correo -->
                    <div class="col-12 col-md-3">
                        <p class="footer-title">
                            <!-- Icono de lista -->
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="white" class="bi bi-list me-2" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5"/>
                            </svg>
                            Menú
                        </p>
                        <!-- Inicio -->
                        <a href="#" class="footer-link">Inicio</a>
                        <!-- Empresa -->
                        <a href="#" class="footer-link mb-4">Empresa</a>
                        
                        <!-- Icono de carta y Correo -->
                         <p class="footer-title mt-3">
                            <!-- Icono de carta -->
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="white" class="bi bi-envelope-fill me-2" viewBox="0 0 16 16">
                                <path d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414z"/>
                                <path d="M0 4.697v7.104l5.803-3.558zM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586zm3.436-.586L16 11.801V4.697z"/>
                            </svg>
                            Correo
                        </p>
                        <p class="footer-text">contacto@rednetve.com</p>
                    </div>

                </div>
            </div>
        </div>

        <!-- FILA 2: COPYRIGHT Y REDES SOCIALES (Dos Columnas) -->
        <div class="footer-bottom">
            <div class="container">
                <div class="row align-items-center">
                    
                    <!-- Columna 1: Derechos Reservados -->
                    <div class="col-12 col-md-6 text-center text-md-start">
                        <span class="copyright-text">
                            Todos los derechos reservados | Rednetve 2025
                        </span>
                    </div>

                    <!-- Columna 2: Redes Sociales -->
                    <div class="col-12 col-md-6 text-center text-md-end mt-2 mt-md-0">
                        <!-- Facebook -->
                        <a href="#" class="social-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-facebook" viewBox="0 0 16 16"><path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.008 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.943 0-1.29.585-1.29 1.25V8.05h2.22l-.356 2.072H10.5V16c3.824-.604 6.75-3.934 6.75-7.951"/></svg>
                        </a>
                        <!-- Twitter -->
                        <a href="#" class="social-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-twitter-x" viewBox="0 0 16 16"><path d="M12.673 3.633a7.485 7.485 0 0 1-2.181.766 3.737 3.737 0 0 0-1.018-1.787 7.464 7.464 0 0 0-4.634.053 3.702 3.702 0 0 0 2.21 2.95 3.735 3.735 0 0 1-1.705-.471v.048a3.743 3.743 0 0 0 2.996 3.666A3.712 3.712 0 0 1 5.378 9.38L5.3 9.405a3.737 3.737 0 0 0 3.486 2.604 7.491 7.491 0 0 1-5.358 1.83 7.49 7.49 0 0 1-1.44-.085 10.575 10.575 0 0 0 5.093 1.488c6.115 0 9.444-5.07 9.444-9.445v-.392a6.76 6.76 0 0 0 1.57-1.638z"/></svg>
                        </a>
                        <!-- Instagram -->
                        
                    </div>

                </div>
            </div>
        </div>
    </footer>

</body>
</html>