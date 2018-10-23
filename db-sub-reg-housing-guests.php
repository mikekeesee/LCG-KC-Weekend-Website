<?php

// Get the database connection information
include("db-connect.php");

$id = $_GET['id'];

$link = mysqli_connect(localhost, $username, $password, $database);
    
$SQL = "	SELECT	r.registration_id as reg_id,
					IFNULL(p.first_name, 'Not Specified') as first_name,
					p.last_name,
					IFNULL(p.email, 'None') as email,
					IFNULL(p.phone, 'None') as phone,
					IFNULL(r.home_city, 'None') as home_city,
					r.Number_In_Party as num_in_party
			FROM Registration r, Registration_Person rp, Registration_Housing rh, Person p
			WHERE	rh.Registration_ID = r.Registration_ID
					AND r.Registration_ID = rp.Registration_ID
                    AND rp.Main_Contact_Ind = 1
                    AND rp.Person_ID = p.Person_ID
					AND rh.Housing_ID = $id
			ORDER BY p.last_name, p.first_name";

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
	$s .= "</row>";
}
$s .= "</rows>";

echo $s;

mysqli_close($link);

?>
