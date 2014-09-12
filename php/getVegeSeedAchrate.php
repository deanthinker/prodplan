<?php

include_once("util.php");
include_once("configdb.php");


$return_arr = array();
$pcode = "";

if(isset($_GET["pcode"]) && strlen($_GET["pcode"]) > 0 ) {
	$pcode = $_GET["pcode"];
	$sql = "SELECT *, (ach*100) achrate from market.achrate where pcode ='" . $pcode . "' order by yr desc";
}else
{
	$sql = "SELECT *, (ach*100) achrate from market.achrate  order by yr desc";
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