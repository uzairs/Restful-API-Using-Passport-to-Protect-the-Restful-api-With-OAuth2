<?php

namespace App\Http\Controllers\Product;

use App\product;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiContoller;

class ProductController extends ApiContoller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

      public function __construct(){

      

      $this->middleware('client.credentials')->only(['index','show']);
       
    

   }
    public function index()
    {
    
       $products = product::all();
 
        return $this->showAll($products);
    }

    
    /**
     * Display the specified resource.
     *
     * @param  \App\product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(product $product)
    
    {
          return $this->showOne($product);

    }

    
}
