<?
	// Get the database connection information
	include("db-connect.php");

	$link = mysqli_connect(localhost, $username, $password, $database);

	// Get the POST data
	$person_id = $_GET['person_id'];
	$reg_id = $_GET['reg_id'];
	$main_contact_first = $_GET['txtFirstName'];
	$main_contact_last = $_GET['txtLastName'];

    // Now get the data to return via JSON
    $SQL = "SELECT	p.Person_ID
            
            FROM	Person p
                
                INNER JOIN Registration_Person rp
                    ON p.Person_ID = rp.Person_ID
                    AND rp.Main_Contact_Ind = 1
                    
                INNER JOIN Registration r
                    ON rp.Registration_ID = r.Registration_ID
            
            WHERE	r.Registration_ID = ".$reg_id;
            
    $result = mysqli_query($link,  $SQL ) or die($SQL."\n\nCouldn't execute registration SELECT query.".mysqli_error($link));
    //"Sorry.  There was a database error - Contact <a href='mailto:mkeesee@gmail.com'>Mike</a> to report that he left a bug in his code."); //$SQL."\n\nCouldn't execute registration SELECT query.".mysqli_error($link));
    $row = mysqli_fetch_array($result);
    $mc_person_id = $row['Person_ID'];
    
	if ($main_contact_first != "" || $main_contact_last != "") {

        $main_contact_age = $_GET['cboAgeRange'];
		$main_contact_email = $_GET['txtEmail'];
		$main_contact_phone = $_GET['txtPhone'];

		$housing_type = $_GET['cboHousingType'];
		$home_city = $_GET['txtHomeCity'];

		$housed_by = $_GET['txtHousedBy'];

		$activity = $_GET['cboActivity'];
		$dining_id = $_GET['cboDining'];

		$SQL = "UPDATE	Person
				SET		First_Name = '".mysqli_real_escape_string($link, $main_contact_first)."',
						Last_Name = '".mysqli_real_escape_string($link, $main_contact_last)."',
						Age_Range = ".$main_contact_age.",
						Email = '".$main_contact_email."',
						Phone = '".$main_contact_phone."'
				WHERE	Person_ID = ".$mc_person_id;

		$result = mysqli_query($link,  $SQL ) or die("Sorry.  There was a database error - Contact <a href='mailto:mkeesee@gmail.com'>Mike</a> to report that he left a bug in his code."); //$SQL."\n\nCouldn't execute main contact UPDATE person query.".mysqli_error($link)); 

		$SQL = "UPDATE	Registration
				SET		Housing_Type = ".$housing_type.",
						Housed_By = '".mysqli_real_escape_string($link, $housed_by)."',
						Dining_ID = ".$dining_id.",
						Home_City = '".mysqli_real_escape_string($link, $home_city)."'
				WHERE	Registration_ID = ".$reg_id;

		mysqli_query($link,  $SQL ) or die($SQL."\n\nCouldn't execute registration UPDATE query.".mysqli_error($link));
		//"Sorry.  There was a database error - Contact <a href='mailto:mkeesee@gmail.com'>Mike</a> to report that he left a bug in his code."); //$SQL."\n\nCouldn't execute registration UPDATE query.".mysqli_error($link));
	}
	
	// Now get the data to return via JSON
	$SQL = "SELECT	p.First_Name,
					p.Last_Name,
					p.Phone,
					p.Email,
					p.Age_Range,
					r.Housing_Type,
					r.Housed_By,
					r.Home_City,
					r.Dining_ID
			
			FROM	Person p
				
				INNER JOIN Registration_Person rp
					ON p.Person_ID = rp.Person_ID
                    
                INNER JOIN Registration r
                    ON rp.Registration_ID = r.Registration_ID
			
			WHERE	p.Person_Id = ".$mc_person_id;
//die ($SQL);
	$result = mysqli_query($link,  $SQL ) or die($SQL."\n\nCouldn't execute registration SELECT query.".mysqli_error($link));
	//"Sorry.  There was a database error - Contact <a href='mailto:mkeesee@gmail.com'>Mike</a> to report that he left a bug in his code."); //$SQL."\n\nCouldn't execute registration SELECT query.".mysqli_error($link));
	$row = mysqli_fetch_array($result);

	// Set up the return type header
	header("Content-type: application/json;charset=utf-8");
	$s  = '{"firstName": "'.htmlspecialchars($row['First_Name']).'",';
	$s .= ' "lastName": "'.htmlspecialchars($row['Last_Name']).'",';
	$s .= ' "phone": "'.$row['Phone'].'",';
	$s .= ' "email": "'.$row['Email'].'",';
	$s .= ' "ageRange": '.$row['Age_Range'].',';
	$s .= ' "housingType": '.$row['Housing_Type'].',';
	$s .= ' "housedBy": "'.htmlspecialchars($row['Housed_By']).'",';
	$s .= ' "homeCity": "'.htmlspecialchars($row['Home_City']).'",';
	$s .= ' "dining": '.$row['Dining_ID'].'}';
	echo $s;
	
	mysqli_close($link);
?>
