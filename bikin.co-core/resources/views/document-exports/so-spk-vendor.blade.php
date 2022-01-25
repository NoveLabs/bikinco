@extends('document-exports.layouts.main')

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
                        <p>BP-{{ $orders[0]->id }}</p>
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
                            <li class="list-grid-6"><span class="text-bold">: {{ $vendors[0]->vendor_name }}</span></li>
                        </ul>
                    </li>
                    <li class="list-grid-6">
                        <ul class="page-list">
                            <li class="list-grid-6"><span>No Telepon</span></li>
                            <li class="list-grid-6"><span class="text-bold">: {{ $vendors[0]->contact }}</span></li>
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
                            <li class="list-grid-6"><span class="text-bold">: {{ $products[0]->name }}</span></li>
                        </ul>
                    </li>
                    <li class="list-grid-6">
                        <ul class="page-list">
                            <li class="list-grid-6"><span>Tanggal Masuk</span></li>
                            <li class="list-grid-6"><span
                                    class="text-bold">: {{ \Illuminate\Support\Carbon::parse($order_items[0]->vendor_mou_date)->locale('id')->translatedFormat('l, d F Y') }}</span>
                            </li>
                        </ul>
                    </li>
                    <li class="list-grid-6">
                        <ul class="page-list">
                            <li class="list-grid-6"><span>Tanggal Selesai</span></li>
                            <li class="list-grid-6"><span
                                    class="text-bold">: {{ \Illuminate\Support\Carbon::parse($order_items[0]->vendor_mou_completed_date)->locale('id')->translatedFormat('l, d F Y') }}</span>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="design-thumbnail" style="padding: 5mm 10mm;">
                <table class="table table-bordered text-center">
                    <tbody>
                    <tr>
                        <td>
                            @if(!$designs->isEmpty())
                                <img class="table-image-fit"
                                     src="{{ asset($designs[0]->photo) }}"
                                     alt="{{ $designs[0]->title }}">
                            @else
                                <img class="table-image-fit"
                                     src="{{ asset($custom_design[0]->photo) }}"
                                     alt="{{ $custom_design[0]->title }}">
                            @endif
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
                        <p>BP-{{ $orders[0]->id }}</p>
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
                        <p>BP-{{ $orders[0]->id }}</p>
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
                    @foreach($order_item_sizes as $key => $item)
                        <tr>
                            <td>{{ $key + 1 }}.</td>
                            <td>{{ $sizes[$key][0]->name }}</td>
                            <td>{{ $size_types[$key][0]->name }}</td>
                            <td>{{ $item->qty }}</td>
                        </tr>
                    @endforeach
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
                        <p>BP-{{ $orders[0]->id }}</p>
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
                    @foreach($materials as $key => $item)
                        <tr>
                            <td>{{ $material_data[$key][0]->name }}</td>
                            <td>{{ $material_item[$key][0]->name }}</td>
                            <td>{{ !empty($material_color[$key][0]->name) ? $material_color[$key][0]->name : '-' }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            @if(!$accessories->isEmpty())
                <div class="data-material-and-specs">
                    <p class="text-default text-bold">Data Aksesoris ( Tambahan )</p>
                    <table class="page-table table-bordered">
                        <thead>
                        <tr>
                            <th>Kategori Aksesori</th>
                            <th>Spesifikasi Aksesori</th>
                            <th>Catatan</th>
                            <th>Biaya Tambahan</th>
                            <th>Jumlah Qty</th>
                            <th>Subtotal</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($accessories as $key => $item)
                            <tr>
                                <td>{{ $accessories_spec_name[$key][0]->name }}</td>
                                <td>{{ $accessories_name[$key][0]->name }}</td>
                                <td>{{ $item->note }}</td>
                                <td>{{ formatRupiah($item->amount) }}/ Item</td>
                                <td>{{ $item->qty }}</td>
                                <td>{{ formatRupiah(($item->qty * $item->amount)) }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
            @if(!empty($order_items[0]->note))
                <div class="order-note">
                    <p class="text-default text-bold">Daftar Order</p>
                    <ul class="page-list">
                        <li class="list-grid-12 default-margin-bottom">
                            <div class="item-list-card default-margin-bottom">
                                <ul class="page-list">
                                    <li class="list-grid-12">
                                        <div>
                                            <span class="text-bold">{{ $order_items[0]->note }}</span>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            @endif
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
    {{--    <div class="main-page no-padding" page-title="name-and-size">--}}
    {{--        <div class="page-header" style="padding: 10mm 10mm 0;">--}}
    {{--            <ul class="page-list">--}}
    {{--                <li class="list-grid-4">--}}
    {{--                    <div class="document-label" style="padding: 3mm 4mm 3mm 4mm;">--}}
    {{--                        <span>SPK Vendor</span><br>--}}
    {{--                        <span style="font-size: 10pt">Surat Perintah Kerja</span>--}}
    {{--                    </div>--}}
    {{--                </li>--}}
    {{--                <li class="list-grid-4">--}}
    {{--                    <div class="document-info small-padding-left">--}}
    {{--                        <h4>No. Order:</h4>--}}
    {{--                        <p>BP-{{ $orders[0]->id }}</p>--}}
    {{--                    </div>--}}
    {{--                </li>--}}
    {{--                <li class="list-grid-4">--}}
    {{--                    <div class="document-info text-right">--}}
    {{--                        <img class="header-image"--}}
    {{--                             src="{{ asset('print_exports/samples/img/logo/company_logo.png') }}"--}}
    {{--                             alt="Bikin.co Company Logo">--}}
    {{--                    </div>--}}
    {{--                </li>--}}
    {{--            </ul>--}}
    {{--        </div>--}}
    {{--        <div class="page-body" style="padding: 0mm 10mm 5mm 10mm;">--}}
    {{--            <div class="design-thumbnail">--}}
    {{--                <p class="text-default text-bold">Daftar Nama &amp; Ukuran</p>--}}
    {{--                <table class="table table-bordered text-center">--}}
    {{--                    <tbody>--}}
    {{--                    <tr>--}}
    {{--                        <td>--}}
    {{--                            <img class="table-image-fit"--}}
    {{--                                 src="{{ asset('print_exports/samples/img/spk/detail/nama.png') }}"--}}
    {{--                                 alt="Daftar Nama & Ukuran">--}}
    {{--                        </td>--}}
    {{--                    </tr>--}}
    {{--                    </tbody>--}}
    {{--                </table>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--        <div class="page-footer" style="padding: 0mm 10mm 5mm 10mm;">--}}
    {{--            <ul class="page-list">--}}
    {{--                <li class="list-grid-4">--}}
    {{--                    <div class="address-container">--}}
    {{--                        <address class="address-title official-color no-margin-top">PT.Bikin Indonesia Berdaya--}}
    {{--                        </address>--}}
    {{--                        <address class="address-content">--}}
    {{--                            3rd Floor, Grha Environesia Jalan Jati Mataram 248 B,--}}
    {{--                            Sleman, D.I. Yogyakarta, 55582, Indonesia--}}
    {{--                        </address>--}}
    {{--                    </div>--}}
    {{--                </li>--}}
    {{--                <li class="list-grid-4 small-padding-left">--}}
    {{--                    <ul class="page-list">--}}
    {{--                        <li class="list-grid-12">--}}
    {{--                            <ul class="page-list">--}}
    {{--                                <li class="list-grid-1 official-color"><span class="lni lni-phone"></span></li>--}}
    {{--                                <li class="list-grid-11">--}}
    {{--                                    <div class="footer-content">--}}
    {{--                                        <span>+62 274 88 0603 (Ext.4)</span><br>--}}
    {{--                                        <span>+62 852 8888 6020</span>--}}
    {{--                                    </div>--}}
    {{--                                </li>--}}
    {{--                            </ul>--}}
    {{--                        </li>--}}
    {{--                        <li class="list-grid-12">--}}
    {{--                            <ul class="page-list">--}}
    {{--                                <li class="list-grid-1 official-color"><span class="lni lni-envelope"></span></li>--}}
    {{--                                <li class="list-grid-11">--}}
    {{--                                    <div class="footer-content">--}}
    {{--                                        <span>info@bikin.co</span>--}}
    {{--                                    </div>--}}
    {{--                                </li>--}}
    {{--                            </ul>--}}
    {{--                        </li>--}}
    {{--                        <li class="list-grid-12">--}}
    {{--                            <ul class="page-list">--}}
    {{--                                <li class="list-grid-1 official-color"><span class="lni lni-world"></span></li>--}}
    {{--                                <li class="list-grid-11">--}}
    {{--                                    <div class="footer-content">--}}
    {{--                                        <span>www.bikin.co</span>--}}
    {{--                                    </div>--}}
    {{--                                </li>--}}
    {{--                            </ul>--}}
    {{--                        </li>--}}
    {{--                    </ul>--}}
    {{--                </li>--}}
    {{--                <li class="list-grid-4"></li>--}}
    {{--            </ul>--}}
    {{--        </div>--}}
    {{--    </div>--}}
    @if(!$designs->isEmpty())
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
                            <p>BP-{{ $orders[0]->id }}</p>
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
                        @foreach($designs as $item)
                            <tr>
                                <td>{{ $item->title }}</td>
                                <td><img class="table-image" src="{{ asset($item->photo) }}"
                                         alt="{{ $item->title }}"></td>
                            </tr>
                        @endforeach
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
    @endif
    @if(!$artworks->isEmpty())
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
                            <p>BP-{{ $orders[0]->id }}</p>
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
                    <p class="text-default text-bold">Artwork Produk</p>
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
                        @foreach($artworks as $key => $item)
                            <tr>
                                <td>{{ $artwork_pos[$key][0]->name }}</td>
                                <td>{{ $artwork_size[$key][0]->size }}</td>
                                <td>{{ $artwork_print[$key][0]->name }}</td>
                                <td>10</td>
                                <td><img class="table-image" src="{{ asset($item->preview_image) }}"
                                         alt="Artwork {{ $artwork_pos[$key][0]->name }}"></td>
                                <td>{{ formatRupiah($item->amount) }}</td>
                            </tr>
                        @endforeach
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
    @endif
    @if(!$custom_artworks->isEmpty())
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
                            <p>BP-{{ $orders[0]->id }}</p>
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
                            <th>Judul</th>
                            <th>Referensi</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($custom_artworks as $item)
                            <tr>
                                <td>{{ $item->title }}</td>
                                <td>
                                    <img class="table-image"
                                         style="height: 320px;width: auto!important;"
                                         src="{{ asset($item->preview_image) }}"
                                         alt="Artwork Referensi - {{ $item->title }}">
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                {{--                <div class="data-material-and-specs">--}}
                {{--                    <p class="text-default text-bold">Referensi Artwork</p>--}}
                {{--                    <table class="page-table table-bordered">--}}
                {{--                        <thead>--}}
                {{--                        <tr>--}}
                {{--                            <th>Referensi</th>--}}
                {{--                        </tr>--}}
                {{--                        </thead>--}}
                {{--                        <tbody>--}}
                {{--                        <tr>--}}
                {{--                            <td>--}}
                {{--                                <img class="table-image" src="https://cdn1.productnation.co/stg/sites/5/5eaa9033577ba.jpeg"--}}
                {{--                                     alt="Artwork Dada Tengah">--}}
                {{--                            </td>--}}
                {{--                        </tr>--}}
                {{--                        </tbody>--}}
                {{--                    </table>--}}
                {{--                </div>--}}
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
    @endif
    @if(!$sizepacks->isEmpty())
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
                            <p>BP-{{ $orders[0]->id }}</p>
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
                    <p class="text-default text-bold">Sizepack</p>
                    <table class="table table-bordered text-center">
                        <tbody>
                        <tr>
                            <td>
                                <img class="table-image-fit" style="width: 100%!important;"
                                     src="{{ asset($sizepacks[0]->file) }}"
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
    @endif
    @if(!$artworks->isEmpty())
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
                            <p>BP-{{ $orders[0]->id }}</p>
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
                                    @foreach($artworks as $key => $item)
                                        <li class="list-grid-6">
                                            <img class="table-image-fit" style="width: 100%!important;"
                                                 src="{{ asset($item->preview_image) }}"
                                                 alt="Detail Produksi">
                                        </li>
                                    @endforeach
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
    @endif
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
                        <p>BP-{{ $orders[0]->id }}</p>
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
                <p class="text-default text-bold">Warna</p>
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
