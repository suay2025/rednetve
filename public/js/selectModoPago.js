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
    select.classList.add('form-control', 'inputForm', 'my-2', 'noradiance')
    select.id = "s"+index
    select.pantalla = pantalla
    
    let option0 = document.createElement('option')
    option0.setAttribute('meta-img', path+'/img/dedo.png')
    option0.value="0"
    option0.innerHTML = "Seleccione.."

    let option1 = document.createElement('option')
    option1.setAttribute('meta-img', path+'/img/visa-mastercard.png')
    option1.value="tarjetadebito"
    option1.innerHTML = "TARJETA DE DÉBITO"

    let option2 = document.createElement('option')
    option2.setAttribute('meta-img', path+'/img/transferencia.png')
    option2.value="transferencia"
    option2.innerHTML = "Transferencia"

    let option3 = document.createElement('option')
    option3.setAttribute('meta-img', path+'/img/pagomovil.png')
    option3.value="pagomovil"
    option3.innerHTML = "PAGO MÓVIL"

    let option4 = document.createElement('option')
    option4.setAttribute('meta-img', path+'/img/zelle.png')
    option4.value="zelle"
    option4.innerHTML = "Zelle"

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
                break;
            
            case 'pagomovil':    
                bloque[0].appendChild(crearPantallaPagoMovil(pantalla))
                break;
        
            default:
                
                //bloque[0].appendChild(crearPantalla(pantalla))
                break;
        }
    }
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

    bancoasociado = document.createElement('select')
    bancoasociado.classList.add('form-control', 'inputForm', 'my-2', 'noradiance')
    bancoasociado.id = "bancoasociado"

    let option = document.createElement('option')
    option.value='0'
    option.innerHTML = 'Seleccione un Banco'
    bancoasociado.appendChild(option)       
    //Llena el select bancoasociado
    bancosAsociados.forEach(element => {
        let option = document.createElement('option')
        option.value=element.codigo
        option.innerHTML = element.banco
        bancoasociado.appendChild(option)       
    });

    bloqueP.appendChild(bancoasociado)

    var spanGroup = document.createElement('div')
    spanGroup.classList.add('d-none')
    spanGroup.id = 'spanGroup'
    spanGroup.innerHTML = ""
    bloqueP.appendChild(spanGroup)

    bancoasociado.addEventListener('change', function(){
        
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
            var banco = bancosAsociados.some(function(buscar){
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
            

            // Agrega el grupo de input para reportar
            spanGroupBotones.innerHTML = showFormGrupoPagoMovil()
            spanGroup.appendChild(spanGroupBotones)

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
    <div class="row">
        <div class="col-lg-12 text-justity pt-3 negrita">Ingresa los datos de tu pago</div>
    </div>

        <div class="form-group">
            <div class="row mx-auto">
                <div class="col-xs-6 col-md-4 col-sm-4 col-4">
                    <label for="tipodocumento">Tipo </label>
                    <select class="form-control inputForm inputType" name="" id="tipodocumento" placeholder="Tipo">
                        <option value="J">J-</option>
                        <option value="E">E-</option>
                        <option value="G">G-</option>
                        <option value="P">P-</option>
                        <option value="V" selected>V-</option>
                    </select>
                </div>
                <div class="col-xs-6 col-md-8 col=sm-8 col-8">
                    <label for="documento">Documento</label>
                    <input type="text" id="documento" class="form-control inputForm" placeholder="Documento">
                </div>
            </div>                        
        </div>

        <div class="row">
            <div class="col-lg-12 text-justity pt-3 negrita">Ingresa el número de teléfono asociado al
                pago móvil</div>
        </div>

        <div class="row">
                <div class="col-xs-6 col-md-4 col-sm-4 col-4">
                    <select class="form-control inputForm inputType" name="" id="premovil">
                        <option value="0">Seleccione</option>
                        <option value="0412">0412</option>
                        <option value="0412">0414</option>
                        <option value="0412">0424</option>
                        <option value="0412">0416</option>
                        <option value="0412">0426</option>
                    </select>
                </div>
                <div class="col-xs-6 col-md-8 col-sm-8 col-8">
                    <input type="text" class="form-control inputForm" id="movil">
                </div>
            </div>

        <div class="row">
            <div class="col-lg-12 text-justity pt-3 negrita">Cuenta Comercio</div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <select class="form-control inputForm" name="" id="cuentacomercio">
                    <option value="0">Seleccione una Cuenta</option>
                </select>
            </div>                        
        </div>

        <div class="form-group pt-3">
            <div class="row">
                <div class="col-xs-12 col-lg-12 col-sm-12 col-md-12">
                    <label for="referencia">Registra la referencia del pago</label>
                    <input type="number" class="form-control inputForm" name="referencia" id="referencia" placeholder="Registra la referencia del pago"/>
                </div>
            </div>                
        </div>
        
        <div class="form-group">
            <div class="row mx-auto my-3 p-3">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <button class="btn boton1 w-100">Reporta el pago</button>
                </div>
            </div>                
        `
    return formGrupo
}

//TARJETA DE DEBITO
function crearPantallaTarjetaDebito(pantalla)
{   
    let bloqueP= document.createElement('div') 
    bloqueP.classList.add('sub-' + pantalla) //para agregar el footer al final

    let montopagar = document.createElement('div')

    let spanR = document.createElement('div')
    spanR.innerText = "Realiza el pago móvil con los datos presentados a continuación"
    spanR.classList.add('textInfo', 'my-2', 'negrita')

    bloqueP.appendChild(spanR)

    bancoasociado = document.createElement('select')
    bancoasociado.classList.add('form-control', 'inputForm', 'my-2', 'noradiance')
    bancoasociado.id = "bancoasociado"

    let option = document.createElement('option')
    option.value='0'
    option.innerHTML = 'Seleccione un Banco'
    bancoasociado.appendChild(option)       
    //Llena el select bancoasociado
    bancosAsociadosT.forEach(element => {
        let option = document.createElement('option')
        option.value=element.codigo
        option.innerHTML = element.banco
        bancoasociado.appendChild(option)       
    });

    bloqueP.appendChild(bancoasociado)

    var spanGroupT = document.createElement('div')
    spanGroupT.classList.add('d-none')
    spanGroupT.id = 'spanGroup'
    spanGroupT.innerHTML = ""
    bloqueP.appendChild(spanGroupT)

    bancoasociado.addEventListener('change', function(){
        
        var spanIMG = document.createElement('div')
        spanIMG.classList.add('text-center')
        var spanGroupBotones = document.createElement('div')
        spanGroupT.innerHTML = ""
        spanGroupT.appendChild(spanIMG)
        //transaccion.banco = e.target.options[index].text
        var codigo = this.value
        var bancotarjeta;
        
        if(codigo === '0'){
            spanIMG.innerHTML = ``
            spanGroupT.classList.add('d-none')
            return 0
        }else{
            var temp = bancosAsociadosT.some(function(buscar){
                if(buscar.codigo === codigo)
                {
                    bancotarjeta = buscar
                }                    
            });
            spanGroupT.classList.remove('d-none')            
            spanIMG.innerHTML = `<div class="imgBanco"><img src='./img/${bancotarjeta.img}'><div>`
            

            // Agrega el grupo de input para reportar
            spanGroupBotones.innerHTML = showFormGrupoTarjetaDebito()
            spanGroupT.appendChild(spanGroupBotones)

            procesarTarjeta.addEventListener('click', procesarTarjetaDebito)

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

    return bloqueP
}

function showFormGrupoTarjetaDebito ()
{
    
    let formGrupo = `
    <div class="row">
        <div class="col-lg-12 text-justity pt-3 negrita">Ingresa los datos de tu pago</div>
    </div>

        <div class="row">
            <div class="col-lg-12 text-justity pt-3 negrita">Selecciona el tipo de cuenta</div>
        </div>

        <div class="form-group">
            <div class="row mx-auto">
                <div class="col-xs-6 col-md-6 col-sm-6 col-6">
                    <input class="cuentabancaria" type="radio" id="radio-btn-1" name="radio-btns">
                    <label for="radio-btn-1" class="btn inputForm inputForm labelcuentabancaria">Cuenta de Ahorro</label>
                </div>
                <div class="col-xs-6 col-md-6 col=sm-6 col-6">
                    <input class="cuentabancaria" type="radio" id="radio-btn-2" name="radio-btns">
                    <label for="radio-btn-2" class="btn inputForm labelcuentabancaria">Cuenta Corriente</label>
                </div>
            </div>                        
        </div>

        <div class="row">
            <div class="col-lg-12 text-justity pt-3 negrita">Ingresa tu número de Cédula o RIF</div>
        </div>

        <div class="form-group">
            <div class="row mx-auto">
                <div class="col-xs-6 col-md-4 col-sm-4 col-4">
                    <label for="tipodocumento">Tipo </label>
                    <select class="form-control inputForm inputType" name="" id="tipodocumento" placeholder="Tipo">
                        <option value="J">J-</option>
                        <option value="E">E-</option>
                        <option value="G">G-</option>
                        <option value="P">P-</option>
                        <option value="V" selected>V-</option>
                    </select>
                </div>
                <div class="col-xs-6 col-md-8 col=sm-8 col-8">
                    <label for="documento">Documento</label>
                    <input type="text" id="documento" class="form-control inputForm" placeholder="Documento">
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
                    <option value="0412">0414</option>
                    <option value="0412">0424</option>
                    <option value="0412">0416</option>
                    <option value="0412">0426</option>
                </select>
            </div>
            <div class="col-xs-6 col-md-8 col-sm-8 col-8">
                <input type="text" class="form-control inputForm" id="movil">
            </div>
        </div>
    
        <div class="form-group">
            <div class="row mx-auto my-3 p-3">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <button id="procesarTarjeta" class="btn boton1 w-100">PROCESAR</button>
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

