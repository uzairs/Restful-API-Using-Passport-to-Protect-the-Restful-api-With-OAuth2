<?php

namespace App\Http\Controllers\Buyer;

use App\Buyer;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiContoller;

class BuyerCategoryController extends ApiContoller
{
    
    public function __construct()
    {

       parent::__construct();

       $this->middleware('scope:read-general')->only('index');
      // $this->middleware('can:view,buyer')->only('index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
      public function index(Buyer $buyer)
     
     {
    
          $categorys = $buyer->transactions()->with('product.categories')
          ->get()
          ->pluck('product.categories')
          ->collapse()
          ->unique('id')
           ->values();
          return $this->showAll($categorys);

    }

    
}
