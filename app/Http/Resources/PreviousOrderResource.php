<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Restaurant;
use App\Models\Order;

class PreviousOrderResource extends JsonResource
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
                
                // 'restaurant name'=> $this->restaurant()->first(),
                'order id'=>$this->id,
                'order items'=>$this->products()->pluck('name'),
                'restaurant name'=>$this->restaurant()->pluck('name'),
                'order price'=>$this->total_price
        ];
       
    }
}
