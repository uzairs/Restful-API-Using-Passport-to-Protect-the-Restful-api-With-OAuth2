<?php

namespace App;

use App\product;
use App\Scopes\SellerScope;
use App\Transformers\sellerTransformer;

class Seller extends User
{
      public $transformer = sellerTransformer::class;
      protected static function boot()
      
      {
        
         parent::boot();
         static::addGlobalScope(new SellerScope);


      }


      public function products()

      {

          return $this->hasMany(product::class);


      }


}
