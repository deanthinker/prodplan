<?php

include_once("util.php");
include_once("configdb.php");
require_once("lib/data_connector.php");


$month = date("m");
$year = date("Y");
$season = getSeason($month);
$period = intval($year . $season);


$sql = "select distinct pcode, pcname from pln145 where planyear >= " . $year . " 
		union
		select distinct pcode, pcname from pln245 where planyear >= " . $year . " 
		order by pcode";

$return_arr = array();

$fetch = mysql_query($sql); 

while ($row = mysql_fetch_array($fetch, MYSQL_ASSOC)) {
	$row_array['id'] = $row['pcode']; //for Webix datatable ID format
    $row_array['pcode'] = $row['pcode'];
    $row_array['pcname'] = $row['pcname'];

    array_push($return_arr,$row_array);
}

echo json_encode($return_arr);



?>

