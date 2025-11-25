<?php 
	use Illuminate\Support\Facades\Route;

	use App\Http\Controllers\CartController;

	use App\Http\Livewire\Cart\Cart;
	use App\Http\Livewire\Cart\Cart1;
	use App\Http\Livewire\Cart\LiveCartController;
	use App\Http\Livewire\Layouts\Navbar;
	

	// Route::get('/cart', Cart::class)->name('cart');

	Route::get('/cart', Cart::class)->name('cart');

	Route::get('/cartView/{comercioId}', function($comercioId) {
		
		$cartCollection = \Cart::getContent();

		return view('livewire.cart.cart1', [
			'cartCollection' => $cartCollection, 
			'words' => null,
			'comercioId' => $comercioId, 
			'manufacturer_id' => 0,
			'modelo_id' => 0,
			'motor_id' => 0,
		]);
	})->name('cartView');

	Route::get('/cartOff', [Cart1::class, 'index'])->name('cartOff');;
		
	Route::get('/goCart', [Navbar::class, 'cartRuta'])->name('goCart');

	Route::get('/goCartView', [Navbar::class, 'cartView'])->name('goCartView');

	Route::get('/previoproductcart/{sucursal_id}/{product_id}/{categoria}', [CartController::class, 'previaCompra']);
	
	Route::post('/add1/{id}', [CartController::class, 'add1'])->name('cart.store1');

	//Route::get('/', [CartController::class, 'shop'])->name('shop')->middleware('auth');
	Route::get('/shop', [CartController::class, 'shop'])->name('shop');
	
	//Route::post('/add', [CartController::class, 'add'])->name('cart.store');
	Route::post('/add', [CartController::class, 'add'])->name('cart.store');

	Route::post('/update', [CartController::class, 'update'])->name('cart.update');
	Route::post('/remove', [CartController::class, 'remove'])->name('cart.remove');
	Route::post('/clear', [CartController::class, 'clear'])->name('cart.clear');

	// Route::get('/cart', [App\Http\Controllers\CartController::class, 'cart'])->name('cart.index');

	Route::get('/comprar', [CartController::class, 'comprar'])->name('cart.comprar')->middleware('auth');

	Route::post('/formulario2', [CartController::class, 'formulario2'])->name('cart.formulario2')->middleware('auth');

	Route::get('/formulario3', [CartController::class, 'formulario3'])->name('cart.formulario3')->middleware('auth');

	Route::get('/formasdepago', [CartController::class, 'formasdepago'])->name('cart.formasdepago')->middleware('auth');	

	

	