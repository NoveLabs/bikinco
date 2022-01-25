@extends('layouts.app')

@section('content')
<div id="sc-page-wrapper">
	<div id="sc-page-content">
        <div class="uk-child-width-1-4@xl uk-child-width-1-2@s" data-uk-grid>
            <div>
                <div class="uk-card">
                    <a href="sales-officer-customer-account-management.html" class="uk-card-body sc-padding sc-padding-medium-ends uk-flex uk-flex-middle">
                        <div class="uk-flex-1">
                            <h3 class="uk-card-title">Customer Account Management</h3>
                            <p class="sc-color-secondary uk-margin-remove uk-text-medium">Manajemen Akun Pelanggan</p>
                        </div>
                        <div class="md-bg-amber-600 uk-flex uk-flex-middle sc-padding-medium sc-padding-small-ends sc-round">
                            <i class="mdi mdi-account-check md-color-white"></i>
                        </div>
                    </a>
                </div>
            </div>
            <div>
                <div class="uk-card">
                    <a href="sales-officer-complain.html" class="uk-card-body sc-padding sc-padding-medium-ends uk-flex uk-flex-middle">
                        <div class="uk-flex-1">
                            <h3 class="uk-card-title">Board of Customer Complains</h3>
                            <p class="sc-color-secondary uk-margin-remove uk-text-medium">Manajemen Data Komplain Pelanggan</p>
                        </div>
                        <div class="md-bg-blue-600 uk-flex uk-flex-middle sc-padding-medium sc-padding-small-ends sc-round">
                            <i class="mdi mdi-alert-decagram md-color-white"></i>
                            <span class="uk-badge md-bg-red-600 uk-position-absolute uk-position-top-right uk-margin-small-top uk-margin-small-right">24 WAITING CONFIRM</span>
                        </div>
                    </a>
                </div>
            </div>
            <div>
                <div class="uk-card">
                    <a href="sales-officer-foc-product.html" class="uk-card-body sc-padding sc-padding-medium-ends uk-flex uk-flex-middle">
                        <div class="uk-flex-1">
                            <h3 class="uk-card-title">FOC and Quotation of Product</h3>
                            <p class="sc-color-secondary uk-margin-remove uk-text-medium">Manajemen FOC & Quotation Produk</p>
                        </div>
                        <div class="md-bg-green-600 uk-flex uk-flex-middle sc-padding-medium sc-padding-small-ends sc-round">
                            <i class="mdi mdi-book-open-outline md-color-white"></i>
                        </div>
                    </a>
                </div>
            </div>
            <div>
                <div class="uk-card">
                    <a href="sales-officer-foc-design.html" class="uk-card-body sc-padding sc-padding-medium-ends uk-flex uk-flex-middle">
                        <div class="uk-flex-1">
                            <h3 class="uk-card-title">FOC and Quotation of Design</h3>
                            <p class="sc-color-secondary uk-margin-remove uk-text-medium">Manajemen FOC & Quotation Desain</p>
                        </div>
                        <div class="md-bg-yellow-600 uk-flex uk-flex-middle sc-padding-medium sc-padding-small-ends sc-round">
                            <i class="mdi mdi-book-open md-color-white"></i>
                        </div>
                    </a>
                </div>
            </div>
            <div>
                <div class="uk-card">
                    <a href="sales-officer-payment.html" class="uk-card-body sc-padding sc-padding-medium-ends uk-flex uk-flex-middle">
                        <div class="uk-flex-1">
                            <h3 class="uk-card-title">Payment Data</h3>
                            <p class="sc-color-secondary uk-margin-remove uk-text-medium">Data Pembayaran</p>
                        </div>
                        <div class="md-bg-deep-purple-600 uk-flex uk-flex-middle sc-padding-medium sc-padding-small-ends sc-round">
                            <i class="mdi mdi-barcode-scan md-color-white"></i>
                            <span class="uk-badge md-bg-red-600 uk-position-absolute uk-position-top-right uk-margin-small-top uk-margin-small-right">24 Declined</span>
                        </div>
                    </a>
                </div>
            </div>
            <div>
                <div class="uk-card">
                    <a href="sales-officer-paid-confirm.html" class="uk-card-body sc-padding sc-padding-medium-ends uk-flex uk-flex-middle">
                        <div class="uk-flex-1">
                            <h3 class="uk-card-title">Paid Confirmation</h3>
                            <p class="sc-color-secondary uk-margin-remove uk-text-medium">Menu Konfirmasi Pelunasan</p>
                        </div>
                        <div class="md-bg-indigo-200 uk-flex uk-flex-middle sc-padding-medium sc-padding-small-ends sc-round">
                            <i class="mdi mdi-cash-multiple md-color-white"></i>
                            <span class="uk-badge md-bg-red-600 uk-position-absolute uk-position-top-right uk-margin-small-top uk-margin-small-right">24 DECLINED</span>
                        </div>
                    </a>
                </div>
            </div>
            <div>
                <div class="uk-card">
                    <a href="sales-officer-spk-product.html" class="uk-card-body sc-padding sc-padding-medium-ends uk-flex uk-flex-middle">
                        <div class="uk-flex-1">
                            <h3 class="uk-card-title">SPK of Product Management</h3>
                            <p class="sc-color-secondary uk-margin-remove uk-text-medium">Konfirmasi dan Catatan Revisi SPK Produk</p>
                        </div>
                        <div class="md-bg-indigo-900 uk-flex uk-flex-middle sc-padding-medium sc-padding-small-ends sc-round">
                            <i class="mdi mdi-webpack md-color-white"></i>
                        </div>
                    </a>
                </div>
            </div>
            <div>
                <div class="uk-card">
                    <a href="sales-officer-spk-design.html" class="uk-card-body sc-padding sc-padding-medium-ends uk-flex uk-flex-middle">
                        <div class="uk-flex-1">
                            <h3 class="uk-card-title">SPK of Design Management</h3>
                            <p class="sc-color-secondary uk-margin-remove uk-text-medium">Konfirmasi dan Catatan Revisi SPK Desain</p>
                        </div>
                        <div class="md-bg-cyan-900 uk-flex uk-flex-middle sc-padding-medium sc-padding-small-ends sc-round">
                            <i class="mdi mdi-brush md-color-white"></i>
                        </div>
                    </a>
                </div>
            </div>
            <div>
                <div class="uk-card">
                    <a href="sales-officer-cust-acceptance.html" class="uk-card-body sc-padding sc-padding-medium-ends uk-flex uk-flex-middle">
                        <div class="uk-flex-1">
                            <h3 class="uk-card-title">Customer Acceptance Confirmation</h3>
                            <p class="sc-color-secondary uk-margin-remove uk-text-medium">Form Konfirmasi Penerimaan</p>
                        </div>
                        <div class="md-bg-orange-900 uk-flex uk-flex-middle sc-padding-medium sc-padding-small-ends sc-round">
                            <i class="mdi mdi-basket-fill md-color-white"></i>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        
        
        
	</div>
</div>
@endsection

    
@push('scripts')
<script>
    $(document).ready(function () {
        $('#so').addClass("sc-page-active");
    });
</script>
@endpush