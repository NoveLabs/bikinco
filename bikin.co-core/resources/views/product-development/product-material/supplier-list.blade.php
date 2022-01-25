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
                    <h5>Pada halaman ini terdapat data master suplier dari Bikin-co</h5>
                    <p>Anda dapat menambah, mengedit dan menghapus data suplier sesuai kebutuhan Anda.</p>
                </div>
            </div>
        </div>
        
        <div class="uk-card uk-margin">
            <div class="uk-flex-middle sc-padding sc-padding-medium-ends uk-grid-small" data-uk-grid>
                <div class="uk-flex-1">
                    <h3 class="uk-card-title">Data Master Suplier</h3>
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
                                <label for="sc-dt-col-1">Nama PIC</label>
                            </div>
                            <div class="uk-margin-small">
                                <input type="checkbox" name="check_2" class="hide-column" data-column="2" value="2"  checked>
                                <label for="sc-dt-col-1">Mobile Phone PIC</label>
                            </div>
                            <div class="uk-margin-small">
                                <input type="checkbox" name="check_3" class="hide-column" data-column="3" value="3"  checked>
                                <label for="sc-dt-col-1">Nama Perusahaan</label>
                            </div>
                            <div class="uk-margin-small">
                                <input type="checkbox" name="check_4" class="hide-column" data-column="4" value="4"  checked>
                                <label for="sc-dt-col-1">Kontak Perusahaan</label>
                            </div>
                            <div class="uk-margin-small">
                                <input type="checkbox" name="check_5" class="hide-column" data-column="5" value="5"  checked>
                                <label for="sc-dt-col-1">Alamat Perusahaan</label>
                            </div>
                            <div class="uk-margin-small">
                                <input type="checkbox" name="check_6" class="hide-column" data-column="6" value="6"  checked>
                                <label for="sc-dt-col-2">Status</label>
                            </div>
                            <div class="uk-margin-small">
                                <input type="checkbox" name="check_7" class="hide-column" data-column="7" value="7"  checked>
                                <label for="sc-dt-col-3">Tanggal Input</label>
                            </div>
                            <div class="uk-margin-small">
                                <input type="checkbox" name="check_8" class="hide-column" data-column="8" value="8"  checked>
                                <label for="sc-dt-col-4">Aksi</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr class="uk-margin-remove">
            <div class="uk-card-body">
                <table id="suppliers-table" class="suppliers-table uk-table uk-table-striped dt-responsive">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama PIC</th>
                            <th>Mobile Phone PIC</th>
                            <th>Nama Perusahaan</th>
                            <th>Kontak Perusahaan</th>
                            <th>Alamat Perusahaan</th>
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
    <a href="#add-modal" onclick="$('#add_form').trigger('reset');" data-uk-toggle class="sc-fab sc-fab-text sc-fab-success"><i class="mdi mdi-plus"></i>Tambah</a>
</div>

<div id="add-modal" data-uk-modal>
    <div class="uk-modal-dialog">
        <form style="margin-right: 20px;" enctype="multipart/form-data" id="add_form" role="form" method="POST" action="" >
        <button class="uk-modal-close-default" type="button" data-uk-close></button>
        <div class="uk-modal-header">
            <h2 class="uk-modal-title">Input Data Suplier</h2>
        </div>
        <div class="uk-modal-body">
            <div class="uk-grid" data-uk-grid="">
                <div class="uk-width-1-2@l">
                    <div class="uk-margin">
                        <label>Nama PIC<sup>*</sup></label>
                        <input type="text" name="pic_name" required class="uk-input" data-sc-input>
                    </div>
                    <div class="uk-margin">
                        <label>Mobile phone PIC<sup>*</sup></label>
                        <input type="number" name="pic_phone_number" required class="uk-input" data-sc-input>
                    </div>
                    <div>
                        <label>Status Kategori</label><sup>*</sup><br>
                        <input type="checkbox" name="status" value="1" data-sc-switchery checked /><label class="uk-margin-small-left">Aktif / Non Aktif</label>
                    </div>
                </div>
                <div class="uk-width-1-2@l">
                    <div class="uk-margin">
                        <label>Nama Perusahaan<sup>*</sup></label>
                        <input type="text" name="company_name" required class="uk-input" data-sc-input>
                    </div>
                    <div class="uk-margin">
                        <label>Kontak Perusahaan<sup>*</sup></label>
                        <input type="number" name="company_contact" required class="uk-input" data-sc-input>
                    </div>
                    <div class="uk-margin">
                        <label>Alamat Perusahaan<sup>*</sup></label>
                        <br/>
                        <textarea name="company_address" required cols="40" rows="5"></textarea>
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
            <h2 class="uk-modal-title">Detail Suplier</h2>
        </div>
        <form  enctype="multipart/form-data" id="edit_form" role="form" method="POST" action="" >
        <div class="uk-modal-body">
            <!-- TODO-007 - Detail Customer Here -->
            <div class="uk-grid" data-uk-grid="">
                <input type="hidden" name="edit-suppliers-id"  />
                <div class="uk-width-1-2@l">
                    <div class="custom-detail-list-box">
                        <ul class="uk-list">
                            <li class="sc-sidebar-menu-heading custom-list-divider"><span>Detail</span></li>
                        </ul>
                        <ul class="uk-list custom-inline-list">
                            <div class="uk-margin">
                                <label>Nama PIC<sup>*</sup></label>
                                <input type="text" name="pic_name" required class="uk-input" data-sc-input>
                            </div>
                            <div class="uk-margin">
                                <label>Mobile phone PIC<sup>*</sup></label>
                                <input type="number" name="pic_phone_number" required class="uk-input" data-sc-input>
                            </div>
                            <div>
                                <label>Status<sup>*</sup></label> <br>
                                <input type="checkbox" name="detail-status" class="detail-categories-status" value="1" data-sc-switchery checked /><label class="uk-margin-small-left">Aktif / Non Aktif</label>
                            </div>
                        </ul>
                    </div>
                </div>
                <div class="uk-width-1-2@l">
                    <div class="uk-margin">
                        <label>Nama Perusahaan<sup>*</sup></label>
                        <input type="text" name="company_name" required class="uk-input" data-sc-input>
                    </div>
                    <div class="uk-margin">
                        <label>Kontak Perusahaan<sup>*</sup></label>
                        <input type="number" name="company_contact" required class="uk-input" data-sc-input>
                    </div>
                    <div class="uk-margin">
                        <label>Alamat Perusahaan<sup>*</sup></label>
                        <br/>
                        <textarea name="company_address" required cols="40" rows="5"></textarea>
                    </div>
                </div>
            </div>
            <br>
        </div>
        
        <div class="uk-modal-footer uk-text-right">
            <form action="" style="width: 100px;">
                <a id="sc-js-modal-confirm" style="margin-right: 66%;" class="delete-suppliers uk-text-left sc-button sc-button-danger sc-js-button-wave-light" href="#">Hapus</a>
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
            url: 'suppliers/' + id,
            success: function (data) {
                var status = data.data.status == 1 ? 'Aktif' : 'Tidak aktif';

                //Set up data for edit modal
                $("input[name=edit-suppliers-id]").val(data.data.id);
                $("input[name=pic_name]").val(data.data.pic_name);
                $("input[name=pic_phone_number]").val(data.data.pic_phone_number);
                $("input[name=company_name]").val(data.data.company_name);
                $("input[name=company_contact]").val(data.data.company_contact);
                $("textarea[name=company_address]").val(data.data.company_address);

                if (data.data.status <= 0) {
                    $('.switchery').click();
                }

                //Set up credentials for edit and delete action...
                $(".delete-suppliers").attr('data-id', id);
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
        var table = $('#suppliers-table').DataTable({
            processing: true,
            serverSide: true,
            retrieve: true,
            pageLength: 10,
            ajax: "{{ route('suppliers') }}",
            columns: [
                {data: 'id', name: 'id', title: 'ID Suplier'},
                {data: 'pic_name', name: 'pic_name', title: 'Nama PIC'},
                {data: 'pic_phone_number', name: 'pic_phone_number', title: 'Mobile Phone PIC'},
                {data: 'company_name', name: 'company_name', title: 'Nama Perusahaan'},
                {data: 'company_contact', name: 'company_contact', title: 'Kontak Perusahaan'},
                {data: 'company_address', name: 'company_address', title: 'Alamat Perusahaan'},
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
        $('.delete-suppliers').on('click', function (e) {
			UIkit.modal.confirm('Apakah anda yakin akan menghapus data ini ?').then(function () {
				e.preventDefault();

                var params = {
                    _token: '{{ csrf_token() }}',
                    id: $(".delete-suppliers").attr('data-id'),
                }

                $.ajax({
                    type: "DELETE",
                    url: "{{ route('suppliers.delete') }}",
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
            
            var id = $("input[name=edit-suppliers-id]").val();
            var status = $("input[name=detail-status]:checked").val() == 1 ? 1 : 0;

            var formDataE = new FormData(this);
            formDataE.append('_token', "{{ csrf_token() }}");
            formDataE.append('status', status);

            $.ajax({
                type: 'POST',
                url: "suppliers/" + id,
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
                url: "{{ route('suppliers.add') }}",
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