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
                    <h5>Pada halaman ini terdapat data Promo dari Bikin-co</h5>
                    <p>Anda dapat menambah, mengedit dan menghapus data kategori sesuai kebutuhan Anda.</p>
                </div>
            </div>
        </div>

        <div class="uk-card uk-margin">
            <div class="uk-flex-middle sc-padding sc-padding-medium-ends uk-grid-small" data-uk-grid>
                <div class="uk-flex-1">
                    <h3 class="uk-card-title">Data Promo</h3>
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
                                <label for="sc-dt-col-1">Title</label>
                            </div>
                            <div class="uk-margin-small">
                                <input type="checkbox" name="check_2" class="hide-column" data-column="2" value="2"  checked>
                                <label for="sc-dt-col-2">Image</label>
                            </div>
                            <!-- <div class="uk-margin-small">
                                <input type="checkbox" name="check_3" class="hide-column" data-column="3" value="3"  checked>
                                <label for="sc-dt-col-3">Content</label>
                            </div> -->
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
                <table id="promo-table" class="promo-table uk-table uk-table-striped dt-responsive">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Title</th>
                            <th>Image</th>
                            <th>Start Date</th>
                            <th>End Date</th>
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
    <a href="#promo-add-modal" onclick="$('#upload_form').trigger('reset');" data-uk-toggle class="sc-fab sc-fab-text sc-fab-success"><i class="mdi mdi-plus"></i>Tambah</a>
</div>

<div id="promo-add-modal" data-uk-modal>
    <div class="uk-modal-dialog">
        <form enctype="multipart/form-data" id="upload_form" role="form" method="POST" action="">
        <button class="uk-modal-close-default" type="button" data-uk-close></button>
        <div class="uk-modal-header">
            <h2 class="uk-modal-title">Input Data Promo</h2>
        </div>
        <div class="uk-modal-body">
            <div class="uk-margin uk-width-1-1">
                <label>Title</label>
                <input type="text" name="title" id="title" required class="uk-input" data-sc-input>
            </div>
             <div class="uk-margin uk-width-1-1">
            <label>Status Promo</label><sup>*</sup><br>
                <input type="checkbox" name="promo-status" value="1" data-sc-switchery checked /><label class="uk-margin-small-left">Aktif / Non Aktif</label>
            </div>
            <div class="uk-width-1-2@s">
                <label>Period Start</label><sup>*</sup><br>        
                <div class="sc-input-wrapper">
                    <input type="text" id="period_start" name="period_start" class="uk-input" data-sc-flatpickr placeholder="Pick a date..."/>
                    <span class="sc-input-bar"></span>
                </div>
            </div>
            <div class="uk-width-1-2@s">
                <label>Period End</label><sup>*</sup><br>
                <div class="sc-input-wrapper">
                    <input type="text" id="period_end" name="period_end" class="uk-input" data-sc-flatpickr placeholder="Pick a date..."/>
                    <span class="sc-input-bar"></span>
                </div>
            </div>
            <div class="uk-margin uk-width-1-2@s">
                <label>Coupon Code</label><br>
                <input type="text" class="uk-input" name="coupon_code" id="coupon_code" data-sc-input />
            </div>
            <div class="uk-margin uk-width-1-2@s">
                <label>Minimum Transactions</label><br>
                <input type="number" class="uk-input" name="minimum_trans" id="minimum_trans" data-sc-input />
            </div>
            <div class="uk-margin uk-width-1-1">
                <label>Description</label><sup>*</sup><br>
                    <textarea id="wysiwyg-tinymce" name="description" class="description" cols="30" rows="20" hidden></textarea>
                <div class="sc-theme-dark-info uk-margin-top">
                    Dark mode for the TinyMCE rich text editor - <a href="https://www.tiny.cloud/promo/dark-mode-tinymce-rich-text-editor/">https://www.tiny.cloud/promo/dark-mode-tinymce-rich-text-editor/</a>
                </div>
            </div>
            <div class="uk-margin uk-width-1-1">
                <label>Terms & Conditions</label><sup>*</sup><br>
                <textarea  name="terms_cond" id="terms_cond" class="uk-textarea" cols="30" rows="20"></textarea>
            </div>
            <br>
            <div class="sc-list-body">
                <div class="dropzone"></div>
                <label style="margin-bottom: 10px;" for="input-file-max-fs">Unggah gambar<sup>*</sup></label>
                <input type="file" id="image_promo" name="image_promo" class="dropify data-photo" data-max-file-size="2M"/>
            </div>
        </div>
        <div class="uk-modal-footer uk-text-right">
            <button class="sc-button sc-button-flat sc-button-flat-danger uk-modal-close" type="button">Batal</button>
            <button class="sc-button add-promo" type="submit">Tambah</button>
        </div>
        </form>
    </div>
</div>
<!-- Add Modal - End Section -->

<!-- Edit Modal -->
<div id="detail-promo-modal" data-uk-modal>
    <div class="uk-modal-dialog">
        <button class="uk-modal-close-default" type="button" data-uk-close></button>
        <div class="uk-modal-header">
            <h2 class="uk-modal-title">Detail Promo</h2>
        </div>
        <form  enctype="multipart/form-data" id="edit_upload_form" role="form" method="POST" action="" >
        <div class="uk-modal-body">
            <div class="uk-margin uk-width-1-1">
                <label>Title</label>
                <input type="text" name="edit_title" id="edit_title" required class="uk-input" data-sc-input>
            </div>
             <div class="uk-margin uk-width-1-1">
            <label>Status Promo</label><sup>*</sup><br>
                <input type="checkbox" name="edit-promo-status" value="1" data-sc-switchery checked /><label class="uk-margin-small-left">Aktif / Non Aktif</label>
            </div>
            <div class="uk-width-1-2@s">
                <label>Period Start</label><sup>*</sup><br>        
                <div class="sc-input-wrapper">
                    <input type="text" id="edit_period_start" name="edit_period_start" class="uk-input" data-sc-flatpickr placeholder="Pick a date..."/>
                    <span class="sc-input-bar"></span>
                </div>
            </div>
            <div class="uk-width-1-2@s">
                <label>Period End</label><sup>*</sup><br>
                <div class="sc-input-wrapper">
                    <input type="text" id="edit_period_end" name="edit_period_end" class="uk-input" data-sc-flatpickr placeholder="Pick a date..."/>
                    <span class="sc-input-bar"></span>
                </div>
            </div>
            <div class="uk-margin uk-width-1-2@s">
                <label>Coupon Code</label><br>
                <input type="text" class="uk-input" name="edit_coupon_code" id="edit_coupon_code" data-sc-input />
            </div>
            <div class="uk-margin uk-width-1-2@s">
                <label>Minimum Transactions</label><br>
                <input type="number" class="uk-input" name="edit_min_transactions" id="edit_min_transactions" data-sc-input />
            </div>
            <div class="uk-margin uk-width-1-1">
                <label>Description</label><sup>*</sup><br>
                    <textarea id="edit-wysiwyg-tinymce" name="edit_description" class="edit_description" cols="30" rows="20" hidden></textarea>
                <div class="sc-theme-dark-info uk-margin-top">
                    Dark mode for the TinyMCE rich text editor - <a href="https://www.tiny.cloud/promo/dark-mode-tinymce-rich-text-editor/">https://www.tiny.cloud/promo/dark-mode-tinymce-rich-text-editor/</a>
                </div>
            </div>
            <div class="uk-margin uk-width-1-1">
                <label>Terms & Conditions</label><sup>*</sup><br>
                <textarea  name="edit_terms_condition" id="edit_terms_condition" class="uk-textarea" cols="30" rows="20"></textarea>
            </div>
            <br>
            <div class="sc-list-body">
                <div class="dropzone"></div>
                <label style="margin-bottom: 10px;" for="input-file-max-fs">Unggah gambar<sup>*</sup></label>
                <input type="file" id="edit_image_promo" name="edit_image_promo" class="dropify data-photo" data-max-file-size="2M"/>
            </div>
                <input type="hidden" id="edit-promo-id" name="edit-promo-id" value="">
        </div>

        <div class="uk-modal-footer uk-text-right">
            <form action="" style="width: 100px;">
                <a id="sc-js-modal-confirm" style="margin-right: 66%;" class="delete-promo uk-text-left sc-button sc-button-danger sc-js-button-wave-light" href="#">Hapus</a>
            </form>
            <button class="sc-button sc-button-flat sc-button-flat-danger uk-modal-close" type="button">Batal</button>
            <button class="sc-button edit-promo" type="submit">Simpan</button>
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
        UIkit.modal($("#detail-promo-modal")).show();

        $.ajax({
            type: "GET",
            url: '{!! route('promo.detail', [':id']) !!}'.replace(':id',id),
            success: function (data) {

                var status = data.data.status == 1 ? 'Aktif' : 'Tidak aktif';

                //Set up data for edit modal
                $("input[name=edit-promo-id]").val(data.data.id);
                $("#edit_title").val(data.data.title);
                $("#edit_coupon_code").val(data.data.coupon_code);
                $("#edit_min_transactions").val(data.data.min_transactions);
                $("#edit_period_start").val(data.data.period_start);
                $("#edit_period_end").val(data.data.period_end);
                $("textarea#edit_terms_condition").val(data.data.terms_condition);
                var s = data.data.description;
                tinyMCE.get('edit-wysiwyg-tinymce').setContent(s);

                if (data.data.status <= 0) {
                    $('.switchery').click();
                }


                // Dropify
                let image_target = $("#edit_image_promo");

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
                $(".delete-promo").attr('data-id', id);
            },
            error: function (err) {

            }
        });
    }

	$(document).ready(function () {
		$('#pdev').addClass("sc-page-active");

        // Initialize DataTable
        var table = $('#promo-table').DataTable({
            processing: true,
            serverSide: true,
            retrieve: true,
            pageLength: 10,
            ajax: "{{ route('promo.index') }}",
            columns: [
                {data: 'id', name: 'id', title: 'ID Promo'},
                {data: 'title', name: 'title', title: 'Title'},
                {data: 'image', name: 'image', title: 'Image'},
                {data: 'period_start', name: 'period_start', title: 'Start Date'},
                {data: 'period_end', name: 'period_end', title: 'End Date'},
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
        $('.delete-promo').on('click', function (e) {
			UIkit.modal.confirm('Apakah anda yakin akan menghapus data ini ?').then(function () {
                e.preventDefault();

                var params = {
                    _token: '{{ csrf_token() }}',
                    id: $(".delete-promo").attr('data-id'),
                }

                $.ajax({
                    type: "DELETE",
                    url: "{{ route('promo.delete') }}",
                    data: params,
                    async: false,
                    success: function (data) {
                        UIkit.modal.alert(data.message).then(function () {

                        });

                        table.draw();
                        UIkit.modal($("#detail-promo-modal")).hide();
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

            var id = $("input[name=edit-promo-id]").val();
            var status = $("#edit-promo-status:checked").val() == 1 ? 1 : 0;

            var formDataE = new FormData(this);
            formDataE.append('_token', "{{ csrf_token() }}");
            formDataE.append('description', tinyMCE.get('edit-wysiwyg-tinymce').getContent());
            formDataE.append('terms_condition', $('textarea#edit_terms_condition').val());
            formDataE.append('title', $("input[name=edit_title]").val());
            formDataE.append('image', $("#edit_image_promo")[0].files[0]);
            formDataE.append('min_transactions', $("#edit_min_transactions").val());
            formDataE.append('period_start', $("#edit_period_start").val());
            formDataE.append('period_end', $("#edit_period_end").val());
            formDataE.append('coupon_code', $("#edit_coupon_code").val());
            formDataE.append('status', status);

            $.ajax({
                type: 'POST',
                url: '{!! route('promo.update', [':id']) !!}'.replace(':id',id),
                data: formDataE,
                cache: false,
                contentType: false,
                processData: false,
                success: (data) => {
                    UIkit.modal.alert(data.message).then(function () {

                    });

                    table.draw();
                    UIkit.modal($("#detail-promo-modal")).hide();
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

            var status = $("input[name=promo-status]:checked").val() == 1 ? 1 : 0;

            var formData = new FormData(this);
            formData.append('_token', '{{ csrf_token() }}');
            formData.append('description', tinyMCE.get('wysiwyg-tinymce').getContent());
            formData.append('terms_condition', $('textarea#terms_cond').val());
            formData.append('title', $("input[name=title]").val());
            formData.append('image', $("#image_promo")[0].files[0]);
            formData.append('min_transactions', $("#minimum_trans").val());
            formData.append('coupon_code', $("#coupon_code").val());
            formData.append('period_start', $("#period_start").val());
            formData.append('period_end', $("#period_end").val());
            formData.append('status', status);

            // console.log($("[name='new-promo-file']")[0].files[0]);

            $.ajax({
                type: 'POST',
                url: "{{ route('promo.add') }}",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: (data) => {
                    UIkit.modal.alert(data.message).then(function () {

                    });

                    table.draw();
                    UIkit.modal($("#promo-add-modal")).hide();
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
        let drEvent = $('#new-promo-file').dropify();

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
        // let editEvent = $('#edit_promo').dropify();

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
