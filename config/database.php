<?php
ob_start();
session_start();
function db() {
	static $conn;
	if ($conn===NULL){
		$servername = "localhost";
		$dbname = "appareldb";
		$username = "apparelus";
		$password = "App$%@DB!^721";
		$conn = mysqli_connect($servername, $username, $password, $dbname);
	}
	return $conn;
}

$fullurl="https://apparelerp.co.in/";

date_default_timezone_set('Asia/Calcutta');

?>