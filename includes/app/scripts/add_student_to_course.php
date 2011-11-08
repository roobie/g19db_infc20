<?php

	$idstudent = mysql_escape_string($_POST["idstudent"]);
	$idcourse = mysql_escape_string($_POST["idcourse"]);

	$db = null;
	$data = array($idstudent, $idcourse);
	$query="CALL InsertStudies(?, ?)";

	try {
		require 'database_props.php';
		
		$db = new PDO($pdo_connection_string, $user, $password);

		$stmt = $db->prepare($query);

		$db->beginTransaction();
		$stmt->execute($data);
		
		$db->commit();
		
		$db = null;
	} catch (PDOException $e) {
		echo '<div class="ui-state-error">FAIL. Try again or consult the webmaster.</div> Append the following info in the message, please: ' . date_default_timezone_set('l jS \of F Y h:i:s A') . $e->getMessage();
	}	
?>
