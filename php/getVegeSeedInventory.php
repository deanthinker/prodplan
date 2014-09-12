<?php

include_once("util.php");
include_once("configdb.php");


$return_arr = array();
$pcode = "";

if(isset($_GET["pcode"]) && strlen($_GET["pcode"]) > 0 ) {
	$pcode = $_GET["pcode"];
}else
{
	echo json_encode($return_arr);
	exit;
}

$sql = "SELECT pcode, pcname, reserve_std_qty, reserve_nstd_qty, avai_std_qty, avai_nstd_qty FROM market.inv340 where pcode = '" . $pcode . "' limit 1";

$fetch = mysql_query($sql); 


while ($row = mysql_fetch_array($fetch, MYSQL_ASSOC)) {
    $row_array['resstd'] = $row['reserve_std_qty'];
    $row_array['resnstd'] = $row['reserve_nstd_qty'];
    $row_array['avastd'] = $row['avai_std_qty'];
    $row_array['avanstd'] = $row['avai_nstd_qty'];
    array_push($return_arr,$row_array);
}

echo json_encode($return_arr);

?>