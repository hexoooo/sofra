<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Register extends JsonResource
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
            'email'=>$this->email,
            'phone'=>$this->phone,
            'region'=>$this->region->name,
            'api token'=>$this->api_token,

        ];
}
}
