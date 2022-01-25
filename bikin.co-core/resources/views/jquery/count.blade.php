<script type="text/javascript">
    $(document).ready(function () {
        $.ajax({
            type: 'GET',
            url: '{{ route('getdata.konfirmasi') }}',
            success: (data) => {
                if (data == 0) {
                    $('#jumlah_belum_konfirmasi').html('');
                } else {
                    $('#jumlah_belum_konfirmasi').html('<span class="uk-badge md-bg-green-600" >'+data+' </span>');                    
                }
            },
            error: function (data) {
               console.log(data);
            }
        });

        $.ajax({
            type: 'GET',
            url: '{{ route('getdata.pelunasan') }}',
            success: (data) => {
                if (data == 0) {
                    $('#jumlah_belum_konfirmasi_pelunasan').html('');
                } else {
                    $('#jumlah_belum_konfirmasi_pelunasan').html('<span class="uk-badge md-bg-green-600" >'+data+' </span>');
                }
            },
            error: function (data) {
               console.log(data);
            }
        });

        $.ajax({
            type: 'GET',
            url: '{{ route('getdata.verifikasi') }}',
            success: (data) => {
                if (data == 0) {
                    $('#jumlah_konfirmasi').html('');
                } else {
                    $('#jumlah_konfirmasi').html('<span class="uk-badge md-bg-green-600" >'+data+' </span>');                     
                }
            },
            error: function (data) {
               console.log(data);
            }
        });

        $.ajax({
            type: 'GET',
            url: '{{ route('getdata.verifikasipelunasan') }}',
            success: (data) => {
                if (data == 0) {
                    $('#jumlah_konfirmasi_pelunasan').html('');
                } else {
                    $('#jumlah_konfirmasi_pelunasan').html('<span class="uk-badge md-bg-green-600" >'+data+' </span>');
                }
            },
            error: function (data) {
               console.log(data);
            }
        });

        $.ajax({
            type: 'GET',
            url: '{{ route('getdata.vendor_order_masuk') }}',
            success: (data) => {
                if (data == 0) {
                    $('#order_masuk_vendor').html('');
                } else {
                    $('#order_masuk_vendor').html('<span class="uk-badge md-bg-green-600" >'+data+' </span>');
                }
            },
            error: function (data) {
               console.log(data);
            }
        });

        $.ajax({
            type: 'GET',
            url: '{{ route('cust_confirm.getData') }}',
            success: (data) => {
                if (data == 0) {
                    $('#jumlah_menunggu_konfirmasi').html('');
                } else {
                    $('#jumlah_menunggu_konfirmasi').html('<span class="uk-badge md-bg-green-600" >'+data+' </span>');
                }
            },
            error: function (data) {
               console.log(data);
            }
        });

        $.ajax({
            type: 'GET',
            url: '{{ route('getdata.vendor_order_proses') }}',
            success: (data) => {
                if (data == 0) {
                    $('#jumlah_vendor_order_proses').html('');
                } else {
                    $('#jumlah_vendor_order_proses').html('<span class="uk-badge md-bg-green-600" >'+data+' </span>');
                }
            },
            error: function (data) {
               console.log(data);
            }
        });
        $.ajax({
            type: 'GET',
            url: '{{ route('getdata.vendor_order_pelunasan') }}',
            success: (data) => {
                if (data == 0) {
                    $('#jumlah_vendor_konfirmasi_pelunasan').html('');
                } else {
                    $('#jumlah_vendor_konfirmasi_pelunasan').html('<span class="uk-badge md-bg-green-600" >'+data+' </span>');
                }
            },
            error: function (data) {
               console.log(data);
            }
        });

        $.ajax({
            type: 'GET',
            url: '{{ route('getdata.vendor_order_selesai') }}',
            success: (data) => {
                if (data == 0) {
                    $('#jumlah_vendor_order_selesai').html('');
                } else {
                    $('#jumlah_vendor_order_selesai').html('<span class="uk-badge md-bg-green-600" >'+data+' </span>');
                }
            },
            error: function (data) {
               console.log(data);
            }
        });

        $.ajax({
            type: 'GET',
            url: '{{ route('getdata.complain_vendor') }}',
            success: (data) => {
                if (data == 0) {
                    $('#jumlah_complain_vendor').html('');
                } else {
                    $('#jumlah_complain_vendor').html('<span class="uk-badge md-bg-green-600" >'+data+' </span>');
                }
            },
            error: function (data) {
               console.log(data);
            }
        });

        $.ajax({
            type: 'GET',
            url: '{{ route('verifikasi_artwork.count') }}',
            success: (data) => {
                if (data == 0) {
                    $('#jumlah_verifikasi_artwork').html('');
                } else {
                    $('#jumlah_verifikasi_artwork').html('<span class="uk-badge md-bg-green-600" >'+data+' </span>');
                }
            },
            error: function (data) {
               console.log(data);
            }
        });

        $.ajax({
            type: 'GET',
            url: '{{ route('order_item_step.count') }}',
            success: (data) => {
                if (data == 0) {
                    $('#jumlah_order_diproses').html('');
                } else {
                    $('#jumlah_order_diproses').html('<span class="uk-badge md-bg-green-600" >'+data+' </span>');
                }
            },
            error: function (data) {
               console.log(data);
            }
        });
        $.ajax({
            type: 'GET',
            url: '{{ route('shipment.count') }}',
            success: (data) => {
                if (data == 0) {
                    $('#jumlah_siap_dikirim').html('');
                } else {
                    $('#jumlah_siap_dikirim').html('<span class="uk-badge md-bg-green-600" >'+data+' </span>');
                }
            },
            error: function (data) {
               console.log(data);
            }
        });

        $.ajax({
            type: 'GET',
            url: '{{ route('order_dikirim.count') }}',
            success: (data) => {
                if (data == 0) {
                    $('#jumlah_order_dikirim').html('');
                } else {
                    $('#jumlah_order_dikirim').html('<span class="uk-badge md-bg-green-600" >'+data+' </span>');
                }
            },
            error: function (data) {
               console.log(data);
            }
        });
        });

    </script>