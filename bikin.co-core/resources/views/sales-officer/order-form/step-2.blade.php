@extends('layouts.app')

@push('css-dropify')
    <link rel="stylesheet" href="{{ asset('assets/js/vendor/dropify/css/dropify.min.css') }}">
@endpush

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
                        <span>2 dari 5</span>
                    </li>
                </ul>
            </div>
        </div>
        <div id="sc-page-content">
            <div class="uk-flex-center uk-grid-small" data-uk-grid>
                <div class="uk-width-4-5@l">
                    <div class="uk-flex uk-flex-middle uk-margin-bottom md-bg-blue-grey-600 sc-round sc-padding sc-padding-medium-ends">
                        <span data-uk-icon="icon: cart; ratio: 1.5" class="uk-margin-right md-color-white"></span>
                        <h4 class="md-color-white uk-margin-remove">Spesifikasi dan Detail Order Produk (2/5)</h4>
                    </div>
                    <div class="uk-fieldset uk-fieldset-alt md-bg-white">
                        <div class="uk-card-body">
                            <form action="so-product-order-create-3.html" id="step_2_form">
                                <ul class="uk-accordion-outline" data-uk-accordion="multiple: true">
                                    <li class="uk-open">
                                        <h3 class="uk-accordion-title">Order 1 - {{ $products[0]->name }}</h3>
                                        <div class="uk-accordion-content">
                                            <div class="uk-child-width-1-2@m" data-uk-grid>
                                                <div>
                                                    <label class="uk-form-label" for="f-c2b">Pelanggan ke
                                                        Bikin.co<sup>*</sup></label>
                                                    <div class="uk-form-controls">
                                                        <select name="data_customer_order_type" id="f-c2b"
                                                                class="uk-select customer_order_type"
                                                                data-sc-select2='{ "placeholder": "Pilih jenis..." }'>
                                                            <option value="">Pilih Salah Satu</option>
                                                            @foreach($prefix_mou as $prefix_item)
                                                                <option value="{{ $prefix_item['id'] }}">{{ $prefix_item['name'] }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div>
                                                    <label class="uk-form-label" for="f-b2v">Bikin.co ke
                                                        Vendor<sup>*</sup></label>
                                                    <div class="uk-form-controls">
                                                        <select name="data_provider_order_type" id="f-b2v"
                                                                class="uk-select provider_order_type"
                                                                data-sc-select2='{ "placeholder": "Pilih jenis..." }'>
                                                            <option value="">Pilih Salah Satu</option>
                                                            @foreach($prefix_mou as $prefix_item)
                                                                <option value="{{ $prefix_item['id'] }}">{{ $prefix_item['name'] }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="uk-child-width-1-1@m" data-uk-grid>
                                                <div>
                                                    <label class="uk-form-label" for="f-sizepack">Pilih
                                                        Sizepack<sup>*</sup></label>
                                                    <div class="uk-form-controls">
                                                        <select name="data_sizepack" id="f-sizepack"
                                                                class="uk-select data_sizepack"
                                                                data-sc-select2='{ "placeholder": "Pilih sizepack..." }'>
                                                            <option value="">Pilih Salah Satu</option>
                                                            @foreach($sizepack as $sizepack_item)
                                                                <option value="{{ $sizepack_item->id }}">{{ $sizepack_item->vendor_name }}
                                                                    Sizepack
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="uk-margin-small">
                                                <label for="f-med-q-1" class="uk-margin-small-left">Sizepack belum
                                                    terdaftar?</label>
                                                <a style="margin-left: 15px;" target="_blank"
                                                   href="{{ route('sizepacks') }}" class="sc-button sc-button-mini">LIHAT
                                                    DATABASE SIZEPACK</a>
                                            </div>
                                            <hr>
                                            <h5>Informasi Label<sup>*</sup></h5>
                                            <div class="uk-grid-small" data-uk-grid>
                                                <div class="uk-width-1-3@s uk-width-1-4@m">
                                                    <ul class="uk-list uk-list-condensed">
                                                        <li>
                                                            <input type="radio" id="none"
                                                                   onchange="ifLabelHasCustom(this.value);"
                                                                   class="data_label" value="0" name="f-payment"
                                                                   data-sc-icheck data-payment-info="more-info-paypal"
                                                                   checked>
                                                            <label>Tidak Ada</label>
                                                        </li>
                                                        <li>
                                                            <input type="radio" id="none"
                                                                   onchange="ifLabelHasCustom(this.value);"
                                                                   class="data_label" value="1" name="f-payment"
                                                                   data-sc-icheck data-payment-info="more-info-paypal">
                                                            <label>Bikin.co</label>
                                                        </li>
                                                        <li>
                                                            <input type="radio" id="f-pay-moneybookers"
                                                                   onchange="ifLabelHasCustom(this.value);"
                                                                   class="data_label" value="2" name="f-payment"
                                                                   data-sc-icheck data-payment-info="more-info-skrill">
                                                            <label for="f-pay-moneybookers">Custom</label>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="uk-width-2-3@s uk-width-3-4@m more-info-section">
                                                    <div style="display: none" id="more-info-skrill">
                                                        <input type="file" name="data_has_custom_label_upload"
                                                               style="margin-bottom: 20px;">
                                                        <label class="uk-form-label" for="f-pay-skrill-name">Catatan
                                                            untuk label custom...</label>
                                                        <input class="uk-input" id="f-pay-skrill-name"
                                                               name="data_has_custom_label_notes" type="text"
                                                               data-sc-input="outline">
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                            <h5>Packaging</h5>
                                            <div class="uk-margin-small">
                                                <input type="checkbox" class="sc-js-med-info data_has_packaging"
                                                       id="f-packaging" name="data_has_packaging" data-sc-switchery
                                                       data-switchery-size="small" data-switchery-color="#1c7cd6">
                                                <label for="f-packaging" class="uk-margin-small-left">Ada packaging
                                                    khusus atau custom?</label>
                                                <div class="sc-js-el-show uk-margin-small-top uk-margin-medium-bottom">
                                                    <input type="text" class="uk-input" name="data_has_packaging_notes"
                                                           placeholder="Catatan packaging jika ada..." data-sc-input>
                                                    <br><small>Upload jika ada contoh desain packaging</small>
                                                    <input type="file" name="data_has_packaging_upload">
                                                </div>
                                            </div>
                                            <h5>Informasi Desain dan Artwork</h5>
                                            <div class="uk-margin-small">
                                                <input type="checkbox" class="sc-js-med-info data_has_design"
                                                       id="f-med-dp" name="data_has_design" data-sc-switchery
                                                       data-switchery-size="small" data-switchery-color="#1c7cd6">
                                                <label for="f-med-dp" class="uk-margin-small-left">Sudah mempunyai
                                                    desain atau mockup?</label>
                                                <button class="sc-button sc-button-flat sc-button-flat-success sc-button-mini"
                                                        data-uk-tooltip="Gambaran desain atau mockup, bisa berupa gambar preview JPEG, JPG atau PNG.">
                                                    Info
                                                </button>
                                                <a href="assets/img/bikin-master/design.png" target="blank"
                                                   class="sc-button sc-button-outline sc-button-outline-danger sc-button-mini">Lihat
                                                    Contoh</a>
                                                <div class="sc-js-el-show uk-margin-small-top uk-margin-medium-bottom">
                                                    <div class="md-bg-grey-100 sc-padding">
                                                        <div class="uk-overflow-auto">
                                                            <table class="uk-table uk-table-small uk-table-middle uk-table-divider uk-margin-remove"
                                                                   id="sc-js-dynamic-fields-education">
                                                                <thead>
                                                                <tr>
                                                                    <th class="uk-text-nowrap">Judul Desain</th>
                                                                    <th class="uk-text-nowrap">Unggah</th>
                                                                    <th></th>
                                                                </tr>
                                                                </thead>
                                                                <tbody data-sc-dynamic-fields="educationTemplate"></tbody>
                                                            </table>
                                                            <script id="educationTemplate"
                                                                    type="text/x-handlebars-template">
                                                                <tr class="sc-form-section">
                                                                    <td class="uk-width-3-5">
                                                                        <input type="text"
                                                                               class="uk-input uk-form-small"
                                                                               name="data_has_design_title[]"/>
                                                                    </td>
                                                                    <td class="uk-width-2-5">
                                                                        <div class="uk-form-controls">
                                                                            <input type="file"
                                                                                   class="uk-input uk-form-small"
                                                                                   name="data_has_design_upload[]"
                                                                                   accept="image/*">
                                                                        </div>
                                                                    </td>
                                                                    <td class="uk-table-middle uk-text-center uk-width-1-5">
                                                                        <a href="#"
                                                                           class="sc-js-section-clone sc-color-primary"><i
                                                                                    class="mdi mdi-plus sc-icon-24 sc-js-el-hide"></i><i
                                                                                    class="mdi mdi-minus sc-icon-24 sc-js-el-show"></i></a>
                                                                    </td>
                                                                </tr>
                                                            </script>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="uk-margin-small">
                                                <input type="checkbox" class="sc-js-med-info data_has_artwork"
                                                       id="f-med-da" name="data_has_artwork" data-sc-switchery
                                                       data-switchery-size="small" data-switchery-color="#1c7cd6">
                                                <label for="f-med-da" class="uk-margin-small-left">Artwork sudah
                                                    siap?</label>
                                                <button class="sc-button sc-button-flat sc-button-flat-success sc-button-mini"
                                                        data-uk-tooltip="Inputkan daftar artwork mana saja yang akan pelanggan order. Unggah dalam bentuk gambar preview. (PNG, JPG, JPEG)">
                                                    Info
                                                </button>
                                                <a href="assets/img/bikin-master/artwork.png" target="blank"
                                                   class="sc-button sc-button-outline sc-button-outline-danger sc-button-mini">Lihat
                                                    Contoh</a>
                                                <div class="sc-js-el-show uk-margin-small-top uk-margin-medium-bottom">
                                                    <div class="md-bg-grey-100 sc-padding">
                                                        <div class="uk-overflow-auto">
                                                            <div class="md-bg-grey-100 sc-padding"
                                                                 id="sc-js-dynamic-fields-empl-history">
                                                                <div data-sc-dynamic-fields="emplHistoryTemplate"></div>
                                                                <script id="emplHistoryTemplate"
                                                                        type="text/x-handlebars-template">
                                                                    <hr class="uk-margin-medium">
                                                                    <div class="uk-grid-match sc-form-section"
                                                                         data-uk-grid>
                                                                        <div class="uk-width-expand@m">
                                                                            <div class="uk-child-width-1-2@s"
                                                                                 data-uk-grid>
                                                                                <div>
                                                                                    <label class="uk-form-label"
                                                                                           for="f-choose-position-">Posisi
                                                                                        Artwork</label>
                                                                                    <div class="uk-form-controls">
                                                                                        <select class="uk-select data_artwork_position"
                                                                                                name="data_has_artwork_position[]"
                                                                                                onchange="updateArtworkSize(this.value);"
                                                                                                data-sc-select2='{"placeholder": "Pilih posisi..."}'>
                                                                                            <option value="">Pilih
                                                                                                posisi...
                                                                                            </option>
                                                                                            @foreach($artwork as $artwork_item)
                                                                                                <option value="{{ $artwork_item->id }}">{{ $artwork_item->name }}</option>
                                                                                            @endforeach
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                                <div>
                                                                                    <label class="uk-form-label"
                                                                                           for="f-choose-artsize-">Ukuran</label>
                                                                                    <div class="uk-form-controls">
                                                                                        <select class="uk-select data_has_artwork_size"
                                                                                                name="data_has_artwork_size[]"
                                                                                                data-sc-select2='{"placeholder": "Pilih ukuran..."}'>
                                                                                            <option value="">Pilih
                                                                                                ukuran...
                                                                                            </option>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                                <div>
                                                                                    <label class="uk-form-label"
                                                                                           for="f-media-cetak-">Material
                                                                                        Cetak</label>
                                                                                    <div class="uk-form-controls">
                                                                                        <select name="data_has_artwork_print_type[]"
                                                                                                data-sc-select2='{"placeholder": "Pilih material..."}'
                                                                                                class="uk-select">
                                                                                            <option value="">Pilih Salah
                                                                                                Satu...
                                                                                            </option>
                                                                                            @foreach($artwork_print as $artwork_print_item)
                                                                                                <option value="{{ $artwork_print_item->id }}">{{ $artwork_print_item->name }}</option>
                                                                                            @endforeach
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                                <div>
                                                                                    <label class="uk-form-label"
                                                                                           for="f-media-cetak-">Metode
                                                                                        Cetak</label>
                                                                                    <div class="uk-form-controls">
                                                                                        <select
                                                                                            name="data_has_artwork_print_methods[]"
                                                                                            data-sc-select2='{"placeholder": "Pilih material..."}'
                                                                                            class="uk-select">
                                                                                            <option value="">Pilih Salah
                                                                                                Satu...
                                                                                            </option>
                                                                                            @foreach($artwork_methods as $artwork_print_item)
                                                                                                <option
                                                                                                    value="{{ $artwork_print_item->id }}">{{ $artwork_print_item->name }}</option>
                                                                                            @endforeach
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                                <div>
                                                                                    <label class="uk-form-label"
                                                                                           for="f-artworkcolorcount-">Jumlah
                                                                                        Warna</label>
                                                                                    <div class="uk-form-controls">
                                                                                        <input type="text"
                                                                                               class="uk-input uk-form-small"
                                                                                               name="data_has_artwork_color_qty[]">
                                                                                    </div>
                                                                                </div>
                                                                                <div>
                                                                                    <label class="uk-form-label"
                                                                                           for="f-uploadartwork-">Unggah
                                                                                        Preview Artwork (JPG, PNG,
                                                                                        JPEG)</label>
                                                                                    <div class="uk-form-controls">
                                                                                        <input type="file"
                                                                                               class="uk-input uk-form-small"
                                                                                               name="data_has_artwork_upload[]"
                                                                                               accept="image/*"/>
                                                                                    </div>
                                                                                </div>
                                                                                <div>
                                                                                    <label class="uk-form-label"
                                                                                           for="f-uploadvectorartwork-">Unggah
                                                                                        Vector Artwork (Zip.)</label>
                                                                                    <div class="uk-form-controls">
                                                                                        <input type="file"
                                                                                               class="uk-input uk-form-small"
                                                                                               name="data_has_artwork_vector_upload[]"
                                                                                               accept="zip,application/octet-stream,application/zip,application/x-zip,application/x-zip-compressed">
                                                                                    </div>
                                                                                </div>
                                                                                <div>
                                                                                    <label class="uk-form-label"
                                                                                           for="additional-price-">Informasi
                                                                                        Tambahan Harga :</label>
                                                                                    <span class="uk-badge">Rp. 2.000</span>
                                                                                    <small>/unit</small>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="uk-width-auto@m uk-flex-middle uk-text-center">
                                                                            <a href="#"
                                                                               class="sc-js-section-clone sc-color-primary"><i
                                                                                        class="mdi mdi-plus-box-outline sc-icon-24 sc-js-el-hide"
                                                                                        onclick="duplicateElements();"></i><i
                                                                                        class="mdi mdi-minus-box-outline sc-icon-24 sc-js-el-show"></i></a>
                                                                        </div>
                                                                    </div>
                                                                </script>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="uk-margin-small">
                                                <input type="checkbox" class="sc-js-med-info data_has_design_reference"
                                                       name="data_has_design_reference" id="f-med-rd" data-sc-switchery
                                                       data-switchery-size="small" data-switchery-color="#1c7cd6">
                                                <label for="f-med-rd" class="uk-margin-small-left">Belum punya desain
                                                    tapi punya referensi atau contoh?</label>
                                                <button class="sc-button sc-button-flat sc-button-flat-success sc-button-mini"
                                                        data-uk-tooltip="Pelanggan ingin memesan tetapi hanya mempunyai referensinya atau contoh desain saja. Desain belum siap.">
                                                    Info
                                                </button>
                                                <div class="sc-js-el-show uk-margin-small-top uk-margin-medium-bottom">
                                                    <input type="text" class="uk-input"
                                                           name="data_has_design_reference_link"
                                                           placeholder="Inputkan berupa link..." data-sc-input>
                                                    <br><small>Atau unggah jika berupa file (JPG, PNG, JPEG)</small>
                                                    <input type="file" name="data_has_design_reference_upload"
                                                           accept="image/*">
                                                </div>
                                            </div>
                                            <div class="uk-margin-small">
                                                <input type="checkbox" class="sc-js-med-info data_has_artwork_reference"
                                                       id="f-med-ra" name="data_has_artwork_reference" data-sc-switchery
                                                       data-switchery-size="small" data-switchery-color="#1c7cd6">
                                                <label for="f-med-ra" class="uk-margin-small-left">Belum punya vector
                                                    artwork tapi sudah punya referensi artwork?</label>
                                                <button class="sc-button sc-button-flat sc-button-flat-success sc-button-mini"
                                                        data-uk-tooltip="Pelanggan ingin memesan, tetapi untuk artwork nya hanya punya contoh atau referensinya saja.">
                                                    Info
                                                </button>
                                                <div class="sc-js-el-show uk-margin-small-top uk-margin-medium-bottom">
                                                    <input type="text" class="uk-input"
                                                           name="data_has_artwork_reference_link"
                                                           placeholder="Inputkan jika berupa link..." data-sc-input>
                                                    <br><small>Upload jika berupa file</small>
                                                    <input type="file" name="data_has_artwork_reference_upload">
                                                </div>
                                            </div>
                                            <br>
                                            <h5>Informasi Pengerjaan</h5>
                                            <br><br>
                                            <div class="uk-grid" data-uk-grid>
                                                <div class="uk-width-1-2@l uk-width-1-2@s">
                                                    <div>
                                                        <p class="uk-form-help-block">Tanggal Masuk Order</p>
                                                        <input type="text" class="uk-input"
                                                               name="data_customer_start_date"
                                                               data-sc-flatpickr='{ "altInput": true, "altFormat": "F j, Y" }'
                                                               placeholder="Tentukan Tanggal">
                                                    </div>
                                                </div>
                                                <div class="uk-width-1-2@l uk-width-1-2@s">
                                                    <div>
                                                        <p class="uk-form-help-block">Tanggal Selesai Order</p>
                                                        <input type="text" class="uk-input"
                                                               name="data_customer_finish_date"
                                                               data-sc-flatpickr='{ "altInput": true, "altFormat": "F j, Y" }'
                                                               placeholder="Tentukan Tanggal">
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                            <br><br>
                                            <label class="uk-form-label" for="f-c2b">Pilih Vendor <sup>*</sup> </label>
                                            <div class="uk-form-controls" style="margin-bottom: 30px;">
                                                <select name="data_vendor" id="f-choose-vendor"
                                                        class="uk-select data_vendor"
                                                        data-sc-select2='{ "placeholder": "Pilih vendor..." }'>
                                                    <option value="">Pilih Salah Satu</option>
                                                    @foreach($vendor as $vendor_item)
                                                        <option value="{{ $vendor_item->id }}">{{ $vendor_item->vendor_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="uk-grid" data-uk-grid>
                                                <div class="uk-width-1-2@l uk-width-1-2@s">
                                                    <div>
                                                        <p class="uk-form-help-block">Tanggal Masuk Order</p>
                                                        <input type="text" name="data_vendor_start_date"
                                                               class="uk-input"
                                                               data-sc-flatpickr='{ "altInput": true, "altFormat": "F j, Y" }'
                                                               placeholder="Tentukan Tanggal">
                                                    </div>
                                                </div>
                                                <div class="uk-width-1-2@l uk-width-1-2@s">
                                                    <div>
                                                        <p class="uk-form-help-block">Tanggal Selesai Order</p>
                                                        <input type="text" name="data_vendor_finish_date"
                                                               class="uk-input"
                                                               data-sc-flatpickr='{ "altInput": true, "altFormat": "F j, Y" }'
                                                               placeholder="Tentukan Tanggal">
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                            <h5>Catatan Order</h5>
                                            <textarea name="data_order_notes" cols="30" rows="6"
                                                      class="uk-textarea"></textarea>
                                        </div>
                                    </li>
                                </ul>
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

    <!-- start modal input sizepack -->
    <div id="sizepack-add-modal" data-uk-modal style="z-index: 1600;">
        <div class="uk-modal-dialog">
            <button class="uk-modal-close-default" type="button" data-uk-close></button>
            <div class="uk-modal-header">
                <h2 class="uk-modal-title">Input Master Sizepack</h2>
            </div>
            <div class="uk-modal-body">
                <form>
                    <div class="uk-margin">
                        <label>Nama Vendor<sup>*</sup></label>
                        <input type="text" class="uk-input" value="" data-sc-input>
                    </div>
                    <div class="uk-margin">
                        <label>Kode Sizepack<sup>*</sup></label>
                        <input type="text" class="uk-input" value="" data-sc-input>
                    </div>
                    <div>
                        <label>Status Sizepack<sup>*</sup></label> <br>
                        <input type="checkbox" data-sc-switchery checked/><label class="uk-margin-small-left">Aktif /
                            Non Aktif</label>
                    </div>
                    <br>
                    <div class="sc-list-body">
                        <label style="margin-bottom: 10px;" for="input-file-max-fs">Unggah gambar dengan resolusi
                            600x600 piksel (jika ada)</label>
                        <input type="file" id="input-file-max-fs" class="dropify" data-max-file-size="2M"/>
                    </div>
                </form>
            </div>
            <div class="uk-modal-footer uk-text-right">
                <button class="sc-button sc-button-flat sc-button-flat-danger uk-modal-close" type="button">Batal
                </button>
                <button class="sc-button" type="button">Tambah</button>
            </div>
        </div>
    </div>
    <!-- end modal input sizepack -->
@endsection

@push('scripts')
    <script>

        function ifLabelHasCustom(data) {
            return alert(data);
        }

        let artwork_itr = 0;

        // Ajax Post form
        $('#step_2_form').submit(function (evt) {
            evt.preventDefault();

            let formData = new FormData(this);
            formData.append('_token', "{{ csrf_token() }}");


            let data_has_design = $('.data_has_design').is(':checked') === true ? '1' : '0';
            let data_has_artwork = $('.data_has_artwork').is(':checked') === true ? '1' : '0';
            let data_has_design_reference = $('.data_has_design_reference').is(':checked') === true ? '1' : '0';
            let data_has_artwork_reference = $('.data_has_artwork_reference').is(':checked') === true ? '1' : '0';
            let data_has_packaging = $('.data_has_packaging').is(':checked') === true ? '1' : '0';

            formData.append('data_has_design', data_has_design);
            formData.append('data_has_artwork', data_has_artwork);
            formData.append('data_has_design_reference', data_has_design_reference);
            formData.append('data_has_artwork_reference', data_has_artwork_reference);
            formData.append('data_has_packaging', data_has_packaging);
            formData.append('session', "{{ $sessions }}");


            let ajax = {
                type: 'POST',
                url: "{{ route('foc.save.2') }}",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function (response) {
                    location.reload();
                    // console.log(response);
                },
                error: function (response) {
                    console.log(response)
                }
            };

            performAjax(ajax);
        });


        function updateArtworkSize(id) {
            let artwork_size_select = $('.data_has_artwork_size');

            let ajax = {
                type: 'GET',
                url: 'source/data/artwork-size/' + id,
                success: function (response) {
                    $(artwork_size_select[artwork_itr]).empty();
                    $(artwork_size_select[artwork_itr]).append("<option value=''>Pilih Salah Satu</option>");

                    for (let i in response.data.artwork_size) {
                        if (response.data.artwork_size.hasOwnProperty(i)) {
                            $(artwork_size_select[artwork_itr]).append("<option value='" + response.data.artwork_size[i].id + "'>" + response.data.artwork_size[i].size + "</option>");
                        }
                    }
                },
                error: function (response) {
                    console.log(response);
                }
            };
            performAjax(ajax);
        }

        function updateArtworkSizeWithItr(index, id) {
            let artwork_size_select = $('.data_has_artwork_size');

            let ajax = {
                type: 'GET',
                url: 'source/data/artwork-size/' + id,
                success: function (response) {
                    $(artwork_size_select[index]).empty();
                    $(artwork_size_select[index]).append("<option value=''>Pilih Salah Satu</option>");

                    for (let i in response.data.artwork_size) {
                        if (response.data.artwork_size.hasOwnProperty(i)) {
                            $(artwork_size_select[index]).append("<option value='" + response.data.artwork_size[i].id + "'>" + response.data.artwork_size[i].size + "</option>");
                        }
                    }
                },
                error: function (response) {
                    console.log(response);
                }
            };
            performAjax(ajax);
        }

        function duplicateElements() {
            $('.data_artwork_position').each(function (index) {
                $(this).attr('onchange', "updateArtworkSizeWithItr(" + index + ", this.value)");
            });

            artwork_itr++;
        }


        function performAjax(source) {
            return $.ajax(source);
        }
    </script>
@endpush

@push('dropify')
    <script src="{{ asset('assets/js/vendor/dropify/js/dropify.min.js') }}"></script>
    <script>

        $(document).ready(function () {

            // Basic
            $('.dropify').dropify();

            // Used events
            var drEvent = $('.dropify-data').dropify();

            drEvent.on('dropify.beforeClear', function (event, element) {
                // console.log(element);
                if (element.file.name === null) {
                    return confirm('Yakin ingin hapus file ini : ' + element.filenameWrapper[0].children[1].innerHTML + '?');
                } else {
                    return confirm("Do you really want to delete \"" + element.file.name + "\" ?");
                }
            });

            drEvent.on('dropify.afterClear', function (event, element) {
                alert('File deleted');
            });

            drEvent.on('dropify.errors', function (event, element) {
                console.log('Has Errors');
            });

        });
    </script>
@endpush
