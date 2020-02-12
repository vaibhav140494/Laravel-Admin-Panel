<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')
            ->references('id')->on('users')
            ->onDelete('cascade');
            $table->bigInteger('offer_id')->unsigned();
            $table->foreign('offer_id')
            ->references('id')->on('offers')
            ->onDelete('cascade');
            $table->string('order_id',20);
            $table->string('instructions',255);
            $table->float('gross_amount');
            $table->float('tax_amount');
            $table->float('total_amount');
            $table->float('discount');
            $table->enum('status', ['placed', 'confirmed','dispatched','delivered','returned','refunded','canceled'])->default('placed');
            $table->boolean('type')->comment('0-pickup and 1-delivery');
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
        Schema::dropIfExists('orders');
    }
}
