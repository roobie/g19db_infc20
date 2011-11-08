<?php

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

$result_set = $stmt->fetchAll();
$db->commit();
foreach ($result_set as $row) {
$stud_id = $row[0];
$stud_name = $row[1] . " " . $row[2];
echo <<<EOB
				
			<tr id="student-row-$stud_id" class="student-other-tr">
				<td class="td-clickable" scope="row">$stud_name</th>
				<td class="td-clickable" scope="row">
EOB;
//MAN FÅR LA GÖRA EN SÖKNING HÄR
		$stmt_section = $db->prepare("CALL GetAllStudentSectionsByCourseAndStudentID(?,?)");

		$db->beginTransaction();
		$stmt_section->execute(array($idcourse, $stud_id));
		
		$result_section = $stmt_section->fetchAll();
		
		$db->commit();
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
}

echo <<<EOB

		</tbody>
	</table>
EOB;


	} catch (PDOException $e) {
		echo $e->getMessage();
	}
?>
