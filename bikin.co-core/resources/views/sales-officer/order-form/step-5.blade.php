@extends('layouts.app')

@section('content')
    <div id="sc-page-wrapper">
        <div id="sc-page-top-bar" class="sc-top-bar">
            <div class="sc-top-bar-content uk-flex uk-flex-middle uk-width-1-1">
                <ul class="uk-breadcrumb uk-margin-remove uk-flex uk-flex-middle">
                    <li>
                        <a href="so-beranda.html">
                            <i class="mdi mdi-home"></i>
                        </a>
                    </li>
                    <li>
                        <a href="so-product-order-waiting-customer.html">
                            Order Produk
                        </a>
                    </li>
                    <li>
                        <a href="so-product-order-create.html">
                            Form Input Order 1 dari 5
                        </a>
                    </li>
                    <li>
                        <a href="so-product-order-create-2.html">
                            2 dari 5
                        </a>
                    </li>
                    <li>
                        <a href="so-product-order-create-3.html">
                            3 dari 5
                        </a>
                    </li>
                    <li>
                        <a href="so-product-order-create-4.html">
                            4 dari 5
                        </a>
                    </li>
                    <li>
                        <span>5 dari 5</span>
                    </li>
                </ul>
            </div>
        </div>
        <div id="sc-page-content">
            <div class="uk-flex-center uk-grid-small" data-uk-grid>
                <div class="uk-width-4-5@l">
                    <div class="uk-flex uk-flex-middle uk-margin-bottom md-bg-blue-grey-600 sc-round sc-padding sc-padding-medium-ends">
                        <span data-uk-icon="icon: cart; ratio: 1.5" class="uk-margin-right md-color-white"></span>
                        <h4 class="md-color-white uk-margin-remove">Preview & FOC (5/5)</h4>
                    </div>
                    <div class="uk-fieldset uk-fieldset-alt md-bg-white">
                        <div class="uk-card-body">
                            <form action="" method="" id="form-step-5">
                                <div class="uk-accordion-content">
                                    <h5>Informasi Pelanggan</h5>
                                    <ul class="uk-list custom-inline-list">
                                        <li class="sc-list-group">
                                            <div class="sc-list-body">
                                                <p class="uk-margin-remove sc-text-semibold">Nama Pelanggan</p>
                                                <span
                                                    class="sc-list-secondary-text"> {{ $customers[0]->fullname }} </span>
                                            </div>
                                        </li>
                                        <li class="sc-list-group">
                                            <div class="sc-list-body">
                                                <p class="uk-margin-remove sc-text-semibold">Provinsi</p>
                                                <span class="sc-list-secondary-text">{{ $province[0]->name }}</span>
                                            </div>
                                        </li>
                                        <li class="sc-list-group">
                                            <div class="sc-list-body">
                                                <p class="uk-margin-remove sc-text-semibold">Email</p>
                                                <span class="sc-list-secondary-text">{{ $customers[0]->email }}</span>
                                            </div>
                                        </li>
                                        <li class="sc-list-group">
                                            <div class="sc-list-body">
                                                <p class="uk-margin-remove sc-text-semibold">No. Telepon</p>
                                                <span
                                                    class="sc-list-secondary-text">{{ $customers[0]->mobile_phone }}</span>
                                            </div>
                                        </li>
                                    </ul>
                                    <hr>
                                    <h5>Informasi Jumlah Order</h5>
                                    <ul class="uk-list custom-inline-list">
                                        <li class="sc-list-group">
                                            <table class="custom-table-1">
                                                <tr>
                                                    <th>No.</th>
                                                    <th>Ukuran</th>
                                                    <th>Jenis</th>
                                                    <th>Jumlah</th>
                                                </tr>
                                                @foreach($order_item_sizes as $key => $item)
                                                    <tr>
                                                        <td>{{ $key + 1 }}</td>
                                                        <td>{{ $sizes[$key][0]->name }}</td>
                                                        <td>{{ $size_types[$key][0]->name }}</td>
                                                        <td>{{ $item->qty }}</td>
                                                    </tr>
                                                @endforeach
                                                <tr style="background-color: lightgray;">
                                                    <td colspan="3">Total Kuantitas Order</td>
                                                    <td><strong>{{ $orders[0]->total_item }}</strong></td>
                                                </tr>
                                            </table>
                                        </li>
                                    </ul>
                                    <hr>
                                    <h5>Informasi Jenis Order</h5>
                                    <ul class="uk-list custom-inline-list">
                                        <li class="sc-list-group">
                                            <div class="sc-list-body">
                                                <p class="uk-margin-remove sc-text-semibold">Customer -> Bikin.co</p>
                                                <span
                                                    class="sc-list-secondary-text">{{ $customer_mou[0]['name'] }}</span>
                                            </div>
                                        </li>
                                        <li class="sc-list-group">
                                            <div class="sc-list-body">
                                                <p class="uk-margin-remove sc-text-semibold">Bikin.co -> Vendor</p>
                                                <span
                                                    class="sc-list-secondary-text">{{ $provider_mou[0]['name'] }}</span>
                                            </div>
                                        </li>
                                        <li class="sc-list-group">
                                            <div class="sc-list-body">
                                                <p class="uk-margin-remove sc-text-semibold">Size Pack</p>
                                                <span class="sc-list-secondary-text">{{ $sizepacks[0]->vendor_name }} Sizepack <br><a
                                                        target="_blank"
                                                        href="{{ $sizepacks[0]->file }}"> >> Download</a></span>
                                            </div>
                                        </li>
                                        @if(!empty($artworks))
                                            <li class="sc-list-group">
                                                <div class="sc-list-body">
                                                    <p class="uk-margin-remove sc-text-semibold">Label</p>
                                                    @if($order_items[0]->is_custom_label == 2)
                                                        <span class="sc-list-secondary-text">Label dari brand sendiri. Desain sudaha ada <br><a
                                                                target="_blank"
                                                                href="{{ $order_items[0]->label_photo }}"> >> Download</a></span>
                                                    @endif
                                                    @if($order_items[0]->is_custom_label == 0)
                                                        <span class="sc-list-secondary-text">Tanpa Label</span>
                                                    @endif
                                                    @if($order_items[0]->is_custom_label == 1)
                                                        <span class="sc-list-secondary-text">Label Dari Bikin.co</span>
                                                    @endif
                                                </div>
                                            </li>
                                            <li class="sc-list-group">
                                                <div class="sc-list-body">
                                                    <p class="uk-margin-remove sc-text-semibold">Packaging</p>
                                                    @if($order_items[0]->is_repackaging == 1)
                                                        <span class="sc-list-secondary-text">{{ $order_items[0]->packaging_note }}<br><a
                                                                target="_blank"
                                                                href="{{ $order_items[0]->packaging_photo }}"> >> Download</a></span>
                                                    @endif
                                                    @if($order_items[0]->is_repackaging == 0)
                                                        <span class="sc-list-secondary-text">Packaging Standar</span>
                                                    @endif
                                                </div>
                                            </li>
                                        @endif
                                    </ul>
                                    <hr>
                                    <h5>Informasi Desain & Artwork</h5>
                                    <ul class="uk-list">
                                        @if(!$designs->isEmpty())
                                            <li class="sc-list-group">
                                                <div class="sc-list-body">
                                                    <p class="uk-margin-remove sc-text-semibold">Data desain & mockup
                                                        produk</p> <br>
                                                    <table class="custom-table-1">
                                                        <tr>
                                                            <th>Judul</th>
                                                            <th>Gambar</th>
                                                        </tr>
                                                        @foreach($designs as $item)
                                                            <tr>
                                                                <td>{{ $item->title }}</td>
                                                                <td><img src="{{ $item->photo }}"
                                                                         alt="{{ $item->title }}"></td>
                                                            </tr>
                                                        @endforeach
                                                    </table>
                                                </div>
                                            </li>
                                        @endif
                                        @if(!$artworks->isEmpty())
                                            <li class="sc-list-group">
                                                <div class="sc-list-body">
                                                    <p class="uk-margin-remove sc-text-semibold">Data Artwork</p> <br>
                                                    <table class="custom-table-1">
                                                        <tr>
                                                            <th>Posisi</th>
                                                            <th>Ukuran</th>
                                                            <th>Material</th>
                                                            <th>Metode Cetak</th>
                                                            <th>Jumlah Warna</th>
                                                            <th>Preview</th>
                                                            <th>Vector</th>
                                                        </tr>
                                                        @foreach($artworks as $key => $item)
                                                            <tr>
                                                                <td>{{ $artwork_pos[$key][0]->name }}</td>
                                                                <td>{{ $artwork_size[$key][0]->size }}</td>
                                                                <td>{{ $artwork_print[$key][0]->name }}</td>
                                                                <td>{{ $artwork_method[$key][0]->name }}</td>
                                                                <td>{{ $item->color_qty }}</td>
                                                                <td><img src="{{ $item->preview_image }}" alt=""></td>
                                                                <td><a target="_blank" href="{{ $item->zip_file }}"> >>
                                                                        Download</a>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </table>
                                                </div>
                                            </li>
                                            <hr>
                                        @endif
                                        @if(!$custom_artworks->isEmpty())
                                            @foreach($custom_artworks as $item)
                                                <li class="sc-list-group">
                                                    <div class="sc-list-body">
                                                        <p class="uk-margin-remove sc-text-semibold">{{ $item->title }}</p>
                                                        <span class="uk-label uk-label-success">Ada</span>
                                                        <img src="{{ $item->preview_image }}"
                                                             alt="">
                                                        <!-- ada validasi, jika link=null maka yg muncul download. Jika image attachment null = maka yang muncul link saja -->
                                                    </div>
                                                </li>
                                            @endforeach
                                        @endif
                                    </ul>
                                    <hr>
                                    @if(!$material_spec->isEmpty())
                                        <h5>Data Material & Spesifikasi</h5>
                                        <!-- list data ini sesuai data pada product material yang terinput pada order -->
                                        <ul class="uk-list custom-inline-list">
                                            <!-- start group -->
                                            <li class="sc-list-group">
                                                <div class="sc-list-body">
                                                    <div class="uk-grid custom-data-notes" data-uk-grid>
                                                        <div class="uk-width-1-1@l uk-width-1-1@s">
                                                            <div class="uk-grid" data-uk-grid>
                                                                <p class="uk-margin-remove sc-text-semibold">Infomasi
                                                                    material produk antara lain : Kain, Media Cetak
                                                                    Sablon</p> <br>
                                                                <table class="custom-table-1">
                                                                    <tr style="background-color: lightgrey;">
                                                                        <th>Material</th>
                                                                        <th>Jenis</th>
                                                                        <th>Warna</th>
                                                                    </tr>
                                                                    @foreach($material_spec as $key => $item)
                                                                        <tr>
                                                                            <td>{{ $material_data[$key][0]->name }}</td>
                                                                            <td>{{ $material_item[$key][0]->name }}</td>
                                                                            <td>{{ !empty($material_color[$key][0]->name) ? $material_color[$key][0]->name : '-' }}</td>
                                                                        </tr>
                                                                    @endforeach
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>

                                        </ul>
                                        <!-- end list data product material -->
                                        <hr>
                                    @endif
                                    @if(!$accessories->isEmpty())
                                        <h5>Data Aksesoris (Tambahan)</h5>
                                        <!-- data ini sesuai data asesoris yang diinput ketika input foc -->
                                        <ul class="uk-list">
                                            <li class="sc-list-group">
                                                <div class="sc-list-body">
                                                    <div class="uk-grid custom-data-notes" data-uk-grid>
                                                        <table class="custom-table-1">
                                                            <tr style="background-color: lightgrey;">
                                                                <th>Kategori Aksesori</th>
                                                                <th>Spesifikasi Aksesori</th>
                                                                <th>Catatan</th>
                                                                <th>Biaya Tambahan</th>
                                                                <th>Jumlah Qty</th>
                                                                <th>Subtotal</th>
                                                            </tr>
                                                            @foreach($accessories as $key => $item)
                                                                <tr>
                                                                    <td>{{ $accessories_spec_name[$key][0]->name }}</td>
                                                                    <td>{{ $accessories_name[$key][0]->name }}</td>
                                                                    <td>
                                                                        <p style="white-space: normal;margin-bottom: 0;">{{ $item->note }}</p>
                                                                    </td>
                                                                    <td>{{ formatRupiah($item->amount) }}/ Item</td>
                                                                    <td>{{ $item->qty }}</td>
                                                                    <td>
                                                                        {{ formatRupiah(($item->qty * $item->amount)) }}
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </table>
                                                    </div>
                                                </div>
                                            </li>
                                            <hr>
                                            @if(!empty($order_items[0]->note))
                                                <li class="sc-list-group">
                                                    <div class="uk-width-1-1@l uk-width-1-1@s">
                                                        <div class="uk-card md-bg-teal-50">
                                                            <div class="sc-padding-medium-s">
                                                                <ul class="uk-list">
                                                                    <li class="sc-sidebar-menu-heading custom-list-highlighted custom-no-margin">
                                                                        <span>Catatan Order</span></li>
                                                                </ul>
                                                                <div class="sc-padding-medium">
                                                                    <p style="word-break: break-word;margin-bottom: 0;">{{ $order_items[0]->note }}</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            @endif
                                        </ul>
                                        <hr>
                                    @endif
                                    <h5>Informasi Pengerjaan ( Pelanggan )</h5>
                                    <ul class="uk-list custom-inline-list">
                                        <li class="sc-list-group">
                                            <div class="sc-list-body">
                                                <p class="uk-margin-remove sc-text-semibold">Tanggal Order</p>
                                                <span
                                                    class="sc-list-secondary-text"> {{ \Illuminate\Support\Carbon::parse($order_items[0]->order_date)->locale('id')->translatedFormat('l, d F Y')  }} </span>
                                            </div>
                                        </li>
                                        <li class="sc-list-group">
                                            <div class="sc-list-body">
                                                <p class="uk-margin-remove sc-text-semibold">Tanggal Selesai</p>
                                                <span
                                                    class="sc-list-secondary-text"> {{ \Illuminate\Support\Carbon::parse($order_items[0]->completed_date)->locale('id')->translatedFormat('l, d F Y')  }} </span>
                                            </div>
                                        </li>
                                    </ul>
                                    <hr>
                                    <h5>Informasi Pengerjaan ( Vendor )</h5>
                                    <ul class="uk-list custom-inline-list">
                                        <li class="sc-list-group">
                                            <div class="sc-list-body">
                                                <p class="uk-margin-remove sc-text-semibold">Tanggal Order</p>
                                                <span
                                                    class="sc-list-secondary-text"> {{ \Illuminate\Support\Carbon::parse($order_items[0]->vendor_mou_date)->locale('id')->translatedFormat('l, d F Y')  }} </span>
                                            </div>
                                        </li>
                                        <li class="sc-list-group">
                                            <div class="sc-list-body">
                                                <p class="uk-margin-remove sc-text-semibold">Tanggal Selesai</p>
                                                <span
                                                    class="sc-list-secondary-text">{{ \Illuminate\Support\Carbon::parse($order_items[0]->vendor_mou_completed_date)->locale('id')->translatedFormat('l, d F Y')  }}</span>
                                            </div>
                                        </li>
                                    </ul>
                                    <ul class="uk-list custom-inline-list">
                                        <li class="sc-list-group">
                                            <div class="sc-list-body">
                                                <p class="uk-margin-remove sc-text-semibold">Nama Vendor</p>
                                                <span
                                                    class="sc-list-secondary-text"> {{ $vendors[0]->vendor_name }} </span>
                                            </div>
                                        </li>
                                    </ul>
                                    <ul class="uk-list uk-margin">
                                        <li class="sc-sidebar-menu-heading custom-list-divider"><span></span></li>
                                    </ul>
                                    <h5>Ringkasan Harga</h5>
                                    <div class="uk-grid-small" data-uk-grid>
                                        <div class="uk-grid" data-uk-grid>
                                            @foreach($order_items as $key => $item)
                                                <div class="uk-width-1-1@l uk-width-1-1@s">
                                                    <div class="uk-grid" data-uk-grid>
                                                        <div class="uk-width-1-2@l uk-width-1-2@s">
                                                            <ul class="uk-list">
                                                                <li class="sc-list-group">
                                                                    <div class="sc-list-body">
                                                                        <p class="uk-margin-remove sc-text-semibold">{{ $products[0]->name }}</p>
                                                                        <span class="sc-list-secondary-text">x  {{ $orders[$key]->total_item }} Pcs ( Termasuk Aksesoris )</span>
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <div class="uk-width-1-2@l uk-width-1-2@s">
                                                            <ul class="uk-list uk-text-right">
                                                                <li class="sc-list-group">
                                                                    <div class="sc-list-body">
                                                                        <p class="uk-margin-remove sc-text-semibold">{{ formatRupiah(($orders[$key]->total_amount - $item->sum_adj_price)) }}</p>
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                            @if(empty($order_adjust_price[0]->note) != 1)
                                                @foreach($order_adjust_price as $item)
                                                    <div class="uk-width-1-1@l uk-width-1-1@s">
                                                        <div class="uk-grid" data-uk-grid>
                                                            <div class="uk-width-1-2@l uk-width-1-2@s">
                                                                <ul class="uk-list">
                                                                    <li class="sc-list-group">
                                                                        <div class="sc-list-body">
                                                                            <p class="uk-margin-remove sc-text-semibold"> {{ $item->note }} </p>
                                                                            <span class="sc-list-secondary-text"></span>
                                                                        </div>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                            <div class="uk-width-1-2@l uk-width-1-2@s">
                                                                <ul class="uk-list uk-text-right">
                                                                    <li class="sc-list-group">
                                                                        <div class="sc-list-body">
                                                                            <p class="uk-margin-remove sc-text-semibold">{{ formatRupiah($item->adjust_amount) }}</p>
                                                                        </div>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endif

                                            <div class="uk-width-1-1@l uk-width-1-1@s custom-price-summary">
                                                <div class="uk-grid" data-uk-grid>
                                                    <div class="uk-width-1-2@l uk-width-1-2@s">
                                                        <ul class="uk-list">
                                                            <li class="sc-list-group">
                                                                <div class="sc-list-body">
                                                                    <p class="uk-margin-remove sc-text-semibold">Total
                                                                        Harga ( Belum Termasuk Ongkir )</p>
                                                                </div>
                                                            </li>
                                                            @if(empty($session_data['payment_percentage']))
                                                                <li class="sc-list-group">
                                                                    <div class="sc-list-body">
                                                                        <p class="uk-margin-remove sc-text-semibold">
                                                                            Down Payment</p>
                                                                    </div>
                                                                </li>
                                                            @endif
                                                            @if(!empty($session_data['payment_percentage']))
                                                                @if($session_data['payment_percentage'] == 0)
                                                                    <li class="sc-list-group">
                                                                        <div class="sc-list-body">
                                                                            <p class="uk-margin-remove sc-text-semibold">
                                                                                {{ $session_data }}</p>
                                                                        </div>
                                                                    </li>
                                                                @endif
                                                                @if($session_data['payment_percentage'] != 0)
                                                                    <li class="sc-list-group">
                                                                        <div class="sc-list-body">
                                                                            <p class="uk-margin-remove sc-text-semibold">
                                                                                DP {{ strval($session_data['payment_percentage']) }}
                                                                                %</p>
                                                                        </div>
                                                                    </li>
                                                                @endif
                                                            @endif
                                                            @if(empty($session_data['total_payment']))
                                                                <li class="sc-list-group">
                                                                    <div class="sc-list-body">
                                                                        <p class="uk-margin-remove sc-text-semibold">
                                                                            Pembayaran Penuh</p>
                                                                    </div>
                                                                </li>
                                                            @endif
                                                        </ul>
                                                    </div>
                                                    <div class="uk-width-1-2@l uk-width-1-2@s">
                                                        <ul class="uk-list uk-text-right">
                                                            <li class="sc-list-group">
                                                                <div class="sc-list-body">
                                                                    <p class="uk-margin-remove sc-text-semibold">
                                                                        {{ formatRupiah($session_data['total_payment_data']) }}</p>
                                                                </div>
                                                            </li>
                                                            @if($session_data['payment_method'] == '0')
                                                                <li class="sc-list-group">
                                                                    <div class="sc-list-body">
                                                                        <p class="uk-margin-remove sc-text-semibold">
                                                                           {{ formatRupiah($session_data['total_payment_data']) }}</p>
                                                                    </div>
                                                                </li>
                                                            @endif
                                                            @if($session_data['payment_method'] == '1')
                                                                <li class="sc-list-group">
                                                                    <div class="sc-list-body">
                                                                        <p class="uk-margin-remove sc-text-semibold">
                                                                            {{ formatRupiah($session_data['total_payment']) }}</p>
                                                                    </div>
                                                                </li>
                                                            @endif
                                                        </ul>
                                                    </div>
                                                    <div class="uk-width-1-1@l uk-width-1-1@s">
                                                        <hr>
                                                    </div>
                                                    @if(!empty($session_data['total_payment']))
                                                        <div class="uk-width-1-2@l uk-width-1-2@s uk-margin-remove-top">
                                                            <ul class="uk-list">
                                                                <li class="sc-list-group">
                                                                    <div class="sc-list-body">
                                                                        <p class="uk-margin-remove sc-text-semibold">
                                                                            Total Belum Dibayar</p>
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <div class="uk-width-1-2@l uk-width-1-2@s uk-margin-remove-top">
                                                            <ul class="uk-list uk-text-right">
                                                                <li class="sc-list-group">
                                                                    <div class="sc-list-body">
                                                                        <p class="uk-margin-remove sc-text-semibold">
                                                                            {{ formatRupiah((intval($session_data['total_payment_data']) - intval($session_data['total_payment']))) }}</p>
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    @endif
                                                    @if(empty($session_data['total_payment']))
                                                        <div class="uk-width-1-2@l uk-width-1-2@s uk-margin-remove-top">
                                                            <ul class="uk-list">
                                                                <li class="sc-list-group">
                                                                    <div class="sc-list-body">
                                                                        <p class="uk-margin-remove sc-text-semibold">
                                                                            Total Belum Dibayar</p>
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <div class="uk-width-1-2@l uk-width-1-2@s uk-margin-remove-top">
                                                            <ul class="uk-list uk-text-right">
                                                                <li class="sc-list-group">
                                                                    <div class="sc-list-body">
                                                                        <p class="uk-margin-remove sc-text-semibold">
                                                                            {{ formatRupiah($session_data['total_payment_data']) }}</p>
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                </div>
                                <div class="uk-margin-top">
                                    <a href="{{ route('foc.form.flush') }}"
                                       class="sc-button sc-button-primary sc-button-large">Kembali
                                    </a>
                                </div>
                                <div class="sc-fab-page-wrapper">
                                    <button type="submit" class="sc-fab sc-fab-large md-bg-light-blue-700 sc-fab-dark">
                                        <i class="mdi mdi-arrow-right"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $('#form-step-5').submit(function (evt) {
            evt.preventDefault();

            let formData = new FormData(this);
            formData.append('_token', "{{ csrf_token() }}");

            let ajax = {
                type: 'POST',
                url: "{{ route('foc.save.5') }}",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function (response) {
                    location.href = "{{ route('cust_confirm.index') }}";
                    // console.log(response);
                },
                error: function (response) {
                    console.log(response);
                }
            };

            performAjax(ajax);
        });

        function performAjax(data) {
            return $.ajax(data);
        }
    </script>
@endpush
