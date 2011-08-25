<?php

// Get the database connection information
include("db-connect.php");

mysql_connect(localhost,$username,$password);
@mysql_select_db($database) or die( "Unable to select database");

// to the url parameter are added 4 parameters as described in colModel
// we should get these parameters to construct the needed query
// Since we specify in the options of the grid that we will use a GET method
// we should use the appropriate command to obtain the parameters.
// In our case this is $_GET. If we specify that we want to use post
// we should use $_POST. Maybe the better way is to use $_REQUEST, which
// contain both the GET and POST variables. For more information refer to php documentation.
// Get the requested page. By default grid sets this to 1.
$page = $_GET['page'];

// get how many rows we want to have into the grid - rowNum parameter in the grid
$limit = $_GET['rows'];

// get index row - i.e. user click to sort. At first time sortname parameter -
// after that the index from colModel
$sidx = $_GET['sidx'];

// sorting order - at first time sortorder
$sord = $_GET['sord'];

if(!$sidx) $sidx = 1;

$result = mysql_query("SELECT COUNT(*) AS count FROM Person p, Person_Activity pa WHERE p.Person_ID = pa.Person_ID");

$row = mysql_fetch_array($result,MYSQL_ASSOC);
$count = $row['count'];

if( $count > 0 ) {
	$total_pages = ceil($count / $limit);
} else {
	$total_pages = 0;
}

if ($page > $total_pages)
	$page=$total_pages;

$start = $limit * $page - $limit; // do not put $limit*($page - 1)

$SQL = "SELECT	p.Person_Id as person_id,
				p.First_Name as first_name,
				p.Last_Name as last_name,
				a.activity_name
		FROM Activity_Type a, Person_Activity ap, Person p
		WHERE	a.Activity_ID = ap.Activity_ID
				AND ap.Person_ID = p.Person_ID
		ORDER BY $sidx $sord LIMIT $start , $limit";

$result = mysql_query( $SQL ) or die("Couldn't execute query.".mysql_error());

// we should set the appropriate header information. Do not forget this.
header("Content-type: text/xml;charset=utf-8");

$s = "<?xml version='1.0' encoding='utf-8'?>";
$s .= "<rows>";
$s .= "<page>".$page."</page>";
$s .= "<total>".$total_pages."</total>";
$s .= "<records>".$count."</records>";
while($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
	$s .= "<row id='". $row[person_id]."'>";
	$s .= "<cell>". $row[first_name]."</cell>";
	$s .= "<cell>". $row[last_name]."</cell>";
	$s .= "<cell>". $row[activity_name]."</cell>";
	$s .= "</row>";
}
$s .= "</rows>";

echo $s;

mysql_close();

?>
