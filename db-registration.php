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

$result = mysqli_query($link, "SELECT COUNT(*) AS count FROM Registration");

$row = mysqli_fetch_array($result);
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
					r.number_in_party as num_in_party,
                    GROUP_CONCAT(CONCAT(dine.number_in_party, ' ', (CASE dine.Dining_Type_ID WHEN 15 THEN 'Adult' WHEN 16 THEN 'Child (9-13)' WHEN 17 THEN 'Child (3-8)' WHEN 19 THEN 'Donated Adult' WHEN 20 THEN 'Donated Child' END)) SEPARATOR ', ') as num_dining,
					s2.string as dining,
					CONCAT('$', IFNULL(pay.Amount_Due, 0)) as due,
					CONCAT('$', IFNULL(pay.Payment_Amount, 0)) as paid
			FROM Registration r

                INNER JOIN Registration_Person rp
                    ON r.Registration_ID = rp.Registration_ID
                    AND rp.Main_Contact_Ind = 1
                
                INNER JOIN Person p
					ON rp.Person_ID = p.Person_ID
				
				INNER JOIN String_Base s
					ON r.housing_type = s.String_ID
				
				INNER JOIN String_Base s2
					ON r.dining_id = s2.String_ID
					
				LEFT OUTER JOIN Registration_Payment pay
					ON r.Registration_ID = pay.Registration_ID
					
				LEFT OUTER JOIN Registration_Dining dine
					ON r.Registration_ID = dine.Registration_ID
					
				LEFT OUTER JOIN String_Base s3
					ON dine.Dining_Type_ID = s3.String_ID
            
            GROUP BY r.Registration_ID
			ORDER BY $sidx $sord LIMIT $start , $limit";

$result = mysqli_query($link, $SQL) or die("Couldn't execute query.".mysqli_error($link));

// we should set the appropriate header information. Do not forget this.
header("Content-type: text/xml;charset=utf-8");

$s = "<?xml version='1.0' encoding='utf-8'?>";
$s .= "<rows>";
$s .= "<page>".$page."</page>";
$s .= "<total>".$total_pages."</total>";
$s .= "<records>".$count."</records>";

while($row = mysqli_fetch_array($result)) {
	$s .= "<row id='". $row[reg_id]."'>";
	$s .= "<cell>". htmlspecialchars($row[first_name])."</cell>";
	$s .= "<cell>". htmlspecialchars($row[last_name])."</cell>";
	$s .= "<cell>". $row[email]."</cell>";
	$s .= "<cell>". $row[phone]."</cell>";
	$s .= "<cell>". htmlspecialchars($row[home_city])."</cell>";
	$s .= "<cell>". $row[num_in_party]."</cell>";
	$s .= "<cell>". htmlspecialchars($row[num_dining])."</cell>";
	$s .= "<cell>". $row[dining]."</cell>";
	$s .= "<cell>". $row[due]."</cell>";
	$s .= "<cell>". $row[paid]."</cell>";
	$s .= "</row>";
}
$s .= "</rows>";

echo $s;

mysqli_close($link);

?>
