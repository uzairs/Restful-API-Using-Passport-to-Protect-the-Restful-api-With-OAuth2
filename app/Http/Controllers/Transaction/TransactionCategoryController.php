<?php

namespace App\Http\Controllers\Transaction;

use App\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiContoller;

class TransactionCategoryController extends ApiContoller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


      public function __construct(){

      

      $this->middleware('client.credentials')->only(['index']);
       
    

   }
    public function index($id)
    {
    
       
     $categories = Transaction::findOrfail($id)->product->categories;

      return $this->showAll($categories);

           
           }

    
}
//$categories = Transaction::findOrfail($id)->product->categories;

  //     return $this->showAll($categories);
