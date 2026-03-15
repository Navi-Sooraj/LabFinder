<?php
$Server="localhost";
$User="root";
$Password="";
$Database="db_labfinder";

$Conn=mysqli_connect($Server,$User,$Password,$Database);

if(!$Conn)
{
	echo "Connection Failed";
}
?>