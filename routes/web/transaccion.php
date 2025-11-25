<?php

use Illuminate\Support\Facades\Route;


use App\Http\Livewire\Transaccion\ListTransacciones;

Route::get('/listTransacciones/{comercioId}', ListTransacciones::class)->name('listTransacciones')->middleware('auth');