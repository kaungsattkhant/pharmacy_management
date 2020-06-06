<?php

use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category=['Analgesics','Bronchodilator','Microntrients','Mutagens','Sympathomimetics'];
        foreach($category as $cate){
            \App\Model\Category::create([
                'name'=>$cate,
            ]);
        }

    }
}
