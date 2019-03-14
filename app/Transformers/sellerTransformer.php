<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Seller;
class sellerTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Seller $seller)
    {
        return [
        'identifier'=>(int)$seller->id,
             'name' =>(String)$seller->name,
             'email'=> (String)$seller->email,
             'isverified'=>(int)$seller->verified,
             'creationDate'=>(String)$seller->created_at,
             'lastChange'=>(String)$seller->updated_at,
             'DeletedDate'=> isset($seller->deleted_at)  ? (String) $seller->deleted_at :  null,
    

            'link' => [ 

                 [

                    'rel' => 'self',
                     'href' => route('sellers.show', $seller->id),
                 ],
            
                   
                 [

                    'rel' => 'seller.categories',
                     'href' => route('sellers.cetagorys.index', $seller->id),
                 ],

                 [

                    'rel' => 'seller.products',
                     'href' => route('sellers.products.index', $seller->id),
                 ],
             
                 [
             
               'rel'=> 'seller.buyers',
               'href'=> route('sellers.buyers.index', $seller->id),

             ],

             [
             'rel' => 'seller.transactions',
               'href' => route('sellers.transactions.index', $seller->id),

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
            'DeletedDate' => 'deleted_at', 

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
            'deleted_at' => 'DeletedDate', 

    ];
      return isset($attributes[$index]) ? $attributes[$index] : null;

    }







}
