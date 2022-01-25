@extends('document-exports.layouts.main-export')

@section('document.content')
    <div class="main-page no-padding" page-title="preambule">
        <div class="page-header" style="padding: 10mm 10mm 0;">
            <ul class="page-list">
                <li class="list-grid-4">
                    <div class="document-label" style="padding: 3mm 4mm 3mm 4mm;">
                        <span>SPK Vendor</span><br>
                        <span style="font-size: 10pt">Surat Perintah Kerja</span>
                    </div>
                </li>
                <li class="list-grid-4">
                    <div class="document-info small-padding-left">
                        <h4>No. Order:</h4>
                        <p>BP-1234</p>
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
            <div class="customer-area-info default-margin-bottom" style="padding: 5mm 10mm; background: #f5f5f5;">
                <ul class="page-list">
                    <li class="list-grid-6">
                        <ul class="page-list">
                            <li class="list-grid-6"><span>Vendor</span></li>
                            <li class="list-grid-6"><span class="text-bold">: Vendor One</span></li>
                        </ul>
                    </li>
                    <li class="list-grid-6">
                        <ul class="page-list">
                            <li class="list-grid-6"><span>No Telepon</span></li>
                            <li class="list-grid-6"><span class="text-bold">: 081234567890</span></li>
                        </ul>
                    </li>
                    <li class="list-grid-6">
                        <ul class="page-list">
                            <li class="list-grid-6"><span>Nama Produk</span></li>
                            <li class="list-grid-6"><span class="text-bold">: Kaos Team Kantor</span></li>
                        </ul>
                    </li>
                    <li class="list-grid-6">
                        <ul class="page-list">
                            <li class="list-grid-6"><span>Jenis Produk</span></li>
                            <li class="list-grid-6"><span class="text-bold">: Kaos O-Neck</span></li>
                        </ul>
                    </li>
                    <li class="list-grid-6">
                        <ul class="page-list">
                            <li class="list-grid-6"><span>Tanggal Masuk</span></li>
                            <li class="list-grid-6"><span class="text-bold">: 28 Februari 2021</span></li>
                        </ul>
                    </li>
                    <li class="list-grid-6">
                        <ul class="page-list">
                            <li class="list-grid-6"><span>Tanggal Selesai</span></li>
                            <li class="list-grid-6"><span class="text-bold">: 12 Maret 2021</span></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="design-thumbnail" style="padding: 5mm 10mm;">
                <table class="table table-bordered text-center">
                    <tbody>
                    <tr>
                        <td>
                            <img class="table-image-fit"
                                 src="{{ asset('print_exports/samples/img/spk/mockup/mockup.png') }}"
                                 alt="Mockup Product">
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="page-footer" style="padding: 0mm 10mm 5mm 10mm;">
            <ul class="page-list">
                <li class="list-grid-4">
                    <div class="address-container">
                        <address class="address-title official-color no-margin-top">PT.Bikin Indonesia Berdaya
                        </address>
                        <address class="address-content">
                            3rd Floor, Grha Environesia Jalan Jati Mataram 248 B,
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
    <div class="main-page no-padding" page-title="note-to-vendor">
        <div class="page-header" style="padding: 10mm 10mm 0;">
            <ul class="page-list">
                <li class="list-grid-4">
                    <div class="document-label" style="padding: 3mm 4mm 3mm 4mm;">
                        <span>SPK Vendor</span><br>
                        <span style="font-size: 10pt">Surat Perintah Kerja</span>
                    </div>
                </li>
                <li class="list-grid-4">
                    <div class="document-info small-padding-left">
                        <h4>No. Order:</h4>
                        <p>BP-1234</p>
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
            <div class="note-to-vendor" style="padding: 5mm 10mm;">
                <p class="text-default text-bold">Catatan Untuk Vendor</p>
                <div class="content-notes default-padding" style="background: #fff4c0">
                    <p class="text-default no-margin-top">1. Ukuran sablon menyesuakan Mockup Halaman 1.</p>
                    <p class="text-default">2. Detail terlampir.</p>
                    <p class="text-default">3. Jahitan rapi dan finishing bersih.</p>
                    <p class="text-default">4. Tepat waktu.</p>
                    <p class="text-default no-margin-bottom">5. Sablon Finishing Doff.</p>
                </div>
            </div>
        </div>
        <div class="page-footer" style="padding: 0mm 10mm 5mm 10mm;">
            <ul class="page-list">
                <li class="list-grid-4">
                    <div class="address-container">
                        <address class="address-title official-color no-margin-top">PT.Bikin Indonesia Berdaya
                        </address>
                        <address class="address-content">
                            3rd Floor, Grha Environesia Jalan Jati Mataram 248 B,
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
    <div class="main-page no-padding" page-title="size-and-quantity">
        <div class="page-header" style="padding: 10mm 10mm 0;">
            <ul class="page-list">
                <li class="list-grid-4">
                    <div class="document-label" style="padding: 3mm 4mm 3mm 4mm;">
                        <span>SPK Vendor</span><br>
                        <span style="font-size: 10pt">Surat Perintah Kerja</span>
                    </div>
                </li>
                <li class="list-grid-4">
                    <div class="document-info small-padding-left">
                        <h4>No. Order:</h4>
                        <p>BP-1234</p>
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
        <div class="page-body" style="padding: 0mm 10mm 5mm 10mm;">
            <div class="size-quantity">
                <p class="text-default text-bold">Size & Quantity</p>
                <table class="page-table table-bordered">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Ukuran</th>
                        <th>Jenis</th>
                        <th>Jumlah</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>1.</td>
                        <td>L</td>
                        <td>Pendek Pria</td>
                        <td>24</td>
                    </tr>
                    <tr>
                        <td>2.</td>
                        <td>4XL</td>
                        <td>Pendek Pria</td>
                        <td>4</td>
                    </tr>
                    <tr>
                        <td>3.</td>
                        <td>M</td>
                        <td>Pendek Pria</td>
                        <td>2</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="page-footer" style="padding: 0mm 10mm 5mm 10mm;">
            <ul class="page-list">
                <li class="list-grid-4">
                    <div class="address-container">
                        <address class="address-title official-color no-margin-top">PT.Bikin Indonesia Berdaya
                        </address>
                        <address class="address-content">
                            3rd Floor, Grha Environesia Jalan Jati Mataram 248 B,
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
    <div class="main-page no-padding" page-title="specification">
        <div class="page-header" style="padding: 10mm 10mm 0;">
            <ul class="page-list">
                <li class="list-grid-4">
                    <div class="document-label" style="padding: 3mm 4mm 3mm 4mm;">
                        <span>SPK Vendor</span><br>
                        <span style="font-size: 10pt">Surat Perintah Kerja</span>
                    </div>
                </li>
                <li class="list-grid-4">
                    <div class="document-info small-padding-left">
                        <h4>No. Order:</h4>
                        <p>BP-1234</p>
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
        <div class="page-body" style="padding: 0mm 10mm 5mm 10mm;">
            <div class="data-material-and-specs">
                <p class="text-default text-bold">Data Material & Spesifikasi</p>
                <table class="page-table table-bordered">
                    <thead>
                    <tr>
                        <th>Material</th>
                        <th>Jenis</th>
                        <th>Model</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>Kain</td>
                        <td>Jenis Kain</td>
                        <td>Cottom Bamboo</td>
                    </tr>
                    <tr>
                        <td>Kain</td>
                        <td>Gramasi Kain</td>
                        <td>24S</td>
                    </tr>
                    <tr>
                        <td>Kain</td>
                        <td>Warna Kain</td>
                        <td>
                            <span class="label default-label">Merah (MB32 - Sritex)</span>
                            <span class="label default-label">Biru (BR32 - Sritex)</span>
                        </td>
                    </tr>
                    <tr>
                        <td>Spesifikasi</td>
                        <td>Jenis Kerah</td>
                        <td>O-Neck</td>
                    </tr>
                    <tr>
                        <td>Spesifikasi</td>
                        <td>Jenis Kain</td>
                        <td>
                            <span class="label default-label">3/4</span>
                            <span class="label default-label">Panjang</span>
                            <span class="label default-label">Pendek</span>
                        </td>
                    </tr>
                    <tr>
                        <td>Spesifikasi</td>
                        <td>Jenis Cuff</td>
                        <td>Standard</td>
                    </tr>
                    <tr>
                        <td>Spesifikasi</td>
                        <td>Jenis Hems</td>
                        <td>Standard</td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="data-material-and-specs">
                <p class="text-default text-bold">Data Aksesoris ( Tambahan )</p>
                <table class="page-table table-bordered">
                    <thead>
                    <tr>
                        <th>Material</th>
                        <th>Jenis</th>
                        <th>Model</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>Kain</td>
                        <td>Jenis Kain</td>
                        <td>Cottom Bamboo</td>
                    </tr>
                    <tr>
                        <td>Kain</td>
                        <td>Gramasi Kain</td>
                        <td>24S</td>
                    </tr>
                    <tr>
                        <td>Kain</td>
                        <td>Warna Kain</td>
                        <td>
                            <span class="label default-label">Merah (MB32 - Sritex)</span>
                            <span class="label default-label">Biru (BR32 - Sritex)</span>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="order-note">
                <p class="text-default text-bold">Daftar Order</p>
                <ul class="page-list">
                    <li class="list-grid-12 default-margin-bottom">
                        <div class="item-list-card default-margin-bottom">
                            <ul class="page-list">
                                <li class="list-grid-12">
                                    <div>
                                        <span class="text-bold">Orderannya yang bagus ya kak, ontime harus! :)</span>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <div class="page-footer" style="padding: 0mm 10mm 5mm 10mm;">
            <ul class="page-list">
                <li class="list-grid-4">
                    <div class="address-container">
                        <address class="address-title official-color no-margin-top">PT.Bikin Indonesia Berdaya
                        </address>
                        <address class="address-content">
                            3rd Floor, Grha Environesia Jalan Jati Mataram 248 B,
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
    <div class="main-page no-padding" page-title="name-and-size">
        <div class="page-header" style="padding: 10mm 10mm 0;">
            <ul class="page-list">
                <li class="list-grid-4">
                    <div class="document-label" style="padding: 3mm 4mm 3mm 4mm;">
                        <span>SPK Vendor</span><br>
                        <span style="font-size: 10pt">Surat Perintah Kerja</span>
                    </div>
                </li>
                <li class="list-grid-4">
                    <div class="document-info small-padding-left">
                        <h4>No. Order:</h4>
                        <p>BP-1234</p>
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
        <div class="page-body" style="padding: 0mm 10mm 5mm 10mm;">
            <div class="design-thumbnail">
                <p class="text-default text-bold">Daftar Nama &amp; Ukuran</p>
                <table class="table table-bordered text-center">
                    <tbody>
                    <tr>
                        <td>
                            <img class="table-image-fit"
                                 src="{{ asset('print_exports/samples/img/spk/detail/nama.png') }}"
                                 alt="Daftar Nama & Ukuran">
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="page-footer" style="padding: 0mm 10mm 5mm 10mm;">
            <ul class="page-list">
                <li class="list-grid-4">
                    <div class="address-container">
                        <address class="address-title official-color no-margin-top">PT.Bikin Indonesia Berdaya
                        </address>
                        <address class="address-content">
                            3rd Floor, Grha Environesia Jalan Jati Mataram 248 B,
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
    <div class="main-page no-padding" page-title="design-product">
        <div class="page-header" style="padding: 10mm 10mm 0;">
            <ul class="page-list">
                <li class="list-grid-4">
                    <div class="document-label" style="padding: 3mm 4mm 3mm 4mm;">
                        <span>SPK Vendor</span><br>
                        <span style="font-size: 10pt">Surat Perintah Kerja</span>
                    </div>
                </li>
                <li class="list-grid-4">
                    <div class="document-info small-padding-left">
                        <h4>No. Order:</h4>
                        <p>BP-1234</p>
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
        <div class="page-body" style="padding: 0mm 10mm 5mm 10mm;">
            <div class="data-material-and-specs">
                <p class="text-default text-bold">Design Produk</p>
                <table class="page-table table-bordered">
                    <thead>
                    <tr>
                        <th>Judul</th>
                        <th>Gambar</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>Design 1 (Depan)</td>
                        <td>
                            <img class="table-image"
                                 src="{{ asset('print_exports/samples/img/spk/mockup/mockup_top.png') }}"
                                 alt="Design 1 (Depan)">
                        </td>
                    </tr>
                    <tr>
                        <td>Design 2 (Belakang)</td>
                        <td>
                            <img class="table-image"
                                 src="{{ asset('print_exports/samples/img/spk/mockup/mockup_bottom.png') }}"
                                 alt="Design 1 (Belakang)">
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="page-footer" style="padding: 0mm 10mm 5mm 10mm;">
            <ul class="page-list">
                <li class="list-grid-4">
                    <div class="address-container">
                        <address class="address-title official-color no-margin-top">PT.Bikin Indonesia Berdaya
                        </address>
                        <address class="address-content">
                            3rd Floor, Grha Environesia Jalan Jati Mataram 248 B,
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
    <div class="main-page no-padding" page-title="design-artwork">
        <div class="page-header" style="padding: 10mm 10mm 0;">
            <ul class="page-list">
                <li class="list-grid-4">
                    <div class="document-label" style="padding: 3mm 4mm 3mm 4mm;">
                        <span>SPK Vendor</span><br>
                        <span style="font-size: 10pt">Surat Perintah Kerja</span>
                    </div>
                </li>
                <li class="list-grid-4">
                    <div class="document-info small-padding-left">
                        <h4>No. Order:</h4>
                        <p>BP-1234</p>
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
        <div class="page-body" style="padding: 0mm 10mm 5mm 10mm;">
            <div class="data-material-and-specs">
                <p class="text-default text-bold">Design Produk</p>
                <table class="page-table table-bordered">
                    <thead>
                    <tr>
                        <th>Posisi</th>
                        <th>Ukuran</th>
                        <th>Material</th>
                        <th>Jumlah Warna</th>
                        <th>Gambar</th>
                        <th>Harga</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>Dada Tengah</td>
                        <td>A4</td>
                        <td>Sablom Rubber</td>
                        <td>10</td>
                        <td>
                            <img class="table-image"
                                 src="https://i.pinimg.com/originals/cd/18/a3/cd18a3cf2212509defd5e43bbf3f266a.png"
                                 alt="Artwork Dada Tengah">
                        </td>
                        <td>Rp. 2,000</td>
                    </tr>
                    <tr>
                        <td>Dada Tengah</td>
                        <td>A6</td>
                        <td>Sablom Rubber</td>
                        <td>10</td>
                        <td>
                            <img class="table-image" src="{{ asset('print_exports/samples/img/design/holland.jpg') }}"
                                 alt="Artwork Dada Tengah">
                        </td>
                        <td>Rp. 2,000</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="page-footer" style="padding: 0mm 10mm 5mm 10mm;">
            <ul class="page-list">
                <li class="list-grid-4">
                    <div class="address-container">
                        <address class="address-title official-color no-margin-top">PT.Bikin Indonesia Berdaya
                        </address>
                        <address class="address-content">
                            3rd Floor, Grha Environesia Jalan Jati Mataram 248 B,
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
    <div class="main-page no-padding" page-title="references">
        <div class="page-header" style="padding: 10mm 10mm 0;">
            <ul class="page-list">
                <li class="list-grid-4">
                    <div class="document-label" style="padding: 3mm 4mm 3mm 4mm;">
                        <span>SPK Vendor</span><br>
                        <span style="font-size: 10pt">Surat Perintah Kerja</span>
                    </div>
                </li>
                <li class="list-grid-4">
                    <div class="document-info small-padding-left">
                        <h4>No. Order:</h4>
                        <p>BP-1234</p>
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
        <div class="page-body" style="padding: 0mm 10mm 5mm 10mm;">
            <div class="data-material-and-specs">
                <p class="text-default text-bold">Referensi Produk</p>
                <table class="page-table table-bordered">
                    <thead>
                    <tr>
                        <th>Referensi</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>
                            <img class="table-image" src="http://i.gzn.jp/img/2018/03/13/coltrane-pitch-diagrams/00.jpg"
                                 alt="Artwork Dada Tengah">
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="data-material-and-specs">
                <p class="text-default text-bold">Referensi Artwork</p>
                <table class="page-table table-bordered">
                    <thead>
                    <tr>
                        <th>Referensi</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>
                            <img class="table-image" src="https://cdn1.productnation.co/stg/sites/5/5eaa9033577ba.jpeg"
                                 alt="Artwork Dada Tengah">
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="page-footer" style="padding: 0mm 10mm 5mm 10mm;">
            <ul class="page-list">
                <li class="list-grid-4">
                    <div class="address-container">
                        <address class="address-title official-color no-margin-top">PT.Bikin Indonesia Berdaya
                        </address>
                        <address class="address-content">
                            3rd Floor, Grha Environesia Jalan Jati Mataram 248 B,
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
    <div class="main-page no-padding" page-title="production-detail">
        <div class="page-header" style="padding: 10mm 10mm 0;">
            <ul class="page-list">
                <li class="list-grid-4">
                    <div class="document-label" style="padding: 3mm 4mm 3mm 4mm;">
                        <span>SPK Vendor</span><br>
                        <span style="font-size: 10pt">Surat Perintah Kerja</span>
                    </div>
                </li>
                <li class="list-grid-4">
                    <div class="document-info small-padding-left">
                        <h4>No. Order:</h4>
                        <p>BP-1234</p>
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
        <div class="page-body" style="padding: 0mm 10mm 5mm 10mm;">
            <div class="design-thumbnail">
                <p class="text-default text-bold">Detail Produksi</p>
                <table class="table table-bordered text-center">
                    <tbody>
                    <tr>
                        <td>
                            <img class="table-image-fit" style="width: 100%!important;"
                                 src="{{ asset('print_exports/samples/img/spk/detail/detail.png') }}"
                                 alt="Detail Produksi">
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="page-footer" style="padding: 0mm 10mm 5mm 10mm;">
            <ul class="page-list">
                <li class="list-grid-4">
                    <div class="address-container">
                        <address class="address-title official-color no-margin-top">PT.Bikin Indonesia Berdaya
                        </address>
                        <address class="address-content">
                            3rd Floor, Grha Environesia Jalan Jati Mataram 248 B,
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
    <div class="main-page no-padding" page-title="artwork-detail">
        <div class="page-header" style="padding: 10mm 10mm 0;">
            <ul class="page-list">
                <li class="list-grid-4">
                    <div class="document-label" style="padding: 3mm 4mm 3mm 4mm;">
                        <span>SPK Vendor</span><br>
                        <span style="font-size: 10pt">Surat Perintah Kerja</span>
                    </div>
                </li>
                <li class="list-grid-4">
                    <div class="document-info small-padding-left">
                        <h4>No. Order:</h4>
                        <p>BP-1234</p>
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
        <div class="page-body" style="padding: 0mm 10mm 5mm 10mm;">
            <div class="design-thumbnail">
                <p class="text-default text-bold">Detail Artwork</p>
                <table class="table table-bordered text-center">
                    <tbody>
                    <tr>
                        <td>
                            <ul class="page-list">
                                <li class="list-grid-6">
                                    <img class="table-image-fit" style="width: 100%!important;"
                                         src="{{ asset('print_exports/samples/img/spk/artwork/artwork.png') }}"
                                         alt="Detail Produksi">
                                </li>
                                <li class="list-grid-6">
                                    <img class="table-image-fit" style="width: 100%!important;"
                                         src="{{ asset('print_exports/samples/img/spk/artwork/artwork.png') }}"
                                         alt="Detail Produksi">
                                </li>
                                <li class="list-grid-6">
                                    <img class="table-image-fit" style="width: 100%!important;"
                                         src="{{ asset('print_exports/samples/img/spk/artwork/artwork.png') }}"
                                         alt="Detail Produksi">
                                </li>
                                <li class="list-grid-6">
                                    <img class="table-image-fit" style="width: 100%!important;"
                                         src="{{ asset('print_exports/samples/img/spk/artwork/artwork.png') }}"
                                         alt="Detail Produksi">
                                </li>
                            </ul>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="page-footer" style="padding: 0mm 10mm 5mm 10mm;">
            <ul class="page-list">
                <li class="list-grid-4">
                    <div class="address-container">
                        <address class="address-title official-color no-margin-top">PT.Bikin Indonesia Berdaya
                        </address>
                        <address class="address-content">
                            3rd Floor, Grha Environesia Jalan Jati Mataram 248 B,
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
    <div class="main-page no-padding" page-title="sizepack">
        <div class="page-header" style="padding: 10mm 10mm 0;">
            <ul class="page-list">
                <li class="list-grid-4">
                    <div class="document-label" style="padding: 3mm 4mm 3mm 4mm;">
                        <span>SPK Vendor</span><br>
                        <span style="font-size: 10pt">Surat Perintah Kerja</span>
                    </div>
                </li>
                <li class="list-grid-4">
                    <div class="document-info small-padding-left">
                        <h4>No. Order:</h4>
                        <p>BP-1234</p>
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
        <div class="page-body" style="padding: 0mm 10mm 5mm 10mm;">
            <div class="design-thumbnail">
                <p class="text-default text-bold">Detail Artwork</p>
                <table class="table table-bordered text-center">
                    <tbody>
                    <tr>
                        <td>
                            <img class="table-image-fit" style="width: 100%!important;"
                                 src="{{ asset('print_exports/samples/img/spk/detail/size_pack.png') }}"
                                 alt="Detail Produksi">
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="page-footer" style="padding: 0mm 10mm 5mm 10mm;">
            <ul class="page-list">
                <li class="list-grid-4">
                    <div class="address-container">
                        <address class="address-title official-color no-margin-top">PT.Bikin Indonesia Berdaya
                        </address>
                        <address class="address-content">
                            3rd Floor, Grha Environesia Jalan Jati Mataram 248 B,
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
    <div class="main-page no-padding" page-title="warna">
        <div class="page-header" style="padding: 10mm 10mm 0;">
            <ul class="page-list">
                <li class="list-grid-4">
                    <div class="document-label" style="padding: 3mm 4mm 3mm 4mm;">
                        <span>SPK Vendor</span><br>
                        <span style="font-size: 10pt">Surat Perintah Kerja</span>
                    </div>
                </li>
                <li class="list-grid-4">
                    <div class="document-info small-padding-left">
                        <h4>No. Order:</h4>
                        <p>BP-1234</p>
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
        <div class="page-body" style="padding: 0mm 10mm 5mm 10mm;">
            <div class="design-thumbnail">
                <p class="text-default text-bold">Detail Artwork</p>
                <table class="table table-bordered text-center">
                    <tbody>
                    <tr>
                        <td>
                            <img class="table-image-fit" style="width: 60%!important;"
                                 src="{{ asset('print_exports/samples/img/spk/detail/warna.png') }}"
                                 alt="Detail Produksi">
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="page-footer" style="padding: 0mm 10mm 5mm 10mm;">
            <ul class="page-list">
                <li class="list-grid-4">
                    <div class="address-container">
                        <address class="address-title official-color no-margin-top">PT.Bikin Indonesia Berdaya
                        </address>
                        <address class="address-content">
                            3rd Floor, Grha Environesia Jalan Jati Mataram 248 B,
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