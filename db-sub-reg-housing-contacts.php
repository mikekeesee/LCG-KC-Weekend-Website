<?php

// Get the database connection information
include("db-connect.php");

$id = $_GET['id'];

mysql_connect(localhost,$username,$password);
@mysql_select_db($database) or die( "Unable to select database");

$SQL = "	SELECT	p.person_id,
					IFNULL(p.first_name, 'Not Specified') as first_name,
					p.last_name,
					IFNULL(p.email, 'None') as email,
					IFNULL(p.phone, 'None') as phone,
					hc.Address1 as address1,
					hc.Address2 as address2,
					hc.City as city,
					hc.State as state,
					hc.Zip as zip
			FROM Registration_Housing rh, Housing_Contact hc, Person p
			WHERE	rh.Housing_ID = hc.Housing_ID
					AND hc.Person_ID = p.Person_ID
					AND rh.Registration_ID = ".$id."
			ORDER BY p.last_name, p.first_name";

$result = mysql_query($SQL) or die("Couldn't execute query.".mysql_error());

// we should set the appropriate header information. Do not forget this.
header("Content-type: text/xml;charset=utf-8");

$s = "<?xml version='1.0' encoding='utf-8'?>";
$s .= "<rows>";
$s .= "<page>".$page."</page>";
$s .= "<total>".$total_pages."</total>";
$s .= "<records>".$count."</records>";

while($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
	$s .= "<row id='". $row[person_id]."'>";
	$s .= "<cell>". htmlspecialchars($row[first_name])."</cell>";
	$s .= "<cell>". htmlspecialchars($row[last_name])."</cell>";
	$s .= "<cell>". htmlspecialchars($row[email])."</cell>";
	$s .= "<cell>". $row[phone]."</cell>";
	$s .= "<cell>". htmlspecialchars($row[address1])."</cell>";
	$s .= "<cell>". htmlspecialchars($row[address2])."</cell>";
	$s .= "<cell>". htmlspecialchars($row[city])."</cell>";
	$s .= "<cell>". htmlspecialchars($row[state])."</cell>";
	$s .= "<cell>". $row[zip]."</cell>";
	$s .= "</row>";
}
$s .= "</rows>";

echo $s;

mysql_close();

?>
