<?php

	ini_set('display_errors', 'On');
	error_reporting(E_ALL | E_STRICT);
	$idcourse = mysql_escape_string($_POST["idc"]);

	$db = null;
	$data = array($idcourse);
	$query="CALL GetAllStudiesByCourseID(?)";

	try {
		require 'database_props.php';
		
		$db = new PDO($pdo_connection_string, $user, $password);

		$stmt = $db->prepare($query);

		$db->beginTransaction();
		$stmt->execute($data);
		
		// Building the table:

		$result_set = $stmt->fetchAll();

echo <<<EOB
	<table class="standard-table">

		<caption>
			To update a row, simply click it.
		</caption>

		<tbody>
			<tr>
					<th scope="col">Students</th>
					<th scope="col">Sections</th>
			</tr>
				
EOB;
		

		foreach ($result_set as $row) {
		$stud_id = $row[0];
		$stud_name = $row[1] . " " . $row[2];

echo <<<EOB
				
			<tr id="student-row-$stud_id" class="student-other-tr">
				<td class="td-clickable" scope="row">$stud_name</th>
				<td class="td-clickable" scope="row">
EOB;
		
		$db2 = new PDO($pdo_connection_string, $user, $password);

		$stmt_section = $db2->prepare("CALL GetAllStudentSectionsByCourseAndStudentID(?,?)");

		$db2->beginTransaction();
		$stmt_section->execute(array($idcourse, $stud_id));
		
		$result_section = $stmt_section->fetchAll();

		foreach ($result_section as $row_section) {
			$sect_name = $row_section[0];
			$sect_grade = $row_section[1];
echo <<<EOB

					<table class="standard-table">
						<tbody>
							<tr>
								<th scope="col">Section</th>
								<th scope="col">Grade</th>
							</tr>
							<tr>
								<td>$sect_name</td>
								<td>$sect_grade</td>
							</tr>
						</tbody>
					</table>
EOB;
}
echo <<<EOB
				</td>
			</tr>
EOB;

		$db2->commit();
}

echo <<<EOB

		</tbody>
	</table>
EOB;

		$db->commit();
	} catch (PDOException $e) {
		echo $e->getMessage();
	}
?>
