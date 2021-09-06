<?php

namespace App\Http\Controllers\web\adminlte;
use App\Models\City;
use Illuminate\Http\Request;
class CityController extends \App\Http\Controllers\Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
   if(auth()->user()->hasAnyRole(['admin','moderator','writer'])){ 
        //here we can see all the cities
        $cities= City::paginate(10);
        return view('city\cities',['cities'=>$cities]);
    }else{abort(403);}
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //here u can add new cities
        if(auth()->user()->hasAnyRole(['admin','writer'])){ 
            return view('city\create');
        }else{abort(403);}
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
        if(auth()->user()->hasAnyRole(['admin','writer'])){ 
            $city= new city;
            $city->name=$request->name;
            $city->save();
            $cities= city::paginate(10);
            return redirect(url('/cities'));
        }else{abort(403);}
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
        //here u can edit ur cities
        if(auth()->user()->hasAnyRole(['admin','writer'])){ 
            return view('city/edit',['id'=>$id]);
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
        //here we put the new edited name of cities
        if(auth()->user()->hasAnyRole(['admin','writer'])){ 
            $city= city::where('id',$id)->first();
            $city->name=$request->newName;
            $city->save();
            $cities= city::paginate(10);
            return redirect(url('/cities'));
        }else{abort(403);}
            
        }
        
        /**
         * Remove the specified resource from storage.
         *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //here we can delete the city we added
        if(auth()->user()->hasAnyRole(['admin','moderator'])){ 
            $city=city::where('id',$id);
            $city->delete();
            $cities= city::paginate(10);
            return redirect(url('/cities'));
        }else{abort(403);}
        }
}
