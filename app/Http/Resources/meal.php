<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class meal extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return[ 
            'name'=>$this->name,
            'price'=>$this->price,
            'time'=> $this->preparation_times,
            'description'=>$this->description,
        
        ];
    }
}
