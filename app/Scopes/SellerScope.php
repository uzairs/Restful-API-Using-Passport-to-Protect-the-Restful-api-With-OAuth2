<?php

 namespace App\Scopes;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope; 
use Illuminate\Database\Eloquent\Builder;

 Class SellerScope implements Scope 

{

   public function apply(Builder $builder, Model $model)
   {
        $builder->has('products');


   }




 }








?>