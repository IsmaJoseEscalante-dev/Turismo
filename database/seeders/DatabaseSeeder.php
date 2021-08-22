<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $role = new Role();
        $role->name = 'admin';
        $role->description = 'Administrator';
        $role->save();

        $role = new Role();
        $role->name = 'user';
        $role->description = 'User';
        $role->save();

        User::factory(1)->create(['name'=>'Administrator', 'email'=> 'admin@admin.com']);
        $user = User::first();
        $user->roles()->attach(Role::where('name', 'admin')->first());
    }
}
