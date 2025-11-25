<style>
    .dropdown-menu {
        text-align: left !important;
        }
</style>
<ul class="navbar-nav d-flex mb-2 mb-lg-0 w-75 d-flex justify-content-around titulo">
    <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="index.html">Inicio</a>
    </li>
    <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="#">Portafolio</a>
    </li>
    <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="#">Conocenos</a>
    </li>
    <li class="nav-item">
        <a class="nav-link active" href="/neg/comercio1">Pasarela</a>
    </li>
    </ul>

    @auth
    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item dropdown">
        <a class="nav-link active dropdown-toggle titulo" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <span class="ml-1" x-ref="username">{{ auth()->user()->name }}</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="{{ route('admin.profile.edit') }}" x-ref="profileLink">Perfil</a>
            <a class="dropdown-item" href="{{ route('admin.dashboard') }}" x-ref="profileLink">Dashboard</a>
            <a class="dropdown-item" href="{{ route('admin.profile.edit') }}" x-ref="changePasswordLink">Cambiar Contraseña</a>
            <a class="dropdown-item" href="{{ route('admin.settings') }}">Configuración</a>
            <div class="dropdown-divider"></div>
            <form method="POST" action="{{ route('logout') }}">
                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">Salir</a>
            </form>
        </div>
        </li>
    </ul>
    @endauth
    
    @guest
    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item dropdown">
        <a class="nav-link active dropdown-toggle titulo" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="/img/icon_miperfil.png" width="25px" alt="" class="mx-1">Perfil
        </a>
        <ul class="dropdown-menu">
            <li class="mx-2">
                <div class="d-flex justify-content-between mb-2">
                    <img src="/img/icon_soporte.png" style="width: 18px; height: 25px;">
                    <a class="dropdown-item" href="#">Soporte en Línea</a>
                </div>
            </li>
            <li class="mx-2">
                <div class="d-flex justify-content-between mb-2">
                    <img src="/img/icon_registrarse.png" style="width: 18px; height: 25px;">
                    
                    <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#registerModal" style="cursor: pointer;">Registrarse</a>

                </div>
            </li>                  
            <li class="mx-2">
                <div class="d-flex justify-content-between mb-2">
                    <img src="/img/icon_entrar.png" style="width: 18px; height: 25px;">

                    <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#loginModal" style="cursor: pointer;">Entrar</a>

                </div>
            </li>
        </ul>
        </li>
    </ul>
    @endguest
    
    <!--<form class="d-flex" role="search">
    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
    <button class="btn btn-outline-success" type="submit">Search</button>
    </form> -->
</div>