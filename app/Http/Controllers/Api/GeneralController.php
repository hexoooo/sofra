<?php

namespace App\Http\Controllers\Api;
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
use App\Http\Resources\Restaurants;
use App\Http\Resources\Menu;
use App\Http\Resources\Register;
use App\Http\Resources\Reviews;
use App\Http\Resources\Meal;
use App\Http\Resources\Info;
use App\Http\Resources\Offers;
use App\Http\Resources\Settings;
class generalController extends \App\Http\Controllers\Controller
{
   use ApiTrait;
   public function restaurants(){
      return $this->results('1','done', Restaurants::collection(Restaurant::all()));
   } 
   public function menu($id){
      return $this->results('1','done',Menu::collection(Restaurant::where('id',$id)->first()->products()->get()));
   } 
   public function reviews($id){
      return $this->results('1','done',Reviews::collection(Restaurant::where('id',$id)->first()->reviews()->get()));
   } 
   public function info($id){
     return $this->results('1','done',new Info(Restaurant::where('id',$id)->first()));  
   } 
   public function meal($id ,$meal_id){
      return $this->results('1','done',new Meal(Restaurant::where('id',$id)->first()->products()->where('id',$meal_id)->first())); 
   } 
   public function offers(){
      return $this->results('1','done',Offers::collection(Offer::all())); 
   } 
   public function about(){
      return $this->results('1','done',new Settings(Setting::first())); 
   } 

    
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
          return $this->results(0,$validator->errors()->first(),$validator->errors());
      }
      $request->merge(['password'=>bcrypt($request->password)]);
      $client=Client::create($request->all());
      $client->api_token = str::random(60);
      $client->save();
      return $this->results('1','done',new Register(Client::latest()->first())); 
   } 
   public function login(Request $request){
    $validator=validator()->make($request->all(),[
      "email"=>'required',
      "password"=>'required',

    ]);
    if($validator->fails()){
    return $this->results(0,$validator->errors()->first(),$validator->errors());
   }else{
      $client=Client::where('email',$request->email)->first();
   
      if($client)
      {
          if (Hash::check($request->password, $client->password)){
              return $this->results(1,'logged in successfully',new Register(Client::where('email',$request->email)->first()));
           }else{
         
            return $this->results(0,'login info error');
     
            }
       }else{
          return $this->results(0,'login info error');
       }

   }
    }
    public function resetPassword(Request $request){
      $validator=validator()->make($request->all(),[
         "email"=>'required']);
         if($validator->fails()){
            return $this->results(0,$validator->errors()->first(),$validator->errors());
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
               return $this->results(1,'done','we sent u an email');
               }
              else{
               return  $this->results(0,'fail','no such email in database');
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
            return $this->results(0,$validator->errors()->first(),$validator->errors());
           }else{
              $client=Client::where('email',$request->email)->first();
           
              if($client)
              {
               if ($client->reset_password_code==$request->code){
                  $client->password=bcrypt($request->password);
                  return $this->results(1,'done');
               }else{
                  return $this->results(0,$validator->errors()->first(),$validator->errors());
               }
            }else{
               return $this->results(0,$validator->errors()->first(),$validator->errors());
            }

    }
}
}