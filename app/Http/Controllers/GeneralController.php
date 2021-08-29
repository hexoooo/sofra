<?php

namespace App\Http\Controllers;
use Illuminate\Support\Str;
use Illuminate\Support\facades\hash;
use Illuminate\Support\facades\Mail;
use Illuminate\Http\Request;
use App\Models\Restaurant;
use App\Models\Offer;
use App\Models\Client;
use App\Models\Setting;
use App\Models\Order;
use App\Traits\ApiTrait;
use App\Mail\ClientReset;
use App\Http\Resources\restaurants;
use App\Http\Resources\menu;
use App\Http\Resources\register;
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
   //============= this one for adding products to order-product table=========
   // public function addProduct($id ,Request $request){
   //    order::where('id',$id)->products()->attach($request->product,['quantity'=>$request->quantity,'special_notes'=>$request->notes,'price'=>$request->price]);
   //    return ApiTrait::results('1','done'); 
   // } 
    
   public function register(Request $request){
      $validator=validator()->make($request->all(),[
          "name"=>'required',
          "phone"=>'required|unique:clients',
          "password"=>'required|min:8',
          "email"=>'required|unique:clients',
          "region_id"=>'required'
      ]
      ) ;
      if ($validator->fails()){
          return ApiTrait::results(0,$validator->errors()->first(),$validator->errors());
      }
      $request->merge(['password'=>bcrypt($request->password)]);
      $client=Client::create($request->all());
      $client->api_token = str::random(60);
      $client->save();
      return ApiTrait::results('1','done',new register(client::latest()->first())); 
   } 
   public function login(Request $request){
    $validator=validator()->make($request->all(),[
      "email"=>'required',
      "password"=>'required',

    ]);
    if($validator->fails()){
    return ApiTrait::results(0,$validator->errors()->first(),$validator->errors());
   }else{
      $client=Client::where('email',$request->email)->first();
   
      if($client)
      {
          if (Hash::check($request->password, $client->password)){
              return ApiTrait::results(1,'logged in successfully',new register(Client::where('email',$request->email)->first()));
           }else{
         
            return ApiTrait::results(0,'login info error');
     
            }
       }else{
          return ApiTrait::results(0,'login info error');
       }

   }
    }
    public function resetPassword(Request $request){
      $validator=validator()->make($request->all(),[
         "email"=>'required']);
         if($validator->fails()){
            return ApiTrait::results(0,$validator->errors()->first(),$validator->errors());
           }else{
              $client=Client::where('email',$request->email)->first();
           
              if($client)
              {
                 $client->reset_password_code = str::random(8);
                 $client->save();
                 Mail::raw('the code to reset ur emeil is ' . "{" . $client->reset_password_code . "}", function ($message) {
                  $message->from('hexoo@me.com', 'hexoo');
                  $message->subject( 'reset');
              
                  $message->to('hecktorhexooooooo@gmail.com');
              });
               return ApiTrait::results(1,'done','we sent u an email');
               }
              else{
               return  ApiTrait::results(0,'fail','no such email in database');
            }
              
            

    }
    }
    public function setNewPassword(Request $request){
      $validator=validator()->make($request->all(),[
         "email"=>'required',
         "code"=>'required',
         "password"=>'required',
      ]);
         if($validator->fails()){
            return ApiTrait::results(0,$validator->errors()->first(),$validator->errors());
           }else{
              $client=Client::where('email',$request->email)->first();
           
              if($client)
              {
               if ($client->reset_password_code==$request->code){
                  $client->password=bcrypt($request->password);
                  return ApiTrait::results(1,'done');
               }else{
                  return ApiTrait::results(0,$validator->errors()->first(),$validator->errors());
               }
            }else{
               return ApiTrait::results(0,$validator->errors()->first(),$validator->errors());
            }

    }
}
}