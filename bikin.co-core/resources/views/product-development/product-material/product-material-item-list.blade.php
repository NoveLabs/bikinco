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
                    <h5>Pada halaman ini terdapat data master material item dari produk dari Bikin-co</h5>
                    <p>Anda dapat menambah, mengedit dan menghapus data material item sesuai kebutuhan Anda.</p>
                </div>
            </div>
        </div>
        
        <div class="uk-card uk-margin">
            <div class="uk-flex-middle sc-padding sc-padding-medium-ends uk-grid-small" data-uk-grid>
                <div class="uk-flex-1">
                    <h3 class="uk-card-title">Data Master Material Item</h3>
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
                                <label for="sc-dt-col-1">Nama Material item</label>
                            </div>
                            <div class="uk-margin-small">
                                <input type="checkbox" name="check_2" class="hide-column" data-column="2" value="2"  checked>
                                <label for="sc-dt-col-2">Material</label>
                            </div>
                            <div class="uk-margin-small">
                                <input type="checkbox" name="check_3" class="hide-column" data-column="3" value="3"  checked>
                                <label for="sc-dt-col-3">Status</label>
                            </div>
                            <div class="uk-margin-small">
                                <input type="checkbox" name="check_4" class="hide-column" data-column="4" value="4"  checked>
                                <label for="sc-dt-col-5">Aksi</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr class="uk-margin-remove">
            <div class="uk-card-body">
                <table id="material-items-table" class="material-items-table uk-table uk-table-striped dt-responsive">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Material item</th>
                            <th>Material</th>
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
    <a href="#" onclick="$('#add_form').trigger('reset');$('select[name=product_material_id]').val('').change();" class="sc-fab sc-fab-text sc-fab-success" data-uk-toggle="target: #material-item-add-modal"><i class="mdi mdi-plus"></i>Tambahkan</a>
</div>

<div id="material-item-add-modal" data-uk-modal>
    <div class="uk-modal-dialog">
        <button class="uk-modal-close-default" type="button" data-uk-close></button>
        <div class="uk-modal-header">
            <h2 class="uk-modal-title">Input Data Material Item</h2>
        </div>
        <form enctype="multipart/form-data" id="add_form" role="form" method="POST" action="">
            <div class="uk-modal-body uk-padding-remove-top">
                <div class="uk-grid" data-uk-grid>
                    <div class="uk-width-1-1@l">
                        <label>Nama Material Item<sup>*</sup></label>
                        <input type="text" name="new-name" required class="uk-input" data-sc-input>
                    </div>
                    <div class="uk-width-1-1@l">
                        <label class="custom-form-label">Material<sup>*</sup></label>
                        <div class="uk-width-expand">
                            <select name="product_material_id" required class="uk-select"
                                    data-sc-select2='{"placeholder": "Pilih Kategori", "allowClear": true }' required>
                                <option value="0">Pilih Material</option>
                                @foreach ($materials as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="uk-width-1-1@l">
                        <label>Status Material Item<sup>*</sup></label> <br>
                        <input type="checkbox" name="status" value="1" data-sc-switchery checked/><label
                                class="uk-margin-small-left">Aktif / Non Aktif</label>
                    </div>
                </div>
            </div>
            <div class="uk-modal-footer uk-text-right">
                <button class="sc-button sc-button-flat sc-button-flat-danger uk-modal-close" type="button">Batal</button>
                <button class="sc-button add-material-items" type="submit">Tambah</button>
            </div>
        </form>
    </div>
</div>
<!-- Add Modal - End Section -->

<!-- Edit Modal -->
<div id="data-modal-edit" class="modal-close data_subcategory" data-uk-modal>
    <div class="uk-modal-dialog">
        <button class="uk-modal-close-default" type="button" data-uk-close></button>
        <div class="uk-modal-header">
            <h2 class="uk-modal-title">Detail Material Item</h2>
        </div>
        <form enctype="multipart/form-data" id="edit_form" role="form" method="POST" action="">
            <div class="uk-modal-body uk-padding-remove-top">
                <ul class="uk-list">
                    <li class="sc-sidebar-menu-heading custom-list-divider"><span class="sc-text-semibold">Detail Material Items</span>
                    </li>
                </ul>
                <input type="hidden" name="edit-material-items-id"/>
                <div class="uk-grid" data-uk-grid>
                    <div class="uk-width-1-1@l">
                        <label>Nama Material Item<sup>*</sup></label>
                        <input type="text" name="name" required class="uk-input data-material-item-name" value="Kaos"
                               data-sc-input>
                    </div>
                    <div class="uk-width-1-1@l">
                        <label class="custom-form-label">Material<sup>*</sup></label>
                        <div class="uk-width-expand">
                            <select name="product_material_id" required id="product_material_id" class="uk-select"
                                    data-sc-select2='{"placeholder": "Pilih Material", "allowClear": true }' required>
                                <option value="0">Pilih Material</option>
                                @foreach ($materials as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="uk-width-1-1@l">
                        <label for="subcategory-stats">Status Material Item<sup>*</sup></label><br>
                        <input type="checkbox" name="detail-status" value="1" data-sc-switchery checked/><label
                                class="uk-margin-small-left">Aktif / Nonaktif</label>
                    </div>
                </div>
            </div>
            <div class="uk-modal-footer">
                <div class="uk-grid" data-uk-grid>
                    <div class="uk-width-1-2@l uk-width-1-2@2">
                        <button class="sc-button sc-button-danger delete-material-items" type="button">Hapus</button>
                    </div>
                    <div class="uk-width-1-2@l uk-width-1-2@2">
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
        UIkit.modal($("#data-modal-edit")).show();

        $.ajax({
            type: "GET",
            url: 'product-material-items/' + id,
            success: function (data) {
                var status = data.data.status == 1 ? 'Aktif' : 'Tidak aktif';

                //Set up data for edit modal
                $("input[name=edit-material-items-id]").val(data.data.id);
                $("input[name=name]").val(data.data.name);
                $("select[name=product_material_id]").val(data.data.product_material_id).change();

                if (data.data.status <= 0) {
                    $('.switchery').click();
                }

                let dataMaterialItemName = $(".data-material-item-name");
                dataMaterialItemName.parent().addClass('sc-inpur-filled');

                //Set up credentials for edit and delete action...
                $(".delete-material-items").attr('data-id', id);
            },
            error: function (err) {

            }
        });
    }    

	$(document).ready(function () {
		$('#pdev').addClass("sc-page-active");

        // Initialize DataTable
        var table = $('#material-items-table').DataTable({
            processing: true,
            serverSide: true,
            retrieve: true,
            pageLength: 10,
            ajax: "{{ route('product-material-items') }}",
            columns: [
                {data: 'id', name: 'id', title: 'ID'},
                {data: 'name', name: 'name', title: 'Nama Material Item'},
                {data: 'alias_material', name: 'hasProductMaterial.name', title: 'Material'},
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
        $('.delete-material-items').on('click', function (e) {
			UIkit.modal.confirm('Apakah anda yakin akan menghapus data ini ?').then(function () {
                e.preventDefault();

                var params = {
                    _token: "{{ csrf_token() }}",
                    id: $(".delete-material-items").attr('data-id'),
                }

                $.ajax({
                    type: "DELETE",
                    url: "{{ route('product-material-items.delete') }}",
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
				console.log('Rejected.')
			})
		});
        
        //Edit Action
        $('#edit_form').submit(function(event) {
            event.preventDefault();

            var id = $("input[name=edit-material-items-id]").val();
            var status = $("input[name=detail-status]:checked").val() == 1 ? 1 : 0;

            var material_id = 0;
            $.each($("#product_material_id option:selected"), function(){            
                material_id = $(this).val();
            });

            var formDataE = new FormData(this);
            formDataE.append('_token', "{{ csrf_token() }}");
            formDataE.append('product_material_id', material_id);
            formDataE.append('status', status);

            $.ajax({
                type: 'POST',
                url: "product-material-items/" + id,
                data: formDataE,
                cache: false,
                contentType: false,
                processData: false,
                success: (data) => {
                    UIkit.modal.alert(data.message).then(function () {
                        
                    });

                    $(this).trigger('reset');

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

            var status = $("input[name=status]:checked").val() == 1 ? 1 : 0;

            var formData = new FormData(this);
            formData.append('_token', '{{ csrf_token() }}');
            formData.append('status', status);
            formData.append('name', $("[name=new-name]").val());

            $.ajax({
                type: 'POST',
                url: "{{ route('product-material-items.add') }}",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: (data) => {
                    UIkit.modal.alert(data.message).then(function () {
                        
                    });

                    $(this).trigger('reset');

                    table.draw();
                    UIkit.modal($("#material-item-add-modal")).hide();
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