@extends('document-exports.layouts.main')

@section('document.content')
    <div class="invoice">
        <div class="main-page">
            <div class="page-header">
                <ul class="page-list">
                    <li class="list-grid-2">
                        <div class="document-label">Invoice</div>
                    </li>
                    <li class="list-grid-6">
                        <div class="document-info small-padding-left">
                            <h4>No Invoice :</h4>
                            <p>BP-1234</p>
                        </div>
                        <div class="document-info small-padding-left">
                            <h4>Tanggal Terbit :</h4>
                            <p>30 Februari 2021</p>
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
                <div class="address-list">
                    <div class="page-info-banner">
                        <ul class="page-list">
                            <li class="list-grid-4 text-left middle-content">
                                <div class="address-sender-section">
                                    <div class="address-container">
                                        <address class="address-title">Vendor One</address>
                                        <address class="address-content">Jalan Gajahmada 04, Sleman, Yogyakarta 55584
                                        </address>
                                    </div>
                                </div>
                            </li>
                            <li class="list-grid-4 text-center middle-content">
                                <div class="icon-separator">
                                    <span class="lni lni-chevron-right-circle"></span>
                                </div>
                            </li>
                            <li class="list-grid-4 text-left">
                                <div class="address-recipient-section">
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
                </div>
                <div class="invoice-content">
                    <div class="page-container">
                        <table class="page-table table-default">
                            <thead>
                            <tr>
                                <th>Kode</th>
                                <th>Nama Item</th>
                                <th>Qty</th>
                                <th>Harga Satuan</th>
                                <th>Total</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>0001</td>
                                <td class="text-left">
                                    <div>Kaos Team Kantor<br>Kaos O-Neck</div>
                                </td>
                                <td>30</td>
                                <td>50,000</td>
                                <td>1,500,000</td>
                            </tr>
                            </tbody>
                        </table>
                        <div class="summary-content text-right">
                            <div class="page-card no-margin-right">
                                <div class="card-body default-grey">
                                    <ul class="page-list text-left">
                                        <li class="list-grid-12">
                                            <ul class="page-list">
                                                <li class="list-grid-6">Subtotal Produk</li>
                                                <li class="list-grid-6 text-right">Rp. 1,740,000</li>
                                            </ul>
                                        </li>
                                        <li class="list-grid-12">
                                            <ul class="page-list">
                                                <li class="list-grid-6">Discount</li>
                                                <li class="list-grid-6 text-right">Rp. 0</li>
                                            </ul>
                                        </li>
                                        <hr class="line-separator">
                                        <li class="list-grid-12">
                                            <ul class="page-list">
                                                <li class="list-grid-6">Total Order</li>
                                                <li class="list-grid-6 text-right">Rp. 1,740,000</li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                                <div class="card-footer official-background">
                                    <ul class="page-list text-left">
                                        <li class="list-grid-12">
                                            <ul class="page-list">
                                                <li class="list-grid-6">Total Bayar</li>
                                                <li class="list-grid-6 text-right">Rp. 1,740,000</li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            </div>
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
        <div class="main-page" page-title="how-to-pay">
            <div class="page-header">
                <ul class="page-list">
                    <li class="list-grid-2">
                        <div class="document-label">Invoice</div>
                    </li>
                    <li class="list-grid-6">
                        <div class="document-info small-padding-left">
                            <h4>No Invoice :</h4>
                            <p>BP-1234</p>
                        </div>
                        <div class="document-info small-padding-left">
                            <h4>Tanggal Terbit :</h4>
                            <p>30 Februari 2021</p>
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
                <div class="how-to-pay">
                    <div class="bank-list default-margin-bottom" style="padding: 4mm; background: #eaeaea">
                        <div>
                            <span class="text-bold">Tujuan Transfer</span><br>
                            <span>a/n PT. Bikin Indonesia Berdaya</span>
                        </div>
                        <br>
                        <ul class="page-list">
                            <li class="list-grid-4">
                                <div>
                                    <ul class="page-list">
                                        <li class="list-grid-4">
                                            <img style="width: 2cm;"
                                                 src="{{ asset('print_exports/samples/img/banks/mandiri.png') }}"
                                                 alt="Bank Mandiri">
                                        </li>
                                        <li class="list-grid-8">
                                            <span>Mandiri</span><br>
                                            <span class="text-bold">0080 10092 12</span>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="list-grid-4">
                                <div>
                                    <ul class="page-list">
                                        <li class="list-grid-4">
                                            <img style="width: 2cm;"
                                                 src="{{ asset('print_exports/samples/img/banks/bri.png') }}"
                                                 alt="Bank BRI">
                                        </li>
                                        <li class="list-grid-8">
                                            <span>BRI</span><br>
                                            <span class="text-bold">0080 10092 12</span>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="list-grid-4">
                                <div>
                                    <ul class="page-list">
                                        <li class="list-grid-4">
                                            <img style="width: 2cm;"
                                                 src="{{ asset('print_exports/samples/img/banks/bca.png') }}"
                                                 alt="Bank BCA">
                                        </li>
                                        <li class="list-grid-8">
                                            <span>BCA</span><br>
                                            <span class="text-bold">0080 10092 12</span>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="how-to-pay" style="padding: 4mm; background: #eaeaea">
                        <div class="default-margin-bottom">
                            <p class="text-bold">Konfirmasi Pembayaran :</p><br>
                            <span><a href="#"
                                     class="official-color">https://www.bikin.co/payment/confirmation?no=12345</a></span><br>
                            <span>atau konfirmasi pembayaran anda melalui Customer Service Kami ( 0812 8888 6020 ).</span>
                        </div>
                        <br>
                        <div class="default-margin-bottom">
                            <p class="text-bold">Syarat & Ketentuan :</p><br>
                            <span class="text-default">1. Surat Perjanjian Kerja ( SPK ) dibuat setelah Pembayaran DP terverifikasi.</span><br>
                            <span class="text-default">2. Produksi dimulai setelah Surat Perjanjian Kerja ( SPK ) disetujui customer.</span>
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
