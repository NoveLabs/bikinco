@extends('layouts.app')

@push('css-dropify')
    <link rel="stylesheet" href="{{ asset('assets/js/vendor/dropify/css/dropify.min.css') }}">
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
                        <h5>Pada halaman ini terdapat data master Model dari Bikin-co</h5>
                        <p>Anda dapat menambah, mengedit dan menghapus data Model sesuai kebutuhan Anda.</p>
                    </div>
                </div>
            </div>
            <div class="uk-grid" data-uk-grid>
                <div class="uk-width-1-1@m">
                    <div class="uk-card uk-margin">
                        <div class="uk-flex-middle sc-padding sc-padding-medium-ends uk-grid-small" data-uk-grid>
                            <div class="uk-flex-1">
                                <h3 class="uk-card-title">Data Master Model</h3>
                            </div>
                            <div class="uk-width-auto@s">
                                <button class="sc-button sc-button-primary sc-button-flex" type="button">Pengaturan Kolom <i class="mdi mdi-chevron-down uk-margin-small-left"></i></button>
                                <div class="uk-dropdown uk-width-small" data-uk-drop="mode: click">
                                    <div class="sc-padding-small">
                                        <div class="uk-margin-small">
                                            <input type="checkbox" class="data-model-table-toggle" data-content="0" value="0" checked disabled>
                                            <label for="sc-dt-col-0">No</label>
                                        </div>
                                        <div class="uk-margin-small">
                                            <input type="checkbox" class="data-model-table-toggle" data-content="1" value="1" checked>
                                            <label for="sc-dt-col-0">Nama Model</label>
                                        </div>
                                        <div class="uk-margin-small">
                                            <input type="checkbox" class="data-model-table-toggle" data-content="2" value="2" checked>
                                            <label for="sc-dt-col-0">Harga</label>
                                        </div>
                                        <div class="uk-margin-small">
                                            <input type="checkbox" class="data-model-table-toggle" data-content="3" value="3" checked>
                                            <label for="sc-dt-col-1">Varian - Subvarian</label>
                                        </div>
                                        <div class="uk-margin-small">
                                            <input type="checkbox" class="data-model-table-toggle" data-content="4" value="4" checked>
                                            <label for="sc-dt-col-3">Nama Produk</label>
                                        </div>
                                        <div class="uk-margin-small">
                                            <input type="checkbox" class="data-model-table-toggle" data-content="5" value="5" checked>
                                            <label for="sc-dt-col-4">Tanggal Input</label>
                                        </div>
                                        <div class="uk-margin-small">
                                            <input type="checkbox" class="data-model-table-toggle" data-content="6" value="6" checked>
                                            <label for="sc-dt-col-5">Status</label>
                                        </div>
                                        <div class="uk-margin-small">
                                            <input type="checkbox" class="data-model-table-toggle" data-content="7" value="7" checked>
                                            <label for="sc-dt-col-6">Aksi</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="uk-margin-remove">
                        <div class="uk-card-body">
                            <table id="data-model-table" class="uk-table uk-table-striped dt-responsive">
                                <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Model</th>
                                    <th>Harga</th>
                                    <th>Subvarian - Subvariant</th>
                                    <th>Produk</th>
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
    <div id="add-model-modal" class="modal-close data_subcategory" data-uk-modal>
        <div class="uk-modal-dialog uk-modal-body">
            <button class="uk-modal-close-default" type="button" data-uk-close></button>
            <h2 class="uk-modal-title">Input Model</h2>
            <form action="" method="" id="add-model-form">
                <div class="uk-modal-body uk-padding-remove">
                    <div class="uk-grid" data-uk-grid>
                        <div class="uk-width-1-1@l">
                            <label class="custom-form-label">Pilih Produk<sup>*</sup></label>
                            <div class="uk-width-expand">
                                <select id="new-model-product-data" required
                                        onchange="return get_variant_data(this.value)" name="f-v-select2"
                                        class="uk-select"
                                        data-sc-select2='{"placeholder": "Pilih Produk", "allowClear": true }'>
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
                                <select id="new-model-variant-data" name="f-v-select2" class="uk-select"
                                        onchange="return get_subvariant_data(this.value)"
                                        data-sc-select2='{"placeholder": "Pilih Varian", "allowClear": true }' required>

                                </select>
                            </div>
                        </div>
                        <div class="uk-width-1-1@l">
                            <label class="custom-form-label">Pilih Subvarian<sup>*</sup></label>
                            <div class="uk-width-expand">
                                <select id="new-model-subvariant-data" name="f-v-select2" class="uk-select"
                                        data-sc-select2='{"placeholder": "Pilih Subvarian", "allowClear": true }'
                                        required>

                                </select>
                            </div>
                        </div>
                        <div class="uk-width-1-1@l">
                            <div class="uk-grid" data-uk-grid>
                                <div class="uk-width-1-2@l uk-width-1-2@s">
                                    <label>Nama Model<sup>*</sup></label>
                                    <input type="text" id="new-model-name" required class="uk-input" data-sc-input>
                                </div>
                                <div class="uk-width-1-2@l uk-width-1-2@s">
                                    <label>Harga<sup>*</sup></label>
                                    <input type="number" id="new-model-price" required class="uk-input" data-sc-input>
                                </div>
                            </div>
                        </div>
                        <div class="uk-width-1-1@l">
                            <label>Status Model</label> <br>
                            <input type="checkbox" id="new-model-status" data-sc-switchery checked/><label
                                    class="uk-margin-small-left">Aktif / Non Aktif</label>
                        </div>
                        <div class="uk-width-1-1@l">
                            <div class="sc-list-body" style="margin: 5px;">
                                <label style="margin-bottom: 10px;" for="input-file-max-fs">Gambar Model</label>
                                <input type="file" id="new-model-file" class="dropify dropify-data"
                                       data-max-file-size="2M"/>
                            </div>
                        </div>
                        <div class="uk-width-1-1@l">
                            <div class="uk-text-right">
                                <button class="sc-button sc-button-flat sc-button-flat-danger uk-modal-close"
                                        type="button">Batalkan
                                </button>
                                <button class="sc-button sc-button-outline-primary" id="add-model-button" type="submit"
                                        data-button-mode="light">Tambah
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
    <div id="edit-model-modal" class="modal-close data_subcategory" data-model-id="" data-uk-modal>
        <div class="uk-modal-dialog uk-modal-body">
            <button class="uk-modal-close-default" type="button" data-uk-close></button>
            <h2 class="uk-modal-title">Detail Informasi Model</h2>
            <form action="" method="" id="edit-model-form">
                <div class="uk-modal-body uk-padding-remove">
                    <div class="uk-grid" data-uk-grid>
                        <div class="uk-width-1-1@l">
                            <label class="custom-form-label">Pilih Produk<sup>*</sup></label>
                            <div class="uk-width-expand">
                                <select name="f-v-select2" id="edit-data-model-product" class="uk-selects"
                                        data-sc-select2='{"placeholder": "Pilih Produk", "allowClear": true }' required>

                                </select>
                            </div>
                        </div>
                        <div class="uk-width-1-1@l">
                            <label class="custom-form-label">Pilih Varian<sup>*</sup></label>
                            <div class="uk-width-expand">
                                <select name="f-v-select2" id="edit-data-model-variant" class="uk-selects"
                                        data-sc-select2='{"placeholder": "Pilih Varian", "allowClear": true }' required>

                                </select>
                            </div>
                        </div>
                        <div class="uk-width-1-1@l">
                            <label class="custom-form-label">Pilih Subvarian<sup>*</sup></label>
                            <div class="uk-width-expand">
                                <select name="f-v-select2" id="edit-data-model-subvariant" class="uk-selects"
                                        data-sc-select2='{"placeholder": "Pilih Subvarian", "allowClear": true }'
                                        required>

                                </select>
                            </div>
                        </div>
                        <div class="uk-width-1-1@l">
                            <div class="uk-grid" data-uk-grid>
                                <div class="uk-width-1-2@l uk-width-1-2@s">
                                    <label>Nama Model<sup>*</sup></label>
                                    <input type="text" id="edit-data-model-name" class="uk-input uk-active"
                                           data-sc-input required>
                                </div>
                                <div class="uk-width-1-2@l uk-width-1-2@s">
                                    <label>Harga<sup>*</sup></label>
                                    <input type="number" id="edit-data-model-price" class="uk-input uk-active"
                                           data-sc-input required>
                                </div>
                            </div>
                        </div>
                        <div class="uk-width-1-1@l">
                            <label>Status Model</label> <br>
                            <input type="checkbox" data-sc-switchery="true" id="edit-data-model-status"/><label
                                    class="uk-margin-small-left">Aktif / Non Aktif</label>
                        </div>
                        <div class="uk-width-1-1@l">
                            <div class="sc-list-body" style="margin: 5px;">
                                <label style="margin-bottom: 10px;" for="input-file-max-fs">Gambar Model</label>
                                <input type="file" id="update-model-file" name="file" class="dropify dropify-data"
                                       data-max-file-size="2M"/>
                            </div>
                        </div>
                        <div class="uk-width-1-1@l">
                            <div class="uk-grid" data-uk-grid>
                                <div class="uk-width-1-2@l uk-width-1-2@s">
                                    <a id="delete-model-button" href="#">
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
                                        <a id="data-edit-model-button" href="">
                                            <button class="sc-button sc-button-outline-primary"
                                                    id="data-edit-model-button" type="submit" data-button-mode="light">
                                                Simpan
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
        <a href="#add-model-modal" class="sc-fab sc-fab-text sc-fab-success" data-uk-toggle="target: #add-model-modal"><i class="mdi mdi-plus"></i>Tambahkan</a>
    </div>

@endsection

@push('scripts')
    <script src="{{ asset('js/private/script.js') }}"></script>
    <script>
        // Datatables Init
        let table = $('#data-model-table').DataTable({
            processing: true,
            serverSide: true,
            retrieve: true,
            ajax: "{{ route('models') }}",
            columns: [
                {data: 'id', name: 'id', title: 'No'},
                {data: 'name', name: 'name', title: 'Nama Model'},
                {data: 'price', name: 'price', title: 'Harga'},
                {data: 'variant_subvariant', name: 'variant_subvariant', title: 'Varian - Subvariant'},
                {data: 'product', name: 'product', title: 'Nama Produk'},
                {data: 'created_at', name: 'created_at', title: 'Tanggal Input'},
                {data: 'status', name: 'status', title: 'Status'},
                {data: 'action', name: 'action', title: 'Tindakan', orderable: false, searchable: false},
            ],
        });

        // Set data-variant-table-toggle class on onClick event
        $('.data-model-table-toggle').on('click', function(){

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
        $('#add-model-form').submit(function(e){
            e.preventDefault();

            try {
                // Declare model
                let add_modal = $("#add-model-modal");

                // Declare form & Input Content
                let form_source = document.getElementById('edit-model-form');
                let model_name = $('#new-model-name');
                let model_price = $('#new-model-price');
                let product_reference = $('#new-model-product-data');
                let variant_reference = $('#new-model-variant-data');
                let subvariant_reference = $('#new-model-subvariant-data');
                let status = $('#new-model-status').is(':checked') === true ? 1 : 0;
                let model_file = $('input[id=new-model-file]')[0].files[0];

                // Define ajax pre-requirement
                let ajax = {
                    type: 'POST',
                    url: "{{ route('models') }}"
                };

                // Declare FormData
                let formData = new FormData(form_source);

                // Add FormData item
                formData.append('_token', '{{ csrf_token() }}');
                formData.append('name', model_name.val());
                formData.append('price', model_price.val());
                formData.append('product', product_reference.val());
                formData.append('variant', variant_reference.val());
                formData.append('subvariant', subvariant_reference.val());
                formData.append('file', model_file);
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

                        // Re-Draw the tale
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
                UIkit.modal($("#edit-model-modal")).hide();

                UIkit.modal.alert(e.statusText).then(function () {

                });
            }
        });

        // Get Content Data
        function get_content_data(data_id){
            try {
                // Declare modal
                let edit_modal = $("#edit-model-modal");

                // Show the modal
                UIkit.modal(edit_modal).show();

                // Declare AJAX Pre-requirement
                let ajax = {
                    type: 'GET',
                    url: "models/" + data_id
                };

                // Perform AJAX
                $.ajax({
                    type: ajax.type,
                    url: ajax.url,
                    success: function(data) {

                        // Define Result Data
                        let result = data.data[0];

                        // Set Delete Target to Delete Model Button
                        $('#delete-model-button').attr('href', "javascript:delete_data("+ result.id +")");

                        // Fill Variant Name
                        let model_name = $('#edit-data-model-name');

                        model_name.parent().addClass('sc-input-focus');
                        model_name.val(result.name);

                        // Fill Model Price
                        let model_price = $('#edit-data-model-price');

                        model_price.parent().addClass('sc-input-focus');
                        model_price.val(result.price);

                        // Set Attribute to Edit Modal
                        edit_modal.attr('data-model-id', result.id);

                        // Dropify
                        let image_target = $("#update-model-file");


                        //  Dropify : Set Image to Render
                        let preview_button = image_target.next();
                        let render_target = image_target.next().next();
                        let file_name = render_target.find('.dropify-filename-inner');
                        let render_children = render_target.children('.dropify-render');

                        // Check If File PAth are null or empty
                        if (result.file !== null) {
                            // First : Remove All Content
                            render_children.empty();
                            render_target.css('display', 'none');
                            preview_button.css('display', 'none');

                            // Dropify : Set Image
                            image_target.attr("data-default-file", "{{ url('/') }}/" + result.file);
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

                        // Declare Switchery Checkbox
                        let model_status = $('#edit-data-model-status');

                        // Set Status
                        if (result.status === 1 && model_status.is(':checked') === false) {

                            // Click event on Switchery Checkbox
                            model_status.click();

                        } else if (result.status === 0 && model_status.is(':checked') === true) {

                            // Click event on Switchery Checkbox
                            model_status.click();

                        } else if (result.status === 0 && model_status.is(':checked') === true) {

                            // Click event on Switchery Checkbox
                            model_status.click();
                        }

                        // Set Update Action
                        edit_modal.attr('data-model-id', result.id);

                        // Fill Product Category
                        updateProductSelector({
                            data_name: result.name,
                            data_url: 'models/data/',
                            data_id: $('#edit-variant-modal').attr('data-model-id'),
                            success: function(data)
                            {
                                // Declare Data Selector
                                let productSelector = $('#edit-data-model-product');
                                let variantSelector = $('#edit-data-model-variant');
                                let subvariantSelector = $('#edit-data-model-subvariant');

                                // Get Product Data From Response
                                let products = data.data.products;

                                // Get Variant Data From Response
                                let variants = data.data.variants;

                                // Get Variant Data From Response
                                let subvariants = data.data.subvariants;

                                // Create Option Element, then append to productSelector
                                let data_content = "<option value='0'>Pilih Produk</option>";
                                productSelector.append(data_content);

                                // Create Option Element, then append to variantSelector
                                let data_content_variant = "<option value='0'>Pilih Varian</option>";
                                variantSelector.append(data_content_variant);

                                // Create Option Element, then append to subvariantSelector
                                let data_content_subvariant = "<option value='0'>Pilih Subvarian</option>";
                                subvariantSelector.append(data_content_subvariant);

                                // Loop Product Content
                                for(a in products){

                                    if (products.hasOwnProperty(a)){

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

                                // Loop Variants
                                for(b in variants){

                                    if (variants.hasOwnProperty(b)) {

                                        // Check if variant id is matched with the result
                                        if (variants[b].id === result.has_variant.id){

                                            // Create Option element with selected attribute, then append to the select input
                                            let data_content = "<option class='data-option-content' selected value='"+ variants[b].id +"'>"+ variants[b].name +"</option>";
                                            variantSelector.append(data_content);

                                        } else {

                                            // Create Option element with selected attribute, then append to the select input
                                            let data_content = "<option class='data-option-content' value='"+ variants[b].id +"'>"+ variants[b].name +"</option>";
                                            variantSelector.append(data_content);

                                        }

                                    }

                                }

                                // Loop Subvariants
                                for(c in subvariants){

                                    if (subvariants.hasOwnProperty(c)) {

                                        // Check if product id is matched with the result
                                        if (subvariants[c].id === result.has_subvariant.id){

                                            // Create Option element with selected attribute, then append to the select input
                                            let data_content = "<option class='data-option-content' selected value='"+ subvariants[c].id +"'>"+ subvariants[c].name +"</option>";
                                            subvariantSelector.append(data_content);

                                        } else {

                                            // Create Option element with selected attribute, then append to the select input
                                            let data_content = "<option class='data-option-content' value='"+ subvariants[c].id +"'>"+ subvariants[c].name +"</option>";
                                            subvariantSelector.append(data_content);

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

                        UIkit.modal.alert(data.responseJSON.message).then(function () {

                        });
                    }
                });

            } catch (e) {

                UIkit.modal.alert(e.statusText).then(function () {

                });
            }
        }

        // Update Select Option
        function updateProductSelector(raw_data)
        {
            $.ajax({
                type:'GET',
                url: raw_data.data_url + raw_data.data_name,
                success: function(data){
                    return raw_data.success(data);
                },
                error: function(error){
                    return raw_data.error(error);
                }
            })
        }

        $("#edit-model-form").submit(function (e) {
            e.preventDefault();

            let id = $("#edit-model-modal").attr('data-model-id');

            console.log(id);

            let type = 'POST',
                url = "models/update/" + id;

            let formdata = new FormData(this);
            let status = $('#edit-data-model-status').is(':checked') === true ? 1 : 0;

            formdata.append('_token', '{{ csrf_token() }}');
            // formdata.append('id', $('#edit-variant-modal').attr('data-variant-id'));
            formdata.append('name', $('#edit-data-model-name').val());
            formdata.append('price', $('#edit-data-model-price').val());
            formdata.append('product_id', $('#edit-data-model-product').val());
            formdata.append('variant_id', $('#edit-data-model-variant').val());
            formdata.append('subvariant_id', $('#edit-data-model-subvariant').val());
            formdata.append('new_file', $('input[id=update-model-file]')[0].files[0]);
            formdata.append('status', status);

            $.ajax({
                type: type,
                url: url,
                data: formdata,
                cache: false,
                contentType: false,
                processData: false,
                success: function (data) {

                    let image_target = $("#update-model-file");

                    //  Dropify : Set Image to Render
                    let preview_button = image_target.next();
                    let render_target = image_target.next().next();
                    let file_name = render_target.find('.dropify-filename-inner');
                    let render_children = render_target.children('.dropify-render');

                    // First : Remove All Content
                    render_children.empty();
                    file_name.empty();
                    render_target.css('display', 'none');
                    preview_button.css('display', 'none');

                    // Remove Form Element Content to Default
                    cancel_editing();

                    UIkit.modal.alert(data.message).then(function () {

                    });

                    // Re-Draw the table
                    table.draw();
                },
                error: function (error) {

                    // Remove Form Element Content to Default
                    cancel_editing();

                    UIkit.modal.alert(error.responseJSON.message).then(function () {

                    });
                }
            })
        })

        function delete_data(id){
            try {
                // Hide the modal
                UIkit.modal($("#edit-model-modal")).hide();

                UIkit.modal.confirm('Anda yakin ingin hapus item ini ?').then(function () {
                    // Prepare AJAX pre-requirement
                    let ajax = {
                        type: 'DELETE',
                        url: 'models/delete/' + id,
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

                UIkit.modal.alert(e.statusText).then(function () {

                });
            }
        }


        // Cancel Edit Function
        function cancel_editing() {

            let image_target = $("#update-model-file");

            //  Dropify : Set Image to Render
            let preview_button = image_target.next();
            let render_target = image_target.next().next();
            let render_children = render_target.children('.dropify-render');
            let file_name = render_target.find('.dropify-filename-inner');

            // First : Remove All Content
            render_children.empty();
            file_name.empty();
            render_target.css('display', 'none');
            preview_button.css('display', 'none');

            // Empty Product Reference
            $('#edit-data-model-product').empty();

            // Empty Variant Reference
            $('#edit-data-model-variant').empty();

            // Empty Subvariant Reference
            $('#edit-data-model-subvariant').empty();

            // Hide the modal
            UIkit.modal($("#edit-model-modal")).hide();
        }


        // Change Variant Variant if Product id Selected
        function get_variant_data(source_id){

            // Declare Select Element
            let product_reference = $('#edit-data-model-product');
            let new_product_reference = $('#new-data-model-product');
            let variant_reference = $('#edit-data-model-variant');
            let new_variant_reference = $('#new-model-variant-data');
            let subvariant_reference = $('#edit-data-model-subvariant');
            let new_subvariant_reference = $('#new-data-model-subvariant');


            // Empty Product Reference
            product_reference.empty();
            new_product_reference.empty();

            // Empty Variant Reference
            variant_reference.empty();
            new_variant_reference.empty();

            // Empty Subvariant Reference
            subvariant_reference.empty();
            new_subvariant_reference.empty();

            // Get Product Id
            let product_id = source_id;

            // Perform Get Variant By Product
            let param = {
                type: 'GET',
                url: 'models/get-variant/' + product_id,
                success: function(data) {

                    // Get response Data
                    let variants = data.data;

                    // Create output element, then append it to new_variant_reference
                    let data_content = "<option value='0'>Pilih Variant</option>";
                    new_variant_reference.append(data_content);

                    // Loop Variants
                    for(a in variants) {

                        if (variants.hasOwnProperty(a)) {

                            // Create output element, then append it to new_variant_reference
                            let data_content = "<option class='data-option-content' value='"+ variants[a].id +"'>"+ variants[a].name +"</option>";
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


        // Change Subvariant if Variant id Selected
        function get_subvariant_data(source_id) {

            // Declare Select Element
            let product_reference = $('#edit-data-model-product');
            let variant_reference = $('#edit-data-model-variant');
            let subvariant_reference = $('#edit-data-model-subvariant');
            let new_subvariant_reference = $('#new-model-subvariant-data');

            // Empty Product Reference
            product_reference.empty();

            // Empty Variants Reference
            variant_reference.empty();

            // Empty Subvariant Reference
            subvariant_reference.empty();
            new_subvariant_reference.empty();

            // Get Product Id
            let product_id = source_id;

            // Perform Get Variant By Product
            let param = {
                type: 'GET',
                url: 'models/get-subvariant/' + product_id,
                success: function(data){

                    // Get response Data
                    let subvariants = data.data;

                    // Create output element, then append it to new_variant_reference
                    let data_content = "<option value='0'>Pilih Subvariant</option>";
                    new_subvariant_reference.append(data_content);

                    // Loop Subvariants
                    for(a in subvariants) {

                        if (subvariants.hasOwnProperty(a)) {

                            // Create output element with selected attribute, then append it to new_variant_reference
                            let data_content = "<option class='data-option-content' value='"+ subvariants[a].id +"'>"+ subvariants[a].name +"</option>";
                            $('#new-model-subvariant-data').append(data_content);

                        }

                    }

                },
                error: function(error){

                    UIkit.modal.alert(error.responseJSON.message).then(function () {

                    });
                }
            };

            // Perform AJAX
            $.ajax(param);

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

        });
    </script>
@endpush