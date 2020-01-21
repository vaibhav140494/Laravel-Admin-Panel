<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVariationvaluesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('variationvalues', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('variation_value',50);
            $table->bigInteger('variation_id')->unsigned();
            $table->foreign('variation_id')
            ->references('id')->on('variationmaster')
            ->onDelete('cascade');
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
        Schema::dropIfExists('variationvalues');
    }
}
