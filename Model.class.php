<?php
	require_once('Model.class.php');

	class Model
	{
		private $_pdo;

		public function __construct(PDO $pdo)
		{
			$this->_pdo = $pdo;
		}

		public function login($login, $passwd)
		{
			$get_users = $this->_pdo->prepare("SELECT * FROM user");
			$get_users->execute();
			$users = $get_users->fetchAll();
			$hash_passwd = hash("whirlpool", $passwd);

			foreach ($users as $element)
			{
				if ($element['username'] == $login && $element['password'] == $hash_passwd)
				{
					$_SESSION['login'] = $element['username'];
					if (isset($_SESSION['login_err']))
						unset($_SESSION['login_err']);
					return TRUE;
				}
			}
			$_SESSION['login_err'] = "Invalid login details";
			return FALSE;
		}

		public function signup()
		{
			if (isset($_SESSION['user_exist']))
					unset($_SESSION['user_exist']);
			if ($_POST["passwd"] != $_POST["repasswd"])
				return false;
			else if (!$_POST["username"] || !$_POST["name"] || !$_POST["email"] ||
				!$_POST["passwd"] || !$_POST['lastname'] || !$_POST["repasswd"])
				return false;
			else if (strlen($_POST["passwd"]) < 6)
				return false;
			else
			{
				$get_userid = $this->_pdo->prepare("SELECT id FROM user
					WHERE username=:username OR email=:email");
				$get_userid->execute(array('username' => $_POST["username"], 'email' => $_POST["email"]));
				$userid = $get_userid->fetch();

				if ($userid)
				{
					$_SESSION['user_exist'] = "User already exists";
					return false;
				}

				$hash_passwd = hash("whirlpool", $_POST["passwd"]);
				$user_create = $this->_pdo->prepare("INSERT INTO user
					(username, email, name, lastname, password) VALUES
					(:username, :email, :name, :lastname, :password)");
				$cols = array(':username' => $_POST["username"], 'email' =>
					$_POST["email"], ':name' => $_POST["name"],
					':lastname' => $_POST["lastname"], ':password' => $hash_passwd);
				$user_create->execute($cols);

				if (isset($_SESSION['user_exist']))
					unset($_SESSION['user_exist']);
				return true;
			}
		}
	}
?>