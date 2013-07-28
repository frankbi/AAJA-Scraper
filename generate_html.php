<?php
	$file = fopen("nyc/Farmers_Markets_in_New_York_State.csv", "r");
	$f = fopen("index.html", "a");
	
	while (($contents = fgetcsv($file)) != FALSE) {
		fwrite($f, "<tr><td>" . $contents[0] . "</td>");
		fwrite($f, "<td>" . $contents[1] . "</td>");
		fwrite($f, "<td>" . $contents[3] . "</td>");
		fwrite($f, "<td>" . $contents[4] . "</td>");
		fwrite($f, "<td>" . $contents[5] . "</td>");
		fwrite($f, "<td>" . $contents[6] . "</td>");
		fwrite($f, "<td>" . $contents[13] . "</td>");
		fwrite($f, "<td>" . $contents[14] . "</td></tr>\n");
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
