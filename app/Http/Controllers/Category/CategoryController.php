<?php

namespace App\Http\Controllers\Category;
use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiContoller;
use App\Transformers\CategoryTransformer;

class CategoryController extends ApiContoller

{

  public function __construct(){

      

      $this->middleware('client.credentials')->only(['index','show']);
      $this->middleware('auth:api')->except(['index','show']);
   $this->middleware('transform.input:' . CategoryTransformer::class)->only(['store','update']);     
    

   }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categorys = Category::all();

        return $this->showAll($categorys);

    }

        /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [

           'name'=> 'required',
           'description' => 'required',
     ];

        $this->Validate($request, $rules); 
     $newCategory = Category::create($request->all());
      return $this->showOne($newCategory, 201);

    }

    /**
     * Display the specified resource.
     *
     * @param  App\Category\ $category
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $category = Category::findOrfail($id);
       return $this->showOne($category);
    }

    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      

       $category = Category::findOrfail($id);
      $category->fill($request->intersect([
        'name',
        'description',

      ]));
         
   if ($category->isClean()) {
   return $this->errorResponse('You need to specify any different value to update', 422);

}

     $category->save();

     return $this->showOne($category);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
 
    {
      $category = Category::findOrfail($id);
        $category->delete();

        return $this->showOne($category);
    }

}














