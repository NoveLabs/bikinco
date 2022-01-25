@extends('layouts.app')

@push('css-dropify')
<link rel="stylesheet" href="{{ asset('assets/js/vendor/dropify/css/dropify.min.css') }}">
@endpush

@section('content')


<div id="sc-page-wrapper">
    <div id="sc-page-top-bar" class="sc-top-bar uk-flex-middle">
        <div class="sc-top-bar-content sc-padding-medium-ends uk-flex-1">
            <div class="uk-flex uk-flex-column uk-flex-1">
                <h1 class="sc-top-bar-title uk-text-uppercase uk-margin-small-bottom">Menunggu Down Payment atau Pembayaran</h1>
                <span class="sc-top-bar-subtitle">Role: Accounting</span>
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
                        <th>Bukti Transfer</th>
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
                    @for ($i = 0; $i < $count ; $i++)
                    <tr role="row "class="odd">
                        <td>
                        @if($data[$i]->status == 3)
                                <a href="#modal-view-image{{ $data[$i]->id }}" data-uk-toggle
                                   class="sc-button sc-button-mini sc-button-success">Lihat</a>
                        @elseif($data[$i]->status == 2)
                                <span class="uk-label uk-label-primary">Menunggu Revisi</span>
                        @endif
                        </td>
                        <td>
                            <a href="#modal-track-order{{$data[$i]->id}}" onclick="trackOrder({{ $data[$i]->id }})" data-uk-toggle class="sc-button sc-button-mini" >TRACK</a>
                            <div style="margin-top: 10px;">
                                <a href="{{ route('so.printable.inv.dp', $data[$i]->id) }}?action=export" target="blank"
                                   class="sc-button sc-button-mini">Invoice</a>
                            </div>
                        </td>
                        <td><a href="so-quotation-print.html" target="blank">BQ-{{ $data[$i]->id }}</a></td>
                        <td>{{ $data[$i]->Customer->fullname }}</td>
                        <td>{{ $data[$i]->name }}</td>
                        <td>
                        @if ($data[$i]->priority == 0)
                        <span class="uk-label">Tidak Prioritas</span>
                        @else
                        <span class="uk-label uk-label-danger">Prioritas</span>
                        @endif
                        </td>
                        <td>{{ $data[$i]->total_item }}</td>
                        <td>{{ $data[$i]->log_created_at }}</td>
                        <td>
                        @if ($data[$i]->orderPayment->isEmpty())
                            <span class="uk-label uk-label-warning">BELUM DIUNGGAH</span>
                        @else
                            @if ($data[$i]->status == 2)
                                <span class="uk-label uk-label-danger">DITOLAK</span>
                            @elseif($data[$i]->status == 3)
                                <span class="uk-label uk-label-primary">MENUNGGU VERIFIKASI</span>
                            @elseif($data[$i]->status == 1)
                                    <span class="uk-label uk-label-primary">DIKONFIRMASI</span>
                                @endif
                            @endif
                        </td>
                    </tr>
                    @endfor
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<!-- start-modal-verification -->
@for ($i = 0; $i < $count ; $i++)
<input class="id_log" hidden value="{{ $data[$i]->order_payment_id }}">
<div id="modal-view-image{{$data[$i]->id}}" data-uk-modal>
    <div class="uk-modal-dialog">
        <button class="uk-modal-close-default" type="button" data-uk-close></button>
        <div class="uk-modal-header">
        </div>
        <div class="uk-modal-body" data-uk-overflow-auto>
            <p style="text-align: center;">Bukti Pembayaran Down Payment</p>
            <img style="max-height: 400px;display: block;margin-left: auto;margin-right: auto;" src="{{ $data[$i]->proof_payment }}" alt="">
            <ul class="uk-list uk-margin">
                <li class="sc-sidebar-menu-heading custom-list-divider"><span>Riwayat Verifikasi</span></li>
            </ul>
            <div class="uk-grid uk-grid-stack" data-uk-grid>
                <ul class="uk-list uk-list-divider uk-first-column">
                    <div class="uk-list uk-list-divider uk-first-column" id="log"></div>
                </ul>
            </div>
        </div>
        <hr class="uk-margin-remove">
        <div class="uk-modal-footer uk-text-right">
            <a href="{{ route('so.printable.inv.dp', $data[$i]->id) }}?action=export" target="blank"
               class="sc-button sc-button-flat sc-button-flat-success" type="button">CEK INVOICE</a>
            <a href="#modal-reject-form{{ $data[$i]->id }}"  data-uk-toggle class="sc-button sc-button-flat sc-button-flat-danger" type="button">TOLAK</a>
            <a class="sc-button sc-button-success">
            <form  enctype="multipart/form-data" role="form" id="add_verifikasi" method="POST" action="">
                @csrf
                <input type="hidden" name="status" id="status" value="1">
                <input type="hidden" name="type" id="type" value="{{$data[$i]->type}}">
                <input type="hidden" name="id_order_payment" id="id_order_payment" value="{{$data[$i]->id_order_payment}}">
                <input type="hidden" name="order_id" id="order_id" value="{{$data[$i]->order_id}}">
                <input type="hidden" name="proof_payment" id="proof_payment" value="{{$data[$i]->proof_payment_name}}">
                <input type="hidden" name="payment_total" id="payment_total" value="{{$data[$i]->payment_total}}">
                <input type="hidden" name="id" id="id" value="{{$data[$i]->id}}">
            <button type="submit" class="sc-button sc-button-success" href="#">Terima</button>
            </form></a>
        </div>
    </div>
</div>
@endfor
@for ($i = 0; $i < $count ; $i++)
<div id="modal-reject-form{{$data[$i]->id}}" data-uk-modal>
    <div class="uk-modal-dialog">
        <div class="uk-modal-header">
            <h2 class="uk-modal-title">Berikan Alasan Penolakan</h2>
        </div>
        <form  enctype="multipart/form-data" role="form" method="POST" action="{{ route('accounting_verifikasi.tolak')}}">
        @csrf
        <div class="uk-modal-body">
            <label>Inputkan Alasan</label>
            <textarea class="uk-textarea" rows="5" data-sc-input="outline" name="keterangan"></textarea>
            <input type="hidden"  name="order_id" value="{{ $data[$i]->id_order_payment }}">
            <input type="hidden"  name="id" value="{{ $data[$i]->id }}">
            <input type="hidden"  name="is_dp" value="2">
            <input type="hidden"  name="proof_payment" value="{{ $data[$i]->log_gambar }}">
            <input type="hidden" name="type" value="{{ $data[$i]->type }}">
            <input type="hidden" name="payment_total_tolak" value="{{$data[$i]->payment_total}}">
            <input type="hidden" name="status" value="2">
        </div>
        <div class="uk-modal-footer uk-text-right">
            <button class="sc-button sc-button-flat sc-button-flat-danger uk-modal-close" type="button">Batal</button>
            <button type="submit" class="sc-button sc-button-secondary">Tolak</button>
        </div>
        </form>
    </div>
</div>
@endfor

<!-- new -->


<!-- start modal track order -->
@foreach ($data as $value)
<div id="modal-track-order{{ $value->id }}" data-uk-modal>
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

                                    <!--       <ul class="uk-list uk-margin">
                                              <li class="sc-sidebar-menu-heading custom-list-divider"><span>Data Material</span></li>
                                          </ul> -->

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


                                    <ul class="uk-list uk-margin">

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

    $(document).ready(function () {

        $('#pdev').addClass("sc-page-active");


        $('.hide-column- input:checked').each(function() {
            selected.push($(this).attr('name'));
        });
        // var table = $('#ts-issues').DataTable();

        $('.hide-column').click(function(e) {
            e.preventDefault();

            var column = table.column( $(this).attr('data-column') );
            column.visible( ! column.visible() );
            table.draw();
        });
        var id = $(".id_log").val();
         $.ajax({
            type: "GET",
            url: '{!! route('accounting_verifikasi_log.all', [':id']) !!}'.replace(':id',id),
            success: function (data) {
                console.log(data)
                $("#log").empty();
                for (i = 0; i < data.data.length; i++) {
                    var date = data.data[i].log_created_at;
                if(data.data[i].log_status == 3){
                    var status_ = "Menunggu Verifikasi";
                }else if(data.data[i].log_status == 2){
                    var status_ = "Ditolak";
                }else {
                    var  status_ = "Dikonfirmasi";
                }
                var html = "<li class='sc-list-group'>";

                if (data.data[i].log_status == 3) {
                    html += "<div class='sc-list-addon'>"+ date +"<br><span class='uk-label uk-label-success'>"+ status_ +"</span></div>";
                  } else if (data.data[i].log_status == 1) {
                    html += "<div class='sc-list-addon'>"+ date +"<br><span class='uk-label uk-label-primary'>"+ status_ +"</span></div>";
                  } else if (data.data[i].log_status == 2) {
                    html += "<div class='sc-list-addon'>"+ date +"<br><span class='uk-label uk-label-danger'>"+ status_ +"</span></div>";

                  }

                if (data.data[i].log_status == 3) {
                html += "<div class='sc-list-body'>Bukti transfer Down Payment berhasil diunggah.</div>";
                } else if (data.data[i].log_status == 2) {
                html += "<div class='sc-list-body'>"+ data.data[i].log_reason+"</div>";
                } else if (data.data[i].log_status == 1) {
                html += "<div class='sc-list-body'>Confirmed</div>";
                }
                    html += "</li>";
                $("#log").append(html);
                }

            },
            error: function (data) {
                console.log('error');
                UIkit.modal.alert(data.responseJSON.message).then(function () {

                });
            }
        });

         $('#add_verifikasi').submit(function(event){
             event.preventDefault();

             var formData = new FormData(this);


             UIkit.modal.confirm('Konfirmasi Bukti Pembayaran Ini?').then(function(){
                  $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                },
                type: 'POST',
                url: "{{ route('accounting_verifikasi.add')}}",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: (data) => {

                    UIkit.modal.alert('Confirmed!');
                    setTimeout(function() {
                        window.location.href = "{{ route('accounting_verifikasi.add') }}";
                    }, 5);
                },
                error: function(data) {
                    UIkit.modal.alert(data.responseJSON.message).then(function () {

                    });
                }
            });
        });
         });


    });



</script>
@endpush

@push('dropify')
<script src="{{ asset('assets/js/vendor/dropify/js/dropify.min.js') }}"></script>
<script>
    $(document).ready(function(){
        // Basic
        $('.dropify').dropify();

         // $('#ts-issues').DataTable();

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
        var drEvent = $('#input-file-events').dropify();

        drEvent.on('dropify.beforeClear', function(event, element){
            return confirm("Do you really want to delete \"" + element.file.name + "\" ?");
        });

        drEvent.on('dropify.afterClear', function(event, element){
            alert('File deleted');
        });

        drEvent.on('dropify.errors', function(event, element){
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
