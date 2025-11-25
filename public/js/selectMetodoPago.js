function selectMetodoPago(index1 = 0)
{
    let index = index1

    let bloque = document.createElement('div')
    bloque.id = index
    let pantalla = 'p-' + index
    bloque.classList.add( pantalla)

    let row0 = document.createElement('div')
    let h40 = document.createElement('div')
    h40.classList.add('titulo', 'c-a')
    h40.innerHTML = "MÉTODOS DE PAGO"

    let group = document.createElement('div')
    group.classList.add('group-control')

    select = document.createElement('select')
    select.classList.add('form-control', 'inputForm', 'my-2', 'noradiance', 'selectModoPago')
    select.id = "s"+index
    select.pantalla = pantalla
    
    let option0 = document.createElement('option')
    option0.classList.add('optionModoPago')
    option0.value="0"
    option0.innerHTML = "Seleccione.."

    let option1 = document.createElement('option')
    option1.classList.add('optionModoPago')
    option1.value="tarjetadebito"
    option1.innerHTML = "TARJETA DE DÉBITO"

    let option2 = document.createElement('option')
    option2.classList.add('optionModoPago')
    option2.value="transferencia"
    option2.innerHTML = "TRANSFERENCIA"

    let option3 = document.createElement('option')
    option3.classList.add('optionModoPago')
    option3.value="pagomovil"
    option3.innerHTML = "PAGO MÓVIL"

    let option4 = document.createElement('option')
    option4.classList.add('optionModoPago')
    option4.value="zelle"
    option4.innerHTML = "ZELLE"

    let spanR = document.createElement('div')
    spanR.classList.add('my-2')
    spanR.innerText = "Seleccione el Método de Pago de su preferencia"
    spanR.classList.add('textInfo')

    let spanP = document.createElement('div')
    spanP.classList.add('my-2')
    spanP.innerText = "Monto a Pagar"
    let spanT = document.createElement('div')
    spanT.classList.add('montoPagar')
    spanT.innerText = "BS. 30,00"
    
    bloque.appendChild(row0)
    row0.appendChild(h40)
    row0.appendChild(group)
    bloque.appendChild(spanP)
    bloque.appendChild(spanT)

    group.appendChild(select)
    group.appendChild(spanR)
    select.appendChild(option0)
    select.appendChild(option1)
    select.appendChild(option2)
    select.appendChild(option3)
    select.appendChild(option4)
    
    select.addEventListener('change', selectModo)

    return bloque

}

function selectModo(e) {
    
    let elementos = {
        'pantalla': '',
        'modopago': '',
        'referencia': '',
        'cedula': '',
        'telefono': '',
        'banco': 'VZLA',
        'codigo': '',
        'fechaPago': '',
        'fecha': '',
        'monto': '',
    }
    
    let index = e.target.selectedIndex;
    //transaccion.banco = e.target.options[index].text
    if(index !== 0 )
    {
        this.style.backgroundColor = "#4447eb";
        this.style.color = "white";
    }else{
        this.style.backgroundColor = "white";
        this.style.color = "black";
    }

    let pantalla = '' + e.target.pantalla

    let ele = elementos
    
    ele.modopago = e.target.value
    ele.pantalla = pantalla

    transaccion.push(ele);


    let bloque = document.getElementsByClassName(pantalla)

    // Eliminar pantalla anterior si existe
    let element = document.querySelector(".sub-"+pantalla);

    //app.firstElementChild; 
    if(element)
        element.remove(); // Elimina el div
    // Fin de eliminar pantalla

    if(index!==0){   
        switch (e.target.value) {
            case 'tarjetadebito':
                bloque[0].appendChild(crearPantallaTarjetaDebito(pantalla))
                /* asignar valores */
                document.getElementById('identificationNac1').value = identificationNac
                document.getElementById('identificationNumber1').value = identificationNumber
                document.getElementById('premovil').value = cellphone.substring(0, 4);
                document.getElementById('movil').value = cellphone.substring(4, cellphone.length);
                //crear form                
                //bloque[0].appendChild(crearFormPagoTarjeja())
                document.querySelector('#identificationNac').value = identificationNac
                document.querySelector('#identificationNumber').value = identificationNumber
                document.querySelector('#rifLetter').value = rifLetter
                document.querySelector('#rifNumber').value = rifNumber
                document.querySelector('#amount').value = amount
                document.querySelector('#currency').value = currency
                document.querySelector('#reference').value = reference
                document.querySelector('#cellphone').value = cellphone
                document.querySelector('#email').value = email
                document.querySelector('#title').value = title
                document.querySelector('#description').innerText = description                
                initFormulario()
                break;
            
            case 'pagomovil':
                bloque[0].appendChild(crearPantallaPagoMovil(pantalla))
                document.getElementById('identificationNacPM').value = identificationNac
                document.getElementById('identificationNumberPM').value = identificationNumber
                document.getElementById('cellphonecodePM').value = cellphone.substring(0, 4);
                document.getElementById('cellphonePM').value = cellphone.substring(4, cellphone.length);
                break;
            
            case 'transferencia':
                bloque[0].appendChild(crearPantallaTransferencia(pantalla))
                document.getElementById('identificationNacT').value = identificationNac
                document.getElementById('identificationNumberT').value = identificationNumber
                break;
            
            case 'zelle':
                bloque[0].appendChild(crearPantallaZelle(pantalla))
                break;
        
            default:
                
                //bloque[0].appendChild(crearPantalla(pantalla))
                break;
        }
    }
}

function crearFormPagoTarjeja(){

    let formulario = `
    <form id="form" method="post" autocomplete="off" class="needs-validation" novalidate>
        <div class="row">
            <!--Es persona jurídica-->
            <div class="col-4 mb-3">
                <div class="form-check form-switch p-0">
                    <label class="form-check-label" for="chkJuridicalPerson">Es Persona Jurídica</label>
                    <br />
                    <input class="form-check-input m-0 mt-2" type="checkbox" id="chkJuridicalPerson">
                </div>
            </div>

            <!--Cédula-->
            <div class="col-4 mb-3">
                <label class="form-label" for="identificationNumber">Cédula *</label>
                <div class="row">
                    <div class="col-4">
                        <select id="identificationNac" name="identificationNac" class="form-select">
                            <option value="V">
                                V
                            </option>
                            <option value="E">
                                E
                            </option>
                            <option value="P">
                                P
                            </option>
                        </select>
                    </div>
                    <div class="col-8 ps-0 validate-me">
                        <input id="identificationNumber" name="identificationNumber"
                                class="form-control" maxlength="20" value="" required>
                    </div>
                </div>
            </div>

            <!--Rif-->
            <div class="col-4 mb-3">
                <label for="rifLetter" class="form-label" disabled>RIF *</label>
                <div class="row">
                    <div class="col-4">
                        <select id="rifLetter" name="rifLetter" class="form-select" required>
                            <option value="J">
                                J
                            </option>
                            <option value="G">
                                G
                            </option>
                        </select>
                    </div>
                    <div class="col-8 ps-0 validate-me">
                        <input id="rifNumber" name="rifNumber" class="form-control" maxlength="20" required>
                    </div>
                </div>
            </div>

            <!--Monto-->
            <div class="col-4 mb-3 validate-me">
                <label for="amount" class="form-label">Monto *</label>
                <input id="amount" name="amount" class="form-control" maxlength="10" value="" required readonly>
            </div>

            <!--Moneda-->
            <div class="col-4 mb-3">
                <label for="currency" class="form-label">Moneda *</label>
                <div class="row">
                    <div class="col">
                        <select id="currency" name="currency" class="form-select" style="width:100%">
                            <option value="1">
                                Bolivares
                            </option>
                        </select>
                    </div>
                </div>
            </div>

            <!--Referencia-->
            <div class="col-4 mb-3 validate-me">
                <label for="reference" class="form-label">Referencia *</label>
                <input id="reference" name="reference" class="form-control" maxlength="50" value="" required readonly>
            </div>

            <!--Teléfono-->
            <div class="col-4 mb-3 validate-me">
                <label for="cellphone" class="form-label">Teléfono *</label>
                <input id="cellphone" name="cellphone" class="form-control" maxlength="30" value="" required>
            </div>

            <!--Mail-->
            <div class="col-8 mb-3">
                <label for="email" class="form-label">Correo Electrónico</label>
                <input id="email" name="email" type="email" class="form-control" maxlength="50" value="">
            </div>

            <!--Título-->
            <div class="col-4 mb-3 validate-me">
                <label for="title" class="form-label">Título *</label>
                <input id="title" name="title" class="form-control" maxlength="50" required readonly value="">
            </div>

            <!--Descripción-->
            <div class="col-8 mb-3 validate-me">
                <label for="description" class="form-label">Descripción *</label>
                <textarea id="description" name="description" class="form-control" maxlength="500" rows="3" required readonly></textarea>
            </div>

        </div>
        
            <img src="/images/botondepago.png" alt="App Logo" height="50px" width="100px" />
        
        <div class="row mb-2 mt-3">
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <input id="btnCreatePayment" type="submit" value="Iniciar Proceso de Pago" class="btn btn-success">                
            </div>
        </div>
    </form>    
    `
    //return formQue
    return formulario
}

//PAGO MOVIL
function crearPantallaPagoMovil(pantalla)
{   
    var bloqueP= document.createElement('div') 
    bloqueP.classList.add('sub-' + pantalla) //para agregar el footer al final

    let montopagar = document.createElement('div')

    let spanR = document.createElement('div')
    spanR.innerText = "Realiza el pago móvil con los datos presentados a continuación"
    spanR.classList.add('textInfo', 'my-2', 'negrita')

    bloqueP.appendChild(spanR)

    bancoasociadoPM = document.createElement('select')
    bancoasociadoPM.classList.add('form-control', 'inputForm', 'my-2', 'noradiance')
    bancoasociadoPM.id = "bancoasociado"

    let option = document.createElement('option')
    option.value='0'
    option.innerHTML = 'Seleccione un Banco'
    bancoasociadoPM.appendChild(option)       
    //Llena el select bancoasociado
    bancosAsociadosPM.forEach(element => {
        let option = document.createElement('option')
        option.value=element.codigo
        option.innerHTML = element.banco
        bancoasociadoPM.appendChild(option)       
    });

    bloqueP.appendChild(bancoasociadoPM)

    var spanGroup = document.createElement('div')
    spanGroup.classList.add('d-none')
    spanGroup.id = 'spanGroup'
    spanGroup.innerHTML = ""
    bloqueP.appendChild(spanGroup)

    bancoasociadoPM.addEventListener('change', function(){
        
        var spanDP = document.createElement('div')
        spanDP.classList.add('textInfo', 'divInfo', 'text-center', 'font-weight-bold')
        var spanGroupBotones = document.createElement('div')
        spanGroup.innerHTML = ""
        spanGroup.appendChild(spanDP)
        //transaccion.banco = e.target.options[index].text
        var codigo = this.value
        var pagomovil;
        
        if(codigo === '0'){
            spanDP.innerHTML = ``
            spanGroup.classList.add('d-none')
            return 0
        }else{
            var banco = bancosAsociadosPM.some(function(buscar){
                if(buscar.codigo === codigo)
                {
                    pagomovil = buscar
                }                    
            });

            spanGroup.classList.remove('d-none')            
            spanDP.innerHTML = `<div class='negrita'>RIF/CEDULA</div><div>${pagomovil.cedula}</div>
                            <div class='negrita'>BANCO</div><div>${pagomovil.banco}</div>
                            <div class='negrita'>TELÉFONO</div><div>${pagomovil.telefono}</div>
            `

        }

    })

    let bottopP = document.createElement('div')
    bottopP.classList.add('bottopP', 'negrita1')
    bloqueP.appendChild(bottopP)
    
    let a = document.createElement('a')
    a.src = "#"
    a.index = pantalla
    a.classList.add('titulo')
    a.innerHTML = "Agregar"
    let span = document.createElement('span')
    span.innerText = 'Método de Pago Múltiple'
    span.classList.add('textInfo', 'negrita')
    a.classList.add('c-a', 'mx-1')    
    if(pantalla == 'p-0'){
        bottopP.appendChild(span)
        bottopP.appendChild(a)
    }
    a.addEventListener('click', nuevoBloque)
    
    let a1 = document.createElement('a')
    a1.src = "#"
    a1.classList.add('enlaceEliminar')
    a1.innerHTML = "¿Eliminar Pantalla?"
    a1.index = pantalla
    a1.addEventListener('click', eliminarBloque)

    if(pantalla !== 'p-0'){
        bottopP.appendChild(a1)
    }

    let formulario = document.createElement('div')
    
    formulario.innerHTML = showFormGrupoPagoMovil()

    bloqueP.appendChild(formulario)

    return bloqueP
}

function nuevoBloque()
{
    
    //let index = Object.keys(transaccion).length
    
    function verificarCampo(elemento){

        for (let x = 0; x < transaccion.length; x++) {
            
            let busqueda = transaccion.some((buscar) => buscar.pantalla === "p-"+x);
            console.log(x + ' - ' + busqueda)
            if(!busqueda){
                return x
            }
            
        }

        return Object.keys(transaccion).length
        
    }

    let result = verificarCampo('pantalla')

    console.log(result)

    let divPrincipal = document.getElementById('divPrincipal')
    divPrincipal.appendChild(selectMetodoPago(result))        
    //Tamaño del array
    
}

function eliminarBloque()
{
    console.log('antes');
    console.log(transaccion);

    let pantalla = this.index

    transaccion.splice(getIndice(pantalla), 1); //elimina el producto del arreglo

    console.log('despues');
    console.log(transaccion);

    function getIndice(IdPantalla) {
        var Indice = -1;
        transaccion.filter(function (producto, i) {
            if (producto.pantalla === IdPantalla) {
                Indice = i;
            }
        });
        return Indice;
    }

    
    // Eliminar pantalla anterior si existe
    let element = document.querySelector("."+this.index);

    //delete transaccion[this.index];


    //app.firstElementChild; 
    if(element)
        element.remove(); // Elimina el div
    // Fin de eliminar pantalla

}

function showFormGrupoPagoMovil ()
{
    
    let formGrupo = `
    <div class="formPM">
    <div class="row">
        <div class="col-lg-12 text-justity pt-3 negrita">Ingresa los datos de tu pago</div>
    </div>
        <div class="form-group">
            <div class="row mx-auto">
                <div class="col-xs-6 col-md-4 col-sm-4 col-4">
                    <label for="identificationNacPM">Tipo </label>
                    <select class="form-control inputForm inputType" name="" id="identificationNacPM" placeholder="Tipo">
                        <option value="V">V-</option>
                        <option value="J">J-</option>
                        <option value="E">E-</option>
                        <option value="G">G-</option>
                        <option value="P">P-</option>
                    </select>
                </div>
                <div class="col-xs-6 col-md-8 col=sm-8 col-8">
                    <label for="identificationNumberPM">Documento</label>
                    <input type="text" id="identificationNumberPM" class="form-control inputForm" placeholder="Documento">
                </div>
            </div>                        
        </div>

        <div class="row">
            <div class="col-lg-12 text-justity pt-3 negrita">Ingresa el número de teléfono asociado al
                pago móvil</div>
        </div>

        <div class="row mx-auto">
                <div class="col-xs-6 col-md-4 col-sm-4 col-4">
                    <select class="form-control inputForm inputType" name="" id="cellphonecodePM">
                        <option value="0">Seleccione</option>
                        <option value="0412">0412</option>
                        <option value="0414">0414</option>
                        <option value="0424">0424</option>
                        <option value="0416">0416</option>
                        <option value="0426">0426</option>
                    </select>
                </div>
                <div class="col-xs-6 col-md-8 col-sm-8 col-8">
                    <input type="text" class="form-control inputForm" id="cellphonePM">
                </div>
            </div>

        <div class="row">
            <div class="col-lg-12 text-justity pt-3 negrita">Cuenta Comercio</div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <select class="form-control inputForm" name="" id="codigoPM">
                    <option value="0">Seleccione una Cuenta</option>
                    `
                    let option = ''
                    bancosAsociadosPM.forEach(element => {
                        option += `
                            <option value="${element.codigo}">${element.banco}</option>
                        `
                    });
    formGrupo += option
                    
    formGrupo += `
                </select>
            </div>                        
        </div>

        <div class="form-group pt-3">
            <div class="row">
                <div class="col-xs-12 col-lg-12 col-sm-12 col-md-12">
                    <label for="amountPM">Monto cancelado</label>
                    <input type="number" class="form-control inputForm" name="amountPM" id="amountPM" placeholder="Monto cancelado"/>
                </div>
            </div>                
        </div>

        <div class="form-group pt-3">
            <div class="row">
                <div class="col-xs-12 col-lg-12 col-sm-12 col-md-12">
                    <label for="referencePM">Registra la referencia del pago</label>
                    <input type="number" class="form-control inputForm" name="referencePM" id="referencePM" placeholder="Registra la referencia del pago"/>
                </div>
            </div>                
        </div>
        
        <div class="form-group">
            <div class="row mx-auto my-3 p-3">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <button id="enviarPagoMovil" class="btn boton1 w-100" onClick="enviarPagoMovil()">Reporta el pago</button>
                </div>
            </div>    
        </div>
        `
    return formGrupo
}

//TARJETA DE DEBITO
function crearPantallaTarjetaDebito(pantalla)
{   
    var bloqueP = document.createElement('div') 
    bloqueP.id = "bloqueP"
    bloqueP.classList.add('sub-' + pantalla) //para agregar el footer al final

    let montopagar = document.createElement('div')

    let spanR = document.createElement('div')
    spanR.id = "spanR"
    spanR.innerText = "Realiza el pago con los datos presentados a continuación"
    spanR.classList.add('textInfo', 'my-2', 'negrita')

    bloqueP.appendChild(spanR)

    let formGrupoTarjetaDebito = document.createElement('div')
    formGrupoTarjetaDebito.id = "formGrupoTarjetaDebito"
    formGrupoTarjetaDebito.innerHTML = showFormGrupoTarjetaDebito()
    
    bloqueP.appendChild(formGrupoTarjetaDebito)
    var spanGroupT = document.createElement('div')
    spanGroupT.classList.add('d-none')
    spanGroupT.id = 'spanGroup'
    spanGroupT.innerHTML = ""
    bloqueP.appendChild(spanGroupT)
    
    let bottopP = document.createElement('div')
    bottopP.classList.add('bottopP', 'negrita1')
    bloqueP.appendChild(bottopP)
    
    let a = document.createElement('a')
    a.src = "#"
    a.index = pantalla
    a.classList.add('titulo')
    a.innerHTML = "Agregar"
    let span = document.createElement('span')
    span.innerText = 'Método de Pago Múltiple'
    span.classList.add('textInfo', 'negrita')
    a.classList.add('c-a', 'mx-1')    
    if(pantalla == 'p-0'){
        bottopP.appendChild(span)
        bottopP.appendChild(a)
    }
    a.addEventListener('click', nuevoBloque)
    
    let a1 = document.createElement('a')
    a1.src = "#"
    a1.classList.add('enlaceEliminar')
    a1.innerHTML = "¿Eliminar Pantalla?"
    a1.index = pantalla
    a1.addEventListener('click', eliminarBloque)

    if(pantalla !== 'p-0'){
        bottopP.appendChild(a1)
    }

    let formulario = document.createElement('div')
    formulario.classList.add('d-none')
    formulario.innerHTML = crearFormPagoTarjeja()

    bloqueP.appendChild(formulario)

    return bloqueP
}

function showFormGrupoTarjetaDebito()
{
    let formGrupo = `
        <div class="row">
            <div class="col-lg-12 text-justity pt-3 negrita">Ingresa los datos de tu pago</div>
        </div>

        <div class="row">
            <div class="col-lg-12 text-justity pt-3 negrita">Ingresa tu número de Cédula o RIF</div>
        </div>

        <div class="form-group">
            <div class="row mx-auto">
                <div class="col-xs-6 col-md-4 col-sm-4 col-4">
                    <label for="identificationNac1">Tipo </label>
                    <select class="form-control inputForm inputType" name="" id="identificationNac1" placeholder="Tipo">
                        <option value="J">J-</option>
                        <option value="E">E-</option>
                        <option value="G">G-</option>
                        <option value="P">P-</option>
                        <option value="V" selected>V-</option>
                    </select>
                </div>
                <div class="col-xs-6 col-md-8 col=sm-8 col-8">
                    <label for="identificationNumber1">Documento</label>
                    <input type="text" id="identificationNumber1" class="form-control inputForm" placeholder="Documento">
                </div>
            </div>                        
        </div>

        <div class="row">
            <div class="col-lg-12 text-justity pt-3 negrita">Ingresa el número de teléfono asociado al
                Banco</div>
        </div>

        <div class="row">
            <div class="col-xs-6 col-md-4 col-sm-4 col-4">
                <select class="form-control inputForm inputType" name="" id="premovil">
                    <option value="0">Seleccione</option>
                    <option value="0412">0412</option>
                    <option value="0414">0414</option>
                    <option value="0424">0424</option>
                    <option value="0416">0416</option>
                    <option value="0426">0426</option>
                </select>
            </div>
            <div class="col-xs-6 col-md-8 col-sm-8 col-8">
                <input type="text" class="form-control inputForm" id="movil">
            </div>
        </div>
    
        <div class="form-group">
            <div class="row mx-auto my-3 p-3">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <button id="procesarTarjeta" class="btn boton1 w-100" onClick="procesarTarjeta()">PROCESAR</button>
                </div>
            </div>                
        `    
    return formGrupo
}

function procesarTarjetaDebito()
{
    bloqueP.innerHTML = showFormGrupoProcesarTarjetaDebito()
    alert('procesar')
}

function showFormGrupoProcesarTarjetaDebito ()
{
    let contenedor = document.createElement('div')
    let spanInfo = document.createElement('div')
    spanInfo.classList.add('divInfo')
    spanInfo.innerText = "Se ha enviado un código temporal al número de teléfono afiliado al BDV, por favor ingresa el código para finalizar el pago"
    
    let formGrupo = document.createElement('div')
    
    formGrupo.innerHTML = `
        <div class="form-group pt-3">
            <div class="row">
                <div class="col-xs-12 col-lg-12 col-sm-12 col-md-12">
                    <label for="codigorecibido">Código recibido</label>
                    <input type="number" class="form-control inputForm" name="codigorecibido" id="codigorecibido" placeholder="Código recibido"/>
                </div>
            </div>                
        </div>

        <div class="form-group">
            <div class="row mx-auto my-3 p-3">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <button class="btn boton1 w-100">PROCESAR PAGO</button>
                </div>
            </div>                
        `
    contenedor.innerHTML = ""
    contenedor.appendChild(spanInfo)
    contenedor.appendChild(formGrupo)
    return contenedor
}

function initFormulario() {
    
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl, { container: 'body', trigger: 'hover' })
    })

    enableJuridicalPerson($('#chkJuridicalPerson').prop("checked"));

    $('#chkJuridicalPerson').on('change', function () {
        enableJuridicalPerson($('#chkJuridicalPerson').prop("checked"));
    });

    $('#paymentErrorContainer').hide();
    $('#paymentLinkContainer').hide();
    $('#btnNewPayment').hide();

    $('#btnCloseAlert').click(function (e) {
        e.preventDefault();
        $("#paymentErrorContainer").hide();
    });

    $('#btnGoPayment').click(function (e) {
        e.preventDefault();
        var url = $('#paymentLink').val();
        window.open(url, '_blank');
    });

    $('#btnCopyLink').click(function (e) {
        e.preventDefault();
        copyToClipboard($('#paymentLink')[0]);
    });

    $('#btnNewPayment').click(function (e) {
        e.preventDefault();
        $("#form").trigger("reset");
        $('#paymentErrorContainer').hide();
        $('#paymentLinkContainer').hide();
        $('#btnNewPayment').hide();
        $('#btnCreatePayment').show();
        $('#checkPaymentTable tbody').html('');
        $('#txtToken').val('');

        enabledControls(false);
        enableJuridicalPerson($('#chkJuridicalPerson').prop("checked"));
        removeValidationClass(form);
    });

    $('#btnClearSearchPayment').click(function (e) {
        e.preventDefault();
        $('#checkPaymentTable tbody').html('');
        $('#txtToken').val('');
    });

    const forms = document.querySelectorAll('.needs-validation');
    Array.from(forms).forEach(form => {
        form.addEventListener('submit', event => {
            event.preventDefault();
            if (form.checkValidity()) {
                createPayment();
            }
            else {
                event.stopPropagation();
                addValidationClass(form);
                console.log('valido fallido')
            }
        }, false)
    });

    $('#searchPayment').click(function () {
        var tokenValue = $("#txtToken").val();

        if (tokenValue != '') {
            var path = "{{ route('CheckPaymentAjax',0) }}";

            $.ajax({
                //url: 'CheckPayment-ajax.php',
                url: path,
                //type: "POST",
                type: "GET",
                data: { token: tokenValue },
                beforeSend: function () {
                    $("#spinner").addClass("show");
                },
                complete: function () {
                    $("#spinner").removeClass("show");
                },
                success: function (data) {

                    jsonResponse = JSON.parse(data);
                    var table = $('#checkPaymentTable tbody');
                    table.html('');

                    for (var prop in jsonResponse) {
                        var tr = $('<tr>');
                        var td1 = $('<td>');
                        var td2 = $('<td>');
                        td1.html(prop);
                        if (jsonResponse[prop] != null)
                            td2.html(jsonResponse[prop].toString());
                        tr.append(td1);
                        tr.append(td2);
                        table.append(tr);
                    }

                }
            });
        }
    });
}

function enableJuridicalPerson(isJuridicalPerson) {
    if (isJuridicalPerson == true) {
        $('#rifLetter').removeAttr('disabled');
        $('#rifNumber').removeAttr('disabled');

    } else {
        $('#rifLetter').attr('disabled', 'disabled');
        $('#rifNumber').attr('disabled', 'disabled');
    }
}

function copyToClipboard(elem) {
    // create hidden text element, if it doesn't already exist
    var targetId = "_hiddenCopyText_";
    var isInput = elem.tagName === "INPUT" || elem.tagName === "TEXTAREA";
    var origSelectionStart, origSelectionEnd;
    if (isInput) {
        // can just use the original source element for the selection and copy
        target = elem;
        origSelectionStart = elem.selectionStart;
        origSelectionEnd = elem.selectionEnd;
    } else {
        // must use a temporary form element for the selection and copy
        target = document.getElementById(targetId);
        if (!target) {
            var target = document.createElement("textarea");
            target.style.position = "absolute";
            target.style.left = "-9999px";
            target.style.top = "0";
            target.id = targetId;
            document.body.appendChild(target);
        }
        target.textContent = elem.textContent;
    }
    // select the content
    var currentFocus = document.activeElement;
    target.focus();
    target.setSelectionRange(0, target.value.length);

    // copy the selection
    var succeed;
    try {
        succeed = document.execCommand("copy");
    } catch (e) {
        succeed = false;
    }
    // restore original focus
    if (currentFocus && typeof currentFocus.focus === "function") {
        currentFocus.focus();
    }

    if (isInput) {
        // restore prior selection
        elem.setSelectionRange(origSelectionStart, origSelectionEnd);
    } else {
        // clear temporary content
        target.textContent = "";
    }
    return succeed;
}

function createPayment() {
    $('#paymentErrorContainer').hide();
    $('#paymentLinkContainer').hide();
    //var path = "{{ route('ProcessPaymentDemo',0) }}";
    var path = "/ProcessPaymentDemo/0";
    $.ajax({
        url: path,
        type: "GET",
        //data: {campo: 'cedula',},
        data: $("#form").serialize(),
        //dataType: "json",
        beforeSend: function () {
            $("#spinner").addClass("show");
        },
        complete: function () {
            $("#spinner").removeClass("show");
        },
        success: function (data) {
            console.log(data)
            if (data.success) {
                enabledControls(true);
                $('#paymentLink').val(data.urlPayment);
                $('#paymentLinkContainer').css('display', 'block');

                //location.href = data.urlPayment;
                let formGrupoTarjetaDebito = document.getElementById('formGrupoTarjetaDebito');
                //borrar el nodo
                formGrupoTarjetaDebito.remove()

                let spanR = document.getElementById('spanR');
                spanR.remove()

                $('#btnCreatePayment').hide();
                $('#btnNewPayment').show();

                let bloqueP = document.getElementById('bloqueP')
                let iframe = document.createElement('iframe')
                iframe.width = '420px;'
                iframe.height = '600px;'
                bloqueP.appendChild(iframe)
                iframe.src = data.urlPayment
            }
            else {
                $('#paymentError').html('Código: ' + data.responseCode + '<br/>Mensaje: ' + data.responseMessage);
                $('#paymentErrorContainer').show();
            }
        }
    });
}

function addValidationClass(form) {
    var elements = form.getElementsByClassName('validate-me');
    for (var i = 0; i < elements.length; i++) {
        elements[i].classList.add('was-validated');
    }
}

function removeValidationClass(form) {
    var elements = form.getElementsByClassName('validate-me');
    for (var i = 0; i < elements.length; i++) {
        elements[i].classList.remove('was-validated');
    }
}

function enabledControls(enabled) {
    if (enabled) {
        $('#form input').each(function () { $(this).attr('disabled', 'disabled'); });
        $('#form select').each(function () { $(this).attr('disabled', 'disabled'); });
        $('#form textarea').each(function () { $(this).attr('disabled', 'disabled'); });
    } else {    
        $('#form input').each(function () { $(this).removeAttr('disabled'); });
        $('#form select').each(function () { $(this).removeAttr('disabled'); });
        $('#form textarea').each(function () { $(this).removeAttr('disabled'); });
    }
}

function procesarTarjeta(){
    createPayment()
}

function enviarPagoMovil(){
    if(controlPagoMovil()){
        let objeto= {'metodo': 'pagomovil'}
        objeto['currency'] = 1
        objeto['clienteId'] = clienteId
        objeto['comercioId'] = comercioId
        
        document.querySelectorAll('.formPM input').forEach((input, i) => {
            let name = input.id + ''
            //let nuevaData = objeto.push({`${name}`: input.value})
            objeto[name.replace('PM', '')] = input.value
        });
        
        document.querySelectorAll('.formPM select').forEach((input, i) => {
            let name = input.id
            //let nuevaData = objeto.push({name: input.value})
            objeto[name.replace('PM', '')] = input.value
        });        
        
        enviarDatos(objeto)
    }
}

function controlPagoMovil() {
    if (document.getElementById('identificationNacPM') == null
        || document.getElementById('identificationNacPM').value == "") {
        alert("El campo no puede estar vacío.");
        document.getElementById('identificationNacPM').focus();
        return false;
    }

    if (document.getElementById('identificationNumberPM') == null
        || document.getElementById('identificationNumberPM').value == "") {
        alert("El campo no puede estar vacío.");
        document.getElementById('identificationNumberPM').focus();
        return false;
    }

    if (document.getElementById('cellphonecodePM') == null
        || document.getElementById('cellphonecodePM').value == "0") {
        alert("El campo no puede estar vacío.");
        document.getElementById('cellphonecodePM').focus();
        return false;
    }
    if (document.getElementById('cellphonePM') == null
        || document.getElementById('cellphonePM').value == "") {
        alert("El campo no puede estar vacío.");
        document.getElementById('cellphonePM').focus();
        return false;
    }
    if (document.getElementById('codigoPM') == null
        || document.getElementById('codigoPM').value == "0") {
        alert("El campo no puede estar vacío.");
        document.getElementById('codigoPM').focus();
        return false;
    }
    if (document.getElementById('referencePM') == null
        || document.getElementById('referencePM').value == "") {
        alert("El campo no puede estar vacío.");
        document.getElementById('referencePM').focus();
        return false;
    }
    if ((document.getElementById('amountPM') == null
        || document.getElementById('amountPM').value == "") && parseFloat(document.getElementById('amountPM').value) > 0) {
        alert("El campo no puede estar vacío.");
        document.getElementById('amountPM').focus();
        return false;
    }
    return true;
}

function enviarDatos(datos){
    var token = '{{csrf_token()}}';// ó $("#token").val() si lo tienes en una etiqueta html.
    var datos = datos 
    var path = "/enviarData";
    $.ajax({
        url: path,
        //type: "POST",
        type: "get",
        datatype:"json",
        data: { 
            _token: token,
            datos: datos
            },
        success: function (data) {

            console.log(data)

        }
    });
}

/**** TRANSFERENCIA *******/
function crearPantallaTransferencia(pantalla)
{   
    var bloqueP= document.createElement('div') 
    bloqueP.classList.add('sub-' + pantalla) //para agregar el footer al final

    let montopagar = document.createElement('div')

    let spanR = document.createElement('div')
    spanR.innerText = "Realiza la transferencia con los datos presentados a continuación"
    spanR.classList.add('textInfo', 'my-2', 'negrita')

    bloqueP.appendChild(spanR)

    bancoasociadoT = document.createElement('select')
    bancoasociadoT.classList.add('form-control', 'inputForm', 'my-2', 'noradiance')
    bancoasociadoT.id = "bancoasociado"

    let option = document.createElement('option')
    option.value='0'
    option.innerHTML = 'Seleccione un Cuenta Bancaria'
    bancoasociadoT.appendChild(option)       
    //Llena el select bancoasociado
    bancosAsociadosT.forEach(element => {
        let option = document.createElement('option')
        option.value = element.codigo
        option.innerHTML = element.banco
        bancoasociadoT.appendChild(option)
    });

    bloqueP.appendChild(bancoasociadoT)

    var spanGroup = document.createElement('div')
    spanGroup.classList.add('d-none')
    spanGroup.id = 'spanGroup'
    spanGroup.innerHTML = ""
    bloqueP.appendChild(spanGroup)

    bancoasociadoT.addEventListener('change', function(){        
        var spanDP = document.createElement('div')
        spanDP.classList.add('textInfo', 'divInfo', 'text-center', 'font-weight-bold')
        var spanGroupBotones = document.createElement('div')
        spanGroup.innerHTML = ""
        spanGroup.appendChild(spanDP)
        //transaccion.banco = e.target.options[index].text
        var codigo = this.value
        var cuentabancaria;
        
        if(codigo === '0'){
            spanDP.innerHTML = ``
            spanGroup.classList.add('d-none')
            return 0
        }else{
            var banco = bancosAsociadosT.some(function(buscar){
                if(buscar.codigo === codigo)
                {
                    cuentabancaria = buscar
                }                    
            });

            spanGroup.classList.remove('d-none')            
            spanDP.innerHTML = `<div class='negrita'>RIF/CEDULA</div><div>${cuentabancaria.cedula}</div>
                            <div class='negrita'>BANCO</div><div>${cuentabancaria.banco}</div>
                            <div class='negrita'>NRO DE CUENTA</div><div>${cuentabancaria.nrocuenta}</div>
            `
        }
    })

    let bottopP = document.createElement('div')
    bottopP.classList.add('bottopP', 'negrita1')
    bloqueP.appendChild(bottopP)
    
    let a = document.createElement('a')
    a.src = "#"
    a.index = pantalla
    a.classList.add('titulo')
    a.innerHTML = "Agregar"
    let span = document.createElement('span')
    span.innerText = 'Método de Pago Múltiple'
    span.classList.add('textInfo', 'negrita')
    a.classList.add('c-a', 'mx-1')    
    if(pantalla == 'p-0'){
        bottopP.appendChild(span)
        bottopP.appendChild(a)
    }
    a.addEventListener('click', nuevoBloque)    
    let a1 = document.createElement('a')
    a1.src = "#"
    a1.classList.add('enlaceEliminar')
    a1.innerHTML = "¿Eliminar Pantalla?"
    a1.index = pantalla
    a1.addEventListener('click', eliminarBloque)
    if(pantalla !== 'p-0'){
        bottopP.appendChild(a1)
    }
    let formulario = document.createElement('div')    
    formulario.innerHTML = showFormGrupoTransferencia()
    bloqueP.appendChild(formulario)

    return bloqueP
}

function showFormGrupoTransferencia()
{
    
    let formGrupo = `
    <div class="formT">
    <div class="row">
        <div class="col-lg-12 text-justity pt-3 negrita">Ingresa los datos de tu pago</div>
    </div>
        <div class="form-group">
            <div class="row mx-auto">
                <div class="col-xs-6 col-md-4 col-sm-4 col-4">
                    <label for="identificationNacT">Tipo </label>
                    <select class="form-control inputForm inputType" name="" id="identificationNacT" placeholder="Tipo">
                        <option value="V">V-</option>
                        <option value="J">J-</option>
                        <option value="E">E-</option>
                        <option value="G">G-</option>
                        <option value="P">P-</option>
                    </select>
                </div>
                <div class="col-xs-6 col-md-8 col=sm-8 col-8">
                    <label for="identificationNumberT">Documento</label>
                    <input type="text" id="identificationNumberT" class="form-control inputForm" placeholder="Documento">
                </div>
            </div>                        
        </div>

        <div class="row">
            <div class="col-lg-12 text-justity pt-3 negrita">Banco hacia donde realizaste la transferencia</div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <select class="form-control inputForm" name="" id="codigoT">
                    <option value="0">Seleccione una Cuenta</option>
                    `
                    let option = ''
                    bancosAsociadosT.forEach(element => {
                        option += `
                            <option value="${element.codigo}">${element.banco}</option>
                        `
                    });
    formGrupo += option
                    
    formGrupo += `
                </select>
            </div>                        
        </div>

        <div class="form-group pt-3">
            <div class="row">
                <div class="col-xs-12 col-lg-12 col-sm-12 col-md-12">
                    <label for="amountT">Monto cancelado</label>
                    <input type="number" class="form-control inputForm" name="amountT" id="amountT" placeholder="Monto cancelado"/>
                </div>
            </div>                
        </div>

        <div class="form-group pt-3">
            <div class="row">
                <div class="col-xs-12 col-lg-12 col-sm-12 col-md-12">
                    <label for="referenceT">Registra la referencia del pago</label>
                    <input type="number" class="form-control inputForm" name="referenceT" id="referenceT" placeholder="Registra la referencia del pago"/>
                </div>
            </div>                
        </div>
        
        <div class="form-group">
            <div class="row mx-auto my-3 p-3">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <button id="enviarTransferencia" class="btn boton1 w-100" onClick="enviarTransferencia()">Reporta el pago</button>
                </div>
            </div>    
        </div>
        `
    return formGrupo
}

function enviarTransferencia(){
    if(controlTransferencia()){
        let objeto= {'metodo': 'transferencia'}
        objeto['clienteId'] = clienteId
        objeto['currency'] = 1
        objeto['comercioId'] = comercioId
        
        document.querySelectorAll('.formT input').forEach((input, i) => {
            let name = input.id + ''
            //let nuevaData = objeto.push({`${name}`: input.value})
            objeto[name.replace('T', '')] = input.value
        });
        
        document.querySelectorAll('.formT select').forEach((input, i) => {
            let name = input.id
            //let nuevaData = objeto.push({name: input.value})
            objeto[name.replace('T', '')] = input.value
        });
        
        enviarDatos(objeto)
    }
}

function controlTransferencia() {
    if (document.getElementById('identificationNacT') == null
        || document.getElementById('identificationNacT').value == "") {
        alert("El campo no puede estar vacío.");
        document.getElementById('identificationNacT').focus();
        return false;
    }

    if (document.getElementById('identificationNumberT') == null
        || document.getElementById('identificationNumberT').value == "") {
        alert("El campo no puede estar vacío.");
        document.getElementById('identificationNumberT').focus();
        return false;
    }

    if (document.getElementById('codigoT') == null
        || document.getElementById('codigoT').value == "0") {
        alert("El campo no puede estar vacío.");
        document.getElementById('codigoT').focus();
        return false;
    }
    if (document.getElementById('referenceT') == null
        || document.getElementById('referenceT').value == "") {
        alert("El campo no puede estar vacío.");
        document.getElementById('referenceT').focus();
        return false;
    }
    if ((document.getElementById('amountT') == null
        || document.getElementById('amountT').value == "") && parseFloat(document.getElementById('amountT').value) > 0) {
        alert("El campo no puede estar vacío.");
        document.getElementById('amountT').focus();
        return false;
    }
    return true;
}

/**** ZELLE *******/
function crearPantallaZelle(pantalla)
{   
    var bloqueP= document.createElement('div') 
    bloqueP.classList.add('sub-' + pantalla) //para agregar el footer al final

    let montopagar = document.createElement('div')

    let spanR = document.createElement('div')
    spanR.innerText = "Realiza la transferencia con los datos presentados a continuación"
    spanR.classList.add('textInfo', 'my-2', 'negrita')

    bloqueP.appendChild(spanR)

    bancoasociadoZelle = document.createElement('select')
    bancoasociadoZelle.classList.add('form-control', 'inputForm', 'my-2', 'noradiance')
    bancoasociadoZelle.id = "bancoasociadoZelle"

    let option = document.createElement('option')
    option.value='0'
    option.innerHTML = 'Seleccione un Cuenta Zelle'
    bancoasociadoZelle.appendChild(option)       
    //Llena el select bancoasociado
    bancosAsociadosZelle.forEach(element => {
        let option = document.createElement('option')
        option.value = element.email
        option.innerHTML = element.email
        bancoasociadoZelle.appendChild(option)
    });

    bloqueP.appendChild(bancoasociadoZelle)

    var spanGroup = document.createElement('div')
    spanGroup.classList.add('d-none')
    spanGroup.id = 'spanGroup'
    spanGroup.innerHTML = ""
    bloqueP.appendChild(spanGroup)

    bancoasociadoZelle.addEventListener('change', function(){        
        var spanDP = document.createElement('div')
        spanDP.classList.add('textInfo', 'divInfo', 'text-center', 'font-weight-bold')
        var spanGroupBotones = document.createElement('div')
        spanGroup.innerHTML = ""
        spanGroup.appendChild(spanDP)
        //transaccion.banco = e.target.options[index].text
        var codigo = this.value
        var cuentazelle;
        
        if(codigo === '0'){
            spanDP.innerHTML = ``
            spanGroup.classList.add('d-none')
            return 0
        }else{
            var banco = bancosAsociadosZelle.some(function(buscar){
                if(buscar.email === codigo)
                {
                    cuentazelle = buscar
                }                    
            });

            spanGroup.classList.remove('d-none')            
            spanDP.innerHTML = `
                            <div class='negrita'>EMAIL A DONDE REALIZAR EL PAGO</div><div>${cuentazelle.email}</div>
            `
        }
    })

    let bottopP = document.createElement('div')
    bottopP.classList.add('bottopP', 'negrita1')
    bloqueP.appendChild(bottopP)
    
    let a = document.createElement('a')
    a.src = "#"
    a.index = pantalla
    a.classList.add('titulo')
    a.innerHTML = "Agregar"
    let span = document.createElement('span')
    span.innerText = 'Método de Pago Múltiple'
    span.classList.add('textInfo', 'negrita')
    a.classList.add('c-a', 'mx-1')    
    if(pantalla == 'p-0'){
        bottopP.appendChild(span)
        bottopP.appendChild(a)
    }
    a.addEventListener('click', nuevoBloque)    
    let a1 = document.createElement('a')
    a1.src = "#"
    a1.classList.add('enlaceEliminar')
    a1.innerHTML = "¿Eliminar Pantalla?"
    a1.index = pantalla
    a1.addEventListener('click', eliminarBloque)
    if(pantalla !== 'p-0'){
        bottopP.appendChild(a1)
    }
    let formulario = document.createElement('div')    
    formulario.innerHTML = showFormGrupoZelle()
    bloqueP.appendChild(formulario)

    return bloqueP
}

function showFormGrupoZelle()
{
    
    let formGrupo = `
    <div class="formZelle">
        <div class="row">
            <div class="col-lg-12 text-justity pt-3 negrita">Ingresa los datos de tu pago</div>
        </div>
        
        <div class="row">
            <div class="col-lg-12 text-justity pt-3 negrita">Email hacia donde realizaste el pago</div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <select class="form-control inputForm" name="" id="emailZelle">
                    <option value="0">Seleccione una dirección Zelle</option>
                    `
                    let option = ''
                    bancosAsociadosZelle.forEach(element => {
                        option += `
                            <option value="${element.email}">${element.email}</option>
                        `
                    });
    formGrupo += option
                    
    formGrupo += `
                </select>
            </div>                        
        </div>

        <div class="form-group pt-3">
            <div class="row">
                <div class="col-xs-12 col-lg-12 col-sm-12 col-md-12">
                    <label for="amountZelle">Monto cancelado</label>
                    <input type="number" class="form-control inputForm" name="amountZelle" id="amountZelle" placeholder="Monto cancelado"/>
                </div>
            </div>                
        </div>

        <div class="form-group pt-3">
            <div class="row">
                <div class="col-xs-12 col-lg-12 col-sm-12 col-md-12">
                    <label for="referenceZelle">Registra el código envia a su correo</label>
                    <input type="number" class="form-control inputForm" name="referenceZelle" id="referenceZelle" placeholder="Registra el código del pago"/>
                </div>
            </div>                
        </div>
        
        <div class="form-group">
            <div class="row mx-auto my-3 p-3">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <button id="enviarZelle" class="btn boton1 w-100" onClick="enviarZelle()">Reporta el código</button>
                </div>
            </div>    
        </div>
        `
    return formGrupo
}

function enviarZelle(){
    if(controlZelle()){
        let objeto= {'metodo': 'zelle'}
        objeto['clienteId'] = clienteId
        objeto['currency'] = 1
        objeto['comercioId'] = comercioId
        objeto['codigo'] = ''
        
        document.querySelectorAll('.formZelle input').forEach((input, i) => {
            let name = input.id + ''
            //let nuevaData = objeto.push({`${name}`: input.value})
            objeto[name.replace('Zelle', '')] = input.value
        });
        
        document.querySelectorAll('.formZelle select').forEach((input, i) => {
            let name = input.id
            //let nuevaData = objeto.push({name: input.value})
            objeto[name.replace('Zelle', '')] = input.value
        });
        
        enviarDatos(objeto)
    }
}

function controlZelle() {
    
    if (document.getElementById('emailZelle') == null
        || document.getElementById('emailZelle').value == "0") {
        alert("El campo no puede estar vacío.");
        document.getElementById('emailZelle').focus();
        return false;
    }
    if (document.getElementById('referenceZelle') == null
        || document.getElementById('referenceZelle').value == "") {
        alert("El campo no puede estar vacío.");
        document.getElementById('referenceZelle').focus();
        return false;
    }
    if ((document.getElementById('amountZelle') == null
        || document.getElementById('amountZelle').value == "") && parseFloat(document.getElementById('amountZelle').value) > 0) {
        alert("El campo no puede estar vacío.");
        document.getElementById('amountZelle').focus();
        return false;
    }
    return true;
}