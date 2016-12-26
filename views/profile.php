<?php
	if (!$_SESSION['login'])
	{
		header("Location: ../index.php");
		exit;
	}

	echo $_SESSION['action'];

	/*include("config/setup.php");
	include("config/database.php");

	$dsn = $DB_DSN .';dbname=db_matcha';
	$user_db = new PDO($dsn, $DB_USER, $DB_PASSWORD);
	$user_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$get_userinfo = $user_db->prepare("SELECT id, username, firstname, lastname, email,
		active FROM users WHERE username=:username");
	$get_userinfo->execute(array('username' => $_SESSION['logged_on_user']));
	$userinfo = $get_userinfo->fetch();

	if ($userinfo['active'] == 1)
	{
		header("Location: other_profiles.php");
		exit;
	}

	if ($_POST['submit'] == "Change picture")
	{
		$_SESSION[]

		$img_name = $_FILES['pro-pic']['name'];
		$img_type = $_FILES['pro-pic']['type'];
		$tmp_img = $_FILES['pro-pic']['tmp_name'];

		if (isset($name) ){
		if (!empty($name)){

			$location = 'images/';

			if (move_uploaded_file($tmp_img, $location . $img_name)) {
				echo $img_name;
				echo "file uploaded";
				$statement = $conn->prepare("INSERT INTO images (name, ...)
					VALUES (:img_name, ...);
				");
				$statement->bindParam(":img_name", $name);
				$statement->execute();
			}
			else
				echo "error uploading file, please try again";
		}
		echo $_POST['pro-pic'];
	}
	if ($_POST['submit'] == "Submit")
	{
		$_SESSION['gender'] = $_POST['gender'];
		$_SESSION['pref'] = $_POST['preference'];
		$_SESSION['bio'] = $_POST['biography'];
		$_SESSION['inter'] = $_POST['interests'];

		if (!$_POST['gender'] || !$_POST['preference'] ||
			!$_POST['biography'] || !$_POST['interests'])
		{
			$_SESSION['error'] = "pro_error";
			$_SESSION['message'] = "No field should be left empty and 
			make sure all selections are made!";
		}
		else
		{
			$_SESSION['error'] = "";
			if ($_POST["gender"] == "Male")
				$pro_pic = "images/avatar-man.png";
			else
				$pro_pic = "images/avatar-lady.png";

			$user_add = $user_db->prepare("INSERT INTO profile (user_id, gender,
				profile_pic, age, agefrom, toage, preference, interests, biography)
				VALUES (:id, :gender, :picture, :age, :agefrom, :toage, :preference,
				:tags, :biography)");
			$cols = array(':gender' => $_POST["gender"], ':preference' =>
				$_POST["preference"], ':biography' => $_POST["biography"],
				':tags' => $_POST["interests"], ':picture' => $pro_pic,
				':id' => $userinfo['id'], ':age' => $_POST["age"],
				':agefrom' => $_POST["agefrom"], 'toage' => $_POST["ageto"]);
			$user_add->execute($cols);
			header("Location: other_profiles.php");
		}
	}*/
?>

<html>
	<head>
		<title>Profile</title>
		<link rel="stylesheet" type="text/css" href="resources/style.css">
	</head>
	<body>
		<div class="header">
			<h1 class="title">HYPERTUBE</h1>
		</div>
		<div class="navigation">
			<ul>
				<li><a href="index.php?action=signout">Sign out</a></li>
			</ul>
		</div>
		<div id="profile-form">
			<?php
				if (isset($_SESSION['error']) && $_SESSION['error'] == "pro_error")
					echo "<div id=\"error\">".$_SESSION['message']."</div>";
			?>
			<form action="index.php" method="POST">
				Profile picture: <br />
				<img src="images/avatar.jpg" width="350"> <br />
				<input type="file" name="pro-pic">
				<input type="submit" name="submit" value="Change picture"/>
				<br />
				Gender: <br />
				<select name="gender">
					<option value="">Select gender</option>
					<option value="Male">Male</option>
					<option value="Female">Female</option>
				</select>
				<br />
				<input type="submit" name="submit" value="Submit"/>
			</form>
		</div>
	</body>
</html>