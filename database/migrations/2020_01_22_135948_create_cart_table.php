<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cart', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')
                  ->references('id')->on('users')
                  ->onDelete('cascade');
            $table->bigInteger('product_id')->unsigned();      
            $table->foreign('product_id')
                  ->references('id')->on('products')
                  ->onDelete('cascade');  
            $table->bigInteger('order_id')->unsigned()->nullable();
            $table->foreign('order_id')
                  ->references('id')->on('orders')
                  ->onDelete('cascade');
            $table->string('cart_id',20);
            $table->integer('quantity');
            $table->integer('gross_amount');
            $table->integer('tax_amount');
            $table->integer('total_amount');                
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
        Schema::dropIfExists('cart');
    }
}
