<?php

namespace App\Http\Controllers\Api\Client;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use App\Models\Setting;
use App\Models\Review;
use App\Models\ContactUs;
use App\Models\Notification;
use App\Http\Resources\RegisterResource;
use App\Traits\ApiTrait;
use App\Http\Resources\OrdersResource;
use App\Http\Resources\PreviousOrderResource;
use App\Http\Resources\CurrentOrderResource;

class ClientAuthController extends \App\Http\Controllers\Controller
{
    use ApiTrait;
      public function makeOrder(Request $request){
       $product=Product::where('id',$request->product[0]['id'])->first();
       $settings=Setting::first();
       $restaurant=$product->restaurant()->first();
       $order= new Order;
       $order->client_name=auth()->user()->name;
       $order->delivery_charge=$restaurant->delivery_charge;
       $order->address=auth()->user()->region()->first()->name ;
       $order->phone=auth()->user()->phone;
       $order->status='pending';
       $order->client_id=auth()->user()->id;
       $order->restaurant_id=$restaurant->id;
       $restaurant=$product->restaurant()->first();
       $order->restaurant_id=$restaurant->id;
       $order->save();
       foreach($request->product as $product ){
        $item=Product::where('id',$product['id'])->first();
        $meal=$item->name;
        $restaurant=$item->restaurant()->first();
        $quantity=$product['quantity'];
        $note=$product['note'];
        if($item->offer_price>0){
            $price=$item->offer_price*$quantity;
         }else{
            $price=$item->price*$quantity;
        }
         $order->commission+=$price * $settings->app_commission;
         $meal_price=$price;
         $order->order_price+=$price;
         $order->total_price+=$price;
         $order->products()->attach($product['id'],['quantity'=>$product['quantity'],'special_notes'=>$product['note'],'price'=> $meal_price]);
        }
        $order->total_price+=$restaurant->delivery_charge;
        $order->save();
        $Notification=new Notification;
        $Notification->body='you have new order from '. auth()->user()->name;
        $Notification->notificationable_id=$order->restaurant_id;
        $Notification->notificationable_type='Restaurant';
        $Notification->title='new order is here';
        $Notification->order_id=$order->id;
        $Notification->save();
        
       return $this->results(1,'done',new OrdersResource($order)); 
   } 
   public function makeReview(Request $request){
       $review= new Review;
       $review->rate=$request->rate;
       $review->comment=$request->comment;
       $review->restaurant_id=$request->restaurant_id;
       $review->client_id=auth()->user()->id;
       $review->save();
       return $this->results(1,'done');
   }
   public function notification(){
       $notification= auth()->user()->notifications()->get();
       dd($notification);
   }
   public function showInfo(){
       $client=auth()->user();
       return $this->results(1,'done',$client); 
   }
   public function editInfo(Request $request ){
    $client= auth()->user();
    if($request->name){
    $client->name=$request->name;
  }
    if($request->email){
    $client->email=$request->email;
  }
    if($request->phone){
    $client->phone=$request->phone;
  }
    if($request->region_id){
    $client->region_id=$request->region_id;
  }
  
  $client->save();
     return $this->results('1','done', new RegisterResource($client));
  } 
   public function previousOrder(request $request){
       $orders=auth()->user()->orders()->whereIN('status',['rejected','finished'])->get();
       if($orders->first->id){
        return $this->results(1,'done',new PreviousOrderResource($orders));  
    }
     else{
        return $this->results(0,'no orders yet'); 
     }
    
   
   }
   public function CurrentOrder(request $request){
     $orders=auth()->user()->orders()->whereIN('status',['pending','accepted','finished'])->get();
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
         $orders->status='finished';
         $orders->save(); 
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
public function contactUs(request $request){
    $contact=new ContactUs;
    $contact->message=$request->message;
    $contact->name=$request->name;
    $contact->email=$request->email;
    $contact->address=$request->address;
    $contact->type=$request->type;
    $contact->save();
    return $this->results(1,'message sent'); 
}
public function logout(){
       auth()->user()->api_token='';
       auth()->user()->save();
       return $this->results(1,'logged out successfully');
}
}
