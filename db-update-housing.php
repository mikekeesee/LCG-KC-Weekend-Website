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
			WHERE Person_ID = ".$mc_person_id;

	$result = mysql_query( $SQL ) or die(mysql_error()); //"Sorry.  There was a database error - Contact <a href='mailto:mkeesee@gmail.com'>Mike</a> to report that he left a bug in his code."); //$SQL."\n\nCouldn't execute SELECT housing contract query.".mysql_error());
	$row = mysql_fetch_array($result,MYSQL_ASSOC);
	$housing_id = $row['housing_id'];

	if ($housing_city != '' || $housing_how_many != 0 || $housing_house_more_ind != 0 || $guest_names != '') {
		if ($housing_how_many == '') $housing_how_many = '0';

		if ($housing_id > 0) {

			// Get the housing ID for the person
			$SQL = "SELECT housing_id
					FROM Housing_Contact
					WHERE Person_ID = ".$mc_person_id;

			$result = mysql_query( $SQL ) or die("Sorry.  There was a database error - Contact <a href='mailto:mkeesee@gmail.com'>Mike</a> to report that he left a bug in his code."); //$SQL."\n\nCouldn't execute SELECT housing contract query.".mysql_error());
			$row = mysql_fetch_array($result,MYSQL_ASSOC);
			$housing_id = $row['housing_id'];

			// Update their housing information
			$SQL = "UPDATE	Housing_Contact
					SET		Address1 = '".mysql_real_escape_string($housing_address1)."',
							Address2 = '".mysql_real_escape_string($housing_address2)."',
							City = '".mysql_real_escape_string($housing_city)."',
							State = '".$housing_state."',
							Zip = '".$housing_zip."',
							How_Many = ".$housing_how_many.",
							House_More_Ind = ".$housing_house_more_ind.",
							Guest_Names = '".mysql_real_escape_string($guest_names)."',
							Pets_Ind = ".$housing_pets_ind.",
							Pets_Info = '".mysql_real_escape_string($housing_pets_info)."',
							Airport_Transportation_Ind = ".$housing_air_trans.",
							Activity_Transportation_Ind = ".$housing_act_trans.",
							Couples_Ind = ".$housing_couples_ind.",
							Singles_Ind = ".$housing_singles_ind.",
							Girls_Ind = ".$housing_girls_ind.",
							Boys_Ind = ".$housing_boys_ind.",
							Adults_Only_Ind = ".$housing_adults_ind.",
							Babies_Ind = ".$housing_babies_ind.",
							Teens_Ind = ".$housing_teens_ind.",
							Other = '".mysql_real_escape_string($housing_other)."'
					WHERE	Housing_ID = ".$housing_id;

			mysql_query( $SQL ) or die("UPDATE ".mysql_error()); //"Sorry.  There was a database error - Contact <a href='mailto:mkeesee@gmail.com'>Mike</a> to report that he left a bug in his code."); //$SQL."\n\nCouldn't execute SELECT family person query.".mysql_error());

		} else {

			// Insert the new housing information
			$SQL = "INSERT INTO Housing_Contact (
						Housing_ID,
						Person_ID,
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
						".$mc_person_id.",
						'".mysql_real_escape_string($housing_address1)."',
						'".mysql_real_escape_string($housing_address2)."',
						'".mysql_real_escape_string($housing_city)."',
						'".$housing_state."',
						'".$housing_zip."',
						".$housing_how_many.",
						".$housing_house_more_ind.",
						'".mysql_real_escape_string($guest_names)."',
						".$housing_pets_ind.",
						'".mysql_real_escape_string($housing_pets_info)."',
						".$housing_air_trans.",
						".$housing_act_trans.",
						".$housing_couples_ind.",
						".$housing_singles_ind.",
						".$housing_girls_ind.",
						".$housing_boys_ind.",
						".$housing_adults_ind.",
						".$housing_babies_ind.",
						".$housing_teens_ind.",
						'".mysql_real_escape_string($housing_other)."')";

			mysql_query( $SQL ) or die("INSERT".mysql_error()); //"Sorry.  There was a database error - Contact <a href='mailto:mkeesee@gmail.com'>Mike</a> to report that he left a bug in his code."); //$SQL."\n\nCouldn't execute INSERT Housing_Contact query.".mysql_error());
		}
	}
	
	if ($housing_id > 0) {
	    $SQL = "SELECT	IFNULL(p.First_Name, 'None Specified') AS First_Name,
						p.Last_Name
			    
				FROM	Registration_Housing rh
					
					INNER JOIN Registration r
						ON rh.Registration_ID = r.Registration_ID
					
					INNER JOIN Person p
						ON r.Main_Contact_Person_ID = p.Person_ID
				
			    WHERE	rh.Housing_ID = ".$housing_id;
	    $result = mysql_query( $SQL ) or die("GUESTS ".mysql_error()); //"Sorry.  There was a database error - Contact <a 
		while($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
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
	    $result = mysql_query( $SQL ) or die(mysql_error()); //"Sorry.  There was a database error - Contact <a href='mailto:mkeesee@gmail.com'>Mike</a> to report that he left a bug in his code."); //$SQL."\n\nCouldn't execute INSERT Housing_Contact query.".mysql_error());
	    $row = mysql_fetch_array($result,MYSQL_ASSOC);
	
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
	
	mysql_close();	
?>
