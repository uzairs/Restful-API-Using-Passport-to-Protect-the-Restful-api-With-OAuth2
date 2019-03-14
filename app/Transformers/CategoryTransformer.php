<?php  

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Category;
class CategoryTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Category $category)
    {
        return [

              'identifier' => (int)$category->id,
               'title' => (String)$category->name,
              'details' => (String)$category->description,
              'creationDate'=> (String)$category->created_at,
              'lastChange'=> (String)$category->updated_at,
              'DeletedDate'=> isset($category->deleted_at)  ? (String) $category->deleted_at: null,

             'link' => [ 

                 [

                    'rel' => 'self',
                     'href' => route('cetagorys.show', $category->id),
                 ],
            
                   
                 [

                    'rel' => 'category.buyers',
                     'href' => route('cetagorys.buyers.index', $category->id),
                 ],

                 [

                    'rel' => 'category.products',
                     'href' => route('cetagorys.products.index', $category->id),
                 ],
             
                 [
             
               'rel'=> 'category.sellers',
               'href'=> route('cetagorys.sellers.index', $category->id),

             ],

             [
             'rel' => 'category.transactions',
               'href' => route('cetagorys.transactions.index', $category->id),

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
             'description'=> 'details',
            'created_at' => 'creationDate',
            'updated_at'=> 'lastChange',
            'deleted_at'=> 'DeletedDate', 

    ];
      return isset($attributes[$index]) ? $attributes[$index] : null;

    }









}
