<?php

	// Get the database connection information
	include("db-connect.php");
	
	$id = $_GET['id'];
	
	mysql_connect(localhost,$username,$password);
	@mysql_select_db($database) or die( "Unable to select database");
	
	$SQL = "SELECT	p.person_id,
					IFNULL(p.first_name, 'Not Specified') as first_name,
					p.last_name,
					s.String AS age_range,
					IFNULL(p.email, 'None') as email,
					IFNULL(p.phone, 'None') as phone
			FROM	Registration_Person rp, Person p, String_Base s
			WHERE	rp.Person_ID = p.Person_ID
					AND p.age_range = s.String_ID
					AND rp.Registration_ID = $id
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
		$s .= "<cell>". $row[first_name]."</cell>";
		$s .= "<cell>". $row[last_name]."</cell>";
		$s .= "<cell>". $row[age_range]."</cell>";
		$s .= "<cell>". $row[email]."</cell>";
		$s .= "<cell>". $row[phone]."</cell>";
		$s .= "</row>";
	}
	$s .= "</rows>";
	
	echo $s;
	
	mysql_close();

?>
