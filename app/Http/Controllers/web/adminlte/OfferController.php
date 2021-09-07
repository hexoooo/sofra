<?php

namespace App\Http\Controllers\web\adminlte;
use App\Models\Offer;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class OfferController extends \App\Http\Controllers\Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(request $request)
    {
        if(auth()->user()->hasAnyRole(['admin','moderator'])){ 
            
            $restaurants= Restaurant::get();
            $offers=Offer::where(function($q) use($request){
            if($request->name){
                $q->whereHas('restaurant' ,function($q) use($request){
                   $q->where('name','like','%' .$request->name .'%');
          });
        }
        })->get();
        if ($offers!='[]'){
        return view('offer\offers',['offers'=>$offers,'restaurants'=>$restaurants]);
    }else{
        return view('offer\err');
    }
            
            //           \\\\\\\\\\\ old way /////////// 
            // if($request->name){
            //     $offers=Restaurant::where('name',$request->name)->first()->offers()->get();
            //     $restaurants= Restaurant::get();
            //      if($offers->first()){
            //        return view('offer\offers',['offers'=>$offers,'restaurants'=>$restaurants]);
            //    }else{   
            //      $offers= Offer::paginate(10);
            //      return view('offer\err');}
            //    }else{
            //      $restaurants= Restaurant::get();
            //      $offers= Offer::paginate(10);
            //      return view('offer\offers',['offers'=>$offers,'restaurants'=>$restaurants]);}
                
        }else{abort(403);}

        //here we can see all the offers
      
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
        //here we put the new edited name of offers


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
        $offer=Offer::where('id',$id);
        $offer->delete();
        $offers= Offer::paginate(10);
        return redirect(url('/offers'));
    }else{abort(403);}
}

}
}