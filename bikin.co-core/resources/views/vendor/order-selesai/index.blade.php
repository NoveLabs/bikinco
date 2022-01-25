@extends('layouts.altair')

@push('css-dropify')
    <link rel="stylesheet" href="{{ asset('assets/js/vendor/dropify/css/dropify.min.css') }}">
@endpush

@section('content')

        <div id="page_content" class="uk-height-1-1">

        <div id="page_content_inner">


            <div class="md-card uk-margin-medium-bottom">
                <div class="md-card-content">
                    <div class="dt_colVis_buttons"></div>
                    <table id="tabel_selesai" class="uk-table" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>No.</th>
                            <th>Order ID</th>
                            <th>Produk</th>
                            <th>Status Terakhir</th>
                            <th>Prioritas</th>
                            <th>Jumlah Order</th>
                            <th>Tgl. Order</th>
                            <th>Tgl. Selesai</th>
                            <th>Keterangan</th>
                        </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>No.</th>
                                <th>Order ID</th>
                                <th>Produk</th>
                                <th>Status Terakhir</th>
                                <th>Prioritas</th>
                                <th>Jumlah Order</th>
                                <th>Tgl. Order</th>
                                <th>Tgl. Selesai</th>
                                <th>Keterangan</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

        </div>

    </div>





@endsection
    
@push('scripts')
<script>

	$(document).ready(function () {
        
        $('#tabel_selesai').DataTable({
            dom: 'Bfrtip',
            processing: true,
            serverSide: true,
            ajax: "{{ route('vendor.order_selesai.index') }}",
            columns: [
                {data: 'id', name: 'id'},
                {data: 'id', name: 'id'},
                {data: 'name', name: 'name'},
                {data: 'flow_step', name: 'flow_step'},
                {data: 'priority', name: 'priority'},
                {data: 'total_item', name: 'total_item'},
                {data: 'tgl_order', name: 'tgl_order'},
                {data: 'tgl_order_selesai', name: 'tgl_order_selesai'},
                {data: 'keterangan', name: 'keterangan'},
                ]
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