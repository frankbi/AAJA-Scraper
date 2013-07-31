<?php
	$file = fopen("nyc/Farmers_Markets_in_New_York_State.csv", "r");


	$counter = 0;
	$pagenum = 0;
	$f;
	while (($contents = fgetcsv($file)) != FALSE) {
		$counter++;
		if (($counter % 100) == 0) {
			$pagenum++;
			$f = fopen("page" . $pagenum . ".html", "w");
			fwrite($f, "<html>\n<head>\n" . 
				"    <title>Farmer Markets in New York</title>\n" .
				"</head>\n<body>\n" . 
				"    <table>\n");
			writerow($counter, $f, $contents);
		} else {
			$pagenum++;
			writerow($counter, $f, $contents);
		}
	}
	fwrite($f, "    </table>\n</body>\n</html>");

	function writerow($c, $file, $data) {
		if ($c != 1) {
			fwrite($file, "    <tr>\n        <td>" . $data[0] . "</td>\n    " .
				"    <td>" . $data[1] . "</td>\n    " .
				"    <td>" . $data[3] . "</td>\n    " .
				"    <td>" . $data[4] . "</td>\n    " .
				"    <td>" . $data[5] . "</td>\n    " .
				"    <td>" . $data[6] . "</td>\n    " .
				"    <td>" . $data[13] . "</td>\n    " .
				"    <td>" . $data[14] . "</td>\n    " .
				"</tr>\n");
		} else {
			fwrite($file, "    <th>\n        <td>" . $data[0] . "</td>\n    " .
				"    <td>" . $data[1] . "</td>\n    " .
				"    <td>" . $data[3] . "</td>\n    " .
				"    <td>" . $data[4] . "</td>\n    " .
				"    <td>" . $data[5] . "</td>\n    " .
				"    <td>" . $data[6] . "</td>\n    " .
				"    <td>" . $data[13] . "</td>\n    " .
				"    <td>" . $data[14] . "</td>\n    " .
				"</th>\n");
		}
	}

	fclose($f);
	fclose($file);
?>
