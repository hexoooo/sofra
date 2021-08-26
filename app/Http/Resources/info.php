<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class info extends JsonResource
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
                'name'=>$this->name,
                'city'=>$this->region->city->name,
                'region'=>$this->region->name,
                'delivery'=>$this->delivery_charge,    
                'minimum charge'=>$this->minimum_charge,    
                ];
    }
}
