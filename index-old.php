<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Bootstrap -->
	<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
	<script src="https://code.jquery.com/jquery.js"></script>
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
	
	function file_get_contents_curl($url) {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //Set curl to return the data instead of printing it to the browser.
		curl_setopt($ch, CURLOPT_URL, $url);
		$data = curl_exec($ch);
		curl_close($ch);
		return $data;
	}
	
	//Deal with response code if there is one
	if(isset($_GET['code'])){
		$code = $_GET['code'];
		$access = json_decode(file_get_contents_curl("https://foursquare.com/oauth2/access_token?client_id=TKMC01BZYM0CACKCVC1OHQS3QLWAETKTZ5PU51M3PQ41W0TX&client_secret=WRI3MSB5HM0T0GFCXRCCFQAEIJZ4E5G2WB2GQSKZEAXH3U4O&grant_type=authorization_code&redirect_uri=https://ec2-184-73-152-240.compute-1.amazonaws.com/index.php&code=" . $code));
		
		$token = "";
		foreach($access as $name){
			$token = $name;
		}

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
				if(isset($_SESSION['username'])){
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
						else{
							$locations = json_decode(file_get_contents_curl("https://api.foursquare.com/v2/users/self/checkins?oauth_token=" . $_SESSION['token'] . "&v=20140205"),TRUE);
							echo "<h4>All Recent Locations</h4>";
							echo "<table class='table'><tr><th>Venue</th><th>Address</th><th>Time of check-in</th></tr>";
							$items = $locations['response']['checkins']['items'];
							foreach($items as $i){
								echo "<tr><td>" . $i['venue']['name'] . "</td><td>" . $i['venue']['location']['address'] . "</td><td>" . date('g:ia \o\n l jS F Y',$i['createdAt'] + ($i['timeZoneOffset'] * 60)) . "</td></tr>";
							}
							echo "</table>";
						}
					}
					else{
						//Load in the current tokens
						$file = "forms/tokens.json";
						$string = file_get_contents($file);
						$tokens=json_decode($string,true);

						if($tokens == null){
							$tokens = array();
						}
						
						if(isset($tokens[$_GET['user']])){
							$t = $tokens[$_GET['user']];
							
							$locations = json_decode(file_get_contents_curl("https://api.foursquare.com/v2/users/self/checkins?oauth_token=" . $t . "&v=20140205"),TRUE);
							echo "<h4>Last Location</h4>";
							echo "<table class='table'><tr><th>Venue</th><th>Address</th><th>Time of check-in</th></tr>";
							$items = $locations['response']['checkins']['items'];
							foreach($items as $i){
								echo "<tr><td>" . $i['venue']['name'] . "</td><td>" . $i['venue']['location']['address'] . "</td><td>" . date('g:ia \o\n l jS F Y',$i['createdAt'] + ($i['timeZoneOffset'] * 60)) . "</td></tr>";
								break;
							}
							echo "</table>";
						}
						else{
							echo $username . " has not yet signed in through foursquare.";
						}
					}
				}
				?>
			</div>

		</div>
	</div><!-- container content -->
	
	<script src="js/bootstrap.min.js"></script>
</body>
</html>
