<?php

namespace App\Traits;

trait UsualTrait{
public function image($name,$path){
$extension=$name->getClientOriginalExtension();
$photo_name=time() . '.' . $extension;
$photo_path=$path;
$name->move($photo_path,$photo_name);
return $photo_name;
}
    

}