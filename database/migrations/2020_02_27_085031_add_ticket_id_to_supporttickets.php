<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTicketIdToSupporttickets extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('supporttickets', function (Blueprint $table) {
            //
            $table->string('ticket_id')->after('topic_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('supporttickets', function (Blueprint $table) {
            //
            $table->dropColumn(['ticket_id']);
        });
    }
}
