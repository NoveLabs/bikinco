@extends('layouts.app')

@push('css-dropify')
<link rel="stylesheet" href="{{ asset('assets/js/vendor/dropify/css/dropify.min.css') }}">
@endpush

@section('content')

<div id="sc-page-wrapper">
	<div id="sc-page-top-bar" class="sc-top-bar uk-flex-middle">
		<div class="sc-top-bar-content sc-padding-medium-ends uk-flex-1">
			<div class="uk-flex uk-flex-column uk-flex-1">
				<h1 class="sc-top-bar-title uk-text-uppercase uk-margin-small-bottom">Order Menunggu Konfirmasi Pelanggan</h1>
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
              <th>Unduh</th>
              <th>Aksi</th>
              <th>Order ID</th>
              <th>Pelanggan</th>
              <th class="filter-select" data-placeholder="Select...">Produk</th>
              <th class="filter-select" data-placeholder="Select...">Prioritas</th>
              <th>Tanggal Order</th>
              <th>Status</th>
            </tr>
          </thead> 
        </table>
      </div>
		</div>
	</div>
</div>


<div id="modal-konfirmasi" data-uk-modal>
  <div class="uk-modal-dialog">
    <form enctype="multipart/form-data" id="update_status" role="form" method="POST" action=""> 
    @csrf
        <div class="uk-modal-body">Konfirmasi order ini?</div> 
        <div class="uk-modal-footer uk-text-right"> 
            <button class="uk-button uk-button-default uk-modal-close" type="button">Cancel</button>
            <button class="uk-button uk-button-primary" autofocus="" type="submit">Ok</button>
            <input type="hidden" id="id" value=""> 
        </div> 
    </form>
  </div>
</div>
@endsection
    
@push('scripts')
 <script>
    function showKonfirmasi($id)
    {
      UIkit.modal($("#modal-konfirmasi")).show();
      $("#id").val($id);
    }

    $(document).ready(function () {
        
        $('#pdev').addClass("sc-page-active");


        $('.hide-column- input:checked').each(function() {
            selected.push($(this).attr('name'));
        });
        var table = $('#ts-issues').DataTable({
            processing: true,
            serverSide: true,
            retrieve: true,
            pageLength: 10,
            ajax: "{{ route('cust_confirm.index') }}",
            columns: [
                {data: 'quotation', name: 'quotation', title: 'Unduh', orderable:false, searchable:false},
                {data: 'action', name: 'action', title: 'Aksi', orderable:false, searchable:false},
                {data: 'id', name: 'id', title: 'Order ID'},
                {data: 'fullname', name: 'fullname', title: 'Pelanggan'},
                {data: 'name', name: 'name', title: 'Produk'},
                {data: 'prioritas', name: 'prioritas', title: 'Prioritas'},
                {data: 'tgl_order', name: 'tgl_order', title: 'Tanggal Order'},
                {data: 'status', name: 'status', title: 'Status'},
            ]
        });

        $('.hide-column').click(function(e) {
            e.preventDefault();
            
            var column = table.column( $(this).attr('data-column') );
            column.visible( ! column.visible() );
            table.draw();
        });
        $('#update_status').submit(function (event) {

            var formData = new FormData(this);
            formData.append('_token', '{{ csrf_token() }}');
            event.preventDefault();
            $.ajax({
                type: 'POST',
                url: '{{ route("cust_confirm.add", ':id') }}'.replace(':id',$('#id').val()),
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: (data) => {
                    table.draw();
                    UIkit.modal($("#modal-konfirmasi")).hide();
                },
                error: function (data) {
                    UIkit.modal.alert(data.responseJSON.message).then(function () {

                    })
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