<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePremiumAdCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('premium_ad_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('title');
            $table->string('slug');
            $table->string('amount');
            $table->timestamps();
        });

        Schema::create('premiumadcategory_product', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('premiumadcategory_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->integer('coupon_id')->nullable()->default(0);
            $table->string('total_amount');
            $table->string('discount_amount');
            $table->string('net_amount');
            $table->string('payment_method');
            $table->timestamps();
            $table->foreign('premiumadcategory_id')->references('id')->on('premium_ad_categories')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    //total_amount
    //coupon_id
    //discount
    //net_amount
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('premium_ad_categories');
        Schema::drop('premiumadcategory_product');
    }
}
