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
                    <h5>Pada halaman ini terdapat data Company produk dari Bikin-co</h5>
                    <p>Anda dapat menambah, mengedit dan menghapus data kategori sesuai kebutuhan Anda.</p>
                </div>
            </div>
        </div>

        <div class="uk-card uk-margin">
            <div class="uk-flex-middle sc-padding sc-padding-medium-ends uk-grid-small" data-uk-grid>
                <div class="uk-flex-1">
                    <h3 class="uk-card-title">Data Company</h3>
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
                                <input type="checkbox" name="check_1" class="hide-column" data-column="1" value="1"  checked>
                                <label for="sc-dt-col-1">Company Name</label>
                            </div>
                            <div class="uk-margin-small">
                                <input type="checkbox" name="check_2" class="hide-column" data-column="2" value="2"  checked>
                                <label for="sc-dt-col-2">Company Logo</label>
                            </div>
                            <div class="uk-margin-small">
                                <input type="checkbox" name="check_3" class="hide-column" data-column="3" value="3"  checked>
                                <label for="sc-dt-col-3">Aksi</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr class="uk-margin-remove">
            <div class="uk-card-body">
                <table id="company-table" class="company-table uk-table uk-table-striped dt-responsive">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Company Name</th>
                            <th>Company Logo</th>
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
    <a href="#company-add-modal" onclick="$('#upload_form').trigger('reset');" data-uk-toggle class="sc-fab sc-fab-text sc-fab-success"><i class="mdi mdi-plus"></i>Tambah</a>
</div>

<div id="company-add-modal" data-uk-modal>
    <div class="uk-modal-dialog">
        <form enctype="multipart/form-data" id="upload_form" role="form" method="POST" action="">
        <button class="uk-modal-close-default" type="button" data-uk-close></button>
        <div class="uk-modal-header">
            <h2 class="uk-modal-title">Input Data Company</h2>
        </div>
        <div class="uk-modal-body">
            <div class="uk-margin">
                <label>Company Name<sup>*</sup></label>
                <input type="text" name="company_name" required class="uk-input" data-sc-input>
            </div>
            <br>
            <div class="sc-list-body">
                <div class="dropzone"></div>
                <label style="margin-bottom: 10px;" for="input-file-max-fs">Unggah gambar (jika ada)</label>
                <input type="file" id="company_logo" name="company_logo" class="dropify data-photo"
                       data-max-file-size="2M"/>
            </div>
        </div>
        <div class="uk-modal-footer uk-text-right">
            <button class="sc-button sc-button-flat sc-button-flat-danger uk-modal-close" type="button">Batal</button>
            <button class="sc-button add-company" type="submit">Tambah</button>
        </div>
        </form>
    </div>
</div>
<!-- Add Modal - End Section -->

<!-- Edit Modal -->
<div id="detail-company-modal" data-uk-modal>
    <div class="uk-modal-dialog">
         <form enctype="multipart/form-data" id="edit_upload_form" role="form" method="POST" action="">
        <button class="uk-modal-close-default" type="button" data-uk-close></button>
        <div class="uk-modal-header">
            <h2 class="uk-modal-title">Input Data Company</h2>
        </div>
        <div class="uk-modal-body">
            <div class="uk-margin">
                <label>Company Name<sup>*</sup></label>
                <input type="text" name="detail_company_name" id="detail_company_name" required class="uk-input" data-sc-input>
            </div>
            <br>
            <div class="sc-list-body">
                <div class="dropzone"></div>
                <label style="margin-bottom: 10px;" for="input-file-max-fs">Unggah gambar (jika ada)</label>
                <input type="file" id="edit-company-logo" name="edit-company-logo" class="dropify data-photo"
                       data-max-file-size="2M"/>
            </div>
        </div>
        <input type="hidden" id="edit-company-id" name="edit-company-id" value="">

        <div class="uk-modal-footer uk-text-right">
            <form action="" style="width: 100px;">
                <a id="sc-js-modal-confirm" style="margin-right: 66%;" class="delete-company uk-text-left sc-button sc-button-danger sc-js-button-wave-light" href="#">Hapus</a>
            </form>
            <button class="sc-button sc-button-flat sc-button-flat-danger uk-modal-close" type="button">Batal</button>
            <button class="sc-button edit-company" type="submit">Simpan</button>
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
        UIkit.modal($("#detail-company-modal")).show();

        $.ajax({
            type: "GET",
            url: '{!! route('company.detail', [':id']) !!}'.replace(':id',id),
            success: function (data) {


                //Set up data for edit modal
                $("input[name=edit-company-id]").val(data.data.id);
                $("#detail_company_name").val(data.data.company_name);

                if (data.data.status <= 0) {
                    $('.switchery').click();
                }


                // Dropify
                let image_target = $("#edit-company-logo");

                //  Dropify : Set Image to Render
                let preview_button = image_target.next();
                let render_target = image_target.next().next();
                let images = render_target.find('.dropify-filename-inner');
                let render_children = render_target.children('.dropify-render');

                // Check If File PAth are null or empty
                if (data.data.company_logo !== null) {
                    // First : Remove All Content
                    render_children.empty();
                    render_target.css('display', 'none');
                    preview_button.css('display', 'none');

                    // Dropify : Set Image
                    image_target.attr("data-default-file", data.data.company_logo);
                    let image_source = "<img src='" + image_target.attr('data-default-file') + "'>";

                    // Set image_source to render_target
                    render_children.append(image_source);
                    render_target.css('display', 'block');
                    preview_button.css('display', 'block');

                    // set Filename
                    images.text(data.data.company_logo);
                    // console.log('is available');
                } else {
                    // Set image_source to render_target
                    render_children.empty();
                    render_target.css('display', 'none');
                    preview_button.css('display', 'none');
                    // console.log('is not available');
                }

                //Set up credentials for edit and delete action...
                $(".delete-company").attr('data-id', id);
            },
            error: function (err) {

            }
        });
    }


	$(document).ready(function () {
		$('#pdev').addClass("sc-page-active");

        // $(".detail-company").click(function(e) {
        //     var id = $(this).data('id');
        // });

        // Initialize DataTable
        var table = $('#company-table').DataTable({
            processing: true,
            serverSide: true,
            retrieve: true,
            pageLength: 10,
            ajax: "{{ route('company.index') }}",
            columns: [
                {data: 'id', name: 'id', title: 'ID Company'},
                {data: 'company_name', name: 'company_name', title: 'Company Name'},
                {data: 'company_logo', name: 'company_logo', title: 'Company Logo'},
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
               $('.delete-company').on('click', function (e) {
            UIkit.modal.confirm('Apakah anda yakin akan menghapus data ini ?').then(function () {
                e.preventDefault();

                var params = {
                    _token: '{{ csrf_token() }}',
                    id: $(".delete-company").attr('data-id'),
                }

                $.ajax({
                    type: "DELETE",
                    url: "{{ route('company.delete') }}",
                    data: params,
                    async: false,
                    success: function (data) {
                        UIkit.modal.alert(data.message).then(function () {

                        });

                        table.draw();
                        UIkit.modal($("#detail-company-modal")).hide();
                    },
                    error: function (data) {
                        UIkit.modal.alert(data.responseJSON.message).then(function () {

                        });
                    }
                });
            }, function () {
                console.log('.')
            })
        });

        $('#edit_upload_form').submit(function(event) {
            event.preventDefault();

            var id = $("input[name=edit-company-id]").val();

            var formDataE = new FormData(this);
            formDataE.append('_token', "{{ csrf_token() }}");
            formDataE.append('company_name', $("#detail_company_name").val());
            formDataE.append('company_logo', $("#edit-company-logo")[0].files[0]);
            // $("[name='edit-detail-categories-file']")[0].files[0]

            $.ajax({
                type: 'POST',
                url: '{!! route('company.update', [':id']) !!}'.replace(':id',id),
                data: formDataE,
                cache: false,
                contentType: false,
                processData: false,
                success: (data) => {
                    UIkit.modal.alert(data.message).then(function () {

                    });

                    table.draw();
                    UIkit.modal($("#detail-company-modal")).hide();
                },
                error: function (data) {
                    UIkit.modal.alert(data.responseJSON.message).then(function () {

                    })
                }
            });
        });

        //Add action
        $('#upload_form').submit(function(event){
            event.preventDefault();


            var formData = new FormData(this);
            formData.append('_token', '{{ csrf_token() }}');
            formData.append('company_name', $("input[name=company_name]").val());
            formData.append('company_logo', $("[name='company_logo']").val());

            // console.log($("[name='new-company-file']")[0].files[0]);

            $.ajax({
                type: 'POST',
                url: "{{ route('company.add') }}",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: (data) => {
                    UIkit.modal.alert(data.message).then(function () {

                    });

                    table.draw();
                    UIkit.modal($("#company-add-modal")).hide();
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
        let drEvent = $('#company_logo').dropify();

        drEvent.on('dropify.beforeClear', function(event, element){
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


        // Edit Event
        let editEvent = $('#edit-company-file').dropify();

        editEvent.on('dropify.beforeClear', function (event, element) {

            if (element.file.name === null) {
                return confirm('Yakin ingin hapus file ini : ' + element.filenameWrapper[0].children[1].innerHTML + '?');
            } else {
                return confirm("Do you really want to delete \"" + element.file.name + "\" ?");
            }
        });

        editEvent.on('dropify.afterClear', function (event, element) {
            alert('File deleted');
        });

        editEvent.on('dropify.errors', function (event, element) {
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
