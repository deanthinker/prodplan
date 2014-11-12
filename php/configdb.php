<?php 

	
$mysql_hostname = "localhost";
$mysql_user = "root";
$mysql_password = "1qaz2wsx";
$mysql_database = "service";
$dbtype = "MySQL";

/*
$mysql_hostname = "23.229.154.169";
$mysql_user = "happy";
$mysql_password = "Ab1234";
$mysql_database = "Service";
*/


header('Content-Type: text/html; charset=utf-8');
$conn=mysql_connect("localhost",$mysql_user, $mysql_password);

if( ! $conn){
	die("can't connect to MySQL server:" . mysql_error());
}


mysql_query("SET NAMES 'utf8'");
mysql_query("SET CHARACTER_SET_CLIENT='utf8'");
mysql_query("SET CHARACTER_SET_RESULTS='utf8'");

$db = mysql_select_db("market", $conn);
if (!$db){
	die("can't get access to the database and table");
}


?>