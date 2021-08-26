<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class reviews extends JsonResource
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
            'rate'=>$this->rate,
            'comment'=>$this->comment,
            ];
    }
}
