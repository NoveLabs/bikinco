<?php

use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (Schema::hasTable('categories')) {
	    	$data = array(
                [
                    'id' => 1,
                    'name' => 'Kaos',
                    'status'  => 1,
                ],
            );

	    	\DB::table('categories')->delete();

	    	foreach($data as $item) {
	        	\DB::table('categories')->insert([
                    'id' => $item['id'],
                    'name' => $item['name'],
                    'status' => $item['status'],
	        	]);
	    	}
        }
    }
}
