<?php
session_start();

/* DATABASE CONFIGURATION */
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'cwaustra_admin');
define('DB_PASSWORD', 'xnG5rV50');
define('DB_DATABASE', 'cwaustra_members');
define("BASE_URL", "http://database.cwaustral.com.au/frontend/"); 


function getDB()
{
	$dbhost = DB_SERVER;
	$dbuser = DB_USERNAME;
	$dbpass = DB_PASSWORD;
	$dbname = DB_DATABASE;

	try
	{
		$dbConnection = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
		$dbConnection->exec("set names utf8");
		$dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		return $dbConnection;
	}
	
	catch (PDOException $e) {
		echo 'Connection failed: ' . $e->getMessage();
	}
}
?>