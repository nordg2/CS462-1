<!DOCTYPE html>
<html>
<head>
	<title>Register</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Bootstrap -->
	<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
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
	<?php include "pageParts/navbar.php" ?>
	
	<div class="container content">
		<div id="signIn">
			<form method="POST" action="PHPForms/register.php" id="signInForm">
				<fieldset>
					<legend>Register</legend>
					<div id="signInFields">
						<label>Username</label>
						<input type="text" id="username" name="username">
						<div id="usernameMessage"></div>
						<button type="submit" class="btn">Register</button>
					</div>
				</fieldset>
			</form>
		</div>
	</div><!-- container content -->
	
	<script src="http://code.jquery.com/jquery.js"></script>
	<script src="js/bootstrap.min.js"></script>
</body>
</html>