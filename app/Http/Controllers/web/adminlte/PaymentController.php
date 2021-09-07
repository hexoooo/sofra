<?php

namespace App\Http\Controllers\web\adminlte;
use App\Models\Payment;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class PaymentController extends \App\Http\Controllers\Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //here we can see all the payments
        if(auth()->user()->hasAnyRole(['admin','moderator','writer'])){ 
          $restaurants= Restaurant::get();
          $payments=Payment::where(function($q) use($request){
            if($request->name){
                $q->whereHas('restaurant' ,function($q) use($request){
                   $q->where('name','like','%' .$request->name .'%');
          });
        }
        })->get();
        if ($payments!='[]'){
          return view('payment\payments',['payments'=>$payments,'restaurants'=>$restaurants]);}
    else{
        return view('payment\err');
    } 
                    //   $restaurants= Restaurant::get();
          // // \\\\\\\\\\the old way//////////
          // if($request->name){
          //  $payments=Restaurant::where('name',$request->name)->first()->payments()->get();
          //  $restaurants= Restaurant::get();
          //   if($payments->first()){
          //     return view('payment\payments',['payments'=>$payments,'restaurants'=>$restaurants]);
          // }else{   
          //   return view('payment\err');}
          // }else{
          //   $payments= Payment::paginate(10);
          //   $restaurants= Restaurant::get();
          //   return view('payment\payments',['payments'=>$payments,'restaurants'=>$restaurants]);}
        }else{abort(403);}
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        if(auth()->user()->hasAnyRole(['admin','writer'])){ 
          $restaurant=Restaurant::all();
            return view('payment\create',['restaurants'=>$restaurant]);
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
              $payment= new payment;
              $restaurant=Restaurant::where('name',$request->restaurant)->first()->id;
              $payment->payed=$request->payed;
              $payment->notes=$request->notes;
              $payment->date=$request->date;
              $payment->restaurant_id=$restaurant;
              $payment->save();
              return redirect(url('/payments'));
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
          //here u can edit ur payments
          if(auth()->user()->hasAnyRole(['admin','writer'])){ 
              $restaurant=Restaurant::all();
              return view('payment/edit',['id'=>$id,'restaurants'=>$restaurant]);
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
          //here we put the new edited name of payments
          if(auth()->user()->hasAnyRole(['admin','writer'])){ 
              $payment= Payment::where('id',$id)->first();
              if($request->payed){
              $payment->payed=$request->payed;
            }
            if($request->notes){
              $payment->notes=$request->notes;
            }
            if($request->date){
              $payment->date=$request->date;
            }
            if($request->restaurant){ 
              $restaurant=Restaurant::where('name',$request->restaurant)->first()->id;
              $payment->restaurant_id=$restaurant;
            }  
              $payment->save();
              return redirect(url('/payments'));
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
          //here we can delete the payment we added
          if(auth()->user()->hasAnyRole(['admin','moderator'])){ 
              $payment=Payment::where('id',$id);
              $payment->delete();
              return redirect(url('/payments'));
            }else{abort(403);}
            }
        }