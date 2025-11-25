<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Recursos\LectorQr;

//Route::get('/lectorQr', LectorQr::class)->name('lectorQr')->middleware('auth');

//Route::get('/lectorQr', LectorQr::class)->name('lectorQr');
Route::get('/lectorQr', function(){
    // return view('externalviews.lectorQr')->middleware('auth');
    return view('externalviews.lectorQr');
});
