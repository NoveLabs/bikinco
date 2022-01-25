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
                    <h5>Pada halaman ini terdapat data master Subkategori produk dari Bikin-co</h5>
                    <p>Anda dapat menambah, mengedit dan menghapus data subkategori sesuai kebutuhan Anda.</p>
                </div>
            </div>
        </div>

        <div class="uk-card uk-margin">
            <div class="uk-flex-middle sc-padding sc-padding-medium-ends uk-grid-small" data-uk-grid>
                <div class="uk-flex-1">
                    <h3 class="uk-card-title">Data Master Subkategori</h3>
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
                                <label for="sc-dt-col-1">Nama Subkategori</label>
                            </div>
                            <div class="uk-margin-small">
                                <input type="checkbox" name="check_2" class="hide-column" data-column="2" value="2"  checked>
                                <label for="sc-dt-col-2">Kategori</label>
                            </div>
                            <div class="uk-margin-small">
                                <input type="checkbox" name="check_3" class="hide-column" data-column="3" value="3"  checked>
                                <label for="sc-dt-col-3">Status</label>
                            </div>
                            <div class="uk-margin-small">
                                <input type="checkbox" name="check_4" class="hide-column" data-column="4" value="4"  checked>
                                <label for="sc-dt-col-4">Tanggal Input</label>
                            </div>
                            <div class="uk-margin-small">
                                <input type="checkbox" name="check_5" class="hide-column" data-column="5" value="5"  checked>
                                <label for="sc-dt-col-5">Aksi</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr class="uk-margin-remove">
            <div class="uk-card-body">
                <table id="sub-categories-table" class="sub-categories-table uk-table uk-table-striped dt-responsive">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Kategori</th>
                            <th>Kategori</th>
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
    <a href="#subcategory-add-modal" onclick="$('#add_form').trigger('reset');$('select[name=f-v-select2]').val('').change();" data-uk-toggle class="sc-fab sc-fab-text sc-fab-success"><i class="mdi mdi-plus"></i>Tambah</a>
</div>

<div id="subcategory-add-modal" data-uk-modal>
    <div class="uk-modal-dialog">
        <button class="uk-modal-close-default" type="button" data-uk-close></button>
        <div class="uk-modal-header">
            <h2 class="uk-modal-title">Input Data Subkategori</h2>
        </div>
        <form enctype="multipart/form-data" id="add_form" role="form" method="POST" action="">
            <div class="uk-modal-body uk-padding-remove-top">
                <div class="uk-margin">
                    <label>Nama Subkategori<sup>*</sup></label>
                    <input type="text" name="subcategories-name" required class="uk-input" data-sc-input>
                </div>
                <div>
                    <label class="custom-form-label">Kategori<sup>*</sup></label>
                    <div class="uk-width-expand">
                        <select name="f-v-select2" required class="uk-select" data-sc-select2='{"placeholder": "Pilih Kategori", "allowClear": true }' required>
                            <option value="0" >Pilih Kategori</option>
                            @foreach ($categories as $item)
                                <option value="{{ $item->id }}" >{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <br>
                <div>
                    <label>Status Subkategori<sup>*</sup></label> <br>
                    <input type="checkbox" name="subcategories-status" id="a_subcategories_status" value="1" data-sc-switchery checked /><label class="uk-margin-small-left">Aktif / Non Aktif</label>
                </div>
                <br>
                <div class="sc-list-body">
                    <label style="margin-bottom: 10px;" for="input-file-max-fs">Unggah gambar dengan resolusi 600x600 piksel (jika ada)</label>
                    <input type="file" id="new-subcategories-file" name="subcategories-file" class="dropify"
                           data-max-file-size="2M"/>
                </div>
            </div>
            <div class="uk-modal-footer uk-text-right">
                <button class="sc-button sc-button-flat sc-button-flat-danger uk-modal-close" type="button">Batal</button>
                <button class="sc-button add-subcategories" type="submit">Tambah</button>
            </div>
        </form>
    </div>
</div>
<!-- Add Modal - End Section -->

<!-- Edit Modal -->
<div id="data-modal-edit" class="modal-close data_subcategory" data-uk-modal>
    <div class="uk-modal-dialog uk-modal-body">
        <button class="uk-modal-close-default" type="button" data-uk-close></button>
        <h2 class="uk-modal-title">Detail Subkategori</h2>
        <form  enctype="multipart/form-data" id="edit_form" role="form" method="POST" action="" >
            <input type="hidden" name="edit-subcategories-id" />
            <div class="uk-modal-body uk-padding-remove">
                <div class="uk-grid" data-uk-grid>
                    <div class="uk-width-1-2@l uk-width-1-1@s">
                        <ul class="uk-list">
                            <li class="sc-sidebar-menu-heading custom-list-divider"><span class="sc-text-semibold">Detail Subkategori</span>
                            </li>
                        </ul>
                        <div class="uk-padding-small uk-padding-remove-bottom"></div>
                        <div class="uk-width-1-1@l uk-width-1-1@s">
                            <div>
                                <label style="padding-left: 8px;">Kategori<sup>*</sup></label>
                                <div class="uk-width-expand">
                                    <select name="detail-subcategories-ids" required id="detail-subcategories-cat"
                                            class="uk-select"
                                            data-sc-select2='{"placeholder": "Pilih Kategori", "allowClear": true }'
                                            required>
                                        <option value="0">Pilih Kategori</option>
                                        @foreach ($categories as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="uk-margin">
                                <label>Nama Subkategori<sup>*</sup></label>
                                <input type="text" name="detail-subcategories-name" required class="uk-input"
                                       value="Kaos" data-sc-input>
                            </div>
                            <div class="uk-margin" style="padding-left: 8px;">
                                <label for="subcategory-stats">Status Kategori<sup>*</sup></label><br>
                                <input type="checkbox" class="detail-subcategories-status" value="1" data-sc-switchery
                                       checked/><label class="uk-margin-small-left">Aktif / Nonaktif</label>
                            </div>
                        </div>
                    </div>
                    <div class="uk-width-1-2@l uk-width-1-1@s">
                        <div class="uk-margin">
                            <ul class="uk-list">
                                <li class="sc-sidebar-menu-heading custom-list-divider"><span class="sc-text-semibold">Gambar</span>
                                </li>
                            </ul>
                            <div class="uk-padding-small uk-padding-remove-bottom"></div>
                            <div>
                                <div class="sc-list-body">
                                    <label style="margin-bottom: 10px;" for="input-file-max-fs">Unggah gambar dengan
                                        resolusi 600x600 piksel (jika ada)</label>
                                    <input type="file" id="edit-subcategories-file" name="detail-subcategories-file"
                                           class="dropify" data-max-file-size="2M"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="uk-width-1-1@l">
                        <div class="uk-grid" data-uk-grid>
                            <div class="uk-width-1-2@l uk-width-1-2@s">
                                <button class="sc-button sc-button-danger delete-subcategories" type="button">Hapus
                                </button>
                            </div>
                            <div class="uk-width-1-2@l uk-width-1-2@s">
                                <div class="uk-text-right">
                                    <button class="sc-button sc-button-flat sc-button-flat-danger uk-modal-close">
                                        Batalkan
                                    </button>
                                    <button class="sc-button sc-button-outline-primary edit-subcategories" type="submit"
                                            data-button-mode="light">Simpan
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
        UIkit.modal($("#data-modal-edit")).show();

        $.ajax({
            type: "GET",
            url: 'sub-categories/' + id,
            success: function (data) {
                var status = data.data.status == 1 ? 'Aktif' : 'Tidak aktif';

                //Set up data for edit modal
                $("input[name=edit-subcategories-id]").val(data.data.id);
                $("input[name=detail-subcategories-name]").val(data.data.name);
                $("select[name=detail-subcategories-ids]").val(data.data.categories_id).change();

                // $(".switchery").prop('checked', data.data.status).trigger("click");

                if (data.data.status <= 0) {
                    $('.switchery').click();
                }


                // Dropify
                let image_target = $("#edit-subcategories-file");

                //  Dropify : Set Image to Render
                let preview_button = image_target.next();
                let render_target = image_target.next().next();
                let file_name = render_target.find('.dropify-filename-inner');
                let render_children = render_target.children('.dropify-render');

                // Check If File PAth are null or empty
                if (data.data.file_name !== null) {
                    // First : Remove All Content
                    render_children.empty();
                    render_target.css('display', 'none');
                    preview_button.css('display', 'none');

                    // Dropify : Set Image
                    image_target.attr("data-default-file", data.data.file_name);
                    let image_source = "<img src='" + image_target.attr('data-default-file') + "'>";

                    // Set image_source to render_target
                    render_children.append(image_source);
                    render_target.css('display', 'block');
                    preview_button.css('display', 'block');

                    // set Filename
                    file_name.text(data.data.file_name);
                    // console.log('is available');
                } else {
                    // Set image_source to render_target
                    render_children.empty();
                    render_target.css('display', 'none');
                    preview_button.css('display', 'none');
                    // console.log('is not available');
                }

                //Set up credentials for edit and delete action...
                $(".delete-subcategories").attr('data-id', id);
            },
            error: function (err) {

            }
        });
    }

	$(document).ready(function () {
		$('#pdev').addClass("sc-page-active");

        // $(".detail-categories").click(function(e) {
        //     var id = $(this).data('id');
        // });

        // Initialize DataTable
        var table = $('#sub-categories-table').DataTable({
            processing: true,
            serverSide: true,
            retrieve: true,
            pageLength: 10,
            ajax: "{{ route('sub-categories') }}",
            columns: [
                {data: 'id', name: 'id', title: 'ID Kategori'},
                {data: 'name', name: 'name', title: 'Nama Kategori'},
                {data: 'alias_categories', name: 'hasCategories.name', title: 'Kategori'},
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
        $('.delete-subcategories').on('click', function (e) {
			UIkit.modal.confirm('Apakah anda yakin akan menghapus data ini ?').then(function () {
                e.preventDefault();

                var params = {
                    _token: "{{ csrf_token() }}",
                    id: $(".delete-subcategories").attr('data-id'),
                }

                $.ajax({
                    type: "DELETE",
                    url: "{{ route('sub-categories.delete') }}",
                    data: params,
                    async: false,
                    success: function (data) {
                        UIkit.modal.alert(data.message).then(function () {

                        });

                        table.draw();
                        UIkit.modal($("#data-modal-edit")).hide();
                    },
                    error: function (data) {
                        UIkit.modal.alert(data.responseJSON.message).then(function () {

                        })
                    }
                });
			}, function () {
				console.log('.')
			})
		});

        //Edit Action
        $('#edit_form').submit(function(event) {
            event.preventDefault();

            var id = $("input[name=edit-subcategories-id]").val();
            var status = $(".detail-subcategories-status:checked").val() == 1 ? 1 : 0;

            var categories_id = 0;
            $.each($("#detail-subcategories-cat option:selected"), function () {
                categories_id = $(this).val();
            });

            var formDataE = new FormData(this);
            formDataE.append('_token', "{{ csrf_token() }}");
            formDataE.append('name', $("input[name=detail-subcategories-name]").val());
            formDataE.append('categories_id', categories_id);
            formDataE.append('file_name', $('input[name=detail-subcategories-file]').prop('files')[0]);
            formDataE.append('status', status);

            $.ajax({
                type: 'POST',
                url: "sub-categories/" + id,
                data: formDataE,
                cache: false,
                contentType: false,
                processData: false,
                success: (data) => {
                    UIkit.modal.alert(data.message).then(function () {

                    });

                    table.draw();
                    UIkit.modal($("#data-modal-edit")).hide();
                },
                error: function (data) {
                    UIkit.modal.alert(data.responseJSON.message).then(function () {

                    })
                }
            });
        });

        //Add action
        $('#add_form').submit(function(event){
            event.preventDefault();

            var status = $("input[name=subcategories-status]:checked").val() == 1 ? 1 : 0;

            var formData = new FormData(this);
            formData.append('_token', '{{ csrf_token() }}');
            formData.append('name', $("input[name=subcategories-name]").val());
            formData.append('categories_id', $("select[name=f-v-select2]").val());
            formData.append('file_name', $('input[name=subcategories-file]').prop('files')[0]);
            formData.append('status', status);

            $.ajax({
                type: 'POST',
                url: "{{ route('sub-categories.add') }}",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: (data) => {
                    UIkit.modal.alert(data.message).then(function () {

                    });

                    table.draw();
                    UIkit.modal($("#subcategory-add-modal")).hide();
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
                remove: 'Supprimer',
                error: 'Désolé, le fichier trop volumineux'
            }
        });

        // Used events
        var drEvent = $('#new-subcategories-file').dropify();

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

        // Edit Events
        var editEvent = $('#edit-subcategories-file').dropify();

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
