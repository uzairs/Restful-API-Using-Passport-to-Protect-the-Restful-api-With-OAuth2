<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Buyer;
class BuyerTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Buyer $buyer)
    {
        return [
            
             'identifier'=>(int)$buyer->id,
             'name' =>(String)$buyer->name,
             'email'=> (String)$buyer->email,
             'isverified'=>(int)$buyer->verified,
             'creationDate'=>(String) $buyer->created_at,
             'lastChange'=>(String) $buyer->updated_at,
             'deletedDate'=> isset($buyer->deleted_at)  ? (String) $buyer->deleted_at :  null,



    'link' => [ 

                 [

                    'rel' => 'self',
                     'href' => route('buyers.show', $buyer->id),
                 ],
            
                   
                 [

                    'rel' => 'buyer.categories',
                     'href' => route('buyers.categories.index', $buyer->id),
                 ],

                 [

                    'rel' => 'buyer.products',
                     'href' => route('buyers.products.index', $buyer->id),
                 ],
             
                 [
             
               'rel'=> 'buyer.sellers',
               'href'=> route('buyers.sellers.index', $buyer->id),

             ],

             [
             'rel' => 'buyer.transactions',
               'href' => route('buyers.transactions.index', $buyer->id),

             ],
        ]





        ];
    }
     public static function  originalAttribute($index)
    {
         $attributes = [
             'identifier'=> 'id',
             'name' => 'name',
             'email'=>  'email',
             'isverified'=> 'verified',
            'creationDate'=> 'created_at',
            'lastChange'=> 'updated_at',
            'deletedDate' => 'deleted_at',


    ];
      return isset($attributes[$index]) ? $attributes[$index] : null;

    }



  public static function  transformedAttribute($index)
    {
         $attributes = [
             'id'=> 'identifier',
             'name' => 'name',
             'email'=>  'email',
             'verified'=> 'isverified',
            'created_at'=> 'creationDate',
            'updated_at'=> 'lastChange',
            'deleted_at' => 'deletedDate',


    ];
      return isset($attributes[$index]) ? $attributes[$index] : null;

    }


}
