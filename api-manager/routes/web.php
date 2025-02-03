<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\SolicitanteController;
use App\Http\Controllers\GrupoController;
use App\Http\Controllers\AprovadorController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('welcome');
});
Route::resource('/users', UserController::class);
Route::resource('/materials', MaterialController::class);
Route::resource('/pedidos', PedidoController::class);
Route::resource('/grupos', GrupoController::class);
Route::resource('/solicitantes', SolicitanteController::class);
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// Route::group(['middleware' => 'auth'], function () {
//     Route::get('/pedidos', [PedidoController::class, 'index'])->name('pedidos');
// });


Auth::routes();

Route::get('/', [App\Http\Controllers\MaterialController::class, 'index'])->name('material');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/solicitantes/dashboard', [SolicitanteController::class, 'dashboard'])
    ->name('solicitantes.dashboard')
    ->middleware(['auth']); 

Route::group(['middleware' => ['auth', 'perfil:aprovador']], function () {
    Route::get('/aprovador/dashboard', [AprovadorController::class, 'index'])->name('aprovador.dashboard');
    // Outras rotas para aprovadores
});

Route::post('/pedidos/aprovar/{id}', [PedidoController::class, 'aprovar'])->name('pedidos.aprovar');
Route::post('/pedidos/solicitarAlteracoes/{id}', [PedidoController::class, 'solicitarAlteracoes'])->name('pedidos.solicitarAlteracoes');
Route::delete('/pedidos/rejeitar/{id}', [PedidoController::class, 'rejeitar'])->name('pedidos.rejeitar');

Route::post('/logout', function() {
    Auth::logout();
    return redirect('/login');
})->name('logout');