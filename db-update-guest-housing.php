<?
	// **********************************************
	// *       Registration Submission Page         *
	// **********************************************

	// Get the database connection information
	include("db-connect.php");

	$link = mysqli_connect(localhost, $username, $password, $database);

	$mc_person_id	= $_GET["person_id"];
	$reg_id			= $_GET["reg_id"];
	
	$SQL = "SELECT	IFNULL(p.First_Name, 'None Specified') AS First_Name,
					p.Last_Name
			
			FROM	Registration_Housing rh
				
				INNER JOIN Housing_Contact hc
					ON rh.Housing_ID = hc.Housing_ID
								
                INNER JOIN Registration_Person rp
                    ON hc.Registration_ID = rp.Registration_ID
                    AND rp.Main_Contact_Ind = 1
                    
				INNER JOIN Person p
					ON rp.Person_ID = p.Person_ID
			
			WHERE	rh.Registration_ID = ".$reg_id;

    $result = mysqli_query($link,  $SQL ) or die(mysqli_error($link)); //"Sorry.  There was a database error - Contact <a 
	while($row = mysqli_fetch_array($result)) {
		$hosts .= htmlspecialchars($row['First_Name']).' '.htmlspecialchars($row['Last_Name']).', ';
	}
	// Strip the last comma off
	$hosts = substr($hosts, 0, strlen($hosts) - 2);

	// Set up the return type header
	$s  = '{ "confirmedHosts": "'.$hosts.'"}';

    header("Content-type: application/json;charset=utf-8");
	echo $s;
	
	mysqli_close($link);	
?>
