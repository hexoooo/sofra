<?php

namespace App\Http\Controllers\web\adminlte;

use Illuminate\Http\Request;

class AdminController extends \App\Http\Controllers\Controller
{
   public function admin(){
       return view ('admin');
   }
}
