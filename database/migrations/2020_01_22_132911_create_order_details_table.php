<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('product_id')->unsigned();
            $table->foreign('product_id')
            ->references('id')->on('products')
            ->onDelete('cascade');
            $table->bigInteger('order_id')->unsigned();
            $table->foreign('order_id')
            ->references('id')->on('orders')
            ->onDelete('cascade');
            $table->integer('quntity');
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
        Schema::dropIfExists('order_details');
    }
}
