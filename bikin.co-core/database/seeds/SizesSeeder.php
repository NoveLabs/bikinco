<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class SizesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (Schema::hasTable('sizes')) {
	    	$data = array(
                ['categories_id' => 1, 'name' => 'XS', 'is_extra_price' => 0, 'extra_price' => 0,],
                ['categories_id' => 1, 'name' => 'S', 'is_extra_price' => 0, 'extra_price' => 0,],
                ['categories_id' => 1, 'name' => 'M', 'is_extra_price' => 0, 'extra_price' => 0,],
                ['categories_id' => 1, 'name' => 'L', 'is_extra_price' => 0, 'extra_price' => 0,],
                ['categories_id' => 1, 'name' => 'XL', 'is_extra_price' => 0, 'extra_price' => 0,],
                ['categories_id' => 1, 'name' => 'XXL', 'is_extra_price' => 0, 'extra_price' => 0,],
                ['categories_id' => 1, 'name' => 'XXXL', 'is_extra_price' => 1, 'extra_price' => 2000,],
            );

	    	DB::table('sizes')->delete();

	    	foreach($data as $item) {
	        	DB::table('sizes')->insert([
                    'categories_id' => $item['categories_id'],
                    'name' => $item['name'],
                    'is_extra_price' => $item['is_extra_price'],
                    'extra_price' => $item['extra_price'],
                    'created_at' => date('Y-m-d H:i:s'),
	        	]);
	    	}
        }
    }
}
