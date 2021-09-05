<?php

namespace App\Http\Controllers\web\adminlte;
use App\Models\client;
use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;

class ResetController extends \App\Http\Controllers\Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $message='';
        if($message!=='')
        {return view ('reset/resetpassword',['message'=>$message]);}
        else{
            return view ('reset/resetpassword',['message'=>$message]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
        $client=client::where('id',$id)->get();
        return view('/reset/edit');
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
        //
        $client=client::where('id',$id)->first();
     
        if(hash::check($request->old_password,$client->password))
        {$client->password=hash::make($request->new_password);
        $client->save();
        $message='password changed';
        return redirect(url('/reset'));
    }else{
            return view('reset/err');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
