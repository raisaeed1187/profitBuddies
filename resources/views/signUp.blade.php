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
select, option {
	color: #00b073;
}

.field-icon {
  float: right;
  margin-left: -25px;
  margin-top: -28px;
  position: relative;
  z-index: 2;
}
</style>
</head>
<body>
<div class="signup-form">
	<h1 style="margin-left:60px; color:#00b073;line-height: normal;font-family: 'Courgette', sans-serif; "><a href="/"> Profit Buddies </a></h1>

    <form action="{{route('signUp')}}" method="post">
        @csrf
		<div class="form-header">
			<h2>Sign Up</h2>
			{{-- <p>Fill out this form to start your free trial!</p> --}}
		</div>
		@if (Session::has('registerMsg'))
			
			<label style="color:red;">{{Session::get('registerMsg')}}</label>
			
		@endif
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label>First Name</label>
					<input type="text" class="form-control input-field" name="firstName" required="required">
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label>Last Name</label>
					<input type="text" class="form-control input-field" name="lastName" required="required">
				</div>
			</div>
		</div>
		
		
        <div class="form-group">
			<label>Username</label>
        	<input type="text" class="form-control" name="userName" required="required">
        </div>
        <div class="form-group">
			<label>Email Address</label>
        	<input type="email" class="form-control" name="email" required="required">
        </div>
		<div class="form-group">
			<label>Password</label>
			<input type="password" class="form-control" id="password-field" name="password" required="required">
			<span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
			
			
		</div>
		<div class="form-group">
			<label>Country</label>
			<select name="country" id="countries" class="form-control" id="country">
				<option value="">Please Pick a country</option>

			</select>
        </div>
			  
		<div class="form-group">
			<label>Business History</label>
			<textarea name="history" class="form-control" id="history" cols="32" rows="3"></textarea>
        </div>

		<div class="form-group">
			<button type="submit" class="btn btn-primary btn-block btn-lg">Sign Up</button>
		</div>	
    </form>
	<div class="text-center small">Already have an account? <a href="/signInForm">Login here</a></div>
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


	// This will be triggered everytime a user types anything
	// in the input field with id as input-field
	$(".input-field").keyup(function(e) {
	// Our regex
	// a-z => allow all lowercase alphabets
	// A-Z => allow all uppercase alphabets
	// 0-9 => allow all numbers
	// @ => allow @ symbol
	// var regex = /^[a-zA-Z0-9@]+$/;
	var regex = /^[a-zA-Z]+$/;
	// This is will test the value against the regex
	// Will return True if regex satisfied
	if (regex.test(this.value) !== true)
	//alert if not true
	//alert("Invalid Input");

	// You can replace the invalid characters by:
	this.value = this.value.replace(/[^a-zA-Z]+/, '');
	// this.value = this.value.replace(/[^a-zA-Z0-9@]+/, '');

	});


</script>

<script src="/js/countries.js"></script>
</body>
</html>