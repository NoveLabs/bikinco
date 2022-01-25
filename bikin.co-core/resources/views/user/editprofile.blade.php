@extends('layouts.app')

@section('content')
<div id="sc-page-wrapper">
	<div id="sc-page-content">
        <div class="uk-flex uk-flex-center">
			<div class="uk-width-4-5@l">
				<div data-uk-grid>
					<div class="uk-width-1-4@m uk-width-1-5@l">
						<ul class="uk-subnav uk-subnav-pill uk-flex-column" data-uk-switcher="connect: .sc-settings-container; animation: uk-animation-slide-bottom-small; swiping: false" data-uk-sticky="offset:72;media: @s">
							<li><a href="#"><span class="uk-flex uk-flex-middle uk-text-medium sc-text-semibold"><i class="mdi mdi-cogs uk-margin-medium-right"></i>Edit Profile</span></a></li>
							<li><a href="#"><span class="uk-flex uk-flex-middle uk-text-medium sc-text-semibold"><i class="mdi mdi-shield-key uk-margin-medium-right"></i>Reset Password</span></a></li>
							<li><a href="#"><span class="uk-flex uk-flex-middle uk-text-medium sc-text-semibold"><i class="mdi mdi-email-check uk-margin-medium-right"></i>Email Setting</span></a></li>
						</ul>
					</div>
					<div class="uk-width-3-4@m uk-width-4-5@l">
						<ul class="uk-switcher sc-settings-container">
							<li>
								<div class="uk-card">
                                    <form action="{{ route('updateProfile', Auth::user()->id ) }}" method="post">
                                        @csrf
									<div class="uk-flex uk-flex-middle sc-theme-bg-dark sc-light sc-round-top sc-padding sc-padding-medium-ends">
										<h3 class="uk-card-title uk-flex-1">
											Edit Profile
											<span class="uk-display-block uk-card-subtitle">Change your profile informations.</span>
										</h3>
										<div class="uk-margin-left">
											<button class="sc-button" type="submit">Save</button>
										</div>
									</div>
									<hr class="uk-margin-remove">
									<div class="uk-card-body">
										<div class="uk-margin">
											<div class="uk-grid-small uk-flex-middle" data-uk-grid>
												<div class="uk-width-1-4@m">
													<label class="sc-color-secondary" for="settings-page-title">Fullname</label>
												</div>
												<div class="uk-width-expand">
                                                <input type="text" class="uk-input" name="name" id="settings-page-title" data-sc-input value="{{ Auth::user()->name }}">
												</div>
											</div>
										</div>
										<div class="uk-margin">
											<div class="uk-grid-small uk-flex-middle" data-uk-grid>
												<div class="uk-width-1-4@m">
													<label class="sc-color-secondary" for="settings-page-slogan">Username</label>
												</div>
												<div class="uk-width-expand">
                                                <input type="text" class="uk-input" name="username" value="{{ Auth::user()->username }}" id="settings-page-slogan" data-sc-input>
												</div>
											</div>
										</div>
										<div class="uk-margin">
											<div class="uk-grid-small uk-flex-middle" data-uk-grid>
												<div class="uk-width-1-4@m">
													<label class="sc-color-secondary" for="settings-page-keywords">Stakeholder Role</label>
												</div>
												<div class="uk-width-expand">
													<select name="role[]" id="settings-page-keywords" class="uk-select" data-sc-select2='{"tags": true, "tokenSeparators": [","], "closeOnSelect": true}' multiple>
                                                        
                                                        @foreach ($role as $roleuser)
                                                            <option value="{{ $roleuser->id }}" 
                                                                {{ in_array($roleuser->id, $userRoles) ? 'selected' : '' }}>
                                                                 {{ $roleuser->name }} 
                                                                </option>
                                                         @endforeach

													</select>
												</div>
											</div>
										</div>
                                    </div>
                                </form>
								</div>
							</li>
							<li>
								<form action="{{ route('password.update',Auth::user()->id ) }}" method="post">
									@csrf
									
									<div class="uk-card">
                                    <div class="uk-flex uk-flex-middle sc-theme-bg-dark sc-light sc-round-top sc-padding sc-padding-medium-ends">
                                        <h3 class="uk-card-title uk-flex-1">
                                            Change Password
                                            <span class="uk-display-block uk-card-subtitle">Change your account security code.</span>
                                        </h3>
                                        <div class="uk-margin-left">
											<button class="sc-button" type="submit">Change</button>
										</div>
                                    </div>
                                    <hr class="uk-margin-remove">
									<div class="uk-card-body">
                                        <div class="uk-margin">
											<div class="uk-grid-small uk-flex-middle" data-uk-grid>
												<div class="uk-width-1-4@m">
													<label class="sc-color-secondary" for="settings-page-title">Input Old Password*</label>
												</div>
												<div class="uk-width-expand">
												<input type="password" class="uk-input" name="oldpassword" id="settings-page-title" data-sc-input>
												</div>
											</div>
										</div>
										<div class="uk-margin">
											<div class="uk-grid-small uk-flex-middle" data-uk-grid>
												<div class="uk-width-1-4@m">
													<label class="sc-color-secondary" for="settings-page-slogan">New Password*</label>
												</div>
												<div class="uk-width-expand">
													<input type="password" class="uk-input" name="password" id="settings-page-slogan" data-sc-input>
												</div>
											</div>
                                        </div>
                                        <div class="uk-margin">
											<div class="uk-grid-small uk-flex-middle" data-uk-grid>
												<div class="uk-width-1-4@m">
													<label class="sc-color-secondary" for="settings-page-slogan">Retype New Password*</label>
												</div>
												<div class="uk-width-expand">
													<input type="password" class="uk-input" name="password_confirmation"  id="settings-page-slogan" data-sc-input>
												</div>
											</div>
										</div>
									</div>
								</div>
								</form>
							</li>
							<li>
								<form action="{{ route('updateEmail',Auth::user()->id ) }}" method="post">
									@csrf
                                <div class="uk-card">
                                    <div class="uk-flex uk-flex-middle sc-theme-bg-dark sc-light sc-round-top sc-padding sc-padding-medium-ends">
                                        <h3 class="uk-card-title uk-flex-1">
                                            Email Setting
                                            <span class="uk-display-block uk-card-subtitle">You can change the email credential of your account.</span>
                                        </h3>
                                        <div>
                                            <button class="sc-button" type="submit">Update Email</button>
                                        </div>
                                    </div>
                                    <hr class="uk-margin-remove">
                                    <div class="uk-card-body">
                                        <div class="uk-margin">
											<div class="uk-grid-small uk-flex-middle" data-uk-grid>
												<div class="uk-width-1-4@m">
													<label class="sc-color-secondary" for="settings-page-title">Current Email*</label>
												</div>
												<div class="uk-width-expand">
												<input type="text" class="uk-input" name="settings-page-title" id="settings-page-title" readonly data-sc-input value="{{ Auth::user()->email }}" disabled>
												</div>
											</div>
                                        </div>
                                        <div class="uk-margin">
											<div class="uk-grid-small uk-flex-middle" data-uk-grid>
												<div class="uk-width-1-4@m">
													<label class="sc-color-secondary" for="settings-page-slogan">New Email*</label>
												</div>
												<div class="uk-width-expand">
													<input type="text" class="uk-input" name="email" value="" id="settings-page-slogan" data-sc-input required>
												</div>
											</div>
                                        </div>
										<div class="uk-margin">
											<div class="uk-grid-small uk-flex-middle" data-uk-grid>
												<div class="uk-width-1-4@m">
													<label class="sc-color-secondary" for="settings-page-slogan">Type Current Password*</label>
												</div>
												<div class="uk-width-expand">
													<input type="password" class="uk-input" name="password"  id="settings-page-slogan" data-sc-input required>
												</div>
											</div>
                                        </div>
                                        <div class="uk-margin">
											<div class="uk-grid-small uk-flex-middle" data-uk-grid>
												<div class="uk-width-1-4@m">
													<label class="sc-color-secondary" for="settings-page-slogan">Retype Password*</label>
												</div>
												<div class="uk-width-expand">
													<input type="password" class="uk-input" name="password_confirmation" id="settings-page-slogan" data-sc-input required>
												</div>
											</div>
										</div>
									</div> 
								</div>
								</form>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection