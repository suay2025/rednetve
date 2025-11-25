<?php

use Illuminate\Support\Facades\Route;

use App\Http\Livewire\Pagomovil\ListPagomovil;

Route::get('/listPagomovil', ListPagomovil::class)->name('listPagomovil');

Route::get('/capturarPagomovil', [ListPagomovil::class, 'capturarPagomovil'])->name('capturarPagomovil');