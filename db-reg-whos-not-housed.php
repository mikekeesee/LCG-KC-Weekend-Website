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

$datatype = $_GET['datatype'];

if(!$sidx) $sidx = 1;

$link = mysqli_connect(localhost, $username, $password, $database);

$result = mysqli_query($link, "	SELECT	COUNT(*) as count
						FROM 	Registration
						WHERE	done_housing_ind = 0
								AND Housing_Type IN (9,10)");

$row = mysqli_fetch_array($result);
$count = $row['count'];

if( $count > 0 ) {
	$total_pages = ceil($count / $limit);
} else {
	$total_pages = 1;
}

if ($page > $total_pages)
	$page=$total_pages;

$start = ($limit * $page) - $limit; // do not put $limit*($page - 1)

$SQL = "	SELECT	r.registration_id,
					IFNULL(p.first_name, 'Not Specified') as first_name,
					p.last_name,
					IFNULL(p.email, 'None') as email,
					IFNULL(p.phone, 'None') as phone,
					IFNULL(r.home_city, 'None') as home_city,
					s.String as housing_type_string,
					r.Number_In_Party as num_in_party,
					r.Housed_By as housed_by,
					p.Person_ID as person_id,
					r.Housing_Type as housing_type
			FROM Person as p, Registration_Person rp, Registration as r, String_Base s
			WHERE	r.Registration_ID = rp.Registration_ID
                    AND rp.Person_ID = p.Person_ID
                    AND rp.Main_Contact_Ind = 1
					AND r.Housing_Type = s.String_ID
					AND r.done_housing_ind = 0
					AND r.Housing_Type IN (9,10)
			ORDER BY $sidx $sord LIMIT $start , $limit";

$result = mysqli_query($link,  $SQL ) or die("Couldn't execute query.".$SQL.mysqli_error($link));

if ($datatype == "xml") {
	// we should set the appropriate header information. Do not forget this.
	header("Content-type: text/xml;charset=utf-8");

	$s = "<?xml version='1.0' encoding='utf-8'?>";
	$s .= "<rows>";
	$s .= "<page>".$page."</page>";
	$s .= "<total>".$total_pages."</total>";
	$s .= "<records>".$count."</records>";

	while($row = mysqli_fetch_array($result)) {
		$s .= "<row id='". $row[registration_id]."'>";
		$s .= "<cell>". htmlspecialchars($row[first_name])."</cell>";
		$s .= "<cell>". htmlspecialchars($row[last_name])."</cell>";
		$s .= "<cell>". $row[email]."</cell>";
		$s .= "<cell>". $row[phone]."</cell>";
		$s .= "<cell>". htmlspecialchars($row[home_city])."</cell>";
		$s .= "<cell>". $row[housing_type_string]."</cell>";
		$s .= "<cell>". $row[num_in_party]."</cell>";
		$s .= "<cell>". htmlspecialchars($row[housed_by])."</cell>";
		$s .= "<cell>". $row[person_id]."</cell>";
		$s .= "<cell>". $row[housing_type]."</cell>";
		$s .= "</row>";
	}
	$s .= "</rows>";
} else {
	// we should set the appropriate header information. Do not forget this.
	header("Content-type: text/json;charset=utf-8");

	$s = '{
			"page" : "'.$page.'",
			"total" : "'.$total_pages.'",
			"records" : "'.$count.'",
			"rows" : [';
	
	$i = 1;
	while($row = mysqli_fetch_array($result)) {
        if ($i != 1) $s.= ',';
		$s .= '{"id" : "'. $row[registration_id].'",';
		$s .= '"cell" : [ "'. htmlspecialchars($row[first_name]).'",';
		$s .= '"'.htmlspecialchars($row[last_name]).'",';
		$s .= '"'.$row[email].'",';
		$s .= '"'.$row[phone].'",';
		$s .= '"'.htmlspecialchars($row[home_city]).'",';
		$s .= '"'.$row[housing_type_string].'",';
		$s .= '"'.$row[num_in_party].'",';
		$s .= '"'.htmlspecialchars($row[housed_by]).'",';
		$s .= '"'.$row[person_id].'",';
		$s .= '"'.$row[housing_type].'"]}';
		$i++;
	}
	
	$s .= ']}';

}

echo $s;

mysqli_close($link);

?>
