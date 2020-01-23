<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('offer_name',100);
            $table->string('offer_code',100);
            $table->boolean('offer_type')->comment('0-flat and 1-percentage');
            $table->string('offer_desc',255);
            $table->integer('min_order_value');
            $table->integer('max_discount');
            $table->integer('min_offer_amount');
            $table->boolean('is_active');
            $table->date('start_date');
            $table->date('end_date');
            $table->integer('no_of_counts');
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
        Schema::dropIfExists('offers');
    }
}
