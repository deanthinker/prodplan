<?php

include_once("util.php");
include_once("configdb.php");


$return_arr = array();
$month = date("m");
$year = date("Y");
$season = getSeason($month);
$period = intval($year . $season);
$pcode = "";

if(isset($_GET["pcode"]) && strlen($_GET["pcode"]) > 0 ) {
	$pcode = $_GET["pcode"];
}else
{
	echo json_encode($return_arr);
	exit;
}

$sql = "SELECT pcode, pcname, period, planyear, planq, sum(planqty) splanqty, sum(alloc) salloc, sum(accushp) sshp 
		FROM (SELECT *, concat(planyear,planq) as period from market.pln145 WHERE pcode = '" . $pcode . "') as T1 
		WHERE period >= " . $period . 
		" GROUP by pcode, period";

$fetch = mysql_query($sql); 

while ($row = mysql_fetch_array($fetch, MYSQL_ASSOC)) {
    $row_array['pcode'] = $row['pcode'];
    $row_array['pcname'] = $row['pcname'];
    $row_array['period'] = $row['period'];
    $row_array['planyear'] = $row['planyear'];
    $row_array['planq'] = $row['planq'];
    $row_array['splanqty'] = (float)$row['splanqty'];
    $row_array['salloc'] = (float)$row['salloc'];
    $row_array['sshp'] = (float)$row['sshp'];

    array_push($return_arr,$row_array);
}

echo json_encode($return_arr);

?>