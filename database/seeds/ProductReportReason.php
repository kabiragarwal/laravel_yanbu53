<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ProductReportReason extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product_report_reason')->insert([
            ['name' => 'Duplicate', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Fraud', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Item unavailable', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Spam', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Wrong Category',  'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Other', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ]);
    }
}
