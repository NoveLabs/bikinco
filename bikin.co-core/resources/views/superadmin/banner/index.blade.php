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
                    <h5>Pada halaman ini terdapat data Banner dari Bikin-co</h5>
                    <p>Anda dapat menambah, mengedit dan menghapus data kategori sesuai kebutuhan Anda.</p>
                </div>
            </div>
        </div>

        <div class="uk-card uk-margin">
            <div class="uk-flex-middle sc-padding sc-padding-medium-ends uk-grid-small" data-uk-grid>
                <div class="uk-flex-1">
                    <h3 class="uk-card-title">Data Banner</h3>
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
                                <label for="sc-dt-col-1">Image</label>
                            </div>
                            <div class="uk-margin-small">
                                <input type="checkbox" name="check_2" class="hide-column" data-column="2" value="2"  checked>
                                <label for="sc-dt-col-2">Link</label>
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
                <table id="banner-table" class="banner-table uk-table uk-table-striped dt-responsive">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Image</th>
                            <th>Link</th>
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
    <a href="#banner-add-modal" onclick="$('#upload_form').trigger('reset');" data-uk-toggle class="sc-fab sc-fab-text sc-fab-success"><i class="mdi mdi-plus"></i>Tambah</a>
</div>

<div id="banner-add-modal" data-uk-modal>
    <div class="uk-modal-dialog">
        <form enctype="multipart/form-data" id="upload_form" role="form" method="POST" action="">
        <button class="uk-modal-close-default" type="button" data-uk-close></button>
        <div class="uk-modal-header">
            <h2 class="uk-modal-title">Input Data Banner</h2>
        </div>
        <div class="uk-modal-body">
            <div class="uk-margin">
                <label>Link (opsional)</label>
                <input type="text" name="link" required class="uk-input" data-sc-input>
            </div>
            <div>
                <label>Status Banner</label><sup>*</sup><br>
                <input type="checkbox" name="banner-status" value="1" data-sc-switchery checked /><label class="uk-margin-small-left">Aktif / Non Aktif</label>
            </div>
            <br>
            <div class="sc-list-body">
                <div class="dropzone"></div>
                <label style="margin-bottom: 10px;" for="input-file-max-fs">Unggah gambar<sup>*</sup></label>
                <input type="file" id="banner" name="banner" class="dropify data-photo"
                       data-max-file-size="2M"/>
            </div>
        </div>
        <div class="uk-modal-footer uk-text-right">
            <button class="sc-button sc-button-flat sc-button-flat-danger uk-modal-close" type="button">Batal</button>
            <button class="sc-button add-banner" type="submit">Tambah</button>
        </div>
        </form>
    </div>
</div>
<!-- Add Modal - End Section -->

<!-- Edit Modal -->
<div id="detail-banner-modal" data-uk-modal>
    <div class="uk-modal-dialog">
        <button class="uk-modal-close-default" type="button" data-uk-close></button>
        <div class="uk-modal-header">
            <h2 class="uk-modal-title">Detail Kategori</h2>
        </div>
        <form  enctype="multipart/form-data" id="edit_upload_form" role="form" method="POST" action="" >
        <div class="uk-modal-body">
                <div class="uk-margin">
                    <label>Link (opsional)</label>
                    <input type="text" name="edit-link" id="edit-link" required class="uk-input detail-banner-link" data-sc-input>
                </div>
                <div>
                    <label>Status Banner</label><sup>*</sup><br>
                    <input type="checkbox" name="banner-status" value="1" data-sc-switchery checked /><label class="uk-margin-small-left">Aktif / Non Aktif</label>
                </div>
                <br>
                <div class="sc-list-body">
                    <div class="dropzone"></div>
                    <label style="margin-bottom: 10px;" for="input-file-max-fs">Unggah gambar<sup>*</sup></label>
                    <input type="file" id="edit_banner" name="edit_banner" class="dropify data-photo" data-max-file-size="2M"/>
                </div>
                <input type="hidden" id="edit-banner-id" name="edit-banner-id" value="">
        </div>

        <div class="uk-modal-footer uk-text-right">
            <form action="" style="width: 100px;">
                <a id="sc-js-modal-confirm" style="margin-right: 66%;" class="delete-banner uk-text-left sc-button sc-button-danger sc-js-button-wave-light" href="#">Hapus</a>
            </form>
            <button class="sc-button sc-button-flat sc-button-flat-danger uk-modal-close" type="button">Batal</button>
            <button class="sc-button edit-banner" type="submit">Simpan</button>
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
        UIkit.modal($("#detail-banner-modal")).show();

        $.ajax({
            type: "GET",
            url: '{!! route('banner.detail', [':id']) !!}'.replace(':id',id),
            success: function (data) {

                var status = data.data.status == 1 ? 'Aktif' : 'Tidak aktif';

                //Set up data for edit modal
                $("input[name=edit-banner-id]").val(data.data.id);
                $(".detail-banner-link").val(data.data.link);

                if (data.data.status <= 0) {
                    $('.switchery').click();
                }


                // Dropify
                let image_target = $("#edit_banner");

                //  Dropify : Set Image to Render
                let preview_button = image_target.next();
                let render_target = image_target.next().next();
                let images = render_target.find('.dropify-filename-inner');
                let render_children = render_target.children('.dropify-render');

                // Check If File PAth are null or empty
                if (data.data.images !== null) {
                    // First : Remove All Content
                    render_children.empty();
                    render_target.css('display', 'none');
                    preview_button.css('display', 'none');

                    // Dropify : Set Image
                    image_target.attr("data-default-file", data.data.images);
                    let image_source = "<img src='" + image_target.attr('data-default-file') + "'>";

                    // Set image_source to render_target
                    render_children.append(image_source);
                    render_target.css('display', 'block');
                    preview_button.css('display', 'block');

                    // set Filename
                    images.text(data.data.filename);
                    // console.log('is available');
                } else {
                    // Set image_source to render_target
                    render_children.empty();
                    render_target.css('display', 'none');
                    preview_button.css('display', 'none');
                    // console.log('is not available');
                }

                //Set up credentials for edit and delete action...
                $(".delete-banner").attr('data-id', id);
            },
            error: function (err) {

            }
        });
    }

	$(document).ready(function () {
		$('#pdev').addClass("sc-page-active");

        // Initialize DataTable
        var table = $('#banner-table').DataTable({
            processing: true,
            serverSide: true,
            retrieve: true,
            pageLength: 10,
            ajax: "{{ route('banner.index') }}",
            columns: [
                {data: 'id', name: 'id', title: 'ID Banner'},
                {data: 'images', name: 'images', title: 'Image Banner'},
                {data: 'link', name: 'link', title: 'Link'},
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
        $('.delete-banner').on('click', function (e) {
			UIkit.modal.confirm('Apakah anda yakin akan menghapus data ini ?').then(function () {
                e.preventDefault();

                var params = {
                    _token: '{{ csrf_token() }}',
                    id: $(".delete-banner").attr('data-id'),
                }

                $.ajax({
                    type: "DELETE",
                    url: "{{ route('banner.delete') }}",
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

            var id = $("input[name=edit-banner-id]").val();
            var status = $(".detail-banner-status:checked").val() == 1 ? 1 : 0;

            var formDataE = new FormData(this);
            formDataE.append('_token', "{{ csrf_token() }}");
            formDataE.append('link', $("#edit-link").val());
            formDataE.append('banner', $("#edit_banner")[0].files[0]);
            formDataE.append('status', status);

            $.ajax({
                type: 'POST',
                url: '{!! route('banner.update', [':id']) !!}'.replace(':id',id),
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

            var status = $("input[name=banner-status]:checked").val() == 1 ? 1 : 0;

            var formData = new FormData(this);
            formData.append('_token', '{{ csrf_token() }}');
            formData.append('link', $("input[name=link]").val());
            formData.append('banner', $("#banner").val());
            formData.append('status', status);

            // console.log($("[name='new-banner-file']")[0].files[0]);

            $.ajax({
                type: 'POST',
                url: "{{ route('banner.add') }}",
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
        let drEvent = $('#new-banner-file').dropify();

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
        // let editEvent = $('#edit_banner').dropify();

        // editEvent.on('dropify.beforeClear', function (event, element) {

        //     if (element.file.name === null) {
        //         return confirm('Yakin ingin hapus file ini : ' + element.filenameWrapper[0].children[1].innerHTML + '?');
        //     } else {
        //         return confirm("Do you really want to delete \"" + element.file.name + "\" ?");
        //     }
        // });

        // editEvent.on('dropify.afterClear', function (event, element) {
        //     alert('File deleted');
        // });

        // editEvent.on('dropify.errors', function (event, element) {
        //     console.log('Has Errors');
        // });


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
