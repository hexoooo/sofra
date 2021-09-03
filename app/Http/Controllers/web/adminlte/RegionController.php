<?php

namespace App\Http\Controllers\web\adminlte;
use App\Models\Region;
use App\Models\city;
use Illuminate\Http\Request;

class RegionController extends \App\Http\Controllers\Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //here we can see all the regions
        // if(auth()->user()->hasAnyRole(['admin','moderator','writer'])){ 
            $regions= Region::paginate(10);
            $city= City::all();
            return view('region\regions',['regions'=>$regions,'cities'=>$city]);
        // }else{abort(403);}
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        // if(auth()->user()->hasAnyRole(['admin','writer'])){ 
            $city=City::all();
            return view('region\create',['cities'=>$city]);
        // }else{abort(403);}
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
        //   if(auth()->user()->hasAnyRole(['admin','writer'])){ 
              $region= new region;
              $city=City::where('name',$request->id)->first()->id;
              $region->name=$request->name;
              $region->city_id=$city;
              $region->save();
              $regions= Region::paginate(10);
              $city= City::all();
              return redirect(url('/regions'));
            // }else{abort(403);}
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
          //here u can edit ur regions
        //   if(auth()->user()->hasAnyRole(['admin','writer'])){ 
              $city=City::all();
              return view('region/edit',['id'=>$id,'cities'=>$city]);
            // }else{abort(403);}
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
          //here we put the new edited name of regions
        //   if(auth()->user()->hasAnyRole(['admin','writer'])){ 
              $region= Region::where('id',$id)->first();
              $city= City::all();
              if($request->newName)
              $region->name=$request->newName;
              $region->city_id=$city->where('name',$request->newId)->first()->id;
              $region->save();
              $regions= Region::paginate(10);
              return redirect(url('/regions'));
            // }else{abort(403);}
            }
            
            /**
             * Remove the specified resource from storage.
             *
       * @param  int  $id
       * @return \Illuminate\Http\Response
       */
      public function destroy($id)
      {
          //here we can delete the region we added
        //   if(auth()->user()->hasAnyRole(['admin','moderator'])){ 
              $region=Region::where('id',$id);
              $region->delete();
              $regions= Region::paginate(10);
              $city= City::all();
              return redirect(url('/regions'));
            // }else{abort(403);}
            }
        }