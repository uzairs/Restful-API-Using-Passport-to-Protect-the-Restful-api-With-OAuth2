<?php

namespace App\Http\Controllers\Product;

use App\product;
use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiContoller;

class ProductcategoryController extends ApiContoller
{
    


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

      public function __construct()

      {


       $this->middleware('client.credentials')->only(['index']);
       $this->middleware('auth:api')->except(['index']);
       $this->middleware('scope:manage-products')->except('index');

          
    
     }






    public function index($id)

    {
        $category = product::findOrfail($id)->categories;

        return $this->showAll($category);    



    }

    public function update(Request $Request, product $product, $id)
    
    {
        //attach, sync, syncWithoutDetaching
          $product->categories()->syncWithoutDetaching([Category::findOrfail($id)->id]);
   
            return $this->showAll($product->categories);
    }

    
  public function  destroy(product $product, $id)

 {

      if (!$product->categories()->find(Category::findOrfail($id)->id)) {
      
        return $this->errorResponse('The spacified category is not a category of the product', 404);
      
      }

   $product->categories()->detach(Category::findOrfail($id)->id);

   return $this->showAll($product->categories);



}



}
