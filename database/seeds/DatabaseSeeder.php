<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Category;
use App\product;
use App\Transaction;
use Illuminate\Support\Facades\DB;
class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
          DB::statement('SET FOREIGN_KEY_CHECKS = 0');

          User::truncate();
          Category::truncate();
          product::truncate();
          Transaction::truncate();
          DB::table('category_product')->truncate();  

          User::flushEventListeners();
          Category::flushEventListeners();
          product::flushEventListeners();
          Transaction::flushEventListeners();



          $usersQuantity =   1000;
          $categoriesQuantity = 30;
          $productsQuantity = 1000;
          $transactionsQuantity = 1000;

          factory(User::Class, $usersQuantity)->create();

          factory(Category::Class, $categoriesQuantity)->create();

           factory(product::Class, $productsQuantity)->create()->each(

            function($product){

             $categories =  Category::all()->random(mt_rand(1, 5))->pluck('id');                    

             $product->categories()->attach($categories);     

           });

           factory(Transaction::Class,$transactionsQuantity)->create();
        
    }
}
