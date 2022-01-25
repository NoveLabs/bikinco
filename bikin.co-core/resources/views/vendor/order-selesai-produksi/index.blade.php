@extends('layouts.altair')

@push('css-dropify')
    <link rel="stylesheet" href="{{ asset('assets/js/vendor/dropify/css/dropify.min.css') }}">
@endpush

@section('content')

    <div id="page_content" class="uk-height-1-1">

        <div id="page_content_inner">

            <div class="md-card">
                <div class="md-card-content">
                    <div class="uk-grid" data-uk-grid-margin="">
                        <div class="uk-width-medium-8-10">
                            <div class="uk-margin-small-top">
                                <select id="product_search_status" data-md-selectize multiple data-md-selectize-bottom>
                                    <option value="">Pilih produk</option>
                                   	@foreach ($product as $value)
                                   	<option value="{{ $value->id }}">{{ $value->name }}</option>
                                   	@endforeach
                                </select>
                            </div>
                        </div>
                        <div class="uk-width-medium-2-10 uk-text-center">
                            <a href="#" onclick="" class="md-btn md-btn-primary uk-margin-small-top">Filter</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="md-card">
                <div class="md-card-content">
                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-1-1">
                            <div class="uk-overflow-container">
                                <table class="uk-table uk-table-align-vertical">
                                    <thead>
                                        <tr>
                                            <th>Produk</th>
                                            <th>Upload</th>
                                            <th>Download</th>
                                            <th>Nama Produk</th>
                                            <th>Jumlah Order</th>
                                            <th>Prioritas</th>
                                            <th>Masuk Order</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @for ($i = 0; $i < $count; $i++)
                                        <tr>
                                             <td><img class="img_thumb" src="{{ $data[$i]->file_name }}" alt=""></td>
                                             <td><a data-uk-modal="{target:'#upload-hasil{{ $data[$i]->id }}'}" onclick="getDataImage({{$data[$i]->id_order_item }})" class="md-btn md-btn-mini md-btn-primary md-btn-wave-light waves-effect waves-button waves-light">Upload Hasil</a></td>
                                            <td>
                                                <a href="{{ route('so.printable.spk.vendor', $data[$i]->id) }}?action=export" target="blank" class="md-btn md-btn-mini md-btn-wave-light">SPK VENDOR</a>
                                                <a href="{{ url('/vendor/pd_upload/print/'.$data[$i]->id) }}" target="_blank" class="md-btn md-btn-mini md-btn-wave-light">PRINT ARTWORK</a>
                                                <a href="{{ route('vendor.printable.billOfMaterial', $data[$i]->id) }}?action=export" target="blank" class="md-btn md-btn-mini md-btn-wave-light">MATERIAL</a>
                                            </td>
                                            <td class="uk-text-nowrap">{{ $data[$i]->name }}</td>
                                            <td>{{ $data[$i]->total_item }}</td>
                                            <td class="uk-text-nowrap">
                                            @if ($data[$i]->priority == 0)
                                            <span class="uk-label">Tidak Prioritas</span>
                                            @else
                                            <span class="uk-label uk-label-danger">Prioritas</span>
                                            @endif
                                            </td>
                                            <td>{{ $data[$i]->order_date }}</td>
                                            <td class="uk-text-nowrap">
                                            <span class="uk-badge uk-badge-success">DP Dibayar</span>
                                            </td>
                                        </tr>
                                    @endfor

                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

@foreach ($data as $value)
  <div class="uk-modal" id="upload-hasil{{ $value->id }}">
        <div class="uk-modal-dialog">
            <div class="uk-modal-header">
                <span class="uk-badge uk-badge-success uk-float-right">SELESAI PRODUKSI</span>
            </div>
                <div class="md-card-content">
                    <div class="uk-slidenav-position" data-uk-slideshow="{animation:'scale',autoplay:true}">
                        <ul class="uk-slideshow" id="img_carousel{{ $value->id }}">
                        </ul>

                        <a href="" class="uk-slidenav uk-slidenav-contrast uk-slidenav-previous" data-uk-slideshow-item="previous"></a>
                        <a href="" class="uk-slidenav uk-slidenav-contrast uk-slidenav-next" data-uk-slideshow-item="next"></a>
                        <ul class="uk-dotnav uk-dotnav-contrast uk-position-bottom uk-flex-center" id="nomer_carousel{{ $value->id }}">

                        </ul>
                    </div>
                </div>
                <hr>
                <div class="uk-margin-medium-bottom">
                    <div class="uk-width-medium-1-1">
                        <div class="md-card-content">
                            <h3 class="heading_a uk-margin-small-bottom">
                                Unggah foto
                            </h3>
                            <form enctype="multipart/form-data" method="post" action="{{ route('vendor_selesai_produksi.upload') }}" class="dropzone" id="dropzone">
                            @csrf
                            <input type="hidden" name="id" value="{{ $value->id }}">
                            </form>
                        </div>
                    </div>
                </div>
                <div class="uk-modal-footer uk-text-right">
                    <button type="button" class="md-btn md-btn-flat uk-modal-close md-btn-wave" onclick="refreshPage()">Tutup</button>
                </div>
        </div>
    </div>

@endforeach




@endsection

@push('scripts')
<script>
function refreshPage(){
    window.location.reload();
}
Dropzone.options.dropzone  =
         {
            maxFilesize: 12,
            acceptedFiles: ".jpeg,.jpg,.png,.gif",
            timeout: 5000,
            success: function(file, response)
            {
               var obj = response.success;
               file.previewElement.id = obj;
            },
            removedfile: function(file)
            {
                var name = file.previewElement.id;
                 $.ajax({
                    headers: {
                                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                            },
                    type: 'POST',
                    url: '{{ route("vendor_selesai_produksi.vendor.deleteUpload") }}',
                    data: {filename: name},
                    success: function (data){
                        console.log("File has been successfully removed!!");
                    },
                    error: function(e) {
                        console.log(e);
                    }});
                    var fileRef;
                    return (fileRef = file.previewElement) != null ?
                    fileRef.parentNode.removeChild(file.previewElement) : void 0;
            },
            error: function(file, response)
            {
               return false;
            }
};
    function getDataImage(id) {
        $.ajax({
            type: "GET",
            url: '{!! route('vendor_selesai_produksi.all', [':id']) !!}'.replace(':id', id),
            success: function (data) {
                $('#img_carousel'+id+'').empty();
                $('#nomer_carousel'+id+'').empty();

                for (i = 0; i < data.data.length; i++) {

                        var html = '<li><img src="' + data.data[i].image +'" alt="" style="width: 100%; height: 100%; object-fit: cover; "> </li>';

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
