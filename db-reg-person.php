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
$page = ($page > 0) || 1;

// get how many rows we want to have into the grid - rowNum parameter in the grid
$limit = $_GET['rows'];

// get index row - i.e. user click to sort. At first time sortname parameter -
// after that the index from colModel
$sidx = $_GET['sidx'];

// sorting order - at first time sortorder
$sord = $_GET['sord'];

$admin = $_GET['admin'];

if(!$sidx) $sidx = 1;

$link = mysqli_connect(localhost, $username, $password, $database);

$result = mysqli_query($link, "SELECT COUNT(*) AS count
                               FROM Person p");

$row = mysqli_fetch_array($result);
$count = $row['count'];

if( $count > 0 ) {
	$total_pages = ceil($count / $limit);
} else {
	$total_pages = 0;
}

if ($page > $total_pages)
	$page=$total_pages;

$start = ($limit * $page) - $limit; // do not put $limit*($page - 1)

if ($admin == 1) {
	$SQL = "	SELECT	p.person_id,
						IFNULL(p.first_name, 'Not Specified') as first_name,
						p.last_name,
						IFNULL(s.String, 'Not Entered') AS age_range,
						IFNULL(p.email, 'None') as email,
						IFNULL(p.phone, 'None') as phone
				
				FROM Person p
				
					LEFT OUTER JOIN String_Base s
						ON p.age_range = s.String_ID
						
				ORDER BY $sidx $sord LIMIT $start , $limit";
} else {
	$SQL = "	SELECT	p.person_id,
						IFNULL(p.first_name, 'Not Specified') as first_name,
						p.last_name
				FROM Person p
				ORDER BY $sidx $sord LIMIT $start , $limit";
}
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
	$s .= "<cell>". htmlspecialchars($row[first_name])."</cell>";
	$s .= "<cell>". htmlspecialchars($row[last_name])."</cell>";
	if ($admin == 1) {
		$s .= "<cell>". $row[age_range]."</cell>";
		$s .= "<cell>". $row[email]."</cell>";
		$s .= "<cell>". $row[phone]."</cell>";
	}
	$s .= "</row>";
}
$s .= "</rows>";

echo $s;

mysqli_close($link);

?>
