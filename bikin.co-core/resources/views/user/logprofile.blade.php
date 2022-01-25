@extends('layouts.app')

@section('content')
<div id="sc-page-wrapper">
    <div id="sc-page-content">
        <div class="uk-flex uk-flex-center">
            <div class="uk-width-5-5@l">
                <div data-uk-grid>
                    <div class="uk-width-2-4@l">
                        <div class="uk-card"">
                            <div class=" uk-card-body">
                            <div class="uk-text-center">
                                <div class="sc-user-profile-avatar fileinput fileinput-exists uk-margin-bottom"
                                    data-provides="fileinput">
                                    <div class="fileinput-new thumbnail thumbnail-lg">
                                        <img src="assets/img/blank.gif" alt="">
                                    </div>
                                    <div class="fileinput-preview fileinput-exists thumbnail thumbnail-lg">
                                        <img src="{{ $user->image  }}" class="sc-avatar " />
                                        <div class="user_avatar_controls">
                                            <span class="btn-file">
                                                <span class="fileinput-new"><i class="mdi mdi-upload"></i></span>
                                                <span class="fileinput-exists"><i class="mdi mdi-autorenew"></i></span>
                                                <input type="file" name="user_edit_avatar_control"
                                                    id="user_edit_avatar_control">
                                            </span>
                                            <a href="{{ route('profileSetting')}}" class="btn-file fileinput-exists" data-dismiss="fileinput"><i class="mdi mdi-account-edit">&#xE5CD;</i></a>
                                        </div>
                                    </div>
                                    <h4 class="uk-card-title">{{ $user->name }}</h4>
                                    <span class="sc-color-secondary">Sales Officer</span>
                                </div>
                                <ul class="uk-list uk-list-divider">
                                    <li class="sc-list-group">
                                        <div class="sc-list-addon">
                                            <i class="mdi mdi-email"></i>
                                        </div>
                                        <div class="sc-list-body">
                                            <div class="sc-list-body-inner">{{ $user->email }}</div>
                                        </div>
                                    </li>
                                    <li class="sc-list-group">
                                        <div class="sc-list-addon">
                                            <i class="mdi mdi-account-check-outline"></i>
                                        </div>
                                        <div class="sc-list-body">
                                            {{ $user->username }} </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="uk-width-expand@l">
                        <div class="uk-card">
                            <div class="uk-card-body">

                                <h4 class="uk-heading-line uk-margin-large-top"><span>Logs</span></h4>
                                <!-- order by id_user desc limit 10 -->
                                <div class="sc-timeline">
                                    @foreach ($logs as $log)
                                    <div class="sc-timeline-item">
                                        <div class="sc-timeline-date">{{ date('d M',strtotime($log->created_at)) }}
                                        </div>

                                        @if ($log->description == 'Login')
                                        <div class="sc-timeline-icon md-bg-green-500 sc-light">
                                            <i class="mdi mdi-file-document"></i>
                                        </div>
                                        @elseif($log->description == 'Logout')
                                        <div class="sc-timeline-icon md-bg-light-blue-500 sc-light">
                                            <i class="mdi mdi-comment"></i>
                                        </div>
                                        @else
                                        <div class="sc-timeline-icon md-bg-red-500 sc-light">
                                            <i class="mdi mdi-image"></i>
                                        </div>
                                        @endif

                                        <div class="sc-timeline-body sc-timeline-body-border">
                                            <h4 class="sc-timeline-header">{{ $log->description }}</h4>
                                            <span class="sc-timeline-meta">at
                                                {{ date('H i',strtotime($log->created_at)) }}
                                                - IP {{ $log->ip }}</span>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $(document).on('change', '#file', function () {
            var name = document.getElementById("file").files[0].name;
            var form_data = new FormData();
            var ext = name.split('.').pop().toLowerCase();
            if (jQuery.inArray(ext, ['gif', 'png', 'jpg', 'jpeg']) == -1) {
                alert("Invalid Image File");
            }
            var oFReader = new FileReader();
            oFReader.readAsDataURL(document.getElementById("file").files[0]);
            var f = document.getElementById("file").files[0];
            var fsize = f.size || f.fileSize;
            if (fsize > 2000000) {
                alert("Image File Size is very big");
            } else {
                form_data.append("file", document.getElementById('file').files[0]);
                form_data.append("_token", "{{ csrf_token() }}");

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    url: "{{ route('updatePhotoProfile', Auth::user()->id) }}",
                    method: "POST",
                    data: form_data,
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: function () {
                        $('#uploaded_image').html(
                            "<label class='text-success'>Image Uploading...</label>");
                    },
                    success: function (data) {
                        $('#uploaded_image').html(data);
                    }
                });
            }
        });
    });

</script>
@endsection
