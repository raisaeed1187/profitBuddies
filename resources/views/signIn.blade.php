<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Courgette|Pacifico:400,700">
<title>Profit Buddies</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<style>
body {
	color: #999;
	background: #e2e2e2;
	font-family: 'Roboto', sans-serif;
}
.form-control {
	min-height: 41px;
	box-shadow: none;
	border-color: #e1e1e1;
}
.form-control:focus {
	border-color: #00cb82;
}	
.form-control, .btn {        
	border-radius: 3px;
}
.form-header {
	margin: -30px -30px 20px;
	padding: 30px 30px 10px;
	text-align: center;
	background: #00cb82;
	border-bottom: 1px solid #eee;
	color: #fff;
}
.form-header h2 {
	font-size: 34px;
	font-weight: bold;
	margin: 0 0 10px;
	font-family: 'Pacifico', sans-serif;
}
.form-header p {
	margin: 20px 0 15px;
	font-size: 17px;
	line-height: normal;
	font-family: 'Courgette', sans-serif;
}
.signup-form {
	width: 390px;
	margin: 0 auto;	
	padding: 30px 0;	
}
.signup-form form {
	color: #999;
	border-radius: 3px;
	margin-bottom: 15px;
	background: #f0f0f0;
	box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
	padding: 30px;
}
.signup-form .form-group {
	margin-bottom: 20px;
}		
.signup-form label {
	font-weight: normal;
	font-size: 14px;
}
.signup-form input[type="checkbox"] {
	position: relative;
	top: 1px;
}
.signup-form .btn {        
	font-size: 16px;
	font-weight: bold;
	background: #00cb82;
	border: none;
	min-width: 200px;
}
.signup-form .btn:hover, .signup-form .btn:focus {
	background: #00b073 !important;
	outline: none;
}
.signup-form a {
	color: #00cb82;		
}
.signup-form a:hover {
	text-decoration: underline;
}
label {
	color: #00b073;
}
.field-icon {
  float: right;
  margin-left: -25px;
  margin-top: -28px;
  position: relative;
  z-index: 2;
}
@media screen and (max-width: 650px) {
	.signup-form {
	width: 360px;
	margin: 0 auto;	
	padding: 10px 0;	
}
}
</style>
</head>
<body>
<div class="signup-form">
	<h1 style="margin-left:60px; color:#00b073;line-height: normal;font-family: 'Courgette', sans-serif; "><a href="/"> Profit Buddies </a></h1>
    <form action="{{route('signIn')}}" method="post">
        @csrf
		<div class="form-header">
			<h2>Sign In</h2>
			{{-- <p>Fill out this form to start your free trial!</p> --}}
		</div>
		@if (Session::has('message'))
			
			<label style="color:red;">{{Session::get('message')}}</label>
			
		@endif
        <div class="form-group">
			<label>Email Address</label>
        	<input type="email" class="form-control" name="email" required="required">
        </div>
		<div class="form-group">
			<label>Password</label>
			<input type="password" class="form-control" name="password" id="password-field" required="required">
			<span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
        </div>
		       

		<div class="form-group">
			<button type="submit" class="btn btn-primary btn-block btn-lg">Sign In</button>
		</div>	
    </form>
	<div class="text-center small">If you are not register? <a href="/signUpForm">Register Here</a></div>
</div>

<script>
	$(".toggle-password").click(function() {

	$(this).toggleClass("fa-eye fa-eye-slash");
	var input = $($(this).attr("toggle"));
	if (input.attr("type") == "password") {
	input.attr("type", "text");
	} else {
	input.attr("type", "password");
	}
	});
</script>

</body>
</html>