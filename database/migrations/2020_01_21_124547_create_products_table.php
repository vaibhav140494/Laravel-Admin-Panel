<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->bigIncrements('id');
            $table->bigInteger('category_id')->unsigned();
            $table->foreign('category_id')
            ->references('id')->on('categories')
            ->onDelete('cascade');
            $table->bigInteger('subcategory_id')->unsigned();
            $table->foreign('subcategory_id')
            ->references('id')->on('subcategories')
            ->onDelete('cascade');
            $table->integer('sku');
            $table->string('product_name',50);
            $table->integer('quantity');
            $table->integer('type')->default(1)->comment('1-simple and 2-congigurable');
            $table->float('price');
            $table->float('discouted_price');
            $table->string('image');
            $table->text('specification');
            $table->timestamps();
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
