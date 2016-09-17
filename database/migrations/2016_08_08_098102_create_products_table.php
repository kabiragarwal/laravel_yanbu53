<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('products', function (Blueprint $table) {
                    $table->increments('id');
                    $table->integer('user_id')->unsigned();
                    $table->string('title');
                    $table->string('slug');
                    $table->string('type');
                    $table->string('subcategory_id');
                    $table->string('price');
                    $table->boolean('price_negotiable');
                    $table->string('premiumadcategory_id')->default(0);
                    $table->text('description');
                    $table->timestamps();
                    $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
                    //$table->foreign('subcategory_id')->references('id')->on('subcategories')->onDelete('cascade');
                });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('products');
    }

}
