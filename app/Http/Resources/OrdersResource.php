<?php

namespace App\Http\Resources;
use App\Models\Product;
use App\Models\OrderProduct;
use Illuminate\Http\Resources\Json\JsonResource;

class OrdersResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
      
        return [
            'client region'=>$this->client->region->name,
            'client city'=>$this->client->region->city->name,
            'resturant'=>$this->restaurant->name,
            'order_price'=>$this->order_price,
            'delivery_charge'=>$this->delivery_charge,
            'commission'=>$this->commission,
            'quantity'=>OrderProduct::where("order_id",$this->id)->pluck('quantity'),
            'total_price'=>$this->total_price,
            'meal'=>$this->products->pluck('name'),
            'client name'=>$this->client->name,
            'client eamil'=>$this->client->email,
            'client phone'=>$this->client->phone,
        ];
    }
}
