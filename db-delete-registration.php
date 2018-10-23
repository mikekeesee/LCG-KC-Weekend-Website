<?
	// Get the database connection information
	include("db-connect.php");

	$link = mysqli_connect(localhost, $username, $password, $database);

	// Get the POST data
	$person_id = $_GET['person_id'];
	$reg_id = $_GET['reg_id'];

	$SQL = "DELETE	Registration
			FROM	Registration
			WHERE	Registration_ID = ".$reg_id;

	$result = mysqli_query($link, $SQL) or die(mysqli_error($link));//"Sorry.  There was a database error - Contact <a href='mailto:mkeesee@gmail.com'>Mike</a> to report that he left a bug in his code."); //$SQL."\n\nCouldn't execute main contact UPDATE person query.".mysqli_error($link)); 

	// This assumes the person is a guest of someone.
    $SQL = "DELETE	Registration_Housing
			FROM	Registration_Housing
			WHERE	Registration_ID = ".$reg_id;

	$result = mysqli_query($link, $SQL) or die(mysqli_error($link));//"Sorry.  There was a database error - Contact <a href='mailto:mkeesee@gmail.com'>Mike</a> to report that he left a bug in his code."); //$SQL."\n\nCouldn't execute main contact UPDATE person query.".mysqli_error($link)); 

    $SQL = "DELETE	Registration_Dining
			FROM	Registration_Dining
			WHERE	Registration_ID = ".$reg_id;

	$result = mysqli_query($link, $SQL) or die(mysqli_error($link));//"Sorry.  There was a database error - Contact <a href='mailto:mkeesee@gmail.com'>Mike</a> to report that he left a bug in his code."); //$SQL."\n\nCouldn't execute main contact UPDATE person query.".mysqli_error($link)); 

    $SQL = "DELETE	Registration_Payment
			FROM	Registration_Payment
			WHERE	Registration_ID = ".$reg_id;

	$result = mysqli_query($link, $SQL) or die(mysqli_error($link));//"Sorry.  There was a database error - Contact <a href='mailto:mkeesee@gmail.com'>Mike</a> to report that he left a bug in his code."); //$SQL."\n\nCouldn't execute main contact UPDATE person query.".mysqli_error($link)); 

	$SQL = "SELECT	housing_id
			FROM	Housing_Contact
			WHERE	Registration_ID = ".$reg_id;
	
	$result = mysqli_query($link, $SQL) or die(mysqli_error($link));//$SQL);//"Sorry.  There was a database error - Contact <a href='mailto:mkeesee@gmail.com'>Mike</a> to report that he left a bug in his code."); //$SQL."\n\nCouldn't execute main contact UPDATE person query.".mysqli_error($link)); 
	$count = mysqli_num_rows($result);
	
	// Check to see if this is a host family.
	if ($count > 0) {
        $row = mysqli_fetch_array($result);
		$housing_id = $row[housing_id];
		
		$SQL = "DELETE	Housing_Contact
				FROM	Housing_Contact
				WHERE	Registration_ID = ".$reg_id;

		$result = mysqli_query($link, $SQL) or die(mysqli_error($link));//"Sorry.  There was a database error - Contact <a href='mailto:mkeesee@gmail.com'>Mike</a> to report that he left a bug in his code."); //$SQL."\n\nCouldn't execute main contact UPDATE person query.".mysqli_error($link)); 
		
		$SQL = "DELETE	Registration_Housing
				FROM	Registration_Housing
				WHERE	Housing_ID = ".$housing_id;

		$result = mysqli_query($link, $SQL) or die(mysqli_error($link));//"Sorry.  There was a database error - Contact <a href='mailto:mkeesee@gmail.com'>Mike</a> to report that he left a bug in his code."); //$SQL."\n\nCouldn't execute main contact UPDATE person query.".mysqli_error($link)); 
	}
		
	mysqli_close($link);
?>
