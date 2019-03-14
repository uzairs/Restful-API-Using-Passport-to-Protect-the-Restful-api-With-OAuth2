<?php

namespace App\Http\Controllers\Seller;

use App\Seller;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiContoller;

class SellerCategoryController extends ApiContoller
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
    public function index(Seller $seller)
    {
        
       $sellers =  $seller->products()
      ->wherehas('categories')
       ->with('categories')
       ->get() 
       ->pluck('categories')
        ->collapse()
        ->unique()
        ->values()
        ;

   return $this->showAll($sellers);

    }

    
}
