@extends('layouts.app')

@section('content')

<div id="sc-page-wrapper">
	<div id="sc-page-content">
        <div class="uk-card uk-margin-top">
            <h3 class="uk-card-title">Dalam Komplain Ke Customer</h3>
            <div class="uk-card-body">
                <div class="uk-overflow-auto">
                    <table class="uk-table uk-table-striped uk-table-hover uk-table-middle">
                        <thead>
                        <tr>
                            <th class="uk-table-shrink"></th>
                            <th>Produk</th>
                            <th>Nama</th>
                            <th>Order ID</th>
                            <th class="uk-text-center">Jumlah (Qty)</th>
							<th>Prioritas</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $number = 1 ;
                        ?>
                        @for ($i = 0; $i < $count; $i++)
                            <tr>
                                <td class="uk-text-right">{{ $number }}</td>
                                <td class="uk-text-nowrap">{{ $data[$i]->orderItems[0]->hasProduct->name }}</a></td>
                                <td class="uk-text-nowrap">{{ $data[$i]->Customer->fullname }}</td>
                                <td>BQ-{{ $data[$i]->id }}</td>
                                <td class="uk-text-center">{{ $data[$i]->total_item }}</td>
								<td>
                                @if($data[$i]->orderItems[0]->priority == 0)
                                <span class="uk-label uk-label-danger">Prioritas</span>
                                @elseif($data[$i]->orderItems[0]->priority == 1)
                                 <span class="uk-label">Tidak Prioritas</span>
                                @endif
                                </td>
                                <td>
                                @if($data[$i]->complainSO[0]->status == 1)
                                <span class="uk-label uk-label-warning">Dikomunikasikan</span>
                                @elseif($data[$i]->complainSO[0]->status == 2)
                                <span class="uk-label uk-label-success">Berhasil Dikomunikasikan</span>
                                @else
                                <span class="uk-label uk-label-danger">Retur</span>
                                <a style="margin-top: 5px;" href="#modal-bukti-retur" data-uk-toggle="" class="sc-button sc-button-mini">Bukti Transfer</a>
                                @endif
                                </td>
                                <td><a href="#modal-lihat{{ $data[$i]->id }}" data-uk-toggle onclick="getDataComplain({{ $data[$i]->orderItems[0]->id }})" class="mdi mdi-file-outline sc-icon-square"></a></td>
                            </tr>
                            <?php $number++;
                            ?>
                        @endfor
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
	</div>
</div>


<!-- start modal view bukti transfer -->
<div id="modal-bukti-retur" class="uk-flex-top" data-uk-modal>
    <div class="uk-modal-dialog uk-width-auto uk-margin-auto-vertical">
        <button class="uk-modal-close-outside" type="button" data-uk-close></button>
        <img style="max-height: 600px;" src="https://apdovi.forum-vokasi.id/wp-content/uploads/2020/08/Struk-seminar-42c179385a598c3e0007f6bde43989be.jpg" alt="">
        <div style="margin: 15px;">
            <p>Diunggah pada 31-12-2021 Pukul 13:43</p>
        </div>
    </div>
</div>
<!-- end modal view bukti transfer -->
<!-- start modal lihat -->
@for ($i = 0; $i < $count; $i++)
<div id="modal-lihat{{ $data[$i]->id }}" data-uk-modal>
	<div class="uk-modal-dialog">
		<button class="uk-modal-close-default" type="button" data-uk-close></button>
		<div class="uk-modal-header">
		</div>
		<div class="uk-modal-body" data-uk-overflow-auto>
			<ul class="uk-list uk-margin">
				<li class="sc-sidebar-menu-heading custom-list-divider"><span>Riwayat Komplain</span></li>
			</ul>
			<ul class="uk-accordion-outline" data-uk-accordion id="riwayat_complain{{$data[$i]->orderItems[0]->id}}">
			</ul>
		</div>
		<hr class="uk-margin-remove">
		<div class="uk-modal-footer uk-text-right">
			<a href="#modal-komplain-vendor{{ $data[$i]->id }}"  data-uk-toggle class="sc-button sc-button-flat sc-button-flat-danger" type="button">BALAS KOMPLAIN</a>
			<a id="sc-js-modal-confirm-dp" class="sc-button sc-button-success" onclick="updateSesuai({{ $data[$i]->id }})">SESUAI</a>
		</div>
	</div>
</div>
@endfor
<!-- end modal lihat -->

<!-- start modal komplain vendor -->
@for ($i = 0; $i < $count; $i++)
<div id="modal-komplain-vendor{{ $data[$i]->id }}" data-uk-modal>
<input type="hidden" id="id_" value="{{ $data[$i]->id }}">
	<div class="uk-modal-dialog uk-modal-body">
		<button class="uk-modal-close-default" type="button" data-uk-close></button>
		<div class="uk-modal-body">
				<div class="custom-form-divider">
					<span class="custom-no-margin-bottom">Input Komplain ke Vendor</span>
                    <p>Apabila memiliki masalah setelah menerima produk, kamu dapat mengajukan komplain dengan cara berikut ini:</p>
				</div>
                <hr>
  <form enctype="multipart/form-data" action="" id="complain_form" method="post" >
                {{csrf_field()}}
            <div class="uk-grid" data-uk-grid>
                <div class="uk-width-1-1@l uk-width-1-1@s">
                    <label for="">Pilih jenis komplain</label>
                    <select name="jenis_komplain" id="jenis_komplain"  class="uk-select" data-sc-select2='{"placeholder": "Pilih paket pengiriman", "allowClear": true }'>
                        <option value="1">Pelayanan</option>
                        <option value="2">Kualitas produk</option>
                        <option value="3">Pengiriman</option>
                    </select>
                </div>
                <div class="uk-width-1-1@l uk-width-1-1@s">
                    <label for="">Catatan / Deskripsi Komplain</label>
                    <textarea name="notes" id="notes" cols="30" rows="6" class="uk-textarea"></textarea>
                </div>
                <div class="uk-width-1-1@l uk-width-1-1@s">
                    <label><div class="custom-form-labeller"><span>Lampiran</span> </div></label>
                    <input class="uk-input" name="attachment" id="attachment" type="text" data-sc-input="outline" placeholder="Link Google Drive, DropBox, dll">
                </div>
            </div>
		</div>
		<p class="uk-text-right">
            <!-- button ini muncul setelah dapet result opsi paket pengiriman -->
            <button class="sc-button sc-button-danger sc-js-button-loading" data-button-mode="light">Balas Komplain</button>
		</p>
        </form>
	</div>
</div>
@endfor
<!-- end modal komplain vendor -->
@endsection


@push('scripts')
<script>
function getDataComplain(id) {

            $.ajax({
            type: "GET",
            url: '{!! route('complainSO.allData', [':id']) !!}'.replace(':id', id),
            success: function (data) {
                $('#riwayat_complain'+id+'').empty();

                for (i = 0; i < data.data[0].complain_s_o.length; i++) {
                        if (data.data[0].complain_s_o[i].status == 1) {
                            var stts = 'Sales Officer';
                        } else {
                            var stts = 'Customer';
                        }

                        if(data.data[0].complain_s_o[i].complain_type == 1) {
                            var compl = 'Pelayanan';
                        } else if(data.data[0].complain_s_o[i].complain_type == 2) {
                            var compl = 'Kualitas Produk';
                        } else {
                            var compl = 'Pengiriman';
                        }
                        // data.data[0].complain_s_o[i].created_at;

                        var complain = '<li class="uk-open">';
                         complain += '<h3 class="uk-accordion-title md-bg-light-blue-50">Pengirim:'+ stts + ' - '+ data.data[0].complain_s_o[i].created_at +'</h3>';
                         // Sabtu, 6 Mar 2021 12:45
                         complain += ' <div class="uk-accordion-content">';
                         complain += '<p style="margin-bottom: 20px;">Jenis Komplain : ' + compl + '</p>';
                         complain += ''+ data.data[0].complain_s_o[i].notes +'';
                         complain += '<br><br>';
                         complain += '<a style="margin-top: 20px;" href="'+data.data[0].complain_s_o[i].attachment + '" target="_blank">>> Lihat Lampiran</a>';
                         complain += '</div>';
                         complain += '</li>';

                        $('#riwayat_complain'+id+'').append(complain);

                }

            },
            error: function (data) {
                console.log('error');
                UIkit.modal.alert(data.responseJSON.message).then(function () {

                });
            }
        });


    }


    function updateSesuai(id)
    {
            UIkit.modal.confirm('Produksi sudah Sesuai, tidak ada komplain?').then(function(){
                      $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    },
                    type: 'POST',
                    url: "{{ route('order_dikirim.done', [":id"]) }}".replace(':id',id),
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: (data) => {

                        UIkit.modal.alert('Confirmed!');
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

    }




    $(document).ready(function () {
        $('#qc').addClass("sc-page-active");

        $('#complain_form').submit(function (event) {
            event.preventDefault();
            var id = $('#id_').val();

            var formData = new FormData(this);
            formData.append('order_id', id);
            $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            },
            type: 'POST',
            url: "{{ route('order_dikirim.add_komplain', [":id"]) }}".replace(':id',id),
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
