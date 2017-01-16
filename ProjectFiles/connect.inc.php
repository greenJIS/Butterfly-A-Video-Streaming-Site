<?php
$conn_error='coudnt connect';
$host='localhost';
$user='root';
$pass='';
$mydb='project';
//||!@mysql_select_db($mydb)

if(!@mysql_connect($host,$user,$pass) || !@mysql_select_db($mydb))
{
		die();
	
}	
?>