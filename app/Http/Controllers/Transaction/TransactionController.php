<?php

namespace App\Http\Controllers\Transaction;

use App\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiContoller;

class TransactionController extends ApiContoller
{
  
   public function __construct()
   {

     parent::__construct();
   $this->middleware('scope:read-general')->only('show');


   }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
             
             $transactions = Transaction::all();

             return $this->showAll($transactions);
    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
              $transaction = Transaction::findOrfail($id);
                 
               return $this->showOne($transaction);
    }

   
}
