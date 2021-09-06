<?php

namespace App\Http\Controllers\web\adminlte;
use App\Models\Governorate;
use Illuminate\Http\Request;
use Spatie\Permission\Models\permission;
class PermissionController extends  \App\Http\Controllers\Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(auth()->user()->hasAnyRole(['admin'])){ 
            //here we can see all the permissions
            $permissions= permission::paginate(10);
            return view('permission\permissions',['permissions'=>$permissions]);
        }else{abort(403);}
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //here u can add new permissions
        if(auth()->user()->hasAnyRole(['admin'])){ 
            return view('permission\create');
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
        if(auth()->user()->hasAnyRole(['admin'])){ 
            $permission= new permission;
            $permission->name=$request->name;
            $permission->save();
            $permissions= permission::paginate(10);
            return redirect(url('/permissions'));
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
        if(auth()->user()->hasAnyRole(['admin'])){ 
            return view('permission/edit',['id'=>$id]);
        }else{abort(403);}
        //here u can edit ur permissions
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
        //here we put the new edited name of permissions
        if(auth()->user()->hasAnyRole(['admin'])){ 
            $permission= permission::where('id',$id)->first();
            $permission->name=$request->newName;
            $permission->save();
            $permissions= permission::paginate(10);
            return redirect(url('/permissions'));
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
        if(auth()->user()->hasAnyRole(['admin'])){ 
            //here we can delete the permission we added
            $permission=permission::where('id',$id);
            $permission->delete();
            $permissions= permission::paginate(10);
            return redirect(url('/permissions'));
        }else{abort(403);}
    }
}
