<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Register</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Bootstrap -->
	<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
	<script src="https://code.jquery.com/jquery.js"></script>
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
			<form method="POST" action="forms/register.php" id="signInForm">
				<fieldset>
					<legend>Register</legend>
					<div id="signInFields">
						<label>Username</label>
						<input type="text" id="username" name="username" autocomplete="off">
						<div id="usernameMessage"></div>
						<button type="submit" class="btn">Register</button>
					</div>
				</fieldset>
			</form>
		</div>
	</div><!-- container content -->
	
	<script src="js/bootstrap.min.js"></script>
	
	<script type="text/javascript">
		$("#signInForm").submit(function(event) {
			/*Stop the form from submitting normally*/
			event.preventDefault();
			
			/*Get the values from the form*/
			var $form = $(this);
			var username = $form.find('input[name="username"]').val();
			var action = $form.attr('action');
			
			/*Validate the data*/
			if(username.length <=0){
				$("#usernameMessage").html("<div class='alert alert-error fade in'><a class='close' data-dismiss='alert' href='#'>&times;</a>Username must be greater than 0 characters.</div>");
				return;
			}
			
			/*Post the data*/
			var posting = $.ajax({
				type: "POST",
				dataType: "text",
				url: action,
				data: {username:username}
			});
			
			/*Handle the return*/
			posting.done(function(data){
				message = $.parseJSON(data);
				if(message.type == "Success"){
					window.location.href = "signin.php";
				}
				else{
					$("#usernameMessage").html("<div class='alert alert-error fade in'><a class='close' data-dismiss='alert' href='#'>&times;</a>" + message.message + "</div>");
				}
			});
		});
	</script>
	
</body>
</html>