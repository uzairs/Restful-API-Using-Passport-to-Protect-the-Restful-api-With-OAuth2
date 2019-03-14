<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) {
  //  return $request->user();
//});


//Buyer
Route::resource('buyers','Buyer\BuyerController', [ 'only'=> ['index','show' ]]);

Route::resource('buyers.transactions','Buyer\BuyerTransactionController', [ 'only' => ['index']]);
Route::resource('buyers.products','Buyer\BuyerProductController', [ 'only' => ['index']]);
Route::resource('buyers.sellers','Buyer\BuyerSellerController', [ 'only' => ['index']]);
Route::resource('buyers.categories','Buyer\BuyerCategoryController', [ 'only' => ['index']]);


//Cetageries
Route::resource('cetagorys','Category\CategoryController', ['except'=> ['create','edit' ]]);

Route::resource('cetagorys.products','Category\CategoryProductController', ['only'=> ['index']]);
Route::resource('cetagorys.sellers','Category\CategorySellerController', ['only'=> ['index']]);
Route::resource('cetagorys.transactions','Category\CategoryTransactionController', ['only'=> ['index']]);
Route::resource('cetagorys.buyers','Category\CategorybuyerController', ['only'=> ['index']]);


//Products
Route::resource('products','Product\ProductController', [ 'only'=> ['index','show' ]]);

Route::resource('products.transactions','Product\ProductTransactionController', [ 'only'=> ['index']]);
Route::resource('products.buyers','Product\ProductbuyerController', [ 'only'=> ['index']]);
Route::resource('products.buyers.transactions','Product\ProductBuyerTransactionController', [ 'only'=> ['store']]);
Route::resource('products.Category','Product\ProductCategoryController', [ 'only'=> ['index' , 'update', 'destroy']]);


//Seller
Route::resource('sellers','Seller\SellerController', [ 'only'=> ['index','show' ]]);

Route::resource('sellers.transactions','Seller\SellerTransactionController', [ 'only'=> ['index']]);
Route::resource('sellers.cetagorys','Seller\SellerCategoryController', [ 'only'=> ['index']]);
Route::resource('sellers.buyers','Seller\SellerbuyerController', [ 'only'=> ['index']]);
Route::resource('sellers.products','Seller\SellerProductController', [ 'except' => ['create', 'show', 'edit']]);



//Transections
Route::resource('transactions','Transaction\TransactionController', [ 'only'=> ['index','show' ] ]);
Route::resource('transactions.categories','Transaction\TransactionCategoryController', [ 'only'=> ['index']]);
Route::resource('transactions.sellers','Transaction\TransactionSellerController', [ 'only'=> ['index'] ]);


 //Users

Route::resource('users','User\UserController', [ 'except'=> ['create','edit'] ]);

Route::name('verify')->get('users/verify/{token}', 'User\UserController@verify');

Route::name('resend')->get('users/{user}/resend', 'User\UserController@resend');

Route::post('oauth/token', '\Laravel\Passport\Http\Controllers\AccessTokenController@issueToken');














