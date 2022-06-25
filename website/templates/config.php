<?php
$conn=myqsli_connect('localhost','root','','vardhanika');
if(!$conn){
	die("could not connect to the database: ".myqsli_connect_error());

}
?>