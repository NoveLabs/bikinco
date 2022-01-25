<?php

Route::group(['middleware' => 'auth:vendor'], function(){
    //vendor
    Route::get('/vendor', 'VEController@index')->name('vendor');

    /*
    * Vendor Order Masuk
    */
    Route::get('/order_masuk/vendor', 'VendorOrderMasukController@index')->name('vendor.order_masuk.index');
    Route::get('/get_data_ordermasukvendor', 'VendorOrderMasukController@getDataOrderMasuk')->name('getdata.vendor_order_masuk');


    /*
    * Vendor Order Proses
    */

    Route::get('/order_proses/vendor', 'VendorOrderProsesController@index')->name('vendor.order_proses.index');
    Route::get('/getImagePembayaran/{id}', 'VendorOrderProsesController@getImagePembayaran')->name('getImagePembayaran');
    Route::get('/get/image/vendor/{id}', 'VendorOrderProsesController@getImagevendorDP')->name('getImageVendorDP');
    Route::get('/order_proses/vendor/{id}', 'VendorOrderProsesController@show')
    ->name('vendor.order_proses.progress');
    Route::post('/order_proses/vendor', 'VendorOrderProsesController@updateStep0')
    ->name('order_proses.vendor.step0');
    Route::post('/order_proses/vendor/upload/store', 'VendorOrderProsesController@storeUpload')
    ->name('order_proses.vendor.upload');
    Route::post('/order_proses/vendor/upload/delete/delete_images', 'VendorOrderProsesController@fileDestroy')
    ->name('order_proses.vendor.deleteUpload');
    Route::post('/catatan/order_proses/vendor', 'VendorOrderProsesController@updateStep2')
    ->name('order_proses.vendor.catatan');
    Route::get('/getLogImage/order_proses/vendor/{id}', 'VendorOrderProsesController@getLogImage')
    ->name('order_proses.vendor_image.all');
    Route::get('/getLogNote/order_proses/vendor/{id}', 'VendorOrderProsesController@getLogNote')
    ->name('order_proses.vendor_note.all');
    Route::get('/vendor/count/order/proses', 'VendorOrderProsesController@getDataOrderProsesVendor')->name('getdata.vendor_order_proses');

    /*
    * Vendor Order Pelunasan
    */
    Route::get('/order_pelunasan/vendor', 'VendorOrderPelunasanController@index')->name('vendor.order_pelunasan.index');
    Route::get('/getImagePelunasan/{id}', 'VendorOrderPelunasanController@getImagePelunasan')->name('getImagePelunasan');
    Route::get('/vendor/count/order/pelunasan', 'VendorOrderPelunasanController@getDataOrderPelunasanVendor')->name('getdata.vendor_order_pelunasan');

    /*
    * Vendor Order Selesai
    */
    Route::get('/order_selesai/vendor', 'VendorOrderSelesaiController@index')->name('vendor.order_selesai.index');
    Route::get('/vendor/count/order/selesai', 'VendorOrderSelesaiController@getDataSelesaiVendor')->name('getdata.vendor_order_selesai');
        /*
    * Route Komplain Vendor
    */

    Route::get('order/complain/vendor', 'KomplainVendorController@index')->name('complain_vendor.index');
    Route::get('/vendor/count/order/complain', 'KomplainVendorController@getDataComplain')->name('getdata.complain_vendor');
    Route::get('/vendor/complain/{id}', 'QCSelesaiProduksiController@getComplain')
    ->name('complainVendor.vendor');
        Route::post('/vendor/selesai/produksi/komplain/{id}', 'KomplainVendorController@updateKomplain')
    ->name('vendor.komplain');

    /*
    * Route Vendor Selesai produksi
    */
    Route::get('order/selesai/vendor/produksi', 'VendorSelesaiProduksiController@index')->name('vendor.selesai_produksi.index');
    Route::post('order/selesai/vendor/produksi/upload', 'VendorSelesaiProduksiController@create')->name('vendor_selesai_produksi.upload');
    Route::get('/order/selesai/vendor/image/{id}', 'VendorSelesaiProduksiController@getLogImage')
    ->name('vendor_selesai_produksi.all');
    Route::post('/order/selesai/vendor/image/delete_images', 'VendorSelesaiProduksiController@fileDestroy')
    ->name('vendor_selesai_produksi.vendor.deleteUpload');
    /*
    * Print Pdf Artwork
    */
    Route::get('/vendor/pd_upload/print/{id}', 'ProductDesignController@printPdf')->name('pd_upload.print.vendor');
    

});
