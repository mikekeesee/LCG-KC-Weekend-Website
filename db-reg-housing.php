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

$with_room = $_GET['with_room'];

if(!$sidx) $sidx = 1;

mysql_connect(localhost,$username,$password);
@mysql_select_db($database) or die( "Unable to select database");

$result = mysql_query("SELECT COUNT(*) AS count FROM Housing_Contact");

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

$SQL = "	SELECT	h.housing_id as housing_id,
					IFNULL(p.first_name, 'Not Specified') as first_name,
					p.last_name as last_name,
					IFNULL(p.email, '') as email,
					IFNULL(p.phone, '') as phone,
					IFNULL(h.address1, '') as addr1,
					IFNULL(h.address2, '') as addr2,
					IFNULL(h.city, '') as city,
					IFNULL(h.state, '') as state,
					IFNULL(h.zip, '') as zip,
					IF(h.house_more_ind=1, 'Y', 'N') as house_more,
					IFNULL(h.how_many, 0) as how_many,
					IFNULL(h.guest_names, '') as guest_names,
					IF(h.pets_ind=1,'Y','N') as pets,
					IFNULL(h.pets_info, '') as pets_info,
					IF(h.airport_transportation_ind=1,'Y','N') as air_trans,
					IF(h.activity_transportation_ind=1,'Y','N') as act_trans,
					IF(h.couples_ind=1,'Y','N') as couples,
					IF(h.singles_ind=1,'Y','N') as singles,
					IF(h.girls_ind=1,'Y','N') as girls,
					IF(h.boys_ind=1,'Y','N') as boys,
					IF(h.adults_only_ind=1,'Y','N') as adults_only,
					IF(h.babies_ind=1,'Y','N') as babies,
					IF(h.teens_ind=1,'Y','N') as teens,
					IFNULL(h.other, '') as other
			FROM	Person p, Housing_Contact h
			WHERE	p.person_id = h.person_id";

//if ($with_room == 1) {
//	$SQL .= "	AND h.House_More_Ind = 1";
//}

$SQL .= "	ORDER BY $sidx $sord LIMIT $start , $limit";


$result = mysql_query( $SQL ) or die("Couldn't execute query.".mysql_error());

// we should set the appropriate header information. Do not forget this.
header("Content-type: text/xml;charset=utf-8");

$s = "<?xml version='1.0' encoding='utf-8'?>";
$s .= "<rows>";
$s .= "<page>".$page."</page>";
$s .= "<total>".$total_pages."</total>";
$s .= "<records>".$count."</records>";

while($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
	$s .= "<row id='". $row[housing_id]."'>";
	$s .= "<cell>". $row[first_name]."</cell>";
	$s .= "<cell>". $row[last_name]."</cell>";
	$s .= "<cell>". $row[house_more]."</cell>";
	$s .= "<cell>". $row[how_many]."</cell>";
	$s .= "<cell>". $row[guest_names]."</cell>";
	$s .= "<cell>". $row[email]."</cell>";
	$s .= "<cell>". $row[phone]."</cell>";
	$s .= "<cell>". $row[addr1]."</cell>";
	$s .= "<cell>". $row[addr2]."</cell>";
	$s .= "<cell>". $row[city]."</cell>";
	$s .= "<cell>". $row[state]."</cell>";
	$s .= "<cell>". $row[zip]."</cell>";
	$s .= "<cell>". $row[pets]."</cell>";
	$s .= "<cell>". $row[pets_info]."</cell>";
	$s .= "<cell>". $row[air_trans]."</cell>";
	$s .= "<cell>". $row[act_trans]."</cell>";
	$s .= "<cell>". $row[couples]."</cell>";
	$s .= "<cell>". $row[singles]."</cell>";
	$s .= "<cell>". $row[girls]."</cell>";
	$s .= "<cell>". $row[boys]."</cell>";
	$s .= "<cell>". $row[adults_only]."</cell>";
	$s .= "<cell>". $row[babies]."</cell>";
	$s .= "<cell>". $row[teens]."</cell>";
	$s .= "<cell>". $row[other]."</cell>";
	$s .= "</row>";
}
$s .= "</rows>";

echo $s;

mysql_close();

?>
