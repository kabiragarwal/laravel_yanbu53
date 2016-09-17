<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ProductStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('statuses')->insert([
            ['status' => 'Active', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['status' => 'Inactive', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['status' => 'Pending', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['status' => 'Archived', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ]);
    }
}
