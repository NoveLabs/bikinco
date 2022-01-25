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
                    <h5>Pada halaman ini terdapat data master spesifikasi addons dari produk dari Bikin-co</h5>
                    <p>Anda dapat menambah, mengedit dan menghapus data spesifikasi addons sesuai kebutuhan Anda.</p>
                </div>
            </div>
        </div>

        <div class="uk-card uk-margin">
            <div class="uk-flex-middle sc-padding sc-padding-medium-ends uk-grid-small" data-uk-grid>
                <div class="uk-flex-1">
                    <h3 class="uk-card-title">Data Master Spesifikasi Addons</h3>
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
                                <label for="sc-dt-col-1">Nama Spesifikasi Addons</label>
                            </div>
                            <div class="uk-margin-small">
                                <input type="checkbox" name="check_2" class="hide-column" data-column="2" value="2"  checked>
                                <label for="sc-dt-col-2">Spesifikasi</label>
                            </div>
                            <div class="uk-margin-small">
                                <input type="checkbox" name="check_3" class="hide-column" data-column="3" value="3"  checked>
                                <label for="sc-dt-col-3">Harga</label>
                            </div>
                            <div class="uk-margin-small">
                                <input type="checkbox" name="check_4" class="hide-column" data-column="4" value="4"  checked>
                                <label for="sc-dt-col-3">Status</label>
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
                <table id="spec-items-table" class="spec-items-table uk-table uk-table-striped dt-responsive">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Spesifikasi Addons</th>
                            <th>Spesifikasi</th>
                            <th>Harga</th>
                            <th>Status</th>
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
    <a href="#add-modal" onclick="$('#add_form').trigger('reset');$('select[name=product_specification_id]').val('').change();" data-uk-toggle class="sc-fab sc-fab-text sc-fab-success"><i class="mdi mdi-plus"></i>Tambah</a>
</div>

<div id="add-modal" data-uk-modal>
    <div class="uk-modal-dialog">
        <button class="uk-modal-close-default" type="button" data-uk-close></button>
        <div class="uk-modal-header">
            <h2 class="uk-modal-title">Input Data Spesifikasi Addons</h2>
        </div>
        <form action="" method="" role="form" id="add_form">
            <input type="hidden" name="edit-spec-items-id"/>
            <div class="uk-modal-body uk-padding-remove-top">
                <div class="uk grid" data-uk-grid>
                    <div class="uk-width-1-1@l">
                        <label>Nama Spesifikasi Addons<sup>*</sup></label>
                        <input type="text" name="name" required class="uk-input" data-sc-input>
                    </div>
                    <div class="uk-width-1-1@l">
                        <label class="custom-form-label">Spesifikasi<sup>*</sup></label>
                        <div class="uk-width-expand">
                            <select name="product_specification_id" required class="uk-select"
                                    data-sc-select2='{"placeholder": "Pilih Spesifikasi", "allowClear": true }'
                                    required>
                                <option value="0">Pilih Spesifikasi</option>
                                @foreach ($specifications as $key => $item)
                                    <option value="{{ $item->id }}">{{ $subcategory[$key][0]->name }}
                                        - {{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="uk-width-1-1@l">
                        <label>Harga<sup>*</sup></label>
                        <input name="price" required class="uk-input data-price-style" data-sc-input data-inputmask="'alias': 'numeric', 'groupSeparator': ',', 'autoGroup': true, 'digits': 0, 'digitsOptional': false, 'prefix': '', 'placeholder': ''">
                    </div>
                    <div class="uk-width-1-1@l">
                        <label>Status Spesifikasi Addons<sup>*</sup></label> <br>
                        <input type="checkbox" name="status" value="1" data-sc-switchery checked/><label
                                class="uk-margin-small-left">Aktif / Non Aktif</label>
                    </div>
                </div>
            </div>
            <div class="uk-modal-footer uk-text-right">
                <button class="sc-button sc-button-flat sc-button-flat-danger uk-modal-close" type="button">Batal</button>
                <button class="sc-button" type="submit">Tambah</button>
            </div>
        </form>
    </div>
</div>
<!-- Add Modal - End Section -->

<!-- Edit Modal -->
<div id="edit-modal" class="modal-close data_subcategory" data-uk-modal>
    <div class="uk-modal-dialog uk-modal-body">
        <button class="uk-modal-close-default" type="button" data-uk-close></button>
        <h2 class="uk-modal-title">Detail Spesifikasi Addons</h2>
        <form enctype="multipart/form-data" method="" id="edit_form" action="">
            <div class="uk-modal-body uk-padding-remove-horizontal uk-padding-remove-top">
                <ul class="uk-list">
                    <li class="sc-sidebar-menu-heading custom-list-divider"><span class="sc-text-semibold">Detail Spesifikasi Addonss</span>
                    </li>
                </ul>
                <div class="uk-grid" data-uk-grid>
                    <div class="uk-width-1-1@l">
                        <label class="custom-form-label">Spesifikasi<sup>*</sup></label>
                        <div class="uk-width-expand">
                            <select name="product_specification_id" required id="product_specification_id"
                                    class="uk-select"
                                    data-sc-select2='{"placeholder": "Pilih Spesifikasi", "allowClear": true }'
                                    required>
                                <option value="0">Pilih Spesifikasi</option>
                                @foreach ($specifications as $item)
                                    <option value="{{ $item->id }}">{{ $subcategory[$key][0]->name }}
                                        - {{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="uk-width-1-1@l">
                        <label>Harga<sup>*</sup></label>
                        <input name="price" required class="uk-input data-price data-price-style" data-sc-input data-inputmask="'alias': 'numeric', 'groupSeparator': ',', 'autoGroup': true, 'digits': 0, 'digitsOptional': false, 'prefix': '', 'placeholder': ''">
                    </div>
                    <div class="uk-width-1-1@l">
                        <label>Nama Spesifikasi Addons<sup>*</sup></label>
                        <input type="text" name="name" required class="uk-input" value="Kaos" data-sc-input>
                    </div>
                    <div class="uk-width-1-1@l">
                        <label for="subcategory-stats">Status Spesifikasi Addons<sup>*</sup></label><br>
                        <input type="checkbox" name="detail-status" value="1" data-sc-switchery checked/><label
                                class="uk-margin-small-left">Aktif / Nonaktif</label>
                    </div>
                </div>
            </div>
            <div class="uk-modal-footer uk-padding-remove-horizontal uk-padding-remove-bottom">
                <div class="uk-grid" data-uk-grid>
                    <div class="uk-width-1-2@l uk-width-1-2@s">
                        <button class="sc-button sc-button-danger delete-spec-items" type="button">Hapus</button>
                    </div>
                    <div class="uk-width-1-2@l uk-width-1-2@s">
                        <div class="uk-text-right">
                            <button class="sc-button sc-button-flat sc-button-flat-danger uk-modal-close">Batalkan
                            </button>
                            <button class="sc-button sc-button-outline-primary" type="submit" data-button-mode="light">
                                Simpan
                            </button>
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
            url: 'product-spec-items/' + id,
            success: function (data) {
                var status = data.data.status == 1 ? 'Aktif' : 'Tidak aktif';

                //Set up data for edit modal
                $("input[name=edit-spec-items-id]").val(data.data.id);
                $("input[name=name]").val(data.data.name);
                $("input[name=price]").val(data.data.price);
                $("select[name=product_specification_id]").val(data.data.product_specification_id).change();

                // Add Sc-input-focus
                let data_price = $(".data-price");
                data_price.parent().addClass('sc-input-focus');

                if (data.data.status <= 0) {
                    $('.switchery').click();
                }

                //Set up credentials for edit and delete action...
                $(".delete-spec-items").attr('data-id', id);
            },
            error: function (err) {

            }
        });
    }

	$(document).ready(function () {
		$('#pdev').addClass("sc-page-active");

        // Initialize DataTable
        var table = $('#spec-items-table').DataTable({
            processing: true,
            serverSide: true,
            retrieve: true,
            pageLength: 10,
            ajax: "{{ route('product-spec-items') }}",
            columns: [
                {data: 'id', name: 'id', title: 'ID'},
                {data: 'name', name: 'name', title: 'Nama Spesifikasi Addons'},
                {data: 'alias_specification', name: 'hasSpecification.name', title: 'Spesifikasi'},
                {data: 'price', name: 'price', title: 'Harga'},
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
        $('.delete-spec-items').on('click', function (e) {
			UIkit.modal.confirm('Apakah anda yakin akan menghapus data ini ?').then(function () {
                e.preventDefault();

                var params = {
                    _token: "{{ csrf_token() }}",
                    id: $(".delete-spec-items").attr('data-id'),
                };

                $.ajax({
                    type: "DELETE",
                    url: "{{ route('product-spec-items.delete') }}",
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

                        })
                    }
                });
			}, function () {
				console.log('Rejected.')
			})
		});

        //Edit Action
        $('#edit_form').submit(function(event) {
            event.preventDefault();

            var id = $("input[name=edit-spec-items-id]").val();
            var status = $("input[name=detail-status]:checked").val() == 1 ? 1 : 0;

            var specification_id = 0;
            $.each($("#product_specification_id option:selected"), function () {
                specification_id = $(this).val();
            });

            var formDataE = new FormData(this);
            formDataE.append('_token', "{{ csrf_token() }}");
            formDataE.append('product_specification_id', specification_id);
            formDataE.append('status', status);

            $.ajax({
                type: 'POST',
                url: "product-spec-items/" + id,
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
            formData.append('status', status);

            $.ajax({
                type: 'POST',
                url: "{{ route('product-spec-items.add') }}",
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
                remove: 'Supprimer',
                error: 'Désolé, le fichier trop volumineux'
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
