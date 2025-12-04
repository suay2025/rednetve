<?php

use Illuminate\Support\Facades\Route;

use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use App\Models\DatosBasicos;

use App\Http\Controllers\WelcomeController;
use App\Http\Livewire\WelcomeWire;
use App\Http\Controllers\AuthController;

use App\Http\Controllers\MainSearch;

use App\Http\Controllers\SearchController;

use App\Http\Controllers\Admin\SearchAfiliado;

use App\Http\Livewire\Admin\Settings\ListMetodosPagos;

use App\Http\Livewire\Recursos\ApiController;



use App\Http\Livewire\Components\Star;

use Illuminate\Foundation\Auth\EmailVerificationRequest;

use App\Http\Livewire\Error\ShowError;



Route::get('/star', Star::class)->name('star'); 

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//  Route::get('/', function () {
//      return view('welcome');
//  });


Route::get('/', [WelcomeController::class, 'index'])->name('welcome'); 

Route::get('/search', [WelcomeController::class, 'index'])->name('search'); 

Route::get('/cat', [WelcomeController::class, 'index'])->name('cat'); 


 Route::get('/searchMotor', [WelcomeController::class, 'index'])->name('searchMotor'); 

 Route::get('/searchM', [WelcomeController::class, 'index'])->name('searchM');

 Route::post('/searchMenu', [WelcomeController::class, 'index'])->name('searchMenu');  


// Route::get('/com/{comercio}', WelcomeController::class)->name('welcomecomercio');
Route::get('/com/{comercio}', WelcomeWire::class)->name('welcomecomercio');
Route::get('/pas/{comercio}', SearchAfiliado::class)->name('searchafiliado');

// Route::get('/', WelcomeController::class)->name('welcome');
//Route::get('/', [App\Http\Controllers\WelcomeController::class, 'index'])->name('welcome');

// Route::get('/', WelcomeWire::class)->name('welcome-wire');

Route::get('/listMetodosPagos', ListMetodosPagos::class)->name('listMetodosPagos')->middleware('auth');

Route::get('/api/apicontroller', ApiController::class)->name('api.apicontroller')->middleware('auth');

Route::get('/ProcessPaymentDemo/0', [ApiController::class, 'recibirDatos'])->name('ProcessPaymentDemo');

Route::get('/CheckPaymentAjax/0', [ApiController::class, 'ChequePago'])->name('CheckPaymentAjax')->middleware('auth');

Route::controller(SearchController::class)->group(function(){
    Route::get('autocomplete-cliente', 'autocompleteCliente')->name('autocomplete-cliente');
});

Route::get('/enviarData', [SearchAfiliado::class, 'enviarData'])->name('enviardata');



Route::post('/autenticar', [AuthController::class, 'autenticar'])->name('autenticar');
Route::post('/registrarse', [AuthController::class, 'registrarse'])->name('registrarse');

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
 
    return redirect('/');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::get('/login1', function(){
    return view('auth.login1');
});

Route::get('/register1', function(){
    return view('auth.register1');
});

Route::get('/registerDelivery', function(){
    return view('auth.registerDelivery');
});

// autentica con google
 
Route::get('/login-google', function () {
    return Socialite::driver('google')->redirect();
});
 
Route::get('/google-callback', function () {
    // $user = Socialite::driver('google')->user();
    
    // $userExists = User::where('external_id', $user->id)->where('external_auth', 'google')->exists();

    // if($userExists){
    //     Auth::login($userExists);
    // }else{
    //     $userNew = User::create([
    //             'name' =>user->name,
    //             'email' =>user->email,
    //             'avatar' =>user->avatar,
    //             'external_id' =>user->id,
    //             'external_auth' =>'google',
    //             'role' =>'cliente',
    //         ]);
        
    //     DatosBasicos::create([
    //         'user_id' => $userNew->id,
    //         'cellphonecode' => '',
    //         'cellphone' => '',
    //     ]);
        
    //     Auth::login($userNew);
    // }
    return redirect('/');
    // $user->token
});

Route::get('/errorFound/{error}', ShowError::class)->name('errorFound');
