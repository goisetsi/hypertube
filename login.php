<html>
<head>
	<title>Sign in</title>
	<link rel="stylesheet" type="text/css" href="resources/style.css">
</head>
	<body>
		<div class="header">
			<h1 class="title">HYPERTUBE</h1>
		</div>
		<div id="login-form">
			<?php
				session_start();
				if (isset($_SESSION['login_err']) && $_POST['action'] == "login")
					echo "<div id=\"error\">". $_SESSION['login_err'] . "</div>";
			?>
			<form action="index.php" method="POST">
				Username: <br/> 
				<input type='hidden' name='action' value='login'>
            	<input type='hidden' name='controller' value='access'>
				<input type="text" name="username" value=""/>
				<br />
				Password: <br/> 
				<input type="password" name="passwd" value=""/>
				<br />
				<input type="submit" name="submit" value="Sign in"/>
				<br /><br />
				Don't have an account?
				<a href="signup.php">Sign up</a><br />
				Forgot password?
				
				<a href="forgot_passwd.php">Reset password</a><br />
			</form>
		</div>
	</body>
</html>