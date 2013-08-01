<?php
	$file = fopen("nyc/Farmers_Markets_in_New_York_State.csv", "r");
	$counter = -1; $pagenum = 0; $f;
	while (($contents = fgetcsv($file)) != FALSE) {
		$counter++;
		if ($counter == 0) {
			$pagenum++;
			$f = opentowrite($pagenum);
		} else if (($counter % 100) == 0) {
			$pagenum++;
			pageendwrite($f);
			$f = opentowrite($pagenum);
			writerow($counter, $f, $contents);
		}
		$f = fopen("page" . $pagenum . ".html", "a");
		writerow($counter, $f, $contents);
	}
	pageendwrite($f);
	fclose($f);
	fclose($file);

	function opentowrite($pagenum) {
			$connection = fopen("page" . $pagenum . ".html", "w");
			fwrite($connection, "<html>\n<head>\n" . 
				"    <title>Farmer Markets in New York</title>\n" .
				"        <link href=\"style.css\">" .
				"        <script src=\"script.js\" type=\"javascript\"></script>" .
				"</head>\n<body>\n" .
				"<h1>Farmer Markets in New York</h1>\n" . 
				"    <table border=\"1\">\n");
			return $connection;
	}

	function pageendwrite($f) {
		fwrite($f, "    </table>\n" .
			"<a href=\"page1.html\">1</a> " .
			"<a href=\"page2.html\">2</a> " .
			"<a href=\"page3.html\">3</a> " .
			"<a href=\"page4.html\">4</a> " .
			"<a href=\"page5.html\">5</a> " .
			"</body>\n</html>");
	}

	function writerow($c, $file, $data) {
		if ($c != 0) {
			fwrite($file, "    <tr>\n        <td class=\"tabledata\">" . $data[0] . "</td>\n    " .
				"    <td class=\"tabledata\">" . $data[1] . "</td>\n    " .
				"    <td class=\"tabledata\">" . $data[3] . "</td>\n    " .
				"    <td class=\"tabledata\">" . $data[4] . "</td>\n    " .
				"    <td class=\"tabledata\">" . $data[5] . "</td>\n    " .
				"    <td class=\"tabledata\">" . $data[6] . "</td>\n    " .
				"    <td class=\"tabledata\">" . $data[13] . "</td>\n    " .
				"    <td class=\"tabledata\">" . $data[14] . "</td>\n    " .
				"</tr>\n");
		} else {
			fwrite($file, "    <tr>\n        <th class=\"tableheader\">" . $data[0] . "</th>\n    " .
				"    <th class=\"tableheader\">" . $data[1] . "</th>\n    " .
				"    <th class=\"tableheader\">" . $data[3] . "</th>\n    " .
				"    <th class=\"tableheader\">" . $data[4] . "</th>\n    " .
				"    <th class=\"tableheader\">" . $data[5] . "</th>\n    " .
				"    <th class=\"tableheader\">" . $data[6] . "</th>\n    " .
				"    <th class=\"tableheader\">" . $data[13] . "</th>\n    " .
				"    <th class=\"tableheader\">" . $data[14] . "</th>\n    " .
				"</tr>\n");
		}
	}
?>
