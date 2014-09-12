<?php
die();
include_once("util.php");
include_once("configdb.php");


$return_arr = array();
$pcode = "";
$sql = "";
$plannum = "";
$field1 = "";$field2 = "";$field3 = "";$field4 = "";

if(isset($_GET["plannum"]) && strlen($_GET["plannum"]) > 0 )
	$plannum = $_GET["plannum"];
else
	die("no plannum defined!");

if(isset($_GET["report1mon"])  ){
	if (strlen($_GET["report1mon"]) > 0)
		$field1 = "report1mon=" . $_GET["report1mon"];
	else
		$field1 = "report1mon=null";
}

if(isset($_GET["report1qty"]) ){
	if (strlen($_GET["report1qty"]) > 0)
		$field2 = " , " . "report1qty=" . $_GET["report1qty"];
	else
		$field2 = ", report1qty=null";	
	
}
if(isset($_GET["report1ym"]) ){
	if (strlen($_GET["report1ym"]) > 0)
		$field3 = " , " . "report1ym=" . $_GET["report1ym"];
	else
		$field3 = ", report1ym=null";	
}

if(isset($_GET["note"]) ){	
	if (strlen($_GET["note"]) > 0)
		$field4 = " , " . "note='" . $_GET["note"] . "'"; //String Value
	else
		$field4 = ", note=null";

}
else{
	echo "-1"; //return false
	die();
}

$sql = "UPDATE pro130 SET " . $field1 . $field2 . $field3 . $field4 . " WHERE plannum='" . $plannum . "' ";
echo $sql;
mysql_query($sql);
if (mysql_affected_rows() > 1 )//SHOULD NOT HAPPEN!!!
	die("error: more than 1 record! count=%d" + mysql_affected_rows()); 
else
	mysql_query("COMMIT");



?>