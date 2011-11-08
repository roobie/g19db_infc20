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
		$check_stmt->execute($data);

		$db->commit();
		
		$result = $check_stmt->fetchAll();
		$count = 0;
		
		foreach ($result as $row) {
			if ($row != null){
				$count ++;
				throw new PDOException("Student not removed. Constraint failed");
			}
		}
		
		if ($count == 0 ) {
			echo "Student successfully removed from database!";
		}
		
		$db = null;
	} catch (PDOException $e) {
		echo '<div class="ui-state-error">FAIL. ' . $e->getMessage() . '</div>';
	}	
?>
