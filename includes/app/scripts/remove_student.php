<?php

	$idstudent = mysql_escape_string($_POST["idstudent"]);


	$db = null;
	$data = array($idstudent);
	$query="CALL RemoveStudent(?)";

	try {
		require 'database_props.php';
		
		$db = new PDO($pdo_connection_string, $user, $password);

		$stmt = $db->prepare($query);

		$db->beginTransaction();
		$stmt->execute($data);

		$last_id = $db->query('SELECT LAST_INSERT_ID() as last_id');
		$last_id->setFetchMode(PDO::FETCH_ASSOC);
		$last_id = $last_id->fetch();
		$last_id = intval($last_id['last_id']);
		
		$db->commit();
		
		$db = null;
	} catch (PDOException $e) {
		echo '<div class="ui-state-error">FAIL. Try again or consult the webmaster.</div> Append the following info in the message, please: ' . date_default_timezone_set('l jS \of F Y h:i:s A') . $e->getMessage();
	}	
?>
