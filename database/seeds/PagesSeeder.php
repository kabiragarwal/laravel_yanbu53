<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class PagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pages')->insert([
            $this->makeInsertArray('About Us'),
            $this->makeInsertArray('Terms and Conditions'),
            $this->makeInsertArray('Privacy Policy'),
            $this->makeInsertArray('FAQ')
        ]);
    }

    public function slugModify($slug) {
        return str_replace(array(' ', ',', '&'), array('-', '', 'and'), strtolower($slug));
    }

    public function makeInsertArray($name) {
        return ['title' => $name, 'slug' => $this->slugModify($name), 'content' => $this->content(), 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()];
    }

    public function content() {
        return $Data = "<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam consectetur sit amet ante nec vulputate. Nulla aliquam, justo auctor consequat tincidunt, arcu erat mattis lorem, lacinia lacinia dui enim at eros. Pellentesque ut gravida augue. Duis ac dictum tellus</p>

                        <p>Pellentesque in mauris placerat, porttitor lorem id, ornare nisl. Pellentesque rhoncus convallis felis, in egestas libero. Donec et nibh dapibus, sodales nisi quis, fringilla augue. Donec dui quam, egestas in varius ut, tincidunt quis ipsum. Nulla nec odio eu nisi imperdiet dictum.</p>

                        <p>Curabitur sed leo dictum, convallis lorem eu, suscipit mi. Mauris viverra blandit varius. Proin non sem turpis. Etiam fringilla hendrerit nunc at accumsan. Duis mollis auctor lobortis.</p>

                        <p>Etiam elementum nulla non erat blandit, sed porttitor urna malesuada. Cras euismod a nulla sed ornare. Vestibulum id molestie nulla. Phasellus sodales, sapien vitae auctor rhoncus</p>";
    }
}
