<div>
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/style-welcome.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <div class="row">
        <div class="col-md-12 d-flex">
            <div class="card mx-auto" style="margin-top: 15px; width:48rem;">
                <div class="card-body">
                    <form action="{{ route('autenticar') }}" method="POST">
                        @csrf
                        <div class="group-control">
                            <label class="text-bold Text-Uppercase" for="">Inicia Sesión</label>
                        </div>
                        <div class="group-control my-3">
                            <a class="form-control text-center" href="/login-google"><i class="fa fa-brands fa-google"></i> Iniciar con Google</a>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-xs-6 col-md-4 col-sm-4 col-4">
                                    <label for="identificationNac">Tipo </label>
                                    <select class="form-control @error('identificationNac') is-invalid @enderror" name="identificationNac" id="identificationNac" placeholder="Tipo">
                                        <option value="J">J-</option>
                                        <option value="E">E-</option>
                                        <option value="G">G-</option>
                                        <option value="P">P-</option>
                                        <option value="V" selected>V-</option>
                                    </select>
                                </div>
                                <div class="col-xs-6 col-md-8 col=sm-8 col-8">
                                    <label for="identificationNumber">Documento</label>
                                    <input type="text" class="form-control @error('identificationNumber') is-invalid @enderror" name="identificationNumber" id="identificationNumber" placeholder="Documento">
                                </div>
                                @error('identificationNumber')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>                            
                        </div>
                        
                        <div class="form-group my-3">
                            <div class="row" >
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <label for="email">Correo Electrónico</label>
                                    <input type="email" name="email" class="form-control inputForm" placeholder="Correo Electrónico" id="emailW">
                                </div>
                            </div>
                            @error('email')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                
                        <div class="form-group my-3">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <label for="password">Contraseña</label>
                                    <input type="password" name="password" id="password-fieldW" class="form-control inputForm" placeholder="Contraseña" value="12345678"/>
                                </div>
                            </div>                
                        </div>          
                        
                        <div class="form-group">
                            <div class="row my-3">
                                <div class="col-xs-12 col-sm-12 col-md-12 d-flex">
                                    <button class="btn btn-app w-100 mx-auto">Iniciar Sesión</button>
                                </div>
                            </div>                
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>