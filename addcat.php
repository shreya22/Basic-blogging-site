 <?php
session_start();
require("config.php");
$db = mysql_connect($dbhost, $dbuser, $dbpassword);
mysql_select_db($dbdatabase, $db);

if(isset($_SESSION['USERNAME']) == FALSE) {
echo 'beta tu logged in nhi h! :p';
header("Location: " . $config_basedir);
}

if(isset($_POST['submit'])) {
	$sql = "INSERT INTO categories(cat) VALUES('" . $_POST['cat'] . "');";
	mysql_query($sql); 
	echo 'done sir!';
	header("Location: " . $config_basedir . "viewcat.php");
}
else {
	require("header.php");
}


?>

<form action="<?php echo $_SERVER['REQUEST_URI'] ?>" method="post">
<table>
<tr>
<td>Category</td>
<td><input type="text" name="cat"></td>
</tr>
<tr>
<td></td>
<td><input type="submit" name="submit" value="Add Entry!"></td>
</tr>
</table>
</form>

<?php

require("footer.php");
?>