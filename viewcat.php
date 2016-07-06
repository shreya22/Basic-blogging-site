<?php
	require("config.php");
	
	if(isset($_GET['id']) == TRUE) {
		$error =0;
		if(is_numeric($_GET['id']) == FALSE) {
			$error = 1;
		}
		if($error == 1) {
			header("Location: " . $config_basedir);
		}
		else {
			$validcat = $_GET['id'];
		}
		}
	else {
		$validcat = 0;
	}
	
	
//	echo $validcat;
	require('header.php');
	
	$sql = "select * from categories;";
	$result = mysql_query($sql);
	while($row = mysql_fetch_assoc($result)) {
		if($validcat == $row['id']) {
			echo "<strong>" . $row['cat'] . "</strong><br />";
			$entriessql = "SELECT * FROM entries WHERE cat_id = " . $validcat .
			" ORDER BY dateposted DESC;";
			$entriesres = mysql_query($entriessql);
			$numrows_entries = mysql_num_rows($entriesres);
			echo "<ul>";
			
			if($numrows_entries == 0) {
				echo "<li>No entries!</li>";
			}
			else {
				while($entriesrow = mysql_fetch_assoc($entriesres)) {
					echo "<li>" . date("D jS F Y g.iA", strtotime($entriesrow
					['dateposted'])) .
					" - <a href='viewentry.php?id=" . $entriesrow['id'] . "'>" .
					$entriesrow['subject'] ."</a></li>";
				}
			}
			echo "</ul>";
			}
			
			else {
			echo "<a href='viewcat.php?id=" . $row['id'] . "'>" . $row['cat'] .
			"</a><br />";
			}
}
require("footer.php");


?>