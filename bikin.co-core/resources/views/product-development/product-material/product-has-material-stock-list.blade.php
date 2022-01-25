@extends('layouts.app')

@push('css-dropify')
<link rel="stylesheet" href="{{ asset('assets/js/vendor/dropify/dropify.min.css') }}">
@endpush

@section('content')
<div id="sc-page-wrapper">
    <div id="sc-page-content">
        <div class="uk-card uk-margin">
			<h3 class="uk-card-title">Gambar {{ $product->name }} - {{ $product->hasSubCategories->name}}</h3>
			<div class="uk-card-body">
				<div class="uk-position-relative uk-visible-toggle uk-light" data-uk-slider>
					<ul class="uk-slider-items uk-child-width-1-2 uk-child-width-1-3@s uk-child-width-1-4@m uk-grid uk-grid-small">
                        @foreach ($product->hasImage()->get() as $image)
						<li>
							<img src="{{ $image->file_name }}" alt="">
						</li>
                        @endforeach
					</ul>
					<a class="uk-position-center-left uk-position-small uk-hidden-hover" href="#" data-uk-slidenav-previous data-uk-slider-item="previous"></a>
					<a class="uk-position-center-right uk-position-small uk-hidden-hover" href="#" data-uk-slidenav-next data-uk-slider-item="next"></a>
				</div>
			</div>
		</div>

        <div class="uk-card uk-margin">
            <div class="uk-flex-middle sc-padding sc-padding-medium-ends uk-grid-small" data-uk-grid>
                <div class="uk-flex-1">
                    <h3 class="uk-card-title">Data Master Material Produk</h3>
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
                                <label for="sc-dt-col-1">Jenis Material</label>
                            </div>
                            <div class="uk-margin-small">
                                <input type="checkbox" name="check_2" class="hide-column" data-column="2" value="2"  checked>
                                <label for="sc-dt-col-1">Kebutuhan</label>
                            </div>
                            <div class="uk-margin-small">
                                <input type="checkbox" name="check_3" class="hide-column" data-column="3" value="2"  checked>
                                <label for="sc-dt-col-1">Satuan</label>
                            </div>
                            <div class="uk-margin-small">
                                <input type="checkbox" name="check_4" class="hide-column" data-column="4" value="4"  checked>
                                <label for="sc-dt-col-1">Suplier</label>
                            </div>
                            <div class="uk-margin-small">
                                <input type="checkbox" name="check_5" class="hide-column" data-column="5" value="5"  checked>
                                <label for="sc-dt-col-1">Catatan</label>
                            </div>
                            <div class="uk-margin-small">
                                <input type="checkbox" name="check_6" class="hide-column" data-column="6" value="6"  checked>
                                <label for="sc-dt-col-3">Tanggal Input</label>
                            </div>
                            <div class="uk-margin-small">
                                <input type="checkbox" name="check_7" class="hide-column" data-column="7" value="7"  checked>
                                <label for="sc-dt-col-4">Aksi</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr class="uk-margin-remove">
            <div class="uk-card-body">
                <table id="material-product-table" class="material-product-table uk-table uk-table-striped dt-responsive">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Jenis Material</th>
                            <th>Kebutuhan</th>
                            <th>Satuan</th>
                            <th>Suplier</th>
                            <th>Catatan</th>
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
    <a href="#add-modal" data-uk-toggle class="sc-fab sc-fab-text sc-fab-success"><i class="mdi mdi-plus"></i>Tambah</a>
</div>

<div id="add-modal" data-uk-modal>
    <div class="uk-modal-dialog">
        <form style="margin-right: 20px;" enctype="multipart/form-data" id="add_form" role="form" method="POST" action="" >
        <button class="uk-modal-close-default" type="button" data-uk-close></button>
        <div class="uk-modal-header">
            <h2 class="uk-modal-title">Input Data Material Produk</h2>
        </div>
        <div class="uk-modal-body">
            <div class="uk-grid" data-uk-grid="">
                <div class="uk-width-1-2@l">
                    <div class="uk-margin">
                        <label class="custom-form-label">Jenis Material<sup>*</sup></label>
                        <div class="uk-width-expand">
                            <select name="material_stock_id" onchange="return getMaterialUnits(this.value);" required
                                    id="material_stock_id" class="uk-select"
                                    data-sc-select2='{"placeholder": "Pilih Kategori", "allowClear": true }' required>
                                <option value="0" >Pilih Jenis Material</option>
                                @foreach ($materialStock as $item)
                                    <option
                                        value="{{ $item->id }}">{{ $item->hasMaterialItem->hasProductMaterial->name }}
                                        - {{ $item->hasMaterialItem->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="uk-margin">
                        <label>Jumlah Kebutuhan<sup>*</sup></label>
                        <input type="text" name="qty" required class="uk-input" data-sc-input>
                    </div>
                    <div class="uk-margin">
                        <label>Satuan<sup>*</sup></label>
                        <input type="text" class="material-units" required class="uk-input" data-sc-input>
                    </div>
                </div>
                <div class="uk-width-1-2@l">
                    <div class="uk-margin">
                        <div class="uk-margin">
                            <textarea name="note" class="uk-textarea sc-js-autosize" rows="3" placeholder="Notes" data-sc-input></textarea>
                        </div>
                    </div>
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
<div id="edit-modal" data-uk-modal>
    <div class="uk-modal-dialog">
        <button class="uk-modal-close-default" type="button" data-uk-close></button>
        <div class="uk-modal-header">
            <h2 class="uk-modal-title">Detail Material Stock</h2>
        </div>
        <form  enctype="multipart/form-data" id="edit_form" role="form" method="POST" action="" >
        <div class="uk-modal-body">
            <!-- TODO-007 - Detail Customer Here -->
            <div class="uk-grid" data-uk-grid="">
                <input type="hidden" name="edit-material-product-id"  />
                <div class="uk-width-1-2@l">
                    <div class="uk-margin">
                        <label class="custom-form-label">Jenis Material<sup>*</sup></label>
                        <div class="uk-width-expand">
                            <select name="material_stock_id" onchange="return getMaterialUnits(this.value);" required id="material_stock_id" class="uk-select" data-sc-select2='{"placeholder": "Pilih Kategori", "allowClear": true }' required>
                                <option value="0" >Pilih Jenis Material</option>
                                @foreach ($materialStock as $item)
                                    <option
                                        value="{{ $item->id }}">{{ $item->hasMaterialItem->hasProductMaterial->name }}
                                        - {{ $item->hasMaterialItem->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="uk-margin">
                        <label>Jumlah Kebutuhan<sup>*</sup></label>
                        <input type="text" name="qty" required class="uk-input" data-sc-input>
                    </div>
                    <div class="uk-margin">
                        <label>Satuan<sup>*</sup></label>
                        <input type="text" class="material-units" required class="uk-input" data-sc-input>
                    </div>
                </div>
                <div class="uk-width-1-2@l">
                    <div class="uk-margin">
                        <div class="uk-margin">
                            <textarea name="note" class="uk-textarea sc-js-autosize" rows="3" placeholder="Notes" data-sc-input></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <br>
        </div>

            <div class="uk-modal-footer uk-text-right">
            <form action="" style="width: 100px;">
                <a id="sc-js-modal-confirm" style="margin-right: 66%;" class="delete-material-products uk-text-left sc-button sc-button-danger sc-js-button-wave-light" href="#">Hapus</a>
            </form>
            <button class="sc-button sc-button-flat sc-button-flat-danger uk-modal-close" type="button">Batal</button>
            <button class="sc-button" type="submit">Simpan</button>
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
            url: '/material-products-s/{{ $product->id }}/' + id,
            success: function (data) {
                var status = data.data.status == 1 ? 'Aktif' : 'Tidak aktif';

                //Set up data for edit modal
                $("input[name=edit-material-product-id]").val(data.data.id);
                $("select[name=material_stock_id]").val(data.data.material_stock_id).change();
                $("input[name=qty]").val(data.data.qty);
                $("textarea[name=note]").val(data.data.note);

                $(".material-units").empty().val(data.data.has_material_stock.has_unit.name).prop('disabled', true);

                if (data.data.status <= 0) {
                    $('.switchery').click();
                }

                //Set up credentials for edit and delete action...
                $(".delete-material-products").attr('data-id', id);
            },
            error: function (data) {
                UIkit.modal.alert(data.responseJSON.message).then(function () {

                });
            }
        });
    }

    function getMaterialUnits(id)
    {
        if (id < 0 || id == null) {
            UIkit.modal.alert('ID kosong').then(function () {

            });
        }

        $.ajax({
            type: "GET",
            url: '/get-material-unit/' + id,
            success: function (data) {
                //Set up data for edit modal
                if (data.status == true) {
                    $(".material-units").empty().val(data.data).prop('disabled', true);
                } else {
                    $(".material-units").val('');
                }
            },
            error: function (data) {
                $(".material-units").val('');
            }
        });
    }

	$(document).ready(function () {
		$('#pdev').addClass("sc-page-active");

        // Initialize DataTable
        var table = $('#material-product-table').DataTable({
            processing: true,
            serverSide: true,
            retrieve: true,
            pageLength: 10,
            ajax: "{{ route('material-products', $product->id) }}",
            columns: [
                {data: 'id', name: 'id', title: 'ID'},
                {data: 'alias_material_item', name: 'hasMaterialStock.hasMaterialItem.name', title: 'Jenis Material'},
                {data: 'qty', name: 'qty', title: 'Kebutuhan'},
                {data: 'alias_unit', name: 'hasUnit.name', title: 'Satuan'},
                {data: 'alias_supplier', name: 'hasMaterialStock.hasSupplier.company_name', title: 'Suplier'},
                {data: 'note', name: 'note', title: 'Catatan'},
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
        $('.delete-material-products').on('click', function (e) {
			UIkit.modal.confirm('Apakah anda yakin akan menghapus data ini ?').then(function () {
                e.preventDefault();

                var params = {
                    _token: '{{ csrf_token() }}',
                    id: $(".delete-material-products").attr('data-id'),
                    product_id: '{{ $product->id }}'
                }

                $.ajax({
                    type: "DELETE",
                    url: "{{ route('material-products.delete') }}",
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

        //Edit action
        $('#edit_form').submit(function(event) {
            event.preventDefault();

            var id = $("input[name=edit-material-product-id]").val();

            var formDataE = new FormData(this);
            formDataE.append('_token', "{{ csrf_token() }}");
            formDataE.append('product_id', "{{ $product->id }}");

            $.ajax({
                type: 'POST',
                url: "/material-products/" + id,
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

            var formData = new FormData(this);
            formData.append('_token', '{{ csrf_token() }}');
            formData.append('product_id', "{{ $product->id }}");

            $.ajax({
                type: 'POST',
                url: "{{ route('material-products.add') }}",
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
