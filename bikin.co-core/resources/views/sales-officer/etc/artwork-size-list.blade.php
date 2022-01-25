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
                    <h5>Pada halaman ini terdapat data master ukuran artwork dari Bikin-co</h5>
                    <p>Anda dapat menambah, mengedit dan menghapus data ukuran artwork kebutuhan Anda.</p>
                </div>
            </div>
        </div>

        <div class="uk-card uk-margin">
            <div class="uk-flex-middle sc-padding sc-padding-medium-ends uk-grid-small" data-uk-grid>
                <div class="uk-flex-1">
                    <h3 class="uk-card-title">Data Master Ukuran Artwork</h3>
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
                                <label for="sc-dt-col-1">Artwork</label>
                            </div>
                            <div class="uk-margin-small">
                                <input type="checkbox" name="check_2" class="hide-column" data-column="2" value="2"  checked>
                                <label for="sc-dt-col-2">Tipe Ukuran</label>
                            </div>
                            <div class="uk-margin-small">
                                <input type="checkbox" name="check_3" class="hide-column" data-column="3" value="3"  checked>
                                <label for="sc-dt-col-3">Ukuran</label>
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
                <table id="artwork-size-table" class="artwork-size-table uk-table uk-table-striped dt-responsive">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tipe Ukuran</th>
                            <th>Ukuran</th>
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
    <a href="#" onclick="$('#add_form').trigger('reset');$('select[name=artwork_id]').val('').change();$('.size-section').show();$('.detail-size-section').show();$('.custom-section').hide();$('.detail-custom-section').hide();" class="sc-fab sc-fab-text sc-fab-success" data-uk-toggle="target: #add-modal"><i class="mdi mdi-plus"></i>Tambahkan</a>
</div>

<div id="add-modal" data-uk-modal>
    <div class="uk-modal-dialog">
        <button class="uk-modal-close-default" type="button" data-uk-close></button>
        <div class="uk-modal-header">
            <h2 class="uk-modal-title">Input Data Ukuran Artwork</h2>
        </div>
        <form style="margin-right: 20px;" enctype="multipart/form-data" id="add_form" role="form" method="POST" action="" >
            <div class="uk-modal-body">

                <br>
                <div>
                    <label>Tipe Ukuran<sup>*</sup></label> <br>
                    <input class="sc-switch-input custom-size" onchange="return changeSize('custom-size', 'size-section', 'custom-section');" id="switch-css" type="checkbox" name="is_custom" value="1" />
                    <label for="switch-css" class="sc-switch-label">
                        <span class="sc-switch-toggle-off">Ukuran Tetap</span>
                        <span class="sc-switch-toggle-on">Kastem Dimensi</span>
                    </label>
                </div>
                <div class="uk-margin size-section">
                    <label>Size<sup>*</sup></label>
                    <input type="text" name="size" class="uk-input" data-sc-input>
                </div>
                <div class="custom-section" style="width: 50%;">
                    <div class="uk-margin" style="float: left;">
                        <label>Panjang</label>
                        <input type="number" name="width" class="uk-input" data-sc-input>
                    </div>
                    <div class="uk-margin" style="float: left;margin: 0px !important;">
                        <label>Lebar</label>
                        <input type="number" name="height" class="uk-input" data-sc-input>
                    </div>
                </div>
                <br style="clear:both;">
                <div>
                    <label>Status<sup>*</sup></label> <br>
                    <input type="checkbox" name="status" value="1" data-sc-switchery checked /><label class="uk-margin-small-left">Aktif / Non Aktif</label>
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
        <h2 class="uk-modal-title">Detail Ukuran Artwork</h2>
        <form  enctype="multipart/form-data" id="edit_form" role="form" method="POST" action="" >
            <input type="hidden" name="edit-artwork-size-id" />
            <div class="uk-modal-body">
                <div class="uk-grid" data-uk-grid="">
                    <div class="uk-width-1-1@l">
                        <div class="uk-grid" data-uk-grid>
                            <div class="uk-width-1-2@l uk-width-1-1@s uk-padding-remove">
                                <ul class="uk-list">
                                    <li class="sc-sidebar-menu-heading custom-list-divider"><span class="sc-text-semibold">Detail Ukuran Artwork</span></li>
                                </ul>
                                <br>
                                <div class="uk-width-1-1@l uk-width-1-1@s">

                                    <br>
                                    <div>
                                        <label>Tipe Ukuran<sup>*</sup></label> <br>
                                        <input class="sc-switch-input detail-custom-size" onchange="return changeSize('detail-custom-size', 'detail-size-section', 'detail-custom-section');" id="eswitch-css" type="checkbox" name="detail_is_custom" value="1" />
                                        <label for="eswitch-css" class="sc-switch-label">
                                            <span class="sc-switch-toggle-off">Ukuran Tetap</span>
                                            <span class="sc-switch-toggle-on">Kastem Dimensi</span>
                                        </label>
                                    </div>
                                    <div class="uk-margin detail-size-section">
                                        <label>Size<sup>*</sup></label>
                                        <input type="text" name="size" class="uk-input" data-sc-input>
                                    </div>
                                    <div class="detail-custom-section" style="width: 50%;">
                                        <div class="uk-margin" style="float: left;">
                                            <label>Panjang</label>
                                            <input type="number" name="width" class="uk-input" data-sc-input>
                                        </div>
                                        <div class="uk-margin" style="float: left;margin: 0px !important;">
                                            <label>Lebar</label>
                                            <input type="number" name="height" class="uk-input" data-sc-input>
                                        </div>
                                    </div>
                                </div>
                                <br style="clear:both;">
                                <div class="uk-width-1-1@l uk-width-1-1@s">
                                    <div>
                                        <label for="subcategory-stats">Status<sup>*</sup></label><br>
                                        <input type="checkbox" name="detail-status" value="1" data-sc-switchery checked /><label class="uk-margin-small-left">Aktif / Nonaktif</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
            </div>
            <div class="uk-grid" data-uk-grid>
                <form action="" style="width: 100px;">
                    <div class="uk-width-1-2@l">
                        <button class="sc-button sc-button-danger delete-artwork-size" type="button">Hapus</button>
                    </div>
                </form>
                <div class="uk-width-1-2@l">
                    <div class="uk-text-right">
                        <button class="sc-button sc-button-flat sc-button-flat-danger uk-modal-close">Batalkan</button>
                        <button class="sc-button sc-button-outline-primary" type="submit" data-button-mode="light">Simpan</button>
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
            url: 'artwork-size/' + id,
            success: function (data) {
                var status = data.data.status == 1 ? 'Aktif' : 'Tidak aktif';

                //Set up data for edit modal
                $("input[name=edit-artwork-size-id]").val(data.data.id);
                $("select[name=artwork_id]").val(data.data.artwork_id).change();

                if (data.data.is_custom == 1) {
                    console.log('tetap');
                    $("input[name=size]").val(data.data.size);
                } else {
                    console.log('kastem');
                    $("input[name=width]").val(data.data.width);
                    $("input[name=height]").val(data.data.height);
                }

                // changeSize('detail-custom-size', 'detail-size-section', 'detail-custom-section');
                $('input[name=width]').prop('required', true);
                $('input[name=height]').prop('required', true);
                $('input[name=size]').prop('required', false);

                $(".detail-size-section").hide();
                $(".detail-custom-section").show();

                if (data.data.status <= 0) {
                    $('.switchery').click();
                }

                //Set up credentials for edit and delete action...
                $(".delete-artwork-size").attr('data-id', id);
            },
            error: function (err) {

            }
        });
    }

    function changeSize(mainElem, opt1, opt2)
    {
        var id = $("." + mainElem + ":checked").val();

        alert(id);

        if (id == 1) {
            $('input[name=width]').prop('required', true);
            $('input[name=height]').prop('required', true);
            $('input[name=size]').prop('required', false);

            $("." + opt1).hide();
            $("." + opt2).show();
        } else {
            $('input[name=size]').prop('required', true);
            $('input[name=width]').prop('required', false);
            $('input[name=height]').prop('required', false);

            $("." + opt1).show();
            $("." + opt2).hide();
        }
    }

	$(document).ready(function () {
		$('#pdev').addClass("sc-page-active");

        $(".custom-section").hide();
        $(".detail-custom-section").hide();

        // Initialize DataTable
        var table = $('#artwork-size-table').DataTable({
            processing: true,
            serverSide: true,
            retrieve: true,
            pageLength: 10,
            ajax: "{{ route('artwork-size') }}",
            columns: [
                {data: 'id', name: 'id', title: 'ID'},
                {data: 'alias_size_type', name: 'id', title: 'Tipe Ukuran', orderable: false, searchable: false},
                {data: 'alias_size', name: 'id', title: 'Ukuran', orderable: false, searchable: false},
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
        $('.delete-artwork-size').on('click', function (e) {
			UIkit.modal.confirm('Apakah anda yakin akan menghapus data ini ?').then(function () {
                e.preventDefault();

                var params = {
                    _token: "{{ csrf_token() }}",
                    id: $(".delete-artwork-size").attr('data-id'),
                }

                $.ajax({
                    type: "DELETE",
                    url: "{{ route('artwork-size.delete') }}",
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

            var id = $("input[name=edit-artwork-size-id]").val();
            var status = $("input[name=detail-status]:checked").val() == 1 ? 1 : 0;
            var is_custom = $("input[name=detail_is_custom]:checked").val() == 1 ? 1 : 0;



            var formDataE = new FormData(this);
            formDataE.append('_token', "{{ csrf_token() }}");
            formDataE.append('status', status);
            formDataE.append('is_custom', is_custom);

            $.ajax({
                type: 'POST',
                url: "artwork-size/" + id,
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
            var is_custom = $("input[name=is_custom]:checked").val() == 1 ? 1 : 0;

            var formData = new FormData(this);
            formData.append('_token', '{{ csrf_token() }}');
            formData.append('status', status);
            formData.append('is_custom', is_custom);

            $.ajax({
                type: 'POST',
                url: "{{ route('artwork-size.add') }}",
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
