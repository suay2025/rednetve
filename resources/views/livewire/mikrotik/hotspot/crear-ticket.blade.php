<div>
    @push('js')
    <script src="https://cdn.jsdelivr.net/npm/qrcodejs@1.0.0/qrcode.min.js"></script>
    @endpush('js')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Crear Ticket</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/admin/dashboard">Escritorio</a></li>
                        <li class="breadcrumb-item active">Crear Ticket</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-lg-12">
                    <div class="d-flex justify-content-between mb-2">
                        <button wire:click.prevent="addNew" class="btn btn-primary"><i class="fa fa-plus-circle mr-1"></i> Nuevo Usuario</button>
                        <div></div>
                    </div>
                    <div class="card">
                        <form autocomplete="off" wire:submit.prevent="{{ $showEditModal ? 'updateHotspot' : 'createHotspotUsers' }}">
                        <div class="card-body">                            
                            <div class="row">
                                <div class="form-group col-md-4 col-4">
                                    <label for="server">Hotspot</label>
                                    <select name="server" wire:model.defer="state.server" class="form-control @error('server') is-invalid @enderror" id="server" wire:ignore.self>
                                        <option value="0">SELECCIONE..</option>
                                        @foreach($nameshotspots as $hotspot)
                                            <option value="{{$hotspot}}">{{$hotspot}}</option>
                                        @endforeach
                                    </select>
                                    <button wire:click.prevent="showUsersHotspot" class="btn btn-primary my-2"><i class="fa fa-plus-circle mr-1"></i> Ver Usuarios</button>
                                    @error('server')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="form-group col-md-3 col-3">
                                    <label for="profile">Perfil de Usuario</label>
                                    <select name="profile" wire:model.defer="state.profile" class="form-control @error('profile') is-invalid @enderror" id="profile" wire:ignore.self>
                                        <option value="0">SELECCIONE..</option>
                                        @foreach($namesprofiles as $profile)
                                            <option value="{{$profile}}">{{$profile}}</option>
                                        @endforeach
                                    </select>
                                    @error('profile')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="form-group col-md-3 col-3">
                                    <label for="totalTicket">N° de ticket(s)</label>
                                    <input type="text" wire:model.defer="state.totalTicket" class="form-control @error('totalTicket') is-invalid @enderror" id="totalTicket" aria-describedby="totalTicketHelp" placeholder="Total de Tickets">
                                    @error('totalTicket')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>                            
                        </div>
                        <div class="card-footer d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-save mr-1"></i>
                                @if($showEditModal)
                                <span>Guardar Cambios</span>
                                @else
                                <span>Crear Ticket(s)</span>
                                @endif
                            </button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 col-12">
                    <div class="row seccion-qr">                        
                                             
                    </div>
                    
                </div>
            </div>

            <div class="row my-3 d-none">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <h1>QR Code Generator</h1>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <p>Enter the text you want to encode into a QR code:</p>
                            <input type="text" id="textInput" placeholder="Enter text here" value="https://www.google.com">
                        </div>
                        <div class="col-md-6">
                            <button onclick="generateQr()">Generate QR Code</button>
                        </div>
                    </div>
                    <div class="row my-3">
                        <div class="col-md-12 col-12">
                            <div id="qrcode"></div>        
                        </div>
                    </div>
                    
                </div>     
                <br><br>
                <script>
                    function generateQr() {
                        const text = document.getElementById("textInput").value;
                        const qrcodeElement = document.getElementById("qrcode");
                        
                        // Clear previous QR code if it exists
                        qrcodeElement.innerHTML = "";
                        
                        if (text.trim() !== '') {
                            // Generate the QR code
                            new QRCode(qrcodeElement, {
                                text: text,
                                width: 200,
                                height: 200,
                                colorDark : "#333333",
                                colorLight : "#FFFFFF",
                                correctLevel : QRCode.CorrectLevel.H
                            });
                        } else {
                            qrcodeElement.innerHTML = "<p>Please enter some text to generate a QR code.</p>";
                        }
                    }
                    
                    // Generate a QR code on page load with the default value
                    window.onload = generateQr;
                </script>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
    <script>
        window.addEventListener('crear-qr', event => {
            let usershotspot = event.detail.usershotspot

            let seccionQr = document.querySelector('.seccion-qr')
            seccionQr.innerHTML = ''

            let contenido ='';
            usershotspot.forEach((user) => {
                contenido = `<div class="col-md-4 col-4">
                            <div class="card shadow w-75">
                                <div class="card-body">
                                    <div class="text-center">${user['name']}</div>
                                    <div style="width:100px; height:100px;" id="qr${user['name']}"></div>
                                </div>
                            </div>                                    
                        </div>`
                seccionQr.innerHTML += contenido

                
            });
            usershotspot.forEach((user) => {
                doQr(user)
            });
        
        }) 

        function doQr(user)
        {
            let text = user['name'] + '&' + user['password']
            let qrcodeElement = document.getElementById("qr"+user['name']);
            
            // Clear previous QR code if it exists
            qrcodeElement.innerHTML = "";
            
            if (text.trim() !== '') {
                // Generate the QR code
                new QRCode(qrcodeElement, {
                    text: text,
                    width: qrcodeElement.offsetWidth, //200,
                    height: qrcodeElement.offsetHeight, //200,
                    colorDark : "#333333",
                    colorLight : "#FFFFFF",
                    correctLevel : QRCode.CorrectLevel.H
                });
            } else {
                qrcodeElement.innerHTML = "<p>Please enter some text to generate a QR code.</p>";
            }
        }
        //doQr()
    </script>
</div>
