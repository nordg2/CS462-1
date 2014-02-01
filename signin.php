<!DOCTYPE html>
<html>
<head>
	<title>Sign In</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Bootstrap -->
	<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
	<style>
		#signIn{
			max-width: 300px;
			margin: 0 auto;
			border: 1px solid grey;
			padding: 15px;
			margin-top: 15px;
			border-radius: 5px;
		}
		#signInFields{
			max-width: 220px;
			margin: 0 auto;
		}
		#signInFields button{
			float: left;
		}
		#signInFields span{
			padding-top: 10px;
			float: left;
		}
	</style>
</head>
<body>
	<div class="navbar navbar-fixed-top">
		<div class="navbar-inner">
			<a class="brand" href="/">CS 462</a>
		</div>
		<div class="nav-collapse collapse navbar-responsive-collapse">
			<ul class="nav" id="topLinks">
				<li><a href="/">Home</a></li>
				<li class="active"><a href="/signin.php">Sign In</a></li>
				<li><a href="/register.php">Register</a></li>
			</ul>
		</div>
	</div><!-- navbar -->
	
	<div class="container content">
		<div id="signIn">
			<form method="POST" action="/PHPForms/signin.php" id="signInForm">
				<fieldset>
					<legend>Sign in</legend>
					<div id="signInFields">
						<label>Username</label>
						<input type="text" id="username" name="username">
						<div id="usernameMessage"></div>
						<button type="submit" class="btn">Sign In</button>
						<span class="help-block">
							Not a user? <a href="/register.php">Register now!</a>
						</span>
					</div>
				</fieldset>
			</form>
		</div>
	</div><!-- container content -->
	
	<script src="http://code.jquery.com/jquery.js"></script>
	<script src="js/bootstrap.min.js"></script>
</body>
</html>