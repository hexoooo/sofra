<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

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
                
                'restaurant name'=>  $restaurant,
                'order id'=>$this->pluck('id'),
                'order price'=>$this->pluck('total_price')
        ];
       
    }
}
