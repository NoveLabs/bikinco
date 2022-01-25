<?php

use Illuminate\Database\Seeder;

class SizepackSeeder extends Seeder
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
            'vendor_name' => 'Vendor One',
            'size_code' => 'VDR-One-112',
            'status' => 1,
            'file' => 'path/to/directory/image.png',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
            'deleted_at' => null,
        ];
        
        \Illuminate\Support\Facades\DB::table('sizepacks')->insert($content);
    }
}
