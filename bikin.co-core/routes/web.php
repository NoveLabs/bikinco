<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect(route('home'));
})->middleware('auth');


Auth::routes();

Route::get('/login', 'LoginController@index');
Route::post('/login', 'LoginController@Login')->name('login');
Route::get('/register', 'LoginController@register');
Route::post('/register', 'LoginController@Register');
Route::get('/logout', 'LoginController@logout')->name('logout');

Route::get('/vendor/login', 'LoginVendorController@index');
Route::post('/vendor/login', 'LoginVendorController@login')->name('login.vendor');
Route::get('/vendor/logout', 'LoginVendorController@logout')->name('logout.vendor');

Route::middleware(['auth'])->group(function () {

    //home
    Route::get('/home', 'HomeController@index')->name('home');
    //dashborard
    // Route::get('/dashboard', 'LoginController@dashboard')->name('home');
    //logout
    Route::get('/logout', 'LoginController@logout')->name('logout.user');
    //accounting
    Route::get('/accounting', 'ACController@index')->name('Accounting');
    //design product
    Route::get('/designProduct', 'DPController@index')->name('DesignProduct');
    //product developemnt
    Route::get('/productDevelopment', 'PDController@index')->name('ProductDevelpoment');
    //quality control
    Route::get('/qualityControl', 'QCController@index')->name('QualityControl');
    //sales officer
    Route::get('/salesOfficer', 'SOController@index')->name('SalesOfficer');



    //profile
    Route::get('/profile/read', 'ProfileController@profile')->name('profile');

    Route::get('/profile/setting', 'ProfileController@index')->name('profileSetting');
    Route::post('/profile/update/{id}', 'ProfileController@post')->name('updateProfile');
    Route::post('/profile/update/photo/{id}', 'ProfileController@updatePhoto')->name('updatePhotoProfile');
    Route::post('/profile/update/email/{id}', 'ProfileController@updateEmail')->name('updateEmail');

    //user management
    Route::get('/user/management', 'AdminManagementController@index')->name('userManagement');
    Route::post('/user/management/add', 'AdminManagementController@addUser')->name('userAdd');
    Route::post('/user/management/resetPassword', 'AdminManagementController@resetPassword')->name('userResetPassword');

    //update password
    Route::post('/password/reset/{id}', '\App\Http\Controllers\Auth\ResetPasswordController@update')->name('password.update');

    /*
     * Categories feature...
     */
    Route::get('/categories', 'CategoryController@index')->name('categories');
    Route::get('/categories/{id}', 'CategoryController@show')->name('categories.single');
    Route::post('/categories', 'CategoryController@create')->name('categories.add');
    Route::post('/categories/{id}', 'CategoryController@update')->name('categories.update');
    Route::delete('/categories', 'CategoryController@delete')->name('categories.delete');

    /*
     * Sub Categories feature...
     */
    Route::get('/sub-categories', 'SubCategoryController@index')->name('sub-categories');
    Route::get('/sub-categories/{id}', 'SubCategoryController@show')->name('sub-categories.single');
    Route::post('/sub-categories', 'SubCategoryController@create')->name('sub-categories.add');
    Route::post('/sub-categories/{id}', 'SubCategoryController@update')->name('sub-categories.update');
    Route::delete('/sub-categories', 'SubCategoryController@delete')->name('sub-categories.delete');

    /*
     * Products feature...
     */
    Route::get('/products', 'ProductController@index')->name('products');
    Route::get('/products/{id}', 'ProductController@show')->name('products.single');
    Route::get('/products-q-subcategories/{id}', 'ProductController@searchSubCategories')->name('products.qsubcategories');
    Route::post('/products', 'ProductController@create')->name('products.add');
    Route::post('/products/{id}', 'ProductController@update')->name('products.update');
    Route::delete('/products', 'ProductController@delete')->name('products.delete');

    /*
     * Product Materials feature...
     */
    Route::get('/product-materials', 'ProductMaterialController@index')->name('product-materials');
    Route::get('/product-materials/{id}', 'ProductMaterialController@show')->name('product-materials.single');
    Route::post('/product-materials', 'ProductMaterialController@create')->name('product-materials.add');
    Route::post('/product-materials/{id}', 'ProductMaterialController@update')->name('product-materials.update');
    Route::delete('/product-materials', 'ProductMaterialController@delete')->name('product-materials.delete');

    /*
     * Product Material Items feature...
     */
    Route::get('/product-material-items', 'ProductMaterialItemController@index')->name('product-material-items');
    Route::get('/product-material-items/{id}', 'ProductMaterialItemController@show')->name('product-material-items.single');
    Route::post('/product-material-items', 'ProductMaterialItemController@create')->name('product-material-items.add');
    Route::post('/product-material-items/{id}', 'ProductMaterialItemController@update')->name('product-material-items.update');
    Route::delete('/product-material-items', 'ProductMaterialItemController@delete')->name('product-material-items.delete');

    /*
     * Supplier feature...
     */
    Route::get('/suppliers', 'SupplierController@index')->name('suppliers');
    Route::get('/suppliers/{id}', 'SupplierController@show')->name('suppliers.single');
    Route::post('/suppliers', 'SupplierController@create')->name('suppliers.add');
    Route::post('/suppliers/{id}', 'SupplierController@update')->name('suppliers.update');
    Route::delete('/suppliers', 'SupplierController@delete')->name('suppliers.delete');

    /*
     * Supplier feature...
     */
    Route::get('/units', 'UnitController@index')->name('units');
    Route::get('/units/{id}', 'UnitController@show')->name('units.single');
    Route::post('/units', 'UnitController@create')->name('units.add');
    Route::post('/units/{id}', 'UnitController@update')->name('units.update');
    Route::delete('/units', 'UnitController@delete')->name('units.delete');

    /*
     * Material Specification feature...
     */
    Route::get('/specifications', 'MaterialSpecificationController@index')->name('specifications');
    Route::get('/specifications/{id}', 'MaterialSpecificationController@show')->name('specifications.single');
    Route::post('/specifications', 'MaterialSpecificationController@create')->name('specifications.add');
    Route::post('/specifications/{id}', 'MaterialSpecificationController@update')->name('specifications.update');
    Route::delete('/specifications', 'MaterialSpecificationController@delete')->name('specifications.delete');

    /*
     * Material Specification Item feature...
     */
    Route::get('/specification-items', 'MaterialSpecificationItemController@index')->name('specification-items');
    Route::get('/specification-items/get-material-items/{id}', 'MaterialSpecificationItemController@getMaterialItem');
    Route::get('/specification-items/{id}', 'MaterialSpecificationItemController@show')->name('specification-items.single');
    Route::post('/specification-items', 'MaterialSpecificationItemController@create')->name('specification-items.add');
    Route::post('/specification-items/{id}', 'MaterialSpecificationItemController@update')->name('specification-items.update');
    Route::delete('/specification-items', 'MaterialSpecificationItemController@delete')->name('specification-items.delete');

    /*
     * Product Material Stock feature...
     */
    Route::get('/material-stocks', 'ProductMaterialStockController@index')->name('material-stocks');
    Route::get('/material-stocks/{id}', 'ProductMaterialStockController@show')->name('material-stocks.single');
    Route::get('/get-material-unit/{id}', 'ProductMaterialStockController@materialUnit')->name('material-stocks.get-unit');
    Route::post('/material-stocks', 'ProductMaterialStockController@create')->name('material-stocks.add');
    Route::post('/material-stocks/{id}', 'ProductMaterialStockController@update')->name('material-stocks.update');
    Route::delete('/material-stocks', 'ProductMaterialStockController@delete')->name('material-stocks.delete');

    /*
     * Product has Material Stock feature...
     */
    Route::get('/material-products/{productId}', 'ProductHasMaterialStockController@index')->name('material-products');
    Route::get('/material-products-s/{productId}/{id}', 'ProductHasMaterialStockController@show')->name('material-products.single');
    Route::post('/material-products', 'ProductHasMaterialStockController@create')->name('material-products.add');
    Route::post('/material-products/{id}', 'ProductHasMaterialStockController@update')->name('material-products.update');
    Route::delete('/material-products', 'ProductHasMaterialStockController@delete')->name('material-products.delete');

    /*
     * Product Specifications feature... ( Kategori Produk Addons )
     */
    Route::get('/product-addons-category', 'ProductSpecificationController@index')->name('product-addons-category');
    Route::get('/product-addons-category/{id}',
        'ProductSpecificationController@show')->name('product-addons-category.single');
    Route::post('/product-addons-category',
        'ProductSpecificationController@create')->name('product-addons-category.add');
    Route::post('/product-addons-category/{id}',
        'ProductSpecificationController@update')->name('product-addons-category.update');
    Route::delete('/product-addons-category',
        'ProductSpecificationController@delete')->name('product-addons-category.delete');


    /*
     * Product Specification Items feature...
     */
    Route::get('/product-spec-items', 'ProductSpecificationItemController@index')->name('product-spec-items');
    Route::get('/product-spec-items/{id}', 'ProductSpecificationItemController@show')->name('product-spec-items.single');
    Route::post('/product-spec-items', 'ProductSpecificationItemController@create')->name('product-spec-items.add');
    Route::post('/product-spec-items/{id}', 'ProductSpecificationItemController@update')->name('product-spec-items.update');
    Route::delete('/product-spec-items', 'ProductSpecificationItemController@delete')->name('product-spec-items.delete');

    /*
     * Customers feature...
     */
    Route::get('/customers', 'CustomerController@index')->name('customers');
    Route::get('/customers/{id}', 'CustomerController@show')->name('customers.single');
    Route::get('/customer/{id}', 'CustomerController@updateForm')->name('customers.update-form');
    Route::get('/customer-verification/{token}', 'CustomerController@verification')->name('customers.verification');
    Route::get('/customer-download/{id}', 'CustomerController@downloadImage')->name('customers.download');
    Route::post('/customers', 'CustomerController@create')->name('customers.add');
    Route::post('/customers/{id}', 'CustomerController@update')->name('customers.update');
    Route::delete('/customers', 'CustomerController@delete')->name('customers.delete');

    /*
     * Customer works features...
     */
    Route::get('/customer-works', 'CustomerWorkController@index')->name('customer-works');
    Route::get('/customer-works/{id}', 'CustomerWorkController@show')->name('customer-works.single');
    Route::post('/customer-works', 'CustomerWorkController@create')->name('customer-works.add');
    Route::post('/customer-works/{id}', 'CustomerWorkController@update')->name('customer-works.update');
    Route::delete('/customer-works', 'CustomerWorkController@delete')->name('customer-works.delete');

    /*
     * Provinces feature...
     */
    Route::get('/provinces', 'ProvinceController@index')->name('provinces');
    Route::get('/provinces/{id}', 'ProvinceController@show')->name('provinces.single');
    Route::post('/provinces', 'ProvinceController@create')->name('provinces.add');
    Route::post('/provinces/{id}', 'ProvinceController@update')->name('provinces.update');
    Route::delete('/provinces', 'ProvinceController@delete')->name('provinces.delete');

    /*
     * Cities feature...
     */
    Route::get('/cities', 'CitiesController@index')->name('cities');
    Route::get('/cities/{id}', 'CitiesController@show')->name('cities.single');
    Route::get('/cities-by-prov/{id}', 'CitiesController@indexByProvince')->name('cities.byprov');
    Route::post('/cities', 'CitiesController@create')->name('cities.add');
    Route::post('/cities/{id}', 'CitiesController@update')->name('cities.update');
    Route::delete('/cities', 'CitiesController@delete')->name('cities.delete');

    /*
     * Routes : Variants
     */
    Route::get('/variants', 'VariantController@index')->middleware('auth')
         ->name('variants');
    Route::get('/variants/{id}', 'VariantController@get_data')
         ->middleware('auth')->name('variants.get');
    Route::get('/variants/data/{id}', 'VariantController@get_single_data')
         ->middleware('auth')->name('variants.get.data');
    Route::post('/variants', 'VariantController@add')->middleware('auth')
         ->name('variants.add');
    Route::post('/variants/update/{id}', 'VariantController@update_data')
         ->middleware('auth')->name('variants.update');
    Route::post('/variants', 'VariantController@add')->middleware('auth')
         ->name('variants');
    Route::delete('/variants/delete/{id}', 'VariantController@delete')
         ->middleware('auth')->name('variants.delete');

    /*
     * Routes Set : Subvariants
     */

    // Routes : subvariants
    Route::get('/subvariants', 'SubvariantController@index')->middleware('auth')
         ->name('subvariants');
    Route::get('/subvariants/{id}', 'SubvariantController@get_data')
         ->middleware('auth')->name('subvariants.get');
    Route::get('/subvariants/data/{id}', 'SubvariantController@get_single_data')
         ->middleware('auth')->name('subvariants.get.data');
    Route::get('/subvariants/get-variant/{id}',
        'SubvariantController@get_variant_data')->middleware('auth')
         ->name('subvariants.get.variant');
    Route::post('/subvariants', 'SubvariantController@add')->middleware('auth')
         ->name('subvariants.add');
    Route::post('/subvariants/update/{id}', 'SubvariantController@update_data')
         ->middleware('auth')->name('subvariants.update');
    Route::post('/subvariants', 'SubvariantController@add')->middleware('auth')
         ->name('subvariants');
    Route::delete('/subvariants/delete/{id}', 'SubvariantController@delete')
         ->middleware('auth')->name('subvariants.delete');

    /*
     * Route Set : Models
     */
    Route::get('/models', 'ModelsController@index')->middleware('auth')
         ->name('models');
    Route::get('/models/{id}', 'ModelsController@get_data')->middleware('auth')
         ->name('models.get');
    Route::get('/models/data/{id}', 'ModelsController@get_single_data')
         ->middleware('auth')->name('models.get.data');
    Route::get('/models/get-variant/{id}', 'ModelsController@get_variant_data')
         ->middleware('auth')->name('models.get.variant');
    Route::get('/models/get-subvariant/{id}',
        'ModelsController@get_subvariant_data')->middleware('auth')
         ->name('models.get.variant');
    Route::post('/models', 'ModelsController@add')->middleware('auth')
         ->name('models.add');
    Route::post('/models/update/{id}', 'ModelsController@update_data')
         ->middleware('auth')->name('models.update');
    Route::post('/models', 'ModelsController@add')->middleware('auth')
         ->name('models');
    Route::delete('/models/delete/{id}', 'ModelsController@delete')
         ->middleware('auth')->name('models.delete');


    /*
     * Route Set : Sizepack
     */
    Route::get('/sizepacks', 'SizeController@index')->middleware('auth')
         ->name('sizepacks');
    Route::get('/sizepacks/image/{id}', 'SizeController@getImage')->middleware('auth')->name('sizepacks.getImage');
    Route::get('/sizepacks/{id}', 'SizeController@getSizepackItem')->middleware('auth')->name('sizepacks.get');
    Route::post('/sizepacks', 'SizeController@add')->middleware('auth')->name('sizepacks');
    Route::post('/sizepacks/update/{id}', 'SizeController@updateData')->middleware('auth')->name('sizepacks.update');
    Route::delete('/sizepacks/delete/{id}', 'SizeController@deleteData')->middleware('auth')->name('sizepacks.delete');


    Route::get('/new-order/{customerId}', 'CustomerController@index')->name('order.add-form');

    /*
     * Vendor feature...
     */
    Route::get('/vendors', 'VendorController@index')->name('vendors');
    Route::get('/vendors/{id}', 'VendorController@show')->name('vendors.single');
    Route::get('/vendor/{id}', 'VendorController@updateForm')->name('vendors.update-form');
    Route::post('/vendors', 'VendorController@create')->name('vendors.add');
    Route::post('/vendors/{id}', 'VendorController@update')->name('vendors.update');
    Route::delete('/vendors', 'VendorController@delete')->name('vendors.delete');

    /*
     * Artwork feature...
     */
    Route::get('/artworks', 'ArtworkController@index')->name('artworks');
    Route::get('/artworks/{id}', 'ArtworkController@show')->name('artworks.single');
    Route::post('/artworks', 'ArtworkController@create')->name('artworks.add');
    Route::post('/artworks/{id}', 'ArtworkController@update')->name('artworks.update');
    Route::delete('/artworks', 'ArtworkController@delete')->name('artworks.delete');

    /*
     * Artwork size feature...
     */
    Route::get('/artwork-size', 'ArtworkSizeController@index')->name('artwork-size');
    Route::get('/artwork-size/{id}', 'ArtworkSizeController@show')->name('artwork-size.single');
    Route::post('/artwork-size', 'ArtworkSizeController@create')->name('artwork-size.add');
    Route::post('/artwork-size/{id}', 'ArtworkSizeController@update')->name('artwork-size.update');
    Route::delete('/artwork-size', 'ArtworkSizeController@delete')->name('artwork-size.delete');


    /*
    Upload Pembayaran Feature..

    */

    Route::get('/order_payment', 'OrderPaymentController@index')->name('order_payment-index');
    Route::get('/order_payment/{id}', 'OrderPaymentController@show')->name('order_payment.single');
    Route::post('/order_payment', 'OrderPaymentController@create')->name('order_payment.add');
    Route::get('/order_payment/order_single/{id}', 'OrderPaymentController@showOrder')->name('order.single');
    Route::get('/get_data_by_konfirmasi', 'OrderPaymentController@getDataByKonfirmasi')->name('getdata.konfirmasi');
    Route::get('/invoice/print/{id}', 'SalesOfficerPrintableController@printInvoice')->name('print.invoice');

    /*
    Upload Pelunasan Feature..

    */

    Route::get('/order_pelunasan_payment', 'OrderPaymentPelunasanController@index')->name('order_pelunasan_payment-index');
    Route::get('/order_pelunasan_payment/{id}', 'OrderPaymentPelunasanController@show')->name('order_pelunasan_payment.single');
    Route::post('/order_pelunasan_payment', 'OrderPaymentPelunasanController@create')->name('order_pelunasan_payment.add');
    Route::get('/order_pelunasan_payment/order_single/{id}', 'OrderPaymentPelunasanController@showOrder')->name('order_pelunasan.single');
    Route::get('/get_data_by_pelunasan', 'OrderPaymentPelunasanController@getDataByKonfirmasiPelunasan')->name('getdata.pelunasan');
    Route::get('/invoice/print/pelunasan/{id}', 'OrderPaymentPelunasanController@printInvoice')->name('print.invoice.pelunasan');

        /*
    Verifikasi Accounting Feature..
    */
    Route::get('/accounting_verifikasi', 'AccountingVerifikasiController@index')->name('accounting_verifikasi-index');
    Route::get('/accounting_verifikasi/{id}', 'AccountingVerifikasiController@show')->name('accounting_verifikasi.single');
    Route::get('/accounting_verifikasi/log/{id}', 'AccountingVerifikasiController@showLog')->name('accounting_verifikasi_log.all');
    Route::post('/accounting_verifikasi', 'AccountingVerifikasiController@create')->name('accounting_verifikasi.add');
    Route::post('/accounting_verifikasi/tolak', 'AccountingVerifikasiController@tolak')->name('accounting_verifikasi.tolak');
    Route::get('/get_data_verifikasi', 'AccountingVerifikasiController@getDataVerifikasi')->name('getdata.verifikasi');


            /*
    Verifikasi Accounting Pelunasan Feature..
    */
    Route::get('/accounting_pelunasan', 'AccountingVerifikasiPelunasanController@index')->name('accounting_pelunasan-index');
    Route::get('/accounting_pelunasan/{id}', 'AccountingVerifikasiPelunasanController@show')->name('accounting_pelunasan.single');
    Route::post('/accounting_pelunasan', 'AccountingVerifikasiPelunasanController@create')->name('accounting_pelunasan.add');
    Route::post('/accounting_pelunasan/tolak', 'AccountingVerifikasiPelunasanController@tolak')->name('accounting_pelunasan.tolak');
    Route::get('/get_data_verifikasipelunasan', 'AccountingVerifikasiPelunasanController@getDataVerifikasiPelunasan')->name('getdata.verifikasipelunasan');




    /*
     *  Route - Printable - Sales Officer
     */
    Route::get('/salesofficer/pelunasan', 'PrintableController@repaymentPaid')
         ->name('so.repayment.paid');
    Route::get('/salesofficer/pelunasan-invoice',
        'PrintableController@repayment')->name('so.repayment');
    Route::get('/salesofficer/dp-invoice', 'PrintableController@downPayment')
         ->name('so.downPayment');
    Route::get('/salesofficer/quotation', 'PrintableController@quotation')
         ->name('so.quotation');
    Route::get('/salesofficer/shipmentreceipt',
        'PrintableController@shipmentReceipt')->name('so.shipmentreceipt');
    Route::get('/salesofficer/spkcustomer', 'PrintableController@customerSPK')
         ->name('so.spk.customer');
    Route::get('/salesofficer/spkvendor', 'PrintableController@vendorSPK')
         ->name('so.spk.vendor');

    // Export function
    Route::get('/salesofficer/pelunasan/export',
        'PrintableController@repaymentPaidExport')
         ->name('so.repayment.paid.export');
    Route::get('/salesofficer/pelunasan-invoice/export',
        'PrintableController@repaymentExport')->name('so.repayment.export');
    Route::get('/salesofficer/dp-invoice/export',
        'PrintableController@downPayment')->name('so.downPayment.export');
    Route::get('/salesofficer/quotation/export',
        'PrintableController@quotationExport')->name('so.quotation.export');
    Route::get('/salesofficer/shipmentreceipt/export',
        'PrintableController@shipmentReceiptExport')
         ->name('so.shipmentreceipt');
    Route::get('/salesofficer/spkcustomer/export',
        'PrintableController@customerSPKExport')
         ->name('so.spk.customer.export');
    Route::get('/salesofficer/spkvendor/export',
        'PrintableController@vendorSPKExport')->name('so.spk.vendor.export');

    /*
     *  Route - Printable - Vendor
     */
    Route::get('/vendor/print/order-invoice',
        'VendorPrintableController@orderInvoice')->name('vendor.order-invoice');
    Route::get('/vendor/print/order-paid',
        'VendorPrintableController@orderInvoicePaid')
         ->name('vendor.order-invoice.paid');
    Route::get('/vendor/print/spk', 'VendorPrintableController@vendorSPK')
         ->name('vendor.spk');
    Route::get('/vendor/print/billofmaterial',
        'VendorPrintableController@billOfMaterial')
         ->name('vendor.billofmaterial');
    Route::get('/vendor/print/deliveryorder',
        'VendorPrintableController@deliveryOrder')
         ->name('vendor.deliveryorder');
    Route::get('/vendor/print/qc-result', 'VendorPrintableController@qcResult')
         ->name('vendor.qc-result');


    /*
     *  Route - Printable Export - Vendor
     */
    Route::get('/vendor/print/order-invoice/export',
        'VendorPrintableController@orderInvoiceExport')
         ->name('vendor.order-invoice.export');
    Route::get('/vendor/print/order-paid/export',
        'VendorPrintableController@orderInvoicePaidExport')
         ->name('vendor.order-invoice.paid.export');
    Route::get('/vendor/print/spk/export',
        'VendorPrintableController@vendorSPKExport')->name('vendor.spk.export');
    Route::get('/vendor/print/billofmaterial/export',
        'VendorPrintableController@billOfMaterialExport')
         ->name('vendor.billofmaterial.export');
    Route::get('/vendor/print/deliveryorder/export',
        'VendorPrintableController@deliveryOrderExport')
         ->name('vendor.deliveryorder.export');
    Route::get('/vendor/print/qc-result/export',
        'VendorPrintableController@qcResultExport')
         ->name('vendor.qc-result.export');

    /*
     *  Route - Accounting
     */
    Route::get('/accounting/print/dp',
        'AccountingPrintableController@downPayment')->name('acc.dp');
    Route::get('/accounting/print/pelunasan',
        'AccountingPrintableController@repayment')->name('acc.repayment');

    /*
     *  Route - Accounting - Export
     */
    Route::get('/accounting/print/dp/export',
        'AccountingPrintableController@downPaymentExport')
         ->name('acc.dp.export');
    Route::get('/accounting/print/pelunasan/export',
        'AccountingPrintableController@repaymentExport')
         ->name('acc.repayment.export');

    /*
     *   Route Production Step Master
    */

    Route::get('/waiting/confirmation/customer', 'OrderCustomerConfirmationController@index')->name('cust_confirm.index');
    Route::post('/waiting_customer_confirmation/{id}', 'OrderCustomerConfirmationController@create')->name('cust_confirm.add');
    Route::get('/get/customer/confirmation', 'OrderCustomerConfirmationController@getDataWaitingCust')->name('cust_confirm.getData');


    Route::get('/product_step_master/{id}', 'ProductionStepMasterController@show')
    ->name('product_step_master.single');
    Route::get('/product_step_master/getData/{id}', 'ProductionStepMasterController@showSingle')
    ->name('product_step_master.show.single');
    Route::post('/product_step_master', 'ProductionStepMasterController@create')
    ->name('product_step_master.add');
    Route::post('/product_step_master/product_step_master/{id}', 'ProductionStepMasterController@edit')
    ->name('product_step_master.edit');
    Route::delete('/product_step_master', 'ProductionStepMasterController@destroy')
    ->name('product_step_master.delete');


    /*
    * Route Waiting Customer Confirmation
    */


    Route::get('/order_item_step', 'OrderItemStepController@index')
    ->name('order_item_step.index');
    Route::get('/order_item_step/{id}', 'OrderItemStepController@show')
    ->name('order_item_step.progress');
    Route::post('/order_item_step', 'OrderItemStepController@updateStep0')
    ->name('order_item_step.step0');
    Route::post('/order_item_step/updateStep1', 'OrderItemStepController@updateStep1')
    ->name('order_item_step.step1');
    Route::post('/order_item_step/upload/store', 'OrderItemStepController@storeUpload')
    ->name('order_item_step.upload');
    Route::post('/catatan/order_item_step', 'OrderItemStepController@updateStep2')
    ->name('order_item_step.catatan');
    Route::post('/complain/order_item_step', 'OrderItemStepController@updateStep3Complain')
    ->name('order_item_step.complain');
    Route::post('/selesai/order_item_step/{id}', 'OrderItemStepController@updateStep3')
    ->name('order_item_step.selesai');
    Route::get('/getLogImage/order_item_step/{id}', 'OrderItemStepController@getLogImage')
    ->name('order_item_step_image.all');
    Route::get('/getLogNote/order_item_step/{id}', 'OrderItemStepController@getLogNote')
    ->name('order_item_step_note.all');
    Route::post('/done/order_item_step/{id}', 'OrderItemStepController@completeStep')
    ->name('order_item_step.done');



        /*
    Verifikasi Artwork  Feature..

    */

    Route::get('/verifikasi_artwork', 'VerifikasiArtworkController@index')->name('verifikasi_artwork.index');
    Route::get('/verifikasi_artwork/{id}', 'VerifikasiArtworkController@show')->name('verifikasi_artwork.single');
    Route::post('/verifikasi_artwork/tolak', 'VerifikasiArtworkController@tolak')->name('verifikasi_artwork.tolak');
    Route::post('/verifikasi_artwork/terima', 'VerifikasiArtworkController@terima')->name('verifikasi_artwork.terima');
    Route::get('/order/count/verifikasi/artwork', 'VerifikasiArtworkController@getDataVerifikasiArtwork')->name('verifikasi_artwork.count');
            /*
    Upload Artowork Design Feature..

    */

    Route::get('/pd_upload', 'ProductDesignController@index')->name('pd_upload-index');
    Route::get('/pd_upload/{id}', 'ProductDesignController@show')->name('pd_upload.single');
    Route::post('/pd_upload/tolak', 'ProductDesignController@tolak')->name('pd_upload.tolak');
    Route::post('/pd_upload/kirimRevisi', 'ProductDesignController@kirimRevisi')->name('pd_upload.kirimRevisi');
    Route::post('/pd_upload/updateDesign', 'ProductDesignController@updateDesign')->name('pd_upload.updateDesign');
    Route::post('/pd_upload/updateArtwork', 'ProductDesignController@updateArtwork')->name('pd_upload.updateArtwork');
    Route::get('/pd_upload/print/{id}', 'ProductDesignController@printPdf')->name('pd_upload.print');
    Route::get('download_pd/{id}', 'ProductDesignController@getFile')->name('pd.getfile');


    /*
    * Route Step Master Card [Diproses]
    */

    Route::get('/order/item/step', 'OrderItemStepController@index')->name('order_item_step.index');
    Route::get('/order/item/step/{id}', 'OrderItemStepController@show')->name('order_item_step.progress');
    Route::get('/order/count/step', 'OrderItemStepController@getDataOrderItemStep')->name('order_item_step.count');

    Route::get('order', 'OrderFormControllerTwo@index')
         ->name('foc.form.index');
    Route::get('order/flush', 'OrderFormControllerTwo@flush')
         ->name('foc.form.flush');
    Route::post('order/step/1', 'OrderFormControllerTwo@stepOne')
         ->name('foc.save.1');
    Route::post('order/step/2', 'OrderFormControllerTwo@stepTwo')
         ->name('foc.save.2');
    Route::post('order/step/3', 'OrderFormControllerTwo@stepThree')
         ->name('foc.save.3');
    Route::post('order/step/4', 'OrderFormControllerTwo@stepFour')
         ->name('foc.save.4');
    Route::post('order/step/5', 'OrderFormControllerTwo@stepFive')
         ->name('foc.save.5');


    /*
     * FOC Data Sources
     */
    Route::get('source/data/customer/', 'SourceDataController@customerList')
         ->name('source.customer');
    Route::get('source/data/customer/{id}',
        'SourceDataController@customerDetail')->name('source.customerDetail');
    Route::get('source/data/subcategory/{id}',
        'SourceDataController@subcategoryList')->name('source.subcategoryList');
    Route::get('source/data/product/{id}', 'SourceDataController@productList')
         ->name('source.productList');
    Route::get('source/data/size/{id}', 'SourceDataController@sizeList')
         ->name('source.sizeList');
    Route::get('source/data/size-type/{id}',
        'SourceDataController@sizeTypeList')->name('source.sizeTypeList');
    Route::get('source/data/artwork-size/{id}',
        'SourceDataController@artworkSizeList')->name('source.artworkSizeList');
    Route::get('source/data/product-spec-items/{id}',
        'SourceDataController@productSpecList')->name('source.productSpecList');
    Route::get('source/data/product-spec-price/{id}',
        'SourceDataController@productSpecPriceList')
         ->name('source.productSpecPriceList');


    /*
    * Order dikirim
    */
    Route::get('/order_dikirim', 'OrderDikirimController@index')
    ->name('order_dikirim.index');
    Route::post('/done/order_dikirim/{id}', 'OrderDikirimController@updateDone')
    ->name('order_dikirim.done');
    Route::get('/nota/pelunasan/print/{id}', 'OrderDikirimController@printPelunasan')
    ->name('print.nota_pelunasan');
    Route::post('/order/dikirim/komplain', 'OrderDikirimController@addKomplain')
    ->name('order_dikirim.add_komplain');
    /*
    * Route komplain SO customer
    */
    Route::get('/order/complain/so', 'OrderDikirimController@indexKomplain')
    ->name('order_dikirim.indexKomplain');
    Route::get('/order/complain/so/{id}', 'OrderDikirimController@getComplain')
    ->name('complainSO.allData');


    /*
    * Route ready shipment
    */

    Route::get('/shipment', 'OrderShipmentController@index')->name('ready_shipment.index');
    Route::post('/shipment', 'OrderShipmentController@create')->name('ready_shipment.add');
    Route::get('/shipment/detail', 'OrderShipmentController@show')->name('ready_shipment.show');
    Route::get('/shipment/list/', 'OrderShipmentController@listQc')->name('ready_shipment.listQc');
    Route::get('/shipment/list/on-progress/', 'OrderShipmentOnProgressController@index')->name('qc.shipment.on-progress');
    Route::get('/shipment/list/on-progress/{id}', 'OrderShipmentOnProgressController@orderShipmentInfo')->name('qc.shipment.on-progress.detail');
    Route::post('/shipment/update/', 'OrderShipmentController@update')->name('ready_shipment.update');
    Route::post('/shipment/update/so', 'OrderShipmentController@updateSo')->name('ready_shipment.updateSO');
    Route::post('/shipment/update/qc/resi', 'OrderShipmentController@updateResi')->name('ready_shipment.updateResi');
    Route::post('/shipment/update/qc/order/transaksi', 'OrderShipmentController@updateTransaksi')->name('ready_shipment.updateTransaksi');
    Route::get('/cetak/resi/{id}', 'OrderShipmentController@cetakResi')->name('ready_shipment.cetakResi');
    Route::get('/order/count/shipment', 'OrderShipmentController@getDataShipment')->name('shipment.count');

    // Route::get('/order_item_step/{id}', 'OrderItemStepController@show')->name('order_item_step.progress');

    Route::get('/order_dikirim', 'OrderDikirimController@index')
    ->name('order_dikirim.index');
    Route::post('/done/order_dikirim/{id}', 'OrderDikirimController@updateDone')
    ->name('order_dikirim.done');
    Route::get('/order/count/kirim', 'OrderDikirimController@getDataKirim')->name('order_dikirim.count');


    /*
    * QC Selesai Produksi
    */

    Route::get('/order/selesai/produksi', 'QCSelesaiProduksiController@index')
    ->name('order_selesai_produksi.index');
    Route::post('/order/selesai/produksi/{id}', 'QCSelesaiProduksiController@updateSesuai')
    ->name('order_selesai_produksi.done');
    Route::post('/order/selesai/produksi/komplain/{id}', 'QCSelesaiProduksiController@updateKomplain')
    ->name('order_selesai_produksi.komplain');
    Route::get('/order/selesai/produksi/image/{id}', 'VendorSelesaiProduksiController@getLogImage')
    ->name('order_selesai_produksi.allImage');
    /*
    * Route Complain Selesai Produksi
    */

    Route::get('qc_complain', 'QCSelesaiProduksiController@complainIndex')->name('qc.complain');
    Route::get('/qc/complain/{id}', 'QCSelesaiProduksiController@getComplain')
    ->name('complainVendor.allData');
    /*
    * Route Riwayat All Record
    */

    Route::get('/order/allrecord', 'OrderAllRecordController@index')
    ->name('order_allrecord.index');
    /*
    * Order Selesai Sampai ditempat
    */

    Route::get('order/selesai/arrived', 'OrderSelesaiController@index')
    ->name('order_selesai_arrived.index');

    /*
    * Route get Status Order
    */

    Route::get('order/get/statusorder/{id}', 'OrderPaymentController@getStatusOrder')
    ->name('track_order.getStatus');
    Route::get('order/get/all/statusorder/{id}', 'OrderPaymentController@getAllStatusOrder')
    ->name('track_order.getStatusAll');
    Route::get('order/get/order/materials/{id}', 'OrderPaymentController@getOrderMaterials')
    ->name('track_order.getOrderMaterials');
    Route::get('order/get/order/adjust/price/{id}', 'OrderPaymentController@getAdjustPrice')
    ->name('track_order.getAdjustPrice');
    Route::get('order/get/order/item/size/{id}', 'OrderPaymentController@getItemSize')
    ->name('track_order.getItemSize');
    Route::get('order/get/order/info/detail/{id}', 'OrderPaymentController@getInfoDetail')
    ->name('track_order.getInfoDetail');
    Route::get('order/get/order/cust/design/{id}', 'OrderPaymentController@getDesign')
    ->name('track_order.getDesign');
    Route::get('order/get/order/artwork/{id}', 'OrderPaymentController@getArtwork')
    ->name('track_order.getArtwork');
    Route::get('order/get/order/design/reference/{id}', 'OrderPaymentController@getDesignReference')
    ->name('track_order.getDesignReference');
    Route::get('order/get/order/material/{id}', 'OrderPaymentController@getMaterial')
    ->name('track_order.getMaterial');

     /*
    * Metode cetak atwork
    */

    Route::get('/atwork/metode/cetak', 'AtworkPrintMethodController@index')->name('printMethod.index');
    Route::post('/atwork/print/method', 'AtworkPrintMethodController@create')->name('printMethod.add');
    Route::get('/atwork/print/method/detail/{id}', 'AtworkPrintMethodController@show')->name('printMethod.show');
    Route::get('/atwork/print/method/list', 'AtworkPrintMethodController@listQc')->name('printMethod.listQc');
    Route::post('/atwork/print/method/update/{id}', 'AtworkPrintMethodController@update')->name('printMethod.update');
    Route::delete('/atwork/print/method/update', 'AtworkPrintMethodController@delete')->name('printMethod.delete');

    /*
     * Material Cetak
    */
    Route::get('/atwork/material/cetak', 'AtworkPrintTypeController@index')->name('materialPrint.index');
    Route::post('/atwork/material/cetak', 'AtworkPrintTypeController@create')->name('materialPrint.add');
    Route::get('/atwork/material/cetak/detail/{id}', 'AtworkPrintTypeController@show')->name('materialPrint.show');


    /*
    * Upload Image Vendor
    */

    Route::get('vendor/upload/image', 'UploadImageVendorController@index')->name('upload_img_vendor.index');
    Route::get('vendor/upload/pelunasan', 'UploadImageVendorController@indexPelunasan')->name('upload_img_vendor.indexPelunasan');
    Route::post('vendor/upload/image/add', 'UploadImageVendorController@create')->name('upload_img_vendor.add');
    Route::post('vendor/upload/pelunasan/repaid', 'UploadImageVendorController@createPelunasan')->name('upload_img_vendor.addPelunasan');

    /*
    * Superadmin
    */

    //banner
    Route::get('banner', 'SuperadminController@banner')->name('banner.index');
    Route::post('banner/superadmin/add', 'SuperadminController@addBanner')->name('banner.add');
    Route::post('banner/superadmin/update/{id}', 'SuperadminController@updateBanner')->name('banner.update');
    Route::get('banner/superadmin/{id}', 'SuperadminController@showBanner')->name('banner.detail');
    Route::delete('banner/superadmin', 'SuperadminController@deleteBanner')->name('banner.delete');
    
    //company
    Route::get('company', 'SuperadminController@company')->name('company.index');
    Route::get('company/superadmin/all', 'SuperadminController@companyAllData')->name('company.allData');
    Route::post('company/superadmin/add', 'SuperadminController@addCompany')->name('company.add');
    Route::post('company/superadmin/update/{id}', 'SuperadminController@updateCompany')->name('company.update');
    Route::get('company/superadmin/{id}', 'SuperadminController@showCompany')->name('company.detail');
    Route::delete('company/superadmin', 'SuperadminController@deleteCompany')->name('company.delete');

    // testimoni
    Route::get('testimoni', 'SuperadminController@testimoni')->name('testimoni.index');
    Route::post('testimoni/superadmin/add', 'SuperadminController@addTestimoni')->name('testimoni.add');
    Route::post('testimoni/superadmin/update/{id}', 'SuperadminController@updateTestimoni')->name('testimoni.update');
    Route::get('testimoni/superadmin/{id}', 'SuperadminController@showTestimoni')->name('testimoni.detail');
    Route::delete('testimoni/superadmin', 'SuperadminController@deleteTestimoni')->name('testimoni.delete');
    Route::get('testimoni/edit/{id}', 'SuperadminController@indexEdit')->name('edit.testimoni');

    //blog
    Route::get('blog', 'BlogController@index')->name('blog.index');
    Route::post('blog/superadmin/add', 'BlogController@addBlog')->name('blog.add');
    Route::post('blog/superadmin/update/{id}', 'BlogController@updateBlog')->name('blog.update');
    Route::get('blog/superadmin/{id}', 'BlogController@showBlog')->name('blog.detail');
    Route::delete('blog/superadmin', 'BlogController@deleteBlog')->name('blog.delete');

    //promo
    Route::get('promo', 'PromoController@index')->name('promo.index');
    Route::post('promo/superadmin/add', 'PromoController@addPromo')->name('promo.add');
    Route::post('promo/superadmin/update/{id}', 'PromoController@updatePromo')->name('promo.update');
    Route::get('promo/superadmin/{id}', 'PromoController@showPromo')->name('promo.detail');
    Route::delete('promo/superadmin', 'PromoController@deletePromo')->name('promo.delete');

    //Category Blog
    Route::get('categoryblog', 'CategoryBlogController@index')->name('categoryblog.index');
    Route::get('categoryblog/all', 'CategoryBlogController@getDataAll')->name('categoryblog.all');
    Route::post('categoryblog/superadmin/add', 'CategoryBlogController@add')->name('categoryblog.add');
    Route::post('categoryblog/superadmin/update/{id}', 'CategoryBlogController@update')->name('categoryblog.update');
    Route::get('categoryblog/superadmin/{id}', 'CategoryBlogController@show')->name('categoryblog.detail');
    Route::delete('categoryblog/superadmin', 'CategoryBlogController@delete')->name('categoryblog.delete');

});

include 'vendor.php';
include 'printable.php';

