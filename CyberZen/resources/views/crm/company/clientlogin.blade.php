



<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login</title>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link href="{{ asset('log/images/icons/favicon.ico') }}" rel="stylesheet">
    <link href="{{ asset('log/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('log/fonts/font-awesome-4.7.0/css/font-awesome.min.cs') }}" rel="stylesheet">
    <link href="{{ asset('log/fonts/Linearicons-Free-v1.0.0/icon-font.min.css') }}" rel="stylesheet">
    <link href="{{ asset('log/vendor/animate/animate.csss') }}" rel="stylesheet">
    <link href="{{ asset('log/vendor/css-hamburgers/hamburgers.min.css') }}" rel="stylesheet">
    <link href="{{ asset('log/vendor/animsition/css/animsition.min.css') }}" rel="stylesheet">
    <link href="{{ asset('log/vendor/select2/select2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('log/vendor/daterangepicker/daterangepicker.css') }}" rel="stylesheet">
	<link href="{{ asset('log/css/util.css') }}" rel="stylesheet">
    <link href="{{ asset('log/css/main.css') }}" rel="stylesheet">
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100 p-t-50 p-b-90">
				<form action="{{Route('client-login-check')}}" method="post" class="login100-form validate-form flex-sb flex-w">
					@csrf
					@method('GET')
				
					<span class="login100-form-title p-b-51">
						lOGIN
					</span>
					
					<div class="wrap-input100 validate-input m-b-16" data-validate = "Username is required">
						<input class="input100" type="text" name="username" placeholder="Username">
						<span class="focus-input100"></span>
					</div>
					
					
					<div class="wrap-input100 validate-input m-b-16" data-validate = "Password is required">
						<input class="input100" type="password" name="password" placeholder="Password">
						<span class="focus-input100"></span>
					</div>
					
					<div class="flex-sb-m w-full p-t-3 p-b-24">
						{{-- <div class="contact100-form-checkbox">
							<input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
							<label class="label-checkbox100" for="ckb1">
								Remember me
							</label>
						</div> --}}
						<div>
							<a href="#" class="txt1">
								Forgot password?
							</a>
						</div>
					</div>

					<div class="container-login100-form-btn m-t-17">
						<button class="login100-form-btn">
							Login
						</button>
					</div>
					@if (session('status'))
					<div class="alert alert-danger">
						{{ session('status') }}
					</div>
					@endif
				</form>
			</div>
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>
    <script type="text/javascript" src="{{ asset('log/vendor/jquery/jquery-3.2.1.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('log/vendor/animsition/js/animsition.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('log/vendor/bootstrap/js/popper.js') }}"></script>
    <script type="text/javascript" src="{{ asset('log/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('log/vendor/select2/select2.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('log/vendor/daterangepicker/moment.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('log/vendor/daterangepicker/daterangepicker.js') }}"></script>
    <script type="text/javascript" src="{{ asset('log/vendor/countdowntime/countdowntime.js') }}"></script>
    <script type="text/javascript" src="{{ asset('log/js/main.js') }}"></script>
</body>
</html>