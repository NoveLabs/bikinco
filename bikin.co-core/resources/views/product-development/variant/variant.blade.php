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
                        <h5>Pada halaman ini terdapat data master varian dari Bikin-co</h5>
                        <p>Anda dapat menambah, mengedit dan menghapus data varian sesuai kebutuhan Anda.</p>
                    </div>
                </div>
            </div>
            <div class="uk-grid" data-uk-grid>
                <div class="uk-width-1-1@m">
                    <div class="uk-card uk-margin">
                        <div class="uk-flex-middle sc-padding sc-padding-medium-ends uk-grid-small" data-uk-grid>
                            <div class="uk-flex-1">
                                <h3 class="uk-card-title">Data Master Varian</h3>
                            </div>
                            <div class="uk-width-auto@s">
                                <button class="sc-button sc-button-primary sc-button-flex" type="button">Pengaturan Kolom <i class="mdi mdi-chevron-down uk-margin-small-left"></i></button>
                                <div class="uk-dropdown uk-width-small" data-uk-drop="mode: click">
                                    <div class="sc-padding-small">
                                        <div class="uk-margin-small">
                                            <input type="checkbox" class="data-variant-table-toggle" data-content="0" value="0" checked disabled>
                                            <label for="sc-dt-col-0">No</label>
                                        </div>
                                        <div class="uk-margin-small">
                                            <input type="checkbox" class="data-variant-table-toggle" data-content="1" value="1" checked>
                                            <label for="sc-dt-col-1">Nama Varian</label>
                                        </div>
                                        <div class="uk-margin-small">
                                            <input type="checkbox" class="data-variant-table-toggle" data-content="2" value="2" checked>
                                            <label for="sc-dt-col-2">Nama Produk</label>
                                        </div>
                                        <div class="uk-margin-small">
                                            <input type="checkbox" class="data-variant-table-toggle" data-content="3" value="3" checked>
                                            <label for="sc-dt-col-3">Tanggal Input</label>
                                        </div>
                                        <div class="uk-margin-small">
                                            <input type="checkbox" class="data-variant-table-toggle" data-content="4" value="4" checked>
                                            <label for="sc-dt-col-4">Status</label>
                                        </div>
                                        <div class="uk-margin-small">
                                            <input type="checkbox" class="data-variant-table-toggle" data-content="5" value="5" checked>
                                            <label for="sc-dt-col-5">Aksi</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="uk-margin-remove">
                        <div class="uk-card-body">
                            <table id="data-variant-table" class="uk-table uk-table-striped dt-responsive">
                                <thead>
                                <tr>
                                    <th>No</th>
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
    <div id="add-variant-modal" class="modal-close data_subcategory" data-uk-modal>
        <div class="uk-modal-dialog uk-modal-body">
            <button class="uk-modal-close-default" type="button" data-uk-close></button>
            <h2 class="uk-modal-title">Input Varian</h2>
            <form action="" method="" id="add_variant_form">
                @csrf
                <div class="uk-modal-body uk-padding-remove">
                    <div class="uk-grid" data-uk-grid="">
                        <div class="uk-width-1-1@l">
                            <label>Nama Varian<sup>*</sup></label>
                            <input type="text" id="new-variant-name" class="uk-input" data-sc-input required>
                        </div>
                        <div class="uk-width-1-1@l">
                            <label class="custom-form-label">Pilih Produk<sup>*</sup></label>
                            <div class="uk-width-expand">
                                <select id="new-variant-product-data" name="f-v-select2" class="uk-select"
                                        data-sc-select2='{"placeholder": "Pilih Kategori", "allowClear": true }'
                                        required>
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
                            <label>Status Varian</label> <br>
                            <input type="checkbox" id="new-variant-status" data-sc-switchery checked/><label
                                    class="uk-margin-small-left">Aktif / Non Aktif</label>
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
    <div id="edit-variant-modal" class="modal-close data_subcategory" data-variant-id="" data-uk-modal>
        <div class="uk-modal-dialog uk-modal-body">
            <button class="uk-modal-close-default" type="button" data-uk-close></button>
            <h2 class="uk-modal-title">Detail Informasi Varian</h2>
            <form action="" method="" id="edit-variant-form">
                <input type="hidden" id="data-variant-id">
                <div class="uk-modal-body uk-padding-remove">
                    <div class="uk-grid" data-uk-grid>
                        <div class="uk-width-1-1@l">
                            <label>Nama Varian<sup>*</sup></label>
                            <input type="text" id="data-variant-name" class="uk-input uk-active" data-sc-input>
                        </div>
                        <div class="uk-width-1-1@l">
                            <label class="custom-form-label">Pilih Produk<sup>*</sup></label>
                            <div class="uk-width-expand">
                                <select name="f-v-select2" id="data-variant-product" class="uk-selects"
                                        data-sc-select2='{"placeholder": "Pilih Kategori", "allowClear": true }'
                                        required>

                                </select>
                            </div>
                        </div>
                        <div class="uk-width-1-1@l">
                            <label>Status Varian</label> <br>
                            <input type="checkbox" data-sc-switchery="true" id="data-variant-status"/><label
                                    class="uk-margin-small-left">Aktif / Non Aktif</label>
                        </div>
                        <div class="uk-width-1-1@l">
                            <div class="uk-grid" data-uk-grid>
                                <div class="uk-width-1-2@l">
                                    <a id="delete-variant-button" href="#">
                                        <button class="sc-button sc-button-danger" type="button">Hapus</button>
                                    </a>
                                </div>
                                <div class="uk-width-1-2@l">
                                    <div class="uk-text-right">
                                        <a id="data-cancel-edit-variant" href="javascript:cancel_editing();">
                                            <button class="sc-button sc-button-flat sc-button-flat-danger"
                                                    type="button">Batalkan
                                            </button>
                                        </a>
                                        <a id="data-edit-variant-button" href="">
                                            <button class="sc-button sc-button-outline-primary"
                                                    id="data-edit-variant-button" type="submit"
                                                    data-button-mode="light">Simpan
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
        <a href="#add-variant-modal" class="sc-fab sc-fab-text sc-fab-success" data-uk-toggle="target: #add-variant-modal"><i class="mdi mdi-plus"></i>Tambahkan</a>
    </div>

@endsection

@push('scripts')
    <script src="{{ asset('js/private/script.js') }}"></script>
    <script>
            // Datatables Init
            let table = $('#data-variant-table').DataTable({
                processing: true,
                serverSide: true,
                retrieve: true,
                ajax: "{{ route('variants') }}",
                columns: [
                    {data: 'id', name: 'id', title: 'No'},
                    {data: 'name', name: 'name', title: 'Varian'},
                    {data: 'product', name: 'product', title: 'Nama Produk'},
                    {data: 'created_at', name: 'created_at', title: 'Tanggal Input'},
                    {data: 'status', name: 'status', title: 'Status'},
                    {data: 'action', name: 'action', title: 'Tindakan', orderable: false, searchable: false},
                ],
            });

            // Set data-variant-table-toggle class on onClick event
            $('.data-variant-table-toggle').on('click', function(){

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

    </script>




@endpush