@extends('document-exports.layouts.main-export')

@section('document.content')
    <div class="Delivery Order">
        <div class="main-page">
            <div class="page-header">
                <ul class="page-list">
                    <li class="list-grid-2">
                        <div class="document-label">Delivery Order</div>
                    </li>
                    <li class="list-grid-6">
                        <div class="document-info small-padding-left">
                            <h4>No Order :</h4>
                            <p>BP-1234</p>
                        </div>
                        <div class="document-info small-padding-left">
                            <ul class="page-list">
                                <li class="list-grid-6">
                                    <h4>Tanggal Terbit :</h4>
                                    <p>30 Februari 2021</p>
                                </li>
                                <li class="list-grid-6">
                                    <h4>Nomor DO :</h4>
                                    <div class="fill-content"></div>
                                </li>
                            </ul>
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
                <div class="delivery-info">
                    <p class="text-default text-bold">Detail Pengiriman</p>
                    <ul class="page-list">
                        <li class="list-grid-6" style="padding-right: 5mm;">
                            <div>
                                <h4>Nama Kendaraan :</h4>
                                <div class="fill-content"></div>
                            </div>
                        </li>
                        <li class="list-grid-6" style="padding-right: 5mm;">
                            <div>
                                <h4>No. Polisi :</h4>
                                <div class="fill-content"></div>
                            </div>
                        </li>
                        <li class="list-grid-6">
                            <div class="default-margin-top">
                                <h4>Pengirim :</h4>
                                <div class="address-container">
                                    <address class="address-title">Vendor One</address>
                                    <address class="address-content">Jalan Gajahmada 04, Sleman, Yogyakarta 55584
                                    </address>
                                </div>
                            </div>
                        </li>
                        <li class="list-grid-6">
                            <div class="default-margin-top">
                                <h4>Penerima :</h4>
                                <div class="address-container">
                                    <address class="address-title">PT.Bikin Indonesia Berdaya</address>
                                    <address class="address-content">3rd Floor, Grha Environesia Jalan Jati Mataram
                                        248 B, Sleman, D.I. Yogyakarta, 55582, Indonesia
                                    </address>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                <br>
                <br>
                <div class="Delivery Order-content">
                    <div class="page-container">
                        <table class="page-table table-default">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode</th>
                                <th>Item</th>
                                <th>QTY</th>
                                <th>Notes</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>1.</td>
                                <td>0001</td>
                                <td class="text-left">
                                    <div>Kaos Team Kantor<br>Kaos O-Neck</div>
                                </td>
                                <td>30</td>
                                <td>...</td>
                            </tr>
                            </tbody>
                        </table>
                        <div class="total-order">
                            <ul class="page-list">
                                <li class="list-grid-12 default-margin-bottom">
                                    <div class="item-list-card summary-item small-margin-top">
                                        <ul class="page-list">
                                            <li class="list-grid-6">
                                                <div>
                                                    <span class="text-bold">Total Quantity</span>
                                                </div>
                                            </li>
                                            <li class="list-grid-6 text-right">
                                                <div>
                                                    <span>30</span>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
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
    </div>
@endsection