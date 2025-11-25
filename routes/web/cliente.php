<?php

use Illuminate\Support\Facades\Route;

use App\Http\Livewire\Cliente\ListClientesComercio;
use App\Http\Livewire\Cliente\ListPedidosCliente;
use App\Http\Livewire\Cliente\DatosFacturacionCliente;
use App\Http\Livewire\Cliente\DetallesPedido;

Route::get('/listPedidosCliente', ListPedidosCliente::class)->name('listPedidosCliente')->middleware('auth');
Route::get('/datosfacturacion', DatosFacturacionCliente::class)->name('datosfacturacion')->middleware('auth');
Route::get('/detallespedido/{nroPedido}', DetallesPedido::class)->name('detallespedido')->middleware('auth');
Route::get('/listClientesComercio/{comercioId}', ListClientesComercio::class)->name('listClientesComercio')->middleware('auth');