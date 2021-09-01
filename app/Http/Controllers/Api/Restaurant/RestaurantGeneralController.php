<?php

namespace App\Http\Controllers\Api\Restaurant;

use Illuminate\Http\Request;
use App\Models\Restaurant;
use App\Traits\ApiTrait;
use Illuminate\Support\Str;
use Illuminate\Support\facades\hash;
use Illuminate\Support\facades\Mail;
use App\Models\NotificationToken;
use App\Mail\RestaurantReset;
use App\Http\Resources\RegisterResource;

class RestaurantGeneralController extends  \App\Http\Controllers\Controller
{
    use ApiTrait;
  
    public function register(Request $request){
        $validator=validator()->make($request->all(),[
            "name"=>'required',
            "phone"=>'required|unique:clients',
            "password"=>'required|min:8',
            "email"=>'required|unique:clients',
            "region_id"=>'required',
            "delivery_charge"=>'required',
            "minimum_charge"=>'required',
        ]
        ) ;
        if ($validator->fails()){
            return $this->results(0,$validator->errors()->first(),$validator->errors());
        }
        $request->merge(['password'=>bcrypt($request->password)]);
        $restaurant=Restaurant::create($request->all());
        $restaurant->api_token = str::random(60);
        $restaurant->save();
        $Notification=new NotificationToken;
        $Notification->token = str::random(60);
        $Notification->tokenable_id=$restaurant->id;
        $Notification->tokenable_type='Restaurant';
        $Notification->platform=$request->platform;
        $Notification->save();
        return $this->results('1','done',new RegisterResource(Restaurant::latest()->first())); 
     } 
     public function login(Request $request){
      $validator=validator()->make($request->all(),[
        "email"=>'required',
        "password"=>'required',
  
      ]);
      if($validator->fails()){
      return $this->results(0,$validator->errors()->first(),$validator->errors());
     }else{
        $restaurant=Restaurant::where('email',$request->email)->first();
        if($restaurant)
        {
            if (Hash::check($request->password, $restaurant->password)){
              $restaurant->api_token = str::random(60);
              $restaurant->save();
                return $this->results(1,'logged in successfully',new RegisterResource(Restaurant::where('email',$request->email)->first()));
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
                $restaurant=Restaurant::where('email',$request->email)->first();
             
                if($restaurant)
                {
                   $restaurant->reset_password_code = str::random(8);
                   $restaurant->save();
                   Mail::raw('the code to reset ur emeil is ' . "{" . $restaurant->reset_password_code . "}", function ($message) {
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
           "password"=>'required|min:8',
        ]);
           if($validator->fails()){
             
              return $this->results(0,$validator->errors()->first(),$validator->errors());
             }else{
                $restaurant=Restaurant::where('email',$request->email)->first();
             
                if($restaurant)
                {
                 if ($restaurant->reset_password_code==$request->code){
                    $restaurant->password=bcrypt($request->password);
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
