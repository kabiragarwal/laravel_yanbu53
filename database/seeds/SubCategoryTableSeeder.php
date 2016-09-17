<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class SubCategoryTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    protected $createdAt = "Carbon::now()";
    protected $updatedAt = "Carbon::now()";

    public function run() {
        DB::table('subcategories')->insert([
            $this->makeInsertArray(1, 'Mobiles'),
            $this->makeInsertArray(2, 'Car Parts & Accessories'),
            $this->makeInsertArray(2, 'Campervans & Caravans'),
            $this->makeInsertArray(2, 'Motorbikes & Scooters'),
            $this->makeInsertArray(2, 'Motorbike Parts & Accessories'),
            $this->makeInsertArray(2, 'Vans, Trucks & Plant'),
            $this->makeInsertArray(2, 'Wanted'),
            $this->makeInsertArray(3, 'House for Rent'),
            $this->makeInsertArray(3, 'House for Sale'),
            $this->makeInsertArray(3, 'Apartments For Sale'),
            $this->makeInsertArray(3, 'Apartments for Rent'),
            $this->makeInsertArray(3, 'Farms-Ranches'),
            $this->makeInsertArray(3, 'Land'),
            $this->makeInsertArray(3, 'Vacation Rentals'),
            $this->makeInsertArray(3, 'Commercial Building'),
            $this->makeInsertArray(4, 'Full Time Jobs'),
            $this->makeInsertArray(4, 'Internet Jobs'),
            $this->makeInsertArray(4, 'Learn & Earn jobs'),
            $this->makeInsertArray(4, 'Manual Labor Jobs'),
            $this->makeInsertArray(4, 'Other Jobs'),
            $this->makeInsertArray(4, 'OwnBusiness'),
            $this->makeInsertArray(5, 'Building, Home & Removals'),
            $this->makeInsertArray(5, 'Entertainment'),
            $this->makeInsertArray(5, 'Health & Beauty'),
            $this->makeInsertArray(5, 'Miscellaneous'),
            $this->makeInsertArray(5, 'Property & Shipping'),
            $this->makeInsertArray(5, 'Tax, Money & Visas'),
            $this->makeInsertArray(5, 'Telecoms & Computers'),
            $this->makeInsertArray(5, 'Travel Services & Tours'),
            $this->makeInsertArray(5, 'Tuition & Lessons'),
            $this->makeInsertArray(6, 'Automotive Classes'),
            $this->makeInsertArray(6, 'Computer Multimedia Classes'),
            $this->makeInsertArray(6, 'Sports Classes'),
            $this->makeInsertArray(6, 'Home Improvement Classes'),
            $this->makeInsertArray(6, 'Language Classes'),
            $this->makeInsertArray(6, 'Music Classes'),
            $this->makeInsertArray(6, 'Personal Fitness'),
            $this->makeInsertArray(6, 'Other Classes'),
            $this->makeInsertArray(7, 'Pets for Sale'),
            $this->makeInsertArray(7, 'Petsitters & Dogwalkers'),
            $this->makeInsertArray(7, 'Equipment & Accessories'),
            $this->makeInsertArray(7, 'Missing, Lost & Found'),
            $this->makeInsertArray(8, 'Audio & Stereo'),
            $this->makeInsertArray(8, 'Baby & Kids Stuff'),
            $this->makeInsertArray(8, 'CDs, DVDs, Games & Books'),
            $this->makeInsertArray(8, 'Clothes, Footwear & Accessories'),
            $this->makeInsertArray(8, 'Computers & Software'),
            $this->makeInsertArray(8, 'Home & Garden'),
            $this->makeInsertArray(8, 'Music & Instruments'),
            $this->makeInsertArray(8, 'Office Furniture & Equipment'),
            $this->makeInsertArray(8, 'Phones, Mobile Phones & Telecoms'),
            $this->makeInsertArray(8, 'Sports, Leisure & Travel'),
            $this->makeInsertArray(8, 'Tickets'),
            $this->makeInsertArray(8, 'TV, DVD & Cameras'),
            $this->makeInsertArray(8, 'Video Games & Consoles'),
            $this->makeInsertArray(8, 'Freebies'),
            $this->makeInsertArray(8, 'Miscellaneous Goods'),
            $this->makeInsertArray(8, 'Stuff Wanted'),
            $this->makeInsertArray(8, 'Swap Shop'),
            $this->makeInsertArray(9, 'Announcements'),
            $this->makeInsertArray(9, 'Car Pool-Bike Ride'),
            $this->makeInsertArray(9, 'Charity-Donate - NGO'),
            $this->makeInsertArray(9, 'Lost - Found'),
            $this->makeInsertArray(9, 'Tender Notices'),
        ]);
    }

    public function slugModify($slug) {
        return str_replace(array(' ', ',', '&'), array('-', '', 'and'), strtolower($slug));
    }

    public function makeInsertArray($id, $name) {
        return ['category_id' => $id, 'name' => $name, 'slug' => $this->slugModify($name), 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()];
    }

}
