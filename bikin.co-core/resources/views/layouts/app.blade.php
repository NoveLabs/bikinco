<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width,initial-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Bikin.co - General Menu</title>
    <meta name="description" content="Scutum Admin Template" />
    <meta name="_token" content="{{csrf_token()}}" />

    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('img/fav/apple-touch-icon.png') }}">
	<link rel="icon" type="image/png" sizes="32x32" href="{{ asset('img/fav/favicon-32x32.png') }}">
	<link rel="icon" type="image/png" sizes="16x16" href="{{ asset('img/fav/favicon-16x16.png') }}">
	<link rel="mask-icon" href="{{ asset('img/fav/safari-pinned-tab.svg') }}" color="#5bbad5">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    @stack('css-dropify')

    @stack('plugin-sweetalert')

	<link rel="manifest" href="manifest.json">
	<meta name="theme-color" content="#00838f">


	<!-- polyfills -->
	<script src="{{ asset('js/vendor/polyfills.min.js') }}"></script>

	<!-- UIKit js -->
    <script src="{{ asset('js/uikit.min.js') }}"></script>

    <script src="{{ asset('js/jquery-3.5.1.min.js')}}"></script>



    <style>
        .test-red{
            background:red;
        }
        .nthA{

        }
        .nthB{
            text-align:right;
        }
        .productDesign{
            color:#ffcc00;
        }
        .checked {
  color: orange;
}
    </style>



    <link rel="stylesheet" type="text/css" href="{{ asset('assets/DataTables/datatables.min.css') }}"/>
    <script src="{{ asset('assets/DataTables/datatables.min.js')}}"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.0.3/js/buttons.html5.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.0.3/js/buttons.print.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.0.3/js/buttons.flash.min.js"></script>
</head>
<body>
<script>
	// prevent FOUC
	var html = document.getElementsByTagName('html')[0];
	html.style.backgroundColor = '#f5f5f5';
	document.body.style.visibility = 'hidden';
	document.body.style.overflow = 'hidden';
	document.body.style.apacity = '0';
	document.body.style.maxHeight = "100%";

</script>
@php
    $userRoles = \DB::table('users_roles')->whereUserId(Auth::user()->id)->get()->pluck('role_id')->toArray();
@endphp
<header id="sc-header">
	<nav class="uk-navbar uk-navbar-container" data-uk-navbar="mode: click; duration: 360">
		<div class="uk-navbar-left nav-overlay-small uk-margin-right uk-navbar-aside">
            			<a href="#" id="sc-sidebar-main-toggle"><i class="mdi mdi-backburger sc-menu-close"></i><i class="mdi mdi-menu sc-menu-open"></i></a>
            			<div class="sc-brand uk-visible@s">
				<a href="dashboard-v1.html"><img src="{{ asset('img/logo.png') }}" alt=""></a>
			</div>
		</div>
        @if(in_array('1', $userRoles))
            <div class="uk-navbar-left nav-overlay uk-margin-right uk-visible@m">
                <ul class="uk-navbar-nav">
                    <li>
                        <a href="javascript:void(0)" class="md-color-white sc-padding-remove-left"><i
                                    class="mdi mdi-view-grid"></i></a>
                        <div class="uk-navbar-dropdown sc-padding-medium">
                            <div class="uk-child-width-2-1 uk-child-width-1-1@s uk-grid uk-grid-small" data-uk-grid>
                                <div>
                                    <a href="{{ route('userManagement')}}"
                                       class="uk-flex uk-flex-column uk-flex-middle uk-box-shadow-hover-small sc-round sc-padding-small">
                                        <i class="mdi mdi-account sc-icon-32 sc-text-lh-1 md-color-blue-grey-700"></i>
                                        <span class="uk-text-medium sc-color-primary">User Management</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        @endif

    		<div class="nav-overlay nav-overlay-small uk-navbar-right uk-flex-1" hidden>
			<a class="uk-navbar-toggle uk-visible@m" data-uk-toggle="target: .nav-overlay; animation: uk-animation-slide-top" href="#">
				<i class="mdi mdi-close sc-icon-24"></i>
			</a>
			<a class="uk-navbar-toggle uk-hidden@m uk-padding-remove-left" data-uk-toggle="target: .nav-overlay-small; animation: uk-animation-slide-top" href="#">
				<i class="mdi mdi-close sc-icon-24"></i>
			</a>
		</div>
		<div class="nav-overlay nav-overlay-small uk-navbar-right">
			<ul class="uk-navbar-nav">
				<li class="uk-visible@l">
					<a href="#" id="sc-js-fullscreen-toggle"><i class="mdi mdi-fullscreen sc-js-el-hide"></i><i class="mdi mdi-fullscreen-exit sc-js-el-show"></i></a>
				</li>

				<li class="uk-visible@s">
					<a href="#">
						<span class="mdi mdi-bell uk-display-inline-block">
							<span class="sc-indicator md-bg-color-red-600"></span>
						</span>
					</a>
					<div class="uk-navbar-dropdown md-bg-grey-100">
                        <div class="sc-padding-medium sc-padding-small-ends">
                            <div class="uk-text-right uk-margin-medium-bottom">
                                <button class="sc-button sc-button-default sc-button-outline sc-button-mini sc-js-clear-alerts">Clear all</button>
                            </div>
                            <ul class="uk-list uk-margin-remove" id="sc-header-alerts">
                                <li class="sc-border sc-round md-bg-white">
                                    <div class="uk-margin-right uk-margin-small-left"><i class="mdi mdi-alert-outline md-color-red-600"></i></div>
                                    <div class="uk-flex-1 uk-text-small">
                                        Information Page Not Found!
                                    </div>
                                </li>
                                <li class="uk-margin-small-top sc-border sc-round md-bg-white">
                                    <div class="uk-margin-right uk-margin-small-left"><i class="mdi mdi-email-check-outline md-color-blue-600"></i></div>
                                    <div class="uk-flex-1 uk-text-small">
                                        A new password has been sent to your e-mail address.
                                    </div>
                                </li>
                                <li class="uk-margin-small-top sc-border sc-round md-bg-white">
                                    <div class="uk-margin-right uk-margin-small-left"><i class="mdi mdi-alert-outline md-color-red-600"></i></div>
                                    <div class="uk-flex-1 uk-text-small">
                                        You do not have permission to access the API!
                                    </div>
                                </li>
                                <li class="uk-margin-small-top sc-border sc-round md-bg-white">
                                    <div class="uk-margin-right uk-margin-small-left"><i class="mdi mdi-check-all md-color-light-green-600"></i></div>
                                    <div class="uk-flex-1 uk-text-small">
                                        Your enquiry has been successfully sent.
                                    </div>
                                </li>
                            </ul>
                            <div class="uk-text-medium uk-text-center sc-js-empty-message sc-text-semibold sc-padding-ends" style="display: none">No alerts!</div>
                        </div>
					</div>
				</li>
				<li>
                <a href="#"><img src="{{ Auth::user()->images }}" alt="" width="31px" height="31px"></a>
					<div class="uk-navbar-dropdown uk-dropdown-small">
						<ul class="uk-nav uk-nav-navbar">
							<li><a href="{{ route('profile')}}">Profile</a></li>
							<li><a href="{{ route('logout')}}">Log Out</a></li>
						</ul>
					</div>
				</li>
			</ul>
            <a href="#" class="sc-js-offcanvas-toggle md-color-white uk-margin-left uk-hidden@l">
	            <i class="mdi mdi-menu sc-offcanvas-open"></i>
	            <i class="mdi mdi-arrow-right sc-offcanvas-close"></i>
            </a>
		</div>
	</nav>
</header>

<aside id="sc-sidebar-main" class="sc-sidebar-info-fixed">
    <div class="uk-offcanvas-bar">
        <div class="sc-sidebar-main-scrollable" data-sc-scrollbar="visible-y">
            <ul class="sc-sidebar-menu uk-nav">
                @if (in_array("2", $userRoles))
                    <li class="sc-sidebar-menu-heading">Sales Officer</li>
                    <li title="Beranda">
                        <a href="so-beranda.html">
                            <span class="uk-nav-icon"><i class="mdi mdi-home-variant-outline"></i>
                            </span><span class="uk-nav-title">Beranda</span>
                        </a>
                    </li>
                    <li class="{{ request()->is('order_payment/*') || request()->is('order_pelunasan_payment/*') || request()->is('verifikasi_artwork*') || request()->is('waiting/confirmation/customer/*') || request()->is('order/item/step/*') || request()->is('order_dikirim/*') || request()->is('order/allrecord/*') || request()->is('order/selesai/arrived/*') || request()->is('shipment/*') || request()->is('order/complain/so/*') == true ? 'sc-section-active' : '' }}" title="Product">

                        <a href="#">
                            <span class="uk-nav-icon"><i class="mdi mdi-basket"></i></span>
                            <span class="uk-nav-title">Order Produk</span>
                        </a>
                        <ul class="sc-sidebar-menu-sub" style="display: none;">
                            <li class="{{ request()->is('order') ? 'sc-page-active' : '' }}">
                                <a href="{{ route('foc.form.flush') }}">Buat Order Baru</a>
                            </li>
                            <li class="{{ request()->is('waiting/confirmation/customer*') ? 'sc-page-active' : '' }}">
                                <a href="{{ route('cust_confirm.index') }}">Menunggu Konfirmasi<div id="jumlah_menunggu_konfirmasi"></div></a></a>
                            </li>
                            <li class="{{ request()->is('order_payment*') ? 'sc-page-active' : '' }}">
                                <a href="{{ route('order_payment-index')}}">Menunggu Pembayaran<div id="jumlah_belum_konfirmasi"></div></a>
                            </li>
                            <li class="{{ request()->is('verifikasi_artwork*') ? 'sc-page-active' : '' }}">
                                <a href="{{ route('verifikasi_artwork.index')}}">Verifikasi Artwork<div id="jumlah_verifikasi_artwork"></div></a>
                            </li>
                            <li class="{{ request()->is('order/item/step*') ? 'sc-page-active' : '' }}">
                                <a href="{{ route('order_item_step.index') }}">Diproses<div id="jumlah_order_diproses"></div></a>
                            </li>
                            <li class="{{ request()->is('shipment*') ? 'sc-page-active' : '' }}">
                                <a href="{{ route('ready_shipment.index') }}">Siap Dikirim<div id="jumlah_siap_dikirim"></div></a>
                            </li>
                            <li class="{{ request()->is('order_pelunasan_payment*') ? 'sc-page-active' : '' }}">
                                <a href="{{ route('order_pelunasan_payment-index')}}">Menunggu Pelunasan<div id="jumlah_belum_konfirmasi_pelunasan"></div></a>
                            </li>
                            <li class="{{ request()->is('order_dikirim*') ? 'sc-page-active' : '' }}">
                                <a href="{{  route('order_dikirim.index') }}">Order Dikirim<div id="jumlah_order_dikirim"></div></a>
                            </li>
                            <li class="{{ request()->is('order/selesai/arrived*') ? 'sc-page-active' : '' }}">
                                <a href="{{ route('order_selesai_arrived.index') }}">Order Selesai</a>
                            </li>
                            <li class="{{ request()->is('order/allrecord*') ? 'sc-page-active' : '' }}">
                                <a href="{{ route('order_allrecord.index') }}">Riwayat Semua Order</a>
                            </li>
                        </ul>
                    </li>
                    <li title="Pembayaran & Pelunasan" class="{{ request()->is('order/complain/so*') ? 'sc-page-active' : '' }}">
                        <a href="{{ route('order_dikirim.indexKomplain') }}">
                            <span class="uk-nav-icon"><i class="mdi mdi-cart-remove"></i>
                            </span><span class="uk-nav-title">Dalam Komplain</span>
                        </a>
                    </li>
                    <li class="sc-sidebar-menu-heading">Management Data</li>
                    <li title="Manajemen Pelanggan">
                        <a href="#">
                            <span class="uk-nav-icon"><i class="mdi mdi-account-group"></i></span>
                            <span class="uk-nav-title">Data Pelanggan</span>
                        </a>
                        <ul class="sc-sidebar-menu-sub" style="display: none;">
                            <li class="@if (Request::segment(1) == 'customers') sc-page-active @endif">
                                <a href="{{ route('customers') }}">Semua Pelanggan</a>
                            </li>
                            <li class="@if (Request::segment(1) == 'cust-subcribe') sc-page-active @endif">
                                <a href="so-customer-blast.html">Sebar Informasi</a>
                            </li>
                        </ul>
                    </li>
                    <li title="Vendor" id="ve">
                        <a href="#">
                            <span class="uk-nav-icon"><i class="mdi mdi-power-plug"></i></span>
                            <span class="uk-nav-title">Manajemen Vendor</span>
                        </a>
                        <ul class="sc-sidebar-menu-sub" style="display: none;">
                            <li class="@if (Request::segment(1) == 'vendors') sc-page-active @endif">
                                <a href="{{ route('vendors') }}">Semua Pelanggan</a>
                            </li>
                            <li class="@if (Request::segment(1) == 'vendor-subcribe') sc-page-active @endif">
                                <a href="so-customer-blast.html">Sebar Informasi</a>
                            </li>
                        </ul>
                    </li>
                @endif

            @if (in_array("3", $userRoles))
                <ul class="sc-sidebar-menu uk-nav">
                <li class="sc-sidebar-menu-heading"><span>Quality Control</span></li>
                <li title="Beranda">
                    <a href="so-beranda.html">
                        <span class="uk-nav-icon"><i class="mdi mdi-home-variant-outline"></i>
                        </span><span class="uk-nav-title">Beranda</span>
                    </a>
                </li>
                <li title="Product" class="{{ request()->is('order/item/step/*') ||  request()->is('shipment/list/*') || request()->is('order/selesai/produksi/*') || request()->is('qc_complain/*')  == true ? 'sc-section-active' : '' }}">
                    <a href="#">
                        <span class="uk-nav-icon"><i class="mdi mdi-basket"></i></span>
                        <span class="uk-nav-title">Order Produk</span>
                    </a>
                        <ul class="sc-sidebar-menu-sub" style="display: none;">
                            <li class="{{ request()->is('order/item/step*') ? 'sc-page-active' : '' }}">
                                <a href="{{ route('order_item_step.index') }}">Diproses</a>
                            </li>
                            <li class="{{ request()->is('order/selesai/produksi*') ? 'sc-page-active' : '' }}">
                                <a href="{{ route('order_selesai_produksi.index') }}">Selesai Produksi</a>
                            </li>
                            <li class="{{ request()->is('shipment/list*') ? 'sc-page-active' : '' }}">
                                <a href="{{ route('ready_shipment.listQc') }}">Siap Dikirim</a>
                            </li>

                        </ul>
                    <ul class="sc-sidebar-menu-sub" style="display: none;">
                    </ul>
                </li>
                <li title="Dalam Komplain" class="{{ request()->is('qc_complain*') ? 'sc-page-active' : '' }}">
                    <a href="{{ route('qc.complain') }}">
                        <span class="uk-nav-icon"><i class="mdi mdi-cart-remove"></i>
                        </span><span class="uk-nav-title">Dalam Komplain</span>
                    </a>
                </li>
            </ul>
                @endif

                @if (in_array("4", $userRoles))
                    <li class="sc-sidebar-menu-heading">Product Design</li>
                <li title="Product Design" id="pd">
                    <a href="{{ route('DesignProduct') }}">
                        <span class="uk-nav-icon"><i class="mdi mdi-view-compact-outline"></i>
                        </span><span class="uk-nav-title">Product Design</span>
                    </a>
                </li>
                <li title="Product" class="sc-js-submenu-trigger sc-has-submenu {{ request()->is('pd_upload/*')   == true ? 'sc-section-active' : '' }}">
                    <a href="#">
                        <span class="uk-nav-icon"><i class="mdi mdi-basket"></i></span>
                        <span class="uk-nav-title">Order Produk</span>
                    </a>
                    <ul class="sc-sidebar-menu-sub" style="display: block;">
                        <li class="{{ request()->is('pd_upload*')   == true ? 'sc-page-active' : '' }}">
                            <a href="{{ route('pd_upload-index') }}">Verifikasi Artwork</a>
                        </li>
                    </ul>
                </li>
                @endif

                @if (in_array("5", $userRoles) )
                    <li class="sc-sidebar-menu-heading">Accounting</li>
                <li title="Accounting" id="ac">
                    <a href="{{ route('Accounting') }}">
                        <span class="uk-nav-icon"><i class="mdi mdi-chart-areaspline"></i>
                        </span><span class="uk-nav-title">Accounting</span>
                    </a>
                </li>
                <li class="{{ request()->is('accounting_verifikasi/*') || request()->is('accounting_pelunasan/*')  == true ? 'sc-section-active' : '' }}" title="Accounting Produk">
                        <a href="#">
                            <span class="uk-nav-icon"><i class="mdi mdi-basket"></i></span>
                            <span class="uk-nav-title">Order Produk</span>
                        </a>
                        <ul class="sc-sidebar-menu-sub" style="display: none;">
                            <li class="{{ request()->is('accounting_verifikasi*')  == true ? 'sc-page-active' : '' }}">
                                <a href="{{ route('accounting_verifikasi-index')}}">Konfirmasi Pembayaran <div id="jumlah_konfirmasi"></div></a>
                            </li>
                            <li class="{{ request()->is('accounting_pelunasan*')  == true ? 'sc-page-active' : '' }}">
                                <a href="{{ route('accounting_pelunasan-index')}}">Menunggu Pelunasan <div id="jumlah_konfirmasi_pelunasan"></div></a>
                            </li>

                </ul>
                </li>
                <li title="Upload Vendor" class="{{ request()->is('vendor/upload/image/*') || request()->is('vendor/upload/pelunasan/*') == true ? 'sc-section-active' : '' }}">
                    <a href="#">
                        <span class="uk-nav-icon"><i class="mdi mdi-upload"></i></span>
                        <span class="uk-nav-title">Upload Vendor</span>
                    </a>
                    <ul class="sc-sidebar-menu-sub" style="display: none;">
                        <li class="{{ request()->is('vendor/upload/image*') == true ? 'sc-page-active' : '' }}">
                            <a href="{{ route('upload_img_vendor.index') }}">Down Payment Vendor</a>
                        </li>
                        <li class="{{ request()->is('vendor/upload/pelunasan*') == true ? 'sc-page-active' : '' }}">
                            <a href="{{ route('upload_img_vendor.indexPelunasan') }}">Upload Pelunasan</a>
                        </li>
                    </ul>
                </li>
                @endif

                @if (in_array("6", $userRoles) )
                <li class="sc-sidebar-menu-heading"><span>Product Development</span></li>
				<li title="Overview">
					<a href="index.html">
						<span class="uk-nav-icon"><i class="mdi mdi-home-variant-outline"></i>
	                    </span><span class="uk-nav-title">Beranda</span>
					</a>
				</li>
				<li title="Product">
					<a href="#">
						<span class="uk-nav-icon"><i class="mdi mdi-hanger"></i></span>
						<span class="uk-nav-title">Manajemen Produk</span>
					</a>
					<ul class="sc-sidebar-menu-sub" style="display: none;">
						<li @if(Request::segment(1) == 'categories') class="sc-page-active" @endif >
							<a href="{{ route('categories') }}">Kategori</a>
						</li>
						<li @if(Request::segment(1) == 'sub-categories') class="sc-page-active" @endif >
							<a href="{{ route('sub-categories') }}">Subkategori</a>
						</li>
						<li @if(Request::segment(1) == 'products') class="sc-page-active" @endif >
							<a href="{{ route('products') }}">Produk</a>
						</li>
                        <li @if(Request::segment(1) == 'product-addons-category') class="sc-page-active" @endif >
                            <a href="{{ route('product-addons-category') }}">Kategori Produk Addons</a>
						</li>
						<li @if(Request::segment(1) == 'product-spec-items') class="sc-page-active" @endif >
                            <a href="{{ route('product-spec-items') }}">Spesifikasi Addons</a>
						</li>
					</ul>
					<a href="#">
						<span class="uk-nav-icon"><i class="mdi mdi-bulletin-board"></i></span>
						<span class="uk-nav-title">Manajemen Material</span>
					</a>
					<ul class="sc-sidebar-menu-sub" style="display: none;">
						<li @if(Request::segment(1) == 'units') class="sc-page-active" @endif >
							<a href="{{ route('units') }}">Units</a>
						</li>
						<li @if(Request::segment(1) == 'suppliers') class="sc-page-active" @endif >
							<a href="{{ route('suppliers') }}">Suplier</a>
						</li>
						<li @if(Request::segment(1) == 'specifications') class="sc-page-active" @endif >
							<a href="{{ route('specifications') }}">Spesifikasi</a>
						</li>
						<li @if(Request::segment(1) == 'specification-items') class="sc-page-active" @endif >
							<a href="{{ route('specification-items') }}">Spesifikasi Item</a>
						</li>
						<li @if(Request::segment(1) == 'product-materials') class="sc-page-active" @endif >
							<a href="{{ route('product-materials') }}">Material</a>
						</li>
						<li @if(Request::segment(1) == 'product-material-items') class="sc-page-active" @endif >
							<a href="{{ route('product-material-items') }}">Material Item</a>
						</li>
						<li @if(Request::segment(1) == 'material-stocks') class="sc-page-active" @endif >
							<a href="{{ route('material-stocks') }}">Material Stock</a>
						</li>
					</ul>
				</li>
				<li title="Varian">
					<a href="#">
						<span class="uk-nav-icon"><i class="mdi mdi-bulletin-board"></i></span>
                        <span class="uk-nav-title">Manajemen Varian</span>
					</a>
					<ul class="sc-sidebar-menu-sub" style="display: none;">
						<li @if(\Illuminate\Support\Facades\Request::segment(1) === 'variants') class="sc-page-active" @endif >
							<a href="{{ route('variants') }}">Varian</a>
						</li>
						<li @if(\Illuminate\Support\Facades\Request::segment(1) === 'subvariants') class="sc-page-active" @endif>
							<a href="{{ route('subvariants') }}">Subvarian</a>
						</li>
						<li @if(\Illuminate\Support\Facades\Request::segment(1) === 'models') class="sc-page-active" @endif>
							<a href="{{ route('models') }}">Model</a>
						</li>
					</ul>
				</li>
                    <li title="Manajemen Vendor">
                        <a href="#">
                            <span class="uk-nav-icon"><i class="mdi mdi-auto-fix"></i></span>
                            <span class="uk-nav-title">Manajemen Artwork</span>
                        </a>
                        <ul class="sc-sidebar-menu-sub" style="display: none;">
                            <li class="@if (Request::segment(1) == 'artworks') sc-page-active @endif">
                                <a href="{{ route('artworks') }}">Artwork</a>
                            </li>
                            <li class="@if (Request::segment(1) == 'artwork-size') sc-page-active @endif">
                                <a href="{{ route('artwork-size') }}">Artwork Size</a>
                            </li>
                            <li class="sc-page{{ request()->is('atwork/material/cetak') ? '-active' : ''}}">
                                <a href="{{ route('materialPrint.index') }}">Material Cetak</a>
                            </li>
                            <li class="sc-page{{ request()->is('atwork/metode/cetak') ? '-active' : ''}}">
                                <a href="{{ route('printMethod.index') }}">Metode Cetak</a>
                            </li>
                        </ul>
                    </li>
				<li class="sc-page{{ request()->is('sizepacks') ? '-active' : ''}}" title="Overview">
					<a href="{{ route('sizepacks') }}">
						<span class="uk-nav-icon"><i class="mdi mdi-folder-settings-variant-outline"></i>
	                    </span><span class="uk-nav-title">Pengaturan Sizepack</span>
					</a>
				</li>
                @endif

                @if (in_array("7", $userRoles) )
                <li title="Vendor" id="ve">
                    <a href="{{ route('Vendor') }}">
                        <span class="uk-nav-icon"><i class="mdi mdi-power-plug"></i>
                        </span><span class="uk-nav-title">Vendor</span>
                    </a>
                </li>
                @endif
            </ul>

            @if (in_array("1", $userRoles))
                <ul class="sc-sidebar-menu uk-nav">
                    <li class="sc-sidebar-menu-heading"><span>Superadmin</span></li>
                    <li class="@if (Request::segment(1) == 'customer-works') sc-page-active @endif" title="Data Klaster"
                        id="data-klaster">
                        <a href="{{ route('customer-works') }}">
                            <span class="uk-nav-icon"><i class="mdi mdi-power-plug"></i></span>
                            <span class="uk-nav-title">Data Klaster</span>
                        </a>
                    </li>
                    <li class="{{ request()->is('banner*') == true ? 'sc-page-active' : '' }}">
                        <a href="{{ route('banner.index') }}">
                            <span class="uk-nav-icon"><i class="mdi mdi-mushroom"></i></span>
                            <span class="uk-nav-title">Banner</span>
                        </a>
                    </li>
                    <li class="{{ request()->is('company*') == true ? 'sc-page-active' : '' }}">
                        <a href="{{ route('company.index') }}">
                            <span class="uk-nav-icon"><i class="mdi mdi-mushroom"></i></span>
                            <span class="uk-nav-title">Company</span>
                        </a>
                    </li>
                    <li class="{{ request()->is('testimoni*') == true ? 'sc-page-active' : '' }}">
                        <a href="{{ route('testimoni.index') }}">
                            <span class="uk-nav-icon"><i class="mdi mdi-mushroom"></i></span>
                            <span class="uk-nav-title">Testimony Company</span>
                        </a>
                    </li>
                    <li class="{{ request()->is('categoryblog*') == true ? 'sc-page-active' : '' }}">
                        <a href="{{ route('categoryblog.index') }}">
                            <span class="uk-nav-icon"><i class="mdi mdi-mushroom"></i></span>
                            <span class="uk-nav-title">Category Blog</span>
                        </a>
                    </li>
                    <li class="{{ request()->is('blog*') == true ? 'sc-page-active' : '' }}">
                        <a href="{{ route('blog.index') }}">
                            <span class="uk-nav-icon"><i class="mdi mdi-mushroom"></i></span>
                            <span class="uk-nav-title">Blog</span>
                        </a>
                    </li>
                    <li class="{{ request()->is('promo*') == true ? 'sc-page-active' : '' }}">
                        <a href="{{ route('promo.index') }}">
                            <span class="uk-nav-icon"><i class="mdi mdi-mushroom"></i></span>
                            <span class="uk-nav-title">Promo</span>
                        </a>
                    </li>
                </li>
                </ul>
                <ul class="sc-sidebar-menu uk-nav">
                    <li class="sc-sidebar-menu-heading"><span>Manajemen Wilayah</span></li>
                    <li title="Manajemen Wilayah">
                        <a href="#">
                            <span class="uk-nav-icon"><i class="mdi mdi-map"></i></span>
                            <span class="uk-nav-title">Data Wilayah</span>
                        </a>
                        <ul class="sc-sidebar-menu-sub" style="display: none;">
                            <li class="@if (Request::segment(1) == 'provinces') sc-page-active @endif">
                                <a href="{{ route('provinces') }}">Provinsi</a>
                            </li>
                            <li class="@if (Request::segment(1) == 'cities') sc-page-active @endif">
                                <a href="{{ route('cities') }}">Kota / Kabupaten</a>
                            </li>
                        </ul>
                    </li>
                </ul>
                <ul class="sc-sidebar-menu uk-nav">
                    <li class="sc-sidebar-menu-heading"><span>Pantau</span></li>
                    <li title="Manajemen Pelanggan">
                        <a href="#">
                            <span class="uk-nav-icon"><i class="mdi mdi-chart-bell-curve-cumulative"></i></span>
                            <span class="uk-nav-title">Statistik & Laporan</span>
                        </a>
                        <ul class="sc-sidebar-menu-sub" style="display: none;">
                            <li>
                                <a href="so-stats-order.html">Statistik Order</a>
                            </li>
                            <li>
                                <a href="so-stats-report.html">Download Laporan</a>
                            </li>
                            <li>
                                <a href="so-stats-customer.html">Statistik Pelanggan</a>
                            </li>
                            <li>
                                <a href="so-stats-complain.html">Laporan Komplain</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            @endif
        </div>
        <div class="sc-sidebar-info">
            version: 0.1.0
        </div>
    </div>
</aside>
    @yield('content')
    @include('jquery.count')

    @include('sweetalert::alert')

<!-- async asset-->
{{--<script src="{{ asset('js/vendor/loadjs.js') }}"></script>--}}

<script>
    // loadjs.js ({{ asset('js/vendor/loadjs.js') }})
    loadjs=function(){function v(a,d){a=a.push?a:[a];var c=[],b=a.length,e=b,g,k;for(g=function(a,b){b.length&&c.push(a);e--;e||d(c)};b--;){var h=a[b];(k=n[h])?g(h,k):(h=p[h]=p[h]||[],h.push(g))}}function r(a,d){if(a){var c=p[a];n[a]=d;if(c)for(;c.length;)c[0](a,d),c.splice(0,1)}}function t(a,d){a.call&&(a={success:a});d.length?(a.error||q)(d):(a.success||q)(a)}function u(a,d,c,b){var e=document,g=c.async,k=c.preload;try{var h=document.createElement("link").relList.supports("preload")}catch(y){h=0}var l=
    (c.numRetries||0)+1,p=c.before||q,m=a.replace(/^(css|img)!/,"");b=b||0;if(/(^css!|\.css$)/.test(a)){var n=!0;var f=e.createElement("link");k&&h?(f.rel="preload",f.as="style"):f.rel="stylesheet";f.href=m}else/(^img!|\.(png|gif|jpg|svg)$)/.test(a)?(f=e.createElement("img"),f.src=m):(f=e.createElement("script"),f.src=a,f.async=void 0===g?!0:g);f.onload=f.onerror=f.onbeforeload=function(e){var g=e.type[0];if(n&&"hideFocus"in f)try{f.sheet.cssText.length||(g="e")}catch(w){18!=w.code&&(g="e")}if("e"==g&&
    (b+=1,b<l))return u(a,d,c,b);k&&h&&(f.rel="stylesheet");d(a,g,e.defaultPrevented)};!1!==p(a,f)&&(n?e.head.insertBefore(f,document.getElementById("main-stylesheet")):e.head.appendChild(f))}function x(a,d,c){a=a.push?a:[a];var b=a.length,e=b,g=[],k;var h=function(a,c,e){"e"==c&&g.push(a);if("b"==c)if(e)g.push(a);else return;b--;b||d(g)};for(k=0;k<e;k++)u(a[k],h,c)}function l(a,d,c){var b;d&&d.trim&&(b=d);var e=(b?c:d)||{};if(b){if(b in m)throw"LoadJS";m[b]=!0}x(a,function(a){t(e,a);r(b,a)},e)}var q=
    function(){},m={},n={},p={};l.ready=function(a,d){v(a,function(a){t(d,a)});return l};l.done=function(a){r(a,[])};l.reset=function(){m={};n={};p={}};l.isDefined=function(a){return a in m};return l}();


</script>
@stack('dropify')
<script>
    var html = document.getElementsByTagName('html')[0];
    // ----------- CSS

    // md icons
    loadjs("{{ asset('css/materialdesignicons.min.css') }}", {
        preload: true
    });

    // UIkit
    loadjs("{{ asset('node_modules/uikit/dist/css/uikit.min.css') }}", {
        preload: true
    });
    // custom css
    loadjs("{{ asset('css/custom.css') }}", {
        preload: true
    });

    // themes
    loadjs("{{ asset('css/themes/themes_combined.min.css') }}", {
        preload: true
    });

    // mdi icons (base64) & google fonts (base64)
    loadjs(["{{ asset('css/fonts/mdi_fonts.css') }}",
            "{{ asset('css/fonts/roboto_base64.css') }}",
            "{{ asset('css/fonts/sourceCodePro_base64.css') }}"
            ], {
        preload: true
    });

    // main stylesheet
    loadjs("{{ asset('css/main.min.css') }}", function() {});

    // vendor
    loadjs("{{ asset('js/vendor.min.js') }}", function () {
            //scutum common functions/helpers
        loadjs("{{ asset('js/scutum_common.js') }}", function () {
                scutum.init();
            loadjs("{{ asset('js/views/forms/forms-examples.js') }}", {
                success: function () {
                    $(function () {
                        scutum.forms.examples.init()
                    });
                }
            })
                loadjs("{{ asset('js/views/plugins/datatables.min.js') }}", { success: function() { $(function(){scutum.plugins.dataTables.init()}); } })
                loadjs("{{ asset('js/views/dashboard/dashboard_v2.min.js') }}", { success: function() { $(function(){scutum.dashboard.init()}); } })
                loadjs("{{ asset('js/views/pages/issues.min.js') }}", { success: function() { $(function(){scutum.dashboard.init()}); } })
                loadjs("{{ asset('js/views/components/modals_dialogs.min.js') }}", { success: function() { $(function(){scutum.dashboard.init()}); } })
                loadjs("{{ asset('js/views/forms/forms-tinymce.min.js') }}", { success: function() { $(function(){scutum.forms.tinymce.init();
                    scutum.forms.tinymceedit.init();
                });
                // loadjs("{{ asset('js/views/forms/forms.min.js') }}", { success: function() { $(function(){scutum.forms.controls.init()}); } })
                 } })

                // show page
                setTimeout(function () {
                    // clear styles (FOUC)
                    $(html).css({
                        'backgroundColor': '',
                    });
                    $('body').css({
                        'visibility': '',
                        'overflow': '',
                        'apacity': '',
                        'maxHeight': ''
                    });
                }, 100);

                // style switcher
                loadjs(["{{ asset('js/style_switcher.min.js') }}", "{{ asset('css/plugins/style_switcher.min.css') }}"], {
                    success: function() {
                        $(function(){
                            scutum.styleSwitcher();
                        });
                    }
                });
            });
    });

</script>

@stack('scripts')

<div id="sc-style-switcher">
    <a href="#" class="sc-sSw-toggle"><i class="mdi mdi-tune"></i></a>
    <p class="sc-text-semibold uk-margin-top-remove uk-margin-bottom">Themes</p>
    <ul class="sc-sSw-theme-switcher">
        <li class="active">
            <a href="#" class="sc-sSw-theme-switch sc-sW-theme-default" data-theme="">
                <span class="sc-sSw-theme-switch-color-1"></span>
                <span class="sc-sSw-theme-switch-color-2"></span>
            </a>
        </li>
        <li>
            <a href="#" class="sc-sSw-theme-switch sc-sW-theme-a" data-theme="sc-theme-a">
                <span class="sc-sSw-theme-switch-color-1"></span>
                <span class="sc-sSw-theme-switch-color-2"></span>
            </a>
        </li>
        <li>
            <a href="#" class="sc-sSw-theme-switch sc-sW-theme-b" data-theme="sc-theme-b">
                <span class="sc-sSw-theme-switch-color-1"></span>
                <span class="sc-sSw-theme-switch-color-2"></span>
            </a>
        </li>
        <li>
            <a href="#" class="sc-sSw-theme-switch sc-sW-theme-c" data-theme="sc-theme-c">
                <span class="sc-sSw-theme-switch-color-1"></span>
                <span class="sc-sSw-theme-switch-color-2"></span>
            </a>
        </li>
        <li>
            <a href="#" class="sc-sSw-theme-switch sc-sW-theme-d" data-theme="sc-theme-d">
                <span class="sc-sSw-theme-switch-color-1"></span>
                <span class="sc-sSw-theme-switch-color-2"></span>
            </a>
        </li>
        <li>
            <a href="#" class="sc-sSw-theme-switch sc-sW-theme-e" data-theme="sc-theme-e">
                <span class="sc-sSw-theme-switch-color-1"></span>
                <span class="sc-sSw-theme-switch-color-2"></span>
            </a>
        </li>
        <li>
            <a href="#" class="sc-sSw-theme-switch sc-sW-theme-f" data-theme="sc-theme-f">
                <span class="sc-sSw-theme-switch-color-1"></span>
                <span class="sc-sSw-theme-switch-color-2"></span>
            </a>
        </li>
        <li>
            <a href="#" class="sc-sSw-theme-switch sc-sW-theme-g" data-theme="sc-theme-g">
                <span class="sc-sSw-theme-switch-color-1"></span>
                <span class="sc-sSw-theme-switch-color-2"></span>
            </a>
        </li>
        <li>
            <a href="#" class="sc-sSw-theme-switch sc-sW-theme-h" data-theme="sc-theme-h">
                <span class="sc-sSw-theme-switch-color-1"></span>
                <span class="sc-sSw-theme-switch-color-2"></span>
            </a>
        </li>
        <li>
            <a href="#" class="sc-sSw-theme-switch sc-sW-theme-dark" data-theme="sc-theme-dark">
                <span class="sc-sSw-theme-switch-color-1"></span>
                <span class="sc-sSw-theme-switch-color-2"></span>
            </a>
        </li>
    </ul>
    <p class="sc-text-semibold uk-margin-large-top uk-margin-bottom">Main Menu</p>
    <div class="uk-flex uk-flex-middle uk-margin-small-bottom">
        <input type="checkbox" id="sc-menu-scroll-to-active" data-sc-icheck><label for="sc-menu-scroll-to-active">Scroll to active</label>
    </div>
    <div class="uk-flex uk-flex-middle">
        <input type="checkbox" id="sc-menu-accordion-mode" data-sc-icheck><label for="sc-menu-accordion-mode">Accordion mode</label>
    </div>
</div>
</body>
</html>

