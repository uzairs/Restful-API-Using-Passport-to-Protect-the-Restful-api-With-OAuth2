<?php
use App\product;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->String('name');
            $table->String('description', 1000);
            $table->integer('quantity')->unsigned();
            $table->String('status')->default(product::UNAVAILABLE_PRODUCT);
            $table->String('image');
            $table->integer('seller_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();
             
             $table->foreign('seller_id')->references('id')->on('users');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
