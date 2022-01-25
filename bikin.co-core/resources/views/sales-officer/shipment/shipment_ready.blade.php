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
                    @if($order->orderShipments->isEmpty())
                    <td>
                     <span>Menunggu QC</span>
                     </td>
                    @else
                        @if ($order->orderShipments[0]->status == 1)
                    <td>
                        <a href="#modal-input-shipment{{$order->id}}" id="update{{$order->id}}" data-uk-toggle class="sc-button sc-button-mini sc-button-primary"  data-id="{{ $order->id }}">Ekspedisi</a>
                        </td>
                        @elseif($order->orderShipments[0]->status == 2)
                        <td>
                        <a href="#modal-detail-shipment" id="shipmentdetail{{$order->id}}" data-uk-toggle class="sc-button sc-button-mini sc-button-primary"  data-id="{{ $order->id }}">Ekspedisi</a>
                        </td>
                        @endif
                    @endif

                    <td>
                        {{$order->total_item}} buah
                    </td>
                    <td><a href="sales-officer/printable/quotation/{{ $order->id }}?action=export"
                           target="blank">{{ $order->id }}</a></td>
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
                        <span class="uk-label uk-label-primary">Menunggu Info Berat</span>
                    @else
                        @if($order->orderShipments[0]->status == 0)
                        <span class="uk-label uk-label-primary">Menunggu Info Berat</span>
                        @elseif($order->orderShipments[0]->status == 1)
                        <span class="uk-label uk-label-warning">INPUTKAN EKSPEDISI</span>
                        @elseif($order->orderShipments[0]->status == 2)
                        <span class="uk-label uk-label-success">DIPROSES QC</span>
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
                        <label><div class="custom-form-labeller"><span>Nama Ekspedisi</span> <span class="custom-important-input"><sup>*</sup></span></div></label>
                        <input class="uk-input" type="text" data-sc-input="outline" name="expedition_name" id="expedition_name" required value="">
                        <input class="uk-input" type="hidden" data-sc-input="outline" name="order_id" id="order_id" value="{{$order->id}}">
                    </div>
                </div>
                <div class="uk-grid" data-uk-grid="">
                    <div class="uk-width-1-1@l uk-width-1-1@s">
                        <div class="sc-input-wrapper sc-input-filled">
                            <label class="custom-form-labeller">Berat</label>
                            <input class="uk-input data-price-style" data-inputmask="'alias': 'numeric', 'groupSeparator': ',', 'autoGroup': true, 'digits': 0, 'digitsOptional': false, 'prefix': '', 'placeholder': ''"  data-sc-input="outline" name="weight" id="weight" required value="">
                            <span class="sc-input-bar"></span>
                        </div>
                    </div>
                </div>
                <div class="uk-grid" data-uk-grid="">
                    <div class="uk-width-1-1@l uk-width-1-1@s">
                        <label><div class="custom-form-labeller"><span>Biaya pengiriman</span> <span class="custom-important-input"><sup>*</sup></span></div></label>
                        <input class="uk-input data-price-style" data-sc-input="outline" data-inputmask="'alias': 'numeric', 'groupSeparator': ',', 'autoGroup': true, 'digits': 0, 'digitsOptional': false, 'prefix': '', 'placeholder': ''" name="price" id="price" required value="">
                    </div>
                </div>
                <p class="uk-text-right">
                    <button class="sc-button sc-button-primary sc-js-button-loading" data-button-mode="light" type="submit" id="update">Inputkan Biaya Kirim</button>
                </p>
            </form>
        </div>
    </div>
</div>
@endforeach

<div id="modal-detail-shipment" data-uk-modal>
    <div class="uk-modal-dialog uk-modal-body">
        <button class="uk-modal-close-default" data-uk-close></button>
        <div class="uk-modal-body">
                <div class="custom-form-divider">
                    <span class="custom-no-margin-bottom">Detail Biaya Pengiriman</span>
                    <hr class="custom-hr">
                </div>
                <div class="uk-grid" data-uk-grid="">
                    <div class="uk-width-1-1@l uk-width-1-1@s">
                    <div class="sc-input-wrapper sc-input-filled">
                        <label class="uk-label-large">Nama Ekspedisi</label>
                         <input class="uk-input" type="text" data-sc-input="outline" name="expedition_name_detail" id="expedition_name_detail" disabled value="">
                        <span class="sc-input-bar"></span>
                        </div>
                    </div>
                </div>
                <div class="uk-grid" data-uk-grid="">
                    <div class="uk-width-1-1@l uk-width-1-1@s">
                        <div class="sc-input-wrapper sc-input-filled">
                        <label class="uk-label-large">Berat</label>
                          <input class="uk-input sc-input-filled" type="text" data-sc-input="outline" name="weight_detail" id="weight_detail" disabled value="">
                        <span class="sc-input-bar"></span>
                        </div>
                    </div>
                </div>
                <div class="uk-grid" data-uk-grid="">
                    <div class="uk-width-1-1@l uk-width-1-1@s">
                        <div class="sc-input-wrapper sc-input-filled">
                        <label class="uk-label-large">Biaya Pengiriman</label>
                        <input class="uk-input data-price-style" data-inputmask="'alias': 'numeric', 'groupSeparator': ',', 'autoGroup': true, 'digits': 0, 'digitsOptional': false, 'prefix': 'Rp. ', 'placeholder': ''" data-sc-input="outline" name="price_detail" id="price_detail" disabled value="">
                        <span class="sc-input-bar"></span>
                        </div>
                    </div>
                </div>
                <div class="uk-grid" data-uk-grid="">
                    <div class="uk-width-1-1@l uk-width-1-1@s">
                         <div class="sc-input-wrapper sc-input-filled">
                        <label class="uk-label-large">No Resi</label>
                        <input class="uk-input" type="number" data-sc-input="outline" name="no_resi_detail" id="no_resi_detail" disabled value="">
                        <span class="sc-input-bar"></span>
                        </div>
                    </div>
                </div>
                <p class="uk-text-right">
                    <button class="sc-button sc-button-default sc-button-flat uk-modal-close" type="button">Tutup</button>
                </p>
            </form>
        </div>
    </div>
</div>


@endsection


@push('scripts')
    <script>
    @foreach ( $orders as $order )

       $(document).ready(function() {
        $('#shipmentdetail{{$order->id}}').click(function() {

            id{{$order->id}} = $(this).data('id');
            $.ajax({
                type: "GET",
                url: '{{ route("ready_shipment.show" )}}',
                data : 'order_id='+id{{$order->id}},
                success: function (user) {
                    console.log(user);

                    $("#expedition_name_detail").val(user.expedition_name).addClass('sc-input-filled');
                    $("#weight_detail").val(user.weight).addClass('sc-input-filled');
                    $("#price_detail").val(user.price).addClass('sc-input-filled');
                    $("#no_resi_detail").val(user.no_resi).addClass('sc-input-filled');
                }
            });
        });

        $('#update{{$order->id}}').click(function() {

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
                    $("#no_resi").val(user.no_resi)
                }
            });
        });

         $('#update').click(function() {

            var expedition_name = $('#expedition_name').val();
            var weight = $('#weight').val();
            var price = $('#price').val();
            var order_id = $('#order_id').val();

            $.ajax({
                url: '{{ route("ready_shipment.updateSO")}}',
                type: "POST",
                data: {
                    expedition_name: expedition_name,
                    weight: weight,
                    price: price,
                    order_id: order_id,
                    "_token": "{{ csrf_token() }}",
                },
                success: function(response) {
                    console.log(response);
                    if(response) {
                        window.location.href = '{{ route("ready_shipment.index" )}}';
                    }
                },
            });
        });

    });
 @endforeach



    </script>


@endpush
