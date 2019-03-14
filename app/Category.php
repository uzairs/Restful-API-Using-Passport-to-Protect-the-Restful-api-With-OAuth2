<?php

namespace App;

use App\product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use  App\Transformers\CategoryTransformer;
class Category extends Model
{

  use SoftDeletes;

protected $hidden =[ 'pivot'

];
    public $transformer = CategoryTransformer::class;
    protected $dates = ['deleted_at'];

  protected $fillable = 
  
  [
        'description',
        'name',
     
  ];

  public function products() 

  {
 
   return $this->belongsToMany(product::class);

  }
  


}
