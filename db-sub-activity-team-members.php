<?php

	// Get the database connection information
	include("db-connect.php");
	
	$id = $_GET['id'];
	
	$link = mysqli_connect(localhost, $username, $password, $database);	
    
	$SQL = "SELECT	p.person_id,
					IFNULL(p.first_name, 'Not Specified') as first_name,
					p.last_name as last_name
			FROM	Team_Member tm
				
				INNER JOIN Person p
					ON tm.Person_ID = p.Person_ID
					
			WHERE	tm.Team_ID = $id
			ORDER BY tm.Team_Captain_Ind DESC, p.last_name, p.first_name";
	
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
		$s .= "</row>";
	}
	$s .= "</rows>";
	
	echo $s;
	
	mysqli_close($link);

?>
