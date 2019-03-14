<?php

namespace App\Http\Controllers\Seller;

use App\Seller;
use App\User;
use App\product;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiContoller;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Auth\Access\AuthorizationException;
use App\Transformers\ProductTransformer;

class SellerProductController extends ApiContoller

{
    

    public function __construct()
      
      {

        parent::__construct();

       $this->middleware('transform.input:' . ProductTransformer::class)->only(['store','update']);
        
        $this->middleware('scope:manage-products')->except('index');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Seller $seller)
    {
    
         if (request()->user()->tokenCan('manage-products')) {
       
     

        $products = $seller->products;

        return $this->showAll($products);

      }

  if (request()->user()->tokenCan('read-general')) {
       
     

        $products = $seller->products;

        return $this->showAll($products);

      }
           
           throw new  AuthorizationException('Invalid scope(s)');

           
             

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request , User $seller)
    {
        $rules = [
         'name' => 'required',
         'description' => 'required',
         'quantity' => 'required|integer|min:1',
         'image' => 'required|image',
       ];
       
        $this->validate($request, $rules);

      $data = $request->all();

      $data['status'] =  product::UNAVAILABLE_PRODUCT; 
      $data['image'] =  $request->image->store('');
      $data['seller_id'] = $seller->id;

     $product = product::create($data);
     return $this->showOne($product);

    }

    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Seller  $seller
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request , Seller $seller , product $product)
    {
        
   
        $rules = [
          'quantity' =>  'integer|min:1',  
           'status' => 'in:'. product::AVAILABLE_PRODUCT . ',' . product::UNAVAILABLE_PRODUCT,
           'image'=> 'image' ,

        ];      
 
        $this->validate($request, $rules);    

    $this->checkSeller($seller, $product);

     $product->fill($request->intersect([

        'name',
        'description',
        'quantity',

     ]));


     
       if ($request->has('status')) {
      
         $product->status = $request->status;

    if ($product->isAvailable() && $product->categories()->count() == 0 ) {
        
        return $this->errorResponse('An Active Product must have at lest one category', 409);
    }
}

if ($request->hasFile('image')) {
    
    Storage::delete($product->image);

   $product->image = $request->image->store('');   

}


  if ($product->isClean()) {
  
    return $this->errorResponse('You need to specify a different value to update', 422);
  
  }
   
      $product->save();
  
      return $this->showOne($product);

       

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Seller  $seller
     * @return \Illuminate\Http\Response
     */
    public function destroy(Seller $seller, product $product)
    {
         
         $this->checkSeller($seller, $product);

      $product->delete();
  
       Storage::delete($product->image);
       return $this->showOne($product);
         


    }



   protected function checkSeller(Seller $seller , product $product)

{
     if ($seller->id != $product->seller_id) {
               
            throw new  HttpException(422, 'The spacified seller is not actual seller of the product');
            
    }    

}


}
