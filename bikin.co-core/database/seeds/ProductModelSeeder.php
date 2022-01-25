<?php

use Illuminate\Database\Seeder;

class ProductModelSeeder extends Seeder
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
            'name' => 'Kain',
            'price' => 50000,
            'product_id' => 1,
            'variant_id' => 1,
            'subvariant_id' => 1,
            'file' => 'path/to/directory/image.jpg',
            'status' => 1,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
            'deleted_at' => null
        ];

        \Illuminate\Support\Facades\DB::table('models')->insert($content);
    }
}
