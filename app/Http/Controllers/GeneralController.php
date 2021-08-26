<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Restaurant;
use App\Models\Offer;
use App\Models\Setting;
use App\Traits\ApiTrait;
use App\Http\Resources\restaurants;
use App\Http\Resources\menu;
use App\Http\Resources\reviews;
use App\Http\Resources\meal;
use App\Http\Resources\info;
use App\Http\Resources\offers;
use App\Http\Resources\settings;
class generalController extends Controller
{
   use ApiTrait;
   public function restaurants(){
      return ApiTrait::results('1','done', restaurants::collection(Restaurant::all()));
   } 
   public function menu($id){
      return ApiTrait::results('1','done',menu::collection(Restaurant::where('id',$id)->first()->products()->get()));
   } 
   public function reviews($id){
      return ApiTrait::results('1','done',reviews::collection(Restaurant::where('id',$id)->first()->reviews()->get()));
   } 
   public function info($id){
     return ApiTrait::results('1','done',new info(Restaurant::where('id',$id)->first()));  
   } 
   public function meal($id ,$meal_id){
      return ApiTrait::results('1','done',new meal(Restaurant::where('id',$id)->first()->products()->where('id',$meal_id)->first())); 
   } 
   public function offers(){
      return ApiTrait::results('1','done',offers::collection(Offer::all())); 
   } 
   public function about(){
      return ApiTrait::results('1','done',new settings(setting::first())); 
   } 
  
}
