<?php
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
	
	for ($i = 0; $i < 100; $i++) {
		switch (rand(1,5)) {
			case 1:
				$code = "INF";
				break;
			case 2:
				$code = "EKO";
				break;
			case 3:
				$code = "MAT";
				break;
			case 4:
				$code = "FIL";
				break;
			case 5:
				$code = "LIT";
		}
		
		$code .= rand(100, 999);
		
		$rand = rand(0, $word_count - 1);
		$name = format_string($word_array[$rand]);
		
		$points = rand(1, 30) . "." . rand(0,9);
		
		$query="INSERT INTO course VALUES (null, '$code', '$name', '$points');";
	
		append_string('many_courses.sql', $query);
	}
	
	fclose($fhandle);
