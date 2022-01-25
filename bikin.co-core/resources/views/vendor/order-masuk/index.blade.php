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
                                            <th>Download</th>
                                            <th>Nama Produk</th>
                                            <th>Jumlah Order</th>
                                            <th>Prioritas</th>
                                            <th>Tanggal Masuk Order</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @for ($i = 0; $i < $count; $i++)
                                        <tr>
                                            <td>
                                            <img class="img_thumb" src="{{ $data[$i]->file_name }}" alt="">
                                            </td>
                                            <td>
                                            @if($data[$i]->flow_step == 3)
                                               <a href="{{ route('vendor.printable.billOfMaterial', $data[$i]->id) }}?action=export" target="blank" class="md-btn md-btn-mini md-btn-wave-light">MATERIAL</a>
                                            @else
                                            <a href="{{ route('so.printable.spk.vendor', $data[$i]->id) }}?action=export" target="blank" class="md-btn md-btn-mini md-btn-wave-light">SPK VENDOR</a>
                                                <a href="{{ url('/vendor/pd_upload/print/'.$data[$i]->id) }}" target="_blank" class="md-btn md-btn-mini md-btn-wave-light">PRINT ARTWORK</a>
                                                <a href="{{ route('vendor.printable.billOfMaterial', $data[$i]->id) }}?action=export" target="blank" class="md-btn md-btn-mini md-btn-wave-light">MATERIAL</a>
                                            @endif
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
                                            @if($data[$i]->flow_step == 2)
                                            <span class="uk-badge uk-badge-warning">Menunggu Down Payment</span>
                                            @else
                                            <span class="uk-badge uk-badge-success">Proses Verifikasi Artwork</span>
                                            @endif
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



    <!-- modal bukti dp start -->
    <div class="uk-modal" id="modal-bukti-dp">
        <div class="uk-modal-dialog">
            <button type="button" class="uk-modal-close uk-close"></button>
            <p class="uk-text-bold">Bukti transfer Down Payment.</p>
            <div class="uk-grid">
                <div class="uk-width-1-1">
                    <img style="max-height: 600px;" src="https://apdovi.forum-vokasi.id/wp-content/uploads/2020/08/Struk-seminar-42c179385a598c3e0007f6bde43989be.jpg" alt="">
                    <div style="margin: 15px;">
                        <p>Diunggah pada 31-12-2021 Pukul 13:43</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- modal bukti dp end -->


@endsection

@push('scripts')
<script>
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
