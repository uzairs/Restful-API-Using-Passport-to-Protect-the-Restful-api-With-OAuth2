<?php

namespace App\Http\Controllers\Product;
use App\User;
use App\product;
use App\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiContoller;
use Illuminate\Support\Facades\DB;
use App\Transformers\TransactionTransformer;


class ProductBuyerTransactionController extends ApiContoller
{
  
   public function __construct()
   { 
      parent::__construct();

     $this->middleware('transform.input:' .TransactionTransformer::class)->only(['store']);
     $this->middleware('scope:purchase-product')->only(['store']);
      $this->middleware('can:puchase,buyer')->only('store');
   }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request , Product $product , User $buyer)
    {

        $rules =[
            'quantity' => 'required|integer|min:1',

        ];


     if ($buyer->id == $product->seller_id) {
         return $this->errorResponse('The buyer must be  different from the seller', 409);
     }

if (!$buyer->isVerified()) {
       return $this->errorResponse('The buyer must be a Verified User',409);
   }   
if (!$product->seller->isVerified()) {
    return $this->errorResponse('The Seller must be a Verified user',409);
}
  
if (!$product->isAvailable()) {
    return $this->errorResponse('The Product is not Available',409);
}

if ($product->quantity < $request->quantity) {
    return $this->errorResponse('The product does not have enought units for this transaction', 409);
}
    return DB::transaction(function() use ($request, $product , $buyer){

     $product->quantity -= $request->quantity;
     $product->save();

    $transaction = Transaction::create([
      'quantity' => $request->quantity,
      'buyer_id' => $buyer->id,
      'product_id' => $product->id,

    ]);

      return $this->showOne($transaction, 201);

    });

    }


}
