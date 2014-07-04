<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Localhost</title>
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
				<th class="col-kind" id="kind"><span>Kind</span></th>
				<th class="col-date"><span>Date Modified</span></th>
				<th class="col-size"><span>Size</span></th>
				<th></th>
			</tr>
	    </thead>
	    <tbody>

<?php

	// Adds pretty filesizes
	function pretty_filesize($file) {
		$size=filesize($file);
		if($size<1024){$size=$size." bytes";}
		elseif(($size<1048576)&&($size>1023)){$size=round($size/1024, 1)." KB";}
		elseif(($size<1073741824)&&($size>1048575)){$size=round($size/1048576, 1)." MB";}
		else{$size=round($size/1073741824, 1)." GB";}
		return $size;
	}

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
		if(is_dir($dirArray[$index]))
		{
				$extn="Folder";
				$size="--";
				$sizekey="0";
				$class="dir";

			// Gets favicon.ico, and displays it, only if it exists.
				if(file_exists("$namehref/favicon.ico"))
					{
						$favicon=" style='background-image:url($namehref/favicon.ico);'";
						$extn="Website";
					}

			// Cleans up . and .. directories
				if($name=="."){$name=". (Current Directory)"; $extn="System Folder"; $favicon=" style='background-image:url($namehref/.favicon.ico);'";}
				if($name==".."){$name=".. (Parent Directory)"; $extn="System Folder";}
		}

	// File-only operations
		else{
			// Gets file extension
			$extn=pathinfo($dirArray[$index], PATHINFO_EXTENSION);

			// Prettifies file type
			switch ($extn){
				case "png": $extn="PNG Image"; break;
				case "jpg": $extn="JPEG Image"; break;
				case "jpeg": $extn="JPEG Image"; break;
				case "svg": $extn="SVG Image"; break;
				case "gif": $extn="GIF Image"; break;
				case "ico": $extn="Windows Icon"; break;

				case "txt": $extn="Text"; break;
				case "log": $extn="Log"; break;
				case "htm": $extn="HTML"; break;
				case "html": $extn="HTML"; break;
				case "xhtml": $extn="HTML"; break;
				case "shtml": $extn="HTML"; break;
				case "php": $extn="PHP"; break;
				case "js": $extn="Javascript"; break;
				case "css": $extn="Stylesheet"; break;
				case "md": $extn="Markdown"; break;

				case "pdf": $extn="PDF Document"; break;
				case "xls": $extn="Spreadsheet"; break;
				case "xlsx": $extn="Spreadsheet"; break;
				case "doc": $extn="Microsoft Word Document"; break;
				case "docx": $extn="Microsoft Word Document"; break;

				case "zip": $extn="ZIP Archive"; break;
				case "htaccess": $extn="Apache Config File"; break;
				case "exe": $extn="Windows Executable"; break;

				default: if($extn!=""){$extn=strtoupper($extn)." File";} else{$extn="Unknown";} break;
			}

			// Gets and cleans up file size
				$size=pretty_filesize($dirArray[$index]);
				$sizekey=filesize($dirArray[$index]);
		}

	// Output
	 echo("
		<tr class='$class'>
			<td></td>
			<td class='col-name'><a href='./$namehref'$favicon class='name'>$name</a></td>
			<td class='col-kind'><a href='./$namehref'>$extn</a></td>
			<td sorttable_customkey='$timekey' class='col-date'><a href='./$namehref'>$modtime</a></td>
			<td sorttable_customkey='$sizekey' class='col-size'><a href='./$namehref'>$size</a></td>
			<td></td>
		</tr>");
	   }
	}
	?>

	    </tbody>
	</table>

	<script src=".localhost/js/jquery.min.js"></script>
	<script src=".localhost/js/colResizable-1.3.med.js"></script>
	<script src=".localhost/js/sorttable.js"></script>
	<script src=".localhost/js/main.js"></script>

</body>
</html>