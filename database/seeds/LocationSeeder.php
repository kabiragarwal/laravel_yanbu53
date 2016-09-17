<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
     protected $createdAt = "Carbon::now()";
     protected $updatedAt = "Carbon::now()";

     public function run() {
         DB::table('countries')->insert([
             $this->countryArray('India'),
             $this->countryArray('United States'),
             $this->countryArray('United Kingdom'),
         ]);

         DB::table('states')->insert([
             $this->stateArray(1, 'Rajasthan'),
             $this->stateArray(1, 'Madhya Pradesh'),
             $this->stateArray(1, 'Utter Pradesh'),
             $this->stateArray(1, 'Maharastra'),

             $this->stateArray(2, 'Illinois'),
             $this->stateArray(2, 'California'),
             $this->stateArray(2, 'New York'),
             $this->stateArray(2, 'South Carolina'),

             $this->stateArray(3, 'England'),
             $this->stateArray(3, 'Wales'),
             $this->stateArray(3, 'Scotland'),
             $this->stateArray(3, 'Northern Ireland'),
         ]);

         DB::table('cities')->insert([
             $this->cityArray(1, 'Ajmer'),
             $this->cityArray(1, 'Sikar'),
             $this->cityArray(1, 'Jaipur'),

             $this->cityArray(2, 'Indore'),
             $this->cityArray(2, 'Ujjain'),
             $this->cityArray(2, 'Bhopal'),

             $this->cityArray(3, 'Kanpur'),
             $this->cityArray(3, 'Varanasi'),
             $this->cityArray(3, 'Allahabad'),

             $this->cityArray(4, 'Nashik'),
             $this->cityArray(4, 'Mumbai'),
             $this->cityArray(4, 'Pune'),

             $this->cityArray(5, 'Chicago'),
             $this->cityArray(5, 'Aurora'),
             $this->cityArray(5, 'Rockford'),

             $this->cityArray(6, 'Adelanto'),
             $this->cityArray(6, 'Buellton'),
             $this->cityArray(6, 'Chico'),

             $this->cityArray(7, 'Amsterdam'),
             $this->cityArray(7, 'Dunkirk'),
             $this->cityArray(7, 'Watertown'),

             $this->cityArray(8, 'Bamberg'),
             $this->cityArray(8, 'Chester'),
             $this->cityArray(8, 'Hardeeville'),

             $this->cityArray(9, 'Birmingham'),
             $this->cityArray(9, 'Liverpool'),
             $this->cityArray(9, 'Cambridge'),

             $this->cityArray(10, 'Swansea'),
             $this->cityArray(10, 'Newport'),
             $this->cityArray(10, 'Bangor'),

             $this->cityArray(11, 'Edinburgh'),
             $this->cityArray(11, 'Glasgow'),
             $this->cityArray(11, 'Dundee'),

             $this->cityArray(12, 'Lisburn'),
             $this->cityArray(12, 'Belfast'),
             $this->cityArray(12, 'Armagh'),
         ]);
     }

     public function slugModify($slug) {
         return str_replace(array(' ', ',', '&'), array('-', '', 'and'), strtolower($slug));
     }



     public function countryArray($name) {
         return ['name' => $name, 'slug' => $this->slugModify($name), 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()];
     }

     public function stateArray($id, $name) {
         return ['country_id' => $id, 'name' => $name, 'slug' => $this->slugModify($name), 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()];
     }

     public function cityArray($id, $name) {
         return ['state_id' => $id, 'name' => $name, 'slug' => $this->slugModify($name), 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()];
     }
}
