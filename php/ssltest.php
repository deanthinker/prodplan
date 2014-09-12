<?php
if ($_SERVER['SERVER_PORT'] != 443) {

header("HTTP/1.1 301 Moved Permanently");
header("Location: https://" . $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"]);

}
else{
	echo "secure!";
	echo phpinfo();
}
?>

