<?php

namespace App\Http\Controllers\Api;
use Illuminate\Support\Str;
use Illuminate\Support\facades\hash;
use Illuminate\Support\facades\Mail;
use Illuminate\Http\Request;
use App\Models\Restaurant;
use App\Models\Offer;
use App\Models\Client;
use App\Models\Region;
use App\Models\Setting;
use App\Models\Order;
use App\Models\NotificationToken;
use App\Traits\ApiTrait;
use App\Mail\ClientReset;
use App\Http\Resources\RestaurantsResource;
use App\Http\Resources\MenuResource;
use App\Http\Resources\RegisterResource;
use App\Http\Resources\ReviewsResource;
use App\Http\Resources\MealResource;
use App\Http\Resources\InfoResource;
use App\Http\Resources\OffersResource;
use App\Http\Resources\SettingsResource;
class generalController extends \App\Http\Controllers\Controller
{
   use ApiTrait;
   public function restaurants(){
      return $this->results('1','done', RestaurantsResource::collection(Restaurant::all()));
   } 
   public function searechRestaurants(Request $request){
      if($request->name and $request->city){   
      $restaurant=Region::where('name',$request->region)->first()->restaurants()->where('name',$request->name)->first();
      if($restaurant){
      return $this->results('1','done',new RestaurantsResource($restaurant));
      }else{
         return $this->results('0','no restaurant found');
      }
   }
      else if($request->name){   
         $restaurant=Restaurant::where('name',$request->name)->first();
         if($restaurant){
         return $this->results('1','done',new RestaurantsResource($restaurant));
         }else{
         return $this->results('0','no restaurant found');
         }
      }
      else if($request->region){
         $restaurant=Region::where('name',$request->region)->first()->restaurants()->get();
         if($restaurant){
         return $this->results('1','done', RestaurantsResource::collection($restaurant));
         }else{
         return $this->results('0','no restaurant found');
         }
      }
   } 
   public function menu($id){
      return $this->results('1','done',MenuResource::collection(Restaurant::where('id',$id)->first()->products()->get()));
   } 
   public function reviews($id){
      return $this->results('1','done',ReviewsResource::collection(Restaurant::where('id',$id)->first()->reviews()->get()));
   } 
   public function info($id){
     return $this->results('1','done',new InfoResource(Restaurant::where('id',$id)->first()));  
   } 
   public function meal($id ,$meal_id){
      return $this->results('1','done',new MealResource(Restaurant::where('id',$id)->first()->products()->where('id',$meal_id)->first())); 
   } 
   public function offers(){
      return $this->results('1','done',OffersResource::collection(Offer::all())); 
   } 
   public function about(){
      return $this->results('1','done',new SettingsResource(Setting::first())); 
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
      $Notification=new NotificationToken;
      $Notification->token = str::random(60);
      $Notification->tokenable_id=$client->id;
      $Notification->tokenable_type='Client';
      $Notification->platform=$request->platform;
      $Notification->save();
      return $this->results('1','done',new RegisterResource(Client::latest()->first())); 
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
            $client->api_token = str::random(60);
            $client->save();
              return $this->results(1,'logged in successfully',new RegisterResource(Client::where('email',$request->email)->first()));
           }else{
         
            return $this->results(0,'login info error');
     
            }
       }else{
          return $this->results(0,'login info error');
       }

   }
    }
    public function logout(){}
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