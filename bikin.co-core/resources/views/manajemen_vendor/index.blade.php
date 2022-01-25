@extends('layouts.app')

@push('css-dropify')
    <link rel="stylesheet" href="{{ asset('assets/js/vendor/dropify/css/dropify.min.css') }}">
@endpush

@section('content')
    <div id="sc-page-wrapper">
        <div id="sc-page-content">
            <div class="uk-alert-icon" data-uk-alert>
                <a class="uk-alert-close" data-uk-close></a>
                <div class="uk-flex uk-flex-middle">
                    <i class="mdi mdi-bullhorn sc-icon-32 uk-margin-right"></i>
                    <div class="uk-alert-content">
                        <h5>Pada halaman ini terdapat data Manajemen Vendor dari Bikin-co</h5>
                        <p>Anda dapat menambah, mengedit dan menghapus data material sesuai kebutuhan Anda.</p>
                    </div>
                </div>
            </div>

            <div class="uk-card uk-margin">
                <div class="uk-flex-middle sc-padding sc-padding-medium-ends uk-grid-small" data-uk-grid>
                    <div class="uk-flex-1">
                        <h3 class="uk-card-title">Data Manajemen Vendor</h3>
                    </div>
                    <div class="uk-width-auto@s">
                        <button class="sc-button sc-button-primary sc-button-flex" type="button">Pengaturan Kolom <i
                                    class="mdi mdi-chevron-down uk-margin-small-left"></i></button>
                        <div class="uk-dropdown uk-width-small" data-uk-drop="mode: click">
                            <div class="sc-padding-small hide-columns-">
                                <div class="uk-margin-small">
                                    <input type="checkbox" class="hide-column" value="0" checked disabled>
                                    <label for="sc-dt-col-0">No</label>
                                </div>
                                <div class="uk-margin-small">
                                    <input type="checkbox" name="check_1" class="hide-column" data-column="1" value="1"
                                           checked>
                                    <label for="sc-dt-col-1">Nama Vendor</label>
                                </div>
                                <div class="uk-margin-small">
                                    <input type="checkbox" name="check_2" class="hide-column" data-column="2" value="2"
                                           checked>
                                    <label for="sc-dt-col-1">Nama Owner</label>
                                </div>

                                <div class="uk-margin-small">
                                    <input type="checkbox" name="check_3" class="hide-column" data-column="3" value="3"
                                           checked>
                                    <label for="sc-dt-col-7">Aksi</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr class="uk-margin-remove">
                <div class="uk-card-body">
                    <table id="vendor-table" class="vendor-table uk-table uk-table-striped dt-responsive">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Vendor</th>
                            <th>Nama Owner</th>
                            <th>Aksi</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Modal -->
    <div class="sc-fab-card-wrapper uk-position-bottom-right">
        <a href="#modal-add-customer" onclick="$('#add_form').trigger('reset');" data-uk-toggle
           class="sc-fab sc-fab-text sc-fab-success"><i class="mdi mdi-plus"></i>Tambah</a>
    </div>


    <!-- start modal detail customer -->
    <div id="modal-detail-customer" data-uk-modal>
        <div class="uk-modal-dialog uk-modal-body">
            <button class="uk-modal-close-default" type="button" data-uk-close></button>
            <h2 class="uk-modal-title">Detail Vendor</h2>
            <!-- TODO-005 - Add Customer Form -->
            <div class="uk-modal-body uk-padding-remove">
                <div class="uk-grid" data-uk-grid="">
                    <div class="uk-width-1-1@s" style="margin-left: 45%;">
                        <div class="sc-avatar-wrapper sc-avatar-wrapper-md">
                            <!-- <span class="sc-user-status away"></span> -->
                            <div id="detail_upload_path"></div>
                        </div>
                    </div>
                    <div class="uk-width-1-2@l">
                        <div class="sc-padding-medium">
                            <ul class="uk-list uk-list-divider">
                                <li class="sc-list-group">
                                    <div class="sc-list-addon"><i class="mdi mdi-account"></i></div>
                                    <div class="sc-list-body">
                                        <p class="uk-margin-remove sc-text-semibold" id="detail_v_names"></p>
                                        <span class="sc-list-secondary-text">Nama Vendor</span>
                                    </div>
                                </li>
                                <li class="sc-list-group">
                                    <div class="sc-list-addon"><i class="mdi mdi-account-details"></i></div>
                                    <div class="sc-list-body">
                                        <p class="uk-margin-remove sc-text-semibold" id="detail_o_names"></p>
                                        <span class="sc-list-secondary-text">Admin / Owner</span>
                                    </div>
                                </li>
                                <li class="sc-list-group">
                                    <div class="sc-list-addon"><i class="mdi mdi-email"></i></div>
                                    <div class="sc-list-body">
                                        <p class="uk-margin-remove sc-text-semibold" id="detail_email"></p>
                                        <span class="sc-list-secondary-text">Email</span>
                                    </div>
                                </li>
                                <li class="sc-list-group">
                                    <div class="sc-list-addon"><i class="mdi mdi-phone"></i></div>
                                    <div class="sc-list-body">
                                        <p class="uk-margin-remove sc-text-semibold" id="detail_kontak"></p>
                                        <span class="sc-list-secondary-text">Kontak</span>
                                    </div>
                                </li>
                                <li class="sc-list-group">
                                    <div class="sc-list-addon"><i class="mdi mdi-office-building"></i></div>
                                    <div class="sc-list-body">
                                        <p class="uk-margin-remove sc-text-semibold" id="detail_website"><a href="#"
                                                                                                            target="blank"></a>
                                        </p>
                                        <span class="sc-list-secondary-text">Web</span>
                                    </div>
                                </li>
                                <br>
                                <li class="sc-list-group">
                                    <div class="sc-list-addon"><i class="mdi mdi-airballoon-outline"></i></div>
                                    <div class="sc-list-body">
                                        <div id="detail_jenis_produk"></div>
                                        <span class="sc-list-secondary-text">Produk Dilayani</span>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="uk-width-1-2@l">
                        <div class="sc-padding-medium">
                            <ul class="uk-list uk-list-divider">
                                <li class="sc-list-group">
                                    <div class="sc-list-addon"><i class="mdi mdi-map-marker"></i></div>
                                    <div class="sc-list-body">
                                        <p class="uk-margin-remove sc-text-semibold" id="detail_province"></p>
                                        <span class="sc-list-secondary-text">Provinsi</span>
                                    </div>
                                </li>
                                <li class="sc-list-group">
                                    <div class="sc-list-addon"><i class="mdi mdi-city"></i></div>
                                    <div class="sc-list-body">
                                        <p class="uk-margin-remove sc-text-semibold" id="detail_kabupaten"></p>
                                        <span class="sc-list-secondary-text">Kota / Kabupaten</span>
                                    </div>
                                </li>
                                <li class="sc-list-group">
                                    <div class="sc-list-addon"><i class="mdi mdi-home"></i></div>
                                    <div class="sc-list-body">
                                        <p class="uk-margin-remove sc-text-semibold sc-list-secondary-text"
                                           id="detail_alamat"></p>
                                        <span class="sc-list-secondary-text">Alamat Lengkap</span>
                                    </div>
                                </li>
                                <li class="sc-list-group">
                                    <div class="sc-list-addon"><i class="mdi mdi-cart"></i></div>
                                    <div class="sc-list-body">
                                        <p class="uk-margin-remove sc-text-semibold" id="detail_username"></p>
                                        <span class="sc-list-secondary-text">Username</span>
                                    </div>
                                </li>
                                <li class="sc-list-group">
                                    <div class="sc-list-addon"><i class="mdi mdi-asterisk"></i></div>
                                    <div class="sc-list-body">
                                        <p class="uk-margin-remove sc-text-semibold">Status Akun</p>
                                        <span class="sc-list-secondary-text"><div class="statusAktif"></div></span>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="uk-width-1-1@l">
                    <h3 class="uk-card-title ">Order Aktif</h3>
                    <div class="uk-card-body">
                        <div class="uk-overflow-auto">
                            <table class="uk-table uk-table-striped uk-table-hover uk-table-middle">
                                <thead>
                                <tr>
                                    <th class="uk-table-shrink"></th>
                                    <th>Produk</th>
                                    <th>Nama Pelanggan</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td class="uk-text-right">1</td>
                                    <td class="uk-text-nowrap"><a
                                                href="printable/sales-officer-product-spk-customer.html" target="blank"
                                                class="sc-text-semibold">Kaos O-Neck</a></td>
                                    <td class="uk-text-nowrap">Claudie Wyman</td>
                                    <td><span class="uk-label uk-label-danger">dibatalkan</span></td>
                                    <td><a href="#" class="mdi mdi-file-outline sc-icon-square"></a></td>
                                </tr>
                                <tr>
                                    <td class="uk-text-right">2</td>
                                    <td class="uk-text-nowrap"><a
                                                href="printable/sales-officer-product-spk-customer.html" target="blank"
                                                class="sc-text-semibold">Kemeja Bomber</a></td>
                                    <td class="uk-text-nowrap">Hailie Rowe</td>
                                    <td><span class="uk-label uk-label-default">menunggu konfirmasi customer</span></td>
                                    <td><a href="#" class="mdi mdi-file-outline sc-icon-square"></a></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>


            </div>
            <div class="uk-grid" data-uk-grid>
                <div class="uk-width-1-2@l">
                    <!-- <a class="sc-button sc-button-primary sc-js-button-wave-light" href="so-vendor-edit.html">Edit</a> -->
                    <div id="edit_button"></div>
                    <!-- <a class="sc-button sc-button-danger sc-js-button-wave-light" href="so-customer-edit.html">Blokir</a> -->
                </div>
                <div class="uk-width-1-2@l">
                    <div class="uk-text-right">
                        <button class="sc-button sc-button-default sc-button-outline sc-js-button-wave uk-modal-close"
                                type="button">Tutup
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end modal detail customer -->

    <!-- start modal add customer -->
    <div id="modal-add-customer" data-uk-modal>
        <div class="uk-modal-dialog uk-modal-body">
            <button class="uk-modal-close-default" type="button" data-uk-close></button>
            <div class="uk-modal-body">
                <form enctype="multipart/form-data" id="add_form" role="form" method="POST" action="">
                    <div class="custom-form-divider">
                        <span class="custom-no-margin-bottom">Informasi Akun</span>
                        <hr class="custom-hr">
                    </div>
                    <div class="uk-grid" data-uk-grid="">
                        <div class="uk-width-1-2@l uk-width-1-1@s">
                            <label>
                                <div class="custom-form-labeller"><span>Nama Vendor</span> <span
                                            class="custom-important-input"><sup>*</sup></span></div>
                            </label>
                            <input class="uk-input vendor_names" type="text" data-sc-input="outline" required
                                   name="vendor_names">
                        </div>
                        <div class="uk-width-1-2@l uk-width-1-1@s">
                            <label>
                                <div class="custom-form-labeller"><span>Admin / Owner</span> <span
                                            class="custom-important-input"><sup>*</sup></span></div>
                            </label>
                            <input class="uk-input" type="text" data-sc-input="outline" required name="owner_name">
                        </div>
                    </div>
                    <div class="uk-grid" data-uk-grid="">
                        <div class="uk-width-1-2@l uk-width-1-1@s">
                            <label>
                                <div class="custom-form-labeller"><span>Email</span> <span
                                            class="custom-important-input"><sup>*</sup></span></div>
                            </label>
                            <input class="uk-input" type="email" data-sc-input="outline" required name="email">
                        </div>
                        <div class="uk-width-1-2@l uk-width-1-1@s">
                            <label>
                                <div class="custom-form-labeller"><span>Kontak</span> <span
                                            class="custom-important-input"><sup>*</sup></span></div>
                            </label>
                            <input class="uk-input data-price-style" data-sc-input="outline" data-inputmask="'alias': 'numeric', 'groupSeparator': '-', 'autoGroup': true, 'digits': 0, 'digitsOptional': false, 'prefix': '', 'placeholder': ''" required name="kontak">
                        </div>
                    </div>
                    <div class="uk-grid" data-uk-grid="">
                        <div class="uk-width-1-2@l uk-width-1-1@s">
                            <label>
                                <div class="custom-form-labeller"><span>Website</span></div>
                            </label>
                            <input class="uk-input" type="text" data-sc-input="outline" name="website">
                        </div>
                        <div class="uk-width-1-2@l uk-width-1-1@s">
                            <label>
                                <div class="custom-form-labeller"><span>Username</span></div>
                            </label>
                            <input class="uk-input vendorurname" type="text" data-sc-input="outline" readonly="readonly"
                                   name="username">
                        </div>
                    </div>
                    <div class="uk-grid" data-uk-grid>
                        <div class="uk-width-1-1@l uk-width-1-1@s">
                            <label>
                                <div class="custom-form-labeller"><span>Pilih produk yang dapat dilayani</span> <span
                                            class="custom-important-input"><sup>*</sup></span></div>
                            </label>
                            <select name="jenis_produk[]" id="jenis_produk" class="uk-select">

                            </select>
                        </div>
                    </div>
                    <br>
                    <div class="uk-width-1-1@l uk-width-1-1@s">
                        <label>
                            <div class="custom-form-labeller"><span>Upload Logo<small> (Maks 1000 KB)</small></span>
                            </div>
                        </label>
                        <input class="uk-input dropify" type="file" name="upload_path" value=""
                               data-max-file-size-preview="1M" data-allowed-file-extensions="jpeg png jpg">
                    </div>
                    <br><br>
                    <div class="custom-form-divider">
                        <span class="custom-no-margin-bottom">Informasi Alamat</span>
                        <hr class="custom-hr">
                    </div>
                    <div class="uk-grid" data-uk-grid="">
                        <div class="uk-width-1-2@l uk-width-1-1@s">
                            <label>
                                <div class="custom-form-labeller"><span>Provinsi</span> <span
                                            class="custom-important-input"><sup>*</sup></span></div>
                            </label>
                            <select name="province" id="province" class="uk-select" required>

                            </select>
                        </div>
                        <div class="uk-width-1-2@l uk-width-1-1@s">
                            <div class="custom-form-labeller"><span>Kota / Kabupaten</span> <span
                                        class="custom-important-input"><sup>*</sup></span></div>
                            <select name="kabupaten" id="kabupaten" class="uk-select"
                                    data-sc-select2='{"placeholder": "Pilih Kabupaten / Kota *", "allowClear": true }'
                                    required>

                            </select>
                        </div>
                    </div>
                    <div class="uk-grid" data-uk-grid="">
                        <div class="uk-width-1-1@l uk-width-1-1@s">
                            <label>
                                <div class="custom-form-labeller"><span>Alamat Lengkap</span> <span
                                            class="custom-important-input"><sup>*</sup></span></div>
                            </label>
                            <textarea class="uk-textarea" rows="5" data-sc-input="outline" name="alamat"></textarea>
                        </div>
                    </div>
                    <div class="uk-grid" data-uk-grid="">
                        <p class="uk-margin-small-bottom">Status</p>
                        <div class="uk-grid-small uk-child-width-auto" data-uk-grid>
                            <label><input class="uk-checkbox" type="checkbox" checked name="status">Aktif</label>
                        </div>
                    </div>

            </div>
            <p class="uk-text-right">
                <button class="sc-button  sc-button-flat sc-button-flat-danger uk-modal-close" type="button">Batalkan
                </button>
                <button class="sc-button sc-button-primary sc-js-button-loading" data-button-mode="light" type="submit">
                    Tambah Data Vendor
                </button>
            </p>
        </div>
        </form>
    </div>
    <!-- end modal add customer -->

    <!-- start modal edit customer -->
    <div id="modal-edit-customer" data-uk-modal>
        <div class="uk-modal-dialog uk-modal-body">
            <button class="uk-modal-close-default" type="button" data-uk-close></button>
            <div class="uk-modal-body">
                <form enctype="multipart/form-data" id="edit_form" role="form" method="POST" action="">
                    @csrf
                    <div class="custom-form-divider">
                        <span class="custom-no-margin-bottom">Informasi Akun</span>
                        <hr class="custom-hr">
                    </div>
                    <div class="uk-grid" data-uk-grid="">
                        <div class="uk-width-1-2@l uk-width-1-1@s">
                            <label>
                                <div class="custom-form-labeller"><span>Nama Vendor</span> <span
                                            class="custom-important-input"><sup>*</sup></span></div>
                            </label>
                            <input class="uk-input vendor_names" type="text" data-sc-input="outline" required
                                   name="vendor_names" id="edit_v_names" value="">
                        </div>
                        <div class="uk-width-1-2@l uk-width-1-1@s">
                            <label>
                                <div class="custom-form-labeller"><span>Admin / Owner</span> <span
                                            class="custom-important-input"><sup>*</sup></span></div>
                            </label>
                            <input class="uk-input" type="text" data-sc-input="outline" required name="owner_name"
                                   id="edit_o_names">
                        </div>
                    </div>
                    <div class="uk-grid" data-uk-grid="">
                        <div class="uk-width-1-2@l uk-width-1-1@s">
                            <label>
                                <div class="custom-form-labeller"><span>Email</span> <span
                                            class="custom-important-input"><sup>*</sup></span></div>
                            </label>
                            <input class="uk-input" type="email" data-sc-input="outline" required name="email"
                                   id="edit_email">
                        </div>
                        <div class="uk-width-1-2@l uk-width-1-1@s">
                            <label>
                                <div class="custom-form-labeller"><span>Kontak</span> <span
                                            class="custom-important-input"><sup>*</sup></span></div>
                            </label>
                            <input class="uk-input data-price-style" type="number" data-sc-input="outline" data-inputmask="'alias': 'numeric', 'groupSeparator': '-', 'autoGroup': true, 'digits': 0, 'digitsOptional': false, 'prefix': '', 'placeholder': ''" required name="kontak"
                                   id="edit_kontak">
                        </div>
                    </div>
                    <div class="uk-grid" data-uk-grid="">
                        <div class="uk-width-1-2@l uk-width-1-1@s">
                            <label>
                                <div class="custom-form-labeller"><span>Website</span></div>
                            </label>
                            <input class="uk-input" type="text" data-sc-input="outline" name="website"
                                   id="edit_website">
                        </div>
                        <div class="uk-width-1-2@l uk-width-1-1@s">
                            <label>
                                <div class="custom-form-labeller"><span>Username</span></div>
                            </label>
                            <input class="uk-input vendorurname" type="text" data-sc-input="outline" name="username"
                                   readonly="readonly" id="edit_username">
                        </div>
                    </div>
                    <div class="uk-grid" data-uk-grid>
                        <div class="uk-width-1-1@l uk-width-1-1@s">
                            <label>
                                <div class="custom-form-labeller"><span>Pilih produk yang dapat dilayani</span> <span
                                            class="custom-important-input"><sup>*</sup></span></div>
                            </label>
                            <select name="jenis_produk[]" multiple class="uk-select"
                                    data-sc-select2='{"placeholder": "Pilih produk yang dapat dilayani", "allowClear": true }'
                                    id="edit_produk">

                            </select>
                        </div>
                    </div>
                    <br>
                    <div class="uk-width-1-1@l uk-width-1-1@s">
                        <label>
                            <div class="custom-form-labeller"><span>Upload Logo<small> (Maks 1000 KB)</small></span>
                            </div>
                        </label>
                        <input class="uk-input dropify" type="file" id="image" name="upload_path">
                        <!-- <div id="edit_upload_path"></div> -->
                    </div>
                    <br><br>
                    <div class="custom-form-divider">
                        <span class="custom-no-margin-bottom">Informasi Alamat</span>
                        <hr class="custom-hr">
                    </div>
                    <div class="uk-grid" data-uk-grid="">
                        <div class="uk-width-1-2@l uk-width-1-1@s">
                            <label>
                                <div class="custom-form-labeller"><span>Provinsi</span> <span
                                            class="custom-important-input"><sup>*</sup></span></div>
                            </label>
                            <select name="province" id="edit_province" class="uk-select" required>

                            </select>
                        </div>
                        <div class="uk-width-1-2@l uk-width-1-1@s">
                            <div class="custom-form-labeller"><span>Kota / Kabupaten</span> <span
                                        class="custom-important-input"><sup>*</sup></span></div>
                            <select name="kabupaten" id="edit_kabupaten" class="uk-select"
                                    data-sc-select2='{"placeholder": "Pilih Kabupaten / Kota *", "allowClear": true }'
                                    required>

                            </select>
                        </div>
                    </div>
                    <div class="uk-grid" data-uk-grid="">
                        <div class="uk-width-1-1@l uk-width-1-1@s">
                            <label>
                                <div class="custom-form-labeller"><span>Alamat Lengkap</span> <span
                                            class="custom-important-input"><sup>*</sup></span></div>
                            </label>
                            <textarea class="uk-textarea" rows="5" data-sc-input="outline" name="alamat"
                                      id="edit_alamat"></textarea>
                        </div>
                    </div>
                    <div class="uk-grid" data-uk-grid="">
                        <p class="uk-margin-small-bottom">Status</p>
                        <div class="uk-grid-small uk-child-width-auto" data-uk-grid>
                            <label><input class="uk-checkbox" type="checkbox" checked name="status">Aktif</label>
                        </div>
                    </div>

            </div>
            <p class="uk-text-right">
                <button class="sc-button  sc-button-flat sc-button-flat-danger uk-modal-close" type="button">Batalkan
                </button>
                <button class="sc-button sc-button-primary sc-js-button-loading" data-button-mode="light" type="submit">
                    Ubah Data Vendor
                </button>
            </p>
        </div>
        <input type="hidden" class="id_kab" value="">
        <input type="hidden" class="id_prov" value="">
        <input type="hidden" class="id_vendor" value="">
        <input type="hidden" class="id_product" value="">
        </form>
    </div>
    <!-- end modal edit customer -->
@endsection

@push('scripts')
    <script>
        function showDetail(id) {
            UIkit.modal($("#modal-detail-customer")).show();

            $.ajax({
                type: "GET",
                url: '{!! route('manajemenvendor.single', [':id']) !!}'.replace(':id', id),
                success: function (data) {
                    // //Set up data for edit modal
                    $("#detail_v_names").text(data.data.vendor_names);
                    $("#detail_o_names").text(data.data.owner_name);
                    $("#detail_email").text(data.data.email);
                    $("#detail_kontak").text(data.data.kontak);
                    $("#detail_website").text(data.data.website);
                    var arr = JSON.parse(data.data.jenis_produk);
                    $("#detail_jenis_produk").empty();
                    $.each(arr, function (key, value) {
                        $.ajax({
                            type: 'GET',
                            url: '{{route('productsGet.ajax.detail', ':id')}}'.replace(':id', value)
                        }).then(function (data) {
                            // create the option and append to Select2
                            var dataset = data[0].text;

                            $("#detail_jenis_produk").append("<p class='uk-margin-remove sc-text-semibold '>" + dataset + "</p>");


                        });

                    });
                    $("#detail_province").text(data.data.name_prov);
                    $("#detail_kabupaten").text(data.data.name_reg);
                    $("#detail_alamat").text(data.data.alamat);
                    var username = '@' + data.data.username;
                    $("#detail_username").text(username);
                    var upload_path = data.data.upload_path;
                    var id = data.data.id;
                    $("#detail_upload_path").html("<img src='images_vendor/" + upload_path + "' class='sc-avatar' alt='' > ");
                    $("#edit_button").html("<a href='javascript:showEdit(" + id + ");' data-uk-toggle class='sc-button sc-button-primary sc-js-button-wave-light' id='edit-button'>Edit</a>'");
                    var dataStatus = data.data.status;
                    var registerTime = data.data.created_at;

                    if (dataStatus == '1') {
                        $('.statusAktif').html("<span class='uk-label uk-label-primary'>Aktif</span> <small>Mendaftar pada " + registerTime + "</small>")
                    } else {
                        $('.statusAktif').html("<span class='uk-label uk-label-danger'>Belum Aktif</span> <small>Mendaftar pada " + registerTime + "</small>")
                    }

                    // if(UIkit.modal($("#modal-detail-customer")).hide() == true){
                    //     $('#detail_jenis_produk').remove();
                    // }

                    // if (data.data.status <= 0) {
                    //     $('.switchery').click();
                    // }

                    // let dataMeterialName = $(".data-material-name");
                    // dataMeterialName.parent().addClass('sc-input-filled');

                    // //Set up credentials for edit and delete action...
                    // $(".delete-materials").attr('data-id', id);
                },
                error: function (data) {
                    console.log('error');
                    UIkit.modal.alert(data.responseJSON.message).then(function () {

                    });
                }
            });
        }

        function showEdit(id) {
            UIkit.modal($("#modal-edit-customer")).show();

            $.ajax({
                type: "GET",
                url: '{!! route('manajemenvendor.single', [':id']) !!}'.replace(':id', id),
                success: function (data) {
                    // //Set up data for edit modal
                    $("#edit_v_names").val(data.data.vendor_names).parent().addClass('sc-input-filled');
                    $("#edit_o_names").val(data.data.owner_name).parent().addClass('sc-input-filled');
                    $("#edit_email").val(data.data.email).parent().addClass('sc-input-filled');
                    $("#edit_kontak").val(data.data.kontak).parent().addClass('sc-input-filled');
                    $("#edit_website").val(data.data.website).parent().addClass('sc-input-filled');
                    var id_produk = data.data.jenis_produk;
                    $(".id_prov").val(data.data.province).parent().addClass('sc-input-filled');
                    $(".id_kab").val(data.data.kabupaten).parent().addClass('sc-input-filled');
                    $(".id_vendor").val(data.data.id).parent().addClass('sc-input-filled');
                    $(".id_product").val(data.data.jenis_produk).parent().addClass('sc-input-filled');
                    $("#edit_alamat").val(data.data.alamat).parent().addClass('sc-input-filled');
                    $("#edit_username").val(data.data.username).parent().addClass('sc-input-filled');
                    $("#edit_username").val(data.data.username).parent().addClass('sc-input-filled');
                    var upload_path = data.data.upload_path;
                    var id = data.data.id;
                    $("#edit_button").html("<a href='javascript:showEdit(" + id + ");' data-uk-toggle class='sc-button sc-button-primary sc-js-button-wave-light' id='edit-button'>Edit</a>'");

                    // Dropify
                    let image_target = $("#image");


                    //  Dropify : Set Image to Render
                    let preview_button = image_target.next();
                    let render_target = image_target.next().next();
                    let file_name = render_target.find('.dropify-filename-inner');
                    let render_children = render_target.children('.dropify-render');

                    // Check If File PAth are null or empty
                    if (data.data.upload_path !== null) {
                        // First : Remove All Content
                        render_children.empty();
                        render_target.css('display', 'none');
                        preview_button.css('display', 'none');

                        // Dropify : Set Image
                        image_target.attr("data-default-file", "{{ url('/images_vendor') }}/" + data.data.upload_path);
                        let image_source = "<img src='" + image_target.attr('data-default-file') + "'>";

                        // Set image_source to render_target
                        render_children.append(image_source);
                        render_target.css('display', 'block');
                        preview_button.css('display', 'block');

                        // set Filename
                        file_name.text(data.filename);
                        // console.log('is available');
                    } else {
                        // Set image_source to render_target
                        render_children.empty();
                        render_target.css('display', 'none');
                        preview_button.css('display', 'none');
                        // console.log('is not available');
                    }


                    product();
                    provinsi();

                }
            });
        }

        function product() {
            // Set up the Select2 control
            $('#edit_produk').select2(
                {
                    placeholder: "Pilih Produk",
                    width: '100%',
                    closeOnSelect: true,
                    allowClear: true,
                    multiple: true,
                    ajax: {
                        url: '{{route('products.ajax.select2')}}',
                        dataType: 'json',
                        delay: 250,
                        data: function (params) {
                            return {
                                term: params.term,
                                page: params.page,
                            };
                        },
                        processResults: function (data, params) {
                            var results = [];
                            $.each(data.data, function (k, v) {
                                results.push({
                                    id: v.id,
                                    text: v.text,
                                });
                            });

                            params.page = params.page || 1;
                            return {
                                results: results,
                                pagination: {
                                    more: (params.page * data.per_page) < data.total
                                }
                            };
                        },
                        cache: true,
                    }
                });
            $('#edit_produk').val('').trigger('change');
            // Fetch the preselected item, and add to the control
            $.ajax({
                type: "GET",
                url: '{!! route('manajemenvendor.single', [':id']) !!}'.replace(':id', $('.id_vendor').val()),
                success: function (data) {
                    var arrProduct = JSON.parse(data.data.jenis_produk);
                    var productSelect = $('#edit_produk');

                    $("#edit_produk").empty();
                    $.each(arrProduct, function (key, value) {
                        $.ajax({
                            type: 'GET',
                            url: '{{route('productsGet.ajax.detail', ':id')}}'.replace(':id', value)
                        }).then(function (data) {
                            // create the option and append to Select2
                            var dataset = data[0].text;

                            var option = new Option(data[0].text, data[0].id, true, true);
                            productSelect.append(option).trigger('change');

                            // manually trigger the `select2:select` event
                            productSelect.trigger({
                                type: 'select2:select',
                                params: {
                                    data: data
                                }
                            });


                        });

                    });
                }
            });


        }

        function provinsi() {
            // Set up the Select2 control

            $('#edit_province').select2(
                {
                    placeholder: "Pilih Provinsi..",
                    width: '100%',
                    closeOnSelect: true,
                    allowClear: true,
                    ajax: {
                        url: '{{route('province.ajax.select2')}}',
                        dataType: 'json',
                        delay: 250,
                        data: function (params) {
                            return {
                                term: params.term,
                                page: params.page,
                            };
                        },
                        processResults: function (data, params) {
                            params.page = params.page || 1;

                            return {
                                results: data.data,
                                pagination: {
                                    more: (params.page * data.per_page) < data.total
                                }

                            };
                        },
                        cache: true,
                    }
                });
            // Fetch the preselected item, and add to the control
            var provinceSelect = $('#edit_province');

            $.ajax({
                type: 'GET',
                url: '{{route('provinceGet.ajax.detail', ':id')}}'.replace(':id', $('.id_prov').val())
            }).then(function (data) {
                // create the option and append to Select2

                var option = new Option(data[0].text, data[0].id, true, true);
                provinceSelect.append(option).trigger('change');

                // manually trigger the `select2:select` event
                provinceSelect.trigger({
                    type: 'select2:select',
                    params: {
                        data: data
                    }
                });
            });
            var id_prov = $('#edit_province').val();

            $.ajax({
                type: 'GET',
                url: '{{route('kab.ajax.select2')}}',
                data: {id: id_prov,},
                success: function (data) {
                    for (let i = 0; i < data.length; i++) {
                        var html = "<option value=" + data[i].id + ">" + data[i].text + "</option>";
                        $('#edit_kabupaten').append(html);
                    }

                    var citySelect = $('#edit_kabupaten');

                    $.ajax({
                        type: 'GET',
                        url: '{{route('cityGet.ajax.detail', ':id')}}'.replace(':id', $('.id_kab').val())
                    }).then(function (data) {
                        // create the option and append to Select2
                        var option = new Option(data[0].text, data[0].id, true, true);
                        citySelect.append(option).trigger('change');

                        // manually trigger the `select2:select` event
                        citySelect.trigger({
                            type: 'select2:select',
                            params: {
                                data: data
                            }
                        });
                    });


                }

            })

            kotaByProv();
        }

        function kotaByProv() {
            $('#edit_province').change(function () {
                var id_prov = $('#edit_province').val();

                $.ajax({
                    type: 'GET',
                    url: '{{route('kab.ajax.select2')}}',
                    data: {id: id_prov,},
                    success: function (data) {
                        console.log("kalokesini masuk gak?");
                        $('#edit_kabupaten').find('option').remove().end();

                        for (let i = 0; i < data.length; i++) {
                            var html = "<option value=" + data[i].id + ">" + data[i].text + "</option>";
                            $('#edit_kabupaten').append(html);
                        }

                    }

                })

            });
        }


        $(document).ready(function () {
            $('#pdev').addClass("sc-page-active");

            // Initialize DataTable
            var table = $('#vendor-table').DataTable({
                processing: true,
                serverSide: true,
                retrieve: true,
                pageLength: 10,
                ajax: "{{ route('manajemenvendor-index') }}",
                columns: [
                    {data: 'id', name: 'id', title: 'ID Vendor'},
                    {data: 'vendor_names', name: 'vendor_names', title: 'Nama Vendor'},
                    {data: 'owner_name', name: 'owner_name', title: 'Nama Owner'},
                    {data: 'action', name: 'action', title: 'Aksi', orderable: false, searchable: false},
                ]
            });

            $('.hide-column- input:checked').each(function () {
                selected.push($(this).attr('name'));
            });

            $('.hide-column').click(function (e) {
                e.preventDefault();

                var column = table.column($(this).attr('data-column'));
                column.visible(!column.visible());
                table.draw();
            });

            //Delete action
            $('.delete-materials').on('click', function (e) {
                UIkit.modal.confirm('Apakah anda yakin akan menghapus data ini ?').then(function () {
                    e.preventDefault();

                    var params = {
                        _token: '{{ csrf_token() }}',
                        id: $(".delete-materials").attr('data-id'),
                    }

                    $.ajax({
                        type: "DELETE",
                        url: "{{ route('product-materials.delete') }}",
                        data: params,
                        async: false,
                        success: function (data) {
                            UIkit.modal.alert(data.message).then(function () {

                            });

                            table.draw();
                            UIkit.modal($("#detail-material-modal")).hide();
                        },
                        error: function (data) {
                            UIkit.modal.alert(data.responseJSON.message).then(function () {

                            });
                        }
                    });
                }, function () {
                    console.log('Rejected.')
                })
            });

            //hit username
            $('.vendor_names').keyup(function (e) {
                var value_vendor = $('.vendor_names').val();
                var trimStr = $.trim(value_vendor).toLowerCase();
                var username = trimStr.replace(/\s/g, '');
                $('.vendorurname').val(username).parent().addClass('sc-input-filled');
            });
            $('#edit_v_names').keyup(function (e) {
                var value_vendor = $('#edit_v_names').val();
                var trimStr = $.trim(value_vendor).toLowerCase();
                var username = trimStr.replace(/\s/g, '');
                $('#edit_username').val(username).parent().addClass('sc-input-filled');
            });

            //kabupaten by province
            $('#province').select2(
                {
                    placeholder: "Pilih Provinsi",
                    width: '100%',
                    // containerCssClass: ':all:',
                    closeOnSelect: true,
                    allowClear: true,
                    ajax: {
                        url: '{{route('province.ajax.select2')}}',
                        dataType: 'json',
                        delay: 250,
                        data: function (params) {
                            return {
                                term: params.term,
                                page: params.page,
                            };
                        },
                        processResults: function (data, params) {
                            var results = [];
                            $.each(data.data, function (k, v) {
                                results.push({
                                    id: v.id,
                                    text: v.text,
                                });
                            });

                            params.page = params.page || 1;
                            return {
                                results: results,
                                pagination: {
                                    more: (params.page * data.per_page) < data.total
                                }
                            };
                        },
                        cache: true,
                    }
                });
            $('#province').val('').trigger('change');
            $('#province').change(function () {
                var id_prov = $('#province').val();

                $.ajax({
                    type: 'GET',
                    url: '{{route('kab.ajax.select2')}}',
                    data: {id: id_prov,},
                    success: function (data) {
                        $('#kabupaten').find('option').remove().end();
                        var html_ = "<option selected value=''> Pilih Kabupaten </option>";
                        $('#kabupaten').append(html_);
                        for (let i = 0; i < data.length; i++) {
                            var html = "<option value=" + data[i].id + ">" + data[i].text + "</option>";
                            $('#kabupaten').append(html);
                        }

                    }

                })

            });

            $('#jenis_produk').select2(
                {
                    placeholder: "Pilih Produk",
                    width: '100%',
                    closeOnSelect: true,
                    allowClear: true,
                    multiple: true,
                    ajax: {
                        url: '{{route('products.ajax.select2')}}',
                        dataType: 'json',
                        delay: 250,
                        data: function (params) {
                            return {
                                term: params.term,
                                page: params.page,
                            };
                        },
                        processResults: function (data, params) {
                            var results = [];
                            $.each(data.data, function (k, v) {
                                results.push({
                                    id: v.id,
                                    text: v.text,
                                });
                            });

                            params.page = params.page || 1;
                            return {
                                results: results,
                                pagination: {
                                    more: (params.page * data.per_page) < data.total
                                }
                            };
                        },
                        cache: true,
                    }
                });
            $('#jenis_produk').val('').trigger('change');


            $('#edit_form').submit(function (event) {
                event.preventDefault();
                var id = $(".id_vendor").val();
                var status = $("input[name=status]:checked").val() == 1 ? 1 : 0;
                var upload = $("input[name=upload_path]").val();

                var formDataE = new FormData(this);
                // formDataE.append('_token', "{{ csrf_token() }}");
                if (upload == null) {
                    formDataE.append('status', status);
                    formDataE.append('upload_path', null);
                } else {
                    formDataE.append('status', status);
                    formDataE.append('upload_path', upload);
                }

                $.ajax({
                    type: 'POST',
                    url: "manajemenvendor/" + id,
                    data: formDataE,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: (data) => {
                        UIkit.modal.alert(data.message).then(function () {

                        });

                        table.draw();
                        UIkit.modal($("#modal-edit-customer")).hide();
                    },
                    error: function (data) {
                        UIkit.modal.alert(data.responseJSON.message).then(function () {

                        })
                    }
                });
            });

            //Add action
            $('#add_form').submit(function (event) {
                event.preventDefault();

                var status = $("input[name=status]:checked").val() == 1 ? 1 : 0;
                var cb = $("input[name=jenis_produk]");
                // console.log(cb);
                console.log("masuk");

                var formData = new FormData(this);
                formData.append('_token', '{{ csrf_token() }}');
                formData.append('status', status);

                $.ajax({
                    type: 'POST',
                    url: "{{ route('manajemenvendor.add') }}",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: (data) => {
                        UIkit.modal.alert(data.message).then(function () {

                        });
                        console.log(data);

                        table.draw();
                        UIkit.modal($("#modal-add-customer")).hide();
                    },
                    error: function (data) {
                        UIkit.modal.alert(data.responseJSON.message).then(function () {

                        });
                    }
                });
            });
        });
    </script>
@endpush

@push('dropify')
    <script src="{{ asset('assets/js/vendor/dropify/js/dropify.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            // Basic
            $('.dropify').dropify();


            // Translated
            $('.dropify-fr').dropify({
                messages: {
                    default: 'Glissez-déposez un fichier ici ou cliquez',
                    replace: 'Glissez-déposez un fichier ou cliquez pour remplacer',
                    remove: 'Supprimer',
                    error: 'Désolé, le fichier trop volumineux'
                }
            });

            // Used events
            var drEvent = $('#input-file-events').dropify();

            drEvent.on('dropify.beforeClear', function (event, element) {
                return confirm("Do you really want to delete \"" + element.file.name + "\" ?");
            });

            drEvent.on('dropify.afterClear', function (event, element) {
                alert('File deleted');
            });

            drEvent.on('dropify.errors', function (event, element) {
                console.log('Has Errors');
            });

            var drDestroy = $('#input-file-to-destroy').dropify();
            drDestroy = drDestroy.data('dropify')
            $('#toggleDropify').on('click', function (e) {
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
