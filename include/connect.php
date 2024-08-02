<?php

include_once 'psl-config.php';

function dbConnect() {
	try {
		// Create connection to database using PDO
	$dsn = "mysql:host=" . HOST . ";dbname=" . DATABASE . ";charset=utf8";
	$options = [
		PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Enable exception mode for errors
		PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // Set the default mode to associative
		PDO::ATTR_EMULATE_PREPARES => false, // Disable prepared statements emulation
	];

	$pdo = new PDO($dsn, USER, PASSWORD, $options);
	return $pdo;

	} catch (PDOException $e) {
		error_log("Koneksi gagal: " . $e->getMessage());
	}
}

?>