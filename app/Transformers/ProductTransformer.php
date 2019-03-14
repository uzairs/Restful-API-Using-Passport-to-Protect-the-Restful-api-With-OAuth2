<?php

namespace App\Transformers;
use App\product;
use League\Fractal\TransformerAbstract;

class ProductTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(product $product)
    {
        return [

             'identifier'=>(int)$product->id,
             'title'=>(String)$product->name,
             'details'=>(String)$product->description,
             'stock'=>(int)$product->quantity,
             'situation'=>(String)$product->status,
             'picture'=>url("img/{$product->image}"),
             'seller'=> (int)$product->seller_id,
             'creationDate'=>(String)$product->created_at,
             'lastChange'=>(String)$product->updated_at,
             'DeletedDate'=>isset($product->deleted_at) ? (String)  $product->deleted_at: null,
            
     'link' => [
        
           [

                    'rel'=> 'self',
                     'href'=> route('products.show', $product->id),
 

           ],

                [

                    'rel'=> 'product.buyers',
                     'href'=> route('products.buyers.index', $product->id),
 

           ],

           [

                    'rel'=> 'product.Category',
                     'href'=> route('products.Category.index', $product->id),
 

           ],
           [

                    'rel'=> 'product.transactions',
                     'href'=> route('products.transactions.index', $product->id),
 

           ],
                [

                    'rel'=> 'seller',
                     'href'=> route('sellers.show', $product->seller_id),
 

           ],

     ]        
  

        ];
    }

      public static function  originalAttribute($index)
    {
         $attributes = [
             'identifier' =>'id',
             'title' =>'name',
             'details'=>'description',
             'stock'=>'quantity',
             'situation'=>'status',
             'picture'=>'image',
             'seller'=> 'seller_id',
            'creationDate' => 'created_at',
            'lastChange'=>'updated_at',
            'DeletedDate'=> 'deleted_at', 

    ];
      return isset($attributes[$index]) ? $attributes[$index] : null;

    }


public static function  transformedAttribute($index)
    {
         $attributes = [
             'id' =>'identifier',
             'name' =>'title',
             'description'=>'details',
             'quantity'=>'stock',
             'status'=>'situation',
             'image'=>'picture',
             'seller_id'=> 'seller',
            'created_at' => 'creationDate',
            'updated_at'=>'lastChange',
            'deleted_at'=> 'DeletedDate', 

    ];
      return isset($attributes[$index]) ? $attributes[$index] : null;

    }



}
