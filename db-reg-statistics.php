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

$link = mysqli_connect(localhost, $username, $password, $database);

$total_pages = 1;

$page=$total_pages;

$start = $limit * $page - $limit; // do not put $limit*($page - 1)

$SQL = "	SELECT '<h5>Total Registered</h5>' AS type, '' AS value

			UNION
			
			SELECT CONCAT(' - ', 'All') as type, SUM(Number_In_Party)
			FROM Registration
			
			UNION

			SELECT CONCAT(' - ', 'Number of Guests') AS type, `SUM(number_in_party)` AS value
			
			FROM Number_Of_Guests
			
			UNION
			
			SELECT '<b>Housing Counts</b>' AS type, '' AS value

			UNION
			
			SELECT CONCAT(' - ', s.String) AS type, SUM(r.Number_In_Party) AS value
			FROM String_Base s
				INNER JOIN Registration r
					ON s.String_ID = Housing_Type
			WHERE String_Grouping = 2
			GROUP BY s.String
			
			UNION
			
			SELECT '<b>Activity Counts</b>' AS type, '' AS value

			UNION
			
			SELECT CONCAT(' - ', Activity_Name) AS type, `COUNT(pa.Person_ID)` AS value
			FROM `Activity Counts`

			UNION
			
			SELECT '<b>Demographic Counts</b>' AS type, '' AS value

			UNION
			
			SELECT CONCAT(' - ', String) AS type, `COUNT(p.Age_Range)` AS value
			FROM Demographics
			
			UNION
			
			SELECT '<b>Dining Preference</b>' AS type, '' AS value

			UNION
			
			SELECT CONCAT(' - ', 'Dining In'), Number AS value
			FROM `Dining In`
			
			UNION
			
			SELECT CONCAT(' - ', 'Dining Out'), Number AS value
			FROM `Dining Out`
			
			UNION
			
			SELECT CONCAT(' - ', Dinner_Choice), Count AS value
			FROM `Dinner Choices`";

$result = mysqli_query($link, $SQL) or die("Couldn't execute query.".mysqli_error($link));

// we should set the appropriate header information. Do not forget this.
header("Content-type: text/xml;charset=utf-8");

$s = "<?xml version='1.0' encoding='utf-8'?>";
$s .= "<rows>";
$s .= "<page>".$page."</page>";
$s .= "<total>".$total_pages."</total>";
$s .= "<records>".$count."</records>";

while($row = mysqli_fetch_array($result)) {
	$s .= "<row id='". $row[person_id]."'>";
	$s .= "<cell>". $row[type]."</cell>";
	$s .= "<cell>". $row[value]."</cell>";
	$s .= "</row>";
}
$s .= "</rows>";

echo $s;

mysqli_close($link);

?>
