<?php
	/*
		NB. Does not guarantee unique ssn's
	*/
	ini_set('display_errors', 'On');
	error_reporting(E_ALL | E_STRICT);
	function append_string($file_name = 'append_string.out', $data) {	
		$handle = fopen($file_name, "a+");
		
		fwrite($handle, "\n");
		fwrite($handle, $data);
		
		fclose($handle); 
	}

	function format_string($str) {
		return mysql_escape_string(mb_ucasefirst($str));
	}
	
	function replace_newline($string) {
		return (string)str_replace(array("\r", "\r\n", "\n"), ' ', $string);
	}

	function mb_ucasefirst($str) {
		$str[0] = mb_strtoupper($str[0]);
		return $str;
	} 
	$file_name = 'most_common_words';
	$fhandle = fopen($file_name, "r");
	$fcontents = fread($fhandle, filesize($file_name));
	$fcontents = replace_newline($fcontents);
	$word_array = explode(" ", $fcontents);
	$word_count = count($word_array);

	for ($i = 0; $i < 500; $i++) {
		$ssn = rand(75, 92);
		$rand = rand(1,12);
		if ($rand < 10) {
			$ssn .= "0" . $rand;
		} else {
			$ssn .= $rand;
		}
		$rand = rand(1,28);
		if ($rand < 10) {
			$ssn .= "0" . $rand;
		} else {
			$ssn .= $rand;
		} 
		$ssn .= rand(1000, 9999);
		
		$rand = rand(0, $word_count - 1);
		$fname = format_string($word_array[$rand]);
		
		$rand = rand(0, $word_count - 1);
		$lname = format_string($word_array[$rand]);
		
		$rand = rand(0, $word_count - 1);
		$address = format_string($word_array[$rand]) . " Rd.";
		$address .= " " . rand(1,100);
		
		$phone_nbr = '+46' . "(0)" . '7' . rand(0, 9) . "-" . rand(0, 9) . rand(0, 9) . rand(0, 9) . "-" . rand(0, 9) . rand(0, 9) . "-" . rand(0, 9) . rand(0, 9);
		
		$rand = rand(0, $word_count - 1);
		$email = format_string($word_array[$rand]);
		$rand = rand(0, $word_count - 1);
		$email .= "@" . format_string($word_array[$rand]);
		switch (rand(1,5)) {
			case 1:
				$email .= ".com";
				break;
			case 2:
				$email .= ".net";
				break;
			case 3:
				$email .= ".se";
				break;
			case 4:
				$email .= ".no";
				break;
			case 5:
				$email .= ".dk";
		}
		$rand = rand(1, 10);
		if ($rand == 10) {
			$type = "foreign";
			$ssn = NULL;
			$query="INSERT INTO student VALUES (null, null, '$fname', '$lname', '$address', '$phone_nbr', '$email', '$type');";
		} else {
			$type = "domestic";
			$query="INSERT INTO student VALUES (null, '$ssn', '$fname', '$lname', '$address', '$phone_nbr', '$email', '$type');";
		};
	
		append_string('many_students.sql', $query);
	}
	
	fclose($fhandle);

