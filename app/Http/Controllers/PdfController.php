<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class PdfController extends Controller
{   
    public $dataRequest;

    public function show()
    {
       
        return view('presupuesto-pdf',);
    
    }

/**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */

    public function recibePost(Request $request)
    {
        // $this->dataRequest=$request;
      
        // $this->dataRequest = $request;
        // return redirect('/pdf')->with('status', 'OK');
        // return view('presupuesto-pdf');
        // return response()->redirectTo('pdf');
        return ($request);
        // return redirect()->route('pdf');
    //    $presupuesto=$request->all();
        // return redirect()->route('pdf.index');
            // ->with(['presupuesto'=> $presupuesto]);
        
    }
}
