<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveProductIdFromVariationmaster extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('variationmaster', function (Blueprint $table) {
            $table->dropForeign('variationmaster_product_id_foreign');
            $table->dropColumn('product_id');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('variationmaster', function (Blueprint $table) {
            //
        });
    }
}
