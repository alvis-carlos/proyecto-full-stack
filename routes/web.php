<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriasController;
use App\Http\Controllers\ProductosController;
use App\Http\Controllers\TipoEstadoController;
use App\Http\Controllers\EstadosController;
use App\Http\Controllers\InventarioController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ProductsListController;
use App\Http\Controllers\ShoppingCartController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\dashboardAdmin;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\FactureController;
use App\Http\Controllers\reports;
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

// Route::get('/', function () {
//     //return view('welcome');
//     return view('home.index');
// });

// Route::middleware(['auth:sanctum', 'verified'])->get('/', function () {
//     return view('home.index');
// })->name('home');


/* URL Admin */

Route::group(['middleware' => 'admin'], function () {
    Route::resource('dash/categorias', CategoriasController::class)->middleware('auth:sanctum');
    Route::resource('dash/productos', ProductosController::class)->middleware('auth:sanctum');
    Route::resource('dash/TipoEstado', TipoEstadoController::class)->middleware('auth:sanctum');
    Route::resource('dash/estados', EstadosController::class)->middleware('auth:sanctum');
    Route::resource('dash/inventario', InventarioController::class)->middleware('auth:sanctum');
    Route::resource('dash/users', UsersController::class)->middleware('auth:sanctum');
    Route::resource('dash/', dashboardAdmin::class)->middleware('auth:sanctum');
    Route::get('dash/reports/factures',[reports::class,'factures'])->middleware('auth:sanctum');
    Route::post('dash/reports/Create_factures',[reports::class,'create_report_facture'])->middleware('auth:sanctum');
    Route::get('dash/reports/list_factures',[FactureController::class,'listAdmin'])->middleware('auth:sanctum');
    Route::get('dash/reports/pdf/{id}',[FactureController::class,'create_pdf'])->middleware('auth:sanctum');
});


Route::group(['middleware' => 'profile'], function () {
    Route::resource('home/products', ProductsListController::class);
    Route::resource('home/shoppingcart', ShoppingCartController::class);
    Route::resource('/', MainController::class);
    Route::get('/paypal/play',[PaymentController::class,'payWithPaypal'])->middleware('auth:sanctum');
    Route::get('/paypal/status',[PaymentController::class,'payPalStatus'])->middleware('auth:sanctum');  
    Route::get('home/facture',[FactureController::class,'index'])->middleware('auth:sanctum');
    Route::get('home/facture/pdf/{id}',[FactureController::class,'create_pdf'])->middleware('auth:sanctum');
});

Route::resource('home/profile', ProfileController::class)->middleware('auth:sanctum');
/* URL Client */
/*  MIDDLEWARE  */




