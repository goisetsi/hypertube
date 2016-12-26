<html>
	<head>
		<title>Sign up</title>
		<link rel="stylesheet" type="text/css" href="resources/style.css">
	</head>
	<body>
		<div class="header">
			<h1 class="title">HYPERTUBE</h1>
		</div>
		<div id="login-form">
			<?php
				if ($_POST['action'] == "signup")
				{
					if ($_POST["passwd"] != $_POST["repasswd"])
						echo "<div id=\"error\">Passwords don't match</div>";
					else if (strlen($_POST["passwd"]) < 6 && strlen($_POST["passwd"]) > 0)
						echo "<div id=\"error\">Password must have at least 6 characters</div>";
					else if (isset($_SESSION['user_exist']))
						echo "<div id=\"error\">" . $_SESSION['user_exist'] . "</div>";
				}
			?>
			<form action="index.php" method="POST">
				<input type='hidden' name='action' value='signup'>
            	<input type='hidden' name='controller' value='access'>
				Username: <br />
				<input type="text" name="username" value="<?php echo $_POST["username"] ?>"/>
				<?php
					if (!$_POST["username"] && $_POST['action'] == "signup")
						echo "<div id=\"error\"> Required field!</div>";
				?>
				<br />
				Name: <br />
				<input type="text" name="name" value="<?php echo $_POST["name"] ?>"/>
				<?php
					if (!$_POST["name"] && $_POST['action'] == "signup")
						echo "<div id=\"error\"> Required field!</div>";
				?>
				<br />
				Last Name: <br />
				<input type="text" name="lastname" value="<?php echo $_POST["lastname"] ?>"/>
				<?php
					if (!$_POST["lastname"] && $_POST['action'] == "signup")
						echo "<div id=\"error\"> Required field!</div>";
				?>
				<br />
				Email: <br />
				<input type="mail" name="email" value="<?php echo $_POST["email"] ?>"/>
				<?php
					if (!$_POST["email"] && $_POST['action'] == "signup")
						echo "<div id=\"error\"> Required field!</div>";
				?>
				<br />
				Password: <br />
				<input type="password" name="passwd" value=""/>
				<?php
					if (!$_POST["passwd"] && $_POST['action'] == "signup")
						echo "<div id=\"error\"> Required field!</div>";
				?>
				<br />
				Re-enter Password: <br />
				<input type="password" name="repasswd" value=""/>
				<?php
					if (!$_POST["repasswd"] && $_POST['action'] == "signup")
						echo "<div id=\"error\"> Required field!</div>";
				?>
				<br />
				<input type="submit" name="submit" value="Sign up"/>
				<br />
				Already have an account?
				<a href="login.php">Sign in</a><br />
			</form>
		</div>
	</body>
</html>