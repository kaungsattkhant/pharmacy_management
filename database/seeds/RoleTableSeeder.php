<?php

use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Model\Role::create([
            'name'=>'Admin',
        ]);
        \App\Model\Role::create([
            'name'=>'Manager',
        ]);
        \App\Model\Role::create([
            'name'=>'FrontMan',
        ]);
    }
}
