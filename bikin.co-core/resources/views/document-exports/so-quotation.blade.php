@extends('document-exports.layouts.main')

@section('document.content')
    <div class="main-page" page-title="preambule">
        <div class="page-header">
            <ul class="page-list">
                <li class="list-grid-2">
                    <div class="document-label">Quotation</div>
                </li>
                <li class="list-grid-6">
                    <div class="document-info small-padding-left">
                        <h4>No Quotation :</h4>
                        <p>BP-{{ $orders[0]->id }}</p>
                    </div>
                    <div class="document-info small-padding-left">
                        <h4>Tanggal Terbit :</h4>
                        <p>{{ \Carbon\Carbon::parse($orders[0]->created_at)->locale('id')->isoFormat('LLLL') }}</p>
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
            <div class="quotation-preambule small-margin-bottom">
                <ul class="page-list">
                    <li class="list-grid-4"></li>
                    <li class="list-grid-4"></li>
                    <li class="list-grid-4 text-right">
                        <div class="address-container text-left">
                            <address class="address-title">{{ $customers[0]->fullname }}</address>
                            <address class="address-content">{{ $customers[0]->address }}</address>
                        </div>
                    </li>
                </ul>
                <ul class="page-list" style="margin-bottom: 20mm;">
                    <li class="list-grid-12">
                        <p class="text-default">Yth, {{ $customers[0]->fullname }},</p>
                        <p class="text-default text-indent text-justify">Bersama dengan surat ini kami dari <strong>PT
                                BIKIN INDONESIA BERDAYA</strong> ingin mengajukan penawaran pembuatan produk. Maka
                            dengan ini kami kirimkan penawaran tersebut denaan rincian dan spesifikasi terlampir.</p>
                        <p class="text-default text-indent text-justify">Demikian surat penawaran ini kami sampaikan.
                            Besar harapan kami dapat terjalinnya hubungan yang baik antar <strong>PT BIKIN INDONESIA
                                BERDAYA</strong> dengan perusahaan/instansi Ibu. Atas perhatiannya kami ucapkan terima
                            kasih.</p>
                    </li>
                </ul>
                <ul class="page-list">
                    <li class="list-grid-4"></li>
                    <li class="list-grid-4"></li>
                    <li class="list-grid-4 text-right">
                        <div class="address-container text-left">
                            <address class="address-title signature-content">
                                <span
                                    class="small-margin-bottom">Yogyakarta, {{ \Carbon\Carbon::parse($orders[0]->created_at)->locale('id')->isoFormat('LLLL') }}</span><br><br>
                                <span>PT. Bikin Indonesia Berdaya</span>
                            </address>
                            <address class="address-content">
                                <span class="text-bold underlined">Ahmad Faiq</span><br>
                                <span>Head Of Sales</span>
                            </address>
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
    <div class="main-page" page-title="order-summary">
        <div class="page-header">
            <ul class="page-list">
                <li class="list-grid-2">
                    <div class="document-label">Quotation</div>
                </li>
                <li class="list-grid-6">
                    <div class="document-info small-padding-left">
                        <h4>No Quotation :</h4>
                        <h4>BP-{{ $orders[0]->id }}</h4>
                    </div>
                    <div class="document-info small-padding-left">
                        <h3>Ringkasan Order</h3>
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
            <div class="customer-info">
                <p class="text-default text-bold">Informasi Customer</p>
                <ul class="page-list">
                    <li class="list-grid-6">
                        <div class="default-margin-bottom">
                            <span class="text-bold">Nama Pelanggan</span><br>
                            <span>{{ $customers[0]->fullname }}</span>
                        </div>
                    </li>
                    <li class="list-grid-6">
                        <div class="default-margin-bottom">
                            <span class="text-bold">Provinsi</span><br>
                            <span>{{ $province[0]->name }}</span>
                        </div>
                    </li>
                    <li class="list-grid-6">
                        <div class="default-margin-bottom">
                            <span class="text-bold">Email</span><br>
                            <span>{{ $customers[0]->email }}</span>
                        </div>
                    </li>
                    <li class="list-grid-6">
                        <div class="default-margin-bottom">
                            <span class="text-bold">No Telepon</span><br>
                            <span>{{ $customers[0]->mobile_phone }}</span>
                        </div>
                    </li>
                </ul>
            </div>
            <hr class="line-separator">
            <div class="order-list">
                <p class="text-default text-bold">Daftar Order</p>
                <ul class="page-list">
                    <li class="list-grid-12 default-margin-bottom">
                        @foreach($order_items as $key => $item)
                            <div class="item-list-card default-margin-bottom">
                                <ul class="page-list">
                                    <li class="list-grid-4">
                                        <div>
                                            <span class="text-bold">{{ $products[0]->name }}</span><br>
                                        </div>
                                    </li>
                                    <li class="list-grid-4 text-center">
                                        <div>
                                            <span>{{ $orders[$key]->total_item }} pcs</span>
                                        </div>
                                    </li>
                                    <li class="list-grid-4 text-right">
                                        <div>
                                            <span>{{ formatRupiah($orders[$key]->total_amount) }}</span>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        @endforeach
                        <div class="item-list-card summary-sub-item">
                            <ul class="page-list">
                                <li class="list-grid-6">
                                    <div>
                                        <span class="text-bold">Subtotal Produk</span>
                                    </div>
                                </li>
                                <li class="list-grid-6 text-right">
                                    <div>
                                        <span>{{ formatRupiah($orders[$key]->total_amount) }}</span>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
            <hr class="line-separator">
            @if(!$order_adjust_price->isEmpty())
                <div class="additional-price">
                    <p class="text-default text-bold">Biaya Tambahan</p>
                    <ul class="page-list">
                        <li class="list-grid-12 default-margin-bottom">
                            @php  $total_adjust_price = [];  @endphp
                            @foreach($order_adjust_price as $key => $item)
                                <div class="item-list-card default-margin-bottom">
                                    <ul class="page-list">
                                        <li class="list-grid-4">
                                            <div>
                                                <span class="text-bold">{{ $item->note }}</span><br>
                                                <span>{{ $products[0]->name }}</span>
                                            </div>
                                        </li>
                                        <li class="list-grid-4 text-center">
                                            <div>
                                                <span>&nbsp;</span>
                                            </div>
                                        </li>
                                        <li class="list-grid-4 text-right">
                                            <div>
                                                <span>{{ formatRupiah($item->adjust_amount) }}</span>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                @php array_push($total_adjust_price, $item->adjust_amount) @endphp
                            @endforeach
                            <div class="item-list-card summary-sub-item">
                                <ul class="page-list">
                                    <li class="list-grid-6">
                                        <div>
                                            <span class="text-bold">Subtotal Biaya Tambahan</span>
                                        </div>
                                    </li>
                                    <li class="list-grid-6 text-right">
                                        <div>
                                            <span>{{ formatRupiah(array_sum($total_adjust_price)) }}</span>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
                <hr class="line-separator">
            @endif
            <div class="total-order">
                <ul class="page-list">
                    <li class="list-grid-12 default-margin-bottom">
                        <div class="item-list-card summary-item small-margin-top">
                            <ul class="page-list">
                                <li class="list-grid-6">
                                    <div>
                                        <span class="text-bold">Total Order</span>
                                    </div>
                                </li>
                                <li class="list-grid-6 text-right">
                                    <div>
                                        <span>{{ formatRupiah(($orders[0]->total_amount + array_sum($total_adjust_price))) }}</span>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
            <p class="text-default">* Harga di atas belum termasuk biaya pengiriman</p>
        </div>
    </div>
    <div class="main-page" page-title="specification">
        <div class="page-header">
            <ul class="page-list">
                <li class="list-grid-2">
                    <div class="document-label">Quotation</div>
                </li>
                <li class="list-grid-6">
                    <div class="document-info small-padding-left">
                        <h4>No Quotation :</h4>
                        <h4>BP-{{ $orders[0]->id }}</h4>
                    </div>
                    <div class="document-info small-padding-left">
                        <h3>Spesifikasi</h3>
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
            <div class="product-specificaton">
                <div>
                    <span class="text-default text-bold">{{ $products[0]->name }}</span><br>
                </div>
                <div class="product-information">
                    <p class="text-default text-bold">Informasi Produk</p>
                    <ul class="page-list">
                        <li class="list-grid-4">
                            <div class="list-with-icon">
                                <ul class="page-list">
                                    <li class="list-grid-2"><span class="lni lni-tag icon-separator"></span></li>
                                    <li class="list-grid-10" style="padding-left: 2mm;">
                                        <div>
                                            <span>Label</span><br>
                                            @if($order_items[0]->is_custom_label == 1)
                                                <span class="text-default text-bold">Custom Label</span>
                                            @endif
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="list-grid-4">
                            <div class="list-with-icon">
                                <ul class="page-list">
                                    <li class="list-grid-2"><span class="lni lni-package icon-separator"></span></li>
                                    <li class="list-grid-10" style="padding-left: 2mm;">
                                        <div>
                                            <span>Packaging</span><br>
                                            @if($order_items[0]->is_repackaging == 1)
                                                <span class="text-default text-bold">Custom Packaging</span>
                                            @endif
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="list-grid-4">
                            <div class="list-with-icon">
                                <ul class="page-list">
                                    <li class="list-grid-2"><span class="lni lni-drop icon-separator"></span></li>
                                    <li class="list-grid-10" style="padding-left: 2mm;">
                                        <div>
                                            <span>Washing</span><br>
                                            @if($order_items[0]->is_washing == 1)
                                                <span class="text-default text-bold">Ya ( washing_name )</span>
                                            @endif
                                            @if($order_items[0]->is_washing == 0)
                                                <span class="text-default text-bold">Tidak</span>
                                            @endif
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
                <hr class="line-separator">
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
                        {{--                        <tr>--}}
                        {{--                            <td>Kain</td>--}}
                        {{--                            <td>Warna Kain</td>--}}
                        {{--                            <td>--}}
                        {{--                                <span class="label default-label">Merah (MB32 - Sritex)</span>--}}
                        {{--                                <span class="label default-label">Biru (BR32 - Sritex)</span>--}}
                        {{--                            </td>--}}
                        {{--                        </tr>--}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="page-footer">
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
    @if(!$accessories->isEmpty() || !empty($order_items[0]->note))
        <div class="main-page" page-title="specification-continue">
            <div class="page-header">
                <ul class="page-list">
                    <li class="list-grid-2">
                        <div class="document-label">Quotation</div>
                    </li>
                    <li class="list-grid-6">
                        <div class="document-info small-padding-left">
                            <h4>No Quotation :</h4>
                            <h4>{{ $orders[0]->id }}</h4>
                        </div>
                        <div class="document-info small-padding-left">
                            <h3>Spesifikasi</h3>
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
                <div class="product-specificaton">
                    <div>
                        <span class="text-default text-bold">{{ $products[0]->name }}</span><br>
                    </div>
                    @if(!$accessories->isEmpty())
                        <div class="data-material-and-specs">
                            <p class="text-default text-bold">Data Aksesoris ( Tambahan )</p>
                            <table class="page-table table-bordered">
                                <thead>
                                <tr style="background-color: lightgrey;">
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
                </div>
                @if(!empty($order_items[0]->note))
                    <div class="order-note">
                        <p class="text-default text-bold">Catatan Order</p>
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
            <div class="page-footer">
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
    @if(!$designs->isEmpty())
        <div class="main-page" page-title="product-design">
            <div class="page-header">
                <ul class="page-list">
                    <li class="list-grid-2">
                        <div class="document-label">Quotation</div>
                    </li>
                    <li class="list-grid-6">
                        <div class="document-info small-padding-left">
                            <h4>No Quotation :</h4>
                            <h4>BP-{{ $orders[0]->id }}</h4>
                        </div>
                        <div class="document-info small-padding-left">
                            <h3>Desain & Artwork</h3>
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
                <div class="product-specificaton">
                    <div>
                        <span class="text-default text-bold">{{ $products[0]->name }}</span><br>
                    </div>
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
            </div>
            <div class="page-footer">
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
        <div class="main-page" page-title="artwork-design">
            <div class="page-header">
                <ul class="page-list">
                    <li class="list-grid-2">
                        <div class="document-label">Quotation</div>
                    </li>
                    <li class="list-grid-6">
                        <div class="document-info small-padding-left">
                            <h4>No Quotation :</h4>
                            <h4>BP-{{ $orders[0]->id }}</h4>
                        </div>
                        <div class="document-info small-padding-left">
                            <h3>Desain & Artwork</h3>
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
                <div class="product-specificaton">
                    <div>
                        <span class="text-default text-bold">{{ $products[0]->name }}</span><br>
                    </div>
                    <div class="data-material-and-specs">
                        <p class="text-default text-bold">Design Produk</p>
                        <table class="page-table table-bordered">
                            <thead>
                            <tr>
                                <th>Posisi</th>
                                <th>Ukuran</th>
                                <th>Material</th>
                                <th>Metode Cetak</th>
                                <th>Jumlah Warna</th>
                                <th>Gambar</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($artworks as $key => $item)
                                <tr>
                                    <td>{{ $artwork_pos[$key][0]->name }}</td>
                                    <td>{{ $artwork_size[$key][0]->size }}</td>
                                    <td>{{ $artwork_print[$key][0]->name }}</td>
                                    <td>{{ $artwork_method[$key][0]->name }}</td>
                                    <td>{{ $item->color_qty }}</td>
                                    <td><img class="table-image" src="{{ asset($item->preview_image) }}"
                                             alt="Artwork {{ $artwork_pos[$key][0]->name }}">
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="page-footer">
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
        <div class="main-page" page-title="product-artwork-reference">
            <div class="page-header">
                <ul class="page-list">
                    <li class="list-grid-2">
                        <div class="document-label">Quotation</div>
                    </li>
                    <li class="list-grid-6">
                        <div class="document-info small-padding-left">
                            <h4>No Quotation :</h4>
                            <h4>BP-{{ $orders[0]->id }}</h4>
                        </div>
                        <div class="document-info small-padding-left">
                            <h3>Referensi Produk dan Artwork</h3>
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
                <div class="product-specificaton">
                    <div>
                        <span class="text-default text-bold">{{ $products[0]->name }}</span><br>
                    </div>
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
                    {{--                    <div class="data-material-and-specs">--}}
                    {{--                        <p class="text-default text-bold">Referensi Artwork</p>--}}
                    {{--                        <table class="page-table table-bordered">--}}
                    {{--                            <thead>--}}
                    {{--                            <tr>--}}
                    {{--                                <th>Referensi</th>--}}
                    {{--                            </tr>--}}
                    {{--                            </thead>--}}
                    {{--                            <tbody>--}}
                    {{--                            <tr>--}}
                    {{--                                <td>--}}
                    {{--                                    <img class="table-image"--}}
                    {{--                                         src="https://cdn1.productnation.co/stg/sites/5/5eaa9033577ba.jpeg"--}}
                    {{--                                         alt="Artwork Dada Tengah">--}}
                    {{--                                </td>--}}
                    {{--                            </tr>--}}
                    {{--                            </tbody>--}}
                    {{--                        </table>--}}
                    {{--                    </div>--}}
                </div>
            </div>
            <div class="page-footer">
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
    <div class="main-page" page-title="terms-condition">
        <div class="page-header">
            <ul class="page-list">
                <li class="list-grid-2">
                    <div class="document-label">Quotation</div>
                </li>
                <li class="list-grid-6">
                    <div class="document-info small-padding-left">
                        <h4>No Quotation :</h4>
                        <h4>BP-1234</h4>
                    </div>
                    <div class="document-info small-padding-left">
                        <h3>Syarat & Ketentuan</h3>
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
            <div class="terms-conditions">
                <p class="text-default text-bold no-margin-bottom">Order :</p>
                <p class="text-default text-bold no-margin-top official-color">Pemesanan :</p>
            </div>
            <ul class="page-list">
                <li class="list-grid-12">
                    <ul class="page-list">
                        <li class="list-grid-1">1.</li>
                        <li class="list-grid-11">
                            <p class="text-default no-margin small-margin-bottom">
                                Bikin.co facilitate free redesign services to ensure maximum customer design by first
                                providing an advance payment of 50%.
                            </p>
                            <p class="text-default official-color no-margin-top">
                                Bikin.co memfasilitasi jasa desain ulang gratis untuk memastikan desain customer
                                maksimal dengan terlebih dahulu memberikan pembayaran uang muka 50%.
                            </p>
                        </li>
                    </ul>
                </li>
                <li class="list-grid-12">
                    <ul class="page-list">
                        <li class="list-grid-1">2.</li>
                        <li class="list-grid-11">
                            <p class="text-default no-margin small-margin-bottom">
                                ...
                            </p>
                            <p class="text-default official-color no-margin-top">
                                ...
                            </p>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
        <div class="page-footer">
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
