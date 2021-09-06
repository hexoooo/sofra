<?php

namespace App\Http\Controllers\web\adminlte;
use App\Models\user;
use App\Models\governorate;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;
use Spatie\Permission\Traits\HasRoles;
class UserController extends \App\Http\Controllers\Controller
{
    use HasRoles;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(request $request)
    {
        //here we can see all the users
        // you need to learn more about auth and middleware

       if(auth()->user()->hasAnyRole(['admin'])){
        $users= user::paginate(10);
        return view('user\users',['users'=>$users]);
   }else{abort(403);}
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       if(auth()->user()->hasAnyRole(['admin'])){ 
            $role= Role::all();
            return view('user\create',['role'=>$role]);
            
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
        $validator=validator()->make($request->all(),[
            "name"=>'required',
            "password"=>'required|min:8',
            "email"=>'required|unique:users',
            "role"=>'required',
        ]
        ) ;
        if ($validator->fails()){
            $role= Role::all();
            $messages=$validator->errors();
            return view('user\create',['role'=>$role,'messages'=>$messages]);
        }
              $user= new user;
             $user->assignRole($request->role);
              $user->name=$request->name;
              $user->email=$request->email;
              $user->password=bcrypt($request->password);
              $user->save();
              $users= user::paginate(10);
    
              return redirect(url('/users'));
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
          //here u can edit ur users
         if(auth()->user()->hasAnyRole(['admin'])){ 
             $role= Role::all();
              return view('user/edit',['id'=>$id,'role'=>$role]);
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
            //here we put the new edited name of users
            $user= user::where('id',$id)->first();
           if($request->role)
           $user->syncRoles($request->role);
            if($request->name)
            $user->name=$request->name;
            if($request->email)
            $user->email=$request->email;
            if($request->password){
            if(Hash::check($request->oldPassword, $user->password))
            {$user->password=bcrypt($request->password);}else{
                dd('password is incorrect');
            }}
  
            $user->save();
          
  
            return redirect(url('/users'));
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
          //here we can delete the user we added
         if(auth()->user()->hasAnyRole(['admin'])){ 
              $user=user::where('id',$id);
              $user->delete();
              $users= user::paginate(10);
              return redirect(url('/users'));
       }else{abort(403);}
      }
  }