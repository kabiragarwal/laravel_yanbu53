<?php

use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Product::class, 500)->create()->each(function($product) {
            $product->images()->save(factory(App\ProductImage::class)->make());
        });


        //factory(App\Product::class, 5)->create();
    }
}
