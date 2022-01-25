@extends('layouts.app')

@push('css-dropify')
<link rel="stylesheet" href="{{ asset('assets/js/vendor/dropify/dropify.min.css') }}">
@endpush

@section('content')
<div id="sc-page-wrapper">
    <div id="sc-page-content">
        <div class="uk-alert-icon" data-uk-alert>
            <a class="uk-alert-close" data-uk-close></a>
            <div class="uk-flex uk-flex-middle">
                <i class="mdi mdi-bullhorn sc-icon-32 uk-margin-right"></i>
                <div class="uk-alert-content">
                    <h5>Pada halaman ini terdapat data master kategori produk addons dari Bikin-co</h5>
                    <p>Anda dapat menambah, mengedit dan menghapus data kategori produk addons sesuai kebutuhan
                        Anda.</p>
                </div>
            </div>
        </div>

        <div class="uk-card uk-margin">
            <div class="uk-flex-middle sc-padding sc-padding-medium-ends uk-grid-small" data-uk-grid>
                <div class="uk-flex-1">
                    <h3 class="uk-card-title">Data Master Kategori Produk Addons</h3>
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
                                <input type="checkbox" name="check_1" class="hide-column" data-column="1" value="1"
                                       checked>
                                <label for="sc-dt-col-0">Subkategori</label>
                            </div>
                            <div class="uk-margin-small">
                                <input type="checkbox" name="check_2" class="hide-column" data-column="2" value="2"
                                       checked>
                                <label for="sc-dt-col-1">Nama Kategori Addons</label>
                            </div>
                            <div class="uk-margin-small">
                                <input type="checkbox" name="check_3" class="hide-column" data-column="3" value="3"
                                       checked>
                                <label for="sc-dt-col-6">Status</label>
                            </div>
                            <div class="uk-margin-small">
                                <input type="checkbox" name="check_4" class="hide-column" data-column="4" value="4"
                                       checked>
                                <label for="sc-dt-col-7">Aksi</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr class="uk-margin-remove">
            <div class="uk-card-body">
                <table id="specifications-table" class="specifications-table uk-table uk-table-striped dt-responsive">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Subkategori</th>
                            <th>Kategori Addons</th>
                            <th class="uk-text-nowrap">Status</th>
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
    <a href="#add-modal" onclick="$('#add_form').trigger('reset');" data-uk-toggle class="sc-fab sc-fab-text sc-fab-success"><i class="mdi mdi-plus"></i>Tambah</a>
</div>

<div id="add-modal" data-uk-modal>
    <div class="uk-modal-dialog">
        <button class="uk-modal-close-default" type="button" data-uk-close></button>
        <div class="uk-modal-header">
            <h2 class="uk-modal-title">Input Data Spesifikasi Produk Addons</h2>
        </div>
        <form action="" method="" enctype="multipart/form-data" role="form" id="add_form">
            <div class="uk-modal-body uk-padding-remove-top">
                <div class="uk-grid" data-uk-grid>
                    <div class="uk-width-1-1@l">
                        <label>Nama Spesifikasi<sup>*</sup></label>
                        <input type="text" name="new-name" required class="uk-input" data-sc-input>
                    </div>
                    <div class="uk-width-1-1@l">
                        <select name="subcategory_id" required class="uk-select"
                                data-sc-select2='{"placeholder": "Pilih Subkategori", "allowClear": true }' required>
                            <option value="0">Pilih Subkategori</option>
                            @foreach ($subcategories as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="uk-width-1-1@l">
                        <label>Status Spesifikasi</label><sup>*</sup><br>
                        <input type="checkbox" name="status" value="1" data-sc-switchery checked/><label
                                class="uk-margin-small-left">Aktif / Non Aktif</label>
                    </div>
                    <div class="uk-width-1-1@l">
                        <div class="uk-text-right">
                            <button class="sc-button sc-button-flat sc-button-flat-danger uk-modal-close" type="button">
                                Batal
                            </button>
                            <button class="sc-button add-material" type="submit">Tambah</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- Add Modal - End Section -->

<!-- Edit Modal -->
<div id="edit-modal" data-uk-modal>
    <div class="uk-modal-dialog">
        <button class="uk-modal-close-default" type="button" data-uk-close></button>
        <div class="uk-modal-header">
            <h2 class="uk-modal-title">Detail Spesifikasi Produk Addons</h2>
        </div>
        <form action="" enctype="multipart/form-data" id="edit_form" role="form">
            <div class="uk-modal-body uk-padding-remove-top">
                <input type="hidden" name="edit-specifications-id">
                <ul class="uk-list uk-margin-remove">
                    <li class="sc-sidebar-menu-heading custom-list-divider"><span>Detail</span></li>
                </ul>
                <div class="uk-padding-small uk-padding-remove-top"></div>
                <div class="uk-grid" data-uk-grid>
                    <div class="uk-width-1-1@l">
                        <label>Nama Spesifikasi<sup>*</sup></label>
                        <input type="text" name="name" required class="uk-input edit-spec-name" value="Fashion"
                               data-sc-input>
                    </div>
                    <div class="uk-width-1-1@l">
                        <select name="subcategory_id" required class="uk-select data_subcategory_id"
                                data-sc-select2='{"placeholder": "Pilih Subkategori", "allowClear": true }' required>
                            <option value="0">Pilih Subkategori</option>
                            @foreach ($subcategories as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="uk-width-1-1@l">
                        <label>Status Spesifikasi<sup>*</sup></label> <br>
                        <input type="checkbox" name="detail-status" value="1" data-sc-switchery checked/><label
                                class="uk-margin-small-left">Aktif / Non Aktif</label>
                    </div>
                    <div class="uk-width-1-1@l">
                        <div class="uk-grid" data-uk-grid>
                            <div class="uk-width-1-2@l uk-width-1-2@s">
                                <a id="sc-js-modal-confirm" style="margin-right: 66%;"
                                   class="delete-specifications uk-text-left sc-button sc-button-danger sc-js-button-wave-light"
                                   href="#">Hapus</a>
                            </div>
                            <div class="uk-width-1-2@l uk-width-1-2@s">
                                <div class="uk-text-right">
                                    <button class="sc-button sc-button-flat sc-button-flat-danger uk-modal-close"
                                            type="button">Batal
                                    </button>
                                    <button class="sc-button" type="submit">Simpan</button>
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
        UIkit.modal($("#edit-modal")).show();

        $.ajax({
            type: "GET",
            url: 'product-addons-category/' + id,
            success: function (data) {
                var status = data.data.status == 1 ? 'Aktif' : 'Tidak aktif';

                //Set up data for edit modal
                $("input[name=edit-specifications-id]").val(data.data.id);
                $("input[name=name]").val(data.data.name);
                $('.data_subcategory_id').val(data.data.has_subcategory.id).change();

                // Add Input focus
                let spec_name = $(".edit-spec-name");
                spec_name.parent().add('sc-input-focus');

                if (data.data.status <= 0) {
                    $('.switchery').click();
                }

                //Set up credentials for edit and delete action...
                $(".delete-specifications").attr('data-id', id);
            },
            error: function (data) {
                UIkit.modal.alert(data.responseJSON.message).then(function () {

                });
            }
        });
    }

	$(document).ready(function () {
		$('#pdev').addClass("sc-page-active");

        // Initialize DataTable
        var table = $('#specifications-table').DataTable({
            processing: true,
            serverSide: true,
            retrieve: true,
            pageLength: 10,
            ajax: "{{ route('product-addons-category') }}",
            columns: [
                {data: 'id', name: 'id', title: 'ID'},
                {data: 'alias_subcategory', name: 'hasSubcategory.name', title: 'Subkategori'},
                {data: 'name', name: 'name', title: 'Nama Spesifikasi'},
                {data: 'status', name: 'status', title: 'Status'},
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
        $('.delete-specifications').on('click', function (e) {
			UIkit.modal.confirm('Apakah anda yakin akan menghapus data ini ?').then(function () {
                e.preventDefault();

                var params = {
                    _token: '{{ csrf_token() }}',
                    id: $(".delete-specifications").attr('data-id'),
                }

                $.ajax({
                    type: "DELETE",
                    url: "{{ route('product-addons-category.delete') }}",
                    data: params,
                    async: false,
                    success: function (data) {
                        UIkit.modal.alert(data.message).then(function () {

                        });

                        table.draw();
                        UIkit.modal($("#edit-modal")).hide();
                    },
                    error: function (data) {
                        UIkit.modal.alert(data.responseJSON.message).then(function () {

                        });
                    }
                });
			}, function () {
				console.log('Rejected.')
			})
		});

        $('#edit_form').submit(function(event) {
            event.preventDefault();

            var id = $("input[name=edit-specifications-id]").val();
            var status = $("input[name=detail-status]:checked").val() == 1 ? 1 : 0;

            var formDataE = new FormData(this);
            formDataE.append('_token', "{{ csrf_token() }}");
            formDataE.append('status', status);

            $.ajax({
                type: 'POST',
                url: "product-addons-category/" + id,
                data: formDataE,
                cache: false,
                contentType: false,
                processData: false,
                success: (data) => {
                    UIkit.modal.alert(data.message).then(function () {

                    });


                    table.draw();
                    UIkit.modal($("#edit-modal")).hide();
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

            var status = $("input[name=status]:checked").val() == 1 ? 1 : 0;

            var formData = new FormData(this);
            formData.append('_token', '{{ csrf_token() }}');
            formData.append('name', $("[name='new-name']").val());
            formData.append('status', status);

            $.ajax({
                type: 'POST',
                url: "{{ route('product-addons-category.add') }}",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: (data) => {
                    UIkit.modal.alert(data.message).then(function () {

                    });

                    table.draw();
                    UIkit.modal($("#add-modal")).hide();
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
<script src="{{ asset('assets/js/vendor/dropify/dropify.min.js') }}"></script>
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
