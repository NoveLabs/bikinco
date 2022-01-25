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
                    <h5>Pada halaman ini terdapat data Testimoni dari Bikin-co</h5>
                    <p>Anda dapat menambah, mengedit dan menghapus data kategori sesuai kebutuhan Anda.</p>
                </div>
            </div>
        </div>

        <div class="uk-card uk-margin">
            <div class="uk-flex-middle sc-padding sc-padding-medium-ends uk-grid-small" data-uk-grid>
                <div class="uk-flex-1">
                    <h3 class="uk-card-title">Data Testimoni</h3>
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
                                <label for="sc-dt-col-1">Company Name</label>
                            </div>
                            <div class="uk-margin-small">
                                <input type="checkbox" name="check_2" class="hide-column" data-column="2" value="2"  checked>
                                <label for="sc-dt-col-2">Testimony</label>
                            </div>
                            <div class="uk-margin-small">
                                <input type="checkbox" name="check_3" class="hide-column" data-column="3" value="3"  checked>
                                <label for="sc-dt-col-3">Rating</label>
                            </div>
                            <div class="uk-margin-small">
                                <input type="checkbox" name="check_4" class="hide-column" data-column="4" value="4"  checked>
                                <label for="sc-dt-col-4">Aksi</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr class="uk-margin-remove">
            <div class="uk-card-body">
                <table id="testimoni-table" class="testimoni-table uk-table uk-table-striped dt-responsive">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Company</th>
                            <th>Testimoni</th>
                            <th>Rating</th>
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
    <a href="#testimoni-add-modal" onclick="$('#upload_form').trigger('reset');" data-uk-toggle class="sc-fab sc-fab-text sc-fab-success"><i class="mdi mdi-plus"></i>Tambah</a>
</div>

<div id="testimoni-add-modal" data-uk-modal>
    <div class="uk-modal-dialog">
        <form enctype="multipart/form-data" id="upload_form" role="form" method="POST" action="">
        <button class="uk-modal-close-default" type="button" data-uk-close></button>
        <div class="uk-modal-header">
            <h2 class="uk-modal-title">Input Testimoni</h2>
        </div>
        <div class="uk-modal-body">
            <div class="uk-margin uk-width-1-1@l uk-width-1-1@s">
                <label>Company Name<sup>*</sup></label><br>
                <select name="company_name" id="company_name" class="uk-select">
                @foreach ($company as $value)
                    <option value="{{ $value->id }}"> {{ $value->company_name }}</option>
                @endforeach
                </select>

            </div>
            <div class="uk-margin uk-width-1-1">
            <label>Status Testimoni</label><sup>*</sup><br>
                <input type="checkbox" name="testimoni-status" value="1" data-sc-switchery checked /><label class="uk-margin-small-left">Aktif / Non Aktif</label>
            </div>
            <div class="uk-width-1-1@l uk-width-1-1@s">
                <label>Testimoni</label><sup>*</sup><br>
                <textarea class="uk-textarea" cols="30" rows="6" name="testimoni" id="testimoni"></textarea>
            </div>
            <br>
            <div class="uk-margin uk-width-1-1@l uk-width-1-1@s">
                <label for="">Tambahkan Rating<sup>*</sup></label>
                <!-- <input type="number" id="rating" name="rating" class="uk-input"> -->
                <div data-sc-raty name="rating" id="rating"></div>
            </div>
        </div>
        <div class="uk-modal-footer uk-text-right">
            <button class="sc-button sc-button-flat sc-button-flat-danger uk-modal-close" type="button">Batal</button>
            <button class="sc-button add-testimoni" type="submit">Tambah</button>
        </div>
        </form>
    </div>
</div>
<!-- Add Modal - End Section -->

<!-- Edit Modal -->
<div id="detail-testimoni-modal" data-uk-modal>
    <div class="uk-modal-dialog">
        <button class="uk-modal-close-default" type="button" data-uk-close></button>
        <div class="uk-modal-header">
            <h2 class="uk-modal-title">Detail Testimoni</h2>
        </div>
        <form  enctype="multipart/form-data" id="edit_upload_form" role="form" method="POST" action="" >
            <div class="uk-modal-body">
            <div class="uk-margin">
                <label>Company Name<sup>*</sup></label>
                <select name="detail-company-name" id="detail-company-name" class="uk-select">
                @foreach ($company as $value)
                    <option value="{{ $value->id }}"> {{ $value->company_name }}</option>
                @endforeach
                </select>
            </div>
            <div class="uk-margin uk-width-1-1">
            <label>Status Testimoni</label><sup>*</sup><br>
                <input type="checkbox" name="edit-testimoni-status" value="1" data-sc-switchery checked /><label class="uk-margin-small-left">Aktif / Non Aktif</label>
            </div>
            <div>
                <label>Testimoni</label><sup>*</sup><br>
                <textarea class="uk-textarea" cols="30" rows="6" name="detail-testimoni" id="detail-testimoni"></textarea>
            </div>
            <br>
            <div class="uk-margin" >
                <label>Rating<sup>*</sup></label>
                <ul class="uk-list">
                    <li>
                        <input type="radio" id="square-radio-1" name="square-radio" data-sc-icheck value="1">
                        <label for="square-radio-1"><span class="fa fa-star checked"></span></label>
                    </li>
                    <li>
                        <input type="radio" id="square-radio-2" name="square-radio"  data-sc-icheck value="2">
                        <label for="square-radio-2"><span class="fa fa-star checked"></span><span class="fa fa-star checked"></span></label>
                    </li>
                    <li>
                        <input type="radio" id="square-radio-3" name="square-radio" data-sc-icheck value="3">
                        <label for="square-radio-3"><span class="fa fa-star checked"></span><span class="fa fa-star checked"></span><span class="fa fa-star checked"></span></label>
                    </li>
                    <li>
                        <input type="radio" id="square-radio-4" name="square-radio"  data-sc-icheck value="4">
                        <label for="square-radio-4"><span class="fa fa-star checked"></span><span class="fa fa-star checked"></span><span class="fa fa-star checked"></span><span class="fa fa-star checked"></span></label>
                    </li>
                    <li>
                        <input type="radio" id="square-radio-5" name="square-radio" data-sc-icheck value="5">
                        <label for="square-radio-5"><span class="fa fa-star checked"></span><span class="fa fa-star checked"></span><span class="fa fa-star checked"></span><span class="fa fa-star checked"></span><span class="fa fa-star checked"></span></label>
                    </li>
                   
                </ul>
            </div>
            <input type="hidden" value="" name="edit-testimoni-id" id="edit-testimoni-id">
        </div>

        <div class="uk-modal-footer uk-text-right">
            <form action="" style="width: 100px;">
                <a id="sc-js-modal-confirm" style="margin-right: 66%;" class="delete-testimoni uk-text-left sc-button sc-button-danger sc-js-button-wave-light" href="#">Hapus</a>
            </form>
            <button class="sc-button sc-button-flat sc-button-flat-danger uk-modal-close" type="button">Batal</button>
            <button class="sc-button edit-testimoni" type="submit">Simpan</button>
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
        UIkit.modal($("#detail-testimoni-modal")).show();

        $.ajax({
            type: "GET",
            url: '{!! route('testimoni.detail', [':id']) !!}'.replace(':id',id),
            success: function (data) {
                var status = data.data.status == 1 ? 'Aktif' : 'Tidak aktif';

                //Set up data for edit modal
                $("input[name=edit-testimoni-id]").val(data.data.id);
                var value = data.data.rating;
                $('.sc-iradio').removeClass('checked');
                var $radios = $('input[name="square-radio"]');
                    if($radios.is(':checked') === false) {
                        $radios.filter('[value='+ data.data.rating +']').parent().addClass('checked');
                    }
                $("#detail-testimoni").val(data.data.testimony);
                $('#detail-company-name').empty();
                var html = '<option value="'+data.data.company_id+'">'+data.data.company_name+'</option>';
                $('#detail-company-name').append(html); 

                if (data.data.status <= 0) {
                    $('.switchery').click();
                }

                //Set up credentials for edit and delete action...
                $(".delete-testimoni").attr('data-id', id);
            },
            error: function (err) {

            }
        });

        $.ajax({
            type: "GET",
            url: '{!! route('company.allData', [':id']) !!}'.replace(':id',id),
            success: function(data) {

            for (i = 0; i < data.data.length; i++) {
                var html = '<option value="'+data.data[i].id+'">'+data.data[i].company_name+'</option>';
                $('#detail-company-name').append(html); 
            }
              
            }
        });
    }

	$(document).ready(function () {
		$('#pdev').addClass("sc-page-active");

        // $(".detail-testimoni").click(function(e) {
        //     var id = $(this).data('id');
        // });

        // Initialize DataTable
        var table = $('#testimoni-table').DataTable({
            processing: true,
            serverSide: true,
            retrieve: true,
            pageLength: 10,
            ajax: "{{ route('testimoni.index') }}",
            columns: [
                {data: 'id', name: 'id', title: 'ID '},
                {data: 'company_name', name: 'company_name', title: 'Company Name'},
                {data: 'testimony', name: 'testimony', title: 'Testimoni'},
                {data: 'rating', name: 'rating', title: 'Rating'},
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
        $('.delete-testimoni').on('click', function (e) {
			UIkit.modal.confirm('Apakah anda yakin akan menghapus data ini ?').then(function () {
                e.preventDefault();

                var params = {
                    _token: '{{ csrf_token() }}',
                    id: $(".delete-testimoni").attr('data-id'),
                }

                $.ajax({
                    type: "DELETE",
                    url: "{{ route('testimoni.delete') }}",
                    data: params,
                    async: false,
                    success: function (data) {
                        UIkit.modal.alert(data.message).then(function () {

                        });

                        table.draw();
                        UIkit.modal($("#detail-testimoni-modal")).hide();
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

            var id = $("input[name=edit-testimoni-id]").val();
            var status = $("#edit-testimoni-status:checked").val() == 1 ? 1 : 0;
            var rating = $('input[name="square-radio"]:checked').val();
            var formDataE = new FormData(this);
            formDataE.append('_token', "{{ csrf_token() }}");
            formDataE.append('company_id', $("#detail-company-name").val());
            formDataE.append('testimony', $("#detail-testimoni").val());
            formDataE.append('rating', rating);
            formDataE.append('status', status);

            $.ajax({
                type: 'POST',
                 url: '{!! route('testimoni.update', [':id']) !!}'.replace(':id',id),
                data: formDataE,
                cache: false,
                contentType: false,
                processData: false,
                success: (data) => {
                    UIkit.modal.alert(data.message).then(function () {

                    });

                    location.reload(); 
                    UIkit.modal($("#detail-testimoni-modal")).hide();
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
            var status = $("#testimoni-status:checked").val() == 1 ? 1 : 0;

            var formData = new FormData(this);
            formData.append('_token', '{{ csrf_token() }}');
            formData.append('company_id', $("#company_name").val());
            formData.append('testimony', $("#testimoni").val());
            formData.append('rating', $("input[name=score]").val());
            formData.append('status', status);

            $.ajax({
                type: 'POST',
                url: "{{ route('testimoni.add') }}",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: (data) => {
                    UIkit.modal.alert(data.message).then(function () {

                    });

                    location.reload(); 
                    
                    UIkit.modal($("#testimoni-add-modal")).hide();
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
        let drEvent = $('#new-testimoni-file').dropify();

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
        let editEvent = $('#edit-testimoni-file').dropify();

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
