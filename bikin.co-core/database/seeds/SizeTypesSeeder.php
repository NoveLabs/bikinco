<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class SizeTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (Schema::hasTable('size_types')) {
	    	$data = array(
                ['categories_id' => 1, 'name' => 'Pria Panjang',],
                ['categories_id' => 1, 'name' => 'Wanita Panjang',],
                ['categories_id' => 1, 'name' => 'Wanita Pendek',],
                ['categories_id' => 1, 'name' => 'Pria Pendek',],
            );

	    	DB::table('size_types')->delete();

	    	foreach($data as $item) {
	        	DB::table('size_types')->insert([
                    'categories_id' => $item['categories_id'],
                    'name' => $item['name'],
                    'created_at' => date('Y-m-d H:i:s'),
	        	]);
	    	}
        }
    }
}
