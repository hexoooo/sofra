<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\GeneralController;
use App\Http\Controllers\Api\client\ClientAuthController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
route::group(['prefix'=>'v1'],function(){
    route::get('/restaurants',[GeneralController::class,'restaurants']);
    route::get('/menu/{id}',[GeneralController::class,'menu']);
    route::get('/meal/{id}/{meal_id}',[GeneralController::class,'meal']);
    route::get('/reviews/{id}',[GeneralController::class,'reviews']);
    route::get('/restaurant-info/{id}',[GeneralController::class,'info']);
    route::get('/offers',[GeneralController::class,'offers']);
    route::get('/about-app',[GeneralController::class,'about']);
    // ------------- routes for clients only ------------ //
    route::group(['prefix'=>'client'],function(){
    route::post('/register',[GeneralController::class,'register']);
    route::post('/login',[GeneralController::class,'login']);
    route::post('/reset-password',[GeneralController::class,'resetPassword']);
    route::post('/set-new-password',[GeneralController::class,'setNewPassword']);
    // ------------- routes for auth clients only ------------ //
    route::group(['middleware'=>'auth:client'],function(){
    route::get('make-order',[ClientAuthController::class,'makeOrder']);
    });
  });
});