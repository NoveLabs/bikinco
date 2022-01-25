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
					<span>Edit Data Pelanggan</span>
				</li>
			</ul>
		</div>
	</div>
	<div id="sc-page-content">
		<div class="uk-flex-center" data-uk-grid>
			<div class="uk-width-2-3@l">
                <form style="margin-right: 20px;" enctype="multipart/form-data" id="edit_form" role="form" method="POST" action="" >
                <input name="edit-customers-id" value="{{ $data->id }}" required type="hidden" >
				<div class="uk-card">
					<div class="uk-card-header uk-margin-bottom">
						<div class="uk-flex uk-flex-middle">
							<h3 class="uk-card-title uk-flex-1">
								Edit Data Pelanggan
							</h3>
							<i data-uk-icon="icon: commenting; ratio: 1.5" class="uk-margin-left md-color-red-600"></i>
						</div>
					</div>
					<div class="uk-card-body">
                        <div class="custom-form-divider">
                            <span class="custom-no-margin-bottom">Informasi Umum</span>
                            <hr class="custom-hr">
                        </div>
                        <div class="uk-grid" data-uk-grid="">
                            <div class="uk-width-1-2@l uk-width-1-1@s">
                                <label><div class="custom-form-labeller"><span>Nama Lengkap</span> <span class="custom-important-input"><sup>*</sup></span></div></label>
                                <input class="uk-input" name="fullname" value="{{ $data->fullname}}" required type="text" data-sc-input="outline">
                            </div>
                            <div class="uk-width-1-2@l uk-width-1-1@s">
                                <label><div class="custom-form-labeller"><span>Email</span> <span class="custom-important-input"><sup>*</sup></span></div></label>
                                <input class="uk-input" name="email" value="{{ $data->email}}" required type="email" data-sc-input="outline">
                            </div>
                        </div>
                        <div class="uk-grid" data-uk-grid="">
                            <div class="uk-width-1-2@l uk-width-1-1@s">
                                <label><div class="custom-form-labeller"><span>Perusahaan / Instansi</span> <span class="custom-important-input"><sup>*</sup></span></div></label>
                                <input class="uk-input" name="company_name" value="{{ $data->company_name}}" required type="text" data-sc-input="outline">
                            </div>
                            <div class="uk-width-1-2@l uk-width-1-1@s">
                                <label><div class="custom-form-labeller"><span>Nomor HP</span> <span class="custom-important-input"><sup>*</sup></span></div></label>
                                <input class="uk-input" name="mobile_phone" value="{{ $data->mobile_phone}}" required type="number" data-sc-input="outline">
                            </div>
                        </div>
                        <div class="uk-grid" data-uk-grid>
                            <div class="uk-width-1-1@l uk-width-1-1@s">
                                <select name="work_id" class="uk-select" data-sc-select2='{"placeholder": "Pilih Klaster", "allowClear": true }'>
                                    <option value="" >Pilih Pekerjaan</option>
                                    @foreach ($works as $item)
                                        <option value="{{ $item->id }}" @if ($data->work_id == $item->id) selected @endif >{{ $item->name }}</option>
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
                                <select name="province_id" onchange="return setCombobox(this.value, 'cities_id',  'Pilih Kota / Kabupaten');" class="uk-select" data-sc-select2='{"placeholder": "Pilih Provinsi *", "allowClear": true }' required>
                                    <option value="" >Pilih Provinsi</option>
                                    @foreach ($provinces as $item)
                                        <option value="{{ $item->id }}" @if ($data->hasCities->hasProvince->id == $item->id) selected @endif >{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="uk-width-1-2@l uk-width-1-1@s">
                                <div class="custom-form-labeller"><span>Kota / Kabupaten</span> <span class="custom-important-input"><sup>*</sup></span></div>
                                <select name="cities_id" id="cities_id" class="uk-select" data-sc-select2='{"placeholder": "Pilih Kabupaten / Kota *", "allowClear": true }' required>
                                    <option value="" >Pilih Kota / Kabupaten</option>
                                    @foreach ($cities as $item)
                                        <option value="{{ $item->id }}" @if ($data->hasCities->id == $item->id) selected @endif >{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="uk-grid" data-uk-grid="">
                            <div class="uk-width-1-1@l uk-width-1-1@s">
                                <label><div class="custom-form-labeller"><span>Alamat Lengkap</span> <span class="custom-important-input"><sup>*</sup></span></div></label>
                                <textarea class="uk-textarea" name="address" rows="5" data-sc-input="outline">{{ $data->address }}</textarea>
                            </div>
                        </div>
                        <br>
                        <div class="uk-width-1-1@l uk-width-1-1@s">
                            <div class="custom-form-labeller"><span>Jenis Identitas</span> <span class="custom-important-input"></span></div>
                            <select name="identity_id" onchange="return setPhotoRequired(this.value, 'photo');" class="uk-select" data-sc-select2='{"placeholder": "Pilih Jenis Identitas", "allowClear": true }'>
                                    <option value="" >Pilih Jenis Identitas</option>
                                    @foreach ($identities as $item)
                                        <option value="{{ $item['id'] }}" @if ($data->identity_id == $item['id']) selected @endif >{{ $item['name'] }}</option>
                                    @endforeach
                            </select>
                        </div>
                        <br>
                        <div class="uk-grid" data-uk-grid="">
                            <div class="uk-width-1-1@l uk-width-1-1@s">
                                @if (!empty($data->photo))
                                    <img width="400" height="600" src="/{{ $data->photo }}" alt="">
                                @endif

                                <label><div class="custom-form-labeller"><span>Unggah Identitas (Max 500KB)</span> <span class="custom-important-input"></span></div></label>
                                <input type="file" name="photo" max="500" accept=".jpg,.jpeg,.png" @if ($data->identity_id != 0 and empty($data->photo)) required @endif >
                            </div>
                        </div>
                        <br><br>
                        <div>
                            <p class="uk-text-left">
                                <button type="submit" class="sc-button sc-button-primary sc-js-button-loading" data-button-mode="light">Perbarui Data Pelanggan</button>
                                <a href="{{ route('customers') }}" class="sc-button  sc-button-flat sc-button-flat-danger uk-modal-close">Kembali</a>
                            </p>
                        </div>
					</div>
				</div>
                </form>
			</div>
		</div>
	</div>
</div>

<!-- Add Modal -->

<!-- Add Modal - End Section -->

<!-- Edit Modal -->

<!-- Edit Modal - End Section -->
@endsection
    
@push('scripts')
<script>
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
            url: '/cities-by-prov/' + id,
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

        //Add action
        $('#edit_form').submit(function(event){
            event.preventDefault();

            var id = $("input[name=edit-customers-id]").val();

            var formData = new FormData(this);
            formData.append('_token', '{{ csrf_token() }}');

            if (id == 0 || id == '') {
                UIkit.modal.alert('Tidak menemukan ID, mohon refresh halaman ini.');
                
                return;
            }

            $.ajax({
                type: 'POST',
                url: "/customers/" + id,
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: (data) => {
                    UIkit.modal.alert(data.message).then(function () {
                        
                    });

                    location.href = '/customers';
                },
                error: function(data) {
                    var errMessage = data.responseJSON.message;
                    if (data.responseJSON.errors.photo.length > 0) {
                        errMessage = '';

                        var i = 0;
                        data.responseJSON.errors.photo.forEach(function(item) {
                            errMessage += item;

                            i++;

                            if (i < data.responseJSON.errors.photo.length) {
                                errMessage += ', ';
                            }
                        });
                    }

                    UIkit.modal.alert(errMessage).then(function () {
                        
                    });
                }
            });
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