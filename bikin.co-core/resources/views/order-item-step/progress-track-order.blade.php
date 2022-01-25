    @extends('layouts.altair_users')

@push('css-dropify')
    <link rel="stylesheet" href="{{ asset('assets/js/vendor/dropify/css/dropify.min.css') }}">
@endpush

@section('content')

 <div id="page_content" class="uk-height-1-1">

        <div class="scrum_board_overflow">
            <div id="scrum_board" class="uk-clearfix">
                <div>
                    <div class="scrum_column_heading_wrapper">
                        <div class="scrum_column_heading">  Poin Pengerjaan </div>

                    </div>
                    <div class="scrum_column">
                        <div id="scrum_column_todo">
                        @foreach ($dataStep0 as $value)
                            <div>
                                <div class="scrum_task critical">
                                    <h3 class="scrum_task_title"><a href="#step-{{ $value->id }}" data-uk-modal="{ center:true }">{{ $value->step_title }}</a></h3>
                                    <p class="scrum_task_description"> {{ $value->step_description }} </p>
                                    <p class="scrum_task_info"><span class="uk-text-muted">Role:</span>{{ $value->vendor_name }}</p>
                                </div>
                            </div>
                        @endforeach
                        </div>
                    </div>
                </div>
                <div>
                    <div class="scrum_column_heading_wrapper">
                        <div class="scrum_column_heading">Dikerjakan</div>
                    </div>
                    <div class="scrum_column">
                        <div id="scrum_column_inAnalysis">
                        @foreach ($dataStep1 as $value)
                            <div>
                                <div class="scrum_task minor">
                                    <h3 class="scrum_task_title"><a href="#step-{{ $value->id }}" onclick="getDataImageDikerjakan({{$value->id }})" data-uk-modal="{ center:true }">{{ $value->step_title }}</a></h3>
                                    <p class="scrum_task_description">{{ $value->step_description }}</p>
                                    <p class="scrum_task_info"><span class="uk-text-muted">Role:</span> {{ $value->vendor_name }}</p>
                                </div>
                            </div>
                        @endforeach
                        </div>
                    </div>
                </div>
                <div>
                    <div class="scrum_column_heading_wrapper">
                        <div class="scrum_column_heading">Diproses QC</div>
                    </div>
                    <div class="scrum_column">
                        <div id="scrum_column_inProgress">
                        @foreach ($dataStep2 as $value)
                            <div>
                                <div class="scrum_task critical">
                                    <h3 class="scrum_task_title"><a class="click_function" href="#step-{{ $value->id }}"  onclick="getDataImageQC({{$value->id }})"  data-uk-modal="{ center:true }">{{ $value->step_title }}</a></h3>
                                    <p class="scrum_task_description">{{ $value->step_description }}</p>
                                    <p class="scrum_task_info"><span class="uk-text-muted">Role:</span> {{ $value->vendor_name }}</p>
                                </div>
                            </div>
                        @endforeach
                        </div>
                    </div>
                </div>
                <div>
                    <div class="scrum_column_heading_wrapper">
                        <div class="scrum_column_heading">Selesai</div>
                    </div>
                    <div class="scrum_column">
                        <div id="scrum_column_done">
                        @foreach ($dataStep3 as $value)
                            <div>
                                <div class="scrum_task critical">
                                    <h3 class="scrum_task_title"><a href="#step-{{ $value->id }}"  onclick="getDataImageSelesai({{$value->id }})" data-uk-modal="{ center:true }">{{ $value->step_title }}</a></h3>
                                    <p class="scrum_task_description">{{ $value->step_description }}</p>
                                    <p class="scrum_task_info"><span class="uk-text-muted">Role:</span> {{ $value->vendor_name }}</p>
                                </div>
                            </div>
                        @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    @if( $params == 1 && $session_id == 3)
    @for ($i=0; $i < 1; $i++)
    <div class="md-fab-wrapper">
        <a class="md-fab md-fab-accent md-fab-wave" href="#new_task" onclick="updateDone({{ $dataStep3[$i]->order_item_id }})" data-uk-modal="{ center:true }">
            <i class="material-icons">done</i>
        </a>
    </div>
    @endfor
    @endif

@foreach ($dataStep0 as $value)
  <div class="uk-modal" id="step-{{ $value->id }}">
        <div class="uk-modal-dialog">
            <div class="uk-modal-header">
                <span class="uk-badge uk-badge-danger uk-float-right">SEGERA DIKERJAKAN</span>
            </div>
            <form class="uk-form-stacked" action="{{ route('order_item_step.step0') }}" method="post" enctype="multipart/form-data">
            @csrf
                <div class="uk-margin-medium-bottom">
                    <p class="uk-margin-small-bottom uk-text-muted">Judul</p>
                    <p class="uk-margin-remove uk-text-large">{{ $value->step_title }}</p>
                </div>
                <div class="uk-margin-medium-bottom">
                    <p class="uk-margin-small-bottom uk-text-muted">Keterangan</p>
                    <p class="uk-margin-remove">{{ $value->step_description }}</p>
                </div>
                <div class="uk-margin-medium-bottom">
                    <p class="uk-margin-small-bottom uk-text-muted">Tanggal Update</p>
                    <p class="uk-margin-remove">{{ $value->created_at }}</p>
                </div>
                <input type="hidden" name="id" value="{{ $value->id }}">
                <div class="uk-modal-footer uk-text-right">
                    <button type="button" class="md-btn md-btn-flat uk-modal-close md-btn-wave">Tutup</button>
                </div>
            </form>
        </div>
    </div>
@endforeach
@foreach ($dataStep1 as $value)
    <div class="uk-modal" id="step-{{ $value->id }}">
        <div class="uk-modal-dialog">
            <div class="uk-modal-header">
                <span class="uk-badge uk-badge-success uk-float-right">DIKERJAKAN</span>
            </div>
                <div class="uk-margin-medium-bottom">
                    <p class="uk-margin-small-bottom uk-text-muted">Judul</p>
                    <p class="uk-margin-remove uk-text-large">{{ $value->step_title }}</p>
                </div>
                <div class="uk-margin-medium-bottom">
                    <p class="uk-margin-small-bottom uk-text-muted">Keterangan</p>
                    <p class="uk-margin-remove">{{ $value->step_description }}</p>
                </div>
                <div class="md-card-content">
                    <div class="uk-slidenav-position" data-uk-slideshow="{animation:'scale',autoplay:true}" >
                    <ul class="uk-slideshow" id="img_carousel{{ $value->id }}">

                    </ul>

                    <a href="" class="uk-slidenav uk-slidenav-contrast uk-slidenav-previous" data-uk-slideshow-item="previous"></a>
                    <a href="" class="uk-slidenav uk-slidenav-contrast uk-slidenav-next parentSlider" data-uk-slideshow-item="next"></a>
                    <ul class="uk-dotnav uk-dotnav-contrast uk-position-bottom uk-flex-center" id="nomer_carousel{{ $value->id }}">

                    </ul>
                    </div>
                </div>
                <br>
                <div class="uk-margin-medium-bottom">
                    <p class="uk-margin-small-bottom uk-text-muted">Tanggal Update</p>
                    <p class="uk-margin-remove">{{ $value->tgl_update }}</p>
                </div>
                <hr>
                @if($session_id == 7)
                <div class="uk-margin-medium-bottom">
                    <div class="uk-width-medium-1-1">
                        <div class="md-card-content">
                            <h3 class="heading_a uk-margin-small-bottom">
                                Unggah foto
                            </h3>
                            <form enctype="multipart/form-data" method="post" action="{{ route('order_item_step.upload') }}" class="dropzone" id="dropzone">
                            @csrf
                            <input type="hidden" name="id" value="{{ $value->id }}">
                            </form>
                        </div>
                    </div>
                </div>
                @endif
                <hr>
                <span>Riwayat Proses</span>
                <div class="uk-grid uk-grid-divider" style="background-color: rgb(238, 238, 238);" data-uk-grid-margin>
                    <div class="uk-width-large-1-1 uk-width-medium-1-1">
                        <ul class="md-list" id="riwayat_vendor{{ $value->id }}">

                        </ul>
                    </div>
                </div>
                <hr>
                <div class="uk-modal-footer uk-text-right">
                    <button type="button" class="md-btn md-btn-flat uk-modal-close md-btn-wave">Tutup</button>
                </div>
        </div>
    </div>
@endforeach

@foreach ($dataStep2 as $value)
    <div class="uk-modal" id="step-{{ $value->id }}">
        <div class="uk-modal-dialog">
            <div class="uk-modal-header">
                <span class="uk-badge uk-badge-success uk-float-right">MENUNGGU QC</span>
            </div>

                <div class="uk-margin-medium-bottom">
                    <p class="uk-margin-small-bottom uk-text-muted">Judul</p>
                    <p class="uk-margin-remove uk-text-large">{{ $value->step_title }}</p>
                </div>
                <div class="uk-margin-medium-bottom">
                    <p class="uk-margin-small-bottom uk-text-muted">Keterangan</p>
                    <p class="uk-margin-remove">{{ $value->step_description }}</p>
                </div>
                <div class="md-card-content">
                    <div class="uk-slidenav-position" data-uk-slideshow="{animation:'scale',autoplay:true}">
                        <ul class="uk-slideshow" id="img_carousel_qc{{ $value->id }}">

                    	</ul>
                        <a href="" class="uk-slidenav uk-slidenav-contrast uk-slidenav-previous" data-uk-slideshow-item="previous"></a>
                        <a href="" class="uk-slidenav uk-slidenav-contrast uk-slidenav-next" data-uk-slideshow-item="next"></a>
                        <ul class="uk-dotnav uk-dotnav-contrast uk-position-bottom uk-flex-center" id="nomer_carousel_qc{{ $value->id }}">

                        </ul>
                    </div>
                </div>
                <br>
                <div class="uk-margin-medium-bottom">
                    <p class="uk-margin-small-bottom uk-text-muted">Tanggal Update</p>
                    <p class="uk-margin-remove">{{ $value->tgl_update }}</p>
                </div>
                <hr>
                <span>Riwayat Proses</span>
                <div class="uk-grid uk-grid-divider" style="background-color: rgb(238, 238, 238);" data-uk-grid-margin>
                    <div class="uk-width-large-1-1 uk-width-medium-1-1">
                        <ul class="md-list" id="riwayat_qc{{ $value->id }}">

                        </ul>
                    </div>
                </div>
                <hr>
                <form class="uk-form-stacked" enctype="multipart/form-data" method="post" action="">
                @csrf
                <input type="hidden" id="id_selesai" value="{{ $value->id }}">

                <div class="uk-modal-footer uk-text-right">
                    <button type="button" class="md-btn md-btn-flat uk-modal-close md-btn-wave">Tutup</button>
                    @if($session_id == 3)
                    <button data-uk-modal="{target:'#modal_komplainQC{{ $value->id }}'}" type="button" class="md-btn md-btn-flat md-btn-flat-primary">KOMPLAIN</button>
                    <button type="button" class="md-btn md-btn-success md-btn-wave-light" onclick="updateSelesai()">SUDAH SESUAI</button>
                    @endif

                </div>
                </form>

        </div>
    </div>

@endforeach

@foreach ($dataStep2 as $value)
    <div class="uk-modal" id="modal_komplainQC{{ $value->id }}">
        <div class="uk-modal-dialog">
            <button type="button" class="uk-modal-close uk-close"></button>
            <p class="uk-text-bold">Berikan catatan.</p>
            <form enctype="multipart/form-data" method="post" action="{{ route('order_item_step.complain') }}">
            @csrf
                <div class="uk-grid">
                    <div class="uk-width-1-1">
                        <div class="uk-form-row">
                            <label>Inputkan Catatan</label>
                            <textarea cols="30" rows="4" class="md-input" name="notes"></textarea>
                            <input type="hidden" name="id" value="{{ $value->id }}">
                        </div>
                    </div>
                </div>
                <div class="uk-grid">
                    <div class="uk-width-1-1">
                        <button type="submit" class="md-btn md-btn-primary">CATAT</button>
                    </div>
                </div>
            </form>
            <!-- <p>Aksi ini akan mengembalikan proses ke tahap sebelumnya.</p> -->
        </div>
    </div>
@endforeach

@foreach ($dataStep1 as $value)
    <!-- komplain modal start -->
    <div class="uk-modal" id="modal_komplain">
        <div class="uk-modal-dialog">
            <button type="button" class="uk-modal-close uk-close"></button>
            <p class="uk-text-bold">Berikan catatan.</p>
            <form enctype="multipart/form-data" method="post" action="{{ route('order_item_step.catatan') }}">
            @csrf
                <div class="uk-grid">
                    <div class="uk-width-1-1">
                        <div class="uk-form-row">
                            <label>Inputkan Catatan</label>
                            <textarea cols="30" rows="4" class="md-input" name="notes"></textarea>
                            <input type="hidden" name="id" value="{{ $value->id }}">
                        </div>
                    </div>
                </div>
                <div class="uk-grid">
                    <div class="uk-width-1-1">
                        <button type="submit" class="md-btn md-btn-primary">CATAT</button>
                    </div>
                </div>
            </form>
            <!-- <p>Aksi ini akan mengembalikan proses ke tahap sebelumnya.</p> -->
        </div>
    </div>
    <!-- komplain modal end -->
@endforeach
    <!-- modal finish start -->
@foreach ($dataStep3 as $value)
    <div class="uk-modal" id="step-{{ $value->id }}">
        <div class="uk-modal-dialog">
            <div class="uk-modal-header">
                <span class="uk-badge uk-badge-success uk-float-right">SELESAI</span>
            </div>
            <form class="uk-form-stacked">
                <div class="uk-margin-medium-bottom">
                    <p class="uk-margin-remove uk-text-bold">{{ $value->step_title }}</p>
                    <p style="font-size: 12px;" class="uk-margin-remove">{{ $value->step_description }}.</p>
                </div>
                <div class="md-card-content">
                    <div class="uk-slidenav-position" data-uk-slideshow="{animation:'scale',autoplay:true}">
                        <ul class="uk-slideshow" id="img_carousel_selesai{{ $value->id }}">

                    	</ul>
                        <a href="" class="uk-slidenav uk-slidenav-contrast uk-slidenav-previous" data-uk-slideshow-item="previous"></a>
                        <a href="" class="uk-slidenav uk-slidenav-contrast uk-slidenav-next" data-uk-slideshow-item="next"></a>
                        <ul class="uk-dotnav uk-dotnav-contrast uk-position-bottom uk-flex-center" id="nomer_carousel_selesai{{ $value->id }}">

                        </ul>
                    </div>
                </div>
                <br>
                <div class="uk-margin-medium-bottom">
                    <p class="uk-margin-small-bottom uk-text-muted">Tanggal Update</p>
                    <p class="uk-margin-remove">{{ $value->tgl_update }}, Validasi oleh <span class="uk-badge uk-badge-warning">QUALITY CONTROL</span></p>
                </div>
                <hr>
                <span>Riwayat Proses</span>
                <div class="uk-grid uk-grid-divider" style="background-color: rgb(238, 238, 238);" data-uk-grid-margin>
                    <div class="uk-width-large-1-1 uk-width-medium-1-1">
                        <ul class="md-list" id="riwayat_selesai{{ $value->id }}">

                        </ul>
                    </div>
                </div>
                <div class="uk-modal-footer uk-text-right">
                    <button type="button" class="md-btn md-btn-flat uk-modal-close md-btn-wave">Tutup</button>
                </div>
            </form>
        </div>
    </div>
@endforeach
    <!-- modal finish end -->
@endsection

@push('scripts')
<<<<<<< HEAD
<script>	

	function updateSelesai()
	{
		UIkit.modal.confirm('Sudah sesuai QC?', function(){
			    $.ajax({
			    headers: {
			        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
			    },
                type: 'POST',
                url: "{{ route('order_item_step.selesai', [":id"]) }}".replace(':id',$('#id_selesai').val()),
                cache: false,
                contentType: false,
                processData: false,
                success: (data) => {

                    UIkit.modal.alert('Confirmed!');
                    setTimeout(function() {
					    location.reload();
					}, 5);
                },
                error: function(data) {
                    UIkit.modal.alert(data.responseJSON.message).then(function () {

                    });
                }
            });


		});
	}

	function updateDone(id)
	{
		UIkit.modal.confirm('Sudah selesai dan tidak ada revisi lagi?', function(){
			    $.ajax({
			    headers: {
			        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
			    },
                type: 'POST',
                url: "{{ route('order_item_step.done', [":id"]) }}".replace(':id',id),
                cache: false,
                contentType: false,
                processData: false,
                success: (data) => {

                    UIkit.modal.alert('Confirmed!');
                    setTimeout(function() {
					    window.location.href = "{{ route('order_item_step.index') }}";
					}, 5);
                },
                error: function(data) {
                    UIkit.modal.alert(data.responseJSON.message).then(function () {

                    });
                }
            });


		});
	}

	function getDataImageDikerjakan(id)
	{
		$.ajax({
            type: "GET",
            url: '{!! route('order_item_step_image.all', [':id']) !!}'.replace(':id', id),
            success: function (data) {
            	$('#img_carousel'+id+'').empty();
            	$('#nomer_carousel'+id+'').empty();

                for (i = 0; i < data.data.length; i++) {

                        var html = '<li><img src="' + data.data[i].photo +'" alt="" style="width: 100%; height: 100%; object-fit: cover; "> </li>';

                        $('#img_carousel'+id+'').append(html);

						var nomer = '<li data-uk-slideshow-item="'+ i +'"> <a href=""></a></li>';

						$('#nomer_carousel'+id+'').append(nomer);
                }

            },
            error: function (data) {
                console.log('error');
                UIkit.modal.alert(data.responseJSON.message).then(function () {

                });
            }
        });

        $.ajax({
            type: "GET",
            url: '{!! route('order_item_step_note.all', [':id']) !!}'.replace(':id', id),
            success: function (data) {
                $('#riwayat_vendor'+id+'').empty();

                for (i = 0; i < data.data.length; i++) {

                        var html = '<li>';
                        html+= '<div class="md-list-content">';
                        if (data.data[i].username == null) {
                            html+= '<span class="uk-badge">vendor</span>';
                        } else {
                            html+= '<span class="uk-badge">'+ data.data[i].username +'</span>';
                        }
                        html+= '<span class="md-list-heading">'+ data.data[i].tanggal_note +'</span>';
                        html+= '<span class="uk-text-small uk-text-muted">'+ data.data[i].notes +'</span></div>';
                        html+= '</li>';
                        $('#riwayat_vendor'+id+'').append(html);

                }

            },
            error: function (data) {
                console.log('error');
                UIkit.modal.alert(data.responseJSON.message).then(function () {

                });
            }
        });
	}

	function getDataImageQC(id)
	{
		$.ajax({
            type: "GET",
            url: '{!! route('order_item_step_image.all', [':id']) !!}'.replace(':id', id),
            success: function (data) {
            	$('#img_carousel_qc'+id+'').empty();
            	$('#nomer_carousel_qc'+id+'').empty();

                for (i = 0; i < data.data.length; i++) {

                        var html = '<li><img src="' + data.data[i].photo +'" alt="" style="width: 100%; height: 100%; object-fit: cover; "> </li>';

                        $('#img_carousel_qc'+id+'').append(html);

						var nomer = '<li data-uk-slideshow-item="'+ i +'"> <a href=""></a></li>';

						$('#nomer_carousel_qc'+id+'').append(nomer);
                }

            },
            error: function (data) {
                console.log('error');
                UIkit.modal.alert(data.responseJSON.message).then(function () {

                });
            }
        });

        $.ajax({
            type: "GET",
            url: '{!! route('order_item_step_note.all', [':id']) !!}'.replace(':id', id),
            success: function (data) {
            	$('#riwayat_qc'+id+'').empty();

                for (i = 0; i < data.data.length; i++) {

                        var html = '<li>';
                        html+= '<div class="md-list-content">';
                        if (data.data[i].username == null) {
                            html+= '<span class="uk-badge">vendor</span>';
                        } else {
                            html+= '<span class="uk-badge">'+ data.data[i].username +'</span>';
                        }
                        html+= '<span class="md-list-heading">'+ data.data[i].tanggal_note +'</span>';
                        html+= '<span class="uk-text-small uk-text-muted">'+ data.data[i].notes +'</span></div>';
                        html+= '</li>';
                        $('#riwayat_qc'+id+'').append(html);

                }

            },
            error: function (data) {
                console.log('error');
                UIkit.modal.alert(data.responseJSON.message).then(function () {

                });
            }
        });
	}

	function getDataImageSelesai(id)
	{
		$.ajax({
            type: "GET",
            url: '{!! route('order_item_step_image.all', [':id']) !!}'.replace(':id', id),
            success: function (data) {
            	$('#img_carousel_selesai'+id+'').empty();
            	$('#nomer_carousel_selesai'+id+'').empty();

                for (i = 0; i < data.data.length; i++) {

                        var html = '<li><img src="' + data.data[i].photo +'" alt="" style="width: 100%; height: 100%; object-fit: cover; "> </li>';

                        $('#img_carousel_selesai'+id+'').append(html);

						var nomer = '<li data-uk-slideshow-item="'+ i +'"> <a href=""></a></li>';

						$('#nomer_carousel_selesai'+id+'').append(nomer);
                }

            },
            error: function (data) {
                console.log('error');
                UIkit.modal.alert(data.responseJSON.message).then(function () {

                });
            }
        });

        $.ajax({
            type: "GET",
            url: '{!! route('order_item_step_note.all', [':id']) !!}'.replace(':id', id),
            success: function (data) {
            	$('#riwayat_selesai'+id+'').empty();

                for (i = 0; i < data.data.length; i++) {

                        var html = '<li>';
                        html+= '<div class="md-list-content">';
                        if (data.data[i].username == null) {
                            html+= '<span class="uk-badge">vendor</span>';
                        } else {
                            html+= '<span class="uk-badge">'+ data.data[i].username +'</span>';
                        }
                        html+= '<span class="md-list-heading">'+ data.data[i].tanggal_note +'</span>';
                        html+= '<span class="uk-text-small uk-text-muted">'+ data.data[i].notes +'</span></div>';
                        html+= '</li>';
                        $('#riwayat_selesai'+id+'').append(html);

                }

            },
            error: function (data) {
                console.log('error');
                UIkit.modal.alert(data.responseJSON.message).then(function () {

                });
            }
        });
	}
	$(document).ready(function () {




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
