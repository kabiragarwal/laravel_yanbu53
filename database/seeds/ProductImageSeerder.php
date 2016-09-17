<?php

use Illuminate\Database\Seeder;

class ProductImageSeerder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\ProductImage::class, 5)->create();
    }
}
