<?php

use Illuminate\Database\Seeder;

class VariantSeeder extends Seeder
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
            'name' => 'Acsessories',
            'product_id' => 1,
            'status' => 1,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
            'deleted_at' => null
        ];

        \Illuminate\Support\Facades\DB::table('variants')->insert($content);
    }
}
