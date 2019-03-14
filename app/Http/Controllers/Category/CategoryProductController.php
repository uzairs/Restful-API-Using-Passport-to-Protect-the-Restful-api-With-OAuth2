<?php

namespace App\Http\Controllers\Category;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiContoller;

class CategoryProductController extends ApiContoller
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
           $products = Category::findOrfail($id)->products;
          
             return $this->showAll($products);     

    }

    
}
