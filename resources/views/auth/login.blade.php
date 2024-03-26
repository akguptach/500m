<html>
	<header>
		<title>Essay Help Login Form</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
        <link rel="stylesheet" href="{{ asset('css/login.css') }}">
        
	</header>
	<body>
		<div class="wrapper">
			<?php /*<div class="logo">
				<img src="https://www.freepnglogos.com/uploads/twitter-logo-png/twitter-bird-symbols-png-logo-0.png" alt="">
			</div>*/?>
			<div class="text-center mt-4 name">
				Essay Help
			</div>
            <x-auth-session-status class="mb-4" :status="session('status')" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 error email-error" />
			<form class="p-3 mt-3" id="login_form" method="POST"  action="{{ route('login') }}">
                @csrf
				<div class="form-field d-flex align-items-center">
					<span class="far fa-user"></span>
					<input type="text" name="email" id="email" placeholder="Email">
                    
				</div>
				<div class="form-field d-flex align-items-center">
					<span class="fas fa-key"></span>
					<input type="password" name="password" id="password" placeholder="Password">
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
				</div>
				<button class="btn mt-3">Login</button>
			</form>
			<?php /*<div class="text-center fs-6">
				<a href="#">Forget password?</a> or <a href="#">Sign up</a>
			</div>*/?>
		</div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
		<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
		<script>
			$().ready(function () {
 
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
        <style>
			
		</style>
	</body>
</html>