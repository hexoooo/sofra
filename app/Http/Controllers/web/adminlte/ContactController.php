<?php

namespace App\Http\Controllers\web\adminlte;
use App\Models\ContactUs;
use Illuminate\Http\Request;

class ContactController extends \App\Http\Controllers\Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(request $request)
    {
        if(auth()->user()->hasAnyRole(['admin','moderator'])){ 
            if($request->name){
                $contacts=ContactUs::where('name',$request->name)->get();
                 if($contacts->first()){
                   return view('contact\contacts',['contacts'=>$contacts]);
               }else{   
                 $contacts= ContactUs::paginate(10);
                 return view('contact\err');}
               }else{
                 $contacts= ContactUs::paginate(10);
                 return view('contact\contacts',['contacts'=>$contacts]);}
                
        }else{abort(403);}

        //here we can see all the contacts
      
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
        //here we put the new edited name of contacts


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
        $contact=ContactUs::where('id',$id);
        $contact->delete();
        return redirect(url('/contacts'));
    }else{abort(403);}
}

}
}