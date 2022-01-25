@extends('layouts.app')

@section('content')
<div id="sc-page-wrapper">
    <div id="sc-page-content">
        <div class="uk-card">
            <h3 class="uk-card-title">Admin Management</h3>
            <div class="uk-card-body">
                <table id="sc-dt-basic" class="uk-table uk-table-striped dt-responsive">
                    <thead>
                        <tr>
                            <th>Nama Lengkap</th>
                            <th>Email</th>
                            <th>Username</th>
                            <th>Role</th>
                            <th class="uk-text-nowrap">Last Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->username }}</td>
                            <td>
                                @foreach ($user->roles as $selectedRole)
                                    <span class="sc-timeline-meta">
                                    <span class="uk-label uk-label-success">{{ ($selectedRole->name) }}</span>
                                @endforeach
                            </td>
                        {{-- <td>{{ $user->lastLog() }}</td> --}}
                        <td>
                            @foreach ($user->lastLog() as $item)
                            {{$item->description}} at {{ date('H i',strtotime($item->created_at)) }}
                            @endforeach
                        </td>
                            <td>
                                <button class="sc-button sc-button-outline sc-button-outline-success sc-js-button-wave-success reset-password"
                                    data-uk-toggle="target: #reset-confirm" data-id="{{ $user->id }}" >Reset Sandi</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Nama Lengkap</th>
                            <th>Email</th>
                            <th>Username</th>
                            <th>Role</th>
                            <th>Last Status</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

    </div>
</div>

<div class="sc-fab-page-wrapper">
    <a href="#modal-overflow" data-uk-toggle class="sc-fab sc-fab-text sc-fab-success"><i
            class="mdi mdi-plus"></i>Add</a>
</div>

<!-- start modal input -->
<div id="modal-overflow" data-uk-modal>
    <div class="uk-modal-dialog">
        <button class="uk-modal-close-default" type="button" data-uk-close></button>
        <div class="uk-modal-header">
            <h2 class="uk-modal-title">Tambah Akun Manajemen</h2>
        </div>
        <div class="uk-modal-body" data-uk-overflow-auto>
            <form action="{{ route('userAdd' ) }}" method="post"">
                @csrf
                <fieldset class="uk-fieldset md-bg-grey-100 sc-padding">
                    <div class="uk-margin">
                        <div class="uk-grid-small uk-flex-middle" data-uk-grid>
                            <div class="uk-width-1-4@m">
                                <label class="sc-color-secondary" for="settings-page-title">Fullname</label>
                            </div>
                            <div class="uk-width-expand">
                                <input type="text" class="uk-input" name="name" id="settings-page-title" data-sc-input
                                    required>
                            </div>
                        </div>
                    </div>
                    <div class="uk-margin">
                        <div class="uk-grid-small uk-flex-middle" data-uk-grid>
                            <div class="uk-width-1-4@m">
                                <label class="sc-color-secondary" for="settings-page-slogan">Email</label>
                            </div>
                            <div class="uk-width-expand">
                                <input type="text" class="uk-input" name="email" id="settings-page-slogan" data-sc-input
                                    required>
                            </div>
                        </div>
                    </div>
                    <div class="uk-margin">
                        <div class="uk-grid-small uk-flex-middle" data-uk-grid>
                            <div class="uk-width-1-4@m">
                                <label class="sc-color-secondary" for="settings-page-slogan">Username</label>
                            </div>
                            <div class="uk-width-expand">
                                <input type="text" class="uk-input" name="username" id="settings-page-slogan"
                                    data-sc-input required>
                            </div>
                        </div>
                    </div>
                    <div class="uk-margin">
                        <div class="uk-grid-small uk-flex-middle" data-uk-grid>
                            <div class="uk-width-1-4@m">
                                <label class="sc-color-secondary" for="settings-page-keywords">Stakeholder Role</label>
                            </div>
                            <div class="uk-width-expand">
                                <select name="role[]" id="settings-page-keywords" class="uk-select"
                                    data-sc-select2='{"tags": true, "tokenSeparators": [","], "closeOnSelect": true}'
                                    multiple required>
                                    @foreach ($role as $roleuser)
                                    <option value="{{ $roleuser->id }}">
                                        {{ $roleuser->name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="sc-button sc-button-primary" style="width: 100%;" type="button">Tambah
                        Akun Manajemen</button>
                </fieldset>
            </div>
            <hr class="uk-margin-remove">
            </form>
        </div>
    </div>
<!-- end modal input -->

<div id="reset-confirm" data-uk-modal>
    <div class="uk-modal-dialog uk-modal-body">
        <h2 class="uk-modal-title">Yakin Anda akan melakukan reset sandi akun tersebut ?</h2>

            <form action="{{ route('userResetPassword')}}" class="uk-text-right" method="POST">
                @csrf
                <input type="hidden" value="" id="iduser" name="id">
                <button class="sc-button sc-button-default sc-button-flat uk-modal-close" type="button">Batal</button>
                <button class="sc-button sc-button-md" type="submit">Reset Sandi</button>
                <!-- sandi akan tereset static menjadi : sayaadminbikinco -->
            </form>

    </div>
</div>
@endsection
@push('scripts')
    <script>
        $(".reset-password").click(function(){
            var id = $(this).data('id');
            $('#iduser').val(id);
        });
    </script>
@endpush