<?php

namespace App\Http\Controllers\Product;

use App\product;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiContoller;

class ProductTransactionController extends ApiContoller
{
      public function __construct(){

        parent::__construct();
      }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(product $product)

    {
    
       $transactions = $product->transactions;

        return $this->showAll($transactions);


    }

    
}
