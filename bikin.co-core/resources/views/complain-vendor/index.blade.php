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
                                    <option value="1">Kaos</option>
                                    <option value="2">Kemeja</option>
                                    <option value="3">Jaket</option>
                                </select>
                            </div>
                        </div>
                        <div class="uk-width-medium-2-10 uk-text-center">
                            <a href="#" class="md-btn md-btn-primary uk-margin-small-top">Filter</a>
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
                                            <th>Masuk Order</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($data as $value)
                                        <tr>
                                            <td>
                                            @if($value->orderItems[0]->hasProduct->hasImage->isEmpty())

                                            @else
                                            <img class="img_thumb" src="{{ asset('/') }}{{ $value->orderItems[0]->hasProduct->hasImage[0]->file_name }}" alt="">
                                            @endif
                                            </td>
                                            <td>
                                                <a href="#" data-uk-modal="{target:'#modal-incomplain{{ $value->id }}'}" class="md-btn md-btn-mini md-btn-wave-light" onclick="getComplain({{ $value->orderItems[0]->id}})">RESUME KOMPLAIN</a>
                                                <a href="../printable/sales-officer-product-spk-vendor.html" target="blank" class="md-btn md-btn-mini md-btn-wave-light">SPK VENDOR</a>
                                                <a href="../so-product-order-waiting-artwork-print.html" target="blank" class="md-btn md-btn-mini md-btn-wave-light">PRINT ARTWORK</a>
                                            </td>
                                            <td class="uk-text-nowrap">{{ $value->orderItems[0]->hasProduct->name }}</td>
                                            <td>
                                            {{ $value->total_item }}
                                            </td>
                                            <td class="uk-text-nowrap">
                                            @if ($value->priority == 0)
                                            <span class="uk-label">Tidak Prioritas</span>
                                            @else
                                            <span class="uk-label uk-label-danger">Prioritas</span>
                                            @endif
                                            </td>
                                            <td>{{ $value->order_date }}</td>
                                            <td class="uk-text-nowrap">
                                            @if($value->flow_step == 0)
                                            <span class="uk-badge uk-badge-primary track-modal">{{ $value->orderLogMaster[0]->title }}</span>
                                            @elseif($value->flow_step == 1)
                                            <span class="uk-badge uk-badge-warning track-modal">{{ $value->orderLogMaster[0]->title }}</span>
                                            @elseif($value->flow_step == 2)
                                            <span class="uk-badge uk-badge-success track-modal">{{ $value->orderLogMaster[0]->title }}</span>
                                            @elseif($value->flow_step == 3)
                                            <span class="uk-badge uk-badge-success track-modal">{{ $value->orderLogMaster[0]->title }}</span>
                                            @elseif($value->flow_step == 4)
                                            <span class="uk-badge uk-badge-warning track-modal">{{ $value->orderLogMaster[0]->title }}</span>
                                            @elseif($value->flow_step == 5)
                                            <span class="uk-badge uk-badge-success track-modal">{{ $value->orderLogMaster[0]->title }}</span>
                                            @elseif($value->flow_step == 6)
                                            <span class="uk-badge uk-badge-success track-modal">{{ $value->orderLogMaster[0]->title }}</span>
                                            @elseif($value->flow_step == 7)
                                            <span class="uk-badge uk-badge-success track-modal">{{ $value->orderLogMaster[0]->title }}</span>
                                            @elseif($value->flow_step == 8)
                                            <span class="uk-badge uk-badge-warning track-modal">{{ $value->orderLogMaster[0]->title }}</span>
                                            @elseif($value->flow_step == 9)
                                            <span class="uk-badge uk-badge-warning track-modal">{{ $value->orderLogMaster[0]->title }}</span>
                                            @elseif($value->flow_step == 10)
                                             <span class="uk-badge uk-badge-success track-modal">{{ $value->orderLogMaster[0]->title }}</span>
                                            @elseif($value->flow_step == 11)
                                             <span class="uk-badge uk-badge-success track-modal">{{ $value->orderLogMaster[0]->title }}</span>
                                            @elseif($value->flow_step == 12)
                                            <span class="uk-badge uk-badge-danger track-modal">{{ $value->orderLogMaster[0]->title }}</span>
                                            @elseif($value->flow_step == 13)
                                            <span class="uk-badge uk-badge-danger track-modal">{{ $value->orderLogMaster[0]->title }}</span>
                                            @endif
                                            </td>
                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>



    <!-- detail komplain start -->
@foreach ($data as $value)
    <div id="modal-incomplain{{$value->id}}" class="uk-modal">
        <div class="uk-modal-dialog">
            <button type="button" class="uk-modal-close uk-close"></button>
            <h2 class="heading_a">Detail Komplain</h2>
            <p>Berikut detail komplain untuk order untuk produk <strong>{{ $value->orderItems[0]->hasProduct->name }}</strong></p>
            <table>
                <tr>
                    <td>SPK</td>
                    <td><a href="../printable/sales-officer-product-spk-vendor.html" target="blank" class="md-btn md-btn-mini md-btn-wave-light">SPK VENDOR</a></td>
                </tr>
                <tr>
                    <td>Data Material</td>
                    <td><a href="../printable/vendor-product-bill-of-material.html" target="blank" class="md-btn md-btn-mini md-btn-wave-light">MATERIAL</a></td>
                </tr>
                <tr>
                    <td>Data Artwork</td>
                    <td><a href="../so-product-order-waiting-artwork-print.html" target="blank" class="md-btn md-btn-mini md-btn-wave-light">PRINT ARTWORK</a></td>
                </tr>
            </table>
            <hr>
            <div class="uk-overflow-container">
                <h2 class="heading_b" id="list_complain{{ $value->orderItems[0]->id }}">Deskripsi Komplain</h2>

            </div>
            <hr>
            <a data-uk-modal="{target:'#modal-komplain-vendor{{ $value->orderItems[0]->id }}'}" class="md-btn md-btn-mini md-btn-wave-light" >PROSES KOMPLAIN</a>
        </div>
    </div>
    @endforeach
    <!-- detail komplain end -->

    @foreach ($data as $value)
     <div class="uk-modal" id="modal-komplain-vendor{{ $value->orderItems[0]->id }}">
        <input type="hidden" id="id_" value="{{ $value->id }}">
        <div class="uk-modal-dialog">
            <div class="uk-modal-header">
                <h3 class="uk-modal-title">Respon Komplain dari Quality Control</h3>
            </div>
            <p>Jika komplain dari Quality Control telah diterima dan sudah Anda proses, maka balas komplain dengan memberitahukan balasan komplain telah diproses.</p>
            <hr>
            <form enctype="multipart/form-data" action="" id="complain_form" method="post" >
                    {{csrf_field()}}
            <div class="uk-grid" data-uk-grid-margin>
                <div class="uk-width-medium-1-1">
                    <select name="jenis_komplain" id="jenis_komplain" class="md-input" data-uk-tooltip="{pos:'top'}">
                        <option value="" disabled selected hidden>Pilih ...</option>
                        <option value="1">Produk tidak lengkap atau kurang</option>
                        <option value="2">Produk rusak</option>
                        <option value="3">Produk tidak sesuai deskripsi</option>
                    </select>
                </div>
                <div class="uk-width-medium-1-1" style="margin-top: 25px;">
                    <label>Detail Balasan Komplain</label>
                    <textarea name="notes" id="notes" cols="30" rows="6" class="md-input"></textarea>
                </div>
                <div class="uk-width-medium-1-1" style="margin-top: 25px;">
                    <label>Link Lampiran (Jika ada)</label>
                    <input type="text" name="lampiran" id="lampiran" class="md-input" placeholder="Link Google Drive, DropBox, dll" />
                </div>
            </div>
            <div class="uk-modal-footer uk-text-right">
                <button type="button" class="md-btn md-btn-flat uk-modal-close">Tutup</button>
                <button class="md-btn md-btn-flat md-btn-flat-primary" >Kirim Pemberitahuan</button>
            </div>
            </form>

        </div>
    </div>

@endforeach

@endsection

@push('scripts')
 <script>
 function getComplain(id) {

    $.ajax({
            type: "GET",
            url: '{!! route('complainVendor.vendor', [':id']) !!}'.replace(':id', id),
            success: function (data) {
                $('#list_complain'+id+'').empty();

                for (i = 0; i < data.data[0].complain_vendor.length; i++) {
                        if (data.data[0].complain_vendor[i].status == 1) {
                            var stts = '<span class="uk-badge uk-badge-notification uk-badge-danger">Quality Control</span>';
                        } else {
                            var stts = '<span class="uk-badge uk-badge-notification uk-badge-warning">Vendor</span>';
                        }

                        if(data.data[0].complain_vendor[i].complain_type == 1) {
                            var compl = 'Produk tidak lengkap atau kurang';
                        } else if(data.data[0].complain_vendor[i].complain_type == 2) {
                            var compl = 'Produk rusak';
                        } else {
                            var compl = 'Produk tidak sesuai deskripsi';
                        }
                        var complain = '<hr>';
                         complain += '<table>';
                         complain += '<tr>';
                         complain += '<td style="width: 170px;"> Jenis Komplain </td>';
                         complain += '<td><span class="uk-badge uk-badge-notification uk-badge-primary">'+ compl +'</span></td>';
                         complain += '</tr>';
                         complain += '<td>Catatan</td>';
                         complain += '<td><p>'+ data.data[0].complain_vendor[i].notes  +'</p></td>';
                         complain += '<tr>';
                         complain += '<td> Lampiran Komplain </td>';
                         complain += '<td><a class="md-btn md-btn-primary md-btn-mini md-btn-wave-light" href="'+ data.data[0].complain_vendor[i].attachment +'" target="_blank">Lihat</a></td>';
                         complain += '</tr>';
                         complain += '<tr>';
                         complain += '<td> Input By </td>';
                         complain += '<td>'+stts+ '';
                         complain += '</td>';
                         complain += '</tr>';
                         complain += '</table>';
                         complain += '<hr>';

                        $('#list_complain'+id+'').append(complain);

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

        $('#complain_form').submit(function (event) {
            event.preventDefault();
            var id = $('#id_').val();

            var formData = new FormData(this);
            formData.append('id', id);
            $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            },
            type: 'POST',
            url: "{{ route('vendor.komplain', [":id"]) }}".replace(':id',id),
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: (data) => {

                // UIkit.modal.alert('Confirmed!');
                setTimeout(function() {
                    window.location.reload();
                }, 5);
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
