<div class="navbar navbar-static-top">
	<div class="navbar-inner">
		<a class="brand" href="index.php">CS 462</a>
		<div class="nav-collapse collapse navbar-responsive-collapse">
			<ul class="nav" id="topLinks">
				<li id="homeLink"><a href="index.php">Home</a></li>
				<li id="signinLink"><a href="signin.php">Sign In</a></li>
				<li id="registerLink"><a href="register.php">Register</a></li>
			</ul>
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
	}
</script>