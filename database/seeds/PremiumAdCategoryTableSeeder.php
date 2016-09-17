<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class PremiumAdCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('premium_ad_categories')->insert([
            ['name' => 'Featured Ad', 'title' => 'Featured Ads', 'slug' => 'featured', 'amount' => '10.00', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Urgent Ad', 'title' => 'Urgent Ads', 'slug' => 'urgent', 'amount' => '20.00', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Top of the Page Ad', 'title' => 'Top Ads', 'slug' => 'top', 'amount' => '30.00', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Top of the Page Ad + Urgent Ad', 'title' => 'Top + Urgent Ads', 'slug' => 'top_urgent', 'amount' => '50.00', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ]);
    }
}
