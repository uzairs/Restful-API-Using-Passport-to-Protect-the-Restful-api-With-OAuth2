<?php

namespace App\Http\Controllers\Buyer;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiContoller;
use App\Buyer;

class BuyerController extends ApiContoller

{
    
    public function __construct()
  
    {

       parent::__construct();
       $this->middleware('scope:read-general')->only('index');
       $this->middleware('can:view,buyer')->only('show');
    
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
       public function index()
    {
    
        $buyers = Buyer::has("transactions")->get();
  
        return $this->showAll($buyers); 

    }

    

    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Buyer $buyer)
    {
    
      // $buyer = Buyer::has("transaction")->findOrFail($id);

        return  $this->showOne($buyer);
    
      }

    /**
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
  }
