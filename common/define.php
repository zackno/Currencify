<?php
global $conn;	
$servername=DB_HOST; $dbname=DB_NAME; $username=DB_USER; $password=DB_PASS;

try {
	$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e)
{
	echo "Connection failed: " . $e->getMessage();
}
