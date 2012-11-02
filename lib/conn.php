<?php
//connection

$host = 'detterholm.com.mysql';
$db = 'detterholm_com';
$user = 'detterholm_com';
$password = '0scar123!';

	$dbConn = mysqli_connect($host, $user, $password, $db);
	
	if (mysqli_connect_errno()) 
	{
			echo "Nu var det minsann något som gick fel vid anslutning till databasen.";
			exit();
	}