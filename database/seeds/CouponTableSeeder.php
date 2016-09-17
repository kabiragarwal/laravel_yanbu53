<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class CouponTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('coupons')->insert([
            ['code' => 'All_100', 'discount' => '100', 'status'=>'1', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['code' => 'TOP_100', 'discount' => '100', 'status'=>'1', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['code' => 'FEATURE_100', 'discount' => '100', 'status'=>'1', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['code' => 'URGENT_100', 'discount' => '100', 'status'=>'1', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ]);
    }
}
