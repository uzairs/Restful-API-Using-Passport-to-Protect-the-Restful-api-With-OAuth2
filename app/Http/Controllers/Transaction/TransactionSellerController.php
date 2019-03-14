<?php

namespace App\Http\Controllers\Transaction;

use App\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiContoller;

class TransactionSellerController extends ApiContoller
{
      public function __construct()
      {

          parent::__construct();
          $this->middleware('scope:read-general')->only('index');
      }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Transaction $transaction)
    {
        $sellers = $transaction->product->seller;


        return $this->showOne($sellers);
   
    }


}
