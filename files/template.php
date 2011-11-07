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
		
		$query="INSERT INTO $table VALUES ();";
	
		append_string('many_.....', $query);
	}
	
	fclose($fhandle);
