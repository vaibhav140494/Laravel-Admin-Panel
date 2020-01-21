<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name', 100);
            $table->string('last_name', 100 );
            $table->string('address',250);
            $table->integer('pincode');
            $table->string('email',250)->unique();
            $table->string('username',100);
            $table->string('password',100)->nullable();
            $table->boolean('status')->default(1);
            $table->string('confirmation_code',191)->nullable();
            $table->boolean('confirmed')->default(0);
            $table->boolean('is_term_accept')->default(0);
            $table->string('phone_no',20);
            $table->string('remember_token',100)->nullable();
            $table->date('birthdate');
            $table->boolean('is_verified')->default(0);
            $table->boolean('role')->default(2);
            $table->integer('created_by')->unsigned();
            $table->integer('updated_by')->unsigned()->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
