<div>
 <style>
    .navbar {      
      background-image: url('/img/panexpres_banner_2-compressed.jpg') !important;
      background-size: 100vw auto !important;
      background-repeat: no-repeat;
      height: 200px !important;
    }   

    .negrita {
      font-weight: 900;
    }

    @media only screen and (max-width: 1070px) {
      
    }
    
 </style>
<nav class="navbar navbar-light bg-light fondo" >
  <div class="d-flex justify-content-between">
    <a class="navbar-brand" href="/"><img class="logo-responsive" style=" width: 265px !important; " src="{{ $comercio->avatar_url }}" alt=""></a>
  </div>
</nav>
<div class="row">
    <div class="col-sm-12">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item negrita"> Divisa @livewire('components.currency')</li>
        </ol>
    </div>
</div>
</div>