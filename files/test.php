<?php 
	
	ini_set('display_errors', 'On');
	error_reporting(E_ALL | E_STRICT);
	
	$user = "g19usr";
	$password = "group19";
	$database = "g19db";

	$pdo_hostname = "mysql:host=localhost;";
	$pdo_dbname = "dbname=g19db";
	$pdo_connection_string = $pdo_hostname . $pdo_dbname;


	try {
		$db = new PDO($pdo_connection_string, $user, $password);

		$query = "view_ten_youngest_students()";
		$statement = $db->prepare($query);

		$db->beginTransaction();
			$statement->execute();
		$db->commit();

		$result = $statement->fetchAll();

		foreach($result as $row) {
			foreach ($row as $element) {
				echo $element;
			}
		}

	} catch(PDOException $e) {
			echo $e->getMessage();
	}

?>