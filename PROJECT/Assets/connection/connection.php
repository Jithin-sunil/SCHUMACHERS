<?php
$server="localhost";
$user="root";
$password="";
$db="schumachers";
$con=mysqli_connect($server,$user,$password,$db);
if(!$con)
{
	echo"connection failed";
}
?>