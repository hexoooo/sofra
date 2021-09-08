<?php

namespace App\Http\Controllers\web\adminlte;
use App\Models\category;
use Illuminate\Http\Request;

class CategoryController extends \App\Http\Controllers\Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //here we can see all the categories
        if(auth()->user()->hasAnyRole(['admin','moderator','writer'])){ 
            $categories= category::paginate(10);
            return view('categories/categories',['categories'=>$categories]);
        }else{abort(403);}
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //here u can add new categories
        if(auth()->user()->hasAnyRole(['admin','writer'])){ 

            return view('categories/create');
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
            $category= new category;
            $category->name=$request->name;
            $category->save();
            $categories= category::paginate(10);
            return redirect(url('/categories'));
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
        //here u can edit ur categories
        
        if(auth()->user()->hasAnyRole(['admin','writer'])){ 
            return view('categories/edit',['id'=>$id]);
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
        //here we put the new edited name of categories
        
        if(auth()->user()->hasAnyRole(['admin','writer'])){ 
            $category= category::where('id',$id)->first();
            $category->name=$request->newName;
            $category->save();
            $categories= category::paginate(10);
            return redirect(url('/categories'));
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
        //here we can delete the category we added

        if(auth()->user()->hasAnyRole(['admin','moderator'])){ 
            $category=category::where('id',$id);
            $category->first()->restaurants()->detach();
            $category->delete();
            $categories= category::paginate(10);
            return redirect(url('/categories'));
        // }else{abort(403);}
        }
}
}