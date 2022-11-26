<?php



	// $dsn = 'mysql:host=localhost;dbname=almajded_dashboard';
	// $user = 'almajded_dashboard_user';
	// $pass = 'Wdk?p)3L?3(H';

	$dsn = 'mysql:host=localhost;dbname=dashboard_5';
	$user = 'root';
	$pass = '';


	$option = array(
		PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
	);

	try {
		$con = new PDO($dsn, $user, $pass, $option);
		$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}

	catch(PDOException $e) {
		echo 'Failed To Connect' . $e->getMessage();
	}
?>