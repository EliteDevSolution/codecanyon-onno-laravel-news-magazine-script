<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"> <!--<![endif]-->
<head>
<meta charset="utf-8">
<title>Paper Stack</title>
<link rel="stylesheet" type="text/css" href="{{ Module::asset('User:login/style.css')  }}" />
</head>
<body>
<div class="container">
	<section id="content">
		<form action="" method="POST">
            <h1>{{__('registration')}} Form</h1>
            @csrf
			<div>
				<input type="text" placeholder="First Name" name="first_name" required="" id="first_name" />
			</div>
			<div>
				<input type="text" placeholder="Last Name" name="last_name" required="" id="last_name" />
			</div>

			<div>
				<input type="text" placeholder="Email Address" name="email" required="" id="username" />
			</div>
			<div>
				<input type="password" placeholder="Password" name="password" required="" id="password" />
            </div>
            <div>
				<input type="password" placeholder="Confirm Password" name="password_confirmation" required="" id="password_confirmation" />
			</div>
			<div>
				<input type="submit" value="Register" />
			
            <a href="{{route('user-login') }}" class="btn btn-info">Login</a>
			</div>
		</form><!-- form -->
		
	</section><!-- content -->
</div><!-- container -->
</body>
</html>