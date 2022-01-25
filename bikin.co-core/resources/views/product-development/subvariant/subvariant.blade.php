@extends('layouts.app')

@push('plugin-sweetalert')
    <link rel="stylesheet" href="{{ asset('plugins/sweetalert/sweetalert2.min.css') }}">
    <script src="{{ asset('plugins/sweetalert/sweetalert2.min.js') }}"></script>
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
                        <h5>Pada halaman ini terdapat data master subvarian dari Bikin-co</h5>
                        <p>Anda dapat menambah, mengedit dan menghapus data subvarian sesuai kebutuhan Anda.</p>
                    </div>
                </div>
            </div>
            <div class="uk-grid" data-uk-grid>
                <div class="uk-width-1-1@m">
                    <div class="uk-card uk-margin">
                        <div class="uk-flex-middle sc-padding sc-padding-medium-ends uk-grid-small" data-uk-grid>
                            <div class="uk-flex-1">
                                <h3 class="uk-card-title">Data Master Subvarian</h3>
                            </div>
                            <div class="uk-width-auto@s">
                                <button class="sc-button sc-button-primary sc-button-flex" type="button">Pengaturan Kolom <i class="mdi mdi-chevron-down uk-margin-small-left"></i></button>
                                <div class="uk-dropdown uk-width-small" data-uk-drop="mode: click">
                                    <div class="sc-padding-small">
                                        <div class="uk-margin-small">
                                            <input type="checkbox" class="data-subvariant-table-toggle" data-content="0" value="0" checked disabled>
                                            <label for="sc-dt-col-0">No</label>
                                        </div>
                                        <div class="uk-margin-small">
                                            <input type="checkbox" class="data-subvariant-table-toggle" data-content="1" value="1" checked>
                                            <label for="sc-dt-col-1">Nama Subvarian</label>
                                        </div>
                                        <div class="uk-margin-small">
                                            <input type="checkbox" class="data-subvariant-table-toggle" data-content="2" value="2" checked>
                                            <label for="sc-dt-col-2">Nama Varian</label>
                                        </div>
                                        <div class="uk-margin-small">
                                            <input type="checkbox" class="data-subvariant-table-toggle" data-content="3" value="3" checked>
                                            <label for="sc-dt-col-3">Nama Produk</label>
                                        </div>
                                        <div class="uk-margin-small">
                                            <input type="checkbox" class="data-subvariant-table-toggle" data-content="4" value="4" checked>
                                            <label for="sc-dt-col-4">Tanggal Input</label>
                                        </div>
                                        <div class="uk-margin-small">
                                            <input type="checkbox" class="data-subvariant-table-toggle" data-content="5" value="5" checked>
                                            <label for="sc-dt-col-5">Status</label>
                                        </div>
                                        <div class="uk-margin-small">
                                            <input type="checkbox" class="data-subvariant-table-toggle" data-content="6" value="6" checked>
                                            <label for="sc-dt-col-6">Aksi</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="uk-margin-remove">
                        <div class="uk-card-body">
                            <table id="data-subvariant-table" class="uk-table uk-table-striped dt-responsive">
                                <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Subvarian</th>
                                    <th>Varian</th>
                                    <th>Nama Produk</th>
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
        </div>
    </div>

    <!-- modal input produk -->
    <div id="add-subvariant-modal" class="modal-close data_subcategory" data-uk-modal>
        <div class="uk-modal-dialog uk-modal-body">
            <button class="uk-modal-close-default" type="button" data-uk-close></button>
            <h2 class="uk-modal-title">Input Varian</h2>
            <form action="" method="" id="add-subvariant-form">
                <div class="uk-modal-body uk-padding-remove">
                    <div class="uk-grid" data-uk-grid>
                        <div class="uk-width-1-1@l">
                            <label class="custom-form-label">Pilih Produk<sup>*</sup></label>
                            <div class="uk-width-expand">
                                <select id="new-subvariant-product-data" onchange="return get_variant_data(this.value)"
                                        name="f-v-select2" class="uk-select"
                                        data-sc-select2='{"placeholder": "Pilih Produk", "allowClear": true }' required>
                                    <option value="0">Pilih Produk</option>
                                    @foreach($products as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }} @if( !empty($item->hasSubCategories) && !empty($item->hasSubCategories->hasCategories))
                                                ({{ $item->hasSubCategories->hasCategories->name }}
                                                > {{ $item->hasSubCategories->name }}) @endif</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="uk-width-1-1@l">
                            <label class="custom-form-label">Pilih Varian<sup>*</sup></label>
                            <div class="uk-width-expand">
                                <select id="new-subvariant-variant-data" name="f-v-select2" class="uk-select"
                                        data-sc-select2='{"placeholder": "Pilih Varian", "allowClear": true }' required>
                                    {{--@foreach($variants as $item)--}}
                                    {{--<option value="{{ $item->id }}">{{ $item->name }}</option>--}}
                                    {{--@endforeach--}}
                                </select>
                            </div>
                        </div>
                        <div class="uk-width-1-1@l">
                            <label>Nama Subvarian<sup>*</sup></label>
                            <input type="text" id="new-subvariant-name" class="uk-input" data-sc-input>
                        </div>
                        <div class="uk-width-1-1@l">
                            <label>Status Subvarian</label> <br>
                            <input type="checkbox" id="new-subvariant-status" data-sc-switchery checked/><label
                                    class="uk-margin-small-left">Aktif / Non Aktif</label>
                        </div>
                        <div class="uk-width-1-1@l">
                            <div class="uk-text-right">
                                <button class="sc-button sc-button-flat sc-button-flat-danger uk-modal-close"
                                        type="button">Batalkan
                                </button>
                                <button class="sc-button sc-button-outline-primary" id="add-subvariant-button"
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
    <div id="edit-subvariant-modal" class="modal-close data_subcategory" data-subvariant-id="" data-uk-modal>
        <div class="uk-modal-dialog uk-modal-body">
            <button class="uk-modal-close-default" type="button" data-uk-close></button>
            <h2 class="uk-modal-title">Detail Informasi Subvarian</h2>
            <form action="" method="" id="edit-subvariant-form">
                <input type="hidden" id="data-subvariant-id">
                <div class="uk-modal-body uk-padding-remove">
                    <div class="uk-grid" data-uk-grid>
                        <div class="uk-width-1-1@l">
                            <label class="custom-form-label">Pilih Produk<sup>*</sup></label>
                            <div class="uk-width-expand">
                                <select name="f-v-select2" id="edit-data-subvariant-product" class="uk-selects"
                                        data-sc-select2='{"placeholder": "Pilih Produk", "allowClear": true }' required>

                                </select>
                            </div>
                        </div>
                        <div class="uk-width-1-1@l">
                            <label class="custom-form-label">Pilih Varian<sup>*</sup></label>
                            <div class="uk-width-expand">
                                <select name="f-v-select2" id="edit-data-subvariant-variant" class="uk-selects"
                                        data-sc-select2='{"placeholder": "Pilih Varian", "allowClear": true }' required>

                                </select>
                            </div>
                        </div>
                        <div class="uk-width-1-1@l">
                            <label>Nama Varian<sup>*</sup></label>
                            <input type="text" id="edit-data-subvariant-name" class="uk-input uk-active" data-sc-input>
                        </div>
                        <div class="uk-width-1-1@l">
                            <label>Status Subvarian</label> <br>
                            <input type="checkbox" data-sc-switchery="true" id="edit-data-subvariant-status"/><label
                                    class="uk-margin-small-left">Aktif / Non Aktif</label>
                        </div>
                        <div class="uk-width-1-1@l">
                            <div class="uk-grid" data-uk-grid>
                                <div class="uk-width-1-2@l uk-width-1-2@s">
                                    <a id="delete-subvariant-button" href="#">
                                        <button class="sc-button sc-button-danger" type="button">Hapus</button>
                                    </a>
                                </div>
                                <div class="uk-width-1-2@l uk-width-1-2@s">
                                    <div class="uk-text-right">
                                        <a id="data-cancel-edit-subvariant" href="javascript:cancel_editing();">
                                            <button class="sc-button sc-button-flat sc-button-flat-danger"
                                                    type="button">Batalkan
                                            </button>
                                        </a>
                                        <a id="data-edit-subvariant-button" href="">
                                            <button class="sc-button sc-button-outline-primary"
                                                    id="data-edit-subvariant-button" data-button-mode="light">Simpan
                                            </button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- end modal edit produk -->

    <div class="sc-fab-card-wrapper uk-position-bottom-right">
        <a href="#add-subvariant-modal" class="sc-fab sc-fab-text sc-fab-success" data-uk-toggle="target: #add-subvariant-modal"><i class="mdi mdi-plus"></i>Tambahkan</a>
    </div>

@endsection

@push('scripts')
    <script src="{{ asset('js/private/script.js') }}"></script>
    <script>
        // Datatables Init
        let table = $('#data-subvariant-table').DataTable({
            processing: true,
            serverSide: true,
            retrieve: true,
            ajax: "{{ route('subvariants') }}",
            columns: [
                {data: 'id', name: 'id', title: 'No'},
                {data: 'name', name: 'name', title: 'Nama Subvarian'},
                {data: 'product', name: 'product', title: 'Nama Produk'},
                {data: 'variant', name: 'variant', title: 'Varian'},
                {data: 'created_at', name: 'created_at', title: 'Tanggal Input'},
                {data: 'status', name: 'status', title: 'Status'},
                {data: 'action', name: 'action', title: 'Tindakan', orderable: false, searchable: false},
            ],
        });

        // Set data-variant-table-toggle class on onClick event
        $('.data-subvariant-table-toggle').on('click', function(){

            // Define DataTable Source
            let column = table.column( $(this).attr('data-column') );

            // Hide / Show the Column
            column.visible( ! column.visible() );

            // Re-draw the table
            table.draw();

        });
    </script>
    <script>
        // Create New Item
        $('#add-subvariant-form').submit(function (e) {
            e.preventDefault();

            try {
                // Declare modal
                let add_modal = $("#add-subvariant-modal");

                // Declare form and Input Content
                let form_source = document.getElementById('edit-subvariant-form');
                let subvariant_name = $('#new-subvariant-name');
                let product_reference = $('#new-subvariant-product-data');
                let variant_reference = $('#new-subvariant-variant-data');
                let status = $('#new-subvariant-status').is(':checked') === true ? 1 : 0;

                // Define ajax pre-requirement
                let ajax = {
                    type: 'POST',
                    url: "{{ route('subvariants') }}"
                };

                // Declare form Data
                let formData = new FormData(form_source);

                // Add FormData Item
                formData.append('_token', '{{ csrf_token() }}');
                formData.append('name', subvariant_name.val());
                formData.append('product', product_reference.val());
                formData.append('variant', variant_reference.val());
                formData.append('status', status);

                // Perform AJAX
                $.ajax({
                    type: ajax.type,
                    url: ajax.url,
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(data) {

                        // Hide the modal
                        UIkit.modal(add_modal).hide();

                        UIkit.modal.alert(data.message).then(function () {

                        });

                        // Reset Form
                        $('#add_subvariant_form').trigger('reset');

                        // Re-Draw the table
                        table.draw();
                    },
                    error: function(error) {

                        // Hide the modal
                        UIkit.modal(add_modal).hide();

                        UIkit.modal.alert(error.responseJSON.message).then(function () {

                        });
                    }
                })

            } catch (e) {

                // Hide the modal
                UIkit.modal($("#add-subvariant-modal")).hide();

                UIkit.modal.alert(e.statusText).then(function () {

                });

            }
        });

        // Get Content Data
        function get_content_data(data_id){
            try {
                // Declare modal
                let edit_modal = $("#edit-subvariant-modal");

                // Show the modal
                UIkit.modal(edit_modal).show();

                // Declare AJAX Pre-requirement
                let ajax = {
                    type: 'GET',
                    url: "subvariants/" + data_id
                };

                // Perform AJAX
                $.ajax({
                    type: ajax.type,
                    url: ajax.url,
                    success: function(data) {

                        // Define Result Data
                        let result = data.data[0];

                        // Set Delete Target to Delete Subvariant Button
                        $('#delete-subvariant-button').attr('href', "javascript:delete_data("+ result.id +")");
                        $("#data-subvariant-id").val(result.id);

                        // Fill Variant Name
                        let subvariant_name = $('#edit-data-subvariant-name');
                        let subvariant_status = $('#edit-data-subvariant-status');

                        subvariant_name.parent().addClass('sc-input-focus');
                        subvariant_name.val(result.name);

                        // Set Attribute to Edit Modal
                        edit_modal.attr('data-subvariant-id', result.id);

                        // Set Status
                        if (result.status === 1 && subvariant_status.is(':checked') === false) {

                            // Click event on Switchery Checkbox
                            subvariant_status.click();

                        } else if (result.status === 0 && subvariant_status.is(':checked') === true) {

                            // Click event on Switchery Checkbox
                            subvariant_status.click();
                        }

                        // Set Update Action
                        $('#data-edit-subvariant-button').attr('href', "javascript:update_data("+ result.id +")");

                        // Fill Product Category
                        updateProductSelector({
                            data_name: result.name,
                            data_url: 'subvariants/data/',
                            data_id: edit_modal.attr('data-subvariant-id'),
                            success: function(data)
                            {
                                // Define Data Selector
                                let productSelector = $('#edit-data-subvariant-product');
                                let variantSelector = $('#edit-data-subvariant-variant');

                                // Get product data from response
                                let products = data.data.products;

                                // Get variant data from response
                                let variants = data.data.variants;

                                // Get subvariant data from response
                                let subvariants = data.data.subvariants;

                                let data_content = "<option value='0'>Pilih Produk</option>";
                                productSelector.append(data_content);

                                let data_content_variant = "<option value='0'>Pilih Varian</option>";
                                variantSelector.append(data_content_variant);

                                // Loop Products Content
                                for(a in products){

                                    if (products.hasOwnProperty(a)) {

                                        // Add Checked attributes if product id is matched with the result
                                        if (products[a].id === result.has_product.id){

                                            // Create Option element with selected attribute, then append to the select input
                                            let data_content = "<option class='data-option-content' selected value='"+ products[a].id +"'>"+ products[a].name + " ( "+ products[a].has_sub_categories.has_categories.name +" > "+ products[a].has_sub_categories.name + " )" +"</option>";
                                            productSelector.append(data_content);

                                        } else {

                                            // Create Option element, then append to the select input
                                            let data_content = "<option class='data-option-content' selected value='"+ products[a].id +"'>"+ products[a].name + " ( "+ products[a].has_sub_categories.has_categories.name +" > "+ products[a].has_sub_categories.name + " )" +"</option>";
                                            productSelector.append(data_content);

                                        }

                                    }

                                }

                                // Loop Variant Items
                                for(b in variants){

                                    if (variants.hasOwnProperty(b)) {

                                        // Check if product id is matched with the result
                                        if (variants[b].id === result.has_variant.id){

                                            // Create Option element with selected attribute, then append to the select input
                                            let data_content = "<option class='data-option-content' selected value='"+ variants[b].id +"'>"+ variants[b].name +"</option>";
                                            $('#edit-data-subvariant-variant').append(data_content);

                                        } else {

                                            // Create Option element, then append to the select input
                                            let data_content = "<option class='data-option-content' value='"+ variants[b].id +"'>"+ variants[b].name +"</option>";
                                            $('#edit-data-subvariant-variant').append(data_content);

                                        }

                                    }

                                }

                            },
                            error: function(error) {

                                UIkit.modal.alert(error.responseJSON.message).then(function () {

                                });
                            }
                        })
                    },
                    error: function(data) {

                        UIkit.modal.alert(data.message).then(function () {

                        });
                    }
                });

            } catch (e) {

                UIkit.modal.alert(e.statusText).then(function () {

                });

            }
        }

        // Update Select Option
        function updateProductSelector(raw_data) {
            // Declare AJAX Pre-requirement
            let ajax = {
                type: 'GET',
                url: raw_data.data_url + raw_data.data_name,
            };

            // Perform AJAX
            $.ajax({
                type: ajax.type,
                url: ajax.url,
                success: function(data){
                    // Return Response Data to Success Function
                    return raw_data.success(data);
                },
                error: function(error){
                    // Return Response Data to Success Function
                    return raw_data.error(error);
                }
            })
        }

        $("#edit-subvariant-form").submit(function (e) {

            // Prevent Default
            e.preventDefault();

            let id = $("#data-subvariant-id").val();
            // Declare AJAX Pre-requirement
            let ajax = {
                type: 'POST',
                url: "subvariants/update/" + id
            };

            // Declare FormData from form_source
            let formData = new FormData(this);

            // Declare form Input
            let subvariant_name = $('#edit-data-subvariant-name');
            let product_reference = $('#edit-data-subvariant-product');
            let variant_reference = $('#edit-data-subvariant-variant');
            let status = $('#edit-data-subvariant-status').is(':checked') === true ? 1 : 0;

            // Add FormData Item
            formData.append('_token', '{{ csrf_token() }}');
            formData.append('name', subvariant_name.val());
            formData.append('product_id', product_reference.val());
            formData.append('variant_id', variant_reference.val());
            formData.append('status', status);

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
            });

        });


        function delete_data(id) {
            try {
                // Hide the modal
                UIkit.modal($("#edit-subvariant-modal")).hide();

                UIkit.modal.confirm('Anda yakin ingin hapus item ini ?').then(function () {
                    // Prepare AJAX pre-requirement
                    let ajax = {
                        type: 'DELETE',
                        url: 'subvariants/delete/' + id,
                        token: {_token: '{{ csrf_token() }}'},
                    };

                    // Perform AJAX
                    $.ajax({
                        type: ajax.type,
                        url: ajax.url,
                        data: ajax.token,
                        success: function (data) {

                            UIkit.modal.alert(data.message).then(function () {

                            });

                            // Re-Draw the Table
                            table.draw();
                        },
                        error: function (error) {

                            UIkit.modal.alert(error.responseJSON.message).then(function () {

                            });
                        }
                    });
                });

            } catch (e) {

                // Hide the modal
                UIkit.modal($("#edit-subvariant-modal")).hide();

                UIkit.modal.alert(e.statusTexr).then(function () {

                });
            }
        }


        // Cancel Edit Function
        function cancel_editing(){
            $('#edit-data-subvariant-product').empty();
            $('#edit-data-subvariant-variant').empty();
            UIkit.modal($("#edit-subvariant-modal")).hide();
        }


        // Change Variant Variant if Product id Selected
        function get_variant_data(source_id){

            // Declare Select element
            let product_reference = $('#edit-data-subvariant-product');
            let variant_reference = $('#edit-data-subvariant-variant');
            let new_variant_reference = $('#new-subvariant-variant-data');

            // Empty all references option element
            product_reference.empty();
            variant_reference.empty();
            new_variant_reference.empty();

            // Get Product Id
            let product_id = source_id;

            // Perform Get Variant By Product
            let param = {
                type: 'GET',
                url: 'subvariants/get-variant/' + product_id,
                success: function(data){

                    // Get response Data
                    let variants = data.data;

                    // Create output element, then append it to new_variant_reference
                    let data_content = "<option value='0'>Pilih Variant</option>";
                    new_variant_reference.append(data_content);

                    for(a in variants){

                        if (variants.hasOwnProperty(a)) {

                            // Create output element with selected attribute, then append it to new_variant_reference
                            let data_content = "<option class='data-option-content' value='" + variants[a].id + "'>" + variants[a].name + "</option>";
                            new_variant_reference.append(data_content);

                        }

                    }

                },
                error: function(error) {

                    UIkit.modal.alert(error.responseJSON.message).then(function () {

                    });
                }
             };

            // Perform AJAX
            $.ajax(param);

        }
    </script>
@endpush