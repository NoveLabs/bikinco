@extends('layouts.app')

@push('css-dropify')
    <link rel="stylesheet" href="{{ asset('assets/js/vendor/dropify/dropify.min.css') }}">
@endpush

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
                        <h5>Pada halaman ini terdapat data master Sizepack dari berbagai vendor</h5>
                        <p>Anda dapat menambah, mengedit dan menghapus data sizepack sesuai kebutuhan Anda.</p>
                    </div>
                </div>
            </div>
            <div class="uk-card uk-margin">
                <div class="uk-flex-middle sc-padding sc-padding-medium-ends uk-grid-small" data-uk-grid>
                    <div class="uk-flex-1">
                        <h3 class="uk-card-title">Data Master Sizepack</h3>
                    </div>
                    <div class="uk-width-auto@s">
                        <button class="sc-button sc-button-primary sc-button-flex" type="button">Pengaturan Kolom <i class="mdi mdi-chevron-down uk-margin-small-left"></i></button>
                        <div class="uk-dropdown uk-width-small" data-uk-drop="mode: click">
                            <div class="sc-padding-small">
                                <div class="uk-margin-small">
                                    <input type="checkbox" class="data-sizepack-column-toggle" data-content="0"
                                           value="0" checked disabled>
                                    <label for="sc-dt-col-0">No</label>
                                </div>
                                <div class="uk-margin-small">
                                    <input type="checkbox" class="data-sizepack-column-toggle" data-content="1"
                                           value="1" checked>
                                    <label for="sc-dt-col-1">Nama Kategori</label>
                                </div>
                                <div class="uk-margin-small">
                                    <input type="checkbox" class="data-sizepack-column-toggle" data-content="2"
                                           value="2" checked>
                                    <label for="sc-dt-col-2">Status</label>
                                </div>
                                <div class="uk-margin-small">
                                    <input type="checkbox" class="data-sizepack-column-toggle" data-content="3"
                                           value="3" checked>
                                    <label for="sc-dt-col-3">Tanggal Input</label>
                                </div>
                                <div class="uk-margin-small">
                                    <input type="checkbox" class="data-sizepack-column-toggle" data-content="4"
                                           value="4" checked>
                                    <label for="sc-dt-col-4">Aksi</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr class="uk-margin-remove">
                <div class="uk-card-body">
                    <table id="data-sizepack-table" class="uk-table uk-table-striped dt-responsive">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Vendor</th>
                            <th>Kode Sizepack</th>
                            <th class="uk-text-nowrap">Tanggal Input</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>

        </div>

    </div>

    <!-- modal detail kategori -->
    <div id="edit-sizepack-modal" data-uk-modal>
        <div class="uk-modal-dialog">
            <button class="uk-modal-close-default" type="button" data-uk-close></button>
            <div class="uk-modal-header">
                <h2 class="uk-modal-title">Detail Sizepack</h2>
            </div>
            <form action="" method="" id="edit-sizepack-form">
                <div class="uk-modal-body">
                    <div class="uk-margin">
                        <label>Nama Vendor<sup>*</sup></label>
                        <select name="data-sizepack-vendor-name" class="uk-select"
                                data-sc-select2='{"placeholder": "Pilih Vendor", "allowClear": true }'>
                            @foreach ($dataVendor as $value)
                                <option value="{{ $value->id }}"> {{ $value->vendor_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="uk-margin">
                        <label>Kode Sizepack<sup>*</sup></label>
                        <input type="text" name="data-sizepack-size-code" required class="uk-input" data-sc-input>
                    </div>
                    <div>
                        <label>Status Sizepack<sup>*</sup></label> <br>
                        <input type="checkbox" name="data-sizepack-status" data-sc-switchery/><label
                            class="uk-margin-small-left">Aktif / Non Aktif</label>
                    </div>
                    <br>
                    <div class="sc-list-body">
                        <label style="margin-bottom: 10px;" for="input-file-max-fs">Unggah gambar dengan resolusi
                            600x600 piksel (jika ada)</label>
                        <input type="file" name="data-sizepack-file" id="input-file-max-fs" class="dropify"
                               data-max-file-size="2M"/>
                    </div>
                </div>
                <div class="uk-modal-footer uk-text-right">
                    <a id="delete-item-button" style="margin-right: 66%;" class="uk-text-left sc-button sc-button-danger sc-js-button-wave-light" href="#">Hapus</a>
                    <button class="sc-button sc-button-flat sc-button-flat-danger uk-modal-close" type="button">Batal</button>
                    <button class="sc-button" type="submit">Simpan</button>
                </div>
            </form>
            {{--            <form action="" method="" id="edit-sizepack-form">--}}
            {{--                <div class="uk-modal-body">--}}
            {{--                    <div class="uk-grid" data-uk-grid="">--}}
            {{--                        <div class="uk-width-1-2@l">--}}
            {{--                            <div class="custom-detail-list-box">--}}
            {{--                                <ul class="uk-list">--}}
            {{--                                    <li class="sc-sidebar-menu-heading custom-list-divider"><span>Detail</span></li>--}}
            {{--                                </ul>--}}
            {{--                                <ul class="uk-list custom-inline-list">--}}
            {{--                                    <div class="uk-margin">--}}
            {{--                                        <label>Nama Vendor<sup>*</sup></label>--}}
            {{--                                        <input type="text" name="edit-sizepack-vendor-name" required class="uk-input" data-sc-input>--}}
            {{--                                    </div>--}}
            {{--                                    <div class="uk-margin">--}}
            {{--                                        <label>Kode Sizepack<sup>*</sup></label>--}}
            {{--                                        <input type="text" name="edit-sizepack-size-code" required class="uk-input" data-sc-input>--}}
            {{--                                    </div>--}}
            {{--                                    <div>--}}
            {{--                                        <label>Status Sizepack<sup>*</sup></label> <br>--}}
            {{--                                        <input type="checkbox" id="edit-sizepack-status" name="edit-sizepack-status" data-sc-switchery checked /><label class="uk-margin-small-left">Aktif / Non Aktif</label>--}}
            {{--                                    </div>--}}
            {{--                                </ul>--}}
            {{--                            </div>--}}
            {{--                        </div>--}}
            {{--                        <div class="uk-width-1-2@l">--}}
            {{--                            <div class="custom-detail-list-box">--}}
            {{--                                <ul class="uk-list">--}}
            {{--                                    <li class="sc-sidebar-menu-heading custom-list-divider"><span>Gambar Sizepack</span></li>--}}
            {{--                                </ul>--}}
            {{--                                <ul class="uk-list custom-inline-list">--}}
            {{--                                    <li class="sc-list-group">--}}
            {{--                                        <div class="sc-list-body">--}}
            {{--                                            <label style="margin-bottom: 10px;" for="input-file-max-fs">Unggah gambar baru untuk memperbarui</label>--}}
            {{--                                            <input type="file" name="edit-sizepack-image" id="input-file-max-fs" class="dropify edit-sizepack-image" data-max-file-size="2M" />--}}
            {{--                                        </div>--}}
            {{--                                    </li>--}}
            {{--                                </ul>--}}
            {{--                            </div>--}}
            {{--                        </div>--}}
            {{--                    </div>--}}
            {{--                    <br>--}}
            {{--                </div>--}}

            {{--                <div class="uk-modal-footer uk-text-right">--}}
            {{--                    <a id="delete-item-button" style="margin-right: 66%;" class="uk-text-left sc-button sc-button-danger sc-js-button-wave-light" href="#">Hapus</a>--}}
            {{--                    <button class="sc-button sc-button-flat sc-button-flat-danger uk-modal-close" type="button">Batal</button>--}}
            {{--                    <button class="sc-button" type="submit">Simpan</button>--}}
            {{--                </div>--}}
            {{--            </form>--}}
        </div>
    </div>
    <!-- end modal detail kategori -->

    <!-- start modal input kategori -->
    <div id="add-sizepack-modal" data-uk-modal>
        <div class="uk-modal-dialog">
            <button class="uk-modal-close-default" type="button" data-uk-close></button>
            <div class="uk-modal-header">
                <h2 class="uk-modal-title">Input Master Sizepack</h2>
            </div>
            <form action="" method="" id="add-sizepack-form">
                <div class="uk-modal-body">
                    <div class="uk-margin">
                        <label>Nama Vendor<sup>*</sup></label>
                        <select name="new-sizepack-vendor-name" id="new-sizepack-vendor-name" class="uk-select">
                            @foreach ($dataVendor as $value)
                            <option value="{{ $value->id }}"> {{ $value->vendor_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="uk-margin">
                        <label>Kode Sizepack<sup>*</sup></label>
                        <input type="text" name="new-sizepack-size-code" required class="uk-input"data-sc-input>
                    </div>
                    <div>
                        <label>Status Sizepack<sup>*</sup></label> <br>
                        <input type="checkbox" name="new-sizepack-status" data-sc-switchery /><label class="uk-margin-small-left">Aktif / Non Aktif</label>
                    </div>
                    <br>
                    <div class="sc-list-body">
                        <label style="margin-bottom: 10px;" for="input-file-max-fs">Unggah gambar dengan resolusi 600x600 piksel (jika ada)</label>
                        <input type="file" name="new-sizepack-file" id="input-file-max-fs" class="dropify" data-max-file-size="2M" />
                    </div>
                </div>
                <div class="uk-modal-footer uk-text-right">
                    <button class="sc-button sc-button-flat sc-button-flat-danger uk-modal-close" type="button">Batal</button>
                    <button class="sc-button" type="submit">Tambah</button>
                </div>
            </form>
        </div>
    </div>
    <!-- end modal input kategori -->

    <!-- start modal detail sizepack -->
    <div id="view-sizepack-modal" class="uk-flex-top" data-uk-modal>
        <div class="uk-modal-dialog uk-width-auto uk-margin-auto-vertical">
            <button class="uk-modal-close-outside" type="button" data-uk-close></button>
            <img id="data-sizepack-image" src="https://cf.shopee.co.id/file/e8ef27565d6321b5dc89b25576639478" alt="">
        </div>
    </div>
    <!-- end modal detail sizepack -->

    <div class="sc-fab-card-wrapper uk-position-bottom-right">
        <a href="#add-sizepack-modal" data-uk-toggle class="sc-fab sc-fab-text sc-fab-success"><i class="mdi mdi-plus"></i>Tambah</a>
    </div>
@endsection

@push('scripts')
    <script>
        // Datatables Init
        let table = $('#data-sizepack-table').DataTable({
            processing: true,
            serverSide: true,
            retrieve: true,
            ajax: "{{ route('sizepacks') }}",
            columns: [
                {data: 'id', name: 'id', title: 'No'},
                {data: 'vendor_name', name: 'vendor_name', title: 'Nama Vendor'},
                {data: 'size_code', name: 'size_code', title: 'Kode Sizepack'},
                {data: 'created_at', name: 'created_at', title: 'Tanggal Input'},
                {data: 'status', name: 'status', title: 'Status'},
                {data: 'action', name: 'action', title: 'Tindakan', orderable: false, searchable: false},
            ],
        });

        // Set data-variant-table-toggle class on onClick event
        $('.data-sizepack-column-toggle').on('click', function(){

            // Define DataTable Source
            let column = table.column( $(this).attr('data-content') );

            console.log(column);
            // Hide / Show the Column
            column.visible( ! column.visible() );

            // Re-draw the table
            table.draw();

        });

        // Add Sizepack Item
        $('#add-sizepack-form').submit(function(e) {
            // Prevent Default
            e.preventDefault();

            // Modal
            let add_modal = $("#add-sizepack-modal");

            // Get All input forms
            let vendor_name = $("[name='new-sizepack-vendor-name']").val(),
                size_code = $("[name='new-sizepack-size-code']").val(),
                status = $("[name='new-sizepack-status']").is(':checked') === true ? 1 : 0,
                file = $("[name='new-sizepack-file']")[0].files[0],
                token = "{{ csrf_token() }}";

            // FormData
            let formData = new FormData(this);

            formData.append('_token', token);
            formData.append('vendor_name', vendor_name);
            formData.append('size_code', size_code);
            formData.append('status', status);
            formData.append('file', file);

            // Perform AJAX
            $.ajax({
                type: 'POST',
                url: "{{ route('sizepacks') }}",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function(data) {

                    // Hide add-variant-modal Modal
                    UIkit.modal(add_modal).hide();

                    // SweetAlert : Show Success Message
                    Swal.fire({
                        icon: 'success',
                        title: 'OK',
                        text: data.message,
                    });

                    // Re-draw the table
                    table.draw();

                }
            })

        });

        // Get Content Image
        function getContentImage(id) {

            // Declare Image Modal
            let image_modal = $("#view-sizepack-modal");


            // Declare AJAX Prerequirements
            let ajax = {
                type: 'GET',
                url: 'sizepacks/image/' + id,
                success: function (data) {

                    // Get Image ID
                    let image_target = $("#data-sizepack-image");

                    // First Remove The Image
                    image_target.attr('src', '');

                    // Set Image Source from Response
                    image_target.attr('src',  data.data);

                    // Show The Modal
                    UIkit.modal(image_modal).show();

                },
                error: function (data) {

                    // Get Image ID
                    let image_target = $("#data-sizepack-image");

                    // First Remove The Image
                    image_target.attr('src', '');

                    // Show The Modal
                    UIkit.modal(image_modal).show();

                }
            };

            // Perform AJAX
            ajaxGet(ajax);

        }

        // Get Size Pack Content Detail
        function getContentData(id) {

            // Declare Image Modal
            let detail_modal = $("#edit-sizepack-modal");


            // Declare AJAX Prerequirements
            let ajax = {
                type: 'GET',
                url: 'sizepacks/' + id,
                success: function (data) {

                    // Declare result data
                    let result = data.data[0];

                    // Declare Form Input
                    let vendor_name = $("[name='data-sizepack-vendor-name']");
                    let size_code = $("[name='data-sizepack-size-code']");
                    let status = $("[name='data-sizepack-status']");
                    let image = $("[name='data-sizepack-file']");
                    let delete_button = $("#delete-item-button");

                    // Set delete button
                    delete_button.attr('href', "javascript:deleteData("+ id +")");

                    // Fill data and set it focus attribute
                    vendor_name.parent().addClass('sc-input-focus');
                    size_code.parent().addClass('sc-input-focus');

                    vendor_name.val(result.vendor_id).change();
                    size_code.val(result.size_code);

                    // Set Status
                    if (result.status === 1 && status.is(':checked') === false) {

                        // Click event on Switchery Checkbox
                        status.click();

                    } else if (result.status === 0 && status.is(':checked') === true) {

                        // Click event on Switchery Checkbox
                        status.click();
                    }

                    //  Dropify : Set Image to Render
                    let preview_button = image.next();
                    let render_target = image.next().next();
                    let file_name = render_target.find('.dropify-filename-inner');
                    let render_children = render_target.children('.dropify-render');

                    // Check If File PAth are null or empty
                    if (result.file !== null) {
                        // First : Remove All Content
                        render_children.empty();
                        render_target.css('display', 'none');
                        preview_button.css('display', 'none');

                        // Dropify : Set Image
                        image.attr("data-default-file", "{{ url('/') }}/" + result.file);
                        let image_source = "<img src='" + image.attr('data-default-file') + "'>";

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

                    detail_modal.attr('data-sizepack-id', id);

                    // Show The Modal
                    UIkit.modal(detail_modal).show();

                },
                error: function (data) {

                    // Get Image ID
                    let image_target = $("#data-sizepack-image");

                    // First Remove The Image
                    image_target.attr('src', '');

                    // Show The Modal
                    UIkit.modal(image_modal).show();

                }
            };

            // Perform AJAX
            ajaxGet(ajax);

        }

        // Update Sizepack Content
        $("#edit-sizepack-form").submit(function (event) {
            event.preventDefault();

            // Modal
            let edit_modal = $("#edit-sizepack-modal");

            // Get All input forms
            let vendor_name = $("[name='data-sizepack-vendor-name']").val(),
                size_code = $("[name='data-sizepack-size-code']").val(),
                status = $("[name='data-sizepack-status']").is(':checked') === true ? 1 : 0,
                file = $("[name='data-sizepack-file']").val() === '' ? null : $("[name='data-sizepack-file']")[0].files[0],
                token = "{{ csrf_token() }}",
                id = edit_modal.attr('data-sizepack-id');

            // FormData
            let formData = new FormData(this);

            formData.append('_token', token);
            formData.append('vendor_name', vendor_name);
            formData.append('size_code', size_code);
            formData.append('status', status);
            formData.append('file', file);

            // Perform AJAX
            $.ajax({
                type: 'POST',
                url: "sizepacks/update/" + id,
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function(data) {

                    // Hide add-variant-modal Modal
                    UIkit.modal(edit_modal).hide();

                    // SweetAlert : Show Success Message
                    Swal.fire({
                        icon: 'success',
                        title: 'OK',
                        text: data.message,
                    });

                    // Re-draw the table
                    table.draw();

                }
            })

        })

        // Delete Function
        function deleteData(id) {

            // Declare modal
            let edit_modal = $("#edit-sizepack-modal");

            // SweetAlert : Confirm
            // Hide the modal
            UIkit.modal(edit_modal).hide();

            // SweetAlert : Show Success Modal
            Swal.fire({
                title: 'Hapus Item Ini?',
                text: "Apakah anda yakin?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus item ini!'
            }).then((result) => {
                if (result.isConfirmed) {

                    // Declare AJAX Pre Requirement
                    let ajax = {
                        type: 'DELETE',
                        url: 'sizepacks/delete/' + id,
                        data: {_token: "{{ csrf_token() }}"},
                        success: function (data) {

                            // Hide the modal
                            UIkit.modal(edit_modal).hide();

                            // SweetAlert : Show Success Message
                            Swal.fire({
                                icon: 'success',
                                title: 'OK',
                                text: data.message,
                            });

                            // Re-draw the table
                            table.draw();

                        },
                        error: function (data) {

                            // Hide the modal
                            UIkit.modal(edit_modal).hide();

                            // SweetAlert : Show Success Message
                            Swal.fire({
                                icon: 'error',
                                title: 'OK',
                                text: data.message,
                            });

                        }
                    };

                    // Perform Ajax
                    ajaxDelete(ajax);
                }
            })



        }

    </script>
    <script>

        function ajaxGet(data){
            // Perfomrm AJAX
            return $.ajax({
                type: data.type,
                url: data.url,
                success: function (response) {
                    return data.success(response);
                },
                error: function (response) {
                    return data.error(response)
                }
            });
        }

        function ajaxDelete(data) {
            // Perfomrm AJAX
            return $.ajax({
                type: data.type,
                url: data.url,
                data: data.data,
                success: function (response) {
                    return data.success(response);
                },
                error: function (response) {
                    return data.error(response)
                }
            });
        }

    </script>
@endpush

@push('dropify')
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script> -->
    <script src="{{ asset('assets/js/vendor/dropify/dropify.min.js') }}"></script>
    <script>

        $(document).ready(function(){

            // Basic
            $('.dropify').dropify();
            // $('.dropify').dropify();

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
