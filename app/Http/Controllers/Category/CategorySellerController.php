<?php

namespace App\Http\Controllers\Category;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiContoller;

class CategorySellerController extends ApiContoller
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
           
           $products = Category::findOrfail($id)->products()->with('seller')->get()->pluck('seller')->unique()->values();

          return $this->showAll($products);


    }


    
}
