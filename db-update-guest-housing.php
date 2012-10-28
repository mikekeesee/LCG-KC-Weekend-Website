<?
	// **********************************************
	// *       Registration Submission Page         *
	// **********************************************

	// Get the database connection information
	include("db-connect.php");

	mysql_connect(localhost,$username,$password) or die("Unable to connect to database");
	mysql_select_db($database) or die("Unable to select database");

	$mc_person_id	= $_GET["person_id"];
	$reg_id			= $_GET["reg_id"];
	
	$SQL = "SELECT	IFNULL(p.First_Name, 'None Specified') AS First_Name,
					p.Last_Name
			
			FROM	Registration_Housing rh
				
				INNER JOIN Housing_Contact hc
					ON rh.Housing_ID = hc.Housing_ID
				
				INNER JOIN Person p
					ON hc.Person_ID = p.Person_ID
			
			WHERE	rh.Registration_ID = ".$reg_id;
	$result = mysql_query( $SQL ) or die(mysql_error()); //"Sorry.  There was a database error - Contact <a 
	while($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
		$hosts .= htmlspecialchars($row['First_Name']).' '.htmlspecialchars($row['Last_Name']).', ';
	}
	// Strip the last comma off
	$hosts = substr($hosts, 0, strlen($hosts) - 2);

	// Set up the return type header
	$s  = '{ "confirmedHosts": "'.$hosts.'"}';

    header("Content-type: application/json;charset=utf-8");
	echo $s;
	
	mysql_close();	
?>
