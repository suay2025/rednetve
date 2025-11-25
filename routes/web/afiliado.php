<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Afiliado\ListComercios;
use App\Http\Livewire\Afiliado\ListCentroDistribucion;
use App\Http\Livewire\Afiliado\ListManufacturers;
use App\Http\Livewire\Afiliado\ListMetodosPagosC;
use App\Http\Livewire\Afiliado\ListCategories;
use App\Http\Livewire\Afiliado\ListCategorieslist;
use App\Http\Livewire\Afiliado\ListSubcategories;
use App\Http\Livewire\Afiliado\ListProducts;
use App\Http\Livewire\Afiliado\ViewDetails;
use App\Http\Livewire\Afiliado\Repuestoexpres\ListMenus;
use App\Http\Livewire\Afiliado\ListPedidos;
use App\Http\Livewire\Afiliado\ListStatusPedidos;
use App\Http\Livewire\Afiliado\ListPedidosDelivery;
use App\Http\Livewire\Afiliado\Product\ListCombos;
use App\Http\Livewire\Afiliado\ListTasas;
use App\Http\Livewire\Afiliado\Product\Repuestoexpres\NewProductRE;
use App\Http\Livewire\Afiliado\Product\Repuestoexpres\NewComboRE;
use App\Http\Livewire\Afiliado\ListBrand;
use App\Http\Livewire\Afiliado\ListContainers;
use App\Http\Livewire\Afiliado\Repuestoexpres\ListClients;
use App\Http\Livewire\Afiliado\Repuestoexpres\UpdateSettingComercio;
use App\Http\Livewire\Afiliado\Repuestoexpres\ListImpuestos;
use App\Http\Livewire\Afiliado\MetodosPagos;
use App\Http\Livewire\Afiliado\ListDeliveryArea;
use App\Http\Livewire\Afiliado\Repuestoexpres\ListUsersComercio;
use App\Http\Livewire\Afiliado\ListPromociones;

use App\Models\Comercio;
use App\Models\Product;
use App\Models\Setting;
use App\Models\SettingComercio;

Route::get('/listComercios/{userId}', ListComercios::class)->name('listComercios')->middleware('auth');

Route::get('/listCentrodistribucion/{comercioId}', listCentroDistribucion::class)->name('listCentrodistribucion')->middleware('auth');

Route::get('/listManufacturers/{comercioId}', listManufacturers::class)->name('listManufacturers')->middleware('auth');

Route::get('/listMetodosPagosC/{comercioId}', ListMetodosPagosC::class)->name('listMetodosPagosC')->middleware('auth');

Route::get('/listCategories/{comercioId}', listCategories::class)->name('listCategories')->middleware('auth');

Route::get('/listCategorieslist/{comercioId}', listCategorieslist::class)->name('listCategorieslist')->middleware('auth');

Route::get('/newSubcategory/{comercioId}/{categoryId}', listSubcategories::class)->name('listSubcategories')->middleware('auth');

Route::get('/listProducts/{comercioId}', ListProducts::class)->name('listProducts')->middleware('auth');

Route::get('/routedetails/{comercioId}/{productId}', function($comercioId, $productId){
    if(auth()->user()){
        return redirect()->route('viewdetails', ['comercioId' => $comercioId, 'productId' => $productId]);
    }
    else{
        
        $product = Product::find($productId);
        $comercio = Comercio::find($comercioId);
        $setting = SettingComercio::where('comercio_id', $comercioId)->first();
        
        if($setting == null)
        {
            $setting = SettingComercio::where('comercio_id', 1)->first();
        }        
        
        return view('externalviews.view-details', [
            'comercio' => $comercio, 
            'productId' => $product->id,
            'in_cellphonecontact' => $setting->in_cellphonecontact,
            'in_sliderprincipal' => $setting->in_sliderprincipal,
            'in_marcasproductos' => $setting->in_marcasproductos,
            'manufacturer_id' => '',
            'modelo_id' => '',
            'motor_id' => '',
        ]);
    }
});

Route::get('/viewdetails/{comercioId}/{productId}', ViewDetails::class)->name('viewdetails');

Route::get('/listMenus/{comercioId}', ListMenus::class)->name('listMenus')->middleware('auth');

Route::get('/listPedidos/{comercioId}', ListPedidos::class)->name('listPedidos')->middleware('auth');

Route::get('/listStatusPedidos/{comercioId}', ListStatusPedidos::class)->name('listStatusPedidos')->middleware('auth');

Route::get('/listPedidosDelivery', ListPedidosDelivery::class)->name('listPedidosDelivery')->middleware('auth');

Route::get('/listCombos/{comercioId}', ListCombos::class)->name('listCombos')->middleware('auth');

Route::get('/listTasas/{comercioId}', ListTasas::class)->name('listTasas')->middleware('auth');

Route::get('/newProductRE/{comercioId}/{productId}/{editModal}', NewProductRE::class)->name('newProductRE')->middleware('auth');

Route::get('/editProductRE/{comercioId}/{productId}/{editModal}', NewProductRE::class)->name('editProductRE')->middleware('auth');

Route::get('/newComboRE/{comercioId}/{editModal}', NewComboRE::class)->name('newComboRE')->middleware('auth');

Route::get('/listBrand/{comercioId}', ListBrand::class)->name('listBrand')->middleware('auth');

Route::get('/listContainers/{comercioId}', ListContainers::class)->name('listContainers')->middleware('auth');

Route::get('/listClients/{comercioId}', listClients::class)->name('listClients')->middleware('auth');

Route::get('/settingComercio/{comercioId}', UpdateSettingComercio::class)->name('settingComercio')->middleware('auth');

Route::get('/listImpuestos/{comercioId}', ListImpuestos::class)->name('listImpuestos')->middleware('auth');

Route::get('/metodospagos/{pedido}', MetodosPagos::class)->name('metodospagos')->middleware('auth');

Route::get('/listDeliveryArea/{comercioId}', ListDeliveryArea::class)->name('listDeliveryArea')->middleware('auth');

Route::get('/listUsersComercio/{comercioId}', ListUsersComercio::class)->name('listUsersComercio')->middleware('auth');

Route::get('/listPromociones', ListPromociones::class)->name('listPromociones')->middleware('auth');