<?php

use Illuminate\Database\Seeder;

class StaffTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Model\Staff::create([
            'name'=>'Admin',
            'email'=>'ad@gmail.com',
            'password'=>bcrypt('pass'),
            'role_id'=>1,
            'branch_id'=>null,
        ]);
        \App\Model\Staff::create([
            'name'=>'FrontMan',
            'email'=>'fm@gmail.com',
            'password'=>bcrypt('pass'),
            'role_id'=>3,
            'branch_id'=>1,
        ]);
    }
}
