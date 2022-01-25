<?php

Route::get('sales-officer/printable/quotation/{id}',
    'SalesOfficerPrintableController@quotation')->name('so.printable.quotation');
Route::get('sales-officer/printable/spk/customer/{id}',
    'SalesOfficerPrintableController@spkCustomer')->name('so.printable.spk.customer');
Route::get('sales-officer/printable/spk/vendor/{id}',
    'SalesOfficerPrintableController@spkVendor')->name('so.printable.spk.vendor');
Route::get('sales-officer/printable/invoice/downpayment/{id}',
    'SalesOfficerPrintableController@downPaymentInvoice')->name('so.printable.inv.dp');
Route::get('sales-officer/printable/invoice/downpayment/paid/{id}',
    'SalesOfficerPrintableController@downPaymentInvoicePaid')->name('so.printable.inv.dp.paid');
Route::get('sales-officer/printable/invoice/repayment/{id}',
    'SalesOfficerPrintableController@repaymentInvoice')->name('so.printable.inv.repayment');
Route::get('sales-officer/printable/invoice/repayment/paid/{id}',
    'SalesOfficerPrintableController@repaymentInvoicePaid')->name('so.printable.inv.repayment.paid');

# Quality Control - All Printables
Route::get('quality-control/printable/shipment-receipt/{id}',
    'QualityControlPrintableController@shipmentReceipt')->name('qc.printable.shipment-receipt');

# Vendors - All Printables
Route::get('vendor/printable/bill-of-material/{id}',
    'VendorDocsPrintableController@billOfMaterial')->name('vendor.printable.billOfMaterial');
