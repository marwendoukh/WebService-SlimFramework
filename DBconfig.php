<?php
function getDB() {
	$dbhost="DatabaseServer";
	$dbuser="DBuser";
	$dbpass="Password";
	$dbname="DatabaseName";
	$dbConnection = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);	
	$dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	return $dbConnection;
}
?>
