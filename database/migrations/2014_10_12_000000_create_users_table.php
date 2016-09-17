<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('users', function (Blueprint $table) {
                    $table->increments('id');
                    $table->string('user_type');
                    $table->string('first_name');
                    $table->string('last_name');
                    $table->string('password');
                    $table->string('email')->unique();
                    $table->string('phone');
                    $table->boolean('hide_phone')->default(0);
                    $table->string('gender');
                    $table->string('address');
                    $table->integer('city_id');
                    $table->integer('state_id');
                    $table->integer('country_id');
                    $table->string('zip_code');
                    $table->string('image');
                    $table->integer('profile_visit');
                    $table->boolean('verified')->default(0);
                    $table->boolean('newsletter')->default(1);
                    $table->boolean('suggestions')->default(1);
                    $table->string('token');
                    $table->rememberToken();
                    $table->timestamps();
                });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('users');
    }

}
