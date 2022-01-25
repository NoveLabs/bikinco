<?php

use Illuminate\Database\Seeder;

class SubvariantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $content = [
            'name' => 'Jenis Kain',
            'product_id' => 1,
            'variant_id' => 1,
            'status' => 1,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
            'deleted_at' => null
        ];

        \Illuminate\Support\Facades\DB::table('subvariants')->insert($content);
    }
}
