<?php

namespace App\Http\Controllers\web\adminlte;
use App\Models\Restaurant;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RestaurantController extends \App\Http\Controllers\Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(request $request)
    {
        if(auth()->user()->hasAnyRole(['admin','moderator'])){ 
            if($request->name)
            { $restaurants=Restaurant::where('name',$request->name)->paginate(10);
              if($restaurants->first()){
                return view('restaurant\restaurants',['restaurants'=>$restaurants]);
            }else{   
                $restaurants= Restaurant::paginate(10);
                return view('restaurant\err');}}
               
                
            else{  $restaurants= Restaurant::paginate(10);
                return view('restaurant\restaurants',['restaurants'=>$restaurants]);}
        }else{abort(403);}

        //here we can see all the restaurants
      
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
        $restaurants=Restaurant::where('id',$id)->paginate(10);
        return view('restaurant\show',['restaurants'=>$restaurants]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    if(auth()->user()->hasAnyRole(['admin'])){ 
        $restaurant=Restaurant::where('id',$id)->first();

        if ($restaurant->active){

            $restaurant->active=0;
            $restaurant->save();
            $restaurants= Restaurant::paginate(10);
            return redirect(url('/restaurants'));

        }else{

            $restaurant->active=1;
            $restaurant->save();
            $restaurants= Restaurant::paginate(10);
            return redirect(url('/restaurants'));
        }
    }else{abort(403);}
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
        //here we put the new edited name of restaurants


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
        $restaurant=Restaurant::where('id',$id);
        $restaurant->delete();
        $restaurants= Restaurant::paginate(10);
        return redirect(url('/restaurants'));
    }else{abort(403);}
}

}
}