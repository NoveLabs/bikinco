// $(document).ready(function(){
//     // Datatables Init
//     var table = $('#data-variant-table').DataTable({
//         processing: true,
//         serverSide: true,
//         retrieve: true,
//         pageLength: 10,
//         ajax: $(this).attr('data-source'),
//         columns: [
//             {data: 'id', name: 'id', title: 'No'},
//             {data: 'name', name: 'name', title: 'Varian'},
//             {data: 'product', name: 'product', title: 'Nama Produk'},
//             {data: 'created_at', name: 'created_at', title: 'Tanggal Input'},
//             {data: 'status', name: 'status', title: 'Status'},
//             {data: 'action', name: 'action', title: 'Tindakan', orderable: false, searchable: false},
//         ],
//     });
//
//     $('.data-variant-table-toggle').on('click', function(){
//         alert('hello');
//     });
//
// });







$('#add-variant-button').on('click', function(){
    $('#new-variant-name').parent().toggleClass('sc-input-focus');
});