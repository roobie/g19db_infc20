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

		$db->commit();
		
		
		$check_stmt = $db->prepare("CALL GetStudentByID(?)");
		$db->beginTransaction();
		$result = $check_stmt->execute($data);

		$db->commit();
		
		$count = 0;
		
		foreach ($result as $row) {
			if ($row != null){
				$count ++;
				throw new PDOException("Student not removed. Constraint failed");
			}
		}
		
		$db = null;
	} catch (PDOException $e) {
		echo '<div class="ui-state-error">FAIL. Try again or consult the webmaster.</div> Append the following info in the message, please: ' . date_default_timezone_set('l jS \of F Y h:i:s A') . $e->getMessage();
	}	
?>
