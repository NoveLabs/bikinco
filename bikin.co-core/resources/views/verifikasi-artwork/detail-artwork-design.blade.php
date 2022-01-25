@extends('layouts.app')

@push('css-dropify')
<link rel="stylesheet" href="{{ asset('assets/js/vendor/dropify/css/dropify.min.css') }}">
@endpush

@section('content')


<div id="sc-page-wrapper">
	<div id="sc-page-top-bar" class="sc-top-bar uk-flex-middle">
		<div class="sc-top-bar-content sc-padding-medium-ends uk-flex-1">
			<div class="uk-flex uk-flex-column uk-flex-1">
				<h1 class="sc-top-bar-title uk-text-uppercase uk-margin-small-bottom">Verifikasi Desain & Artwork</h1>
				<span class="sc-top-bar-subtitle">Role: Sales Offier</span>
				<hr>
				<ul class="uk-list custom-inline-list">
				@for ($i = 0; $i < $countOrder ; $i++)
					<li class="sc-list-group">
						<div class="sc-list-body">
							<p class="uk-margin-remove sc-text-semibold">Nama Pelanggan</p>
							<span class="sc-list-secondary-text">{{ $dataOrder[$i]->fullname }}</span>
						</div>
					</li>
					<li class="sc-list-group">
						<div class="sc-list-body">
							<p class="uk-margin-remove sc-text-semibold">Provinsi</p>
							<span class="sc-list-secondary-text">{{ $dataOrder[$i]->name }}</span>
						</div>
					</li>
					<li class="sc-list-group">
						<div class="sc-list-body">
							<p class="uk-margin-remove sc-text-semibold">Email</p>
							<span class="sc-list-secondary-text">{{ $dataOrder[$i]->email }}</span>
						</div>
					</li>
					<li class="sc-list-group">
						<div class="sc-list-body">
							<p class="uk-margin-remove sc-text-semibold">No. Telepon</p>
							<span class="sc-list-secondary-text">{{ $dataOrder[$i]->mobile_phone }}</span>
						</div>
					</li>
				</ul>
			</div>
			<div class="sc-actions uk-margin-left">
				<a href="{{ url('pd_upload/print/'.$dataOrder[$i]->id) }}" class="sc-actions-icon mdi mdi-printer" target="_blank"></a>
			</div>
				@endfor
		</div>
	</div>
	<div id="sc-page-content">
		<div data-uk-grid>
			<div class="uk-width-2-3@m">
				<div class="uk-card uk-margin">
					<h3 class="uk-card-title">Data Desain & Mockup Produk</h3>
					<div class="uk-card-body">
						<div class="uk-overflow-auto">
							<table class="uk-table uk-table-middle uk-table-divider">
								<thead>
									<tr>
										<th class="uk-width-small">Judul</th>
										<th>Gambar</th>
									</tr>
								</thead>
								<tbody>
								@for ($i = 0; $i < $countDesign ; $i++)
									<tr>
										<td>Desain {{ $dataDesign[$i]->title }}</td>

										<td><img style="max-height: 300px;" src="{{ $dataDesign[$i]->design }}" alt=""></td>
									</tr>
								@endfor
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<div class="uk-card uk-margin">
					<h3 class="uk-card-title">Data Artwork</h3>
					<div class="uk-card-body">
						<div class="uk-overflow-auto">
							<table class="uk-table uk-table-middle uk-table-divider">
								<thead>
									<tr>
										<th class="uk-width-small">Posisi</th>
										<th>Ukuran</th>
										<th>Material</th>
										<th>Printing</th>
										<th>Jumlah Warna</th>
										<th>Vector</th>
										<th>Preview</th>
									</tr>
								</thead>
								<tbody>
								@for ($i = 0; $i < $countArtwork ; $i++)
									<tr>
										<td>{{ $dataArtwork[$i]->artwork_position }}</td>
										<td>{{ $dataArtwork[$i]->size }}</td>
										<td>{{ $dataArtwork[$i]->name_material }}</td>
										<td>{{ $dataArtwork[$i]->name_printing }}</td>
										<td>{{ $dataArtwork[$i]->color_qty_artwork }}</td>
										<td><a href="{{ $dataArtwork[$i]->zip_file }}">Download</a></td>
										<td><img style="max-height: 400px;" src="{{ $dataArtwork[$i]->artwork }}" alt=""></td>
									</tr>
								@endfor
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			<div class="uk-width-1-3@m">
				<div class="uk-card">
					<div class="uk-card-body">
						<section>
							<span class="sc-color-secondary">Log:</span><br>
							<ul class="uk-comment-list uk-margin-small-top">
							@foreach($dataLog as $data)
								<li class="{{ $data->role_id  == 2 ? 'nthA' : 'nthB' }}">
									<article class="uk-comment uk-visible-toggle" tabindex="-1">
										<header class="uk-comment-header uk-position-relative">
											<h4 class="uk-comment-title uk-margin-remove">
												<a class="uk-link-reset {{ $data->role_id  == 4 ? 'productDesign' : '' }}"  href="javascript:void(0)">
												@if($data->role_id == 2)
													Sales Officer
												@elseif($data->role_id == 4)
													Product Design
												@endif
												</a>
											</h4>
											<p class="uk-comment-meta">
												<a class="uk-link-reset" href="javascript:void(0)">{{ $data->created_at }}</a>
											</p>
										</header>
										<div class="uk-comment-body">
											<p>{{ $data->reason }}</p>
										</div>
									</article>

								</li>
							@endforeach
							</ul>
							<a href="#modal-revisi" data-uk-toggle class="sc-button sc-button-default sc-button-small sc-button-outline">
								Revisi
							</a>
						</section>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


@foreach ($dataOrder as $data)
<div class="sc-fab-page-wrapper sc-fab-speed-dial" data-sc-fab='{"hover": true}'>
    <a href="#" class="sc-fab"><i class="mdi mdi-apple-keyboard-control"></i></a>
    <div class="sc-fab-wrapper-inner">
    	<form action="{{ url('verifikasi_artwork/terima') }}" method="post" enctype="multipart/form-data">
		@csrf
		<input type="hidden" name="order_id" value="{{$data->id}}">
        <button type="submit" class="sc-fab md-bg-light-green-600 sc-fab-dark"><i class="mdi mdi-check"></i></button>
        </form>
        <a href="#modal-revisi" data-uk-toggle class="sc-fab md-bg-amber-600 sc-fab-dark"><i class="mdi mdi-reload"></i></a>
		<a href="{{ url('pd_upload/print/'.$data->id) }}" class="sc-fab md-bg-blue-600 sc-fab-dark" target="_blank"><i class="mdi mdi-file-download-outline"></i></a>
    </div>
</div>
@endforeach
@foreach ($dataOrder as $data)
<div id="modal-revisi" data-uk-modal>
	<div class="uk-modal-dialog">
		<div class="uk-modal-header">
			<h2 class="uk-modal-title">Alasan Revisi</h2>
		</div>
		<form action="{{ url('verifikasi_artwork/tolak') }}" method="post" enctype="multipart/form-data">
		@csrf
		<div class="uk-modal-body">
			<label>Inputkan Alasan</label>
			<textarea class="uk-textarea" rows="5" data-sc-input="outline" name="reason"></textarea>
			<input type="hidden" name="order_id" value="{{$data->id}}">
		</div>
		<div class="uk-modal-footer uk-text-right">
			<button class="sc-button sc-button-flat sc-button-flat-danger uk-modal-close" type="button">Batal</button>
			<button type="submit" class="sc-button sc-button-secondary">Revisi</button>
		</div>
		</form>
	</div>
</div>
@endforeach





@endsection
    
@push('scripts')
 <script>

    $(document).ready(function () {
        
        $('#pdev').addClass("sc-page-active");


        $('.hide-column- input:checked').each(function() {
            selected.push($(this).attr('name'));
        });
        // var table = $('#ts-issues').DataTable();

        $('.hide-column').click(function(e) {
            e.preventDefault();
            
            var column = table.column( $(this).attr('data-column') );
            column.visible( ! column.visible() );
            table.draw();
        });


    });



</script>
@endpush

@push('dropify')
<script src="{{ asset('assets/js/vendor/dropify/js/dropify.min.js') }}"></script>
<script>
    $(document).ready(function(){
        // Basic
        $('.dropify').dropify();

         // $('#ts-issues').DataTable();

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