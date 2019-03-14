<?php

namespace App\Http\Controllers\Seller;

 use Illuminate\Http\Request;
 use App\Http\Controllers\ApiContoller;
 use App\Seller;

  class SellerController extends ApiContoller
{
    
   public function __construct()
   {

       parent::__construct();
       $this->middleware('scope:read-general')->only('show');

   }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index()
       {
       
        $sellers = Seller::has('products')->get();
      
         return $this->showAll($sellers);
      
       }

    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Seller $seller)
    {
     
      //       $seller = Seller::has('products')->findOrFail($id);
            return $this->showOne($seller);       
 
    }
 

}
