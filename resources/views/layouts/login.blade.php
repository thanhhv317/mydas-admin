<!DOCTYPE html>
<html lang="en">

	<!-- begin::Head -->
	<head>
		<base href="../../../">
		<meta charset="utf-8" />
		<title>Login </title>
		<meta name="description" content="Login page example">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<!--begin::Fonts -->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700|Roboto:300,400,500,600,700">

		<!--end::Fonts -->

		<!--begin::Page Custom Styles(used by this page) -->
		<link href="assets/css/pages/login/login-4.css" rel="stylesheet" type="text/css" />

		<!--end::Page Custom Styles -->

		<!--begin::Global Theme Styles(used by all pages) -->
		<link href="assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
		<link href="assets/css/style.bundle.css" rel="stylesheet" type="text/css" />

		<!--end::Global Theme Styles -->

		<!--begin::Layout Skins(used by all pages) -->

		<!--end::Layout Skins -->
		<link rel="shortcut icon" href="assets/media/logos/favicon.ico" />
	</head>

	<!-- end::Head -->

	<!-- begin::Body -->
	<body class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--enabled kt-subheader--transparent kt-aside--enabled kt-aside--fixed kt-page--loading">

		<!-- begin:: Page -->
		<div class="kt-grid kt-grid--ver kt-grid--root kt-page">
			<div class="kt-grid kt-grid--hor kt-grid--root  kt-login kt-login--v4 kt-login--signin" id="kt_login">
				<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" style="background-image: url(assets/media/bg/bg-2.jpg);">
					<div class="kt-grid__item kt-grid__item--fluid kt-login__wrapper">
						<div class="kt-login__container">
							<div class="kt-login__logo">
								<a href="#">
									<img src="assets/media/logos/logo-5.png">
								</a>
							</div>
							<div class="kt-login__signin">
								<div class="kt-login__head">
									<h3 class="kt-login__title">Sign In To Admin</h3>
								</div>
								<form class="kt-form" action="">
									@csrf
									<div class="input-group">
										<input class="form-control" type="text" placeholder="Username" name="username" autocomplete="off">
									</div>
									<div class="input-group">
										<input class="form-control" type="password" placeholder="Password" name="password">
									</div>
									<div class="row kt-login__extra">
										<div class="col">
											<label class="kt-checkbox">
												<input type="checkbox" name="remember"> Remember me
												<span></span>
											</label>
										</div>
										<div class="col kt-align-right">
											<a href="javascript:;" id="kt_login_forgot" class="kt-login__link">Forget Password ?</a>
										</div>
									</div>
									<div class="kt-login__actions">
										<button id="kt_login_signin_submit" class="btn btn-brand btn-pill kt-login__btn-primary">Sign In</button>
									</div>
								</form>
							</div>
							<div class="kt-login__signup">
								<div class="kt-login__head">
									<h3 class="kt-login__title">Sign Up</h3>
									<div class="kt-login__desc">Enter your details to create your account:</div>
								</div>
								<form class="kt-form" action="">
									<div class="input-group">
										<input class="form-control" type="text" placeholder="Fullname" name="fullname">
									</div>
									<div class="input-group">
										<input class="form-control" type="text" placeholder="Email" name="email" autocomplete="off">
									</div>
									<div class="input-group">
										<input class="form-control" type="password" placeholder="Password" name="password">
									</div>
									<div class="input-group">
										<input class="form-control" type="password" placeholder="Confirm Password" name="rpassword">
									</div>
									<div class="row kt-login__extra">
										<div class="col kt-align-left">
											<label class="kt-checkbox">
												<input type="checkbox" name="agree">I Agree the <a href="#" class="kt-link kt-login__link kt-font-bold">terms and conditions</a>.
												<span></span>
											</label>
											<span class="form-text text-muted"></span>
										</div>
									</div>
									<div class="kt-login__actions">
										<button id="kt_login_signup_submit" class="btn btn-brand btn-pill kt-login__btn-primary">Sign Up</button>&nbsp;&nbsp;
										<button id="kt_login_signup_cancel" class="btn btn-secondary btn-pill kt-login__btn-secondary">Cancel</button>
									</div>
								</form>
							</div>
							<div class="kt-login__forgot">
								<div class="kt-login__head">
									<h3 class="kt-login__title">Forgotten Password ?</h3>
									<div class="kt-login__desc">Enter your email to reset your password:</div>
								</div>
								<form class="kt-form" action="">
									<div class="input-group">
										<input class="form-control" type="text" placeholder="Email" name="email" id="kt_email" autocomplete="off">
									</div>
									<div class="kt-login__actions">
										<button id="kt_login_forgot_submit" class="btn btn-brand btn-pill kt-login__btn-primary">Request</button>&nbsp;&nbsp;
										<button id="kt_login_forgot_cancel" class="btn btn-secondary btn-pill kt-login__btn-secondary">Cancel</button>
									</div>
								</form>
							</div>
							<div class="kt-login__account">
								<span class="kt-login__account-msg">
									Don't have an account yet ?
								</span>
								&nbsp;&nbsp;
								<a href="javascript:;" id="kt_login_signup" class="kt-login__account-link">Sign Up!</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- end:: Page -->

		<!-- begin::Global Config(global config for global JS sciprts) -->
		<script>
			var KTAppOptions = {
				"colors": {
					"state": {
						"brand": "#2c77f4",
						"light": "#ffffff",
						"dark": "#282a3c",
						"primary": "#5867dd",
						"success": "#34bfa3",
						"info": "#36a3f7",
						"warning": "#ffb822",
						"danger": "#fd3995"
					},
					"base": {
						"label": ["#c5cbe3", "#a1a8c3", "#3d4465", "#3e4466"],
						"shape": ["#f0f3ff", "#d9dffa", "#afb4d4", "#646c9a"]
					}
				}
			};
		</script>

		<!-- end::Global Config -->

		<!--begin::Global Theme Bundle(used by all pages) -->
		<script src="assets/plugins/global/plugins.bundle.js" type="text/javascript"></script>
		<script src="assets/js/scripts.bundle.js" type="text/javascript"></script>

		<!--end::Global Theme Bundle -->

		<!--begin::Page Scripts(used by this page) -->
		<script>
			"use strict";

			// Class Definition
			var KTLoginGeneral = function() {

				var login = $('#kt_login');

				var showErrorMsg = function(form, type, msg) {
					var alert = $('<div class="alert alert-' + type + ' alert-dismissible" role="alert">\
						<div class="alert-text">'+msg+'</div>\
						<div class="alert-close">\
							<i class="flaticon2-cross kt-icon-sm" data-dismiss="alert"></i>\
						</div>\
					</div>');

					form.find('.alert').remove();
					alert.prependTo(form);
					//alert.animateClass('fadeIn animated');
					KTUtil.animateClass(alert[0], 'fadeIn animated');
					alert.find('span').html(msg);
				}

				// Private Functions
				var displaySignUpForm = function() {
					login.removeClass('kt-login--forgot');
					login.removeClass('kt-login--signin');

					login.addClass('kt-login--signup');
					KTUtil.animateClass(login.find('.kt-login__signup')[0], 'flipInX animated');
				}

				var displaySignInForm = function() {
					login.removeClass('kt-login--forgot');
					login.removeClass('kt-login--signup');

					login.addClass('kt-login--signin');
					KTUtil.animateClass(login.find('.kt-login__signin')[0], 'flipInX animated');
					//login.find('.kt-login__signin').animateClass('flipInX animated');
				}

				var displayForgotForm = function() {
					login.removeClass('kt-login--signin');
					login.removeClass('kt-login--signup');

					login.addClass('kt-login--forgot');
					//login.find('.kt-login--forgot').animateClass('flipInX animated');
					KTUtil.animateClass(login.find('.kt-login__forgot')[0], 'flipInX animated');

				}

				var handleFormSwitch = function() {
					$('#kt_login_forgot').click(function(e) {
						e.preventDefault();
						displayForgotForm();
					});

					$('#kt_login_forgot_cancel').click(function(e) {
						e.preventDefault();
						displaySignInForm();
					});

					$('#kt_login_signup').click(function(e) {
						e.preventDefault();
						displaySignUpForm();
					});

					$('#kt_login_signup_cancel').click(function(e) {
						e.preventDefault();
						displaySignInForm();
					});
				}

				var handleSignInFormSubmit = function() {
					$('#kt_login_signin_submit').click(function(e) {
						e.preventDefault();
						var btn = $(this);
						var form = $(this).closest('form');

						form.validate({
							rules: {
								email: {
									required: true,
								},
								password: {
									required: true
								}
							}
						});

						if (!form.valid()) {
							return;
						}

						btn.addClass('kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light').attr('disabled', true);

						form.ajaxSubmit({
							url: '{{ route("users.post.postLogin") }}',
							method: 'POST',
							data: {
								_token: $("input[type='_token']").val()
							},
							success: function(response, status, xhr, $form) {
								console.log(response);
								if (response== true) {
									showErrorMsg(form, 'success', 'Đăng nhập thành công, vui lòng chờ!');
									setTimeout(() => {
										window.location.href ='{{ route("users.get.dashboard") }}';
									}, 1000);
								}
								else {
									btn.removeClass('kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light').attr('disabled', false);
									showErrorMsg(form, 'danger', 'Tài khoản hoặc mật khẩu không chính xác.');
								}
							}
						});
					});
				}

				var handleSignUpFormSubmit = function() {
					$('#kt_login_signup_submit').click(function(e) {
						e.preventDefault();

						var btn = $(this);
						var form = $(this).closest('form');

						form.validate({
							rules: {
								fullname: {
									required: true
								},
								email: {
									required: true,
									email: true
								},
								password: {
									required: true
								},
								rpassword: {
									required: true
								},
								agree: {
									required: true
								}
							}
						});

						if (!form.valid()) {
							return;
						}

						btn.addClass('kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light').attr('disabled', true);

						form.ajaxSubmit({
							url: '',
							success: function(response, status, xhr, $form) {
								// similate 2s delay
								setTimeout(function() {
									btn.removeClass('kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light').attr('disabled', false);
									form.clearForm();
									form.validate().resetForm();

									// display signup form
									displaySignInForm();
									var signInForm = login.find('.kt-login__signin form');
									signInForm.clearForm();
									signInForm.validate().resetForm();

									showErrorMsg(signInForm, 'success', 'Thank you. To complete your registration please check your email.');
								}, 2000);
							}
						});
					});
				}

				var handleForgotFormSubmit = function() {
					$('#kt_login_forgot_submit').click(function(e) {
						e.preventDefault();

						var btn = $(this);
						var form = $(this).closest('form');

						form.validate({
							rules: {
								email: {
									required: true,
									email: true
								}
							}
						});

						if (!form.valid()) {
							return;
						}

						btn.addClass('kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light').attr('disabled', true);

						form.ajaxSubmit({
							url: '',
							success: function(response, status, xhr, $form) {
								// similate 2s delay
								setTimeout(function() {
									btn.removeClass('kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light').attr('disabled', false); // remove
									form.clearForm(); // clear form
									form.validate().resetForm(); // reset validation states

									// display signup form
									displaySignInForm();
									var signInForm = login.find('.kt-login__signin form');
									signInForm.clearForm();
									signInForm.validate().resetForm();

									showErrorMsg(signInForm, 'success', 'Cool! Password recovery instruction has been sent to your email.');
								}, 2000);
							}
						});
					});
				}

				// Public Functions
				return {
					// public functions
					init: function() {
						handleFormSwitch();
						handleSignInFormSubmit();
						handleSignUpFormSubmit();
						handleForgotFormSubmit();
					}
				};
			}();

			// Class Initialization
			jQuery(document).ready(function() {
				KTLoginGeneral.init();
			});

		</script>

		<!--end::Page Scripts -->
	</body>

	<!-- end::Body -->
</html>