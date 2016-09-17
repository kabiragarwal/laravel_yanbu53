<?php

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Role::class)->create();
        //DB::table('roles')->insert([['name'=>'Admin'], ['name'=>'Editor']]);
    }
}
