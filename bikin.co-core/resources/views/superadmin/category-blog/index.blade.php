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
                    <h5>Pada halaman ini terdapat data Category Blog dari Bikin-co</h5>
                    <p>Anda dapat menambah, mengedit dan menghapus data kategori sesuai kebutuhan Anda.</p>
                </div>
            </div>
        </div>

        <div class="uk-card uk-margin">
            <div class="uk-flex-middle sc-padding sc-padding-medium-ends uk-grid-small" data-uk-grid>
                <div class="uk-flex-1">
                    <h3 class="uk-card-title">Data Blog</h3>
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
                                <label for="sc-dt-col-1">Category Blog Name</label>
                            </div>
                            <div class="uk-margin-small">
                                <input type="checkbox" name="check_2" class="hide-column" data-column="2" value="2"  checked>
                                <label for="sc-dt-col-2">Aksi</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr class="uk-margin-remove">
            <div class="uk-card-body">
                <table id="category-blog-table" class="category-blog-table uk-table uk-table-striped dt-responsive">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Category Blog Name</th>
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
    <a href="#cat-blog-add-modal" onclick="$('#upload_form').trigger('reset');" data-uk-toggle class="sc-fab sc-fab-text sc-fab-success"><i class="mdi mdi-plus"></i>Tambah</a>
</div>

<div id="cat-blog-add-modal" data-uk-modal>
    <div class="uk-modal-dialog">
        <form enctype="multipart/form-data" id="upload_form" role="form" method="POST" action="">
        <button class="uk-modal-close-default" type="button" data-uk-close></button>
        <div class="uk-modal-header">
            <h2 class="uk-modal-title">Input Data Category Blog</h2>
        </div>
        <div class="uk-modal-body">
            <div class="uk-margin">
                <label>Category Blog Name</label>
                <input type="text" name="name" id="name" required class="uk-input" data-sc-input>
            </div>
        </div>
        <div class="uk-modal-footer uk-text-right">
            <button class="sc-button sc-button-flat sc-button-flat-danger uk-modal-close" type="button">Batal</button>
            <button class="sc-button add-blog" type="submit">Tambah</button>
        </div>
        </form>
    </div>
</div>
<!-- Add Modal - End Section -->

<!-- Edit Modal -->
<div id="detail-cat-blog-modal" data-uk-modal>
    <div class="uk-modal-dialog">
        <button class="uk-modal-close-default" type="button" data-uk-close></button>
        <div class="uk-modal-header">
            <h2 class="uk-modal-title">Detail Category Blog</h2>
        </div>
        <form  enctype="multipart/form-data" id="edit_upload_form" role="form" method="POST" action="" >
        <div class="uk-modal-body">
            <div class="uk-margin">
                <label>Category Blog Name</label>
                <input type="text" name="edit_name" id="edit_name" required class="uk-input" data-sc-input>
            </div>
                <input type="hidden" id="edit-cat-blog-id" name="edit-cat-blog-id" value="">
        </div>

        <div class="uk-modal-footer uk-text-right">
            <form action="" style="width: 100px;">
                <a id="sc-js-modal-confirm" style="margin-right: 66%;" class="delete-cat-blog uk-text-left sc-button sc-button-danger sc-js-button-wave-light" href="#">Hapus</a>
            </form>
            <button class="sc-button sc-button-flat sc-button-flat-danger uk-modal-close" type="button">Batal</button>
            <button class="sc-button edit-blog" type="submit">Simpan</button>
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
        UIkit.modal($("#detail-cat-blog-modal")).show();

        $.ajax({
            type: "GET",
            url: '{!! route('categoryblog.detail', [':id']) !!}'.replace(':id',id),
            success: function (data) {

                //Set up data for edit modal
                $("input[name=edit-cat-blog-id]").val(data.data.id);
                $("#edit_name").val(data.data.name);

                //Set up credentials for edit and delete action...
                $(".delete-cat-blog").attr('data-id', id);
            },
            error: function (err) {

            }
        });
    }

	$(document).ready(function () {
		$('#pdev').addClass("sc-page-active");

        // Initialize DataTable
        var table = $('#category-blog-table').DataTable({
            processing: true,
            serverSide: true,
            retrieve: true,
            pageLength: 10,
            ajax: "{{ route('categoryblog.index') }}",
            columns: [
                {data: 'id', name: 'id', title: 'ID'},
                {data: 'name', name: 'name', title: 'Category Blog Name'},
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
        $('.delete-cat-blog').on('click', function (e) {
			UIkit.modal.confirm('Apakah anda yakin akan menghapus data ini ?').then(function () {
                e.preventDefault();

                var params = {
                    _token: '{{ csrf_token() }}',
                    id: $(".delete-cat-blog").attr('data-id'),
                }

                $.ajax({
                    type: "DELETE",
                    url: "{{ route('categoryblog.delete') }}",
                    data: params,
                    async: false,
                    success: function (data) {
                        UIkit.modal.alert(data.message).then(function () {

                        });

                        table.draw();
                        UIkit.modal($("#detail-cat-blog-modal")).hide();
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

            var id = $("input[name=edit-cat-blog-id]").val();

            var formDataE = new FormData(this);
            formDataE.append('_token', "{{ csrf_token() }}");
            formDataE.append('name', $("#edit_name").val());

            $.ajax({
                type: 'POST',
                url: '{!! route('categoryblog.update', [':id']) !!}'.replace(':id',id),
                data: formDataE,
                cache: false,
                contentType: false,
                processData: false,
                success: (data) => {
                    UIkit.modal.alert(data.message).then(function () {

                    });

                    table.draw();
                    UIkit.modal($("#detail-cat-blog-modal")).hide();
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
            formData.append('name', $("input[name=name]").val());

            // console.log($("[name='new-blog-file']")[0].files[0]);

            $.ajax({
                type: 'POST',
                url: "{{ route('categoryblog.add') }}",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: (data) => {
                    UIkit.modal.alert(data.message).then(function () {

                    });

                    table.draw();
                    UIkit.modal($("#cat-blog-add-modal")).hide();
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
        let drEvent = $('#new-blog-file').dropify();

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
        // let editEvent = $('#edit_blog').dropify();

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
