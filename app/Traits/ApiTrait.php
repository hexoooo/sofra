<?php

namespace App\Traits;

trait ApiTrait{
    public function results($status,$message,$data=null){
        $response=[
            'status'=>$status,
            'message'=>$message,
            'data'=>$data
        ];
        return response()->json($response);
}
public function edit(request $request, $field){
 
    $client=client::where('phone',$request->phone)->first();
    if($request->has("$field")){
 
        $client->$field=($request->$field);
        $client->save();
        return $this->results(1,'edited successfully',$client);
    }
}
    

}