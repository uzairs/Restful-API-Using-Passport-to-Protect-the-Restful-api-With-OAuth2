<?php

namespace App\Http\Controllers\Category;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiContoller;

class CategorybuyerController extends ApiContoller
{
    
   public function __construct()
    {

       parent::__construct();
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {  


          $products = Category::findOrfail($id)->products()
          

          ->whereHas('transactions')
          ->with('transactions.buyer')
          ->get()
          ->pluck('transactions')
          ->collapse()
          ->pluck('buyer')
          ->unique('id')
          ->values();
          
    
    return  $this->showAll($products);
    }

 
}
