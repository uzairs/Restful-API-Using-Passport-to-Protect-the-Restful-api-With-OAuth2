<?php

namespace App\Http\Controllers\Product;

use App\product;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiContoller;

class ProductbuyerController extends ApiContoller
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
             
             $products = product::findOrfail($id)->transactions()
             ->with('buyer')
              ->get()
               ->pluck('buyer')
               ->unique('id')
               ->values();

               return $this->showAll($products);


    


    }

    
}
