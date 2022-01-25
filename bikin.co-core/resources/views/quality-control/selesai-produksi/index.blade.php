@extends('layouts.app')

@section('content')
<div id="sc-page-wrapper">
	<div id="sc-page-top-bar" class="sc-top-bar uk-flex-middle">
		<div class="sc-top-bar-content sc-padding-medium-ends uk-flex-1">
			<div class="uk-flex uk-flex-column uk-flex-1">
				<h1 class="sc-top-bar-title uk-text-uppercase uk-margin-small-bottom">Daftar Order Diproses</h1>
				<span class="sc-top-bar-subtitle">Role: Sales Officer, Vendor, Quality Control</span>
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
              <th>Track</th>
              <th>Aksi</th>
              <th>Order ID</th>
              <th>Pelanggan</th>
              <th class="filter-select" data-placeholder="Select...">Produk</th>
              <th class="filter-select" data-placeholder="Select...">Prioritas</th>
              <th>Tanggal Order</th>
            </tr>
          </thead>
          <tbody>
         @foreach ($data as $value)
            <tr>
                <td>
                    <a style="margin-top: 5px;" href="#modal-lihat{{ $value->id }}" onclick="getDataImage({{ $value->order_item_id }})" data-uk-toggle class="sc-button sc-button-mini sc-button-danger" >Lihat</a>
                </td>
                <td>
                    <a style="margin-top: 5px;" href="#modal-track-order" data-uk-toggle class="sc-button sc-button-mini" href="#">TRACK</a>
                    <a style="margin-top: 5px;"
                       href="sales-officer/printable/spk/customer/{{ $value->id }}?action=export" target="blank"
                       class="sc-button sc-button-mini">SPK CUSTOMER</a>
                    <a style="margin-top: 5px;" href="sales-officer/printable/spk/vendor/{{ $value->id }}?action=export"
                       target="blank" class="sc-button sc-button-mini">SPK VENDOR</a>
					<a style="margin-top: 5px;" href="{{ route('pd_upload.print', $value->id) }}" target="blank" class="sc-button sc-button-mini">PRINT ARTWORK</a>
                    <a style="margin-top: 5px;" href="vendor/printable/bill-of-material/{{ $value->id }}?action=export"
                       target="blank" class="sc-button sc-button-mini">MATERIAL</a>
                </td>
                <td><a href="sales-officer/printable/quotation/{{ $value->id }}?action=export"
                       target="blank">{{ $value->id }}</a></td>
                <td>{{ $value->fullname }}</td>
                <td>{{ $value->name }}</td>
                <td>
                    @if($value->priority == 0)
                    <span class="uk-label uk-label-danger">Prioritas</span>
                    @elseif($value->priority == 1)
                     <span class="uk-label">Tidak Prioritas</span>
                    @endif
                </td>
                <td>{{ $value->tgl_order }}</td>
            </tr>
           @endforeach
          </tbody>
        </table>
      </div>
		</div>
	</div>
</div>


<!-- start modal lihat -->
@foreach ($data as $value)
<div id="modal-lihat{{ $value->id }}" data-uk-modal>
    <div class="uk-modal-dialog">
        <button class="uk-modal-close-default" type="button" data-uk-close></button>
        <div class="uk-modal-header">
        </div>

            <p style="text-align: center;">Lihat Hasil Produksi</p>
            <div class="uk-flex-center uk-margin" data-uk-grid>
                <div class="uk-width-2-3@m">
                    <div class="uk-card uk-margin">
                        <h3 class="uk-card-title">Hasil produksi vendor</h3>
                        <div class="uk-card-body">
                            <div class="uk-position-relative uk-visible-toggle uk-light" data-uk-slider="center: true">
                                <ul class="uk-slider-items uk-grid" id="img_carousel{{$value->order_item_id}}">

                                </ul>
                                <a class="uk-position-center-left uk-position-small uk-hidden-hover" href="#" data-uk-slidenav-previous data-uk-slider-item="previous"></a>
                                <a class="uk-position-center-right uk-position-small uk-hidden-hover" href="#" data-uk-slidenav-next data-uk-slider-item="next"></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        <hr class="uk-margin-remove">
        <div class="uk-modal-footer uk-text-right">
            <a href="#modal-komplain-vendor{{ $value->id }}"  data-uk-toggle class="sc-button sc-button-flat sc-button-flat-danger" type="button">KOMPLAIN</a>
            <a id="sc-js-modal-confirm-dp" class="sc-button sc-button-success" onclick="updateSesuai({{ $value->id }})">SESUAI</a>
        </div>
    </div>
</div>
@endforeach
<!-- end modal lihat -->
<!-- start modal track order -->
@foreach ($data as $value)
<div id="modal-track-order" data-uk-modal>
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
                                                        <table class="custom-table-1" style="margin-left: 50px;">
                                                            <tr>
                                                                <th>Produk</th>
                                                                <th>Harga </th>
                                                                <th>Jumlah</th>
                                                                <th>Total</th>
                                                            </tr>
                                                            <tr>
                                                                <td>Kaos O-Neck</td>
                                                                <td>Rp. 50.000</td>
                                                                <td>72</td>
                                                                <td>Rp. 3.190.000</td>
                                                            </tr>
                                                            <tr style="background-color: lightgray;">
                                                                <td colspan="3">Total</td>
                                                                <td>Rp. 3.190.000</td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="uk-width-1-1@l uk-width-1-1@s">
                                                    <div class="uk-grid" data-uk-grid>
                                                        <p class="uk-margin-remove sc-text-semibold">Informasi Tambahan Biaya</p> <br>
                                                        <table class="custom-table-1" style="margin-left: 50px;">
                                                            <tr>
                                                                <th>Item</th>
                                                                <th>Harga</th>
                                                                <th>Jumlah</th>
                                                                <th>Total</th>
                                                            </tr>
                                                            <tr>
                                                                <td>Bubble wrap 15 lapis</td>
                                                                <td>Rp. 10.000</td>
                                                                <td>72</td>
                                                                <td>Rp. 720.000</td>
                                                            </tr>
                                                            <tr style="background-color: lightgray;">
                                                                <td colspan="3">Total Tambahan</td>
                                                                <td>Rp. 720.000</td>
                                                            </tr>
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
                                                                        <p class="uk-margin-remove sc-text-semibold">Rp. 3.910.000</p>
                                                                        <br>
                                                                        <p class="uk-margin-remove sc-text-semibold">Rp. 1.955.000</p>
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
                                            <table class="custom-table-1">
                                                <tr>
                                                    <th>No.</th>
                                                    <th>Ukuran</th>
                                                    <th>Jenis</th>
                                                    <th>Jumlah</th>
                                                </tr>
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
                                                <tr style="background-color: lightgray;">
                                                    <td colspan="3">Total Kuantitas Order</td>
                                                    <td><strong>30 buah</strong></td>
                                                </tr>
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
                                                <span class="sc-list-secondary-text"></span>
                                            </div>
                                        </li>
                                        <li class="sc-list-group">
                                            <div class="sc-list-body">
                                                <p class="uk-margin-remove sc-text-semibold">Bikin.co -> Vendor</p>
                                                <span class="sc-list-secondary-text"></span>
                                            </div>
                                        </li>
                                        <li class="sc-list-group">
                                            <div class="sc-list-body">
                                                <p class="uk-margin-remove sc-text-semibold">Size Pack</p>
                                                <span class="sc-list-secondary-text">HitamYK Sizepack <br><a href="#"> >> Download</a></span>
                                            </div>
                                        </li>
                                        <li class="sc-list-group">
                                            <div class="sc-list-body">
                                                <p class="uk-margin-remove sc-text-semibold">Label</p>
                                                <span class="sc-list-secondary-text">Label dari brand sendiri. Desain sudaha ada <br><a href="#"> >> Download</a></span>
                                            </div>
                                        </li>
                                        <li class="sc-list-group">
                                            <div class="sc-list-body">
                                                <p class="uk-margin-remove sc-text-semibold">Packaging</p>
                                                <!-- <span class="sc-list-secondary-text">Standard Bikin.co</span> -->
                                                <span class="sc-list-secondary-text">Dibuat dus unik dengan brand sendiri <br><a href="#"> >> Download</a></span>
                                            </div>
                                        </li>
                                        <li class="sc-list-group">
                                            <div class="sc-list-body">
                                                <p class="uk-margin-remove sc-text-semibold">Washing</p>
                                                <span class="sc-list-secondary-text">Ya (Jenis Washing)</span>
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
                                                <table class="custom-table-1">
                                                    <tr>
                                                        <th>Judul</th>
                                                        <th>Gambar</th>
                                                    </tr>
                                                    <tr>
                                                        <td>Desain 1 (Depan)</td>
                                                        <td><img src="printable/samples/img/spk/mockup/mockup.png" alt=""></td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </li>
                                        <li class="sc-list-group">
                                            <div class="sc-list-body">
                                                <p class="uk-margin-remove sc-text-semibold">Data Artwork</p> <br>
                                                <table class="custom-table-1">
                                                    <tr>
                                                        <th>Posisi</th>
                                                        <th>Ukuran</th>
                                                        <th>Material</th>
                                                        <th>Jumlah Warna</th>
                                                        <th>Preview</th>
                                                        <th>Vector</th>
                                                        <th>Harga</th>
                                                    </tr>
                                                    <tr>
                                                        <td>Dada Tengah</td>
                                                        <td>A4</td>
                                                        <td>Sablon Rubber</td>
                                                        <td>10</td>
                                                        <td><img src="https://i.pinimg.com/originals/cd/18/a3/cd18a3cf2212509defd5e43bbf3f266a.png" alt=""></td>
                                                        <td><a href="#"> >> Download</a></td>
                                                        <td>Rp. 2.000</td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </li>
                                        <hr>
                                        <li class="sc-list-group">
                                            <div class="sc-list-body">
                                                <p class="uk-margin-remove sc-text-semibold">Punya referensi desain produk saja</p>
                                                <span class="uk-label uk-label-success">Ada</span>
                                                <img src="https://cdn1.productnation.co/stg/sites/5/5eaa9033577ba.jpeg" alt="">
                                                <!-- ada validasi, jika link=null maka yg muncul download. Jika image attachment null = maka yang muncul link saja -->
                                            </div>
                                        </li>
                                        <li class="sc-list-group">
                                            <div class="sc-list-body">
                                                <p class="uk-margin-remove sc-text-semibold">Punya referensi artwork saja</p>
                                                <span class="uk-label uk-label-success">Ada</span>
                                                <!-- <span class="sc-list-secondary-text"><a href="#" target="blank"> >> Link</a> atau <a href="#" target="blank"> >> Download</a></span> -->
                                                <img src="http://i.gzn.jp/img/2018/03/13/coltrane-pitch-diagrams/00.jpg" alt="">
                                                <!-- ada validasi, jika link=null maka yg muncul download. Jika image attachment null = maka yang muncul link saja -->
                                            </div>
                                        </li>
                                    </ul>

                                    <ul class="uk-list uk-margin">
                                        <li class="sc-sidebar-menu-heading custom-list-divider"><span>Data Material</span></li>
                                    </ul>
                                    <!-- list data ini sesuai data pada product material yang terinput pada order -->
                                    <ul class="uk-list custom-inline-list">
                                        <!-- start group -->
                                        <li class="sc-list-group">
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

                                    </ul>
                                    <!-- end list data product material -->

                                    <ul class="uk-list uk-margin">
                                        <li class="sc-sidebar-menu-heading custom-list-divider"><span>Data Aksesoris (Tambahan)</span></li>
                                    </ul>

                                    <!-- data ini sesuai data asesoris yang diinput ketika input foc -->
                                    <ul class="uk-list custom-inline-list">
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

                                    </ul>

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
                                    </ul>
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

<!-- start modal komplain vendor -->
@foreach ($data as $value)
<div id="modal-komplain-vendor{{ $value->id }}" data-uk-modal>
<input type="hidden" id="id_" value="{{ $value->id }}">
	<div class="uk-modal-dialog uk-modal-body">
		<button class="uk-modal-close-default" type="button" data-uk-close></button>
		<div class="uk-modal-body">
				<div class="custom-form-divider">
					<span class="custom-no-margin-bottom">Input Komplain ke Vendor</span>
                    <p>Apabila memiliki masalah setelah menerima produk, kamu dapat mengajukan komplain dengan cara berikut ini:</p>
				</div>
                <hr>
            <form enctype="multipart/form-data" action="" id="complain_form" method="post" >
                {{csrf_field()}}
            <div class="uk-grid" data-uk-grid>
                <div class="uk-width-1-1@l uk-width-1-1@s">
                    <label for="">Pilih jenis komplain</label>
                    <select name="jenis_komplain" id="jenis_komplain"  class="uk-select" data-sc-select2='{"placeholder": "Pilih paket pengiriman", "allowClear": true }'>
                        <option value="1">Produk tidak lengkap atau kurang</option>
                        <option value="2">Produk rusak</option>
                        <option value="3">Produk tidak sesuai deskripsi</option>
                    </select>
                </div>
                <div class="uk-width-1-1@l uk-width-1-1@s">
                    <label for="">Catatan Komplain</label>
                    <textarea name="notes" id="notes" cols="30" rows="6" class="uk-textarea"></textarea>
                </div>
                <div class="uk-width-1-1@l uk-width-1-1@s">
                    <label><div class="custom-form-labeller"><span>Lampiran</span> </div></label>
                    <input class="uk-input" name="lampiran" id="lampiran" type="text" data-sc-input="outline" placeholder="Link Google Drive, DropBox, dll">
                </div>
            </div>
		</div>
		<p class="uk-text-right">
            <!-- button ini muncul setelah dapet result opsi paket pengiriman -->
            <button type="submit" class="sc-button sc-button-danger sc-js-button-loading" data-button-mode="light">Komplain</button>
		</p>
		</form>
	</div>
</div>
@endforeach
<!-- end modal komplain vendor -->
@endsection


@push('scripts')
<script>
function getDataImage(id) {
        $.ajax({
            type: "GET",
            url: '{!! route('order_selesai_produksi.allImage', [':id']) !!}'.replace(':id', id),
            success: function (data) {
                $('#img_carousel'+id+'').empty();

                for (i = 0; i < data.data.length; i++) {

                        var html = '<li class="uk-width-3-4">';
                         html += '<img src="' + data.data[i].image +'" alt="">';
                         html += '</li>';

                        $('#img_carousel'+id+'').append(html);

                }

            },
            error: function (data) {
                console.log('error');
                UIkit.modal.alert(data.responseJSON.message).then(function () {

                });
            }
        });
    }
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
                console.log(data.data[0]);

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
 }
	function updateSesuai(id)
	{
	        UIkit.modal.confirm('Produksi sudah Sesuai, tidak ada komplain?').then(function(){
	                  $.ajax({
	                headers: {
	                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
	                },
	                type: 'POST',
	                url: "{{ route('order_selesai_produksi.done', [":id"]) }}".replace(':id',id),
	                cache: false,
	                contentType: false,
	                processData: false,
	                success: (data) => {

                        UIkit.modal.alert('Confirmed!');
	                    setTimeout(function() {
                            window.location.href = "{{ route('order_selesai_produksi.index') }}";
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
		$('#qc').addClass("sc-page-active");

        $('#complain_form').submit(function (event) {
            event.preventDefault();
            // var notes = $('#notes').val();
            // var lampiran = $('#lampiran').val();
            // var jenis_komplain = $('#jenis_komplain').val();
            var id = $('#id_').val();

            var formData = new FormData(this);
            formData.append('id', id);
			$.ajax({
	        headers: {
	            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
	        },
	        type: 'POST',
	        url: "{{ route('order_selesai_produksi.komplain', [":id"]) }}".replace(':id',id),
	        data: formData,
	        cache: false,
	        contentType: false,
	        processData: false,
	        success: (data) => {

                // UIkit.modal.alert('Confirmed!');
	            setTimeout(function() {
	                window.location.href = "/order/selesai/produksi";
	            }, 5);
	        },
	        error: function(data) {
	            UIkit.modal.alert(data.responseJSON.message).then(function () {

	            });
	        }
	    });
            });

    });
</script>
@endpush
