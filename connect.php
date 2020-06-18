<?php //PDO

	$server = "localhost:3307";
	$user = "root";
	$pw = "";

	try {
		$connect = new PDO("mysql:host=$server;dbname=paw", $user, $pw);
		$connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		/* echo "Connected successfully"; */
	}catch(PDOException $e) {
		echo "Connection failed: " . $e->getMessage();
		die();
	}
?>
