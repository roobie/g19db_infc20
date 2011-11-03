<?php

	function append_text($file_name = 'append_string.out', $data) {
		$handle = fopen($file_name, "a+");
		
		fwrite($handle, "\n");
		fwrite($handle, $data);
		
		fclose($handle); 
	}
?>
