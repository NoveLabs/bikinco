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
                    <h5>Pada halaman ini terdapat data master Kategori produk dari Bikin-co</h5>
                    <p>Anda dapat menambah, mengedit dan menghapus data kategori sesuai kebutuhan Anda.</p>
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
                                <input type="checkbox" name="check_1" class="hide-column" data-column="1" value="1"  checked>
                                <label for="sc-dt-col-1">Nama Kategori</label>
                            </div>
                            <div class="uk-margin-small">
                                <input type="checkbox" name="check_2" class="hide-column" data-column="2" value="2"  checked>
                                <label for="sc-dt-col-2">Status</label>
                            </div>
                            <div class="uk-margin-small">
                                <input type="checkbox" name="check_3" class="hide-column" data-column="3" value="3"  checked>
                                <label for="sc-dt-col-3">Tanggal Input</label>
                            </div>
                            <div class="uk-margin-small">
                                <input type="checkbox" name="check_4" class="hide-column" data-column="4" value="4"  checked>
                                <label for="sc-dt-col-4">Aksi</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr class="uk-margin-remove">
            <div class="uk-card-body">
                <table id="categories-table" class="categories-table uk-table uk-table-striped dt-responsive">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Kategori</th>
                            <th>Status</th>
                            <th class="uk-text-nowrap">Tanggal Input</th>
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
    <a href="#category-add-modal" onclick="$('#uplaod_form').trigger('reset');" data-uk-toggle class="sc-fab sc-fab-text sc-fab-success"><i class="mdi mdi-plus"></i>Tambah</a>
</div>

<div id="category-add-modal" data-uk-modal>
    <div class="uk-modal-dialog">
        <form enctype="multipart/form-data" id="upload_form" role="form" method="POST" action="">
        <button class="uk-modal-close-default" type="button" data-uk-close></button>
        <div class="uk-modal-header">
            <h2 class="uk-modal-title">Input Data Kategori</h2>
        </div>
        <div class="uk-modal-body">
            <div class="uk-margin">
                <label>Nama Kategori<sup>*</sup></label>
                <input type="text" name="categories-name" required class="uk-input" data-sc-input>
            </div>
            <div>
                <label>Status Kategori</label><sup>*</sup><br>
                <input type="checkbox" name="categories-status" value="1" data-sc-switchery checked /><label class="uk-margin-small-left">Aktif / Non Aktif</label>
            </div>
            <br>
            <div class="sc-list-body">
                <div class="dropzone"></div>
                <label style="margin-bottom: 10px;" for="input-file-max-fs">Unggah gambar dengan resolusi 600x600 piksel (jika ada)</label>
                <input type="file" id="new-categories-file" name="new-categories-file" class="dropify data-photo"
                       data-max-file-size="2M"/>
            </div>
            <div class="sc-list-body">
                <div class="dropzone"></div>
                <label style="margin-bottom: 10px;" for="input-file-max-fs">Unggah Icon dengan format PNG </label>
                <input type="file" id="new-categories-icon" name="new-categories-icon" class="dropify data-photo"
                       data-max-file-size="2M"/>
            </div>
        </div>
        <div class="uk-modal-footer uk-text-right">
            <button class="sc-button sc-button-flat sc-button-flat-danger uk-modal-close" type="button">Batal</button>
            <button class="sc-button add-categories" type="submit">Tambah</button>
        </div>
        </form>
    </div>
</div>
<!-- Add Modal - End Section -->

<!-- Edit Modal -->
<div id="detail-category-modal" data-uk-modal>
    <div class="uk-modal-dialog">
        <button class="uk-modal-close-default" type="button" data-uk-close></button>
        <div class="uk-modal-header">
            <h2 class="uk-modal-title">Detail Kategori</h2>
        </div>
        <form  enctype="multipart/form-data" id="edit_upload_form" role="form" method="POST" action="" >
            <div class="uk-modal-body uk-padding-remove-vertical">
            <!-- TODO-008 - Detail Customer Here -->
            <div class="uk-grid" data-uk-grid="">
                <input type="hidden" name="edit-categories-id" >
                <div class="uk-width-1-2@l">
                    <div class="custom-detail-list-box">
                        <ul class="uk-list">
                            <li class="sc-sidebar-menu-heading custom-list-divider"><b><span>Detail</span></b></li>
                        </ul>
                        <hr class="uk-margin-remove-top">
                        <ul class="uk-list custom-inline-list">
                            <div class="uk-margin">
                                <label>Nama Kategori<sup>*</sup></label>
                                <input type="text" required class="detail-categories-name uk-input" value="Fashion" data-sc-input>
                            </div>
                            <div>
                                <label>Status Kategori<sup>*</sup></label> <br>
                                <input type="checkbox" class="detail-categories-status" value="1" data-sc-switchery checked /><label class="uk-margin-small-left">Aktif / Non Aktif</label>
                            </div>
                        </ul>
                    </div>
                </div>
                <div class="uk-width-1-2@l">
                    <div class="custom-detail-list-box">
                        <ul class="uk-list">
                            <li class="sc-sidebar-menu-heading custom-list-divider"><b><span>Gambar</span></b></li>
                        </ul>
                        <hr class="uk-margin-remove-top">
                        <ul class="uk-list custom-inline-list">
                            <li class="sc-list-group">
                                <div class="sc-list-body">
                                    <label style="margin-bottom: 10px;" for="input-file-max-fs">Unggah gambar baru untuk memperbarui</label>
                                    <input type="file" id="edit-categories-file" name="edit-detail-categories-file"
                                           class="dropify" data-max-file-size="2M"/>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="uk-width-1-2@l">
                    <div class="custom-detail-list-box">
                        <ul class="uk-list">
                            <li class="sc-sidebar-menu-heading custom-list-divider"><b><span>Icon</span></b></li>
                        </ul>
                        <hr class="uk-margin-remove-top">
                        <ul class="uk-list custom-inline-list">
                            <li class="sc-list-group">
                                <div class="sc-list-body">
                                    <label style="margin-bottom: 10px;" for="input-file-max-fs">Unggah Icon baru untuk memperbarui</label>
                                    <input type="file" id="edit-categories-icon" name="edit-detail-categories-icon"
                                           class="dropify dropify_icon" data-max-file-size="2M"/>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <br>
        </div>

        <div class="uk-modal-footer uk-text-right">
            <form action="" style="width: 100px;">
                <a id="sc-js-modal-confirm" style="margin-right: 66%;" class="delete-categories uk-text-left sc-button sc-button-danger sc-js-button-wave-light" href="#">Hapus</a>
            </form>
            <button class="sc-button sc-button-flat sc-button-flat-danger uk-modal-close" type="button">Batal</button>
            <button class="sc-button edit-categories" type="submit">Simpan</button>
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
        UIkit.modal($("#detail-category-modal")).show();

        $.ajax({
            type: "GET",
            url: 'categories/' + id,
            success: function (data) {
                var status = data.data.status == 1 ? 'Aktif' : 'Tidak aktif';

                //Set up data for edit modal
                $("input[name=edit-categories-id]").val(data.data.id);
                $(".detail-categories-name").val(data.data.name);

                if (data.data.status <= 0) {
                    $('.switchery').click();
                }


                let image_target = $("#edit-categories-file");
                let image_target2 = $(".dropify_icon");

                let preview_button = image_target.next();
                let render_target = image_target.next().next();
                let file_name = render_target.find('.dropify-filename-inner');
                let render_children = render_target.children('.dropify-render');

                let preview_button_icon = image_target2.next();
                let render_target_icon = image_target2.next().next();
                let icon_name = render_target_icon.find('.dropify-filename-inner');
                let render_children_icon = render_target_icon.children('.dropify-render');

                if (data.data.file_name !== null) {
                    render_children.empty();
                    render_target.css('display', 'none');
                    preview_button.css('display', 'none');

                    image_target.attr("data-default-file", data.data.file_name);
                    let image_source = "<img src='" + image_target.attr('data-default-file') + "'>";

                    render_children.append(image_source);
                    render_target.css('display', 'block');
                    preview_button.css('display', 'block');

                    file_name.text(data.data.filename);
                } else {
                    render_children.empty();
                    render_target.css('display', 'none');
                    preview_button.css('display', 'none');
                }

                if (data.data.category_icon !== null) {
                    render_children_icon.empty();
                    render_target_icon.css('display', 'none');
                    preview_button_icon.css('display', 'none');

                    image_target2.attr("data-default-file", data.data.category_icon);
                    let icon_source = "<img src='" + image_target2.attr('data-default-file') + "'>";

                    render_children_icon.append(icon_source);
                    render_target_icon.css('display', 'block');
                    preview_button_icon.css('display', 'block');

                    file_name.text(data.data.category_icon);
                } else {
                    render_children_icon.empty();
                    render_target_icon.css('display', 'none');
                    preview_button_icon.css('display', 'none');
                }


                //Set up credentials for edit and delete action...
                $(".delete-categories").attr('data-id', id);
            },
            error: function (err) {

            }
        });
    }

	$(document).ready(function () {
		$('#pdev').addClass("sc-page-active");


        // Initialize DataTable
        var table = $('#categories-table').DataTable({
            processing: true,
            serverSide: true,
            retrieve: true,
            pageLength: 10,
            ajax: "{{ route('categories') }}",
            columns: [
                {data: 'id', name: 'id', title: 'ID Kategori'},
                {data: 'name', name: 'name', title: 'Nama Kategori'},
                {data: 'status', name: 'status', title: 'Status'},
                {data: 'created_at', name: 'created_at', title: 'Tanggal Input'},
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
        $('.delete-categories').on('click', function (e) {
			UIkit.modal.confirm('Apakah anda yakin akan menghapus data ini ?').then(function () {
                e.preventDefault();

                var params = {
                    _token: '{{ csrf_token() }}',
                    id: $(".delete-categories").attr('data-id'),
                }
                console.log(params);

                $.ajax({
                    type: "DELETE",
                    url: "{{ route('categories.delete') }}",
                    data: params,
                    async: false,
                    success: function (data) {
                        UIkit.modal.alert(data.message).then(function () {

                        });

                        table.draw();
                        UIkit.modal($("#detail-category-modal")).hide();
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

            var id = $("input[name=edit-categories-id]").val();
            var status = $(".detail-categories-status:checked").val() == 1 ? 1 : 0;

            var formDataE = new FormData(this);
            formDataE.append('_token', "{{ csrf_token() }}");
            formDataE.append('name', $(".detail-categories-name").val());
            formDataE.append('detail-categories-file', $("#edit-categories-file")[0].files[0]);
            formDataE.append('detail-categories-icon', $("#edit-categories-icon")[0].files[0]);
            formDataE.append('status', status);

            $.ajax({
                type: 'POST',
                url: "categories/" + id,
                data: formDataE,
                cache: false,
                contentType: false,
                processData: false,
                success: (data) => {
                    UIkit.modal.alert(data.message).then(function () {

                    });

                    table.draw();
                    UIkit.modal($("#detail-category-modal")).hide();
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

            // console.log($('input[name=categories-file]').prop('files')[0]);
            var status = $("input[name=categories-status]:checked").val() == 1 ? 1 : 0;

            var formData = new FormData(this);
            formData.append('_token', '{{ csrf_token() }}');
            formData.append('name', $("input[name=categories-name]").val());
            formData.append('categories-file', $("[name='new-categories-file']")[0].files[0]);
            formData.append('categories-icon', $("[name='new-categories-icon']")[0].files[0]);
            formData.append('status', status);

            // console.log($("[name='new-categories-file']")[0].files[0]);

            $.ajax({
                type: 'POST',
                url: "{{ route('categories.add') }}",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: (data) => {
                    UIkit.modal.alert(data.message).then(function () {

                    });

                    table.draw();
                    UIkit.modal($("#category-add-modal")).hide();
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
        let drEvent = $('#new-categories-file').dropify();

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
        let editEvent = $('#edit-categories-file').dropify();

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
