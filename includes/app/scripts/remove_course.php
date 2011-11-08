<?php

	$idcourse = $_POST["idcourse"];

	$db = null;
	$data = array($idcourse);
	$query="CALL RemoveCourse(?)";

	try {
		require 'database_props.php';

		$db = new PDO($pdo_connection_string, $user, $password);
		$stmt = $db->prepare($query);
		$db->beginTransaction();
		$stmt->execute($data);

		$db->commit();

		$check_stmt = $db->prepare("CALL GetCourseByID(?)");
		$db->beginTransaction();
		$check_stmt->execute($data);

		$db->commit();

		$result = $check_stmt->fetchAll();
		$count = 0;

		foreach ($result as $row) {
			if ($row != null){
				$count ++;
				throw new PDOException("Course not removed. Constraint failed");
			}
			echo $row;
		}

		if ($count == 0 ) {
			echo "Course successfully removed from database!";
		}

		$db = null;
	} 
	
	catch (PDOException $e) {
		echo '<div class="ui-state-error">FAIL. ' . $e->getMessage() . '</div>';
	}
?>
