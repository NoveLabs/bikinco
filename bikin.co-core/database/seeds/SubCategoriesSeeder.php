<?php

use Illuminate\Database\Seeder;

class SubCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (Schema::hasTable('sub_categories')) {
	    	$data = array(
                [
                    'id' => 1,
                    'categories_id' => 1,
                    'name' => 'Kaos Oblong',
                    'status' => 1,
                ],
            );

	    	\DB::table('sub_categories')->delete();

	    	foreach($data as $item){
	        	\DB::table('sub_categories')->insert([
                    'id' => $item['id'],
                    'categories_id' => $item['categories_id'],
                    'name' => $item['name'],
                    'status' => $item['status'],
	        	]);
	    	}
        }
    }
}
