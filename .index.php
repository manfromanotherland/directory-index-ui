<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Localhost</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link rel="stylesheet" href="./.localhost/css/main.css">
</head>
<body>

	<?php
	// Checks to see if veiwing hidden files is enabled
	if($_SERVER['QUERY_STRING']=="hidden") {
		$hide="";
		$ahref="./";
		$atext="hide";
	} else {
		$hide=".";
		$ahref="./?hidden";
		$atext="show";
	}
	?>

	<header role="banner" class="header">
		<h1>Localhost</h1>
		<nav role="navigation" class="nav">
			<?php echo("<a href='$ahref' class='btn btn--$atext'>Hidden</a>"); ?>
		</nav>
	</header>

	<table class="sortable">
	    <thead>
			<tr>
				<th></th>
				<th class="col-name"><span>Name</span></th>
				<th class="col-date"><span>Date Modified</span></th>
				<th></th>
			</tr>
	    </thead>
	    <tbody>

<?php

	// Opens directory
	$myDirectory=opendir(".");

	// Gets each entry
	while($entryName=readdir($myDirectory)) {
		$dirArray[]=$entryName;
	}

	// Closes directory
	closedir($myDirectory);

	// Counts elements in array
	$indexCount=count($dirArray);

	// Sorts files
	sort($dirArray);

	// Loops through the array of files
	for($index=0; $index < $indexCount; $index++) {

		// Decides if hidden files should be displayed, based on query above.
		if(substr("$dirArray[$index]", 0, 1)!=$hide) {

			// Resets Variables
			$favicon="";
			$class="file";

			// Gets File Names
			$name=$dirArray[$index];
			$namehref=$dirArray[$index];

			// Gets Date Modified
			$modtime=date("M j, Y, g:i A", filemtime($dirArray[$index]));
			$timekey=date("YmdHis", filemtime($dirArray[$index]));

				// Separates directories, and performs operations on those directories
				if(is_dir($dirArray[$index])) {

					$extn="Folder";
					$size="--";
					$sizekey="0";
					$class="dir";

					// Gets favicon.ico, and displays it, only if it exists.
					if(file_exists("$namehref/favicon.ico")) {
						$favicon=" style='background-image:url($namehref/favicon.ico);'";
						$extn="Website";
					}

				// Cleans up . and .. directories
				if($name=="."){$name=". (Current Directory)"; $extn="System Folder"; $favicon=" style='background-image:url($namehref/.favicon.ico);'";}
				if($name==".."){$name=".. (Parent Directory)"; $extn="System Folder";}
			}

			// Output
			echo("
			<tr class='$class'>
				<td></td>
				<td class='col-name'><a href='./$namehref'$favicon class='name'>$name</a></td>
				<td sorttable_customkey='$timekey' class='col-date'><a href='./$namehref'>$modtime</a></td>
				<td></td>
			</tr>");

		}
	}
?>

		</tbody>
	</table>

	<script src=".localhost/js/jquery.min.js"></script>
	<script src=".localhost/js/sorttable.js"></script>

</body>
</html>