<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use App\Models\Setting;
use App\Traits\ApiTrait;
use App\Http\Resources\orders;

class ClientAuthController extends Controller
{
      public function makeOrder(Request $request){
       $product=Product::where('id',$request->product_id)->first();
       $settings=Setting::first();
       $restaurant=$product->restaurant()->first();
       $order= new Order;
       $order->client_name=auth()->user()->name;
       if($product->offer_price>0){
           $order->order_price=$product->offer_price;
        }else{
            $order->order_price=$product->price;
        }
        $order->delivery_charge=$restaurant->delivery_charge;
        $order->commission=$settings->app_commission;
       $order->total_price=$order->order_price*$request->quantity+$order->delivery_charge+$order->commission;
       $order->address=auth()->user()->region()->first()->name ;
       $order->phone=auth()->user()->phone;
       $order->status='yes';
       $order->client_id=auth()->user()->id;
       $order->restaurant_id=$restaurant->id;
       $order->save();
       $order->products()->attach($request->product_id,['quantity'=>$request->quantity,'special_notes'=>$request->notes,'price'=>$order->total_price]);
        
       return ApiTrait::results('1','done',new orders($order,$product)); 
   } 
}
