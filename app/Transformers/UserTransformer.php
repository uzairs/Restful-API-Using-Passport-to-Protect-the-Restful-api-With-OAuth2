<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\User;
class UserTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(User $user)
    {
        return [
          'identifier'=>(int)$user->id,
            'name' =>(String)$user->name,
            'email'=> (String)$user->email,
            'isverified'=>(int)$user->verified,
            'isAdmin'=>  ($user->admin ===  'true'),
             'creationDate'=>(String) $user->created_at,
              'lastChange'=>(String)$user->updated_at,
              'deletedDate'=> isset($user->deleted_at)  ? (String) $user->deleted_at :  null,

       'link'=> [
      
    [

            'rel'=> 'self',
              'herf'=>route('users.show', $user->id),

    ],
       ]
  

        ];
    }


    public static function  originalAttribute($index)
    {
         $attributes = [
             'identifier' =>'id',
             'name' => 'name',
             'email'=> 'email',
             'isverified' => 'verified',
             'isAdmin'=> 'admin',
            'creationDate' => 'created_at',
            'lastChange' => 'updated_at',
            'deletedDate' => 'deleted_at', 

    ];
      return isset($attributes[$index]) ? $attributes[$index] : null;

    }


    public static function  transformedAttribute($index)
    {
         $attributes = [              
                 'id' => 'identifier',
                'name' => 'name',
                'email' => 'email',
                'verified'=> 'isverified',
                'admin' =>    'isAdmin',
                'created_at' => 'creationDate',
                'updated_at' =>  'lastChange',
               'deleted_at'  =>  'deletedDate', 

                   
 
    ];

      return isset($attributes[$index]) ? $attributes[$index] : null;

}


}