<?
	// Get the database connection information
	include("db-connect.php");

	mysql_connect(localhost,$username,$password) or die("Unable to connect to database");
	mysql_select_db($database) or die("Unable to select database");

	$reg_id			= $_GET["reg_id"];
	$num_in_party	= $_GET["num_in_party"];

	for ($i=1; $i < $num_in_party; $i++) {
        $person_id[$i] = $_GET["hidPersonId".$i];
		$first[$i]	= $_GET["txtFirstName".$i];
		$last[$i]	= $_GET["txtLastName".$i];
		$email[$i]	= $_GET["txtEmail".$i];
		$phone[$i]	= $_GET["txtPhone".$i];
		$age[$i]	= $_GET["cboAgeRange".$i];
	}


	// Insert the Person table data for each family member
	for ($i=1; $i < $num_in_party; $i++) {

		// If the person has already registered, update their information
		if ($person_id[$i] > 0) {

			$SQL = "UPDATE	Person
					SET		First_Name = '".mysql_real_escape_string($first[$i])."',
							Last_Name = '".mysql_real_escape_string($last[$i])."',
							Age_Range = ".$age[$i].",
							Email = '".$email[$i]."',
							Phone = '".$phone[$i]."'
					WHERE	Person_ID = ".$person_id[$i];

			mysql_query( $SQL ) or die("Sorry.  There was a database error - Contact <a href='mailto:mkeesee@gmail.com'>Mike</a> to report that he left a bug in his code."); //$SQL."\n\nCouldn't execute main contact UPDATE person query.".mysql_error());
			
		// If they're a new registrant, enter their information
		} else {
            if ($first[$i] != '' || $last[$i] != '') {
			    $SQL = "INSERT INTO Person
						    (Person_ID,
						        First_Name,
						        Last_Name,
						        Age_Range,
						        Email,
						        Phone)
					    VALUES
						    (NULL,
						        '".mysql_real_escape_string($first[$i])."',
						        '".mysql_real_escape_string($last[$i])."',
						        ".$age[$i].",
						        '".$email[$i]."',
						        '".$phone[$i]."')";

			    mysql_query( $SQL ) or die("Sorry.  There was a database error - Contact <a href='mailto:mkeesee@gmail.com'>Mike</a> to report that he left a bug in his code."); //$SQL."\n\nCouldn't execute INSERT family person query.".mysql_error());
			    $fam_person_id = mysql_insert_id();		

			    // Insert the Registration table data
			    $SQL = "INSERT INTO Registration_Person
						    (Registration_ID,
						        Person_ID)
					    VALUES
						    (".$reg_id.",
						        ".mysql_insert_id().");";

			    mysql_query( $SQL ) or die("Sorry.  There was a database error - Contact <a href='mailto:mkeesee@gmail.com'>Mike</a> to report that he left a bug in his code."); //$SQL."\n\nCouldn't execute INSERT registration person query.".mysql_error());
            }
		}
	}
	
	// Now get the data to return via JSON
	$SQL = "SELECT	p.Person_ID,
                    p.First_Name,
					p.Last_Name,
					p.Phone,
					p.Email,
					p.Age_Range
			
			FROM	Person p
				
				INNER JOIN Registration_Person rp
					ON p.Person_ID = rp.Person_ID
			
			WHERE	rp.Registration_Id = ".$reg_id;

	$result = mysql_query( $SQL ) or die($SQL."\n\nCouldn't execute registration SELECT query.".mysql_error());
	//"Sorry.  There was a database error - Contact <a href='mailto:mkeesee@gmail.com'>Mike</a> to report that he left a bug in his code."); //$SQL."\n\nCouldn't execute registration SELECT query.".mysql_error());

    // Set up the return type header
    header("Content-type: application/json;charset=utf-8");

    $i = 1;
    $s = "[";
	while($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
        if ($i != 1) $s.= ',';
	    $s .= '{"personId": "'.$row['Person_ID'].'",';
        $s .= ' "firstName": "'.htmlspecialchars($row['First_Name']).'",';
	    $s .= ' "lastName": "'.htmlspecialchars($row['Last_Name']).'",';
	    $s .= ' "phone": "'.$row['Phone'].'",';
	    $s .= ' "email": "'.$row['Email'].'",';
	    $s .= ' "ageRange": '.$row['Age_Range'].'}';
        $i++;
    }
    
    $s .= ']';
    echo $s;
	
	mysql_close();
?>
