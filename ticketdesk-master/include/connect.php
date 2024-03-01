<?php
include_once 'psl-config.php';   
function dbConnect() {
	$mysqli = new mysqli(HOST, USER, PASSWORD, DATABASE);
	return $mysqli;
}

?>