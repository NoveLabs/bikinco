@extends('layouts.app')

@push('css-dropify')
    <link rel="stylesheet" href="{{ asset('assets/js/vendor/dropify/css/dropify.min.css') }}">
@endpush

@section('content')
<div id="sc-page-wrapper">
    <div id="sc-page-content">
        <div class="uk-child-width-1-1@xl uk-child-width-1-2@l uk-child-width-1-2@s uk-grid-match" data-uk-grid>
            <div>
                <div class="uk-card sc-widget uk-flex">
                    <div class="uk-width-1-4 md-bg-amber-500 uk-flex-middle uk-flex uk-flex-center">
                        <i class="mdi mdi-eye-check-outline"></i>
                    </div>
                    <div class="uk-flex-1">
                        <div class="uk-card-body">
                            <h3 class="uk-card-title active-product">{{ $activeProductTotalData }}</h3>
                            <p class="uk-text-meta">Produk Tertampil</p>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <div class="uk-card sc-widget uk-flex">
                    <div class="uk-width-1-4 md-bg-red-500 uk-flex-middle uk-flex uk-flex-center">
                        <i class="mdi mdi-eye-off-outline"></i>
                    </div>
                    <div class="uk-flex-1">
                        <div class="uk-card-body">
                            <h3 class="uk-card-title deactive-product">{{ $deactiveProductTotalData }}</h3>
                            <p class="uk-text-meta">Produk Tidak Tampil</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="uk-card uk-margin">
            <div class="uk-flex-middle sc-padding sc-padding-medium-ends uk-grid-small" data-uk-grid>
                <div class="uk-flex-1">
                    <h3 class="uk-card-title">Data Master Kategori</h3>
                </div>
                <div class="uk-width-auto@s">
                    <button class="sc-button sc-button-primary sc-button-flex" type="button">Pengaturan Kolom <i class="mdi mdi-chevron-down uk-margin-small-left"></i></button>
                    <div class="uk-dropdown uk-width-small" data-uk-drop="mode: click">
                        <div class="sc-padding-small hide-columns-">
                            <div class="uk-margin-small">
                                <input type="checkbox" class="hide-column" value="0"  checked disabled>
                                <label for="sc-dt-col-0">No</label>
                            </div>
                            <div class="uk-margin-small">
                                <input type="checkbox" name="check_1" class="hide-column" data-column="1" value="1" checked>
                                <label for="sc-dt-col-1">Nama Produk</label>
                            </div>
                            <div class="uk-margin-small">
                                <input type="checkbox" name="check_2" class="hide-column" data-column="2" value="2" checked>
                                <label for="sc-dt-col-2">Harga</label>
                            </div>
                            <div class="uk-margin-small">
                                <input type="checkbox" name="check_3" class="hide-column" data-column="3" value="3" checked>
                                <label for="sc-dt-col-3">Subkategori</label>
                            </div>
                            <div class="uk-margin-small">
                                <input type="checkbox" name="check_4" class="hide-column" data-column="4" value="4" checked>
                                <label for="sc-dt-col-4">Kategori</label>
                            </div>
                            <div class="uk-margin-small">
                                <input type="checkbox" name="check_5" class="hide-column" data-column="5" value="5" checked>
                                <label for="sc-dt-col-5">Tanggal Input</label>
                            </div>
                            <div class="uk-margin-small">
                                <input type="checkbox" name="check_6" class="hide-column" data-column="6" value="6" checked>
                                <label for="sc-dt-col-6">Status</label>
                            </div>
                            <div class="uk-margin-small">
                                <input type="checkbox" name="check_7" class="hide-column" data-column="7" value="7" checked>
                                <label for="sc-dt-col-7">Aksi</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr class="uk-margin-remove">
            <div class="uk-card-body">
                <table id="product-table" class="product-table uk-table uk-table-striped dt-responsive">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Produk</th>
                            <th>Harga</th>
                            <th>Subkategori</th>
                            <th>Kategori</th>
                            <th>Tanggal Input</th>
                            <th class="uk-text-nowrap">Status</th>
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
    <a href="#data-modal-add" class="sc-fab sc-fab-text sc-fab-success" data-uk-toggle="target: #data-modal-add"><i class="mdi mdi-plus"></i>Tambahkan</a>
</div>

<div id="data-modal-add" class="modal-close data_subcategory" data-uk-modal>
    <div class="uk-modal-dialog uk-modal-body">
        <button class="uk-modal-close-default" type="button" data-uk-close></button>
        <h2 class="uk-modal-title">Input Produk</h2>
        <form enctype="multipart/form-data" id="add_form" role="form" method="POST" action="">
            <div class="uk-modal-body uk-padding-remove">
                <div class="uk-grid" data-uk-grid>
                    <div class="uk-width-1-1@l">
                        <div class="uk-grid" data-uk-grid>
                            <div class="uk-width-1-1@l">
                                <label>Nama Produk<sup>*</sup></label>
                                <input type="text" required name="products-name" class="uk-input" data-sc-input>
                            </div>
                            <div class="uk-width-1-1@l">
                                <label>Harga Produk<sup>*</sup></label>
                                <input required name="products-price" class="uk-input data-price-style" data-sc-input data-inputmask="'alias': 'numeric', 'groupSeparator': ',', 'autoGroup': true, 'digits': 0, 'digitsOptional': false, 'prefix': '', 'placeholder': ''">
                            </div>
                            <div class="uk-width-1-2@s">
                                <label class="custom-form-label">Kategori<sup>*</sup></label>
                                <div class="uk-width-expand">
                                    <select id="products-categories" required onchange="return setSubCategories(this.value, 'subcategories');" class="uk-select" data-sc-select2='{"placeholder": "Pilih Kategori", "allowClear": true }' required>
                                        <option value="0" >Pilih Kategori</option>
                                        @foreach ($categories as $item)
                                            <option value="{{ $item->id }}" >{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="uk-width-1-2@s">
                                <label class="custom-form-label">Subkategori<sup>*</sup></label>
                                <div class="uk-width-expand">
                                    <select name="products-subcategories" required id="subcategories" class="uk-select" data-sc-select2='{"placeholder": "Pilih Subkategori", "allowClear": true }' required>
                                        <option value="0" >Pilih Subkategori</option>
                                    </select>
                                </div>
                            </div>
                            <div class="uk-width-1-2@s">
                                <label>Status Produk<sup>*</sup></label> <br>
                                <input type="checkbox" name="products-status" value="1" data-sc-switchery
                                       checked/><label class="uk-margin-small-left">Aktif / Non Aktif</label>
                            </div>

                            <div class="uk-width-1-2@s">
                                <label>Estimasi Berat(gr)<sup>*</sup></label>
                                <input type="number" required name="weight_approx" class="uk-input" data-sc-input>
                            </div>


                        </div>
                    </div>
                    <div class="uk-width-1-1@l">
                        <div class="uk-grid" data-uk-grid>
                            <div class="uk-width-1-1@l uk-width-1-1@s">
                                <ul class="uk-list">
                                    <li class="sc-sidebar-menu-heading custom-list-divider"><span
                                                class="sc-text-semibold">Upload Gambar Produk</span></li>
                                </ul>
                                <div class="uk-grid" data-uk-grid>
                                    <div class="uk-width-1-2@l uk-width-1-1@s">
                                        <div class="sc-list-body" style="margin: 5px;">
                                            <label style="margin-bottom: 10px;" for="input-file-max-fs">Gambar Produk
                                                1</label>
                                            <input type="file" name="products-file[]" class="dropify new-product-file"
                                                   data-max-file-size="2M"/>
                                        </div>
                                    </div>
                                    <div class="uk-width-1-2@l uk-width-1-1@s">
                                        <div class="sc-list-body" style="margin: 5px;">
                                            <label style="margin-bottom: 10px;" for="input-file-max-fs">Gambar Produk
                                                2</label>
                                            <input type="file" name="products-file[]" class="dropify new-product-file"
                                                   data-max-file-size="2M"/>
                                        </div>
                                    </div>
                                    <div class="uk-width-1-2@l uk-width-1-1@s">
                                        <div class="sc-list-body" style="margin: 5px;">
                                            <label style="margin-bottom: 10px;" for="input-file-max-fs">Gambar Produk
                                                3</label>
                                            <input type="file" name="products-file[]" class="dropify new-product-file"
                                                   data-max-file-size="2M"/>
                                        </div>
                                    </div>
                                    <div class="uk-width-1-2@l uk-width-1-1@s">
                                        <div class="sc-list-body" style="margin: 5px;">
                                            <label style="margin-bottom: 10px;" for="input-file-max-fs">Gambar Produk
                                                4</label>
                                            <input type="file" name="products-file[]" class="dropify new-product-file"
                                                   data-max-file-size="2M"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="uk-width-1-1@l">
                        <div class="uk-grid" data-uk-grid>
                            <div class="uk-width-1-2@l">
                            </div>
                            <div class="uk-width-1-2@l">
                                <div class="uk-text-right">
                                    <button class="sc-button sc-button-flat sc-button-flat-danger uk-modal-close">
                                        Batalkan
                                    </button>
                                    <button class="sc-button sc-button-outline-primary" type="submit"
                                            data-button-mode="light">Tambah Produk
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- Add Modal - End Section -->

<!-- Edit Modal -->
<div id="data-modal-edit" class="modal-close data_subcategory" data-uk-modal>
    <div class="uk-modal-dialog uk-modal-body">
        <button class="uk-modal-close-default" type="button" data-uk-close></button>
        <h2 class="uk-modal-title">Detail Informasi Produk</h2>
        <form enctype="multipart/form-data" id="edit_form" role="form" method="POST" action="">
            <input type="hidden" name="edit-products-id" />
            <div class="uk-modal-body uk-padding-remove">
                <div class="uk-grid" data-uk-grid>
                    <div class="uk-width-1-1@l">
                        <label>Nama Produk<sup>*</sup></label>
                        <input type="text" required name="detail-products-name" class="uk-input data-edit-text-input"
                               data-sc-input>
                    </div>
                    <div class="uk-width-1-1@l">
                        <label>Harga Produk<sup>*</sup></label>
                        <input required name="detail-products-price" class="uk-input data-edit-text-input data-price-style"
                               data-sc-input data-inputmask="'alias': 'numeric', 'groupSeparator': ',', 'autoGroup': true, 'digits': 0, 'digitsOptional': false, 'prefix': '', 'placeholder': ''">
                    </div>
                    <div class="uk-width-1-1@l">
                        <div class="uk-grid" data-uk-grid>
                            <div class="uk-width-1-2@l uk-width-1-1@s">
                                <label class="custom-form-label">Kategori<sup>*</sup></label>
                                <div class="uk-width-expand">
                                    <select id="detail-products-categories" required
                                            onchange="return setSubCategories(this.value, 'detail-products-subcategories');"
                                            class="uk-select"
                                            data-sc-select2='{"placeholder": "Pilih Kategori", "allowClear": true }'
                                            required>
                                        <option value="0">Pilih Kategori</option>
                                        @foreach ($categories as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="uk-width-1-2@l uk-width-1-1@s">
                                <label class="custom-form-label">Subkategori<sup>*</sup></label>
                                <div class="uk-width-expand">
                                    <select id="detail-products-subcategories" required class="uk-select"
                                            data-sc-select2='{"placeholder": "Pilih Subkategori", "allowClear": true }'
                                            required>
                                        <option value="0">Pilih Subkategori</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="uk-width-1-2@s">
                        <label>Status Kategori</label> <br>
                        <input type="checkbox" name="detail-products-status" value="1" data-sc-switchery checked/><label
                                class="uk-margin-small-left">Aktif / Non Aktif</label>
                    </div>
                    <div class="uk-width-1-2@s">
                        <label>Estimasi Berat(gr)<sup>*</sup></label> <br>
                        <input type="number" required name="detail-weight_approx" class="uk-input" data-sc-input>
                    </div>

                    <div class="uk-width-1-1@l">
                        <ul class="uk-list">
                            <li class="sc-sidebar-menu-heading custom-list-divider"><span class="sc-text-semibold">Upload Gambar Produk</span>
                            </li>
                        </ul>
                        <div class="uk-grid" data-uk-grid>
                            <div class="uk-width-1-2@l uk-width-1-1@s">
                                <div class="sc-list-body" style="margin: 5px;">
                                    <label style="margin-bottom: 10px;" for="input-file-max-fs">Gambar Produk 1</label>
                                    <input type="file" name="detail-products-file[]" class="dropify data-product-file"
                                           data-max-file-size="2M"/>
                                </div>
                            </div>
                            <div class="uk-width-1-2@l uk-width-1-1@s">
                                <div class="sc-list-body" style="margin: 5px;">
                                    <label style="margin-bottom: 10px;" for="input-file-max-fs">Gambar Produk 2</label>
                                    <input type="file" name="detail-products-file[]" class="dropify data-product-file"
                                           data-max-file-size="2M"/>
                                </div>
                            </div>
                            <div class="uk-width-1-2@l uk-width-1-1@s">
                                <div class="sc-list-body" style="margin: 5px;">
                                    <label style="margin-bottom: 10px;" for="input-file-max-fs">Gambar Produk 3</label>
                                    <input type="file" name="detail-products-file[]" class="dropify data-product-file"
                                           data-max-file-size="2M"/>
                                </div>
                            </div>
                            <div class="uk-width-1-2@l uk-width-1-1@s">
                                <div class="sc-list-body" style="margin: 5px;">
                                    <label style="margin-bottom: 10px;" for="input-file-max-fs">Gambar Produk 4</label>
                                    <input type="file" name="detail-products-file[]" class="dropify data-product-file"
                                           data-max-file-size="2M"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="uk-width-1-1@l">
                        <div class="uk-grid" data-uk-grid>
                            <div class="uk-width-1-2@l uk-width-1-2@s">
                                <button class="sc-button sc-button-danger delete-products" type="button">Hapus</button>
                            </div>
                            <div class="uk-width-1-2@l uk-width-1-2@s">
                                <div class="uk-text-right">
                                    <button class="sc-button sc-button-flat sc-button-flat-danger uk-modal-close">
                                        Batalkan
                                    </button>
                                    <button class="sc-button sc-button-outline-primary" type="submit"
                                            data-button-mode="light">Simpan
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- Edit Modal - End Section -->
@endsection

@push('scripts')
<script>
    function showDetail(id)
    {
        UIkit.modal($("#data-modal-edit")).show();

        $.ajax({
            type: "GET",
            url: 'products/' + id,
            success: function (data) {
                var status = data.data.status == 1 ? 'Aktif' : 'Tidak aktif';

                //Set up data for edit modal
                $("input[name=edit-products-id]").val(data.data.id);
                $("input[name=detail-products-name]").val(data.data.name);
                $("input[name=detail-products-price]").val(data.data.price);
                $("input[name=detail-weight_approx]").val(data.data.weight_approx);
                $("#detail-products-categories").val(data.data.has_sub_categories.has_categories.id).change();

                if (data.data.has_sub_categories.has_categories.id != 0) {
                    setSubCategories(data.data.has_sub_categories.has_categories.id, 'detail-products-subcategories', data.data.has_sub_categories.id);
                }

                let form_input = $(".data-edit-text-input");
                form_input.parent().addClass('sc-input-focus');

                if (data.data.status <= 0) {
                    $('.switchery').click();
                }

                let image_target = $(".data-product-file");

                $(image_target).each(function (index) {
                    //  Dropify : Set Image to Render
                    let preview_button = $(this).next();
                    let render_target = $(this).next().next();
                    let file_name = render_target.find('.dropify-filename-inner');
                    let render_children = render_target.children('.dropify-render');

                    // Check If File PAth are null or empty
                    if (data.image[index] !== null || data.image !== undefined || data.image !== '') {
                        // First : Remove All Content
                        render_children.empty();
                        render_target.css('display', 'none');
                        preview_button.css('display', 'none');

                        // Dropify : Set Image
                        image_target.attr("data-default-file", data.image[index]);
                        let image_source = "<img src='" + image_target.attr('data-default-file') + "'>";

                        // Set image_source to render_target
                        render_children.append(image_source);
                        render_target.css('display', 'block');
                        preview_button.css('display', 'block');

                        // set Filename
                        file_name.text(data.image[index]);
                        // console.log('is available');
                    } else {
                        // Set image_source to render_target
                        render_children.empty();
                        render_target.css('display', 'none');
                        preview_button.css('display', 'none');
                        // console.log('is not available');
                    }
                });


                //Set up credentials for edit and delete action...
                $(".delete-products").attr('data-id', id);
            },
            error: function (err) {

            }
        });
    }

    function setSubCategories(id, childId, editId = 0)
    {
        $.ajax({
            url: 'products-q-subcategories/' + id,
            dataType: 'json',
            success: function(data) {
                var len = data.data.length;

                $("#" + childId).empty();

                for(var i = 0; i<len; i++) {
                    var id = data.data[i]['id'];
                    var name = data.data[i]['name'];

                    var selected = '';
                    if (editId != 0 && id == editId) {
                        selected = 'selected';
                    }

                    $("#" + childId).append("<option value='" + id + "' " + selected + " >" + name + "</option>");
                }
            }
        });
    }

	$(document).ready(function () {
		$('#pdev').addClass("sc-page-active");

        // $(".detail-categories").click(function(e) {
        //     var id = $(this).data('id');
        // });

        // Initialize DataTable
        var table = $('#product-table').DataTable({
            processing: true,
            serverSide: true,
            retrieve: true,
            pageLength: 10,
            ajax: "{{ route('products') }}",
            columns: [
                {data: 'id', name: 'id', title: 'ID Produk'},
                {data: 'name', name: 'name', title: 'Nama Produk'},
                {data: 'price', name: 'price', title: 'Harga'},
                {data: 'alias_subcategories', name: 'alias_subcategories', title: 'Sub-Kategori'},
                {data: 'alias_categories', name: 'alias_categories', title: 'Kategori'},
                {data: 'created_at', name: 'created_at', title: 'Tanggal Input'},
                {data: 'status', name: 'status', title: 'Status'},
                {data: 'action', name: 'action', title: 'Aksi', orderable: false, searchable: false},
            ]
        });

        $('.hide-column- input:checked').each(function() {
            selected.push($(this).attr('name'));
        });

        $('.hide-column').click(function(e) {
            e.preventDefault();

            var column = table.column( $(this).attr('data-column') );
            column.visible( ! column.visible() );
            table.draw();
        });

        //Delete action
        $(".delete-products").click(function(e){
            e.preventDefault();

            var params = {
                _token: '{{ csrf_token() }}',
                id: $(".delete-products").attr('data-id'),
            }

            $.ajax({
                type: "DELETE",
                url: "{{ route('products.delete') }}",
                data: params,
                async: false,
                success: function (data) {
                    UIkit.modal.alert(data.message).then(function () {

                    });

                    table.draw();
                    UIkit.modal($("#data-modal-edit")).hide();
                },
                error: function (data) {
                    UIkit.modal.alert(data.responseJSON.message).then(function () {

                    });
                }
            });
        });

        $('#edit_form').submit(function(event) {
            event.preventDefault();

            var id = $("input[name=edit-products-id]").val();
            var status = $("input[name=detail-products-status]:checked").val() == 1 ? 1 : 0;

            var sub_categories_id = 0;
            $.each($("#detail-products-subcategories option:selected"), function(){
                sub_categories_id = $(this).val();
            });

            var formDataE = new FormData(this);

            formDataE.append('_token', "{{ csrf_token() }}");
            formDataE.append('name', $("input[name=detail-products-name]").val());
            formDataE.append('price', $("input[name=detail-products-price]").val());
            formDataE.append('weight_approx', $("input[name=detail-weight_approx]").val());

            formDataE.append('sub_categories_id', sub_categories_id);
            formDataE.append('status', status);

            $.ajax({
                type: 'POST',
                url: "products/" + id,
                data: formDataE,
                cache: false,
                contentType: false,
                processData: false,
                success: (data) => {
                    UIkit.modal.alert(data.message).then(function () {

                    });

                    table.draw();
                    UIkit.modal($("#data-modal-edit")).hide();
                },
                error: function (data) {
                    UIkit.modal.alert(data.responseJSON.message).then(function () {

                    })
                }
            });
        });

        //Add action
        $('#add_form').submit(function(event){
            event.preventDefault();

            var status = $("input[name=products-status]:checked").val() == 1 ? 1 : 0;

            var categories_id = 0;
            $.each($("#subcategories option:selected"), function(){
                categories_id = $(this).val();
            });

            var formData = new FormData(this);

            formData.append('_token', '{{ csrf_token() }}');
            formData.append('name', $("input[name=products-name]").val());
            formData.append('price', $("input[name=products-price]").val());
            formData.append('weight_approx', $("input[name=weight_approx]").val());
            formData.append('sub_categories_id', categories_id);
            formData.append('status', status);

            $.ajax({
                type: 'POST',
                url: "{{ route('products.add') }}",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: (data) => {
                    UIkit.modal.alert(data.message).then(function () {

                    });

                    table.draw();
                    UIkit.modal($("#data-modal-add")).hide();
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
        var drEvent = $('.new-product-file').dropify();

        drEvent.on('dropify.beforeClear', function(event, element){
            // console.log(element);
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
