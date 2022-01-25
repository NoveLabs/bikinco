@extends('layouts.app')

@push('css-dropify')
<link rel="stylesheet" href="{{ asset('assets/js/vendor/dropify/dropify.min.css') }}">
@endpush

@section('content')
<div id="sc-page-wrapper">
	<div id="sc-page-top-bar" class="sc-top-bar">
		<div class="sc-top-bar-content uk-flex uk-flex-middle uk-width-1-1">
			<ul class="uk-breadcrumb uk-margin-remove uk-flex uk-flex-middle">
				<li>
					<a href="/">
						<i class="mdi mdi-home"></i>
					</a>
				</li>
				<li>
					<a href="{{ route('customers') }}">
						Data Pelanggan
					</a>
				</li>
				<li>
					<span>Semua Pelanggan</span>
				</li>
			</ul>
		</div>
	</div>
	<div id="sc-page-content">
        <div class="uk-card uk-margin">
            <div class="uk-flex-middle sc-padding sc-padding-medium-ends uk-grid-small" data-uk-grid>
                <div class="uk-flex-1">
                    <h3 class="uk-card-title">Database Pelanggan</h3>
                </div>
                <div class="uk-width-auto@s">
                    <div id="sc-dt-buttons"></div>
                </div>
            </div>
            <hr class="uk-margin-remove">
            <div class="uk-card-body">
                <table id="sc-dt-buttons-table--" style="width: 100% !important;" class="customers-table uk-table uk-table-striped dt-responsive">
                    <thead>
                        <tr>
                            <th>Aksi</th>
                            <th>ID</th>
                            <th>Nama</th>
                            <th>Klaster</th>
                            <th>Instansi</th>
                            <th>Telepon</th>
                            <th>Repeat Order</th>
                            <th>Verifikasi</th>
                        </tr>
                    </thead>           
                </table>
            </div>
        </div>
	</div>
</div>

<!-- Add Modal -->
<div class="sc-fab-page-wrapper">
    <a href="#" onclick="$('#add_form').trigger('reset');$('select[name=province_id]').val('').change();" data-uk-toggle="target: #add-modal" class="sc-fab sc-fab-large md-bg-light-green-700 sc-fab-dark"><i class="mdi mdi-plus"></i></a>
</div>
<div id="add-modal" data-uk-modal>
	<div class="uk-modal-dialog uk-modal-body">
		<button class="uk-modal-close-default" type="button" data-uk-close></button>
        <form style="margin-right: 20px;" enctype="multipart/form-data" id="add_form" role="form" method="POST" action="" >
		<div class="uk-modal-body">
            <div class="custom-form-divider">
                <span class="custom-no-margin-bottom">Informasi Umum</span>
                <hr class="custom-hr">
            </div>
            <div class="uk-grid" data-uk-grid="">
                <div class="uk-width-1-2@l uk-width-1-1@s">
                    <label><div class="custom-form-labeller"><span>Nama Lengkap</span> <span class="custom-important-input"><sup>*</sup></span></div></label>
                    <input class="uk-input" name="fullname" required type="text" data-sc-input="outline">
                </div>
                <div class="uk-width-1-2@l uk-width-1-1@s">
                    <label><div class="custom-form-labeller"><span>Email</span> <span class="custom-important-input"><sup>*</sup></span></div></label>
                    <input class="uk-input" name="email" required type="email" data-sc-input="outline">
                </div>
            </div>
            <div class="uk-grid" data-uk-grid="">
                <div class="uk-width-1-2@l uk-width-1-1@s">
                    <label><div class="custom-form-labeller"><span>Perusahaan / Instansi</span> <span class="custom-important-input"><sup>*</sup></span></div></label>
                    <input class="uk-input" name="company_name" required type="text" data-sc-input="outline">
                </div>
                <div class="uk-width-1-2@l uk-width-1-1@s">
                    <label><div class="custom-form-labeller"><span>Nomor HP</span> <span class="custom-important-input"><sup>*</sup></span></div></label>
                    <input class="uk-input" name="mobile_phone" required type="number" data-sc-input="outline">
                </div>
            </div>
            <div class="uk-grid" data-uk-grid>
                <div class="uk-width-1-1@l uk-width-1-1@s">
                    <select name="work_id" required class="uk-select" data-sc-select2='{"placeholder": "Pilih Klaster", "allowClear": true }'>
                        <option value="" >Pilih Pekerjaan</option>
                        @foreach ($works as $item)
                            <option value="{{ $item->id }}" >{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <br><br>
            <div class="custom-form-divider">
                <span class="custom-no-margin-bottom">Informasi Lokasi</span>
                <hr class="custom-hr">
            </div>
            <div class="uk-grid" data-uk-grid="">
                <div class="uk-width-1-2@l uk-width-1-1@s">
                    <label for="select-basic"><div class="custom-form-labeller"><span>Provinsi</span> <span class="custom-important-input"><sup>*</sup></span></div></label>
                    <select name="province_id" id="province_id" onchange="return setCombobox(this.value, 'cities_id',  'Pilih Kota / Kabupaten');" required class="uk-select" data-sc-select2='{"placeholder": "Pilih Provinsi *", "allowClear": true }' required>
                        <option value="" >Pilih Provinsi</option>
                        @foreach ($provinces as $item)
                            <option value="{{ $item->id }}" >{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="uk-width-1-2@l uk-width-1-1@s">
                    <div class="custom-form-labeller"><span>Kota / Kabupaten</span> <span class="custom-important-input"><sup>*</sup></span></div>
                    <select name="cities_id" id="cities_id" required class="uk-select" data-sc-select2='{"placeholder": "Pilih Kabupaten / Kota *", "allowClear": true }' required>
                        <option value="" >Pilih Kota / Kabupaten</option>
                    </select>
                </div>
            </div>
            <div class="uk-grid" data-uk-grid="">
                <div class="uk-width-1-1@l uk-width-1-1@s">
                    <label><div class="custom-form-labeller"><span>Alamat Lengkap</span> <span class="custom-important-input"><sup>*</sup></span></div></label>
                    <textarea class="uk-textarea" name="address" rows="5" data-sc-input="outline"></textarea>
                </div>
            </div>
            <br>
            <div class="uk-width-1-1@l uk-width-1-1@s">
                <div class="custom-form-labeller"><span>Jenis Identitas</span> <span class="custom-important-input"></span></div>
                <select name="identity_id" onchange="return setPhotoRequired(this.value, 'photo');" class="uk-select" data-sc-select2='{"placeholder": "Pilih Jenis Identitas", "allowClear": true }'>
                    <option value="" >Pilih Jenis Identitas</option>
                    @foreach ($identities as $item)
                        <option value="{{ $item['id'] }}" >{{ $item['name'] }}</option>
                    @endforeach
                </select>
            </div>
            <br>
            <div class="uk-grid" data-uk-grid="">
                <div class="uk-width-1-1@l uk-width-1-1@s">
                    <label><div class="custom-form-labeller"><span>Unggah Identitas (Max 500KB)</span> <span class="custom-important-input"></span></div></label>
                    <input type="file" name="photo" max="500" accept=".jpg,.jpeg,.png" >
                </div>
            </div>
		</div>
		<p class="uk-text-right">
			<button class="sc-button sc-button-flat sc-button-flat-danger uk-modal-close" type="button">Batalkan</button>
			<button class="sc-button sc-button-primary sc-js-button-loading" type="submit" data-button-mode="light">Tambah Data Pelanggan</button>
		</p>
        </form>
	</div>
</div>
<!-- Add Modal - End Section -->

<!-- Edit Modal -->
<div id="edit-modal" data-uk-modal>
	<div class="uk-modal-dialog uk-modal-body">
		<button class="uk-modal-close-default" type="button" data-uk-close></button>
		<h2 class="uk-modal-title">Detail Pelanggan</h2>
		<!-- TODO-005 - Add Customer Form -->
		<div class="uk-modal-body uk-padding-remove">
			<div class="uk-grid" data-uk-grid="">
                <div class="uk-width-1-1@s" style="margin-left: 45%;">
                    <div class="sc-avatar-wrapper sc-avatar-wrapper-md">
                        <span class="sc-user-status away"></span>
                        <img src="assets/img/avatars/avatar_08_md.png" class="sc-avatar" alt="">
                    </div>
                </div>
				<div class="uk-width-1-2@l">
					<div class="sc-padding-medium">
						<ul class="uk-list uk-list-divider">
							<li class="sc-list-group">
								<div class="sc-list-addon"><i class="mdi mdi-account"></i></div>
								<div class="sc-list-body">
									<p class="uk-margin-remove sc-text-semibold">Nama Lengkap</p>
									<span class="sc-list-secondary-text fullname">Ananda Erditya Utama</span>
								</div>
							</li>
							<li class="sc-list-group">
								<div class="sc-list-addon"><i class="mdi mdi-email"></i></div>
								<div class="sc-list-body">
									<p class="uk-margin-remove sc-text-semibold">Email</p>
									<span class="sc-list-secondary-text email">ananda.erditya@gmail.com</span>
								</div>
							</li>
							<li class="sc-list-group">
								<div class="sc-list-addon"><i class="mdi mdi-phone"></i></div>
								<div class="sc-list-body">
									<p class="uk-margin-remove sc-text-semibold">No. Telepon</p>
									<span class="sc-list-secondary-text mobile_phone">0896-1185-6866</span>
								</div>
							</li>
                            <li class="sc-list-group">
								<div class="sc-list-addon"><i class="mdi mdi-account-details"></i></div>
								<div class="sc-list-body">
									<p class="uk-margin-remove sc-text-semibold">Klaster</p>
									<span class="sc-list-secondary-text work">Brand Owner</span>
								</div>
							</li>
							<li class="sc-list-group">
								<div class="sc-list-addon"><i class="mdi mdi-office-building"></i></div>
								<div class="sc-list-body">
									<p class="uk-margin-remove sc-text-semibold">Perusahaan / Instansi</p>
									<span class="sc-list-secondary-text company_name">Bikin.co</span>
								</div>
							</li>
                            <li class="sc-list-group">
								<div class="sc-list-addon"><i class="mdi mdi-attachment"></i></div>
								<div class="sc-list-body">
									<p class="uk-margin-remove sc-text-semibold">Jenis Identitas Verifikasi (<span class="identity"></span>)</p>
									<span class="sc-list-secondary-text identityUrl"></span>
								</div>
							</li>
						</ul>
					</div>
				</div>
				<div class="uk-width-1-2@l">
					<div class="sc-padding-medium">
						<ul class="uk-list uk-list-divider">
							<li class="sc-list-group">
								<div class="sc-list-addon"><i class="mdi mdi-map-marker"></i></div>
								<div class="sc-list-body">
									<p class="uk-margin-remove sc-text-semibold">Provinsi</p>
									<span class="sc-list-secondary-text province">Yogyakarta</span>
								</div>
							</li>
							<li class="sc-list-group">
								<div class="sc-list-addon"><i class="mdi mdi-city"></i></div>
								<div class="sc-list-body">
									<p class="uk-margin-remove sc-text-semibold">Kota / Kabupaten</p>
									<span class="sc-list-secondary-text cities">Kota Yogyakarta</span>
								</div>
							</li>
							<li class="sc-list-group">
								<div class="sc-list-addon"><i class="mdi mdi-home"></i></div>
								<div class="sc-list-body">
									<p class="uk-margin-remove sc-text-semibold">Alamat Lengkap</p>
									<span class="sc-list-secondary-text address">Jalan Degolan 03 RT.001/RW.003, Ngemplak, Selamn, Yogyakarta</span>
								</div>
							</li>
							<li class="sc-list-group">
								<div class="sc-list-addon"><i class="mdi mdi-cart"></i></div>
								<div class="sc-list-body">
									<p class="uk-margin-remove sc-text-semibold">Repeat Order</p>
									<span class="sc-list-secondary-text repeat_order"><span class="uk-label uk-label-success">Ya</span></span>
								</div>
							</li>
                            <li class="sc-list-group">
								<div class="sc-list-addon"><i class="mdi mdi-asterisk"></i></div>
								<div class="sc-list-body">
									<p class="uk-margin-remove sc-text-semibold">Status Akun</p>
									<span class="sc-list-secondary-text verified"><span class="uk-label uk-label-success">Aktif sejak 3 Maret 2020</span></span>
								</div>
							</li>
						</ul>
					</div>
				</div>
			</div>
            <!-- <div class="uk-width-1-1@l">
                <h3 class="uk-card-title">Riwayat Order</h3>
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
                                <th class="uk-table-shrink">Status</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                                                                                                            <tr>
                                    <td class="uk-text-right">1</td>
                                    <td class="uk-text-nowrap"><a href="#" class="sc-text-semibold">Samsung 128GB 100MB/s (U3) MicroSD</a></td>
                                    <td class="uk-text-nowrap">Claudie Wyman</td>
                                    <td>#aH7Ntw3lDG</td>
                                    <td class="uk-text-center">4</td>
                                    <td><span class="uk-label uk-label-danger">dibatalkan</span></td>
                                    <td><a href="#" class="mdi mdi-file-outline sc-icon-square"></a></td>
                                </tr>
                                                                                    <tr>
                                    <td class="uk-text-right">2</td>
                                    <td class="uk-text-nowrap"><a href="#" class="sc-text-semibold">Nintendo Switch – Neon Red and Neon Blue Joy-Con</a></td>
                                    <td class="uk-text-nowrap">Hailie Rowe</td>
                                    <td>#faAGFhgkyp</td>
                                    <td class="uk-text-center">4</td>
                                    <td><span class="uk-label uk-label-default">menunggu konfirmasi customer</span></td>
                                    <td><a href="#" class="mdi mdi-file-outline sc-icon-square"></a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div> -->


		</div>
		<div class="uk-grid" data-uk-grid>
			<div class="uk-width-1-2@l">
				<a class="sc-button sc-button-primary sc-js-button-wave-light add-order-btn">Tambah Order</a>
				<a class="sc-button sc-button-primary sc-js-button-wave-light edit-btn" >Edit</a>
				<a class="sc-button sc-button-warning sc-js-button-wave-light verification-btn" style="display:none;" >Verifikasi ?</a>
                <!-- <a class="sc-button sc-button-danger sc-js-button-wave-light" href="so-customer-edit.html">Blokir</a> -->
			</div>
			<div class="uk-width-1-2@l">
				<div class="uk-text-right">
                    <button class="sc-button sc-button-default sc-button-outline sc-js-button-wave uk-modal-close" type="button">Tutup</button>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Edit Modal - End Section -->
@endsection
    
@push('scripts')
<script>
    function showDetail(id)
    {
        UIkit.modal($("#edit-modal")).show();

        $.ajax({
            type: "GET",
            url: 'customers/' + id,
            success: function (data) {
                var repeatStatus = '<span class="uk-label uk-label-danger">Belum Order</span>';
                if (data.data.latest_ordering == 1) {
                    repeatStatus = '<span class="uk-label uk-label-warning">Tidak</span>';
                } else if (data.data.latest_ordering > 1) {
                    repeatStatus = '<span class="uk-label uk-label-success">Ya</span>';
                }

                var verifiedStatus = '<span class="uk-label uk-label-danger">Tidak Aktif</span>';
                if (data.data.is_verified == 1) {
                    verifiedStatus = '<span class="uk-label uk-label-success">Aktif sejak ' + data.data.fverified_date + '</span>';
                    $(".verification-btn").prop('style', 'display:none;');
                } else {
                    $(".verification-btn").prop('style', '');
                }

                //Set up data for edit modal
                $(".fullname").html(data.data.fullname);
                $(".email").html(data.data.email);
                $(".mobile_phone").html(data.data.mobile_phone);
                $(".work").html(data.data.has_work.name);
                $(".company_name").html(data.data.company_name);
                $(".identity").html(data.data.identity);
                $(".province").html(data.data.has_cities.has_province.name);
                $(".cities").html(data.data.has_cities.name);
                $(".address").html(data.data.address);
                $(".repeat_order").html(repeatStatus);
                $(".verified").html(verifiedStatus);

                if (data.data.identity != '' && data.data.photo != '') {
                    $(".identityUrl").html('<a href="/customer-download/' + id + '">Download</a>');
                } else {
                    $(".identityUrl").html('Tidak ada gambar');
                }

                //Set up action button..
                $(".add-order-btn").prop('href', '/new-order/' + id);
                $(".edit-btn").prop('href', '/customer/' + id);
                $(".verification-btn").attr('data-id', data.data.token);
            },
            error: function (data) {
                UIkit.modal.alert(data.responseJSON.message).then(function () {
                    
                });
            }
        });
    }   

    function setCombobox(id, childId, headLabel = '', editId = 0)
    {
        if (headLabel == null || headLabel == '') {
            headLabel = 'Pilih';
        }

        if (id == null || id == 0) {
            $("#" + childId).empty();
            
            return;
        }

        $.ajax({
            url: 'cities-by-prov/' + id,
            dataType: 'json',
            success: function(data) { 
                var len = data.data.length;

                $("#" + childId).empty();
                $("#" + childId).append("<option value='0' >" + headLabel + "</option>");

                for(var i = 0; i<len; i++) {
                    var id = data.data[i]['id'];
                    var name = data.data[i]['name'];

                    var selected = '';
                    if (editId != 0 && id == editId) {
                        selected = 'selected';
                    }
                    
                    $("#" + childId).append("<option value='" + id + "' " + selected + " >" + name + "</option>");
                }
            }
        });
    }

    function setPhotoRequired(id, field)
    {
        if (id != '' && id != 0) {
            $("input[name=" + field + "]").prop('required', true);
        } else {
            $("input[name=" + field + "]").prop('required', false);
        }

        return;
    }

	$(document).ready(function () {
		$('#pdev').addClass("sc-page-active");

        // Initialize DataTable
        var table = $('.customers-table').DataTable({
            processing: true,
            serverSide: true,
            retrieve: true,
            pageLength: 10,
            ajax: "{{ route('customers') }}",
            columns: [
                {data: 'action', name: 'action', title: 'Aksi', orderable: false, searchable: false},
                {data: 'alias_id', name: 'id', title: 'ID'},
                {data: 'fullname', name: 'fullname', title: 'Nama'},
                {data: 'alias_work', name: 'hasWork.name', title: 'Klaster', orderable: false},
                {data: 'company_name', name: 'company_name', title: 'Instansi', orderable: false},
                {data: 'mobile_phone', name: 'mobile_phone', title: 'Telepon'},
                {data: 'repeat_order', name: 'repeat_order', title: 'Repeat Order', orderable: false, searchable: false},
                {data: 'is_verified', name: 'is_verified', title: 'Verifikasi', orderable: false, searchable: false},
            ],
            // dom: 'Blftip',
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ],
            /*
            buttons: [
				{
					extend: "copy",
					className: "sc-button",
					text: 'Copy'
				},
				{
					extend: "csv",
					className: "sc-button",
					text: 'CSV '
				},
				{
					extend: "excel",
					className: "sc-button",
					text: 'Excel '
				},
				{
					extend: "pdf",
					className: "sc-button sc-button-icon",
					text: '<i class="mdi mdi-file-pdf md-color-red-800"></i>'
				},
				{
					extend: "print",
					className: "sc-button sc-button-icon",
					text: '<i class="mdi mdi-printer"></i>',
					title: 'Custom Title',
					messageTop: 'Custom message on the top',
					messageBottom: 'Custom message on the bottom',
					autoPrint: true
				}
			]
            */
        });

		table.buttons().container().appendTo($('#sc-dt-buttons'));

        $(".verification-btn").click(function() {
            var token = $(this).attr('data-id');

            if (token == 0 || token == '') {
                UIkit.modal.alert('Tidak menemukan Token, mohon refresh halaman ini.');
                return;
            }

            $.ajax({
                type: 'GET',
                url: "customer-verification/" + token,
                cache: false,
                contentType: false,
                processData: false,
                success: (data) => {
                    UIkit.modal.alert(data.message).then(function () {
                        
                    });

                    UIkit.modal($("#edit-modal")).hide();
                },
                error: function(data) {
                    UIkit.modal.alert(data.responseJSON.message).then(function () {
                        
                    });
                }
            });

            table.draw();
        });

        //Add action
        $('#add_form').submit(function(event){
            event.preventDefault();

            var formData = new FormData(this);
            formData.append('_token', '{{ csrf_token() }}');

            $.ajax({
                type: 'POST',
                url: "{{ route('customers.add') }}",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: (data) => {
                    UIkit.modal.alert(data.message).then(function () {
                        
                    });

                    UIkit.modal($("#add-modal")).hide();
                    table.ajax.reload();
                },
                error: function(data) {
                    UIkit.modal.alert(data.responseJSON.message).then(function () {
                        
                    });
                }
            });

            table.draw();
        });
	});
</script>
@endpush

@push('dropify')
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script> -->
<script src="{{ asset('assets/js/vendor/dropify/dropify.min.js') }}"></script>
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