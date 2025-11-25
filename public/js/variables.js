var path = 'file:///C:/Users/Personal/Desktop/metodopago/'

var monto = 0;

var datosCliente = {
    'userId': 0,
    'codigoFactura': '',
    'monto': 0,
}

var transaccion = []

var modoPago =  [
    {
        'nombre': 'Efectivo',
        'modo': 'efectivo', 
    },
    {
        'nombre': 'Transferencia',
        'modo': 'transferencia', 
    },
    {
        'nombre': 'Punto de Venta',
        'modo': 'puntodeventa', 
    },
    {
        'nombre': 'Biopago',
        'modo': 'biopago', 
    },
    {
        'nombre': 'Pago Movil',
        'modo': 'pagomovil', 
    },
    {
        'nombre': 'Divisa',
        'modo': 'divisa', 
    },
    {
        'nombre': 'Zelle',
        'modo': 'zelle', 
    },
    {
        'nombre': 'TARJETA DE DEBITO',
        'modo': 'tarjetadebito', 
    },
    {
        'nombre': 'TARJETA DE CREDITO',
        'modo': 'tarjetacredito', 
    },
]

var bancosAsociadosPM =  [
    {
        'banco': 'Venezuela',
        'codigo': '0102', 
        'telefono': '04165800403',
        'cedula': '13053081',
    },
    {
        'banco': 'Banesco',
        'codigo': '0134', 
        'telefono': '0414999888',
        'cedula': '13999888',
    },
]

var bancosAsociadosT =  [
    {
        'banco': 'Venezuela',
        'codigo': '0102', 
        'img': 'img_BDV.png',
        'tarjetadebito': '0102', 
        'telefono': '04165800403',
        'cedula': '13053081',
        'nrocuenta': '01029999988888000000',
    }
]

var bancosAsociadosZelle =  [
    {
        'cedula': '13053081',
        'email': 'typej2003@gmail.com',
    }
]

var categoryOption = []




/*
"currency" => $paymentRequest->currency,
"amount" => is_numeric($paymentRequest->amount) ? $paymentRequest->amount : 0,
"reference" => $paymentRequest->reference,
"title" => $paymentRequest->title,
"description" => $paymentRequest->description,
"letter" => $paymentRequest->idLetter,
"number" => $paymentRequest->idNumber,
"email" => $paymentRequest->email,
"cellphone" => $paymentRequest->cellphone,
"urlToReturn" => $paymentRequest->urlToReturn,
"rifLetter" => $paymentRequest->rifLetter,
"rifNumber" => $paymentRequest->rifNumber);

*/
