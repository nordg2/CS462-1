<div class="navbar navbar-static-top">
	<a class="btn btn-navbar" data-toggle="collapse" data-target=".navbar-responsive-collapse">
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
	</a>
	<div class="navbar-inner">
		<a class="brand" href="index.php">CS 462</a>
		<div class="nav-collapse collapse navbar-responsive-collapse">
			<ul class="nav" id="topLinks">
				<li id="homeLink"><a href="index.php">Home</a></li>
				<?php
				if(isset($_SESSION['username'])){
					/*Nothing*/
				}
				else{
					echo '<li id="signinLink"><a href="signin.php">Sign In</a></li>';
					echo '<li id="registerLink"><a href="register.php">Register</a></li>';				
				}
				?>
				<li id="privacyLink"><a href="privacy.php">Privacy</a></li>
			</ul>
			<?php
			if(isset($_SESSION['username'])){
				$username = $_SESSION['username'];
				echo <<<HTML
<ul class="nav pull-right" id="settings_dropdown">
	<li class="dropdown">
		<a class="dropdown-toggle" data-toggle="dropdown" href="#">
			<i class="icon-cog"></i>
			<span class="caret" style="margin-left:-3px"></span>
		</a>
		<ul class="dropdown-menu">
			<li class="disabled"><a>$username</a></li>
			<li class="divider"></li>
			<li><a href="signout.php">Sign Out</a></li>
		</ul>
	</li>
</ul>
HTML;
			}
			?>
		</div>
	</div>
</div><!-- navbar -->
<script>
	switch(window.location.pathname){
		case "/index.php":
			$("#homeLink").addClass("active");
			break;
		case "/signin.php":
			$("#signinLink").addClass("active");
			break;
		case "/register.php":
			$("#registerLink").addClass("active");
			break;
		case "/privacy.php":
			$("#privacyLink").addClass("active");
			break;
	}
</script>