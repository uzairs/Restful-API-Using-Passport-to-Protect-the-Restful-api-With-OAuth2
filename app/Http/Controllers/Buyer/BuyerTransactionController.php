<?php

namespace App\Http\Controllers\Buyer;

use App\Buyer;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiContoller;

class BuyerTransactionController extends ApiContoller

{
    

    public function __construct()

    {

       parent::__construct();
       $this->middleware('scope:read-general')->only('index');
        $this->middleware('can:view,buyer')->only('index');
        
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
           
//       $transaction = $buyer->transactions;
  
        
//       return $this->showAll($transaction); 



      $transaction = Buyer::findOrfail($id)->transactions;

      return $this->showAll($transaction);



    }

}
