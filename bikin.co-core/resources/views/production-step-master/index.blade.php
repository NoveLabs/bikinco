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
                    <h5>Pada halaman ini terdapat data step master produk dari Bikin-co</h5>
                    <p>Anda dapat menambah, mengedit dan menghapus data kategori sesuai kebutuhan Anda.</p>
                </div>
            </div>
        </div>
        
        <div class="uk-card uk-margin">
            <div class="uk-flex-middle sc-padding sc-padding-medium-ends uk-grid-small" data-uk-grid>
                <div class="uk-flex-1">
                    <h3 class="uk-card-title">Data Step Master</h3>
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
                                <label for="sc-dt-col-1">Step Title</label>
                            </div>
                            <div class="uk-margin-small">
                                <input type="checkbox" name="check_2" class="hide-column" data-column="2" value="2"  checked>
                                <label for="sc-dt-col-2">Step Note</label>
                            </div>
                            <div class="uk-margin-small">
                                <input type="checkbox" name="check_4" class="hide-column" data-column="3" value="3"  checked>
                                <label for="sc-dt-col-4">Aksi</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr class="uk-margin-remove">
            <div class="uk-card-body">
                <table id="production_step_master-table" class="production_step_master-table uk-table uk-table-striped dt-responsive">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Title</th>
                            <th>Step Note</th>
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
    <a href="#product_step_master-add-modal" onclick="$('#uplaod_form').trigger('reset');" data-uk-toggle class="sc-fab sc-fab-text sc-fab-success"><i class="mdi mdi-plus"></i>Tambah</a>
</div>

<div id="product_step_master-add-modal" data-uk-modal>
    <div class="uk-modal-dialog">
        <form enctype="multipart/form-data" id="input_form" role="form" method="POST" action="">
        <button class="uk-modal-close-default" type="button" data-uk-close></button>
        <div class="uk-modal-header">
            <h2 class="uk-modal-title">Input Data Step Master</h2>
        </div>
        <div class="uk-modal-body">
            <div class="uk-margin">
                <label>Title<sup>*</sup></label>
                <input type="text" name="step_title" required class="uk-input" data-sc-input>
            </div>
            <div>
                <label>Step Note</label><sup>*</sup><br>
                <textarea type="text" name="step_description" required class="uk-input" style=" width: 800px;
  height: 150px;"></textarea>
                <input type="hidden" name="category_id" value="{{ $dataStepMaster }}">
            </div>
        </div>
        <div class="uk-modal-footer uk-text-right">
            <button class="sc-button sc-button-flat sc-button-flat-danger uk-modal-close" type="button">Batal</button>
            <button class="sc-button add-categories" type="submit">Tambah</button>
        </div>
        </form>
    </div>
</div>
<!-- Add Modal - End Section -->

<!-- Edit Modal -->
<div id="detail-stepmaster-modal" data-uk-modal>
    <div class="uk-modal-dialog">
        <button class="uk-modal-close-default" type="button" data-uk-close></button>
        <div class="uk-modal-header">
            <h2 class="uk-modal-title">Detail Kategori</h2>
        </div>
        <form  enctype="multipart/form-data" id="edit_form" role="form" method="POST" action="" >
           <div class="uk-modal-body">
            <div class="uk-margin">
                <label>Title<sup>*</sup></label>
                <input type="text" name="edit_step_title"id="edit_step_title" required class="uk-input" data-sc-input>
            </div>
            <div>
                <label>Step Note</label><sup>*</sup><br>
                <textarea type="text" name="edit_step_description" id="edit_step_description" required class="uk-input" style=" width: 800px;
                height: 150px;"></textarea>
                <input type="hidden" name="edit_category_id" value="" id="edit_category_id">
                <input type="hidden" name="edit_id" value="" id="edit_id">
            </div>
        </div>
        
        <div class="uk-modal-footer uk-text-right">
            <form action="" style="width: 100px;">
                <a id="sc-js-modal-confirm" style="margin-right: 66%;" class="delete-stepmaster uk-text-left sc-button sc-button-danger sc-js-button-wave-light" href="#">Hapus</a>
            </form>
            <button class="sc-button sc-button-flat sc-button-flat-danger uk-modal-close" type="button">Batal</button>
            <button class="sc-button edit-categories" type="submit">Simpan</button>
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
        UIkit.modal($("#detail-stepmaster-modal")).show();

        $.ajax({
            type: "GET",
            url: '/product_step_master/getData/' + id,
            success: function (data) {
                console.log(data);
                $("input[name=edit_id]").val(data.data.id);
                $("input[name=edit_step_title]").val(data.data.step_title).addClass('sc-input-filled');
                $("textarea[name=edit_step_description]").val(data.data.step_description).addClass('sc-input-filled');
                $("input[name=edit_category_id]").val(data.data.category_id);
                //Set up credentials for edit and delete action...

                 $(".delete-stepmaster").attr('data-id', id);
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
        var table = $('#production_step_master-table').DataTable({
            processing: true,
            serverSide: true,
            retrieve: true,
            pageLength: 10,
            ajax: "{{ route('product_step_master.single', $dataStepMaster) }}",
            columns: [
                {data: 'id', name: 'id', title: 'ID'},
                {data: 'step_title', name: 'step_title', title: 'Title'},
                {data: 'step_description', name: 'step_description', title: 'Step Description'},
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
        $('.delete-stepmaster').on('click', function (e) {
			UIkit.modal.confirm('Apakah anda yakin akan menghapus data ini ?').then(function () {
                e.preventDefault();

                var params = {
                    _token: '{{ csrf_token() }}',
                    id: $(".delete-stepmaster").attr('data-id'),
                }

                $.ajax({
                    type: "DELETE",
                    url: "{{ route('product_step_master.delete') }}",
                    data: params,
                    async: false,
                    success: function (data) {
                        UIkit.modal.alert(data.message).then(function () {
                            
                        });

                        table.draw();
                        UIkit.modal($("#detail-stepmaster-modal")).hide();
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

        $('#edit_form').submit(function(event) {
            event.preventDefault();
            
            var id = $("#edit_id").val();
            var formDataE = new FormData(this);
            formDataE.append('_token', '{{ csrf_token() }}');
            formDataE.append('step_title', $("#edit_step_title").val());
            formDataE.append('step_description', $("#edit_step_description").val());
            formDataE.append('category_id', $("#edit_category_id").val());
            formDataE.append('id', $("#edit_id").val());

            $.ajax({
                type: 'POST',
                url: "product_step_master/" + id,
                data: formDataE,
                cache: false,
                contentType: false,
                processData: false,
                success: (data) => {
                    UIkit.modal.alert(data.message).then(function () {
                        
                    });

                    table.draw();
                    UIkit.modal($("#detail-stepmaster-modal")).hide();
                },
                error: function (data) {
                    UIkit.modal.alert(data.responseJSON.message).then(function () {
                        
                    })
                }
            });
        });

        //Add action
        $('#input_form').submit(function(event){
            event.preventDefault();


            var formData = new FormData(this);
            formData.append('_token', '{{ csrf_token() }}');
            formData.append('step_title', $("input[name=step_title]").val());
            formData.append('step_description', $("[name='step_description']").val());
            formData.append('category_id', $("[name='category_id']").val());

            $.ajax({
                type: 'POST',
                url: "{{ route('product_step_master.add') }}",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: (data) => {
                    UIkit.modal.alert(data.message).then(function () {

                    });

                    table.draw();
                    UIkit.modal($("#product_step_master-add-modal")).hide();
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
        let drEvent = $('#new-categories-file').dropify();

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
        let editEvent = $('#edit-categories-file').dropify();

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