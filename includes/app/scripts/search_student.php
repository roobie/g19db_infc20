<?php 
	
	$term = $_POST['search_term'];

	$term = "%$term%";

	require 'database_props.php';

	$data = array($term, $term, $term, $term, $term, $term, $term, $term);

	try {
		$db = new PDO($pdo_connection_string, $user, $password);

		$st = $db->prepare("
						SELECT *
						FROM student
						WHERE
							idstudent LIKE ? OR
							social_security_number LIKE ? OR
							first_name LIKE ? OR
							last_name LIKE ? OR
							address LIKE ? OR
							phone_number LIKE ? OR
							email LIKE ? OR
							type LIKE ?
						");

		$db->beginTransaction();
			$st->execute($data);

			//$st->setFetchMode(PDO::FETCH_ASSOC);

			// Building the table:

echo <<<EOB
	<table class="standard-table">

    <caption>
  		To update a row, simply click it.
    </caption>

		<tbody>
    <tr>
			<th scope="col">Student</th>
			<th scope="col">ID</th>
			<th scope="col">Civic number</th>
			<th scope="col">Address</th>
			<th scope="col">Telephone</th>
			<th scope="col">Email</th>
			<th scope="col">Exchange?</th>
    </tr>
EOB;

$result_set = $st->fetchAll();

foreach ($result_set as $row) {
	$name		= $row[2] . " " . $row[3];
	$id			= $row[0];
	$civ		= $row[1];
	$addr		= $row[4];
	$tel		= $row[5];
	$mail		= $row[6];
	$mail		= '<a href="mailto:' . $mail . '">'.$mail.'</a>';
	$domf		= $row[7];
	if ($domf == 'foreign') {
		$domf = '<span class="green-text">yes</span>';
	} else {
		$domf = '<span class="red-text">no</span>';
	};

echo <<<EOB
		<tr>
			<th id="student-row-$id" class="td-clickable" scope="row">$name</th>
			<td class="td-clickable">$id</td>
			<td class="td-clickable">$civ</td>
			<td class="td-clickable">$addr</td>
			<td class="td-clickable">$tel</td>
			<td class="td-clickable">$mail</td>
			<td class="td-clickable">$domf</td>
		</tr>
EOB;
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