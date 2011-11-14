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

$result = mysql_query("SELECT COUNT(*) AS count FROM Registration");

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

$SQL = "	SELECT	r.registration_id as reg_id,
					IFNULL(p.first_name, 'Not Specified') as first_name,
					p.last_name,
					IFNULL(p.email, 'None') as email,
					IFNULL(p.phone, 'None') as phone,
					IFNULL(r.home_city, 'None') as home_city,
					s.string as housing,
					r.number_in_party as num_in_party,
					r.Housed_By as housed_by,
					CASE	WHEN r.Done_Housing_Ind=1 AND r.Housing_Type IN (9,10)
							THEN 'Yes'
							WHEN r.Done_Housing_Ind=0 AND r.Housing_Type IN (9,10)
							THEN 'No'
							ELSE 'N/A'
							END as done_housing,
					CONCAT('$', IFNULL(pay.Payment_Amount, 0), '.00') as paid
			FROM Registration r
				INNER JOIN Person p
					ON r.Main_Contact_Person_ID = p.Person_ID
				
				INNER JOIN String_Base s
					ON r.housing_type = s.String_ID
				
				LEFT OUTER JOIN Registration_Payment pay
					ON r.Registration_ID = pay.Registration_ID
					
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
	$s .= "<row id='". $row[reg_id]."'>";
	$s .= "<cell>". htmlspecialchars($row[first_name])."</cell>";
	$s .= "<cell>". htmlspecialchars($row[last_name])."</cell>";
	$s .= "<cell>". $row[email]."</cell>";
	$s .= "<cell>". $row[phone]."</cell>";
	$s .= "<cell>". htmlspecialchars($row[home_city])."</cell>";
	$s .= "<cell>". $row[housing]."</cell>";
	$s .= "<cell>". $row[num_in_party]."</cell>";
	$s .= "<cell>". htmlspecialchars($row[housed_by])."</cell>";
	$s .= "<cell>". $row[done_housing]."</cell>";
	$s .= "<cell>". $row[paid]."</cell>";
	$s .= "</row>";
}
$s .= "</rows>";

echo $s;

mysql_close();

?>
