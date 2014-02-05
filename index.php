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
	
	<?php
	//Deal with response code if there is one
	if(isset($_GET['code'])){
		$code = $_GET['code'];
		$access = json_decode(file_get_contents("https://foursquare.com/oauth2/access_token?client_id=TKMC01BZYM0CACKCVC1OHQS3QLWAETKTZ5PU51M3PQ41W0TX&client_secret=WRI3MSB5HM0T0GFCXRCCFQAEIJZ4E5G2WB2GQSKZEAXH3U4O&grant_type=authorization_code&redirect_uri=https://ec2-184-73-152-240.compute-1.amazonaws.com/index.php&code=" . $code));
		$token = $access['access_token'];
		
		//Load in the current tokens
		$file = "forms/tokens.json";
		$string = file_get_contents($file);
		$tokens=json_decode($string,true);

		if($tokens == null){
			$tokens = array();
		}
			
		//Update or add the token
		$user = $_SESSION['username'];
		$tokens[$user] = $token;

		//Save the tokens
		file_put_contents($file, json_encode($tokens));
		
		$_SESSION['token'] = $token;
	}
	?>
	
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
					if($users == null){
						$users = array();
					}
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
				if(isset($_SESSION['username']) && !isset($_SESSION['token'])){
					echo '<a class="btn btn-primary" href="https://foursquare.com/oauth2/authenticate?client_id=TKMC01BZYM0CACKCVC1OHQS3QLWAETKTZ5PU51M3PQ41W0TX&response_type=code&redirect_uri=https://ec2-184-73-152-240.compute-1.amazonaws.com/index.php">Sign in through FourSquare</a><hr/>';
				}
				if($username == ""){
					echo "Click a user to see their last check-in location.";
				}
				else{
					if(isset($_SESSION['username']) && $username == $_SESSION['username']){
						if(!isset($_SESSION['token'])){
							echo "You have not yet signed in through foursquare. You can do so through the link above.";
						}
					}
					else{
						echo $username . " has not yet signed in through foursquare.";
					}
				}
				?>
			</div>

		</div>
	</div><!-- container content -->
	
	<script src="js/bootstrap.min.js"></script>
</body>
</html>