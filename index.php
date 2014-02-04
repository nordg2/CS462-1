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
		.sidenav{
			border: 1px solid gray;
			border-radius: 5px;
			margin-bottom: 10px;
		}
	</style>
</head>
<body>
	<?php include "pageParts/navbar.php" ?>
	
	<div class="container content" id="content">
		<div class="row-fluid">
			<div class="span2">
				<ul class="nav nav-list affix-top sidenav" id="tagList">
					<li class="nav-header">Current Users</li>
					<?php
					//Load in the current users
					$file = "forms/users.json";
					$string = file_get_contents($file);
					$users=json_decode($string,true);
					
					if(isset($_GET['user'])){
						$username = $_GET['user'];
					}
					else{
						$username = "";
					}
					foreach($users as $name){
						if($username == $name){
							echo '<li class="active"><a href="index.php?user=' . $name . '">' . $name . '</a></li>';
						}
						else{
							echo '<li><a href="index.php?user=' . $name . '">' . $name . '</a></li>';
						}
					}
					?>
				</ul>
			</div>
		
			<div class="span10">
				<?php
				if($username == ""){
					echo "Click a user to see their last check-in location.";
				}
				else{
					echo $username . " data";
				}
				?>
			</div>

		</div>
	</div><!-- container content -->
	
	<script src="js/bootstrap.min.js"></script>
</body>
</html>