<?php

include_once("util.php");
//include_once("configdb.php");
require_once("lib/data_connector.php");

$conn=mysql_connect("localhost","root","1234")  or die(mysql_error());
mysql_select_db("service");
 
$month = date("m");
$year = date("Y");
$period = intval($year . getSeason($month));

echo $month . " , " . $year . " = " . $period . "\n";

header('Content-Type: text/html; charset=utf-8');


mysql_query("SET NAMES 'utf8'");
mysql_query("SET CHARACTER_SET_CLIENT='utf8'");
mysql_query("SET CHARACTER_SET_RESULTS='utf8'");

$datacon = new JSONDataConnector($conn, "MySQL");

//$sql = "SELECT * FROM market.pln145 where planyear >= 2014";
/*
$sql = "SELECT pcode, pcname, period, planyear, planq, sum(planqty) splanq, sum(alloc) salloc, sum(accushp) sshp 
		FROM (SELECT *, concat(planyear,planq) as period from pln145 WHERE planyear >=2014) as T1 
		group by pcode, period";
*/

$sql = "SELECT id, name, addr FROM service.main";
//$sql = "SELECT * FROM market.pln145 where planyear >= 2014"; 

$datacon->dynamic_loading(10);
$datacon->render_table("service.main", "id", "id, name, addr");
//$datacon->render_sql($sql, "pcode", "pcode, pcname, planyear, planq, planqty, alloc, accushp");
//$datacon->render_sql($sql, "pcode", "pcode, pcname, period, planyear, planq, planyear, planq, planqty");




?>

