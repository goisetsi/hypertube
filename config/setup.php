<?php
	include("database.php");

	try
	{
		$db = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "CREATE DATABASE IF NOT EXISTS " . $DB_NAME;
		$sql_create = "CREATE TABLE IF NOT EXISTS user(
			id int PRIMARY KEY AUTO_INCREMENT NOT NULL,
			username VARCHAR(30) NOT NULL,
			email VARCHAR(50) NOT NULL,
			name VARCHAR(50) NOT NULL,
			lastname VARCHAR(50) NOT NULL,
			password VARCHAR(150) NOT NULL,
			`gender` ENUM('Male', 'Female'),
			picture VARCHAR(100),
			first_login TINYINT NOT NULL DEFAULT 0)";

		$sql_reset = "CREATE TABLE IF NOT EXISTS reset(
			id int PRIMARY KEY AUTO_INCREMENT NOT NULL,
			email VARCHAR(50) NOT NULL,
			token VARCHAR(150) NOT NULL)";

		$db->exec($sql);
		$db->exec("use " . $DB_NAME);
		$db->exec($sql_create);
		$db->exec($sql_reset);
	}
	catch (PDOException $e)
	{
		print "Error!: " . $e->getMessage() . PHP_EOL;

	}
?>