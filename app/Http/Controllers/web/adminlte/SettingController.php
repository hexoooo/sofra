<?php

namespace App\Http\Controllers\web\adminlte;
use App\Models\Setting;
use Illuminate\Http\Request;

class settingController extends \App\Http\Controllers\Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //here we can see all the settings
        // if(auth()->user()->hasAnyRole(['admin','moderator','writer'])){ 
            $settings= Setting::paginate(10);
            return view('setting/settings',['settings'=>$settings]);
        // }else{abort(403);}
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //here u can add new settings

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
        //here u can edit ur settings
        
        // if(auth()->user()->hasAnyRole(['admin','writer'])){ 
            return view('setting/edit',['id'=>$id]);
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
        //here we put the new edited name of settings
        
        // if(auth()->user()->hasAnyRole(['admin','writer'])){ 
            $setting= Setting::where('id',$id)->first();
            if($request->about){
            $setting->about_app=$request->about;
             }
            if($request->commission){
            $setting->app_comission=$request->commission;
            }
            $setting->save();
            return redirect(url('/settings'));
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
        //here we can delete the setting we added

        
        }
}
