<?php

include_once("util.php");
//include_once("configdb.php");
require_once("lib/data_connector.php");

header('Content-Type: text/html; charset=utf-8');

$month = date("m");
$year = date("Y");
$period = intval($year . getSeason($month));




$conn=mysql_connect("localhost","root","1234");

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

$sql = "SELECT pcode, pcname, period, planyear, planq, sum(planqty) splanqty, sum(alloc) salloc, sum(accushp) saccushp 
		FROM (SELECT *, concat(planyear,planq) as period from pln145 WHERE planyear >=2014) as T1 
		group by pcode, period";

$return_arr = array();

$fetch = mysql_query($sql); 

while ($row = mysql_fetch_array($fetch, MYSQL_ASSOC)) {
	$row_array['id'] = $row['pcode']; //for Webix datatable ID format
    $row_array['pcode'] = $row['pcode'];
    $row_array['pcname'] = $row['pcname'];
    $row_array['period'] = $row['period'];
    $row_array['planyear'] = $row['planyear'];
    $row_array['planq'] = $row['planq'];
    $row_array['splanqty'] = $row['splanqty'];
    $row_array['salloc'] = $row['salloc'];
    $row_array['saccushp'] = $row['saccushp'];

    array_push($return_arr,$row_array);
}

echo json_encode($return_arr);



?>

