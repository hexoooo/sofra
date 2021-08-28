<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\generalController;
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
    route::post('/register-client',[GeneralController::class,'register']);
    route::post('/login-client',[GeneralController::class,'login']);
    route::post('/reset-client-password',[GeneralController::class,'resetPassword']);
    //we need to make function to get emails to reset passwords on the new day
  // ------------- routes for clients only ------------ //
    route::group(['middleware'=>'auth:client'],function(){
    route::get('/hello',function(){ 
            dd("hello");});

    });
});