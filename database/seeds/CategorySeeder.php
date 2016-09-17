<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class CategorySeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    protected $createdAt = "Carbon::now()";
    protected $updatedAt = "Carbon::now()";

    public function run() {
        DB::table('categories')->insert([
            $this->makeInsertArray('Electronics'),
            $this->makeInsertArray('Automobiles'),
            $this->makeInsertArray('Property'),
            $this->makeInsertArray('Jobs'),
            $this->makeInsertArray('Services'),
            $this->makeInsertArray('Learning'),
            $this->makeInsertArray('Pets'),
            $this->makeInsertArray('For Sale'),
            $this->makeInsertArray('Community')
        ]);
    }

    public function slugModify($slug) {
        return str_replace(array(' ', ',', '&'), array('-', '', 'and'), strtolower($slug));
    }

    public function makeInsertArray($name) {
        return ['name' => $name, 'slug' => $this->slugModify($name), 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()];
    }

}
