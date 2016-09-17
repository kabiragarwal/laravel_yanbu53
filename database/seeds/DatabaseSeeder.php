<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
          //$this->call(PagesSeeder::class);
          //$this->call(CategorySeeder::class);
          //$this->call(SubCategoryTableSeeder::class);
          //$this->call(CouponTableSeeder::class);
          //$this->call(PremiumAdCategoryTableSeeder::class);
          //$this->call(ProductStatusSeeder::class);
          //$this->call(LocationSeeder::class);
          $this->call(ProductReportReason::class);
          //$this->call(RoleSeeder::class);
          //$this->call(AdminSeerder::class);
          //$this->call(UserSeeder::class);
          //$this->call(ProductSeeder::class);
          //$this->call(ProductImageSeerder::class);
    }
}
