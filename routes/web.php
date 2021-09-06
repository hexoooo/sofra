<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\web\adminlte\AdminController;
use App\Http\Controllers\web\adminlte\GovernorateController;
use App\Http\Controllers\web\adminlte\ClientController;
use App\Http\Controllers\web\adminlte\CategoryController;
use App\Http\Controllers\web\adminlte\RegionController;
use App\Http\Controllers\web\adminlte\CityController;
use App\Http\Controllers\web\adminlte\OfferController;
use App\Http\Controllers\web\adminlte\PaymentController;
use App\Http\Controllers\web\adminlte\ContactController;
use App\Http\Controllers\web\adminlte\OrderController;
use App\Http\Controllers\web\adminlte\SettingController;
use App\Http\Controllers\web\adminlte\RestaurantController;
use App\Http\Controllers\web\adminlte\UserController;
use App\Http\Controllers\web\adminlte\ResetController;
use App\Http\Controllers\web\adminlte\RoleController;
use App\Http\Controllers\web\adminlte\PermissionController;
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
Route::middleware(['auth','web'])->group(function () {
    

Route::get('/main', [AdminController::class, 'admin']); 
//governorates
route::resource("/cities",CityController::class);
// categories
route::resource("/categories",CategoryController::class);
//cities
route::resource("/regions",RegionController::class);
//clients
route::resource("/clients",ClientController::class);
//payments
route::resource("/payments",PaymentController::class);
//offer
route::resource("/offers",OfferController::class);
//contacts
route::resource("/contacts",ContactController::class);
//settings
route::resource("/settings",SettingController::class);
//restaurants
route::resource("/restaurants",RestaurantController::class);
//orders
route::resource("/orders",OrderController::class);
//users
route::resource("/users",UserController::class);
//reset passowrd
route::resource("/reset",ResetController::class);
//rules
route::resource("/roles",RoleController::class);
//permissions
route::resource("/permissions",PermissionController::class);
});