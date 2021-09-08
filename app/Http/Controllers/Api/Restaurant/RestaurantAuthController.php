<?php

namespace App\Http\Controllers\Api\Restaurant;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use App\Models\Setting;
use App\Models\ContactUs;
use App\Models\Offer;
use App\Models\Notification;
use App\Traits\ApiTrait;
use App\Traits\UsualTrait;
use App\Http\Resources\OrdersResource;
use App\Http\Resources\PreviousOrderResource;
use App\Http\Resources\CurrentOrderResource;
use App\Http\Resources\NotificationResource;
use App\Http\Resources\RestaurantsResource;
use App\Http\Resources\MenuResource;
use App\Http\Resources\RegisterResource;
use App\Http\Resources\ReviewsResource;
use App\Http\Resources\MealResource;
use App\Http\Resources\InfoResource;
use App\Http\Resources\OffersResource;
use App\Http\Resources\SettingsResource;


class RestaurantAuthController extends  \App\Http\Controllers\Controller
{
   
  use ApiTrait , UsualTrait;
  public function previousOrder(request $request){
        $orders=auth()->user()->orders()->whereIN('status',['rejected','finished'])->get();
        if($orders->first->id){
         return $this->results(1,'done',new PreviousOrderResource($orders));  
     }
      else{
         return $this->results(0,'no orders yet'); 
      }
     
    
    }
  public function newOrder(request $request){
        $orders=auth()->user()->orders()->whereIN('status',['pending'])->get();
        if($orders->first->id){
         return $this->results(1,'done',PreviousOrderResource::collection($orders));  
     }
      else{
         return $this->results(0,'no orders yet'); 
      }
     
    
    }
    public function CurrentOrder(request $request){
      $orders=auth()->user()->orders()->whereIN('status',['accepted'])->get();
      if ($orders->first->id){
         return $this->results(1,'done',new CurrentOrderResource($orders)); 
         
     }
      else{
         return $this->results(0,'no orders yet'); 
      }
     
    
    }
    public function acceptOrder(request $request){
      $orders=auth()->user()->orders()->where('id',$request->id)->first();
      if ($orders->id){
          $orders->status='accepted';
          $orders->save(); 
          $Notification=new Notification;
          $Notification->body='your order from '. auth()->user()->name .'is accepted';
          $Notification->notificationable_id=$orders->client_id;
          $Notification->notificationable_type='App\Models\Client';
          $Notification->title='your order is accepted';
          $Notification->order_id=$orders->id;
          $Notification->save();
         return $this->results(1,'order accepted'); 
         
     }
      else{
         return $this->results(0,'no orders yet'); 
      }
  
    
    }
    public function declineOrder(request $request){
     $orders=auth()->user()->orders()->where('id',$request->id)->first();
     if ($orders->id){
         $orders->status='declined';
         $orders->save(); 
        return $this->results(1,'order decliend'); 
        
    }
     else{
        return $this->results(0,'no orders yet'); 
     }
    
 
 }
 public function logout(){
    auth()->user()->api_token='';
    auth()->user()->save();
    return $this->results(1,'logged out successfully');
}
public function menu(Request $request){
  return $this->results('1','done',MenuResource::collection(auth()->user()->products()->get()));
} 
public function info(Request $request){
  return $this->results('1','done',new InfoResource(auth()->user()));  
} 
public function editInfo(Request $request ){
  $restaurant= auth()->user();
  if($request->name){
  $restaurant->name=$request->name;
}
  if($request->email){
  $restaurant->email=$request->email;
}
  if($request->phone){
  $restaurant->phone=$request->phone;
}
  if($request->delivery_charge){
  $restaurant->delivery_charge=$request->delivery_charge;
}

 $restaurant->save();
   return $this->results('1','done',new InfoResource(auth()->user()));
} 
public function meal($meal_id){
   return $this->results('1','done',new MealResource(auth()->user()->products()->where('id',$meal_id)->first())); 
} 
public function offers(Request $request){
  return auth()->user();
   return $this->results('1','done',OffersResource::collection(auth()->user()->offers()->get())); 
} 
public function notification(){
  $notification= auth()->user()->notifications()->get();
  return $this->results('1','done',NotificationResource::collection( $notification)); 
}
public function addOffer(Request $request){
  $validator=validator()->make($request->all(),[
    "name"=>'required',
    "info"=>'required',
    "photo"=>'required',
    "start_date"=>'required',
    "end_date"=>'required',

  ]);
  if($validator->fails()){
  return $this->results(0,$validator->errors()->first(),$validator->errors());
 }else{
  $photo=image($request->photo,'App/Public/Images/Offers');
  $offer= new Offer;
  $offer->name=$request->name;
  $offer->photo=$photo;
  $offer->info=$request->info;
  $offer->start_date=$request->start_date;
  $offer->end_date=$request->end_date;
  $offer->restaurant_id=auth()->user()->id;
  $offer->save();
   return $this->results('1','done',new OffersResource($offer)); 
} }
public function editOffer(Request $request ,$id){
  $offer= Offer::where('id',$id)->first();
  if($request->name){
  $offer->name=$request->name;
}
  if($request->info){
    $offer->info=$request->info;
}
  if($request->start_date){
    $offer->start_date=$request->start_date;
}
  if($request->end_date){
    $offer->end_date=$request->end_date;
  }
 $offer->save();
   return $this->results('1','done',new OffersResource($offer));
} 
public function deleteOffer(Request $request ,$id){
  $offer= Offer::where('id',$id)->first();
  if($offer){
  $offer->delete();
  return $this->results('1','offer deleted');
}else{
  return $this->results('0','no such offer');
}
} 
public function addMeal(Request $request){
  $validator=validator()->make($request->all(),[
    "name"=>'required',
    "price"=>'required',
    "preparation_times"=>'required',
    "description"=>'required',

  ]);
  if($validator->fails()){
  return $this->results(0,$validator->errors()->first(),$validator->errors());
 }else{
  $meal= new Product;
  $meal->name=$request->name;
  $meal->price=$request->price;
  $meal->preparation_times=$request->preparation_times;
  $meal->description=$request->description;
  $meal->restaurant_id=auth()->user()->id;
  $meal->save();
   return $this->results('1','done',new MealResource($meal)); 
} }
public function editMeal(Request $request ,$id){
  $meal= Product::where('id',$id)->first();
  if($request->name){
  $meal->name=$request->name;
}
  if($request->price){
    $meal->price=$request->price;
}
  if($request->preparation_times){
    $meal->preparation_times=$request->preparation_times;
}
  if($request->description){
    $meal->description=$request->description;
  }
 $meal->save();
   return $this->results('1','done',new MealResource($meal));
} 
public function deleteMeal(Request $request ,$id){
  $meal= Product::where('id',$id)->first();
  if($meal){
  $meal->delete();
  return $this->results('1','offer deleted');
}else{
  return $this->results('0','no such offer');
}
} 

public function commission(){
  $orders=auth()->user()->orders()->get();
  $income=0;
  foreach($orders as $order){
    $income+=$order->order_price;
  }
  $commission=0;
  foreach($orders as $order){
    $commission+=$order->commission;
  }
  $payments=auth()->user()->payments()->get();
  $payed=0;
  foreach($payments as $payment){
    $payed+=$payment->payed;
  }
  $remaining=$commission-$payed;
  return $this->results('1','done',['income'=>$income,'commission'=>$commission,'payed'=>$payed,'remaining'=>$remaining]);
}
}
