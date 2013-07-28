<?php
	$file = fopen("nyc/Farmers_Markets_in_New_York_State.csv", "r");
	$f = fopen("index.html", "a");
	
	while (($contents = fgetcsv($file)) != FALSE) {
		//echo $contents[0] . " | " . $contents[1] . "\n";
		fwrite($f, $contents[0] . "\n");
	}
	
	/*
		County [0]
		Market Name [1]
		Address Line 1 [3]
		City [4]
		State [5]
		Zip [6]
		Latitude [13]
		Longitude [14]
	*/

	fclose($f);
	fclose($file);
?>
