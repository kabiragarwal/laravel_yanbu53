<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\User;
use Carbon\Carbon;

class AdminSeerder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // factory(App\User::class)->create(['email'=>'Admin1@yanbu.com','first_name'=>'Admin'])->each(function($user) {
        //     $user->images()->save(factory(App\ProductImage::class)->make());
        // });
        factory(App\User::class)->create(['email'=>'Admin@yanbu.com','first_name'=>'Admin']);

        $user = User::whereEmail('Admin@yanbu.com')->first();
        $role = Role::whereName('Admin')->first();
        DB::table('role_user')->insert(['role_id'=>$role->id, 'user_id'=>$user->id, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
    }
}
