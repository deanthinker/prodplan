<?php

include_once("util.php");
include_once("configdb.php");


$return_arr = array();
$pcode = "";

if(isset($_GET["pcode"]) && strlen($_GET["pcode"]) > 0 ) {
	$pcode = $_GET["pcode"];
	$sql = "SELECT *, concat(year, season) yq, concat(estd_year, estd_season) estdyq FROM market.pro130 where pcode = '" . $pcode . "' order by estdyq desc";
}else
{
	$sql = "SELECT *, concat(year, season) yq, concat(estd_year, estd_season) estdyq FROM market.pro130 order by estdyq desc";
}

$fetch = mysql_query($sql); 
$fieldnum = mysql_num_fields($fetch);

$id =1;
while ($row = mysql_fetch_array($fetch, MYSQL_ASSOC)) {
	$idx=0;
	$row_array["id"] = $id;
	while ($idx < $fieldnum){
	    $meta = mysql_fetch_field($fetch, $idx); //get the filed name
	    if (!$meta) {
	        echo "No information available<br />\n";
	    }
	    if ($meta->numeric)
	    	$row_array[$meta->name] = (float)$row[$meta->name]; //use the field name as index
	    else
	    	$row_array[$meta->name] = $row[$meta->name]; //use the field name as index
		$idx++;
	}
	
    array_push($return_arr,$row_array);
    $id++;
}

echo json_encode($return_arr);

?>