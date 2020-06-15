<?php

use Illuminate\Database\Seeder;

class ItemTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Model\Item::create([
            'name'=>'Paracetamol',
            'qty'=>10,
            'price'=>200,
            'category_id'=>1,
            'expire_date'=>\Carbon\Carbon::today(),
            'branch_id'=>1,
        ]);
        \App\Model\Item::create([
            'name'=>'Biogesic',
            'qty'=>10,
            'price'=>300,
            'expire_date'=>\Carbon\Carbon::today(),
            'category_id'=>2,
            'branch_id'=>1,
        ]);
        \App\Model\Item::create([
            'name'=>'Barmeton',
            'qty'=>10,
            'price'=>400,
            'category_id'=>3,
            'expire_date'=>\Carbon\Carbon::today(),
            'branch_id'=>1,
        ]);
        \App\Model\Item::create([
            'name'=>'Metro',
            'qty'=>5,
            'price'=>500,
            'expire_date'=>\Carbon\Carbon::today(),
            'category_id'=>4,
            'branch_id'=>1,
        ]);
    }
}
