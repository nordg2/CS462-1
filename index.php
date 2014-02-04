<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Bootstrap -->
	<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
	<script src="http://code.jquery.com/jquery.js"></script>
	<style>
		#content{
			padding-top: 15px;
		}
	</style>
</head>
<body>
	<?php include "pageParts/navbar.php" ?>
	
	<div class="container content" id="content">
		<h3><u>Current Users</u></h3>
		<?php
		//Load in the current users
		$file = "forms/users.json";
		$string = file_get_contents($file);
		$users=json_decode($string,true);
		
		foreach($users as $name){
			echo $name . '<br/>';
		}
		?>
	</div><!-- container content -->
	
	<script src="js/bootstrap.min.js"></script>
</body>
</html>