<?php

namespace App\Http\Controllers\web\adminlte;
use App\Models\Governorate;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class RoleController extends \App\Http\Controllers\Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
         if(auth()->user()->hasAnyRole(['admin'])){ 
        //here we can see all the roles
        $roles= role::paginate(10);
        return view('role\roles',['roles'=>$roles]);
    }else{abort(403);}
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //here u can add new roles
        if(auth()->user()->hasAnyRole(['admin'])){ 
            $permission=permission::all();
            return view('role\create',['permission'=>$permission]);
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
            $role= new role;
            $role->givePermissionTo($request->permission);
            $role->name=$request->name;
            $role->save();
            $roles= role::paginate(10);
            return redirect(url('/roles'));
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
        //here u can edit ur roles
        if(auth()->user()->hasAnyRole(['admin'])){ 
            $permission=permission::all();
            return view('role/edit',['id'=>$id,'permission'=>$permission]);
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
        if(auth()->user()->hasAnyRole(['admin'])){ 
            //here we put the new edited name of roles
            $role= role::where('id',$id)->first();
            if($request->permission)
            $role->syncPermissions($request->permission);
            if($request->newName)
            $role->name=$request->newName;
            $role->save();
            $roles= role::paginate(10);
            return redirect(url('/roles'));

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
        //here we can delete the role we added
        if(auth()->user()->hasAnyRole(['admin'])){ 
            $role=role::where('id',$id);
            $role->delete();
            $roles= role::paginate(10);
            return redirect(url('/roles'));
        }else{abort(403);}
    }
}
