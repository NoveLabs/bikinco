<?php

use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $content = [
            'name' => 'Kaos O-Neck',
            'price' => 50000,
            'sub_categories_id' => 1,
            'status' => 1,
            'file_name' => 'path/to/directory/image.jpg',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
            'deleted_at' => null
        ];

        \Illuminate\Support\Facades\DB::table('products')->insert($content);
    }
}
