

<?php
	require("header.php"); echo '<br>';
	$sql = "SELECT entries.*, categories.cat FROM entries, categories
	WHERE entries.cat_id = categories.id
	ORDER BY dateposted DESC
	LIMIT 1;";
	$result = mysql_query($sql);
	$row = mysql_fetch_assoc($result);
	
	echo "<h2><a href='viewentry.php?id=" . $row['id']
	."'>" . $row['subject'].
	"</a></h2><br />";
	
	echo "<i>In <a href='viewcat.php?id=" . $row['cat_id']
	."'>" . $row['cat'] .
	"</a> - Posted on " . date("D jS F Y g.iA",
	strtotime($row['dateposted'])) .
	"</i>";
	if(isset($_SESSION['USERNAME']) == TRUE) {
	echo " [<a href='updateentry.php?id=" . $row['id'] . "'>edit</a>]";
	}
	
	echo "<p>";
	echo ($row['body']);
	echo "</p>";
	
	echo "<p>";
	$commsql = "SELECT * FROM comments WHERE blog_id = " . $row['id'] .
	" ORDER BY dateposted;";
	$commresult = mysql_query($commsql);
	$numrows_comm = mysql_num_rows($commresult);
	
	if($numrows_comm == 0) {
	echo "<p>No comments.</p>";
	}
	else {
	echo "(<strong>" . $numrows_comm . "</strong>) comments : <br>";
	$i = 1;
	while($commrow = mysql_fetch_assoc($commresult)) {
	echo "<a href='viewentry.php?id=" . $row['id'] ."#comment" . $i .
	"'>" . $commrow['name'] . ":</a> ". $commrow['comment'];
	$i++;
	echo '<br>';
	}
	}
	echo "</p>";
	$prevsql = "SELECT entries.*, categories.cat FROM entries, categories
	WHERE entries.cat_id = categories.id
	ORDER BY dateposted DESC
	LIMIT 1, 5;";
	$prevresult = mysql_query($prevsql);
	$numrows_prev = mysql_num_rows($prevresult);
		
	if($numrows_prev == 0) {
		echo "<p>No previous entries.</p>";
	}
	else {

		echo "<ul>";
		while($prevrow = mysql_fetch_assoc($prevresult)) {
		echo "<li><a href='viewentry.php?id="
		. $prevrow['id'] . "'><strong>" . $prevrow ['subject']
		. "</strong></a></li>";
		}
		echo "</ul>";
		
	}
	
	
		
	require("footer.php");
?>

