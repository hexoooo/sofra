<?php

namespace App\Http\Controllers\Api\Client;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use App\Models\Setting;
use App\Traits\ApiTrait;
use App\Http\Resources\Orders;

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
       $order->status='yes';
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
        
       return $this->results('1','done',new orders($order)); 
   } 
}
