



<!DOCTYPE html>
<html lang="en">
<head>
	<title>Register</title>
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
				<form action="{{Route('admin-register')}}" method="post" class="login100-form validate-form flex-sb flex-w">
					@csrf
                    @method('PUT')
					<span class="login100-form-title p-b-51">
						REGISTER
					</span>
					<input type="hidden" name="user_id" value="{{$user_id}}">
					<div class="wrap-input100 validate-input m-b-16" data-validate = "Username is required">
						<input class="input100" type="text" name="username" placeholder="Username">
						<span class="focus-input100"></span>
					</div>					
					
					<div class="wrap-input100 validate-input m-b-16" data-validate = "Password is required">
						<input class="input100" type="password" name="password" placeholder="Password">
						<span class="focus-input100"></span>
					</div>
					
					<div class="wrap-input100 validate-input m-b-16" data-validate = "Firstname is required">
						<input class="input100" type="text" name="firstname" placeholder="Firstname">
						<span class="focus-input100"></span>
					</div>					
					
					<div class="wrap-input100 validate-input m-b-16" data-validate = "Middlename is optional">
						<input class="input100" type="text" name="middlename" placeholder="Middlename">
						<span class="focus-input100"></span>
					</div>
					
                    <div class="wrap-input100 validate-input m-b-16" data-validate = "Lastname is required">
						<input class="input100" type="text" name="lastname" placeholder="Lastname">
						<span class="focus-input100"></span>
					</div>					
					
                    <div class="container-login100-form-btn w-100">
                        <select class="input100 w-100" name="accesslevel" id="accesslevel">
                            <option id="0">SELECT ACCESS LEVEL</option>
                            @foreach ($access_levels as $access_level)
                                <option id="{{$access_level->id}}">{{$access_level->access_level}}</option>
                            @endforeach
                        </select>    
                        <input type="hidden" name="accesslevel_id" id="accesslevel_id">
                        <span class="focus-input100"></span>        
                    </div>
 
					<div class="container-login100-form-btn m-t-17">
						<button class="login100-form-btn">
							REGISTER
						</button>
					</div>
				
				</form>
			</div>
		</div>
	</div>
    
    
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <script>
    
      
        $(document).ready(function(){
            
            $('#accesslevel').change(function(){
                console.log("hello");
                var idval = $(this).children(":selected").attr("id");
                console.log(idval);
                $('#accesslevel_id').val(idval);
            });

        });
       
    </script>

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