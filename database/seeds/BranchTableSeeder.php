<?php

use Illuminate\Database\Seeder;

class BranchTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Model\Branch::create([
            'name'=>'Chan Aye Branch',
            'address'=>'Mandalay,Chan Aye Thar Zan',
            'phone_number'=>'09939338328',
        ]);
        \App\Model\Branch::create([
            'name'=>'Mahar Aung Myay Branch',
            'address'=>'Mandalay,Mahar Aung Myay',
            'phone_number'=>'09976363',
        ]);
        \App\Model\Branch::create([
            'name'=>'Sat Mu Branch',
            'address'=>'Mandalay,Pyi Gyi Ta Gon',
            'phone_number'=>'09453236263',
        ]);
    }
}
