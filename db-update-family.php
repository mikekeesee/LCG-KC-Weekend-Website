<?
	// Get the database connection information
	include("db-connect.php");

	$link = mysqli_connect(localhost, $username, $password, $database);
    
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
					SET		First_Name = '".mysqli_real_escape_string($link, $first[$i])."',
							Last_Name = '".mysqli_real_escape_string($link, $last[$i])."',
							Age_Range = ".$age[$i].",
							Email = '".$email[$i]."',
							Phone = '".$phone[$i]."'
					WHERE	Person_ID = ".$person_id[$i];

			mysqli_query($link,  $SQL ) or die("Sorry.  There was a database error - Contact <a href='mailto:mkeesee@gmail.com'>Mike</a> to report that he left a bug in his code."); //$SQL."\n\nCouldn't execute main contact UPDATE person query.".mysqli_error($link));
			
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
						        '".mysqli_real_escape_string($link, $first[$i])."',
						        '".mysqli_real_escape_string($link, $last[$i])."',
						        ".$age[$i].",
						        '".$email[$i]."',
						        '".$phone[$i]."')";

			    mysqli_query($link,  $SQL ) or die("Sorry.  There was a database error - Contact <a href='mailto:mkeesee@gmail.com'>Mike</a> to report that he left a bug in his code."); //$SQL."\n\nCouldn't execute INSERT family person query.".mysqli_error($link));
			    $fam_person_id = mysqli_insert_id($link);		

			    // Insert the Registration table data
			    $SQL = "INSERT INTO Registration_Person
						    (Registration_ID,
						        Person_ID)
					    VALUES
						    (".$reg_id.",
						        ".mysqli_insert_id($link).");";

			    mysqli_query($link,  $SQL ) or die("Sorry.  There was a database error - Contact <a href='mailto:mkeesee@gmail.com'>Mike</a> to report that he left a bug in his code."); //$SQL."\n\nCouldn't execute INSERT registration person query.".mysqli_error($link));
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
                    AND rp.Main_Contact_Ind = 0
			
			WHERE	rp.Registration_Id = ".$reg_id;

	$result = mysqli_query($link,  $SQL ) or die($SQL."\n\nCouldn't execute registration SELECT query.".mysqli_error($link));
	//"Sorry.  There was a database error - Contact <a href='mailto:mkeesee@gmail.com'>Mike</a> to report that he left a bug in his code."); //$SQL."\n\nCouldn't execute registration SELECT query.".mysqli_error($link));

    // Set up the return type header
    header("Content-type: application/json;charset=utf-8");

    $i = 1;
    $s = "[";
	while($row = mysqli_fetch_array($result)) {
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
	
	mysqli_close($link);
?>
