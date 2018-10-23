<?
	// **********************************************
	// *       Registration Submission Page         *
	// **********************************************

	// Get the database connection information
	include("db-connect.php");

	$link = mysqli_connect(localhost, $username, $password, $database);

	$mc_person_id	= $_GET["person_id"];
	$reg_id			= $_GET["reg_id"];

	// Housing contact info
	$housing_address1		= $_GET["address1"];
	$housing_address2		= $_GET["address2"];
	$housing_city			= $_GET["city"];
	$housing_state			= $_GET["state"];
	$housing_zip			= $_GET["zip"];
	$housing_how_many		= $_GET["how_many"];
	$housing_house_more_ind	= $_GET["house_more_ind"];
	$guest_names			= $_GET["guest_names"];
	$housing_pets_ind		= $_GET["pets_ind"];
	$housing_pets_info		= $_GET["pets_info"];
	$housing_air_trans		= $_GET["air_trans_ind"];
	$housing_act_trans		= $_GET["act_trans_ind"];
	$housing_couples_ind	= $_GET["couples_ind"];
	$housing_singles_ind	= $_GET["singles_ind"];
	$housing_girls_ind		= $_GET["girls_ind"];
	$housing_boys_ind		= $_GET["boys_ind"];
	$housing_adults_ind		= $_GET["adults_ind"];
	$housing_babies_ind		= $_GET["babies_ind"];
	$housing_teens_ind		= $_GET["teens_ind"];
	$housing_other			= $_GET["other"];

	// Get the housing ID for the person
	$SQL = "SELECT housing_id
			FROM Housing_Contact
			WHERE Registration_ID = ".$reg_id;

	$result = mysqli_query($link,  $SQL ) or die(mysqli_error($link)); //"Sorry.  There was a database error - Contact <a href='mailto:mkeesee@gmail.com'>Mike</a> to report that he left a bug in his code."); //$SQL."\n\nCouldn't execute SELECT housing contract query.".mysqli_error($link));
	$row = mysqli_fetch_array($result);
	$housing_id = $row['housing_id'];

	if ($housing_city != '' || $housing_how_many != 0 || $housing_house_more_ind != 0 || $guest_names != '') {
		if ($housing_how_many == '') $housing_how_many = '0';

		if ($housing_id > 0) {

			// Get the housing ID for the person
			$SQL = "SELECT housing_id
					FROM Housing_Contact
					WHERE Registration_ID = ".$reg_id;

			$result = mysqli_query($link,  $SQL ) or die("Sorry.  There was a database error - Contact <a href='mailto:mkeesee@gmail.com'>Mike</a> to report that he left a bug in his code."); //$SQL."\n\nCouldn't execute SELECT housing contract query.".mysqli_error($link));
			$row = mysqli_fetch_array($result);
			$housing_id = $row['housing_id'];

			// Update their housing information
			$SQL = "UPDATE	Housing_Contact
					SET		Address1 = '".mysqli_real_escape_string($link, $housing_address1)."',
							Address2 = '".mysqli_real_escape_string($link, $housing_address2)."',
							City = '".mysqli_real_escape_string($link, $housing_city)."',
							State = '".$housing_state."',
							Zip = '".$housing_zip."',
							How_Many = ".$housing_how_many.",
							House_More_Ind = ".$housing_house_more_ind.",
							Guest_Names = '".mysqli_real_escape_string($link, $guest_names)."',
							Pets_Ind = ".$housing_pets_ind.",
							Pets_Info = '".mysqli_real_escape_string($link, $housing_pets_info)."',
							Airport_Transportation_Ind = ".$housing_air_trans.",
							Activity_Transportation_Ind = ".$housing_act_trans.",
							Couples_Ind = ".$housing_couples_ind.",
							Singles_Ind = ".$housing_singles_ind.",
							Girls_Ind = ".$housing_girls_ind.",
							Boys_Ind = ".$housing_boys_ind.",
							Adults_Only_Ind = ".$housing_adults_ind.",
							Babies_Ind = ".$housing_babies_ind.",
							Teens_Ind = ".$housing_teens_ind.",
							Other = '".mysqli_real_escape_string($link, $housing_other)."'
					WHERE	Housing_ID = ".$housing_id;

			mysqli_query($link,  $SQL ) or die("UPDATE ".mysqli_error($link)); //"Sorry.  There was a database error - Contact <a href='mailto:mkeesee@gmail.com'>Mike</a> to report that he left a bug in his code."); //$SQL."\n\nCouldn't execute SELECT family person query.".mysqli_error($link));

		} else {

			// Insert the new housing information
			$SQL = "INSERT INTO Housing_Contact (
						Housing_ID,
						Registration_ID,
						Address1,
						Address2,
						City,
						State,
						Zip,
						How_Many,
						House_More_Ind,
						Guest_Names,
						Pets_Ind,
						Pets_Info,
						Airport_Transportation_Ind,
						Activity_Transportation_Ind,
						Couples_Ind,
						Singles_Ind,
						Girls_Ind,
						Boys_Ind,
						Adults_Only_Ind,
						Babies_Ind,
						Teens_Ind,
						Other)
					VALUES (
						NULL,
						".$reg_id.",
						'".mysqli_real_escape_string($link, $housing_address1)."',
						'".mysqli_real_escape_string($link, $housing_address2)."',
						'".mysqli_real_escape_string($link, $housing_city)."',
						'".$housing_state."',
						'".$housing_zip."',
						".$housing_how_many.",
						".$housing_house_more_ind.",
						'".mysqli_real_escape_string($link, $guest_names)."',
						".$housing_pets_ind.",
						'".mysqli_real_escape_string($link, $housing_pets_info)."',
						".$housing_air_trans.",
						".$housing_act_trans.",
						".$housing_couples_ind.",
						".$housing_singles_ind.",
						".$housing_girls_ind.",
						".$housing_boys_ind.",
						".$housing_adults_ind.",
						".$housing_babies_ind.",
						".$housing_teens_ind.",
						'".mysqli_real_escape_string($link, $housing_other)."')";

			mysqli_query($link,  $SQL ) or die("INSERT".mysqli_error($link)); //"Sorry.  There was a database error - Contact <a href='mailto:mkeesee@gmail.com'>Mike</a> to report that he left a bug in his code."); //$SQL."\n\nCouldn't execute INSERT Housing_Contact query.".mysqli_error($link));
		}
	}
	
	if ($housing_id > 0) {
	    $SQL = "SELECT	IFNULL(p.First_Name, 'None Specified') AS First_Name,
						p.Last_Name
			    
				FROM	Registration_Housing rh
					
					INNER JOIN Registration r
						ON rh.Registration_ID = r.Registration_ID
					
					INNER JOIN Registration_Person rp
						ON r.Registration_ID = rp.Registration_ID
				
					INNER JOIN Person p
						ON rp.Person_ID = p.Person_ID
                        AND rp.Main_Contact_Ind = 1
				
			    WHERE	rh.Housing_ID = ".$housing_id;
                
	    $result = mysqli_query($link,  $SQL ) or die("GUESTS ".mysqli_error($link)); //"Sorry.  There was a database error - Contact <a 
		while($row = mysqli_fetch_array($result)) {
			$guests .= htmlspecialchars($row['First_Name']).' '.htmlspecialchars($row['Last_Name']).', ';
		}
		// Strip the last comma off
		$guests = substr($guests, 0, strlen($guests) - 2);
		
	    $SQL = "SELECT	Address1,
					    Address2,
					    City,
					    State,
					    Zip,
					    How_Many,
					    House_More_Ind,
					    Guest_Names,
					    Pets_Ind,
					    Pets_Info,
					    Airport_Transportation_Ind,
					    Activity_Transportation_Ind,
					    Couples_Ind,
					    Singles_Ind,
					    Girls_Ind,
					    Boys_Ind,
					    Adults_Only_Ind,
					    Babies_Ind,
					    Teens_Ind,
					    Other

				FROM	Housing_Contact
				
			    WHERE	Housing_ID = ".$housing_id;
	    $result = mysqli_query($link,  $SQL ) or die(mysqli_error($link)); //"Sorry.  There was a database error - Contact <a href='mailto:mkeesee@gmail.com'>Mike</a> to report that he left a bug in his code."); //$SQL."\n\nCouldn't execute INSERT Housing_Contact query.".mysqli_error($link));
	    $row = mysqli_fetch_array($result);
	
	    // Set up the return type header
	    $s  = '{"address1": "'.htmlspecialchars($row['Address1']).'",';
	    $s .= ' "address2": "'.htmlspecialchars($row['Address2']).'",';
	    $s .= ' "city": "'.htmlspecialchars($row['City']).'",';
	    $s .= ' "state": "'.htmlspecialchars($row['State']).'",';
	    $s .= ' "zip": "'.htmlspecialchars($row['Zip']).'",';
	    $s .= ' "howMany": '.$row['How_Many'].',';
	    $s .= ' "houseMore": '.$row['House_More_Ind'].',';
	    $s .= ' "guestNames": "'.htmlspecialchars($row['Guest_Names']).'",';
	    $s .= ' "petsInd": '.$row['Pets_Ind'].',';
	    $s .= ' "petsInfo": "'.htmlspecialchars($row['Pets_Info']).'",';
	    $s .= ' "airportTransportationInd": '.$row['Airport_Transportation_Ind'].',';
	    $s .= ' "activityTransportationInd": '.$row['Activity_Transportation_Ind'].',';
	    $s .= ' "couples": '.$row['Couples_Ind'].',';
	    $s .= ' "singles": '.$row['Singles_Ind'].',';
	    $s .= ' "girls": '.$row['Girls_Ind'].',';
	    $s .= ' "boys": '.$row['Boys_Ind'].',';
	    $s .= ' "adults": '.$row['Adults_Only_Ind'].',';
	    $s .= ' "babies": '.$row['Babies_Ind'].',';
	    $s .= ' "teens": '.$row['Teens_Ind'].',';
	    $s .= ' "other": "'.htmlspecialchars($row['Other']).'",';
	    $s .= ' "housing_id": "'.$housing_id.'",';
		$s .= ' "confirmedGuests": "'.$guests.'"}';
    } else {
	    $s  = '{"address1": "",';
	    $s .= ' "address2": "",';
	    $s .= ' "city": "",';
	    $s .= ' "state": "",';
	    $s .= ' "zip": "",';
	    $s .= ' "howMany": 0,';
	    $s .= ' "houseMore": 0,';
	    $s .= ' "guestNames": "",';
	    $s .= ' "petsInd": 0,';
	    $s .= ' "petsInfo": "",';
	    $s .= ' "airportTransportationInd": 0,';
	    $s .= ' "activityTransportationInd": 0,';
	    $s .= ' "couples": 0,';
	    $s .= ' "singles": 0,';
	    $s .= ' "girls": 0,';
	    $s .= ' "boys": 0,';
	    $s .= ' "adults": 0,';
	    $s .= ' "babies": 0,';
	    $s .= ' "teens": 0,';
	    $s .= ' "other": "",';
		$s .= ' "confirmedGuests": ""}';
    }

    header("Content-type: application/json;charset=utf-8");
	echo $s;
	
	mysqli_close($link);	
?>
