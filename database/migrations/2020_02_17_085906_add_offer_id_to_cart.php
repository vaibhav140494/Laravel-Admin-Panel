<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOfferIdToCart extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cart', function (Blueprint $table) {
            $table->bigInteger('offer_id')->unsigned();
            $table->foreign('offer_id')
                    ->references('id')->on('offers')
                    ->onDelete('cascade');   
        });
    }
    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cart', function (Blueprint $table) {
            $table->dropForeign('cart_offer_id_foreign');
            $table->dropColumn(['offer_id']);
        });
    }
}
