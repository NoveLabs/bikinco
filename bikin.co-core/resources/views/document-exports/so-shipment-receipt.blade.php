@extends('document-exports.layouts.main')

@section('document.content')
    <div class="main-page">
        <div class="page-header">
            <ul class="page-list">
                <li class="list-grid-2">
                    <div class="document-label">Shipment</div>
                </li>
                <li class="list-grid-6">
                    <div class="document-info small-padding-left">
                        <h4>Shipment Receipt</h4>
                    </div>
                    <div class="document-info small-padding-left">
                        <h4>{{ $order_shipments[0]['expedition_name'] }}</h4>
                        <p>Yogyakarta - Cargo</p>
                    </div>
                </li>
                <li class="list-grid-4">
                    <div class="document-info text-right">
                        <img class="header-image"
                             src="{{ asset('print_exports/samples/img/logo/company_logo.png') }}"
                             alt="Bikin.co Company Logo">
                    </div>
                </li>
            </ul>
        </div>
        <div class="page-body">
            <div class="shipment-info">
                <ul class="page-list">
                    <li class="list-grid-6">
                        <div class="default-margin">
                            <span class="text-default text-bold">Nomor Resi</span><br>
                            <span class="text-default">{{ $order_shipments[0]['no_resi'] }}</span>
                        </div>
                    </li>
                    <li class="list-grid-6">
                        <div class="default-margin">
                            <span class="text-default text-bold">Layanan</span><br>
                            <span class="text-default">Regular</span>
                        </div>
                    </li>
                    <li class="list-grid-6">
                        <div class="default-margin">
                            <span class="text-default text-bold">Pengirim</span><br>
                            <div class="address-container">
                                <address class="address-title">PT.Bikin Indonesia Berdaya</address>
                                <address class="address-content">
                                    3rd Floor, Grha Environesia Jalan Jati Mataram
                                    248 B, Sleman, D.I. Yogyakarta, 55582, Indonesia
                                </address>
                            </div>
                        </div>
                    </li>
                    <li class="list-grid-6">
                        <div class="default-margin">
                            <span class="text-default text-bold">Penerima</span><br>
                            <div class="address-container">
                                <address class="address-title">{{ $customer['fullname'] }}</address>
                                <address class="address-content">{{ $customer['address'] }}
                                </address>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <div class="page-footer">
            <ul class="page-list">
                <li class="list-grid-4">
                    <div class="address-container">
                        <address class="address-title official-color no-margin-top">PT.Bikin Indonesia Berdaya
                        </address>
                        <address class="address-content">3rd Floor, Grha Environesia Jalan Jati Mataram 248 B,
                            Sleman, D.I. Yogyakarta, 55582, Indonesia
                        </address>
                    </div>
                </li>
                <li class="list-grid-4 small-padding-left">
                    <ul class="page-list">
                        <li class="list-grid-12">
                            <ul class="page-list">
                                <li class="list-grid-1 official-color"><span class="lni lni-phone"></span></li>
                                <li class="list-grid-11">
                                    <div class="footer-content">
                                        <span>+62 274 88 0603 (Ext.4)</span><br>
                                        <span>+62 852 8888 6020</span>
                                    </div>
                                </li>
                            </ul>
                        </li>
                        <li class="list-grid-12">
                            <ul class="page-list">
                                <li class="list-grid-1 official-color"><span class="lni lni-envelope"></span></li>
                                <li class="list-grid-11">
                                    <div class="footer-content">
                                        <span>info@bikin.co</span>
                                    </div>
                                </li>
                            </ul>
                        </li>
                        <li class="list-grid-12">
                            <ul class="page-list">
                                <li class="list-grid-1 official-color"><span class="lni lni-world"></span></li>
                                <li class="list-grid-11">
                                    <div class="footer-content">
                                        <span>www.bikin.co</span>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="list-grid-4"></li>
            </ul>
        </div>
    </div>
@endsection
