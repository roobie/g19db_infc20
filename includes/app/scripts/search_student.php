<?php 
	$term = $_POST['search_term'];

	$term = "%$term%";
	require '../../../inc/database_props.php';

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
<div id="student-search-result"></div>

	<table class="standard-table">
	    
    <caption>
  		This is the result from the query given.
    </caption>

    <tr>
			<th scope="col">Student</th>
			<th scope="col">ID</th>
			<th scope="col">Civic number</th>
			<th scope="col">Address</th>
			<th scope="col">Telephone</th>
			<th scope="col">Email</th>
			<th scope="col">Domestic/Foreign</th>
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
	$mail		= '<a href="mailto:' . $mail . '">mail</a>';
	$domf		= $row[7];
echo <<<EOB
		<tr>
			<th scope="row">$name</th>
			<td>$id</td>
			<td>$civ</td>
			<td>$addr</td>
			<td>$tel</td>
			<td>$mail</td>
			<td>$domf</td>
		</tr>
EOB;
}

echo <<<EOB

  </table>
</div>
EOB;

		$db->commit();

	} catch (PDOException $e) {
		echo $e->getMessage();
	}
?>