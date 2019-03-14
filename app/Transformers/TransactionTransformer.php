<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\transaction;
class TransactionTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Transaction $transaction)
    {
        return [
               'identifier'=>(int)$transaction->id,
                'Quantity'=>(int)$transaction->quantity,
                'buyer'=>(int)$transaction->buyer_id,
                'Products'=>(int)$transaction->product_id,
                'creationDate'=>(String)$transaction->created_at,
                'lastChange'=>(String) $transaction->updated_at,
                'Deleted_at'=> isset($transaction->deleted_at) ? (String) $transaction->deleted_at: null,
     
          'link' => [
        
           [

                    'rel'=> 'self',
                     'href'=> route('transactions.show', $transaction->id),
 

           ],

                [

                    'rel'=> 'transaction.categories',
                     'href'=> route('transactions.categories.index', $transaction->id),
 

           ],

                [

                    'rel'=> 'transaction.sellers',
                     'href'=> route('transactions.sellers.index', $transaction->id),
 

           ],


[

                    'rel'=> 'buyer',
                     'href'=> route('buyers.show', $transaction->buyer_id),
 

           ],



           [

                    'rel'=> 'product',
                     'href'=> route('products.show', $transaction->product_id),
 

           ],




     ]        
  






        ];
    
    }


    public static function  originalAttribute($index)
    {
         $attributes = [
             'identifier' => 'id',
             'Quantity' => 'quantity',
             'buyer'  => 'buyer_id',
             'Products' =>'product_id',
             'CreationDate' =>'created_at',
             'lastChange'=>'updated_at',
             'DeletedDate'=> 'deleted_at', 

    ];

      return isset($attributes[$index]) ? $attributes[$index] : null;

    }


    public static function  transformedAttribute($index)
    {
         $attributes = [
             'id' => 'identifier',
             'quantity' => 'Quantity',
             'buyer_id'  => 'buyer',
             'product_id' =>'Products',
             'created_at' =>'CreationDate',
             'updated_at'=>'lastChange',
             'deleted_at'=> 'DeletedDate', 

    



    ];
    
      return isset($attributes[$index]) ? $attributes[$index] : null;

    }


}
