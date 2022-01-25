<?php

use Illuminate\Database\Seeder;

class OrderLogMastersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (Schema::hasTable('order_log_masters')) {
	    	$log = array(
                [
                    'id'   => 1,
                    'flow_step_id' => '0',
                    'current_description' => 'Menunggu Konfirmasi Pelanggan.',
                    'next_description'  => '',
                    'title' => 'Order Dibuat',
                ],
                [
                    'id'   => 2,
                     'flow_step_id' => '1',
                    'current_description' => 'Menunggu Down Payment.',
                    'next_description'  => 'Detail pesanan telah dikonfirmasi pelanggan.',
                    'title' => 'Dikonfirmasi Pelanggan',
                ],
                [
                    'id'   => 3,
                    'flow_step_id' => '2',
                    'current_description' => 'Menunggu verifikasi Artwork.',
                    'next_description'  => 'Down Payment telah terverifikasi.',
                    'title' => 'Uang Muka Dibayarkan.',
                ],
                [
                    'id'   => 4,
                    'flow_step_id' => '3',
                    'current_description' => 'Order segera diproses Vendor.',
                    'next_description'  => 'Artwork telah diverifikasi pelanggan.',
                    'title' => 'Artwork Diverifikasi.',
                ],
                [
                    'id'   => 5,
                  'flow_step_id' => '4',
                    'current_description' => 'Menunggu selesai diproses.',
                    'next_description'  => 'Pesanan sedang diproses vendor.',
                    'title' => 'Diproses Vendor',
                ],
                [
                    'id'   => 6,
                   'flow_step_id' => '5',
                    'current_description' => 'Menunggu pelunasan pelanggan.',
                    'next_description'  => 'Pesanan selesai diproses Vendor.',
                    'title' => 'Produksi Selesai.',
                ],
                [
                    'id'   => 7,
                   'flow_step_id' => '6',
                    'current_description' => 'Produksi telah Selesai.',
                    'next_description'  => 'Menunggu QC kirim barang.',
                    'title' => 'Siap Dikirim.',
                ],
                [
                    'id'   => 8,
                   'flow_step_id' => '7',
                    'current_description' => 'Menunggu verifikasi pelunasan pelanggan.',
                    'next_description'  => 'Pelunasan dibayar pelanggan.',
                    'title' => 'Pelunasan.',
                ],
                [
                    'id'   => 9,
                   'flow_step_id' => '8',
                    'current_description' => 'Menunggu Konfirmasi Pelanggan.',
                    'next_description'  => '',
                    'title' => 'Pelunasan dibayar.',
                ],
                [
                    'id'   => 10,
                   'flow_step_id' => '9',
                    'current_description' => 'Order dalam pengiriman kepada pelanggan.',
                    'next_description'  => 'Bukti pelunasan telah dikonfirmasi.',
                    'title' => 'Pengiriman.',
                ],
                [
                    'id'   => 11,
                   'flow_step_id' => '10',
                    'current_description' => 'Menunggu status order.',
                    'next_description'  => 'Order telah sampai tujuan.',
                    'title' => 'Order Sampai Tujuan.',
                ],
                [
                    'id'   => 12,
                   'flow_step_id' => '11',
                    'current_description' => 'Order telah selesai.',
                    'next_description'  => 'rder telah sampai tujuan.',
                    'title' => 'Selesai',
                ],
                [
                    'id'   => 13,
                   'flow_step_id' => '12',
                    'current_description' => 'Order Dalam Komplain',
                    'next_description'  => '',
                    'title' => 'Dalam Komplain.',
                ],               
                [
                    'id'   => 14,
                   'flow_step_id' => '13',
                    'current_description' => 'Order Dibatalkan.',
                    'next_description'  => '',
                    'title' => 'Dibatalkan',
                ]
            );

	    	#truncate all row
	    	\DB::table('order_log_masters')->delete();
	    	foreach($log as $logs){
		    	#crete default data for sistem
		    	$cekDefaultUser = \DB::table('order_log_masters')->where('flow_step_id', $logs['flow_step_id'])->first();
	        	\DB::table('order_log_masters')->insert([
                    'id'    => $logs['id'],
                    'flow_step_id' => $logs['flow_step_id'],
                    'current_description' => $logs['current_description'],
                    'next_description'  => $logs['next_description'],
                    'title' => $logs['title'],
	        	]);
	    	}
    }
}
}
