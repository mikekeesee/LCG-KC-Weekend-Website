<?php

// get index row - i.e. user click to sort. At first time sortname parameter -
// after that the index from colModel
$sidx = $_GET['sidx'];

// sorting order - at first time sortorder
$sord = $_GET['sord'];

// Get the database connection information
include("db-connect.php");

$link = mysqli_connect(localhost, $username, $password, $database);

$SQL = "SELECT	activity_id,
				activity_name
		FROM Activity_Type
		ORDER BY 1"; //$sidx $sord";

$result = mysqli_query($link, $SQL) or die("Couldn't execute query.".mysqli_error($link));

// we should set the appropriate header information. Do not forget this.
header("Content-type: text/xml;charset=utf-8");

$s = "<?xml version='1.0' encoding='utf-8'?>";
$s .= "<rows>";
while($row = mysqli_fetch_array($result)) {
	$s .= "<row id='". $row[activity_id]."'>";
	$s .= "<cell>". $row[activity_name]."</cell>";
	$s .= "</row>";
}
$s .= "</rows>";

echo $s;

mysqli_close($link);

?>
