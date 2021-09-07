<?php

namespace App\Http\Controllers\web\adminlte;
use App\Models\order;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class OrderController extends \App\Http\Controllers\Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(request $request)
    {
        if(auth()->user()->hasAnyRole(['admin','moderator'])){ 
            $orders=Order::where(function($q) use($request){
                if($request->name){
                    $q->where('client_name' ,'like','%' .$request->name .'%');
                }

            })->get();
            if( $orders!='[]'){
                return view('order\orders',['orders'=>$orders]);
        }else{
            return view('order\err');
        }
        
   
   
   
   
   
            // if($request->name)
            // { $orders=Order::where('name',$request->name)->paginate(10);
            //   if($orders->first()){
            //     return view('order\orders',['orders'=>$orders]);
            // }else{   
            //     $orders= Order::paginate(10);
            //     return view('order\err');}}
               
                
            // else{  $orders= Order::paginate(10);
            //     return view('order\orders',['orders'=>$orders]);}
        }else{abort(403);}

        //here we can see all the orders
      
}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //here we can save the new data
      
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $orders=Order::where('id',$id)->paginate(10);
        return view('order\show',['orders'=>$orders]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

  }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //here we put the new edited name of orders


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    {if(auth()->user()->hasAnyRole(['admin','moderator'])){ 
        $order=Order::where('id',$id);
        $order->delete();
        $orders= Order::paginate(10);
        return redirect(url('/orders'));
    }else{abort(403);}
}

}
}