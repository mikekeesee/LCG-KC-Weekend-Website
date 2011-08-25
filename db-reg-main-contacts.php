<?php

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

$username="mmoluf_kc";
$password="kc";
$database="mmoluf_kcweekend";

mysql_connect(localhost,$username,$password);
@mysql_select_db($database) or die( "Unable to select database");

$result = mysql_query("SELECT COUNT(*) AS count FROM Person");

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

$SQL = "	SELECT	r.registration_id,
					IFNULL(p.first_name, 'Not Specified') as first_name,
					p.last_name,
					IFNULL(p.email, 'None') as email,
					IFNULL(p.phone, 'None') as phone,
					CASE r.housing_type
						WHEN 1 THEN 'KC Resident'
						WHEN 2 THEN 'Hotel'
						WHEN 3 THEN 'Stay with brethren'
						WHEN 4 THEN 'Already housed'
						WHEN 5 THEN 'None of the above'
						END AS housing_type
			FROM Person as p, Registration as r
			WHERE	r.Main_Contact_Person_ID = p.Person_ID
					AND r.housing_type IN (3,4)
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
	$s .= "<row id='". $row[registration_id]."'>";
	$s .= "<cell>". $row[first_name]."</cell>";
	$s .= "<cell>". $row[last_name]."</cell>";
	$s .= "<cell>". $row[email]."</cell>";
	$s .= "<cell>". $row[phone]."</cell>";
	$s .= "<cell>". $row[housing_type]."</cell>";
	$s .= "</row>";
}
$s .= "</rows>";

echo $s;

mysql_close();

?>
