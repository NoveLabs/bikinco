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
                    <h5>Pada halaman ini terdapat data Blog dari Bikin-co</h5>
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
                                <label for="sc-dt-col-1">Category Blog</label>
                            </div>
                            <div class="uk-margin-small">
                                <input type="checkbox" name="check_2" class="hide-column" data-column="2" value="2"  checked>
                                <label for="sc-dt-col-2">Title</label>
                            </div>
                            <div class="uk-margin-small">
                                <input type="checkbox" name="check_3" class="hide-column" data-column="3" value="3"  checked>
                                <label for="sc-dt-col-3">Image</label>
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
                <table id="blog-table" class="blog-table uk-table uk-table-striped dt-responsive">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Category Blog</th>
                            <th>Title</th>
                            <th>Image</th>
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
    <a href="#blog-add-modal" onclick="$('#upload_form').trigger('reset');" data-uk-toggle class="sc-fab sc-fab-text sc-fab-success"><i class="mdi mdi-plus"></i>Tambah</a>
</div>

<div id="blog-add-modal" data-uk-modal>
    <div class="uk-modal-dialog">
        <form enctype="multipart/form-data" id="upload_form" role="form" method="POST" action="">
        <button class="uk-modal-close-default" type="button" data-uk-close></button>
        <div class="uk-modal-header">
            <h2 class="uk-modal-title">Input Data Blog</h2>
        </div>
        <div class="uk-modal-body">
            <div class="uk-margin">
                <label>Title</label>
                <input type="text" name="title" id="title" required class="uk-input" data-sc-input>
            </div>
             <div>
            <label>Status Blog</label><sup>*</sup><br>
                <input type="checkbox" name="blog-status" value="1" data-sc-switchery checked /><label class="uk-margin-small-left">Aktif / Non Aktif</label>
            </div>
            <div>
                <label>Category Blog</label><sup>*</sup><br>
                <select class="uk-select" name="category_blog" id="category_blog">
                    @foreach ($cat_blog as $value)
                        <option value="{{ $value->id }}">{{ $value->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label>Content</label><sup>*</sup><br>
                    <textarea id="wysiwyg-tinymce" name="content" class="content" cols="30" rows="20" hidden></textarea>
                <div class="sc-theme-dark-info uk-margin-top">
                    Dark mode for the TinyMCE rich text editor - <a href="https://www.tiny.cloud/blog/dark-mode-tinymce-rich-text-editor/">https://www.tiny.cloud/blog/dark-mode-tinymce-rich-text-editor/</a>
                </div>
            </div>
            <br>
            <div class="sc-list-body">
                <div class="dropzone"></div>
                <label style="margin-bottom: 10px;" for="input-file-max-fs">Unggah gambar<sup>*</sup></label>
                <input type="file" id="blog" name="blog" class="dropify data-photo" data-max-file-size="2M"/>
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
<div id="detail-blog-modal" data-uk-modal>
    <div class="uk-modal-dialog">
        <button class="uk-modal-close-default" type="button" data-uk-close></button>
        <div class="uk-modal-header">
            <h2 class="uk-modal-title">Detail Blog</h2>
        </div>
        <form  enctype="multipart/form-data" id="edit_upload_form" role="form" method="POST" action="" >
        <div class="uk-modal-body">
            <div class="uk-margin">
                <label>Title</label>
                <input type="text" name="edit_title" id="edit_title" required class="uk-input" data-sc-input>
            </div>
             <div>
            <label>Status Blog</label><sup>*</sup><br>
                <input type="checkbox" name="edit-blog-status" id="edit-blog-status" value="1" data-sc-switchery checked /><label class="uk-margin-small-left">Aktif / Non Aktif</label>
            </div>
            <div>
                <label>Category Blog</label><sup>*</sup><br>
                <select class="uk-select" name="edit_category_blog" id="edit_category_blog">
                </select>
            </div>
            <div>
                <label>Content</label><sup>*</sup><br>
                    <textarea id="edit-wysiwyg-tinymce" name="edit_content" class="edit_content" cols="30" rows="20" hidden></textarea>
                <div class="sc-theme-dark-info uk-margin-top">
                    Dark mode for the TinyMCE rich text editor - <a href="https://www.tiny.cloud/blog/dark-mode-tinymce-rich-text-editor/">https://www.tiny.cloud/blog/dark-mode-tinymce-rich-text-editor/</a>
                </div>
            </div>
            <br>
            <div class="sc-list-body">
                <div class="dropzone"></div>
                <label style="margin-bottom: 10px;" for="input-file-max-fs">Unggah gambar<sup>*</sup></label>
                <input type="file" id="edit_blog" name="edit_blog" class="dropify data-photo" data-max-file-size="2M"/>
            </div>
                <input type="hidden" id="edit-blog-id" name="edit-blog-id" value="">
        </div>

        <div class="uk-modal-footer uk-text-right">
            <form action="" style="width: 100px;">
                <a id="sc-js-modal-confirm" style="margin-right: 66%;" class="delete-blog uk-text-left sc-button sc-button-danger sc-js-button-wave-light" href="#">Hapus</a>
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
        UIkit.modal($("#detail-blog-modal")).show();

        $.ajax({
            type: "GET",
            url: '{!! route('categoryblog.all') !!}',
            success: function (data) {
                $("#edit_category_blog").empty();
                for (let i = 0; i < data.data.length; ++i) {
                    var html = '<option value="'+data.data[i].id+'">'+data.data[i].name+'</option>';
                    $("#edit_category_blog").append(html);
                }
            }
        });

        $.ajax({
            type: "GET",
            url: '{!! route('blog.detail', [':id']) !!}'.replace(':id',id),
            success: function (data) {

                var status = data.data.status == 1 ? 'Aktif' : 'Tidak aktif';

                //Set up data for edit modal
                $("input[name=edit-blog-id]").val(data.data.id);
                $("#edit_title").val(data.data.title);

                var html = '<option value="'+data.data.id_cat+'" selected>'+data.data.name+'</option>';
                $("#edit_category_blog").append(html);
                var s = data.data.content;
                tinyMCE.get('edit-wysiwyg-tinymce').setContent(s);

                if (data.data.status <= 0) {
                    $('.switchery').click();
                }


                // Dropify
                let image_target = $("#edit_blog");

                //  Dropify : Set Image to Render
                let preview_button = image_target.next();
                let render_target = image_target.next().next();
                let images = render_target.find('.dropify-filename-inner');
                let render_children = render_target.children('.dropify-render');

                // Check If File PAth are null or empty
                if (data.data.image !== null) {
                    // First : Remove All Content
                    render_children.empty();
                    render_target.css('display', 'none');
                    preview_button.css('display', 'none');

                    // Dropify : Set Image
                    image_target.attr("data-default-file", data.data.image);
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
                $(".delete-blog").attr('data-id', id);
            },
            error: function (err) {

            }
        });
    }

	$(document).ready(function () {
		$('#pdev').addClass("sc-page-active");

        // Initialize DataTable
        var table = $('#blog-table').DataTable({
            processing: true,
            serverSide: true,
            retrieve: true,
            pageLength: 10,
            ajax: "{{ route('blog.index') }}",
            columns: [
                {data: 'id', name: 'id', title: 'ID Blog'},
                {data: 'name', name: 'name', title: 'Category Blog'},
                {data: 'title', name: 'title', title: 'Title'},
                {data: 'image', name: 'image', title: 'Image'},
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
        $('.delete-blog').on('click', function (e) {
			UIkit.modal.confirm('Apakah anda yakin akan menghapus data ini ?').then(function () {
                e.preventDefault();

                var params = {
                    _token: '{{ csrf_token() }}',
                    id: $(".delete-blog").attr('data-id'),
                }

                $.ajax({
                    type: "DELETE",
                    url: "{{ route('blog.delete') }}",
                    data: params,
                    async: false,
                    success: function (data) {
                        UIkit.modal.alert(data.message).then(function () {

                        });

                        table.draw();
                        UIkit.modal($("#detail-blog-modal")).hide();
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

            var id = $("input[name=edit-blog-id]").val();
            var status = $("#edit-blog-status:checked").val() == 1 ? 1 : 0;

            var formDataE = new FormData(this);
            formDataE.append('_token', "{{ csrf_token() }}");
            formDataE.append('content', tinyMCE.get('edit-wysiwyg-tinymce').getContent());
            formDataE.append('title', $("#edit_title").val());
            formDataE.append('category_blog_id', $("#edit_category_blog").val());
            formDataE.append('blog', $("#edit_blog")[0].files[0]);
            formDataE.append('status', status);

            $.ajax({
                type: 'POST',
                url: '{!! route('blog.update', [':id']) !!}'.replace(':id',id),
                data: formDataE,
                cache: false,
                contentType: false,
                processData: false,
                success: (data) => {
                    UIkit.modal.alert(data.message).then(function () {

                    });

                    table.draw();
                    UIkit.modal($("#detail-blog-modal")).hide();
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

            var status = $("input[name=blog-status]:checked").val() == 1 ? 1 : 0;

            var formData = new FormData(this);
            formData.append('_token', '{{ csrf_token() }}');
            formData.append('content', tinyMCE.get('wysiwyg-tinymce').getContent());
            // formData.append('content', $("textarea#wysiwyg-tinymce").val());
            formData.append('title', $("input[name=title]").val());
            formData.append('blog', $("#blog").val());
            formData.append('category_blog_id', $("#category_blog").val());
            formData.append('status', status);

            // console.log($("[name='new-blog-file']")[0].files[0]);

            $.ajax({
                type: 'POST',
                url: "{{ route('blog.add') }}",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: (data) => {
                    UIkit.modal.alert(data.message).then(function () {

                    });

                    table.draw();
                    UIkit.modal($("#blog-add-modal")).hide();
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
