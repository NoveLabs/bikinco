@extends('layouts.app')

@push('plugin-sweetalert')
    <link rel="stylesheet" href="{{ asset('plugins/sweetalert/sweetalert2.min.css') }}">
    <script src="{{ asset('plugins/sweetalert/sweetalert2.min.js') }}"></script>
@endpush
@push('css-dropify')
<link rel="stylesheet" href="{{ asset('assets/js/vendor/dropify/dropify.min.css') }}">
@endpush

@section('content')
    <!-- Main Content -->
    <div id="sc-page-wrapper">
        <div id="sc-page-content">
            <div class="uk-alert-icon" data-uk-alert>
                <a class="uk-alert-close" data-uk-close></a>
                <div class="uk-flex uk-flex-middle">
                    <i class="mdi mdi-bullhorn sc-icon-32 uk-margin-right"></i>
                    <div class="uk-alert-content">
                        <h5>Pada halaman ini terdapat data master material cetak dari Bikin-co</h5>
                        <p>Anda dapat menambah, mengedit dan menghapus data varian sesuai kebutuhan Anda.</p>
                    </div>
                </div>
            </div>
            <div class="uk-grid" data-uk-grid>
                <div class="uk-width-1-1@m">
                    <div class="uk-card uk-margin">
                        <div class="uk-flex-middle sc-padding sc-padding-medium-ends uk-grid-small" data-uk-grid>
                            <div class="uk-flex-1">
                                <h3 class="uk-card-title">Data Master Material Cetak</h3>
                            </div>

                        </div>
                        <hr class="uk-margin-remove">
                        <div class="uk-card-body">
                            <table id="data-materialCetak-table" class="uk-table uk-table-striped dt-responsive">
                                <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama </th>
                                    <th>Price</th>
                                    <th class="uk-text-nowrap">Status</th>
                                    <th>Aksi</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- modal input produk -->
    <div id="add-matcetak-modal" class="modal-close data_subcategory" data-uk-modal>
        <div class="uk-modal-dialog uk-modal-body">
            <button class="uk-modal-close-default" type="button" data-uk-close></button>
            <h2 class="uk-modal-title">Input Material Cetak</h2>
            <form enctype="multipart/form-data" method="" action="" id="add_form" role="form">
                @csrf
                <div class="uk-modal-body uk-padding-remove">
                    <div class="uk-grid" data-uk-grid="">
                        <div class="uk-width-1-1@l">
                            <label>Nama<sup>*</sup></label>
                            <input type="text" id="new-matcetak-name" name= "new-matcetak-name" class="uk-input" data-sc-input required>
                        </div>
                        <div class="uk-width-1-1@l">
                            <label>Price<sup>*</sup></label>
                            <input id="new-matcetak-price" name= "new-matcetak-price" class="uk-input data-price-style" data-sc-input data-inputmask="'alias': 'numeric', 'groupSeparator': ',', 'autoGroup': true, 'digits': 0, 'digitsOptional': false, 'prefix': '', 'placeholder': ''" required>
                        </div>
                        <div class="uk-width-1-1@l">
                            <label>Status </label><sup>*</sup><br>
                            <input type="checkbox" name="status" value="1" data-sc-switchery checked/><label
                                    class="uk-margin-small-left">Aktif / Non Aktif</label>
                        </div>
                        <div class="uk-width-1-1@l">
                            <div class="uk-margin">
                                <label>Deskripsi</label>
                                <br/>
                                <textarea name="new-matcetak-desc" required cols="40" rows="5" style="margin: 0px; height: 152px; width: 744px;"></textarea>
                            </div>
                        </div>
                        <div class="uk-width-1-1@l">
                            <div class="uk-text-right">
                                <button class="sc-button sc-button-flat sc-button-flat-danger uk-modal-close"
                                        type="button">Batalkan
                                </button>
                                <button class="sc-button sc-button-outline-primary" id="add-variant-button"
                                        type="submit" data-button-mode="light">Tambah
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- end modal input produk -->

    <!-- MODAL : Edit Produk -->
    <div id="edit-modal" data-uk-modal>
    <div class="uk-modal-dialog">
        <button class="uk-modal-close-default" type="button" data-uk-close></button>
        <div class="uk-modal-header">
            <h2 class="uk-modal-title">Detail </h2>
        </div>
            <form action="" enctype="multipart/form-data" method="" role="" id="edit_form">
                <div class="uk-modal-body uk-padding-remove-topK">
                    <ul class="uk-list">
                        <li class="sc-sidebar-menu-heading custom-list-divider"><span>Detail</span></li>
                    </ul>
                    <input type="hidden" name="edit-matcetak-id"/>
                    <div class="uk-grid" data-uk-grid>

                        <div class="uk-width-1-1@l">
                            <label>Nama<sup>*</sup></label>
                            <input type="text" id="detail-matcetak-name" name= "detail-matcetak-name" class="uk-input" data-sc-input required value="detail">
                        </div>
                        <div class="uk-width-1-1@l">
                            <label>Price<sup>*</sup></label>
                            <input type="number" id="detail-matcetak-price" name= "detail-matcetak-price" class="uk-input" data-sc-input required value="0">
                        </div>
                        <div class="uk-width-1-1@l">
                            <label>Status <sup>*</sup></label> <br>
                            <input type="checkbox" name="detail-status" value="1" data-sc-switchery checked/><label
                                    class="uk-margin-small-left">Aktif / Non Aktif</label>
                        </div>
                        <div class="uk-width-1-1@l">
                            <div class="uk-margin">
                                <label>Deskripsi</label>
                                <br/>
                                <textarea name="detail-matcetak-desc" required cols="40" rows="5" style="margin: 0px; height: 152px; width: 744px;"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="uk-modal-footer">
                    <div class="uk-grid" data-uk-grid>
                        <div class="uk-width-1-2@l uk-width-1-2@s">
                            <a id="sc-js-modal-confirm" style="margin-right: 66%;"
                            class="delete-units uk-text-left sc-js-button-wave-light" href="#">
                                <button class="sc-button sc-button-danger" type="button">Hapus</button>
                            </a>
                        </div>
                        <div class="uk-width-1-2@l uk-width-1-2@s">
                            <div class="uk-text-right">
                                <button class="sc-button sc-button-flat sc-button-flat-danger uk-modal-close" type="button">
                                    Batal
                                </button>
                                <button class="sc-button" type="submit">Simpan</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- end modal edit produk -->

    <div class="sc-fab-card-wrapper uk-position-bottom-right">
        <a href="#add-matcetak-modal" class="sc-fab sc-fab-text sc-fab-success" data-uk-toggle="target: #add-matcetak-modal"><i class="mdi mdi-plus"></i>Tambahkan</a>
    </div>

@endsection

@push('scripts')
    <script src="{{ asset('js/private/script.js') }}"></script>
    <script>
    let table = $('#data-materialCetak-table').DataTable({
        processing: true,
        serverSide: true,
        retrieve: true,
        ajax: "{{ route('materialPrint.index') }}",
        columns: [
            {data: 'id', name: 'id', title: 'No'},
            {data: 'name', name: 'name', title: 'name'},
            {data: 'price', name: 'price', title: 'price'},
            {data: 'status', name: 'status', title: 'Status'},
            {data: 'action', name: 'action', title: 'Tindakan', orderable: false, searchable: false},
        ],
    });

    $('.data-variant-table-toggle').on('click', function(){

        let column = table.column( $(this).attr('data-column') );

        column.visible( ! column.visible() );

        table.draw();

    });

    $('#add_form').submit(function(event){
            event.preventDefault();

            var status = $("input[name=status]:checked").val() == 1 ? 1 : 0;

            var formData = new FormData(this);
            formData.append('_token', '{{ csrf_token() }}');
            formData.append('status', status);
            formData.append('name', $("[name='new-matcetak-name']").val());
            formData.append('price', $("[name='new-matcetak-price']").val());
            formData.append('description', $("[name='new-matcetak-desc']").val());

            $.ajax({
                type: 'POST',
                url: "{{ route('materialPrint.add') }}",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: (data) => {
                    UIkit.modal.alert(data.message).then(function () {

                    });

                    table.draw();
                    UIkit.modal($("#add-modal")).hide();
                },
                error: function(data) {
                    UIkit.modal.alert(data.responseJSON.message).then(function () {

                    });
                }
            });
        });

        function showDetail(id)
    {
        UIkit.modal($("#edit-modal")).show();

        $.ajax({
            type: "GET",
            url: 'cetak/detail/' + id,
            success: function (data) {
                var status = data.data.status == 1 ? 'Aktif' : 'Tidak aktif';

                //Set up data for edit modal
                $("input[name=edit-matcetak-id]").val(data.data.id);
                $("input[name=detail-matcetak-name]").val(data.data.name);
                $("input[name=detail-matcetak-price]").val(data.data.price);
                $("textarea[name=detail-matcetak-desc]").val(data.data.description);

                if (data.data.status <= 0) {
                    $('.switchery').click();
                }

                //Set up credentials for edit and delete action...
                $(".delete-units").attr('data-id', id);
            },
            error: function (data) {
                UIkit.modal.alert(data.responseJSON.message).then(function () {

                });
            }
        });
    }
    </script>


    {{-- <script>
        // Create New Item
        $('#add_variant_form').submit(function(e) {
            e.preventDefault();

            // Define ajax pre-requirement
            let ajax = {
                type: 'POST',
                url: "{{ route('variants') }}"
            };

            // Get Form Source By ID
            let form_source = document.getElementById('add_variant_form');

            // Declare FormData By form_source
            let formdata = new FormData(form_source);

            // Add FormData Item
            formdata.append('_token', '{{ csrf_token() }}');
            formdata.append('name', $('#new-variant-name').val());
            formdata.append('product', $('#new-variant-product-data').val());
            formdata.append('status', $('#new-variant-status').is(':checked') === true ? 1 : 0);

            // Perform AJAX
            $.ajax({
                type: ajax.type,
                url: ajax.url,
                data: formdata,
                cache: false,
                contentType: false,
                processData: false,
                success: function (data) {

                    // Hide add-variant-modal Modal
                    UIkit.modal($("#add-variant-modal")).hide();

                    UIkit.modal.alert(data.message).then(function () {

                    });

                    // Reset Form
                    $('#add_variant_form').trigger('reset');

                    // Re-draw the table
                    table.draw();

                },
                error: function (error) {

                    // Hide add-variant-modal Modal
                    UIkit.modal($("#add-variant-modal")).hide();

                    UIkit.modal.alert(error.responseJSON.message).then(function () {

                    });

                }
            });

        });

        // Get Content Data
        function getContentData(data_id) {
            try {
                // Declare Edit Variant Modal
                let edit_modal = $("#edit-variant-modal");

                // Show Edit Variant Modal
                UIkit.modal(edit_modal).show();

                // Define ajax pre-requirement
                let ajax = {
                    type: 'GET',
                    url: 'variants/'+data_id,
                };

                // Perform Ajax
                $.ajax({
                    type: ajax.type,
                    url: ajax.url,
                    success: function (data) {

                        // Define result data
                        let result = data.data[0];

                        // Set Delete Target to Delete Variant Button
                        $('#delete-variant-button').attr('href', "javascript:deleteData("+ result.id +")");
                        $("#data-variant-id").val(result.id);

                        // Fill Variant Name
                        let variant_name = $('#data-variant-name');
                        let variant_status = $('#data-variant-status');

                        variant_name.parent().addClass('sc-input-focus');
                        variant_name.val(result.name);

                        // Add data-variant-id attributes on Edit Modal
                        edit_modal.attr('data-variant-id', result.has_product.id);

                        // Set Status
                        if (result.status === 1 && variant_status.is(':checked') === false) {

                            // Click event on Switchery Checkbox
                            variant_status.click();

                        } else if (result.status === 0 && variant_status.is(':checked') === true) {

                            // Click event on Switchery Checkbox
                            variant_status.click();
                        }

                        // Set Update Action
                        $('#data-edit-variant-button').attr('href', "javascript:updateData("+ result.id +")");

                        // Fill Product Category
                        updateProductSelector({
                            data_name: result.name,
                            data_url: 'variants/data/',
                            data_id: edit_modal.attr('data-variant-id'),
                            success: function(data) {

                                // Define data variant Product Selector
                                let dataVariantProduct = $('#data-variant-product');

                                // Get product data from response
                                let products = data.data.products;

                                // Create Option element, then append to the select input
                                let data_content = "<option value='0'>Pilih Produk</option>";
                                dataVariantProduct.append(data_content);

                                // Loop Product Content
                                for(a in products){

                                    if (products.hasOwnProperty(a)) {

                                        // Add Checked attributes if product id is matched with the result
                                        if (products[a].id === result.has_product.id) {

                                            // Create Option element with selected attribute, then append to the select input
                                            let data_content = "<option class='data-option-content' selected value='"+ products[a].id +"'>"+ products[a].name + " ( "+ products[a].has_sub_categories.has_categories.name +" > "+ products[a].has_sub_categories.name + " )" +"</option>";
                                            dataVariantProduct.append(data_content);

                                        } else {

                                            // Create Option element, then append to the select input
                                            let data_content = "<option class='data-option-content' value='"+ products[a].id +"'>"+ products[a].name + " ( "+ products[a].has_sub_categories.has_categories.name +" > "+ products[a].has_sub_categories.name + " )" +"</option>";
                                            dataVariantProduct.append(data_content);

                                        }

                                    }

                                }

                            },
                            error: function (error) {

                                // SweetAlert : Show Error Message
                                Swal.fire({
                                    icon: 'error',
                                    title: "Galat",
                                    text: error.statusText
                                });

                            }
                        })
                    },
                    error: function (data) {

                        // SweetAlert : Show Error Message
                        Swal.fire({
                            icon: 'error',
                            title: 'Galat',
                            text: data.statusText,
                            footer: '<a href>Why do I have this issue?</a>'
                        });

                        console.log(data.statusText);

                    }
                });

            } catch (e) {

                // SweetAlert : Show Error Message
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: e,
                    footer: '<a href>Why do I have this issue?</a>'
                });

            }
        }

        // Update Select Option
        function updateProductSelector(raw_data) {
            // Declare AJAX Pre-requirements
            let ajax = {
                type: 'GET',
                url: raw_data.data_url + raw_data.data_name,
            };

            // Perform AJAX
            $.ajax({
                type: ajax.type,
                url: ajax.url,
                success: function(data) {
                    // Return Response Data to Success Function
                    return raw_data.success(data);
                },
                error: function(error) {
                    // Return Response Data to Success Function
                    return raw_data.error(error);
                }
            })
        }

        $("#edit-variant-form").submit(function (e) {
            e.preventDefault();

            let id = $("#data-variant-id").val();

            // Declare AJAX Pre-requirement
            let ajax = {
                type: 'POST',
                url: "variants/update/" + id
            };

            // Declate Form Source
            let formSource = document.getElementById('edit-variant-form');

            // Declare FormData from form_source
            let formData = new FormData(formSource);

            // Add FormData Item
            formData.append('_token', "{{ csrf_token() }}");
            formData.append('name', $('#data-variant-name').val());
            formData.append('product_id', $('#data-variant-product').val());
            formData.append('status', $('#data-variant-status').is(':checked') === true ? 1 : 0);

            // Perform AJAX
            $.ajax({
                type: ajax.type,
                url: ajax.url,
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function (data) {

                    // Remove Form Element Content to Default
                    cancel_editing();

                    UIkit.modal.alert(data.message).then(function () {

                    });

                    // Re-Draw the Table
                    table.draw();
                },
                error: function (error) {

                    // Remove Form Element Content to Default
                    cancel_editing();

                    UIkit.modal.alert(error.responseJSON.message).then(function () {

                    });
                }
            })
        });


        function deleteData(id)
        {
            try {

                // Confirm Modal
                UIkit.modal.confirm('Anda yakin ingin hapus item ini ?').then(function () {

                    // Prepare AJAX pre-requirement
                    let ajax = {
                        type: 'DELETE',
                        url: 'variants/delete/' + id,
                        token: {_token: '{{ csrf_token() }}'},
                    };

                    // Pergorm Ajax Deletion
                    $.ajax({
                        type: ajax.type,
                        url: ajax.url,
                        data: ajax.token,
                        success: function (data) {
                            UIkit.modal.alert(data.message).then(function () {

                            });

                            // Re-Draw the table
                            table.draw();
                        },

                        error: function (error) {

                            UIkit.modal.alert(error.responseJSON.message).then(function () {

                            });
                        }

                    });

                }, function () {
                    alert('Rejected.');
                });

            } catch (e) {

                // Hide Edit Variant Modal
                UIkit.modal($("#edit-variant-modal")).hide();

                UIkit.modal.alert(e.statusText).then(function () {

                });
            }
        }


        // Cancel Edit Function
        function cancel_editing(){

            $('#data-variant-product').empty();
            UIkit.modal($("#edit-variant-modal")).hide();

        }

    </script> --}}




@endpush

@push('dropify')
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script> -->
<script src="{{ asset('assets/js/vendor/dropify/dropify.min.js') }}"></script>
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
