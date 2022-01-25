@extends('layouts.app')

@section('content')

<div id="sc-page-wrapper">
	<div id="sc-page-top-bar" class="sc-top-bar uk-flex-middle">
		<div class="sc-top-bar-content sc-padding-medium-ends uk-flex-1">
			<div class="uk-flex uk-flex-column uk-flex-1">
				<h1 class="sc-top-bar-title uk-text-uppercase uk-margin-small-bottom">Pilih Pengiriman</h1>
				<span class="sc-top-bar-subtitle">Role: Sales Officer</span>
			</div>
			<div class="sc-actions uk-margin-left">
				<a href="javascript:void(0)" class="sc-actions-icon mdi mdi-printer"></a>
			</div>
		</div>
	</div>
	<div id="sc-page-content">
		<div class="uk-card">
      <div class="uk-overflow-auto">
        <table class="uk-table uk-table-divider" id="ts-issues">
          <thead>
            <tr>
              <th>Input Pengiriman</th>
              <th>Jumlah Order</th>
              <th>Order ID</th>
              <th>Ekspedisi</th>
              <th>Berat</th>
              <th>Biaya Kirim</th>
              <th>Pelanggan</th>
              <th class="filter-select" data-placeholder="Select...">Produk</th>
              <th class="filter-select" data-placeholder="Select...">Prioritas</th>
              <th>Tanggal Order</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
              @foreach ( $orders as $order )

                <tr>
                    <td>
                        <!-- <a href="#modal-detail-shipment" id="shipmentdetail{{$order->id}}" data-uk-toggle class="sc-button sc-button-mini sc-button-success" data-id="{{ $order->id }}">Perbarui</a> -->
                        @if($order->orderShipments->isEmpty())
                        <a style="margin-top: 5px;" href="#modal-input-weight{{$order->id}}" data-uk-toggle="" class="sc-button sc-button-mini" data-id="{{ $order->id }}">INPUTBERAT</a>
                        @else
                                @if($order->orderShipments[0]->status == 1)
                            <span>Menunggu SO</span>
                            @elseif($order->orderShipments[0]->status == 2)
                            <a href="#modal-input-shipment{{$order->id}}" id="updatedetail{{$order->id}}" data-uk-toggle="" class="sc-button sc-button-mini sc-button-success" data-id="{{ $order->id }}">Validasi</a>
                            @elseif($order->ordershipments[0]->status == 3)
                            <a style="margin-top: 5px;" href="#modal-print-shipment{{$order->id}}" id="updatedetailtransaksi{{$order->id}}" data-uk-toggle="" class="sc-button sc-button-mini" data-id="{{ $order->id }}">CETAK RESI</a>
                            @endif

                        @endif
                    </td>

                    <td>
                        {{$order->total_item}} buah
                    </td>
                    <td><a href="sales-officer/printable/quotation/{{ $order->id }}?action=export"
                           target="blank">{{ $order->id }}</a></td>
                    <td>{{ !empty($order->orderShipments[0]) ? $order->orderShipments[0]->expedition_name : '' }}</td>
                    <td>{{ !empty($order->orderShipments[0]) ? $order->orderShipments[0]->weight : ''}} Kg</td>
                    <td>{{ !empty($order->orderShipments[0]) ? formatRupiah($order->orderShipments[0]->price) : '' }}</td>
                    <td>{{$order->customer->fullname }}</td>
                    <td>{{$order->orderItems[0]->hasProduct->name}}</td>
                    @if ($order->orderItems[0]->hasProduct->name == 1)
                    <td><span class="uk-label uk-label-danger">Prioritas</span></td>
                    @else
                    <td><span class="uk-label">Tidak Prioritas</span></td>
                    @endif
                    <td>{{ \Carbon\Carbon::parse($order->order_date)->format('d M Y') }}</td>
                    <td>
                    @if($order->orderShipments->isEmpty())
                        <span class="uk-label uk-label-warning">INPUTKAN BERAT</span>
                    @else
                        @if($order->orderShipments[0]->status == 0)
                        <span class="uk-label uk-label-warning">INPUTKAN BERAT</span>
                        @elseif($order->orderShipments[0]->status == 1)
                        <span class="uk-label uk-label-primary">MENUNGGU SO</span>
                        @elseif($order->orderShipments[0]->status == 2)
                        <span class="uk-label uk-label-success">SIAP PROSES KIRIM</span>
                        @else
                        <span class="uk-label uk-label-success">SIAP PROESES KIRIM</span>

                            @endif
                    @endif
                    </td>
                </tr>

              @endforeach
            </tr>
          </tbody>
        </table>
      </div>
		</div>
	</div>
</div>

@foreach ($orders as $order )
<div id="modal-input-shipment{{$order->id}}" data-uk-modal>
    <div class="uk-modal-dialog uk-modal-body">
        <button class="uk-modal-close-default" data-uk-close></button>
        <div class="uk-modal-body">
                <div class="custom-form-divider">
                    <span class="custom-no-margin-bottom">Input Biaya Pengiriman</span>
                    <hr class="custom-hr">
                </div>
                <div class="uk-grid" data-uk-grid="">
                    <div class="uk-width-1-1@l uk-width-1-1@s">
                        <div class="sc-input-wrapper sc-input-filled">
                        <label><div class="custom-form-labeller"><span>Nama Ekspedisi</span> <span class="custom-important-input"><sup>*</sup></span></div></label>
                        <input class="uk-input" type="text" data-sc-input="outline" name="expedition_name" id="expedition_name" disabled>
                        <input class="uk-input" type="hidden" data-sc-input="outline" name="order_id" id="id" value="{{$order->id}}">
                        </div>
                    </div>
                </div>
                <div class="uk-grid" data-uk-grid="">
                    <div class="uk-width-1-1@l uk-width-1-1@s">
                        <div class="sc-input-wrapper sc-input-filled">
                        <label><div class="custom-form-labeller"><span>Berat</span> <span class="custom-important-input"><sup>*</sup></span></div></label>
                        <input class="uk-input data-price-style" data-inputmask="'alias': 'numeric', 'groupSeparator': ',', 'autoGroup': true, 'digits': 0, 'digitsOptional': false, 'prefix': '', 'placeholder': ''" data-sc-input="outline" name="weight" id="weight" required>
                        </div>
                    </div>
                </div>
                <div class="uk-grid" data-uk-grid="">
                    <div class="uk-width-1-1@l uk-width-1-1@s">
                        <div class="sc-input-wrapper sc-input-filled">

                        <label><div class="custom-form-labeller"><span>Biaya pengiriman</span> <span class="custom-important-input"><sup>*</sup></span></div></label>
                        <input class="uk-input data-price-style" data-sc-input="outline" data-inputmask="'alias': 'numeric', 'groupSeparator': ',', 'autoGroup': true, 'digits': 0, 'digitsOptional': false, 'prefix': '', 'placeholder': ''" name="price" id="price" required>
                        </div>
                    </div>
                </div>
                <div class="uk-grid" data-uk-grid="">
                    <div class="uk-width-1-1@l uk-width-1-1@s">
                        <label class="customer-form-labeller">No Resi</label>
                        <input class="uk-input" type="text" data-sc-input="outline" name="no_resi" id="no_resi" required value="">
                        <span class="sc-input-bar"></span>
                    </div>
                </div>
                <p class="uk-text-right">
                    <button class="sc-button sc-button-primary sc-js-button-loading" data-button-mode="light" type="submit" id="updateResi">Inputkan Resi</button>

                </p>
        </div>
    </div>
</div>
@endforeach

@foreach ($orders as $order )
<div id="modal-print-shipment{{$order->id}}" data-uk-modal>
    <div class="uk-modal-dialog uk-modal-body">
        <button class="uk-modal-close-default" data-uk-close></button>
        <div class="uk-modal-body">
                <div class="custom-form-divider">
                    <span class="custom-no-margin-bottom">Input Biaya Pengiriman</span>
                    <hr class="custom-hr">
                </div>
                <div class="uk-grid" data-uk-grid="">
                    <div class="uk-width-1-1@l uk-width-1-1@s">
                        <div class="sc-input-wrapper sc-input-filled">
                        <label><div class="custom-form-labeller"><span>Nama Ekspedisi</span> <span class="custom-important-input"><sup>*</sup></span></div></label>
                        <input class="uk-input" type="text" data-sc-input="outline" name="expedition_name" id="expedition_name_trans" disabled>
                        <input class="uk-input" type="hidden" data-sc-input="outline" name="order_id" id="id_trans" value="{{$order->id}}">
                        </div>
                    </div>
                </div>
                <div class="uk-grid" data-uk-grid="">
                    <div class="uk-width-1-1@l uk-width-1-1@s">
                        <div class="sc-input-wrapper sc-input-filled">
                        <label><div class="custom-form-labeller"><span>Berat</span> <span class="custom-important-input"><sup>*</sup></span></div></label>
                        <input class="uk-input" type="text" data-sc-input="outline" name="weight" id="weight_trans" required>
                        </div>
                    </div>
                </div>
                <div class="uk-grid" data-uk-grid="">
                    <div class="uk-width-1-1@l uk-width-1-1@s">
                        <div class="sc-input-wrapper sc-input-filled">

                        <label><div class="custom-form-labeller"><span>Biaya pengiriman</span> <span class="custom-important-input"><sup>*</sup></span></div></label>
                        <input class="uk-input data-price-style" data-inputmask="'alias': 'numeric', 'groupSeparator': ',', 'autoGroup': true, 'digits': 0, 'digitsOptional': false, 'prefix': '', 'placeholder': ''" data-sc-input="outline" name="price" id="price_trans" required>
                        </div>
                    </div>
                </div>
                <div class="uk-grid" data-uk-grid="">
                    <div class="uk-width-1-1@l uk-width-1-1@s">
                     <div class="sc-input-wrapper sc-input-filled">
                        <label class="customer-form-labeller">No Resi</label>
                        <input class="uk-input" type="text" data-sc-input="outline" name="no_resi" id="no_resi_trans" required >
                        <span class="sc-input-bar"></span>
                        </div>
                    </div>
                </div>
                <p class="uk-text-right">
                    <a data-button-mode="light"
                       href="{{ route('qc.printable.shipment-receipt', $order->id) }}?action=export" target="_blank"
                       data-uk-toggle="" class="sc-button sc-button-primary sc-js-button-loading">CETAK RESI</a>
                    <button class="sc-button sc-button-primary sc-js-button-loading" data-button-mode="light" type="submit" id="updateTransaksi">Order Dikirim</button>
                </p>

        </div>
    </div>
</div>
@endforeach

@foreach ($orders as $order)
<div id="modal-input-weight{{$order->id}}" data-uk-modal>
    <div class="uk-modal-dialog uk-modal-body">
        <button class="uk-modal-close-default" data-uk-close></button>
        <div class="uk-modal-body">
            <div class="custom-form-divider">
                <span class="custom-no-margin-bottom">Perbarui Biaya Pengiriman</span>
                <hr class="custom-hr">
            </div>
            <div class="uk-grid" data-uk-grid="">
                <div class="uk-width-1-1@l uk-width-1-1@s">
                    Berat<sup>*</sup></span>
                    {{-- <input class="uk-input" type="text" data-sc-input="outline" value="10,9 Kg" disabled> --}}
                    <input class="uk-input data-price-style" data-inputmask="'alias': 'numeric', 'groupSeparator': ',', 'autoGroup': true, 'digits': 0, 'digitsOptional': false, 'prefix': '', 'placeholder': ''" data-sc-input="outline" id="weight_detail" name="weight" required>
                    <input type="hidden" class="uk-input" type="text" data-sc-input="outline" id="order_id_detail" value="{{ $order->id }}">


                </div>
            </div>
            <p class="uk-text-right">
                <button class="sc-button sc-button-primary sc-js-button-loading" data-button-mode="light" type="submit" id="updateWeight">Input Berat</button>
            </p>

        </div>
    </div>
</div>
@endforeach


@endsection


@push('scripts')
    <script>
    @foreach ( $orders as $order )

       $(document).ready(function() {
        $('#updatedetail{{$order->id}}').click(function() {

            id{{$order->id}} = $(this).data('id');
            $.ajax({
                type: "GET",
                url: '{{ route("ready_shipment.show" )}}',
                data : 'order_id='+id{{$order->id}},
                success: function (user) {
                    console.log(user);

                    $("#expedition_name").val(user.expedition_name);
                    $("#weight").val(user.weight);
                    $("#price").val(user.price);
                    $("#id").val(user.order_id);
                    $("#no_resi").val(user.no_resi);
                }
            });
        });

        $('#updatedetailtransaksi{{$order->id}}').click(function() {

            id{{$order->id}} = $(this).data('id');
            $.ajax({
                type: "GET",
                url: '{{ route("ready_shipment.show" )}}',
                data : 'order_id='+id{{$order->id}},
                success: function (user) {
                    console.log(user);

                    $("#expedition_name_trans").val(user.expedition_name);
                    $("#weight_trans").val(user.weight);
                    $("#price_trans").val(user.price);
                    $("#id_trans").val(user.order_id);
                    $("#no_resi_trans").val(user.no_resi);
                }
            });
        });

    });
    @endforeach

    $(document).ready(function() {
        $('#updateWeight').click(function() {

            var weight = $('#weight_detail').val();
            var order_id = $('#order_id_detail').val();

            $.ajax({
                url: '{{ route("ready_shipment.update")}}',
                type: "POST",
                data: {
                    weight: weight,
                    order_id: order_id,
                    "_token": "{{ csrf_token() }}",
                },
                success: function(response) {
                    console.log(response);
                    if(response) {
                        window.location.href = '{{ route("ready_shipment.listQc" )}}';
                    }
                },
            });
        });

         $('#updateResi').click(function() {

            var expedition_name = $('#expedition_name').val();
            var weight = $('#weight').val();
            var price = $('#price').val();
            var no_resi = $('#no_resi').val();
            var order_id = $('#id').val();

            $.ajax({
                url: '{{ route("ready_shipment.updateResi")}}',
                type: "POST",
                data: {
                    expedition_name: expedition_name,
                    weight: weight,
                    price: price,
                    no_resi: no_resi,
                    order_id: order_id,
                    "_token": "{{ csrf_token() }}",
                },
                success: function(response) {
                    console.log(response);
                    if(response) {
                        window.location.href = '{{ route("ready_shipment.listQc" )}}';
                    }
                },
            });
        });

        $('#updateTransaksi').click(function() {

            var expedition_name = $('#expedition_name_trans').val();
            var weight = $('#weight_trans').val();
            var price = $('#price_trans').val();
            var no_resi = $('#no_resi_trans').val();
            var order_id = $('#id_trans').val();

            $.ajax({
                url: '{{ route("ready_shipment.updateTransaksi")}}',
                type: "POST",
                data: {
                    expedition_name: expedition_name,
                    weight: weight,
                    price: price,
                    no_resi: no_resi,
                    order_id: order_id,
                    "_token": "{{ csrf_token() }}",
                },
                success: function(response) {
                    console.log(response);
                    if(response) {
                        window.location.href = '{{ route("ready_shipment.listQc" )}}';
                    }
                },
            });
        });

    });



    </script>


@endpush
