<html>
	<header>
		<title>500m Login Form</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
        <link rel="stylesheet" href="{{ asset('css/adminlte.min.css') }}">
        <style>
			
			.error{
				color:#DE3545 !important;
				width:100%;
				font-weight:normal !important;
			}
			
			input.error{
				border-color:#DE3545 !important;
			}
			.login-card-body .input-group .form-control
			{
				border:1px solid #d9d1d1 !important;
				border-radius:5px !important;
			}
			
		</style>
	</header>
	<body class="hold-transition login-page" style="background-image: url('images/1.jpg');">
		<div class="login-box">
  <div class="login-logo">
    <a href="index.html"><b>Wecome to </b>admin login</a>
  </div>
  <!-- /.login-logo -->
  <div class="card" style="border-radius: 1rem; ">
    <div class="card-body login-card-body" style="border-radius: 1rem; ">
      <p class="login-box-msg">Sign in to start your session</p>

      <form id="login_form" method="POST"  action="{{ route('login') }}">
	    @csrf
	    <x-auth-session-status class="mb-4" :status="session('status')" />
        
        <div class="input-group mb-3">
          <input type="email" class="form-control" name="email" id="email" placeholder="Email">
		 <x-input-error :messages="$errors->get('email')" class="mt-2 error" />
          
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" name="password" id="password" placeholder="Password">
          
		  <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Remember Me
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

    </div>
    <!-- /.login-card-body -->
  </div>
</div>
		
		
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
		<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
		<script>
			$(document).ready(function () {
 
				$("#login_form").validate({
			 
					// In 'rules' user have to specify all the 
					// constraints for respective fields
					rules: {
                        email: {
							required: true,
							email: true
						},
						password: {
							required: true,
							minlength: 5
						},
					},
				});
			});
		</script>
        
	</body>
</html>