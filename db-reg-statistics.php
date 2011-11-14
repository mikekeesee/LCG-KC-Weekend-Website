<?php

// Get the database connection information
include("db-connect.php");

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

mysql_connect(localhost,$username,$password);
@mysql_select_db($database) or die( "Unable to select database");

$total_pages = 1;

$page=$total_pages;

$start = $limit * $page - $limit; // do not put $limit*($page - 1)

$SQL = "	SELECT 'Number of Guests' AS type, `SUM(number_in_party)` AS value
			
			FROM Number_Of_Guests
			
			UNION
			
			SELECT Activity_Name AS type, `COUNT(pa.Person_ID)` AS value
			FROM `Activity Counts`

			UNION
			
			SELECT String AS type, `COUNT(p.Age_Range)` AS value
			FROM Demographics
			
			UNION
			
			SELECT 'Dining In', Number AS value
			FROM `Dining In`
			
			UNION
			
			SELECT 'Dining Out', Number AS value
			FROM `Dining Out`";

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
	$s .= "<cell>". $row[type]."</cell>";
	$s .= "<cell>". $row[value]."</cell>";
	$s .= "</row>";
}
$s .= "</rows>";

echo $s;

mysql_close();

?>
