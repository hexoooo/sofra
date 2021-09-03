<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\web\adminlte\AdminController;
use App\Http\Controllers\web\adminlte\GovernorateController;
use App\Http\Controllers\web\adminlte\ClientController;
use App\Http\Controllers\web\adminlte\CategoryController;
use App\Http\Controllers\web\adminlte\RegionController;
use App\Http\Controllers\web\adminlte\cityController;
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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/main', [AdminController::class, 'admin']); 
//governorates
route::resource("/cities",CityController::class);
// categories
route::resource("/categories",CategoryController::class);
//cities
route::resource("/regions",RegionController::class);
//clients
route::resource("/clients",ClientController::class);