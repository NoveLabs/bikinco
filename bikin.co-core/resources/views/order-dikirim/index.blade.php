@extends('layouts.app')

@push('css-dropify')
    <link rel="stylesheet" href="{{ asset('assets/js/vendor/dropify/css/dropify.min.css') }}">
@endpush

@section('content')
<div id="sc-page-wrapper">
    <div id="sc-page-top-bar" class="sc-top-bar uk-flex-middle">
        <div class="sc-top-bar-content sc-padding-medium-ends uk-flex-1">
            <div class="uk-flex uk-flex-column uk-flex-1">
                <h1 class="sc-top-bar-title uk-text-uppercase uk-margin-small-bottom">Daftar Order Dalam Proses Pengiriman</h1>
                <span class="sc-top-bar-subtitle">Role: Sales Officer</span>
            </div>
            <div class="sc-actions uk-margin-left">
                <a href="javascript:void(0)" class="sc-actions-icon mdi mdi-printer"></a>
            </div>
        </div>
    </div>
    <div id="sc-page-content">
        <div class="uk-card">
      <div class="uk-overflow-auto">
        <table class="uk-table uk-table-divider" id="ts-issues">
          <thead>
            <tr>
              <th>Bukti Pelunasan</th>
              <th>Aksi</th>
              <th>Order ID</th>
              <th>Pelanggan</th>
              <th class="filter-select" data-placeholder="Select...">Produk</th>
              <th class="filter-select" data-placeholder="Select...">Prioritas</th>
              <th>Qty</th>
              <th>Tanggal Order</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            @foreach($data as $value)
            <tr>
                <td>
                    <a style="margin-top: 5px;"  onclick="updateSelesai({{ $value->id }})" class="sc-button sc-button-mini sc-button-success" >SELESAIKAN</a>
                    <a style="margin-top: 5px;" href="#modal-komplain" data-uk-toggle class="sc-button sc-button-mini sc-button-danger">KOMPLAIN</a>
                </td>
                <td>
                    <a href="#modal-track-shipment" data-uk-toggle class="sc-button sc-button-mini">LACAK RESI</a>
                    <a style="margin-top: 5px;" href="#modal-track-order{{ $value->id }}" onclick="trackOrder({{ $value->id }})" data-uk-toggle class="sc-button sc-button-mini">TRACK ORDER</a>
                    <a style="margin-top: 5px;"
                       href="{{ route('so.printable.inv.repayment.paid', $value->id) }}?action=export" target="_blank"
                       class="sc-button sc-button-mini">Nota Pelunasan</a>
                </td>
                <td><a href="so-quotation-print.html" target="blank">{{ $value->id }}</a></td>
                <td>{{ $value->fullname }}</td>
                <td>{{ $value->name }}</td>
                <td>
                        @if ($value->priority == 0)
                        <span class="uk-label">Tidak Prioritas</span>
                        @else
                        <span class="uk-label uk-label-danger">Prioritas</span>
                        @endif
                </td>
                <td>{{ $value->total_item }}</td>
                <td>{{ $value->tgl_order }}</td>
                <td><span class="uk-label uk-label-success">MASUK PORT. GAMBIR</span></td>
            </tr>
            @endforeach

          </tbody>
        </table>
      </div>
        </div>
    </div>
</div>

<button uk-toggle="target: #my-id" type="button"></button>

<!-- This is the modal -->
<div id="my-id" uk-modal>
    <div class="uk-modal-dialog uk-modal-body">
        <h2 class="uk-modal-title"></h2>
        <button class="uk-modal-close" type="button"></button>
    </div>
</div>


<!-- start modal track order -->
@foreach ($data as $value)
<div id="modal-track-order{{$value->id}}" data-uk-modal>
    <div class="uk-modal-dialog">
        <button class="uk-modal-close-default" type="button" data-uk-close></button>
        <div class="uk-modal-header">
            <h2 class="uk-modal-title">Detail Order</h2>
        </div>
        <div class="uk-modal-body" data-uk-overflow-auto>
            <div class="uk-grid" data-uk-grid="">
                <div class="uk-width-1-1@l">
                    <div class="custom-detail-list-box">
                        <ul class="uk-list">
                            <li class="sc-sidebar-menu-heading custom-list-divider"><span>{{ $value->id }}</span></li>
                        </ul>
                        <ul class="uk-list custom-inline-list">
                            <li class="sc-list-group">
                                <div class="sc-list-body">
                                    <p class="uk-margin-remove sc-text-semibold">No. Order</p>
                                    <span class="sc-list-secondary-text">{{ $value->id }}</span>
                                </div>
                            </li>
                            <li class="sc-list-group">
                                <div class="sc-list-body">
                                    <p class="uk-margin-remove sc-text-semibold">Produk</p>
                                    <span class="sc-list-secondary-text">{{ $value->name }}</span>
                                </div>
                            </li>
                            <li class="sc-list-group">
                                <div class="sc-list-body">
                                    <p class="uk-margin-remove sc-text-semibold">Nama Pelanggan</p>
                                    <span class="sc-list-secondary-text">{{ $value->fullname }}</span>
                                </div>
                            </li>
                            <li class="sc-list-group">
                                <div class="sc-list-body">
                                    <p class="uk-margin-remove sc-text-semibold">Tanggal Masuk Order</p>
                                    <span class="sc-list-secondary-text">{{ $value->tgl_order }}</span>
                                </div>
                            </li>
                            <li class="sc-list-group">
                                <div class="sc-list-body">
                                    <p class="uk-margin-remove sc-text-semibold">Prioritas</p>
                                    <span class="sc-list-secondary-text">
                                    @if($value->priority == 0)
                                    <span class="uk-label">Tidak Prioritas</span>
                                    @else
                                    <span class="uk-label uk-label-danger">Prioritas</span>
                                    @endif
                                    </span>
                                </div>
                            </li>
                            <li class="sc-list-group">
                                <div class="sc-list-body">
                                    <p class="uk-margin-remove sc-text-semibold">Status Order</p>
                                    <span class="sc-list-secondary-text" id="update_status">

                                    </span>
                                </div>
                            </li>
                        </ul>
                        <hr>
  <ul class="uk-accordion-alt" data-uk-accordion>
                            <li>
                                <h4 class="uk-accordion-title md-bg-teal-600 md-color-white">Informasi Detail Order</h4>
                                <div class="uk-accordion-content">
                                    <ul class="uk-list uk-margin">
                                        <li class="sc-sidebar-menu-heading custom-list-divider"><span>Ringkasan Harga</span></li>
                                    </ul>
                                    <ul class="uk-list custom-inline-list">
                                        <li class="sc-list-group">
                                            <div class="uk-grid custom-data-card" data-uk-grid>
                                                <div class="uk-width-1-1@l uk-width-1-1@s">
                                                    <div class="uk-grid" data-uk-grid>
                                                        <p class="uk-margin-remove sc-text-semibold">Informasi Order</p> <br>
                                                        <table class="custom-table-1 informasi_order" style="margin-left: 50px;" >

                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="uk-width-1-1@l uk-width-1-1@s">
                                                    <div class="uk-grid" data-uk-grid>
                                                        <p class="uk-margin-remove sc-text-semibold">Informasi Tambahan Biaya</p> <br>
                                                        <table class="custom-table-1 informasi_tambahan_biaya" style="margin-left: 50px;">

                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="uk-width-1-1@l uk-width-1-1@s">
                                                    <div class="uk-card md-bg-teal-500 md-color-white">
                                                        <div class="sc-padding-medium">
                                                            <div class="uk-grid " data-uk-grid>
                                                                <div class="uk-width-1-2@l uk-width-1-2@s">
                                                                    <div class="sc-list-body">
                                                                        <p class="uk-margin-remove sc-text-semibold">Total Harga ( Belum Termasuk Biaya Pengiriman )</p>
                                                                        <br>
                                                                        <p class="uk-margin-remove sc-text-semibold">Down Payment 50%</p>
                                                                    </div>
                                                                </div>
                                                                <div class="uk-width-1-2@l uk-width-1-2@s">
                                                                    <div class="sc-list-body uk-text-right">
                                                                        <p class="uk-margin-remove sc-text-semibold total_bayar"></p>
                                                                        <br>
                                                                        <p class="uk-margin-remove sc-text-semibold total_bayar_50"></p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                    <ul class="uk-list uk-margin">
                                        <li class="sc-sidebar-menu-heading custom-list-divider"><span>Informasi Jumlah Order</span></li>
                                    </ul>
                                    <ul class="uk-list custom-inline-list">
                                        <li class="sc-list-group">
                                            <table class="custom-table-1 item_size">

                                            </table>
                                        </li>
                                    </ul>
                                    <ul class="uk-list uk-margin">
                                        <li class="sc-sidebar-menu-heading custom-list-divider"><span>Informasi Jenis Order</span></li>
                                    </ul>
                                    <ul class="uk-list custom-inline-list">
                                        <li class="sc-list-group">
                                            <div class="sc-list-body">
                                                <p class="uk-margin-remove sc-text-semibold">Customer -> Bikin.co</p>
                                                <div class="cust_to_own"></div>
                                            </div>
                                        </li>
                                        <li class="sc-list-group">
                                            <div class="sc-list-body">
                                                <p class="uk-margin-remove sc-text-semibold ">Bikin.co -> Vendor</p>
                                                <div class="own_to_cust"></div>
                                            </div>
                                        </li>
                                        <li class="sc-list-group">
                                            <div class="sc-list-body">
                                                <p class="uk-margin-remove sc-text-semibold">Size Pack</p>
                                                <div class="sizepack"></div>
                                            </div>
                                        </li>
                                        <li class="sc-list-group">
                                            <div class="sc-list-body">
                                                <p class="uk-margin-remove sc-text-semibold">Label</p>
                                                <div class="download_label"></div>

                                            </div>
                                        </li>
                                        <li class="sc-list-group">
                                            <div class="sc-list-body">
                                                <p class="uk-margin-remove sc-text-semibold">Packaging</p>
                                                <!-- <span class="sc-list-secondary-text">Standard Bikin.co</span> -->
                                                <div class="download_packaging"></div>

                                            </div>
                                        </li>
                                        <li class="sc-list-group">
                                            <div class="sc-list-body">
                                                <p class="uk-margin-remove sc-text-semibold">Washing</p>
                                                <div class="washing"></div>
                                            </div>
                                        </li>
                                    </ul>
                                    <ul class="uk-list uk-margin">
                                        <li class="sc-sidebar-menu-heading custom-list-divider"><span>Informasi Desain & Artwork</span></li>
                                    </ul>
                                    <ul class="uk-list">
                                        <li class="sc-list-group">
                                            <div class="sc-list-body">
                                                <p class="uk-margin-remove sc-text-semibold">Data desain & mockup produk</p> <br>
                                                <table class="custom-table-1 design_produk">

                                                </table>
                                            </div>
                                        </li>
                                        <li class="sc-list-group">
                                            <div class="sc-list-body">
                                                <p class="uk-margin-remove sc-text-semibold">Data Artwork</p> <br>
                                                <table class="custom-table-1 artwork_produk">

                                                </table>
                                            </div>
                                        </li>
                                        <hr>
                                        <li class="sc-list-group">
                                            <div class="sc-list-body">
                                                <p class="uk-margin-remove sc-text-semibold">Punya referensi desain produk saja</p>
                                                <div class="reference_design"></div>
                                            </div>
                                        </li>
                                        <li class="sc-list-group">
                                            <div class="sc-list-body">
                                                <p class="uk-margin-remove sc-text-semibold">Punya referensi artwork saja</p>
                                                <div class="reference_artwork"></div>
                                            </div>
                                        </li>
                                    </ul>


                                    <!-- list data ini sesuai data pada product material yang terinput pada order -->
                                   <!--  <ul class="uk-list custom-inline-list"> -->
                                        <!-- start group -->
                                        <!-- <li class="sc-list-group">
                                            <div class="sc-list-body">
                                                <div class="uk-grid custom-data-notes" data-uk-grid>
                                                    <div class="uk-width-1-1@l uk-width-1-1@s">
                                                        <div class="uk-grid" data-uk-grid>
                                                            <p class="uk-margin-remove sc-text-semibold">Infomasi material produk antara lain : Kain, Media Cetak Sablon</p> <br>
                                                            <table class="custom-table-1" style="margin-left: 45px;">
                                                                <tr style="background-color: lightgrey;">
                                                                    <th>Material</th>
                                                                    <th>Jenis</th>
                                                                    <th>Model</th>
                                                                </tr>
                                                                <tr>
                                                                    <td>Kain</td>
                                                                    <td>Jenis Kain</td>
                                                                    <td>Cotton Bamboo</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Kain</td>
                                                                    <td>Gramasi Kain</td>
                                                                    <td>24S</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Kain</td>
                                                                    <td>Warna Kain</td>
                                                                    <td><span class="uk-label uk-label-primary">Merah (MB32 - Sritex)</span> <span class="uk-label uk-label-primary">Biru (MB20 - Sritex)</span></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Spesifikasi</td>
                                                                    <td>Jenis Kerah</td>
                                                                    <td>O-Neck</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Spesifikasi</td>
                                                                    <td>Jenis Lengan</td>
                                                                    <td><span class="uk-label">3/4</span> <span class="uk-label">Pendek</span> <span class="uk-label">Panjang</span></td>
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
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>

                                    </ul> -->
                                    <!-- end list data product material -->
                                    <!--
                                                                        <ul class="uk-list uk-margin">
                                                                            <li class="sc-sidebar-menu-heading custom-list-divider"><span>Data Aksesoris (Tambahan)</span></li>
                                                                        </ul> -->

                                    <!-- data ini sesuai data asesoris yang diinput ketika input foc -->
                                 <!--    <ul class="uk-list custom-inline-list">
                                        <li class="sc-list-group">
                                            <div class="sc-list-body">
                                                <div class="uk-grid custom-data-notes" data-uk-grid>
                                                    <table class="custom-table-1" style="margin-left: 45px;">
                                                        <tr style="background-color: lightgrey;">
                                                            <th>Material</th>
                                                            <th>Jenis</th>
                                                            <th>Model</th>
                                                        </tr>
                                                        <tr>
                                                            <td>Kain</td>
                                                            <td>Jenis Kain</td>
                                                            <td>Cotton Bamboo</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Kain</td>
                                                            <td>Gramasi Kain</td>
                                                            <td>24S</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Kain</td>
                                                            <td>Warna Kain</td>
                                                            <td><span class="uk-label uk-label-primary">Merah (MB32 - Sritex)</span> <span class="uk-label uk-label-primary">Biru (MB20 - Sritex)</span></td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="sc-list-group">
                                            <div class="uk-width-1-1@l uk-width-1-1@s">
                                                <div class="uk-card md-bg-teal-50">
                                                    <div class="sc-padding-medium-s">
                                                        <ul class="uk-list">
                                                            <li class="sc-sidebar-menu-heading custom-list-highlighted custom-no-margin"><span>Catatan Order</span></li>
                                                        </ul>
                                                        <div class="sc-padding-medium">
                                                            <span class="sc-list-secondary-text">Orderannya yang bagus ya kak, ontime harus! :)</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>

                                    </ul> -->

                                    <!-- <ul class="uk-list uk-margin">
                                        <li class="sc-sidebar-menu-heading custom-list-divider"><span>Informasi Pengerjaan ( Pelanggan )</span></li>
                                    </ul>
                                    <ul class="uk-list custom-inline-list">
                                        <li class="sc-list-group">
                                            <div class="sc-list-body">
                                                <p class="uk-margin-remove sc-text-semibold">Tanggal Order</p>
                                                <span class="sc-list-secondary-text"></span>
                                            </div>
                                        </li>
                                        <li class="sc-list-group">
                                            <div class="sc-list-body">
                                                <p class="uk-margin-remove sc-text-semibold">Tanggal Selesai</p>
                                                <span class="sc-list-secondary-text"></span>
                                            </div>
                                        </li>
                                        <li class="sc-list-group">
                                            <small>Harga/unit untuk pelanggan Rp. 50.000</small>
                                        </li>
                                    </ul>
                                    <ul class="uk-list uk-margin">
                                        <li class="sc-sidebar-menu-heading custom-list-divider"><span>Informasi Pengerjaan ( Vendor )</span></li>
                                    </ul>
                                    <ul class="uk-list custom-inline-list">
                                        <li class="sc-list-group">
                                            <div class="sc-list-body">
                                                <p class="uk-margin-remove sc-text-semibold">Tanggal Order</p>
                                                <span class="sc-list-secondary-text">}</span>
                                            </div>
                                        </li>
                                        <li class="sc-list-group">
                                            <div class="sc-list-body">
                                                <p class="uk-margin-remove sc-text-semibold">Tanggal Selesai</p>
                                                <span class="sc-list-secondary-text"></span>
                                            </div>
                                        </li>
                                        <li class="sc-list-group">
                                            <small>Harga/unit untuk vendor Rp. 45.000</small>
                                        </li>
                                    </ul>
                                    <ul class="uk-list custom-inline-list">
                                        <li class="sc-list-group">
                                            <div class="sc-list-body">
                                                <p class="uk-margin-remove sc-text-semibold">Nama Vendor</p>
                                                <span class="sc-list-secondary-text"></span>
                                            </div>
                                        </li>
                                    </ul> -->
                                </div>
                            </li>
                        </ul>

                        <ul class="uk-list uk-margin">
                            <li class="sc-sidebar-menu-heading custom-list-divider"><span>Status Pesanan</span></li>
                        </ul>
                        <div class="uk-grid" data-uk-grid>
                            <ul class="uk-list uk-list-divider" id="log_order">

                            </ul>
                        </div>
                    </div>
                    <hr>
                </div>
                <br>
            </div>
        </div>
        <div class="uk-modal-footer">

        </div>
    </div>
</div>
@endforeach
<!-- end modal track order -->

<!-- start modal input no resi -->
<div id="modal-add-resi" data-uk-modal>
    <div class="uk-modal-dialog uk-modal-body">
        <button class="uk-modal-close-default" type="button" data-uk-close></button>
        <div class="uk-modal-body">
            <form action="">
                <div class="custom-form-divider">
                    <span class="custom-no-margin-bottom">Input No. Resi</span>
                    <hr class="custom-hr">
                </div>
                <div class="uk-grid" data-uk-grid="">
                    <div class="uk-width-1-1@l uk-width-1-1@s">
                        <label><div class="custom-form-labeller"><span>No. Resi</span> <span class="custom-important-input"><sup>*</sup></span></div></label>
                        <input class="uk-input" type="text" data-sc-input="outline">
                    </div>
                </div>
                <div class="uk-grid" data-uk-grid="">
                    <div class="uk-width-1-1@l uk-width-1-1@s">
                        <label><div class="custom-form-labeller"><span>Nama Expedisi</span> <span class="custom-important-input"><sup>*</sup></span></div></label>
                        <input class="uk-input" type="text" data-sc-input="outline" value="JNE OKE" disabled>
                    </div>
                </div>
                <div class="uk-grid" data-uk-grid="">
                    <div class="uk-width-1-1@l uk-width-1-1@s">
                        <label><div class="custom-form-labeller"><span>Berat Kiriman</span> <span class="custom-important-input"><sup>*</sup></span></div></label>
                        <input class="uk-input" type="text" data-sc-input="outline" value="10" disabled>
                    </div>
                </div>

            </form>
        </div>
        <p class="uk-text-right">
            <button class="sc-button  sc-button-flat sc-button-flat-danger uk-modal-close" type="button">Batal</button>
            <button class="sc-button sc-button-primary sc-js-button-loading" data-button-mode="light">Input Resi</button>
        </p>
    </div>
</div>
<!-- end modal input no resi -->

<!-- start modal track shipment -->
<div id="modal-track-shipment" data-uk-modal>
    <div class="uk-modal-dialog">
        <button class="uk-modal-close-default" type="button" data-uk-close></button>
        <div class="uk-modal-header">
            <h2 class="uk-modal-title">Lacak Pengiriman</h2>
        </div>
        <div class="uk-modal-body" data-uk-overflow-auto>
            <div class="uk-grid" data-uk-grid="">
                <div class="uk-width-1-1@l">
                    <div class="custom-detail-list-box">
                        <ul class="uk-list custom-inline-list">
                            <li class="sc-list-group">
                                <div class="sc-list-body">
                                    <p class="uk-margin-remove sc-text-semibold">No. Order</p>
                                    <span class="sc-list-secondary-text">BQ-01/03-21</span>
                                </div>
                            </li>
                            <li class="sc-list-group">
                                <div class="sc-list-body">
                                    <p class="uk-margin-remove sc-text-semibold">Produk</p>
                                    <span class="sc-list-secondary-text">Kaos V-Neck</span>
                                </div>
                            </li>
                            <li class="sc-list-group">
                                <div class="sc-list-body">
                                    <p class="uk-margin-remove sc-text-semibold">Nama Pelanggan</p>
                                    <span class="sc-list-secondary-text">Rizki Kartika Dewi</span>
                                </div>
                            </li>
                            <li class="sc-list-group">
                                <div class="sc-list-body">
                                    <p class="uk-margin-remove sc-text-semibold">Berat Total</p>
                                    <span class="sc-list-secondary-text">12 Kg</span>
                                </div>
                            </li>
                            <li class="sc-list-group">
                                <div class="sc-list-body">
                                    <p class="uk-margin-remove sc-text-semibold">Jasa Pengiriman</p>
                                    <span class="sc-list-secondary-text">JNE</span>
                                </div>
                            </li>
                            <li class="sc-list-group">
                                <div class="sc-list-body">
                                    <p class="uk-margin-remove sc-text-semibold">Lama Pengiriman</p>
                                    <span class="sc-list-secondary-text">3-5 hari</span>
                                </div>
                            </li>
                        </ul>
                        <hr>
                        <div class="uk-grid" data-uk-grid>
                            <ul class="uk-list uk-list-divider">
                                <li class="sc-list-group">
                                    <div class="sc-list-addon"> Sabtu, 14 Mar 2021 12:45 <br><span class="uk-label uk-label-success track-modal">Order Selesai</span></div>
                                    <div class="sc-list-body">
                                        Order telah selesai.
                                        <small>Diterima pelanggan : Rizki Kartika Dewi</small>
                                    </div>
                                </li>
                                <li class="sc-list-group">
                                    <div class="sc-list-addon"> Sabtu, 11 Mar 2021 12:45 <br><span class="uk-label uk-label-success track-modal">Menunggu Pelunasan</span></div>
                                    <div class="sc-list-body">
                                        Bukti pelunasan telah dikonfirmasi. <br>
                                        Order dikirim.
                                        <small>Keterangan : Melalui kurir JNE Reguler</small>
                                    </div>
                                </li>
                                <li class="sc-list-group">
                                    <div class="sc-list-addon"> Sabtu, 10 Mar 2021 12:45 <br><span class="uk-label uk-label-success track-modal">Menunggu Pelunasan</span></div>
                                    <div class="sc-list-body">
                                        Vendor telah selesai memproduksi pesanan. <br>
                                        Menunggu pelunasan dari pelanggan.
                                    </div>
                                </li>
                                <li class="sc-list-group">
                                    <div class="sc-list-addon"> Sabtu, 9 Mar 2021 12:45 <br><span class="uk-label uk-label-success track-modal">Diproses Vendor</span></div>
                                    <div class="sc-list-body">
                                        Artwork dikonfirmasi pelanggan. <br>
                                        Pesanan diproses vendor
                                    </div>
                                </li>
                                <li class="sc-list-group">
                                    <div class="sc-list-addon">Sabtu, 8 Mar 2021 12:45 <br><span class="uk-label uk-label-success track-modal">Proses Verifikasi Artwork</span></div>
                                    <div class="sc-list-body">
                                        Down Payemnt telah diverifikasi. <br>
                                        Artwork sedang diolah oleh tim.
                                    </div>
                                </li>
                                <li class="sc-list-group">
                                    <div class="sc-list-addon">Sabtu, 7 Mar 2021 12:45 <br><span class="uk-label uk-label-warning track-modal">Menunggu Down Payment</span></div>
                                    <div class="sc-list-body">
                                        Detail pesanan telah dikonfirmasi pelanggan. <br>
                                        Menunggu Down Payment.
                                    </div>
                                </li>
                                <li class="sc-list-group">
                                    <div class="sc-list-addon">Sabtu, 6 Mar 2021 12:45 <br><span class="uk-label uk-label-primary track-modal">Order Dibuat</span></div>
                                    <div class="sc-list-body">
                                        Order dibuat. <br>
                                        Menunggu konfirmasi pelanggan.
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <hr>
                </div>
                <br>
            </div>
        </div>
        <div class="uk-modal-footer">

        </div>
    </div>
</div>
<!-- end modal track shipment -->

@foreach($data as $value)
<!-- start modal komplain vendor -->
<div id="modal-komplain" data-uk-modal>
    <div class="uk-modal-dialog uk-modal-body">
        <button class="uk-modal-close-default" type="button" data-uk-close></button>
        <div class="uk-modal-body">
                <div class="custom-form-divider">
                    <span class="custom-no-margin-bottom">Input Komplain dari Pelanggan</span>
                    <p>Apabila pelanggan memiliki masalah setelah menerima produk, input komplain dengan cara berikut ini:</p>
                </div>
                <hr>

            <div class="uk-grid" data-uk-grid>
                <div class="uk-width-1-1@l uk-width-1-1@s">
                    <label for="">Pilih jenis komplain</label>
                    <select name="jenis_komplain" id="jenis_komplain"  class="uk-select" data-sc-select2='{"placeholder": "Pilih jenis komplain", "allowClear": true }'>
                        <option value="">Pilih jenis komplain</option>
                        <option value="1">Pelayanan</option>
                        <option value="2">Kualitas produk</option>
                        <option value="3">Pengiriman</option>
                    </select>
                </div>
                <div class="uk-width-1-1@l uk-width-1-1@s">
                    <label for="">Catatan / Deskripsi Komplain</label>
                    <textarea name="notes" id="notes" cols="30" rows="6" class="uk-textarea"></textarea>
                </div>
                <div class="uk-width-1-1@l uk-width-1-1@s">
                    <label><div class="custom-form-labeller"><span>Lampiran</span> </div></label>
                    <input class="uk-input" type="text" data-sc-input="outline" placeholder="Link Google Drive, DropBox, dll" name="attachment" id="attachment">
                    <input type="hidden" id="id" value="{{ $value->id }}">
                </div>
            </div>
        </div>
        <p class="uk-text-right">
            <!-- button ini muncul setelah dapet result opsi paket pengiriman -->
            <button class="sc-button sc-button-danger sc-js-button-loading" data-button-mode="light" id="add_komplain">Catat Komplain</button>
        </p>
    </div>
</div>
@endforeach
<!-- end modal komplain vendor -->
@endsection

@push('scripts')
<script>
 function trackOrder(id)
 {
     $.ajax({
            type: "GET",
            url: '{!! route('track_order.getStatus', [':id']) !!}'.replace(':id',id),
            success: function (data) {
            $('#update_status').empty();
            if (data.data['flow_step'] == 1) {
                var html = '<span class="uk-label uk-label-primary track-modal">'+ data.data['title']  +'</span>';
            } else if (data.data['flow_step'] == 2) {
                var html = '<span class="uk-label uk-label-success track-modal">'+ data.data['title']  +'</span>';
            } else if (data.data['flow_step'] == 3) {
                var html = '<span class="uk-label uk-label-success track-modal">'+ data.data['title']  +'</span>';
            } else if (data.data['flow_step'] == 4) {
                var html = '<span class="uk-label uk-label-warning track-modal">'+ data.data['title']  +'</span>';
            } else if (data.data['flow_step'] == 5) {
                var html = '<span class="uk-label uk-label-success track-modal">'+ data.data['title']  +'</span>';
            } else if (data.data['flow_step'] == 6) {
                var html = '<span class="uk-label uk-label-success track-modal">'+ data.data['title']  +'</span>';
            } else if (data.data['flow_step'] == 7) {
                var html = '<span class="uk-label uk-label-success track-modal">'+ data.data['title']  +'</span>';
            } else if (data.data['flow_step'] == 8) {
                var html = ' <span class="uk-label uk-label-warning track-modal">'+ data.data['title']  +'</span>';
            } else if (data.data['flow_step'] == 9) {
                var html = '<span class="uk-label uk-label-warning track-modal">'+ data.data['title']  +'</span>';
            } else if (data.data['flow_step'] == 10) {
                var html = '<span class="uk-label uk-label-success track-modal">'+ data.data['title']  +'</span>';
            } else if (data.data['flow_step'] == 11) {
                var html = '<span class="uk-label uk-label-success track-modal">'+ data.data['title']  +'</span>';
            } else if (data.data['flow_step'] == 12) {
                var html = '<span class="uk-label uk-label-danger track-modal">'+ data.data['title']  +'</span>';
            } else {
                var html = '<span class="uk-label uk-label-danger track-modal">'+ data.data['title']  +'</span>';
            }

                $('#update_status').append(html);

            }


     });

        $.ajax({
            type: "GET",
            url: '{!! route('track_order.getStatusAll', [':id']) !!}'.replace(':id',id),
            success: function (data) {

                $('#log_order').empty();
            for (let i = 0; i < data.data.length; ++i) {
            var htmlLog = '<li class="sc-list-group">';
            htmlLog += '<div class="sc-list-addon">';
            htmlLog += ''+data.data[i]['tgl_log']+' '+ data.data[i]['time_log'] +'<br>';
            if (data.data[i]['flow_step'] == 1) {
                 htmlLog += '<span class="uk-label uk-label-primary track-modal">'+ data.data[i]['title']  +'</span> </div>';
            } else if (data.data[i]['flow_step'] == 2) {
                 htmlLog += '<span class="uk-label uk-label-success track-modal">'+ data.data[i]['title']  +'</span> </div>';
            } else if (data.data[i]['flow_step'] == 3) {
                 htmlLog += '<span class="uk-label uk-label-success track-modal">'+ data.data[i]['title']  +'</span> </div>';
            } else if (data.data[i]['flow_step'] == 4) {
                 htmlLog += '<span class="uk-label uk-label-warning track-modal">'+ data.data[i]['title']  +'</span> </div>';
            } else if (data.data['flow_step'] == 5) {
                 htmlLog += '<span class="uk-label uk-label-success track-modal">'+ data.data[i]['title']  +'</span> </div>';
            } else if (data.data[i]['flow_step'] == 6) {
                 htmlLog += '<span class="uk-label uk-label-success track-modal">'+ data.data[i]['title']  +'</span> </div>';
            } else if (data.data[i]['flow_step'] == 7) {
                 htmlLog += '<span class="uk-label uk-label-success track-modal">'+ data.data[i]['title']  +'</span> </div>';
            } else if (data.data[i]['flow_step'] == 8) {
                 htmlLog += ' <span class="uk-label uk-label-warning track-modal">'+ data.data[i]['title']  +'</span> </div>';
            } else if (data.data[i]['flow_step'] == 9) {
                 htmlLog += '<span class="uk-label uk-label-warning track-modal">'+ data.data[i]['title']  +'</span> </div>';
            } else if (data.data[i]['flow_step'] == 10) {
                 htmlLog += '<span class="uk-label uk-label-success track-modal">'+ data.data[i]['title']  +'</span> </div>';
            } else if (data.data[i]['flow_step'] == 11) {
                 htmlLog += '<span class="uk-label uk-label-success track-modal">'+ data.data[i]['title']  +'</span> </div>';
            } else if (data.data[i]['flow_step'] == 12) {
                 htmlLog += '<span class="uk-label uk-label-danger track-modal">'+ data.data[i]['title']  +'</span> </div>';
            } else {
                 htmlLog += '<span class="uk-label uk-label-danger track-modal">'+ data.data[i]['title']  +'</span> </div>';
            }
            htmlLog += '<div class="sc-list-body">';
            htmlLog += ''+ data.data[i]['current_description'] +'<br>';
            htmlLog += ''+ data.data[i]['next_description']+'</div> </li>';

            $('#log_order').append(htmlLog);
        }


            }
    });

        $.ajax({
            type: "GET",
            url: '{!! route('track_order.getOrderMaterials', [':id']) !!}'.replace(':id',id),
            success: function (data) {
            $('.informasi_order').empty();
            var htmlTitleMaterial = '<tr>';
            htmlTitleMaterial += '<th>Produk</th>';
            htmlTitleMaterial += '<th>Harga</th>';
            htmlTitleMaterial += '<th>Jumlah</th>';
            htmlTitleMaterial += '<th>Total</th>';
            htmlTitleMaterial += '</tr>';
            $('.informasi_order').append(htmlTitleMaterial);
            var sum = 0;

            for (let i = 0; i < data.data[0].order_items[0].has_material.length; ++i) {
             var htmlOrderMaterial = '<tr>';
            htmlOrderMaterial += '<td>'+ data.data[0].order_items[0].has_product.name +'  </td>';
            htmlOrderMaterial += '<td>Rp. '+ data.data[0].order_items[0].has_product.price +'</td>';
            htmlOrderMaterial += '<td>'+ data.data[0].order_items[0].has_material[i].qty +'</td>';
            var hasil = data.data[0].order_items[0].has_product.price*data.data[0].order_items[0].has_material[i].qty;
            htmlOrderMaterial += '<td>Rp. '+ hasil +'</td>';
            htmlOrderMaterial += '</tr>';
            sum += Number(hasil);

            $('.informasi_order').append(htmlOrderMaterial);
        }

        var htmlTotal = '<tr style="background-color: lightgray;">';
        htmlTotal += '<td colspan="3">Total</td>';
        htmlTotal += '<td> Rp.'+ sum +'</td>';
        htmlTotal += '</tr>';
        $('.informasi_order').append(htmlTotal);

        }
    });

        $.ajax({
            type: "GET",
            url: '{!! route('track_order.getAdjustPrice', [':id']) !!}'.replace(':id',id),
            success: function (data) {
            $('.informasi_tambahan_biaya').empty();
            var htmAdjustPriceTitle = '<tr>';
            htmAdjustPriceTitle += '<th>Item</th>';
            htmAdjustPriceTitle += '<th>Harga</th>';
            htmAdjustPriceTitle += '<th>Jumlah</th>';
            htmAdjustPriceTitle += '<th>Total</th>';
            htmAdjustPriceTitle += '</tr>';
            $('.informasi_tambahan_biaya').append(htmAdjustPriceTitle);

                var sum = 0;

            for (let i = 0; i < data.data[0].order_items[0].has_adjust_price.length; ++i) {
             var htmlAdjustPrice = '<tr>';
            htmlAdjustPrice += '<td>'+ data.data[0].order_items[0].has_adjust_price[i].note +'  </td>';
            htmlAdjustPrice += '<td>Rp. '+ data.data[0].order_items[0].has_adjust_price[i].adjust_amount +'</td>';
            htmlAdjustPrice += '<td>'+ +'</td>';
            var hasil = data.data[0].order_items[0].has_adjust_price[i].adjust_amount ;
            htmlAdjustPrice += '<td>Rp. '+ hasil +'</td>';
            htmlAdjustPrice += '</tr>';
            sum += Number(hasil);

            $('.informasi_tambahan_biaya').append(htmlAdjustPrice);
        }

        var htmlAdjustPriceTotal = '<tr style="background-color: lightgray;">';
        htmlAdjustPriceTotal += '<td colspan="3">Total</td>';
        htmlAdjustPriceTotal += '<td> Rp.'+ sum +'</td>';
        htmlAdjustPriceTotal += '</tr>';
        $('.informasi_tambahan_biaya').append(htmlAdjustPriceTotal);

            $('.total_bayar').empty();
            $('.total_bayar_50').empty();

            var total_bayar = 'Rp.'+ data.data[0].total_amount +'';
            var total_bayar_50 = 'Rp.'+ data.data[0].part_paid_amount +'';

            $('.total_bayar').append(total_bayar);
            $('.total_bayar_50').append(total_bayar_50);

        }
    });

        $.ajax({
            type: "GET",
            url: '{!! route('track_order.getItemSize', [':id']) !!}'.replace(':id',id),
            success: function (data) {
            $('.item_size').empty();
            var htmItemSizeTitle = '<tr>';
            htmItemSizeTitle += '<th>No</th>';
            htmItemSizeTitle += '<th>Ukuran</th>';
            htmItemSizeTitle += '<th>Jenis</th>';
            htmItemSizeTitle += '<th>Jumlah</th>';
            htmItemSizeTitle += '</tr>';
            $('.item_size').append(htmItemSizeTitle);

                var sum = 0;

            for (let i = 0; i < data.data[0].order_items[0].has_item_sizes.length; ++i) {
             var htmlItemSize = '<tr>';
            htmlItemSize += '<td>'+ data.data[0].order_items[0].has_product.has_sub_categories.has_categories.has_size[0].name +'  </td>';
            htmlItemSize += '<td>'+ data.data[0].order_items[0].has_product.has_sub_categories.has_categories.has_size_type[0].name +'</td>';
            htmlItemSize += '<td>'+ data.data[0].order_items[0].has_item_sizes[i].qty +'</td>';
            var hasil = data.data[0].order_items[0].has_item_sizes[i].qty;
            htmlItemSize += '<td>'+ hasil +'</td>';
            htmlItemSize += '</tr>';
            sum += Number(hasil);

            $('.item_size').append(htmlItemSize);
        }

        var htmlItemSizeTotal = '<tr style="background-color: lightgray;">';
        htmlItemSizeTotal += '<td colspan="3">Total Kuantitas Order </td>';
        htmlItemSizeTotal += '<td>'+ sum +' buah</td>';
        htmlItemSizeTotal += '</tr>';
        $('.item_size').append(htmlItemSizeTotal);

        }
    });

         $.ajax({
            type: "GET",
            url: '{!! route('track_order.getInfoDetail', [':id']) !!}'.replace(':id',id),
            success: function (data) {
            $('.cust_to_own').empty();
            $('.own_to_cust').empty();
            $('.sizepack').empty();
            $('.download_label').empty();
            $('.download_packaging').empty();
            $('.washing').empty();
            var cust_to_own =  data.data[0].order_items[0].cust_to_own_type;
            var own_to_cust = data.data[0].order_items[0].own_to_cust_type;
            var sizepack = data.data[0].order_items[0].has_product.has_vendor[0].has_vendor.has_sizepack[0].size_code;
            var file_sizepack = data.data[0].order_items[0].has_product.has_vendor[0].has_vendor.has_sizepack[0].file;
            var download_label = data.data[0].order_items[0].label_photo;
            var download_packaging = data.data[0].order_items[0].packaging_photo;
            var is_packaging = data.data[0].order_items[0].is_repackaging;
            var packaging_note = data.data[0].order_items[0].packaging_note;
            var is_washing = data.data[0].order_items[0].is_washing;
            var washing = data.data[0].order_items[0].has_product.has_add_on.has_add_on.name;


            if (cust_to_own == 0) {

                var text_cust_to_own = '<span class="sc-list-secondary-text">FOB (Full Order Buyer)</span>';
            } else {
                var text_cust_to_own = '<span class="sc-list-secondary-text">CMT (Cut, Make, Trim)</span>';
            }
            $('.cust_to_own').append(text_cust_to_own);

                if (own_to_cust == 0) {
                var text_own_to_cust = '<span class="sc-list-secondary-text">FOB (Full Order Buyer)</span>';
            } else {
                var text_own_to_cust = '<span class="sc-list-secondary-text">CMT (Cut, Make, Trim)</span>';
            }
            $('.own_to_cust').append(text_own_to_cust);

            var html_sizepack = '<span class="sc-list-secondary-text">'+ sizepack +'<br><a href="{{ URL::asset("/") }}'+ file_sizepack +'" target="_blank"> >> Download </a></span>';
            $('.sizepack').append(html_sizepack);

            var html_label = '<span class="sc-list-secondary-text">Label masih static <br><a href="{{ URL::asset("/") }}'+ download_label +'" target="_blank"> >> Download</a></span>';
            $('.download_label').append(html_label);

            var html_packaging = '<span class="sc-list-secondary-text">'+ packaging_note +' <br><a href="{{ URL::asset("/") }}'+ download_packaging +'" target="_blank" >> Download</a></span>';
            $('.download_packaging').append(html_packaging);
            if(is_washing == 0) {
                var txt = 'Tidak';
            } else {
                var txt = 'Ya';
            }
            var html_washing = '<span class="sc-list-secondary-text washing">'+ txt +' ('+washing+')</span>';
            $('.washing').append(html_washing);
        }
    });

        $.ajax({
            type: "GET",
            url: '{!! route('track_order.getDesign', [':id']) !!}'.replace(':id',id),
            success: function (data) {
                $('.design_produk').empty();
                var htmlDesignTitle = '<tr>';
                htmlDesignTitle += '<th>Judul</th>';
                htmlDesignTitle += '<th>Gambar</th>';
                htmlDesignTitle += '</tr>';
                $('.design_produk').append(htmlDesignTitle);
                  for (let i = 0; i < data.data[0].order_items[0].has_cust_artwork.length; ++i) {
                var htmlDesign = '<tr>';
                htmlDesign += '<td>'+ data.data[0].order_items[0].has_cust_artwork[i].title +'</td>';
                htmlDesign += '<td><img src="{{ URL::asset("/") }}'+ data.data[0].order_items[0].has_cust_artwork[i].photo +'" alt=""></td>';
                htmlDesign += '</tr>';

                $('.design_produk').append(htmlDesign);
        }
        }
    });

        $.ajax({
            type: "GET",
            url: '{!! route('track_order.getArtwork', [':id']) !!}'.replace(':id',id),
            success: function (data) {
                $('.artwork_produk').empty();
                var htmlArtworkTitle = '<tr>';
                htmlArtworkTitle += '<th>Posisi</th>';
                htmlArtworkTitle += '<th>Ukuran</th>';
                htmlArtworkTitle += '<th>Material</th>';
                htmlArtworkTitle += '<th>Jumlah Warna</th>';
                htmlArtworkTitle += '<th>Preview</th>';
                htmlArtworkTitle += '<th>Vector</th>';
                htmlArtworkTitle += '<th>Harga</th>';
                htmlArtworkTitle += '</tr>';
                $('.artwork_produk').append(htmlArtworkTitle);
                  for (let i = 0; i < data.data.length; ++i) {
                var htmlArtwork = '<tr>';
                htmlArtwork += '<td>'+ data.data[i].posisi +'</td>';
                htmlArtwork += '<td>'+ data.data[i].ukuran +'</td>';
                htmlArtwork += '<td>'+ data.data[i].name_material +'</td>';
                htmlArtwork += '<td>'+ data.data[i].color_qty +'</td>';
                htmlArtwork += '<td><img src="{{ URL::asset("/") }}'+ data.data[i].preview_image +'" alt=""></td>';
                htmlArtwork += '<td><a href="{{ URL::asset("/") }}'+ data.data[i].zip_file +'" target="_blank"> >> Download</a></td>';
                htmlArtwork += '<td>'+ data.data[i].amount +'</td>';
                htmlArtwork += '</tr>';

                $('.artwork_produk').append(htmlArtwork);
        }
        }
    });

         $.ajax({
            type: "GET",
            url: '{!! route('track_order.getDesignReference', [':id']) !!}'.replace(':id',id),
            success: function (data) {
                $('.reference_design').empty();


                if (data.data == null) {
                    var htmlDesignReference = '<span class="sc-list-secondary-text"><a href="#" target="blank"> >> Link</a> atau <a href="#" target="blank"> >> Download</a></span>';
                } else {
                    var htmlDesignReference = '<span class="uk-label uk-label-success">Ada</span>';
                }
                htmlDesignReference += '<img src="{{ URL::asset("/") }}'+ data.data[0].preview_image +'" alt="">'
                $('.reference_design').append(htmlDesignReference);

        }
    });
 }
function updateSelesai(id)
{
        UIkit.modal.confirm('Selesaikan order ini tanpa komplain?').then(function(){
                  $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                },
                type: 'POST',
                url: "{{ route('order_dikirim.done', [":id"]) }}".replace(':id',id),
                cache: false,
                contentType: false,
                processData: false,
                success: (data) => {

                    UIkit.modal.alert('Confirmed!');
                    setTimeout(function() {
                        window.location.href = "{{ route('order_dikirim.index') }}";
                    }, 5);
                },
                error: function(data) {
                    UIkit.modal.alert(data.responseJSON.message).then(function () {

                    });
                }
            });
        });

}
	$(document).ready(function () {
         $('#add_komplain').click(function() {

            var jenis_komplain = $('#jenis_komplain').val();
            var notes = $('#notes').val();
            var attachment = $('#attachment').val();
            var order_id = $('#id').val();

            $.ajax({
                url: '{{ route("order_dikirim.add_komplain")}}',
                type: "POST",
                data: {
                    jenis_komplain: jenis_komplain,
                    notes: notes,
                    attachment: attachment,
                    order_id: order_id,
                    "_token": "{{ csrf_token() }}",
                },
                success: function(response) {
                    console.log(response);
                    if(response) {
                         window.location.href = "/order_dikirim";
                    }
                },
            });
        });
	});
</script>
@endpush

@push('dropify')
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script> -->
<script src="{{ asset('assets/js/vendor/dropify/js/dropify.min.js') }}"></script>
<script>
    $(document).ready(function(){
        // Basic
        $('.dropify').dropify();

        // Translated
        $('.dropify-fr').dropify({
            messages: {
                default: 'Glissez-déposez un fichier ici ou cliquez',
                replace: 'Glissez-déposez un fichier ou cliquez pour remplacer',
                remove:  'Supprimer',
                error:   'Désolé, le fichier trop volumineux'
            }
        });

        // Used events
        let drEvent = $('#new-categories-file').dropify();

        drEvent.on('dropify.beforeClear', function(event, element){
            if (element.file.name === null) {
                return confirm('Yakin ingin hapus file ini : ' + element.filenameWrapper[0].children[1].innerHTML + '?');
            } else {
                return confirm("Do you really want to delete \"" + element.file.name + "\" ?");
            }
        });

        drEvent.on('dropify.afterClear', function(event, element){
            alert('File deleted');
        });

        drEvent.on('dropify.errors', function(event, element){
            console.log('Has Errors');
        });


        // Edit Event
        let editEvent = $('#edit-categories-file').dropify();

        editEvent.on('dropify.beforeClear', function (event, element) {

            if (element.file.name === null) {
                return confirm('Yakin ingin hapus file ini : ' + element.filenameWrapper[0].children[1].innerHTML + '?');
            } else {
                return confirm("Do you really want to delete \"" + element.file.name + "\" ?");
            }
        });

        editEvent.on('dropify.afterClear', function (event, element) {
            alert('File deleted');
        });

        editEvent.on('dropify.errors', function (event, element) {
            console.log('Has Errors');
        });


        var drDestroy = $('#input-file-to-destroy').dropify();
        drDestroy = drDestroy.data('dropify')
        $('#toggleDropify').on('click', function(e){
            e.preventDefault();
            if (drDestroy.isDropified()) {
                drDestroy.destroy();
            } else {
                drDestroy.init();
            }
        })
    });
</script>
@endpush
