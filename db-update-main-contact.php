<?
	// Get the database connection information
	include("db-connect.php");

	mysql_connect(localhost,$username,$password) or die("Unable to connect to database");
	mysql_select_db($database) or die("Unable to select database");


	// Get the POST data
	$mc_person_id = $_GET['person_id'];
	$reg_id = $_GET['reg_id'];
	$main_contact_first = $_GET['txtFirstName'];
	$main_contact_last = $_GET['txtLastName'];

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
				SET		First_Name = '".mysql_real_escape_string($main_contact_first)."',
						Last_Name = '".mysql_real_escape_string($main_contact_last)."',
						Age_Range = ".$main_contact_age.",
						Email = '".$main_contact_email."',
						Phone = '".$main_contact_phone."'
				WHERE	Person_ID = ".$mc_person_id;

		$result = mysql_query( $SQL ) or die("Sorry.  There was a database error - Contact <a href='mailto:mkeesee@gmail.com'>Mike</a> to report that he left a bug in his code."); //$SQL."\n\nCouldn't execute main contact UPDATE person query.".mysql_error()); 

		$SQL = "UPDATE	Registration
				SET		Housing_Type = ".$housing_type.",
						Housed_By = '".mysql_real_escape_string($housed_by)."',
						Dining_ID = ".$dining_id.",
						Home_City = '".mysql_real_escape_string($home_city)."'
				WHERE	Registration_ID = ".$reg_id;

		mysql_query( $SQL ) or die($SQL."\n\nCouldn't execute registration UPDATE query.".mysql_error());
		//"Sorry.  There was a database error - Contact <a href='mailto:mkeesee@gmail.com'>Mike</a> to report that he left a bug in his code."); //$SQL."\n\nCouldn't execute registration UPDATE query.".mysql_error());
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
				
				INNER JOIN Registration r
					ON p.Person_ID = r.Main_Contact_Person_ID
			
			WHERE	p.Person_Id = ".$mc_person_id;

	$result = mysql_query( $SQL ) or die($SQL."\n\nCouldn't execute registration SELECT query.".mysql_error());
	//"Sorry.  There was a database error - Contact <a href='mailto:mkeesee@gmail.com'>Mike</a> to report that he left a bug in his code."); //$SQL."\n\nCouldn't execute registration SELECT query.".mysql_error());
	$row = mysql_fetch_array($result,MYSQL_ASSOC);

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
	
	mysql_close();
?>
