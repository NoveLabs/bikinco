@extends('layouts.app')

@push('css-dropify')
    <link rel="stylesheet" href="{{ asset('assets/js/vendor/dropify/css/dropify.min.css') }}">
@endpush

@section('content')
<div id="sc-page-wrapper">
    <div id="sc-page-top-bar" class="sc-top-bar uk-flex-middle">
        <div class="sc-top-bar-content sc-padding-medium-ends uk-flex-1">
            <div class="uk-flex uk-flex-column uk-flex-1">
                <h1 class="sc-top-bar-title uk-text-uppercase uk-margin-small-bottom">Riwayat Semua Order</h1>
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
              <th>No.</th>
              <th>Order ID</th>
              <th class="filter-select" data-placeholder="Pilih status...">Status Terakhir</th>
              <th>Pelanggan</th>
              <th class="filter-select" data-placeholder="Pilih produk...">Produk</th>
              <th class="filter-select" data-placeholder="Pilih prioritas...">Prioritas</th>
              <th>Qty</th>
              <th>Tanggal Order</th>
              <th>Tgl Selesai</th>
            </tr>
          </thead>
          <tbody>
            <?php $i = 1 ?>
            @foreach($data as $value)
            <tr>
                <td><?php echo $i; ?></td>
                <td><a href="{{ route('so.printable.quotation', $value->id) }}?action=export"
                       target="blank">{{ $value->id }}</a></td>
                <td>
                @if($value->flow_step == 0 )
                <span class="uk-label uk-label-primary">Order Dibuat, Menunggu konfirmasi Pelanggan</span>
                @elseif($value->flow_step == 1)
                <span class="uk-label uk-label-warning">Dikonfirmasi Pelanggan</span>
                @elseif($value->flow_step == 2)
                <span class="uk-label uk-label-success">Menunggu Pembayaran Down Payment</span>
                @elseif($value->flow_step == 3)
                <span class="uk-label uk-label-success">Down Payment Diverifikasi</span>
                @elseif($value->flow_step == 4)
                <span class="uk-label uk-label-warning">Artwork Diverifikasi</span>
                @elseif($value->flow_step == 5)
                <span class="uk-label uk-label-success">Diproses Vendor</span>
                @elseif($value->flow_step == 6)
                <span class="uk-label uk-label-success">Selesai Produksi</span>
                @elseif($value->flow_step == 7)
                <span class="uk-label uk-label-success">Siap Dikirim</span>
                @elseif($value->flow_step == 8)
                <span class="uk-label uk-label-warning">Menunggu Pembayaran Pelunasan</span>
                @elseif($value->flow_step == 9)
                <span class="uk-label uk-label-warning">Down Payment Pelunasan Diverifikasi</span>
                @elseif($value->flow_step == 10)
                 <span class="uk-label uk-label-success">Tiba di Tujuan</span>
                @elseif($value->flow_step == 11)
                 <span class="uk-label uk-label-success">Selesai</span>
                @elseif($value->flow_step == 12)
                <span class="uk-label uk-label-success">Tiba di Tujuan</span>
                <span class="uk-label uk-label-danger">Dalam Komplain</span>
                @else
                <span class="uk-label uk-label-danger">Dibatalkan</span>
                @endif
                </td>
                <td>{{ $value->fullname }}</td>
                <td>{{ $value->name }}</td>
                <td>
                @if($value->priority == 0)
                <span class="uk-label uk-label-danger">Prioritas</span>
                @elseif($value->priority == 1)
                <span class="uk-label uk-label-warning">Medium</span>
                @else
                <span class="uk-label">Tidak Prioritas</span>
                @endif</td>
                <td>{{ $value->total_item }}</td>
                <td>{{ $value->tgl_order }}</td>
                <td>{{ $value->tgl_flow_step }}</td>
            </tr>
            <?php $i++; ?>
            @endforeach
          </tbody>
        </table>
      </div>
        </div>
    </div>
</div>
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
