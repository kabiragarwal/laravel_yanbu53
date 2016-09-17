<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'user_type' => $faker->randomElement($array = array('Professional','Individual')),
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'password' => 123456,
        'email' => $faker->freeEmail,
        'phone' => $faker->numberBetween($min = 100000000, $max = 999999999),
        'hide_phone' => $faker->boolean,
        'gender' => $faker->randomElement($array = array('Male','Female')),
        'address' => $faker->address,
        'city_id' => '1',
        'state_id' => '1',
        'country_id' => '1',
        'zip_code' => $faker->postcode,
        'image' => $faker->file(public_path().'/upload/Wallpaper', public_path().'/upload/users', false),
        'profile_visit' => $faker->numberBetween($min = 10, $max = 99),
        'verified' => 1,
        'newsletter' => $faker->boolean,
        'suggestions' => $faker->boolean,
    ];
});

$factory->define(App\Product::class, function (Faker\Generator $faker) {
    return [
        //'user_id' => factory(App\User::class)->create()->id,
        'user_id' => $faker->numberBetween(2,10),
        'title' => $faker->sentence($nbWords = 6, $variableNbWords = true),
        'type' => $faker->randomElement($array = array('Private','Business')),
        'subcategory_id' => $faker->numberBetween(1,60),
        'price' => $faker->numberBetween(10,10000),
        'price_negotiable' => 1,
        'description' => $faker->paragraphs(3, true),
        'visitors' => 0,
        'status' => 1,
    ];
});


$factory->define(App\ProductImage::class, function (Faker\Generator $faker) {
    $imageCode = $faker->file(public_path().'/upload/Wallpaper', public_path().'/upload/products', false);
    return [
        //'product_id' => factory(App\Product::class)->create()->id,
        //'product_id' => '',

        'image' => $imageCode,
        'thumbnail_image' => $imageCode,
    ];
});


$factory->define(App\Role::class, function (Faker\Generator $faker) {
    return [
        'name' => 'Admin',
    ];
});

$factory->define(App\Page::class, function (Faker\Generator $faker) {
    $title = $faker->sentence($nbWords = 6, $variableNbWords = true);
    return [
        'title' => $title,
        'slug' => str_replace(' ', '-', strtolower(trim($title))),
        'content' => $faker->paragraphs(3, true)
    ];
});

$factory->define(App\Country::class, function (Faker\Generator $faker) {
    return [
        'name' => '0',
        'slug' => '0'
    ];
});

$factory->define(App\State::class, function (Faker\Generator $faker) {
    return [
        'country_id' =>0,
        'name' => '0',
        'slug' => '0'
    ];
});

$factory->define(App\City::class, function (Faker\Generator $faker) {
    return [
        'state_id' =>0,
        'name' => '0',
        'slug' => '0'
    ];
});
