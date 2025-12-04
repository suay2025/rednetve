<div class="navigationMap">
    <link rel="stylesheet" href="/css/navigationMap.css">
    <div class="row">
        <div class="col-xl-4 logoNM">
            <img class="logo-responsiveNM" src="/img/panexpres_logo_blanco.png" alt="">
        </div>
        <div class="col-xl-8 d-flex flex-column align-self-start">
            <div class="row">
                <div class="col-3">
                    <p>Acerca de {{ $comercio->name }}</p>
                </div>
                <div class="col-3">
                    <p>Categorias</p>
                </div>
                <div class="col-3">Ayuda</div>
                <div class="col-3"><a class="text-white" href="{{ route('admin.profile.edit') }}">Mi Perfil</a></div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <!-- Social Media Buttons HTML -->
            <div class="wrapperRedes d-flex justify-content-start navigationMap">
                <a href="{{ $comercio->instagram }}" class="icon instagram">
                    <div class="tooltip">Instagram</div>
                    <span><i class="fab fa-instagram"></i></span>
                </a>
            </div>
            <!-- End Social Media Buttons HTML -->
        </div>
    </div>
</div>
